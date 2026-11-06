# Dokumentasi API: Role Pembimbing Lapangan untuk Aplikasi Mobile (APK)

Dokumen ini adalah panduan lengkap integrasi bagi pengembang aplikasi mobile (Flutter / React Native / Android) untuk mengimplementasikan role **Pembimbing Lapangan (Mentor Industri)** (`pembimbing_lapangan`) di PT. Media Balai Nusa.

---

## 1. Arsitektur Role di Aplikasi Mobile

Aplikasi mobile kini mendukung 4 Role:
1. **`pelamar`** (Siswa Magang): Mengisi laporan harian, presensi QR, mengajukan sertifikat, chat mentor.
2. **`pembimbing`** (Guru Pembimbing Sekolah): Memantau perkembangan akademik siswa.
3. **`pembimbing_lapangan`** (Mentor Industri Perusahaan): **ACC Izin, Verifikasi Sertifikat, Chat Siswa, ACC Laporan Harian, dan Monitoring Absensi Siswa.**
4. **`orang_tua`** (Wali/Orang Tua): Memantau kehadiran dan log harian anak.

### Rekomendasi Navigasi Mobile (Bottom Navigation Bar):
Saat login berhasil dengan `role == 'pembimbing_lapangan'`, arahkan aplikasi ke **Dashboard Khusus Pembimbing Lapangan** dengan tab:
1. **Beranda**: Statistik cepat (total siswa, izin pending, laporan pending, sertifikat pending, presensi hari ini).
2. **ACC Izin**: Daftar permohonan izin/sakit siswa, foto surat dokter, tombol ACC dan Tolak.
3. **Laporan**: Log harian siswa dengan foto dokumentasi kegiatan, tombol ACC dan Tolak revisi.
4. **Absensi**: Rekap kehadiran harian (jam masuk, jam pulang, foto) dan filter tanggal.
5. **Sertifikat**: Pengajuan e-sertifikat magang yang butuh validasi mentor industri.
6. **Chat Siswa**: Daftar kontak siswa bimbingan dengan *badge unread*, obrolan real-time, dan kirim lampiran.

---

## 2. Endpoint Autentikasi (Login)

### `POST /api/login`
Mentor login menggunakan email dan password akun pembimbing lapangan.

#### Request Headers:
```http
Accept: application/json
Content-Type: application/json
```

#### Request Body:
```json
{
  "email": "pembimbinglapangan@gmail.com",
  "password": "password123"
}
```

#### Response Sukses (HTTP 200 OK):
```json
{
  "status": "success",
  "message": "Login berhasil!",
  "data": {
    "token": "21|Kj98x...sanctum_token...",
    "user": {
      "id": 75,
      "name": "Budi Santoso, S.Kom (Mentor Industri)",
      "email": "pembimbinglapangan@gmail.com",
      "role": "pembimbing_lapangan",
      "nim": null,
      "no_telp": "081234567890",
      "anak": null,
      "pembimbing_lapangan": {
        "perusahaan": "PT. Media Balai Nusa",
        "divisi": "Divisi Software Engineering PT Media Balai Nusa",
        "total_siswa": 1,
        "pending_counts": {
          "laporan": 1,
          "izin": 0,
          "sertifikat": 0,
          "unread_chats": 1
        }
      }
    }
  }
}
```

---

## 3. Daftar Endpoint Lengkap untuk Aplikasi Mobile

Semua endpoint berikut memerlukan token otorisasi:
```http
Authorization: Bearer <SANCTUM_TOKEN>
Accept: application/json
```

---

### A. Dashboard & Data Siswa

#### 1. Ringkasan Dashboard
* **Endpoint**: `GET /api/pembimbing-lapangan/dashboard`
* **Response**:
```json
{
  "status": "success",
  "data": {
    "total_siswa": 1,
    "pending_laporan": 2,
    "pending_izin": 1,
    "pengajuan_sertifikat": 1,
    "unread_chats": 3,
    "hadir_hari_ini": 1
  }
}
```

#### 2. Daftar Siswa Bimbingan
* **Endpoint**: `GET /api/pembimbing-lapangan/siswa`
* **Response**:
```json
{
  "status": "success",
  "data": [
    {
      "id": 73,
      "name": "fikri firdaus",
      "email": "fikrifirdaus753@gmail.com",
      "nim": "6404230042",
      "no_telp": "089531558273",
      "asal_sekolah": "politeknik negri bengkalis",
      "jurusan": "Teknik Informatika",
      "kehadiran_hari_ini": {
        "status": "Hadir",
        "jam_masuk": "08:00:00",
        "jam_keluar": "17:00:00"
      },
      "laporan_terakhir": {
        "id": 10,
        "tanggal": "2026-11-06",
        "kegiatan": "Melakukan testing modul API mobile pembimbing lapangan",
        "status": "pending"
      }
    }
  ]
}
```

---

### B. Modul ACC Izin & Sakit

#### 1. Daftar Pengajuan Izin Siswa
* **Endpoint**: `GET /api/pembimbing-lapangan/izin`
* **Response**:
```json
{
  "status": "success",
  "data": [
    {
      "id": 15,
      "id_users": 73,
      "tgl_absen": "2026-11-07",
      "status": "Izin",
      "keterangan": "Izin ada urusan keluarga di kampung",
      "foto_bukti": "surat_izin_123.jpg",
      "status_validasi": "pending",
      "user": {
        "id": 73,
        "name": "fikri firdaus",
        "email": "fikrifirdaus753@gmail.com"
      }
    }
  ]
}
```

#### 2. Setujui (ACC) Izin
* **Endpoint**: `POST /api/pembimbing-lapangan/izin/{id}/approve`
* **Response**:
```json
{
  "status": "success",
  "message": "Izin berhasil disetujui (ACC)."
}
```

#### 3. Tolak Izin
* **Endpoint**: `POST /api/pembimbing-lapangan/izin/{id}/reject`
* **Body Form / JSON**:
```json
{
  "alasan": "Surat keterangan izin tidak dilampirkan."
}
```
* **Response**:
```json
{
  "status": "success",
  "message": "Izin berhasil ditolak."
}
```

---

### C. Modul Data Laporan Harian

#### 1. Daftar Laporan Kegiatan Siswa
* **Endpoint**: `GET /api/pembimbing-lapangan/laporan`
* **Response**:
```json
{
  "status": "success",
  "data": [
    {
      "id": 12,
      "user_id": 73,
      "tanggal": "2026-11-06",
      "kegiatan": "Mendesain antarmuka mobile Flutter untuk modul presensi QR dan chat",
      "foto": "uploads/laporan/123_foto.jpg",
      "catatan": null,
      "status": "pending",
      "user": {
        "id": 73,
        "name": "fikri firdaus"
      }
    }
  ]
}
```

#### 2. Setujui (ACC) Laporan
* **Endpoint**: `POST /api/pembimbing-lapangan/laporan/{id}/approve`
* **Body (Opsional)**:
```json
{
  "catatan": "Bagus, lanjutkan penyelesaian fitur."
}
```
* **Response**:
```json
{
  "status": "success",
  "message": "Laporan harian berhasil di-ACC."
}
```

#### 3. Tolak Laporan (Minta Revisi)
* **Endpoint**: `POST /api/pembimbing-lapangan/laporan/{id}/reject`
* **Body (Wajib)**:
```json
{
  "catatan": "Foto dokumentasi kegiatan belum jelas, tolong perbaiki."
}
```
* **Response**:
```json
{
  "status": "success",
  "message": "Laporan harian ditolak untuk revisi."
}
```

---

### D. Modul Absensi Siswa

#### 1. Monitoring Absensi Harian (Bisa Filter Tanggal)
* **Endpoint**: `GET /api/pembimbing-lapangan/absensi?tanggal=2026-11-06`
* **Response**:
```json
{
  "status": "success",
  "date": "2026-11-06",
  "data": [
    {
      "id": 44,
      "id_users": 73,
      "tgl_absen": "2026-11-06",
      "jam_masuk": "07:55:00",
      "jam_keluar": "17:05:00",
      "status": "Hadir",
      "foto_bukti": "masuk_73.jpg",
      "foto_keluar": "pulang_73.jpg",
      "lokasi_masuk": "-1.4827, 102.1284",
      "lokasi_keluar": "-1.4827, 102.1284",
      "user": {
        "id": 73,
        "name": "fikri firdaus"
      }
    }
  ]
}
```

#### 2. Riwayat Lengkap Absensi Satu Siswa
* **Endpoint**: `GET /api/pembimbing-lapangan/absensi/siswa/{siswa_id}`
* **Response**:
```json
{
  "status": "success",
  "data": [ ... ]
}
```

---

### E. Modul Pengajuan Sertifikat

#### 1. Daftar Pengajuan Sertifikat Siswa
* **Endpoint**: `GET /api/pembimbing-lapangan/sertifikat`
* **Response**:
```json
{
  "status": "success",
  "data": [
    {
      "id": 3,
      "nama_sertifikat": "Sertifikat Selesai Magang Periode Ganjil 2026",
      "file_path": "sertifikat_fikri.pdf",
      "created_by": 73,
      "status_pengajuan": "pending",
      "user": {
        "id": 73,
        "name": "fikri firdaus"
      }
    }
  ]
}
```

#### 2. Setujui (ACC) Pengajuan Sertifikat
* **Endpoint**: `POST /api/pembimbing-lapangan/sertifikat/{id}/approve`
* **Response**:
```json
{
  "status": "success",
  "message": "Pengajuan sertifikat disetujui (ACC)."
}
```

#### 3. Tolak Pengajuan Sertifikat
* **Endpoint**: `POST /api/pembimbing-lapangan/sertifikat/{id}/reject`
* **Response**:
```json
{
  "status": "success",
  "message": "Pengajuan sertifikat ditolak."
}
```

---

### F. Modul Chat Langsung (Mentor & Siswa)

#### 1. Daftar Kontak Chat Siswa (Dengan Unread Badge)
* **Endpoint**: `GET /api/pembimbing-lapangan/chat-contacts`
* **Response**:
```json
{
  "status": "success",
  "data": [
    {
      "id": 73,
      "name": "fikri firdaus",
      "email": "fikrifirdaus753@gmail.com",
      "no_telp": "089531558273",
      "asal_sekolah": "politeknik negri bengkalis",
      "jurusan": "Teknik Informatika",
      "unread_count": 2,
      "last_message": {
        "id": 1,
        "is_mine": false,
        "message": "Pak, apakah laporan hari ini sudah bisa saya ajukan?",
        "time": "14:20",
        "date": "2026-11-06"
      }
    }
  ]
}
```

#### 2. Ambil Riwayat Chat dengan Siswa Tertentu
* **Endpoint**: `GET /api/pembimbing-lapangan/chat/{siswa_id}`
* *Pesan otomatis ditandai terbaca (`is_read = true`).*
* **Response**:
```json
{
  "status": "success",
  "current_user_id": 75,
  "data": [
    {
      "id": 1,
      "is_mine": false,
      "message": "Selamat pagi Pak Budi.",
      "attachment": null,
      "time": "08:15",
      "date": "2026-11-06"
    },
    {
      "id": 2,
      "is_mine": true,
      "message": "Pagi, silakan lanjutkan tugas modul presensi ya.",
      "attachment": null,
      "time": "08:18",
      "date": "2026-11-06"
    }
  ]
}
```

#### 3. Kirim Pesan / Lampiran ke Siswa
* **Endpoint**: `POST /api/pembimbing-lapangan/chat/send`
* **Content-Type**: `multipart/form-data`
* **Form Data**:
  - `receiver_id`: `73` (ID siswa penerima)
  - `message`: `Tolong revisi dokumen laporan bab 3 ya.` (Teks pesan)
  - `attachment`: `[File gambar/pdf opsional]`
* **Response**:
```json
{
  "status": "success",
  "data": {
    "id": 3,
    "is_mine": true,
    "message": "Tolong revisi dokumen laporan bab 3 ya.",
    "attachment": null,
    "time": "15:35"
  }
}
```

---

## 4. Contoh Implementasi di Flutter (Dart)

```dart
// Model Login Response
class LoginResponse {
  final String status;
  final String token;
  final String role;
  final int userId;
  final String userName;
  final Map<String, dynamic>? pembimbingLapangan;

  LoginResponse.fromJson(Map<String, dynamic> json)
      : status = json['status'],
        token = json['data']['token'],
        role = json['data']['user']['role'],
        userId = json['data']['user']['id'],
        userName = json['data']['user']['name'],
        pembimbingLapangan = json['data']['user']['pembimbing_lapangan'];
}

// Navigasi Berdasarkan Role
void handlePostLogin(LoginResponse res, BuildContext context) {
  if (res.role == 'pembimbing_lapangan') {
    Navigator.pushReplacement(
      context,
      MaterialPageRoute(builder: (_) => PembimbingLapanganMainScreen(token: res.token)),
    );
  } else if (res.role == 'orang_tua') {
    Navigator.pushReplacement(
      context,
      MaterialPageRoute(builder: (_) => OrangTuaMainScreen(token: res.token)),
    );
  } else {
    Navigator.pushReplacement(
      context,
      MaterialPageRoute(builder: (_) => SiswaMagangMainScreen(token: res.token)),
    );
  }
}
```
