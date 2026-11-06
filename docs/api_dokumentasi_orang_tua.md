# Dokumentasi API: Role Orang Tua / Wali untuk Aplikasi Mobile (APK)

Dokumen ini adalah panduan integrasi untuk pengembang Aplikasi Mobile (Flutter / Android) dalam mengimplementasikan fitur khusus **Role Orang Tua / Wali (`orang_tua`)** untuk memantau aktivitas, kehadiran, dan laporan harian anak yang sedang magang di PT. Media Balai Nusa.

---

## 1. Alur Role di Aplikasi Mobile (Multi-Role Support)

Aplikasi mobile kini mendukung 3 role:
1. **`pelamar`** (Siswa Magang): Mengisi laporan harian, memindai presensi QR, mengajukan sertifikat.
2. **`pembimbing`** (Guru/Dosen Pembimbing): Memeriksa & menyetujui (ACC) laporan bimbingan, memantau absensi siswa binaannya.
3. **`orang_tua`** (Orang Tua / Wali): **Memantau kehadiran anak secara real-time, melihat rekap status magang, dan membaca seluruh laporan harian anak.**

> **Tips Navigasi UI Mobile:**
> Saat login berhasil, periksa nilai `data.user.role`:
> * Jika `role == 'orang_tua'`, arahkan aplikasi ke **Dashboard Khusus Orang Tua** dengan menu bawah (Bottom Navigation Bar):
>   1. **Beranda**: Ringkasan anak, status kehadiran hari ini, total laporan.
>   2. **Absensi**: Rekapitulasi & riwayat jam masuk/pulang anak.
>   3. **Laporan**: Riwayat aktivitas harian anak & status ACC pembimbing.
>   4. **Profil**: Data diri anak, guru pembimbing, dan orang tua.

---

## 2. Endpoint Autentikasi (Login)

### `POST /api/login`
Orang Tua dapat login menggunakan email dan password akun orang tua yang didaftarkan oleh admin.

#### Request Headers:
```http
Accept: application/json
Content-Type: application/json
```

#### Request Body:
```json
{
  "email": "orangtua@gmail.com",
  "password": "password_orang_tua"
}
```

#### Response Sukses (HTTP 200 OK):
```json
{
  "status": "success",
  "message": "Login berhasil!",
  "data": {
    "token": "15|9xKk...sanctum_token...",
    "user": {
      "id": 74,
      "name": "Bapak Joko (Wali Fikri)",
      "email": "orangtua@gmail.com",
      "role": "orang_tua",
      "nim": null,
      "no_telp": "08123456789",
      "anak": {
        "id": 73,
        "name": "fikri firdaus",
        "email": "fikrifirdaus753@gmail.com",
        "nim": "6404230042",
        "no_telp": "089531558273",
        "sekolah": "politeknik negri bengkalis",
        "jurusan": "Teknik Informatika",
        "status_magang": "diterima"
      }
    }
  }
}
```

---

## 3. Daftar Endpoint Khusus Orang Tua

Semua endpoint di bawah ini memerlukan header:
```http
Authorization: Bearer <SANCTUM_TOKEN>
Accept: application/json
```

---

### A. Dashboard Utama Orang Tua
* **Endpoint**: `GET /api/orang-tua/dashboard`
* **Deskripsi**: Menampilkan data anak yang diasuh, kartu statistik kehadiran & laporan, status kehadiran anak hari ini, serta 5 riwayat absensi & laporan terbaru.

#### Response (HTTP 200 OK):
```json
{
  "status": "success",
  "data": {
    "orang_tua": {
      "id": 74,
      "name": "Bapak Joko (Wali Fikri)",
      "email": "orangtua@gmail.com",
      "role": "orang_tua"
    },
    "anak": {
      "id": 73,
      "name": "fikri firdaus",
      "email": "fikrifirdaus753@gmail.com",
      "nim": "6404230042",
      "no_telp": "089531558273",
      "sekolah": "politeknik negri bengkalis",
      "jurusan": "Teknik Informatika",
      "kelas": "TI-4B",
      "status_magang": "diterima",
      "tanggal_mulai": "2026-07-01",
      "tanggal_selesai": "2026-12-31",
      "guru_pembimbing": {
        "name": "Ahmad Dani, M.Kom",
        "email": "pembimbing@gmail.com",
        "no_telp": "081299887766"
      }
    },
    "stats": {
      "kehadiran": {
        "total_hadir": 14,
        "total_izin": 1,
        "total_sakit": 0,
        "total_alfa": 0,
        "status_hari_ini": "Sedang Magang (Masuk: 08:05 WIB)"
      },
      "laporan": {
        "total_laporan": 12,
        "disetujui": 11,
        "menunggu": 1,
        "ditolak": 0
      }
    },
    "absensi_terbaru": [
      {
        "id": 45,
        "tanggal": "2026-11-05",
        "tanggal_formatted": "Kamis, 05 November 2026",
        "jam_masuk": "08:05",
        "jam_keluar": "-",
        "status": "Hadir",
        "keterangan": "Hadir tepat waktu",
        "foto_masuk_url": "http://192.168.43.101:8000/uploads/absensi/foto.jpg",
        "foto_keluar_url": null
      }
    ],
    "laporan_terbaru": [
      {
        "id": 30,
        "tanggal": "2026-11-04",
        "tanggal_formatted": "Rabu, 04 November 2026",
        "kegiatan": "Konfigurasi server jaringan dan maintenance router mikrotik kantor",
        "catatan": null,
        "status": "approved",
        "foto_url": "http://192.168.43.101:8000/laporan_harian/bukti.jpg"
      }
    ]
  }
}
```

---

### B. Monitoring Seluruh Riwayat Absensi Anak
* **Endpoint**: `GET /api/orang-tua/absensi`
* **Deskripsi**: Mengambil seluruh log absensi anak dari hari pertama magang hingga saat ini.

#### Response (HTTP 200 OK):
```json
{
  "status": "success",
  "data": {
    "anak": {
      "id": 73,
      "name": "fikri firdaus",
      "nim": "6404230042"
    },
    "total_hari": 15,
    "total_hadir": 14,
    "total_izin": 1,
    "total_sakit": 0,
    "total_alfa": 0,
    "riwayat": [
      {
        "id": 45,
        "tanggal": "2026-11-05",
        "tanggal_formatted": "Kamis, 05 November 2026",
        "jam_masuk": "08:05",
        "jam_keluar": "17:02",
        "status": "Hadir",
        "keterangan": "Hadir via Scan QR Layar Kantor",
        "foto_masuk_url": "http://192.168.43.101:8000/uploads/absensi/123_masuk.jpg",
        "foto_keluar_url": "http://192.168.43.101:8000/uploads/absensi/123_pulang.jpg",
        "lokasi_masuk": "Kantor PT. MEDIA BALAI NUSA (Via QR)"
      }
    ]
  }
}
```

---

### C. Monitoring Seluruh Laporan Harian Anak
* **Endpoint**: `GET /api/orang-tua/laporan`
* **Deskripsi**: Mengambil daftar lengkap laporan kerja harian anak beserta status persetujuan dari guru pembimbing.

#### Response (HTTP 200 OK):
```json
{
  "status": "success",
  "data": {
    "anak": {
      "id": 73,
      "name": "fikri firdaus",
      "nim": "6404230042"
    },
    "total_laporan": 12,
    "disetujui": 11,
    "pending": 1,
    "ditolak": 0,
    "laporan": [
      {
        "id": 30,
        "tanggal": "2026-11-04",
        "tanggal_formatted": "Rabu, 04 November 2026",
        "kegiatan": "Melakukan instalasi kabel jaringan LAN kantor cabang",
        "catatan": "Kerja bagus, pertahankan ketelitian.",
        "status": "approved",
        "foto_url": "http://192.168.43.101:8000/laporan_harian/kegiatan.jpg",
        "created_at": "2026-11-04 16:30"
      }
    ]
  }
}
```

---

### D. Detail Satu Laporan Harian Anak
* **Endpoint**: `GET /api/orang-tua/laporan/{id}`
* **Deskripsi**: Menampilkan detail lengkap satu laporan harian yang dipilih oleh orang tua.

---

### E. Profil Lengkap Anak & Informasi Magang
* **Endpoint**: `GET /api/orang-tua/profil-anak`
* **Deskripsi**: Data lengkap siswa, asal sekolah, jurusan, kontak guru pembimbing, dan kontak wali.

---

## 4. Contoh Penanganan Role di Flutter (Dart)

```dart
// Saat login berhasil:
final userData = response['data']['user'];
final String role = userData['role'];

if (role == 'orang_tua') {
  // Arahkan ke Beranda Khusus Orang Tua
  Navigator.pushReplacement(
    context,
    MaterialPageRoute(builder: (context) => OrangTuaMainScreen()),
  );
} else if (role == 'pembimbing') {
  Navigator.pushReplacement(
    context,
    MaterialPageRoute(builder: (context) => PembimbingMainScreen()),
  );
} else {
  // Role 'pelamar' (Siswa)
  Navigator.pushReplacement(
    context,
    MaterialPageRoute(builder: (context) => SiswaMainScreen()),
  );
}
```
