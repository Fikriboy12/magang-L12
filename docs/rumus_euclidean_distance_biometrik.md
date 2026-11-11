# 📐 Dokumentasi Implementasi Sistem Keamanan Biometrik Ganda: Liveness Detection (EAR) & Face Recognition (Euclidean Distance)

Dokumen ini mencatat secara lengkap penerapan matematis dan teknis dari sistem autentikasi biometrik wajah pada proyek magang PT. Media Balai Nusa, yang menggabungkan dua metode pengujian ilmiah:
1. **Liveness Detection (Anti-Spoofing)** menggunakan algoritma **Eye Aspect Ratio (EAR)** untuk mendeteksi kedipan mata manusia asli (mencegah manipulasi foto cetak / layar HP).
2. **Face Recognition (Pencocokan Identitas Wajah)** menggunakan algoritma **Euclidean Distance ($\le 0{,}60$)** sesuai **Tabel 2.3**.

---

## 1. 👁️ METODE 1: Liveness Detection (Eye Aspect Ratio / EAR)

### A. Konsep & Rumus Matematis
Untuk memastikan bahwa objek di depan kamera adalah manusia hidup (bukan foto 2D), sistem menghitung rasio bukaan kelopak mata (*Eye Aspect Ratio / EAR*) dari 6 titik landmark mata (titik 36–41 untuk mata kiri, titik 42–47 untuk mata kanan):

$$EAR = \frac{||p_2 - p_6|| + ||p_3 - p_5||}{2 \cdot ||p_1 - p_4||}$$

- $p_1, p_4$ : Titik sudut luar dan sudut dalam mata (jarak horizontal).
- $p_2, p_6$ : Titik kelopak mata atas dan bawah bagian luar (jarak vertikal 1).
- $p_3, p_5$ : Titik kelopak mata atas dan bawah bagian dalam (jarak vertikal 2).
- $||\dots||$ : Jarak Euclidean 2D antar koordinat titik piksel.

### B. Tabel Interpretasi Nilai EAR (Deteksi Kedipan)

| Kondisi Mata | Nilai Rata-rata EAR | Status Liveness | Respon Sistem |
| :--- | :--- | :--- | :--- |
| **Mata Terbuka Normal** | $EAR \ge 0{,}26$ | Menunggu kedipan | Sistem meminta user mengedipkan mata. |
| **Mata Menutup (Berkedip)** | $EAR < 0{,}22$ | Kedipan berlangsung | Kelopak mata menutup tercatat dalam siklus kedip. |
| **Mata Terbuka Kembali** | $EAR \ge 0{,}26$ | **Liveness VALID (Manusia Asli)** | Siklus kedip lengkap terverifikasi, ekstraksi wajah disetujui. |
| **Foto Mati / Layar HP** | $EAR$ konstan ($\approx 0{,}30$) | **GAGAL / DITOLAK** | Tidak ada siklus kedip, sistem tidak akan pernah submit login. |

---

## 2. 🧮 METODE 2: Face Recognition (Euclidean Distance $\le 0{,}60$)

### A. Tabel 2.3 Interpretasi Nilai Euclidean Distance

| Nilai Distance ($d$) | Interpretasi | Status di Sistem | Tindakan Sistem |
| :--- | :--- | :--- | :--- |
| **$d \le 0{,}60$ (Threshold)** | Wajah cocok (*Match*) | **Valid** | Login berhasil, sesi autentikasi dibuat, redirect ke dashboard sesuai role. |
| **$d > 0{,}60$ (Threshold)** | Wajah tidak cocok (*No Match*) | **Invalid** | Login ditolak, muncul notifikasi skor ketidakmiripan melebihi batas 0.60. |

### B. Rumus Matematis Euclidean Distance
Pencocokan wajah dilakukan dengan menghitung jarak Euclidean antara dua vektor fitur wajah 128 dimensi:

$$d(p, q) = \sqrt{\sum_{i=1}^{128} (p_i - q_i)^2}$$

- **$d(p, q)$** : Nilai ketidakmiripan antara dua wajah (semakin kecil mendekati 0, semakin identik).
- **$p_i$** : Vektor fitur wajah tersimpan di database (*Stored Descriptor*).
- **$q_i$** : Vektor fitur wajah langsung dari kamera (*Live Descriptor* setelah lolos liveness).
- **$128$** : Jumlah dimensi unik wajah yang diekstraksi oleh AI.

---

## 3. 📂 Letak Kode dalam Sistem

### A. Frontend: Perhitungan EAR & Deteksi Kedip Mata
- **File:** `resources/views/auth/login.blade.php` (Baris 350 – 480)
- **Fungsi:** `calculateEyeEAR(eye)` dan mesin status siklus kedip (*open $\rightarrow$ closed $\rightarrow$ open*).
- **UI:** Menampilkan badge real-time status Anti-Spoofing dan nilai `EAR: 0.xx`.

### B. Backend: Perhitungan Euclidean Distance & Validasi $\le 0{,}60$
- **File:** `app/Http/Controllers/Auth/LoginController.php` (Baris 125 – 168)
- **Fungsi:** `loginBiometric(Request $request)`
- Melakukan verifikasi keamanan ganda dan mencatat status `liveness_verified: true` pada log audit Laravel.

### C. Basis Data: Penyimpanan Vektor Wajah 128 Dimensi
- **File:** `app/Http/Controllers/Auth/RegisterController.php` (Baris 105)
- Menyimpan 128 titik data float ke kolom `face_descriptor` pada tabel `users`.

---

## 4. 💡 Pertanyaan Penguji / Dosen Sidang (FAQ Sidang)

1. **Bagaimana sistem Anda memastikan bahwa yang login bukan foto cetak atau foto di HP?**  
   *Jawaban:* Sistem kami menerapkan **Liveness Detection berbasis Eye Aspect Ratio (EAR)**. Sebelum wajah dicocokkan, sistem mewajibkan verifikasi kedipan mata alami manusia. Foto 2D (kertas maupun layar HP) memiliki nilai EAR yang statis dan tidak dapat melakukan siklus menutup-membuka kelopak mata, sehingga manipulasi foto 100% tertolak.

2. **Kenapa menggunakan kombinasi EAR + Euclidean Distance?**  
   *Jawaban:* EAR bertanggung jawab sebagai lapis keamanan pertama (*Liveness / Anti-Spoofing*) di sisi klien untuk memastikan subjek adalah manusia hidup. Sedangkan Euclidean Distance bertanggung jawab sebagai lapis keamanan kedua (*Identity Verification*) di sisi server untuk mencocokkan apakah wajah tersebut memang milik akun yang bersangkutan dengan batas toleransi $\le 0{,}60$.
