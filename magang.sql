-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2026 at 09:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magang`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensis`
--

CREATE TABLE `absensis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_users` bigint(20) UNSIGNED NOT NULL,
  `tgl_absen` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Hadir',
  `foto_bukti` varchar(255) DEFAULT NULL,
  `foto_keluar` varchar(255) DEFAULT NULL,
  `lokasi_masuk` varchar(255) DEFAULT NULL,
  `lokasi_keluar` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status_validasi` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensis`
--

INSERT INTO `absensis` (`id`, `id_users`, `tgl_absen`, `jam_masuk`, `jam_keluar`, `status`, `foto_bukti`, `foto_keluar`, `lokasi_masuk`, `lokasi_keluar`, `keterangan`, `status_validasi`, `created_at`, `updated_at`) VALUES
(2, 73, '2026-07-09', '21:20:28', '21:20:42', 'Hadir', 'uploads/absensi/1783606828_masuk_upload.jpg', 'uploads/absensi/1783606842_pulang_upload.jpg', NULL, NULL, 'hadir', 'pending', '2026-07-09 07:20:28', '2026-07-09 07:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `alur`
--

CREATE TABLE `alur` (
  `id_alur` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar_alur` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `alur`
--

INSERT INTO `alur` (`id_alur`, `judul`, `deskripsi`, `gambar_alur`, `created_at`, `updated_at`) VALUES
(1, 'Registerasi', 'Sebelum Melakukan Pendaftaran silahkan Lakukan Registerasi Akun Terlebih Dahulu Supaya Memiliki Akun', 'alur-26012022da48f06eb9.png', '2025-11-26 12:46:18', '2025-11-26 12:46:18'),
(2, 'Lengkapi Berkas', 'Setelah Melengkapi Berkas Silahkan Untuk Melengkapi Berkas Yang Ada Supaya Dapat Melanjutkan Ke Proses Selanjutnya', 'alur-2601202268e28289f3.png', '2023-10-01 06:07:46', NULL),
(3, 'Lengkapi berkas', 'Setelah Melengkapi Biodata Silahkan Untuk Melakukan Proses Melengkapi Berkas Yang Ada Untuk Dapat Melanjutkan Proses Pnedaftaran Yang Ada', 'alur-260120220846cd95ad.png', '2023-10-01 06:07:46', NULL),
(4, 'Daftar Perusahaan', 'Setelah Berkas Lengkap Silahkan Melakuka Pendaftaran dan Pilih Jurusan Yang Anda Minati, Terdapat Berbagai Jurusan Yang Dapat Anda Pilih', 'alur-26012022ae6d25274d.png', '2023-10-03 13:22:30', '2023-10-03 13:22:30'),
(5, 'Menunggu Hasil', 'Setelah Mendaftar, Tunggu Hasil dan Cek Secara Berkala Pada Menu Daftar Berkas Yang Ada Pada Sub Menu Profil', 'alur-260120227dc482823b.png', '2023-10-01 06:07:46', NULL),
(6, 'Selesai', 'Semua Proses Wajib Di Ikuti Secara Urut Untuk Dapat Mendaftar Pada Sekolahan Kami, Terimakasih dan Semoga Diterima', 'alur-260120228d907c820f.png', '2023-10-01 06:07:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_reports`
--

CREATE TABLE `daily_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pendaftaran_id` bigint(20) UNSIGNED NOT NULL,
  `report_date` date NOT NULL,
  `activity_description` text NOT NULL,
  `activity_photo` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `supervisor_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_users`
--

CREATE TABLE `detail_users` (
  `id_detail_users` int(11) NOT NULL,
  `nim` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `agama` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `id_users` int(11) NOT NULL,
  `alamat_lengkap` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_users`
--

INSERT INTO `detail_users` (`id_detail_users`, `nim`, `nik`, `jenis_kelamin`, `agama`, `tanggal_lahir`, `tempat_lahir`, `id_users`, `alamat_lengkap`, `nama_lengkap`, `created_at`, `updated_at`) VALUES
(3, '3232', '324234', 'laki-laki', 'Islam', '2023-10-03', 'dffdg', 5, 'ewrewr', 'ewrfewr', '2023-10-02 08:38:45', NULL),
(4, '640423001', '4734924567', 'laki-laki', 'Islam', '2023-10-03', 'Bengkalis', 3, 'Sungai Alam', 'Fikri', '2025-10-15 16:26:32', '2025-10-15 23:26:32'),
(5, '6404230042', '123753865', 'laki-laki', 'Islam', '2025-10-06', 'Lukit', 7, 'Fikri Firdaus', 'Fikri Firdaus', '2025-10-15 16:21:47', NULL),
(6, '6404230042', '4734924567', 'laki-laki', 'Islam', '2025-10-06', 'Lukit', 8, 'Desa Lukit, Kepulauan Meranti, riau', 'Fikri Firdaus', '2025-10-25 17:16:12', NULL),
(7, '6404230042', '4734924567', 'laki-laki', 'Islam', '2025-10-06', 'Lukit', 10, 'Desa Lukit, Kepulauan Meranti, riau', 'Fikri Firdaus', '2025-10-26 04:36:06', NULL),
(8, '6404230042', '4734924567', 'laki-laki', 'Islam', '2025-10-06', 'Lukit', 12, 'Desa Lukit, Kepulauan Meranti, riau', 'Fikri Firdaus', '2025-10-26 04:43:52', NULL),
(9, '6404230042', '4734924567', 'laki-laki', 'Islam', '2025-10-06', 'Lukit', 13, 'Desa Lukit, Kepulauan Meranti, riau', 'Fikri', '2025-10-26 04:45:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `galeri_gambar` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `galeri_gambar`, `created_at`, `updated_at`) VALUES
(31, '1764858628_WhatsApp Image 2025-12-04 at 08.58.42_93704fe5.jpg', '2025-12-04 07:30:28', NULL),
(32, '1764858646_WhatsApp Image 2025-12-04 at 08.57.17_cbdfecbf.jpg', '2025-12-04 07:30:46', NULL),
(33, '1764858660_WhatsApp Image 2025-12-04 at 09.13.41_13a5cf72.jpg', '2025-12-04 07:31:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id_informasi` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `gambar_informasi` varchar(200) NOT NULL,
  `tgl_informasi` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id_informasi`, `judul`, `deskripsi`, `penulis`, `gambar_informasi`, `tgl_informasi`, `created_at`, `updated_at`) VALUES
(5, 'Pelaksanaan Magang Siswa SMKN 1 Merbau di PT Media Balai Nusa', 'PT Media Balai Nusa (STRONET.ID) secara resmi menerima siswa dari SMKN 1 Merbau untuk melaksanakan program Praktik Kerja Lapangan (PKL) selama 6 bulan, sebagai bentuk nyata dukungan perusahaan terhadap peningkatan kompetensi putra daerah di industri telekomunikasi. Selama masa magang ini, para siswa terlibat langsung dalam berbagai kegiatan teknis di lapangan, mulai dari instalasi jaringan WiFi, penarikan kabel fiber optic, hingga proses troubleshooting dan pemeliharaan infrastruktur jaringan demi menjamin kualitas layanan internet yang stabil bagi pelanggan. Melalui pengalaman kerja nyata ini, diharapkan para siswa dapat menguasai keahlian teknis secara mendalam sekaligus membentuk etos kerja yang profesional sebelum terjun sepenuhnya ke dunia industri teknologi informasi.', 'Fikri', '1764850268_banner1.jpg', '2025-08-18', '2025-12-17 03:29:36', '2025-12-17 03:29:36'),
(6, 'Kunjungan Industri SMK Telekomunikasi Tunas Harapan ke PT Media Balai Nusa', 'PT Media Balai Nusa (STRONET.ID) menerima kunjungan industri dari para siswa Program Keahlian Rekayasa Perangkat Lunak (RPL) SMK Telekomunikasi Tunas Harapan sebagai bagian dari upaya menyelaraskan kurikulum pendidikan dengan kebutuhan nyata di dunia industri. Dalam kegiatan ini, para siswa diajak untuk melihat langsung alur kerja profesional di balik layar perusahaan penyedia layanan internet, mulai dari pengelolaan infrastruktur jaringan hingga pengembangan perangkat lunak yang mendukung operasional telekomunikasi. Melalui interaksi langsung dengan para praktisi, kunjungan ini diharapkan dapat membuka wawasan para siswa mengenai peluang karier di bidang IT serta memotivasi mereka untuk terus mengasah keterampilan teknis agar siap bersaing dalam ekosistem ekonomi digital di masa depan.', 'Fikri', '1765942329_kunjungan-industri.jpeg', '2024-02-20', '2025-12-16 20:32:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_harians`
--

CREATE TABLE `laporan_harians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `kegiatan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_harians`
--

INSERT INTO `laporan_harians` (`id`, `user_id`, `tanggal`, `kegiatan`, `foto`, `catatan`, `created_at`, `updated_at`, `status`) VALUES
(22, 73, '2026-07-09', 'perbaiki kabel lan', 'laporan_harian/1783606798_upload.jpg', NULL, '2026-07-09 07:19:58', '2026-07-09 07:21:57', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2025_10_15_200531_create_detail_users_table', 1),
(10, '2025_10_15_200842_create_pendaftaran_table', 1),
(11, '2025_10_26_000645_create_sertifikat_table', 2),
(12, '2025_10_26_153419_add_status_pengajuan_to_sertifikat_table', 3),
(13, '2025_10_26_160650_add_sertifikat_to_pendaftaran_table', 4),
(14, '2025_10_29_180357_add_profile_fields_to_users_table', 5),
(15, '0001_01_01_000001_create_cache_table', 6),
(16, '0001_01_01_000002_create_jobs_table', 7),
(18, '2025_11_16_072419_add_role_to_users_table', 9),
(19, '2025_11_18_023749_add_role_and_pembimbing_to_users_table', 10),
(21, '2025_11_18_023834_create_laporan_harians_table', 11),
(22, '2025_11_12_140838_create_sessions_table', 12),
(23, '2025_11_26_075251_create_sessions_table', 13),
(24, '2025_12_22_120154_create_personal_access_tokens_table', 14),
(25, '2026_01_03_134216_create_absensis_table', 14),
(26, '2026_06_06_024221_add_siswa_and_wali_columns_to_users_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `ktp` varchar(255) NOT NULL,
  `universitas` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `prodi` varchar(255) DEFAULT NULL,
  `surat_rekomendasi` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `proposal` varchar(255) DEFAULT NULL,
  `sertifikat` varchar(255) DEFAULT NULL,
  `id_users` bigint(20) UNSIGNED NOT NULL,
  `dari_tanggal` varchar(255) NOT NULL,
  `sampai_tanggal` varchar(255) NOT NULL,
  `status_pendaftaran` varchar(200) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `gambar`, `ktp`, `universitas`, `jurusan`, `prodi`, `surat_rekomendasi`, `cv`, `proposal`, `sertifikat`, `id_users`, `dari_tanggal`, `sampai_tanggal`, `status_pendaftaran`, `keterangan`, `created_at`, `updated_at`) VALUES
(33, '1783605573_foto.jpg', '1783605573_KTP.jpg', 'politeknik negri bengkalis', 'teknik informatika', 'keamanan sistem informasi', '1783605573_Surat.pdf', '1783605573_CV.pdf', '1783605573_Proposal.pdf', NULL, 73, '2026-07-09', '2026-07-09', 'diterima', NULL, '2026-07-09 14:00:43', '2026-07-09 14:00:43');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(20, 'App\\Models\\User', 72, 'mobile_token', 'b46d94ee9bfe0b24be3296eaae8b43b0c267d7513ad572fd05fb26bf853776bd', '[\"*\"]', '2026-07-09 03:15:34', NULL, '2026-07-09 03:15:04', '2026-07-09 03:15:34'),
(24, 'App\\Models\\User', 31, 'mobile_token', 'ca08717b4541c226ceeea20a740b4c2564492226a79695f363455b473c03324c', '[\"*\"]', '2026-07-09 07:22:21', NULL, '2026-07-09 07:21:33', '2026-07-09 07:22:21'),
(25, 'App\\Models\\User', 73, 'mobile_token', '091f850468d86666cc989923c261cdfcc7e228b4f4fff5a30c9d555e9e63a0aa', '[\"*\"]', '2026-07-09 07:22:37', NULL, '2026-07-09 07:22:35', '2026-07-09 07:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `id_users` int(11) NOT NULL,
  `gambar_perusahaan` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id_perusahaan`, `nama_perusahaan`, `deskripsi`, `visi`, `misi`, `no_hp`, `facebook`, `email`, `instagram`, `id_users`, `gambar_perusahaan`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'PT. MEDIA BALAN NUSA astro net', 'PT Media Balai Nusa adalah perusahaan teknologi penyedia layanan internet serat optik berkecepatan tinggi. Perusahaan ini berfokus pada pendekatan lokal untuk menyediakan konektivitas digital yang stabil dan handal, terutama di wilayah Tanjungbalai dan Bengkalis.', 'Menjadi penyedia internet terpercaya yang menghubungkan masyarakat ke masa depan digital, menjadi solusi infrastruktur telekomunikasi berakar kearifan lokal, dan badan assurance berkelas dunia.', 'Menyediakan akses internet berkualitas tinggi (cepat dan stabil) dengan harga terjangkau bagi seluruh lapisan masyarakat, mulai dari rumah tangga hingga sektor bisnis.', '+6283897813168', 'astronet.id', 'support@astronet.id', 'astronet.id', 1, '1765383595_logo.jpg', 'Jl. Letjend. Suprapto (Kawasan Titi Gantung), Kel. Beting Kuala Kapias, Kec. Teluk Nibung, Kota Tanjungbalai, Sumatera Utara 21335.', '2025-12-16 14:35:52', '2025-12-16 14:35:52');

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_sertifikat` varchar(255) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_pengajuan` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `nim` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `face_descriptor` text DEFAULT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `pembimbing_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `nama_wali` varchar(255) DEFAULT NULL,
  `email_wali` varchar(255) DEFAULT NULL,
  `no_hp_wali` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nama_lengkap`, `nim`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `email`, `email_verified_at`, `password`, `face_descriptor`, `otp_code`, `role`, `pembimbing_id`, `no_telp`, `nama_wali`, `email_wali`, `no_hp_wali`, `status`, `alamat_lengkap`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL, NULL, NULL, NULL, 'admin@gmail.com', NULL, '$2y$12$5FmB5sw80CfRuSqQCre5P.ZomE7NevtC6/r5knV66jcUIW9ttGcue', NULL, NULL, 'admin', NULL, '082268808430', NULL, NULL, NULL, '1', NULL, NULL, '2023-10-02 06:03:43', '2025-11-26 09:19:09'),
(31, 'pembimbing', NULL, '6404230042', 'Lukit', '2005-01-12', 'laki-laki', 'pembimbing@gmail.com', NULL, '$2y$12$RAxGkJGnrMnmu4nQuMXin.EYmfHFrLv47jHzrNuV8c0rvtItZ36qW', NULL, NULL, 'pembimbing', NULL, '082268808430', NULL, NULL, NULL, '1', 'Sungai Alam.', NULL, '2025-11-17 04:56:02', '2025-11-26 09:36:12'),
(57, 'pembimbing3', NULL, NULL, NULL, NULL, NULL, 'pembimbing3@gmail.com', NULL, '$2y$12$uZ8a25KwIIMmd73HuWeJiOmw3Qn5ZwoEf7AAzZ..x/EMpBL0lbzYK', NULL, NULL, 'pembimbing', NULL, '082235839180', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-28 04:04:58', '2025-11-28 04:04:58'),
(60, 'pembimbing2', NULL, NULL, NULL, NULL, NULL, 'pembimbing2@gmail.com', NULL, '$2y$12$zvVhLiGE1FCgsrxNoeroHei5salk4VpJlrObJ2vMeWcuot.ksKXZW', NULL, NULL, 'pembimbing', NULL, '082268808438', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-29 02:34:39', '2025-11-29 02:34:39'),
(63, 'Pembimbingpolbeng', NULL, NULL, NULL, NULL, NULL, 'Pembimbingpolbeng@gmail.com', NULL, '$2y$12$XdMgbyQIBtgSh9bK.yeGj.2NcIhEj2KurL4Upeh3V/gom7k.njt6a', NULL, NULL, 'pembimbing', NULL, '082268854934', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-06 00:26:55', '2025-12-06 00:26:55'),
(73, 'fikri firdaus', 'fikri firdaus', '6404230042', NULL, NULL, NULL, 'fikrifirdaus753@gmail.com', NULL, '$2y$12$dCe2mHH/bXUeGPwQNibQx.qo3JEYRiYwAfzR30wiScrsr2qvPutHC', '[-0.14857050776481628,0.046049583703279495,-0.02759403921663761,-0.03646306321024895,-0.037594422698020935,-0.016041580587625504,-0.015142411924898624,-0.10218397527933121,0.22939901053905487,-0.06261157244443893,0.2759316563606262,-0.019429238513112068,-0.1189301460981369,-0.19837108254432678,0.004060331732034683,0.15429116785526276,-0.17834261059761047,-0.15400178730487823,-0.033852219581604004,-0.04428119957447052,0.015812093392014503,-0.04709535092115402,0.0021362595725804567,0.06956188380718231,-0.05273613706231117,-0.3683660924434662,-0.06591594964265823,-0.17722970247268677,0.0967496931552887,-0.09443595260381699,-0.09152812510728836,0.03771244361996651,-0.2100236564874649,-0.1546967327594757,0.014647005125880241,0.14549162983894348,0.009330655448138714,-0.009019885212182999,0.17423878610134125,-0.032686252146959305,-0.156399667263031,-0.0008618278079666197,-0.019439982250332832,0.2440720796585083,0.16488853096961975,0.05493658408522606,0.01668577268719673,-0.07171639055013657,0.043740253895521164,-0.14607176184654236,0.05633443221449852,0.09649984538555145,0.13174697756767273,0.017110755667090416,0.004178379196673632,-0.15560297667980194,-0.02977415733039379,0.05981440842151642,-0.15743926167488098,0.01859813556075096,0.02424641139805317,-0.05871989578008652,-0.054804008454084396,-0.03348596394062042,0.27913060784339905,0.09960051625967026,-0.08747308701276779,-0.13147875666618347,0.1601579487323761,-0.08989004045724869,-0.02696363255381584,0.060664959251880646,-0.1113387793302536,-0.18848136067390442,-0.25172802805900574,0.0755566656589508,0.4789847135543823,0.08341458439826965,-0.2352280616760254,0.037382934242486954,-0.12654133141040802,-0.04614441096782684,0.11462706327438354,0.06721671670675278,-0.01093614473938942,0.03465314581990242,-0.10544022172689438,-0.0279874037951231,0.1723654866218567,0.010415368713438511,-0.05338747799396515,0.10294336080551147,-0.05152999982237816,0.07321750372648239,0.04738622158765793,0.01875261403620243,0.0023567478638142347,0.05089116469025612,-0.13087257742881775,-0.06509476900100708,0.042429618537425995,-0.045753538608551025,-0.017307469621300697,0.06666762381792068,-0.15843360126018524,0.08863947540521622,0.05389745533466339,-0.009621410630643368,0.008080542087554932,0.0347195565700531,-0.07144587486982346,-0.05174209550023079,0.1683189868927002,-0.26433491706848145,0.2383674532175064,0.19603343307971954,0.054835908114910126,0.2099306434392929,0.0695919394493103,0.07626105099916458,0.004008524585515261,-0.043859563767910004,-0.19112712144851685,-0.02621079422533512,0.052899137139320374,-0.0038070091977715492,0.11384603381156921,0.03713373839855194]', NULL, 'pelamar', 31, '082268808430', 'laila', 'laila123@gmail.com', '0822578658', 'diterima', NULL, NULL, '2026-07-09 06:57:54', '2026-07-09 07:18:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensis`
--
ALTER TABLE `absensis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alur`
--
ALTER TABLE `alur`
  ADD PRIMARY KEY (`id_alur`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `daily_reports`
--
ALTER TABLE `daily_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_users`
--
ALTER TABLE `detail_users`
  ADD PRIMARY KEY (`id_detail_users`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_harians`
--
ALTER TABLE `laporan_harians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_harian_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `pendaftaran_id_users_foreign` (`id_users`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id_perusahaan`),
  ADD KEY `kd_admin` (`id_users`);

--
-- Indexes for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sertifikat_created_by_foreign` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensis`
--
ALTER TABLE `absensis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `alur`
--
ALTER TABLE `alur`
  MODIFY `id_alur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `daily_reports`
--
ALTER TABLE `daily_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_users`
--
ALTER TABLE `detail_users`
  MODIFY `id_detail_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id_informasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_harians`
--
ALTER TABLE `laporan_harians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan_harians`
--
ALTER TABLE `laporan_harians`
  ADD CONSTRAINT `laporan_harian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD CONSTRAINT `sertifikat_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
