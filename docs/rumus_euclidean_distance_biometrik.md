# 📐 Dokumentasi Implementasi Rumus Euclidean Distance & Threshold Biometrik Wajah

Dokumen ini mencatat secara lengkap penerapan matematis dan teknis dari **Tabel 2.3 (Interpretasi Euclidean Distance)** yang digunakan dalam sistem autentikasi biometrik pengenalan wajah pada proyek magang PT. Media Balai Nusa.

---

## 1. 📊 Tabel Interpretasi Nilai Euclidean Distance (Tabel 2.3)

| Nilai Distance ($d$) | Interpretasi | Status di Sistem | Tindakan Sistem |
| :--- | :--- | :--- | :--- |
| **$d \le 0{,}60$ (Threshold)** | Wajah cocok (*Match*) | **Valid** | Login berhasil, sesi autentikasi dibuat, redirect ke dashboard sesuai role. |
| **$d > 0{,}60$ (Threshold)** | Wajah tidak cocok (*No Match*) | **Invalid** | Login ditolak, muncul notifikasi skor ketidakmiripan melebihi batas 0.60. |

> **Catatan Akademis:**  
> Nilai acuan $0{,}60$ adalah standar baku industri untuk model *Face Recognition 128-d Net* (arsitektur ResNet-34 yang dilatih dengan dataset LFW / Labeled Faces in the Wild), yang memberikan akurasi pembeda wajah optimal dengan False Acceptance Rate (FAR) yang sangat rendah.

---

## 2. 🧮 Rumus Matematis Euclidean Distance

Pencocokan wajah dilakukan dengan menghitung jarak Euclidean (*Euclidean Distance*) antara dua vektor fitur wajah 128 dimensi:

$$d(p, q) = \sqrt{\sum_{i=1}^{128} (p_i - q_i)^2}$$

### Penjelasan Variabel:
- **$d(p, q)$** : Nilai *Euclidean Distance* (tingkat ketidakmiripan antara dua wajah). Semakin kecil nilainya mendekati 0, semakin identik kedua wajah tersebut.
- **$p_i$** : Nilai elemen ke-$i$ dari vektor wajah yang tersimpan di basis data (*Stored Descriptor* saat registrasi).
- **$q_i$** : Nilai elemen ke-$i$ dari vektor wajah yang ditangkap langsung melalui kamera webcam saat login (*Live Descriptor*).
- **$128$** : Jumlah dimensi fitur unik wajah (jarak antar mata, hidung, bibir, kontur rahang, dll.) yang diekstraksi oleh sistem AI.

---

## 3. 📂 Letak Kode dalam Sistem

### A. Perhitungan Rumus & Validasi Threshold (Backend)
- **File:** `app/Http/Controllers/Auth/LoginController.php`
- **Metode:** `loginBiometric(Request $request)`
- **Baris:** 125 – 168

```php
// 1. Ekstraksi Vektor Fitur Wajah 128 Dimensi
$storedDescriptor = json_decode($user->face_descriptor, true);
$liveDescriptor = json_decode($request->face_descriptor, true);

// 2. Penerapan Rumus Matematis Euclidean Distance
$distance = 0;
for ($i = 0; $i < 128; $i++) {
    // Menghitung kuadrat selisih tiap dimensi: (pi - qi)^2
    $distance += pow($storedDescriptor[$i] - $liveDescriptor[$i], 2);
}
// Mengambil akar kuadrat dari total penjumlahan: sqrt(...)
$distance = sqrt($distance);

// 3. Penerapan Tabel 2.3: Validasi Threshold <= 0.60
if ($distance <= 0.60) {
    // Wajah cocok (Match)!
    Auth::login($user);
    $request->session()->regenerate();
    
    $pesan = 'Berhasil Login dengan Wajah! Selamat datang ' . $user->name . ' (Skor: ' . round($distance, 4) . ')';
    
    // Redirect sesuai Role (Pembimbing, Siswa, Orang Tua, dll.)
    return redirect()->route('home.auth')->with('success', $pesan);
} else {
    // Wajah tidak cocok (No Match)!
    return back()->with('error', 'Wajah tidak cocok! (Skor Ketidakmiripan: ' . round($distance, 4) . '). Nilai harus <= 0.60');
}
```

---

### B. Visualisasi Deteksi & Threshold Kamera (Frontend)
- **File:** `resources/views/auth/login.blade.php`
- **Baris:** 375 – 377

```javascript
// Menampilkan kotak deteksi wajah dengan label threshold 0.60 pada canvas kamera
const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, { label: '0.60' });
drawBox.draw(canvas);
faceapi.draw.drawFaceLandmarks(canvas, resizedDetection);
```

---

### C. Penyimpanan Vektor Wajah Pertama Kali (Registrasi)
- **File:** `app/Http/Controllers/Auth/RegisterController.php`
- **Baris:** 105

```php
// Menyimpan 128 titik data float wajah ke kolom face_descriptor tabel users
'face_descriptor' => $validated['face_descriptor'],
```

---

## 4. 💡 Pertanyaan Umum Penguji / Dosen Sidang (FAQ Sidang)

1. **Kenapa menggunakan Euclidean Distance, bukan Manhattan atau Cosine?**  
   *Jawaban:* Euclidean Distance mengukur jarak geometris terpendek (*garis lurus*) dalam ruang berdimensi 128 ($L_2$ norm), yang paling efektif membedakan pola penyebaran titik landmark wajah manusia dalam representasi embedding mendalam (*deep metric learning*).

2. **Kenapa nilai threshold dipilih 0,60?**  
   *Jawaban:* Nilai threshold $0{,}60$ merupakan *sweet spot* yang direkomendasikan oleh pembuat pustaka Face-API / Dlib. Jika threshold terlalu rendah (misal $< 0{,}40$), sistem akan menolak orang yang sama hanya karena perbedaan pencahayaan (False Rejection). Sebaliknya jika terlalu tinggi (misal $> 0{,}70$), orang yang berwajah mirip bisa salah dikenali sebagai pemilik akun (False Acceptance). Nilai $0{,}60$ memberikan keseimbangan akurasi tertinggi.
