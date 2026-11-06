# Dokumentasi API: Presensi QR Dinamis (Anti-Screenshot) untuk Aplikasi Mobile (APK)

Dokumen ini adalah panduan integrasi untuk pengembang Aplikasi Android / Mobile (Flutter, Kotlin, React Native, dll.) dalam menghubungkan scanner kamera HP ke sistem presensi dinamis PT. Media Balai Nusa.

---

## 1. Konsep Keamanan Anti-Screenshot (Dynamic QR)

1. Layar monitor Admin (`/data-absensi/qr`) menampilkan **QR Code Dinamis** yang **otomatis diperbarui setiap 20 detik**.
2. Setiap QR Code membawa token unik berbatas waktu (time-based token) yang disimpan di cache server backend Laravel.
3. Jika seorang siswa mencoba **mengambil tangkapan layar (screenshot / foto layar)** lalu mengirimkannya ke teman di luar kantor melalui WhatsApp, saat foto tersebut dipindai oleh teman, token sudah kedaluwarsa dan server akan menolak dengan pesan error:
   `"QR Code sudah kedaluwarsa atau tidak valid!"` (HTTP 400).

---

## 2. Format Data QR Code yang Dipindai Scanner

Ketika kamera HP memindai QR Code di layar admin, isi teks QR berupa format JSON:
```json
{
  "app": "magang-mbn",
  "type": "dynamic_attendance_qr",
  "token": "MBN-QR-OVEGISSCZ8-1793865989",
  "ts": 1793865989
}
```

> **Catatan Fleksibilitas Backend:**
> Aplikasi mobile dapat mengirimkan **seluruh teks JSON mentah** hasil scan ke parameter `qr_token`, atau hanya nilai `token`-nya saja. Backend Laravel secara otomatis mengenali dan mengekstrak token validnya.

---

## 3. Spesifikasi Endpoint API

- **URL Endpoint**: `POST /api/absensi/scan-qr`
- **Autentikasi**: Wajib menggunakan **Bearer Token (Laravel Sanctum)** milik siswa yang sedang login.
- **Content-Type**: `multipart/form-data` (jika melampirkan foto) ATAU `application/json` (jika tanpa foto).

### Header Permintaan (Request Headers):
```http
Authorization: Bearer <SANCTUM_TOKEN_SISWA>
Accept: application/json
```

### Parameter Permintaan (Request Body):

| Parameter | Tipe Data | Wajib? | Keterangan |
| :--- | :--- | :--- | :--- |
| `qr_token` | `string` | **WAJIB** | String token atau seluruh teks JSON hasil pemindaian kamera. |
| `tipe` | `string` | *Opsional* | `'masuk'` atau `'pulang'`. Jika dikosongkan, backend otomatis mendeteksi (jika hari ini belum absen masuk -> otomatis masuk; jika sudah masuk -> otomatis pulang). |
| `foto` | `file (image)` | *Opsional* | File foto selfie kehadiran dari kamera HP (JPG, PNG maks 2MB). |
| `lokasi` | `string` | *Opsional* | Keterangan lokasi atau koordinat GPS (contoh: `"-1.4851, 102.1382"`). |
| `keterangan` | `string` | *Opsional* | Catatan kegiatan / kehadiran (default: `"Hadir via Scan QR Layar Kantor"`). |

---

## 4. Contoh Respon Server

### A. Berhasil Absen Masuk (HTTP 200 OK)
```json
{
  "status": "success",
  "tipe": "masuk",
  "message": "Presensi MASUK berhasil! Tercatat pada pukul 08:05:12 WIB.",
  "data": {
    "id": 45,
    "id_users": 12,
    "tgl_absen": "2026-11-05",
    "jam_masuk": "08:05:12",
    "status": "Hadir",
    "status_validasi": "valid"
  }
}
```

### B. Berhasil Absen Pulang (HTTP 200 OK)
```json
{
  "status": "success",
  "tipe": "pulang",
  "message": "Presensi PULANG berhasil! Tercatat pada pukul 16:01:25 WIB. Hati-hati di jalan!",
  "data": {
    "id": 45,
    "jam_masuk": "08:05:12",
    "jam_keluar": "16:01:25",
    "status": "Hadir"
  }
}
```

### C. Gagal: QR Code Kedaluwarsa / Hasil Screenshot Lama (HTTP 400 Bad Request)
```json
{
  "status": "error",
  "code": "QR_EXPIRED",
  "message": "QR Code sudah kedaluwarsa atau tidak valid! Mohon arahkan kamera ke layar monitor kantor dan pindai QR Code terbaru yang sedang tampil."
}
```

### D. Peringatan: Sudah Selesai Masuk & Pulang Hari Ini (HTTP 200 OK)
```json
{
  "status": "info",
  "message": "Anda sudah menyelesaikan absensi masuk (08:05 WIB) dan absen pulang (16:01 WIB) untuk hari ini.",
  "data": { ... }
}
```

---

## 5. Contoh Implementasi di Flutter (Dart)

```dart
import 'dart:convert';
import 'package:http/http.dart' as http;

Future<void> submitQrAttendance({
  required String rawQrString,
  required String sanctumToken,
}) async {
  final url = Uri.parse('http://192.168.1.10:8000/api/absensi/scan-qr');

  final response = await http.post(
    url,
    headers: {
      'Authorization': 'Bearer $sanctumToken',
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    },
    body: jsonEncode({
      'qr_token': rawQrString,
      'keterangan': 'Hadir tepat waktu via Aplikasi Mobile',
    }),
  );

  final resData = jsonDecode(response.body);

  if (response.statusCode == 200 && resData['status'] == 'success') {
    // Tampilkan notifikasi berhasil (Masuk / Pulang)
    print('Berhasil: ${resData['message']}');
  } else if (resData['code'] == 'QR_EXPIRED') {
    // Beritahu siswa bahwa QR sudah kedaluwarsa (misal jika scan screenshot)
    print('Peringatan: ${resData['message']}');
  } else {
    print('Error: ${resData['message']}');
  }
}
```
