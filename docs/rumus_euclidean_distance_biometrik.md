# 📐 Dokumentasi Implementasi Sistem Keamanan Biometrik Ganda: Liveness Detection (EAR) & Face Recognition (Euclidean Distance)

Dokumen ini mencatat secara lengkap penerapan matematis dan teknis dari sistem autentikasi biometrik wajah pada proyek magang PT. Media Balai Nusa, yang menggabungkan dua metode pengujian ilmiah:
1. **Liveness Detection (Anti-Spoofing)** menggunakan algoritma **Eye Aspect Ratio (EAR)** untuk mendeteksi kedipan mata manusia asli (mencegah manipulasi foto cetak / layar HP).
2. **Face Recognition (Pencocokan Identitas Wajah)** menggunakan algoritma **Euclidean Distance ($\le 0{,}60$)** sesuai **Tabel 2.3**.

---

## 1. 👁️ METODE 1: Liveness Detection (Eye Aspect Ratio / EAR)

### A. Konsep & Rumus Matematis (Subbab 2.2.9)
Liveness Detection merupakan proses yang digunakan untuk memastikan bahwa wajah yang terdeteksi berasal dari pengguna yang berada secara langsung di depan kamera dan bukan berasal dari representasi wajah seperti foto atau video. Teknologi face recognition memiliki kerentanan terhadap serangan *spoofing* karena pengguna yang tidak berwenang dapat mencoba menggunakan representasi wajah untuk melewati proses autentikasi. Liveness Detection digunakan sebagai pemeriksaan tambahan untuk memastikan keberadaan pengguna secara nyata. Pada penelitian ini digunakan deteksi kedipan mata berdasarkan Eye Aspect Ratio (EAR) yang dihitung dari titik facial landmarks mata.

Rumus Eye Aspect Ratio (EAR):

$$EAR = \frac{(P_2 - P_6) + (P_3 - P_5)}{2(P_1 - P_4)}$$

**Keterangan:**
- $P_1$ dan $P_4$ = titik *landmark* horizontal mata (sudut luar dan sudut dalam).
- $P_2$ dan $P_6$ = titik *landmark* vertikal pertama (kelopak atas dan bawah).
- $P_3$ dan $P_5$ = titik *landmark* vertikal kedua (kelopak atas dan bawah).
- $EAR$ = nilai rasio aspek mata.

---

### B. Tabel 2.4 Interpretasi Nilai EAR pada Liveness Detection

| Nilai EAR | Interpretasi | Status di Sistem | Respon Sistem |
| :--- | :--- | :--- | :--- |
| **$EAR > 0{,}20$** | **Mata terbuka** | Menunggu kedipan / Siklus selesai | Sistem menunggu pengguna mengedipkan mata; jika kedip selesai, liveness terverifikasi. |
| **$EAR \le 0{,}20$** | **Mata tertutup / kedipan terdeteksi** | Kedipan terdeteksi | Sistem merekam bahwa kelopak mata telah menutup, meminta membuka mata kembali. |

> **Catatan Ilmiah Jurnal:**  
> Nilai EAR menurun ketika mata menutup dan kembali naik ketika mata terbuka. Penelitian terdahulu menggunakan *threshold* EAR sebesar $0{,}20$. Penelitian ini menggunakan nilai tersebut sebagai nilai acuan validasi sistem ($EAR \le 0{,}20$ untuk mata tertutup, dan $EAR > 0{,}20$ untuk mata terbuka). Siklus kedip alami dinyatakan valid jika berlangsung dalam rentang durasi 80 ms hingga 3.000 ms.

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
