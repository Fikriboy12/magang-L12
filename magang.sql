-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2026 at 07:09 AM
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
(2, 73, '2026-07-09', '21:20:28', '21:20:42', 'Hadir', 'uploads/absensi/1783606828_masuk_upload.jpg', 'uploads/absensi/1783606842_pulang_upload.jpg', NULL, NULL, 'hadir', 'pending', '2026-07-09 07:20:28', '2026-07-09 07:20:42'),
(5, 73, '2026-11-05', '17:08:15', NULL, 'Hadir', NULL, NULL, 'Kantor PT. MEDIA BALAI NUSA (Via QR)', NULL, 'Hadir via Scan QR Layar Kantor', 'valid', '2026-11-05 03:08:15', '2026-11-05 03:08:15');

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
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(26, '2026_06_06_024221_add_siswa_and_wali_columns_to_users_table', 15),
(27, '2026_11_02_100148_add_siswa_id_to_users_table', 16),
(28, '2026_11_05_102500_update_pendaftaran_table_final_design', 17),
(29, '2026_11_06_143000_add_pembimbing_lapangan_id_to_users_table', 18),
(30, '2026_11_06_143100_create_chats_table', 18),
(31, '2026_11_16_130000_make_legacy_columns_nullable_in_pendaftaran', 19);

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
  `ktp` varchar(255) DEFAULT NULL,
  `universitas` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `nama_guru_pembimbing` varchar(255) DEFAULT NULL,
  `email_guru_pembimbing` varchar(255) DEFAULT NULL,
  `no_hp_guru_pembimbing` varchar(255) DEFAULT NULL,
  `nama_wali` varchar(255) DEFAULT NULL,
  `hubungan_wali` varchar(255) DEFAULT NULL,
  `no_hp_wali` varchar(255) DEFAULT NULL,
  `email_wali` varchar(255) DEFAULT NULL,
  `prodi` varchar(255) DEFAULT NULL,
  `surat_rekomendasi` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `surat_pengantar` varchar(255) DEFAULT NULL,
  `surat_izin_wali` varchar(255) DEFAULT NULL,
  `proposal` varchar(255) DEFAULT NULL,
  `sertifikat` varchar(255) DEFAULT NULL,
  `id_users` bigint(20) UNSIGNED NOT NULL,
  `nisn` varchar(255) DEFAULT NULL,
  `nama_sekolah` varchar(255) DEFAULT NULL,
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

INSERT INTO `pendaftaran` (`id_pendaftaran`, `gambar`, `ktp`, `universitas`, `jurusan`, `kelas`, `nama_guru_pembimbing`, `email_guru_pembimbing`, `no_hp_guru_pembimbing`, `nama_wali`, `hubungan_wali`, `no_hp_wali`, `email_wali`, `prodi`, `surat_rekomendasi`, `cv`, `surat_pengantar`, `surat_izin_wali`, `proposal`, `sertifikat`, `id_users`, `nisn`, `nama_sekolah`, `dari_tanggal`, `sampai_tanggal`, `status_pendaftaran`, `keterangan`, `created_at`, `updated_at`) VALUES
(34, '1794830655_foto.png', NULL, 'smkn1 merbau', 'tkj', 'tkj2', 'laila', 'laila@gmail.com', '082268808430', 'ila', 'Ibu', '08225675834', 'ila@gmail.com', 'tkj', '1794830655_SuratPengantar.pdf', '1794830655_CV.pdf', '1794830655_SuratPengantar.pdf', '1794830655_SuratIzinWali.pdf', NULL, NULL, 76, '6404230042', 'smkn1 merbau', '2026-11-16', '2027-07-16', 'diterima', NULL, '2026-11-16 12:06:57', '2026-11-16 12:06:57');

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
(27, 'App\\Models\\User', 31, 'mobile_token', 'ccb9cac8ea51308903b07ca630cc77cbf38e25a74c45062ab0d0817a84a7c3aa', '[\"*\"]', '2026-11-05 02:44:09', NULL, '2026-11-05 02:43:41', '2026-11-05 02:44:09'),
(29, 'App\\Models\\User', 73, 'mobile_token', 'e2531969fb9b773788654bcca222b57ecfc59aa2f70f10775ff7e9001faee845', '[\"*\"]', '2026-11-05 03:10:38', NULL, '2026-11-05 03:07:35', '2026-11-05 03:10:38'),
(30, 'App\\Models\\User', 75, 'mobile_token', 'f260e2dd207ce1d151ded2880abb0bee2dbea9027eaebf5d9e763d01f2371136', '[\"*\"]', NULL, NULL, '2026-11-06 01:55:24', '2026-11-06 01:55:24'),
(31, 'App\\Models\\User', 76, 'deep_link_auth_token', '896e6fb8ede7483a46c5192f9d653054da005ea6ca22181e2195996f2e3c4a21', '[\"*\"]', NULL, NULL, '2026-11-25 00:52:30', '2026-11-25 00:52:30'),
(32, 'App\\Models\\User', 76, 'deep_link_auth_token', '32754edff065669934dd82226fd78ea7a60367a670f1ebda818792ed98ceadfa', '[\"*\"]', NULL, NULL, '2026-11-25 01:01:43', '2026-11-25 01:01:43'),
(33, 'App\\Models\\User', 76, 'deep_link_auth_token', 'd0dc0496eddc71cbf866750e63d6adfcb37d5055e8f60a28d3288c34a9a30f2c', '[\"*\"]', NULL, NULL, '2026-11-25 01:16:52', '2026-11-25 01:16:52'),
(34, 'App\\Models\\User', 76, 'deep_link_auth_token', 'd2197176d23fd40941e64c8225c6f5a60da6afe0393aca9b2ccfcd09680436d1', '[\"*\"]', NULL, NULL, '2026-11-25 01:19:02', '2026-11-25 01:19:02'),
(35, 'App\\Models\\User', 76, 'deep_link_auth_token', '2e0e4e328e6abac56818ff581cfe6da64f7bed106df0cff4465da1400183e792', '[\"*\"]', '2026-11-25 01:22:36', NULL, '2026-11-25 01:22:01', '2026-11-25 01:22:36'),
(36, 'App\\Models\\User', 76, 'deep_link_auth_token', 'ab82e0bfadd37aa077463ce3b3555c96ef5b7dd6e98d5481e0b2797fc5dfd063', '[\"*\"]', '2026-11-25 01:22:38', NULL, '2026-11-25 01:22:35', '2026-11-25 01:22:38');

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
(1, 'PT. MEDIA BALAN NUSA astro net', 'PT Media Balai Nusa adalah perusahaan teknologi penyedia layanan internet serat optik berkecepatan tinggi. Perusahaan ini berfokus pada pendekatan lokal untuk menyediakan konektivitas digital yang stabil dan handal, terutama di wilayah Tanjungbalai dan Bengkalis.', 'Menjadi penyedia internet terpercaya yang menghubungkan masyarakat ke masa depan digital, menjadi solusi infrastruktur telekomunikasi berakar kearifan lokal, dan badan assurance berkelas dunia.', 'Menyediakan akses internet berkualitas tinggi (cepat dan stabil) dengan harga terjangkau bagi seluruh lapisan masyarakat, mulai dari rumah tangga hingga sektor bisnis.', '+6283897813168', 'astronet.id', 'support@astronet.id', 'astronet.id', 1, '1795502767_ANMS-logo.png', 'Jl. Letjend. Suprapto (Kawasan Titi Gantung), Kel. Beting Kuala Kapias, Kec. Teluk Nibung, Kota Tanjungbalai, Sumatera Utara 21335.', '2026-11-24 06:46:07', '2026-11-24 06:46:07');

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
  `pembimbing_lapangan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `siswa_id` bigint(20) UNSIGNED DEFAULT NULL,
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

INSERT INTO `users` (`id`, `name`, `nama_lengkap`, `nim`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `email`, `email_verified_at`, `password`, `face_descriptor`, `otp_code`, `role`, `pembimbing_id`, `pembimbing_lapangan_id`, `siswa_id`, `no_telp`, `nama_wali`, `email_wali`, `no_hp_wali`, `status`, `alamat_lengkap`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL, NULL, NULL, NULL, 'admin@gmail.com', NULL, '$2y$12$Gl2.CnE6LwWH3CNQWnGAguEvwzML4dixXh5hhR1cuCtFna8lyK7Q.', NULL, NULL, 'admin', NULL, NULL, NULL, '082268808430', NULL, NULL, NULL, '1', NULL, NULL, '2023-10-02 06:03:43', '2026-10-30 06:01:00'),
(31, 'pembimbing', NULL, '6404230042', 'Lukit', '2005-01-12', 'laki-laki', 'pembimbing@gmail.com', NULL, '$2y$12$RAxGkJGnrMnmu4nQuMXin.EYmfHFrLv47jHzrNuV8c0rvtItZ36qW', NULL, NULL, 'pembimbing', NULL, NULL, NULL, '082268808430', NULL, NULL, NULL, '1', 'Sungai Alam.', NULL, '2025-11-17 04:56:02', '2025-11-26 09:36:12'),
(74, 'Bapak Joko (Wali Fikri)', NULL, NULL, NULL, NULL, NULL, 'orangtua@gmail.com', NULL, '$2y$12$ASWOcsVfwic5aZp.X9Va4.47ISLDxDL68MlyJTiJGrqsfPljFaFIq', NULL, NULL, 'orang_tua', NULL, NULL, NULL, '081234567890', NULL, NULL, NULL, NULL, NULL, NULL, '2026-11-02 03:49:39', '2026-11-05 02:42:51'),
(75, 'Budi Santoso, S.Kom (Mentor Industri)', 'Budi Santoso, S.Kom (Mentor Industri)', NULL, NULL, NULL, NULL, 'pembimbinglapangan@gmail.com', NULL, '$2y$12$qNnBBIXXNbSHqiD2whkNjeAyN040eUm/OUSQ9wmC4fSRsOWiSA4vq', NULL, NULL, 'pembimbing_lapangan', NULL, NULL, NULL, '081234567890', NULL, NULL, NULL, '1', 'Divisi Software Engineering PT Media Balai Nusa', NULL, '2026-11-06 01:28:42', '2026-11-06 01:52:43'),
(76, 'fikri firdaus', 'fikri firdaus', '6404230042', NULL, NULL, NULL, 'fikrifirdaus753@gmail.com', NULL, '$2y$12$PMGp0o9.eTwSWjVrKKW4KeBuqxy1ZhBdHBswcgDxfY1RKkEZAo26O', '[-0.12496284395456314,0.1695576161146164,0.032595761120319366,-0.028123559430241585,-0.006809148471802473,-0.07720314711332321,0.026237672194838524,-0.13500690460205078,0.19526945054531097,-0.04829021915793419,0.31129810214042664,-0.009525205940008163,-0.20011702179908752,-0.17774398624897003,0.031429268419742584,0.135702982544899,-0.19295166432857513,-0.1472967118024826,-0.0048903813585639,-0.005433470942080021,0.0637773871421814,-0.01538329292088747,0.05478473752737045,0.07130531221628189,-0.05906029790639877,-0.3929552733898163,-0.11117832362651825,-0.14613179862499237,0.058048609644174576,-0.03291736915707588,-0.04687323421239853,0.06128602847456932,-0.24089086055755615,-0.15603671967983246,-0.009752216748893261,0.10403583198785782,0.0059916190803050995,0.009515051729977131,0.20266373455524445,-0.04579656198620796,-0.17036613821983337,-0.007459978573024273,0.06780312210321426,0.25499606132507324,0.16878698766231537,0.03408889099955559,0.020960109308362007,-0.05372382700443268,-0.01308334432542324,-0.1837434321641922,0.059901218861341476,0.12140020728111267,0.17983944714069366,0.08742538094520569,-0.02434748411178589,-0.2085547149181366,0.03298211097717285,0.037691857665777206,-0.2286796122789383,-0.01477872859686613,0.04693957045674324,-0.08685670047998428,-0.03853127360343933,0.030999988317489624,0.30561167001724243,0.06859523802995682,-0.11398711800575256,-0.10207701474428177,0.14571820199489594,-0.12265758961439133,-0.03176453337073326,0.060162726789712906,-0.1174384206533432,-0.196285218000412,-0.300977498292923,0.1000056192278862,0.3900080919265747,0.10018302500247955,-0.22046026587486267,0.09302917867898941,-0.1642390340566635,-0.04920276254415512,0.03045501559972763,0.06203586235642433,-0.041956305503845215,0.05702057480812073,-0.15515024960041046,0.004485088866204023,0.1309429258108139,-0.00565252173691988,-0.023819660767912865,0.2175082266330719,-0.013701521791517735,0.09816480427980423,0.06845233589410782,0.06256337463855743,-0.021879641339182854,0.026616552844643593,-0.17923679947853088,0.0031059281900525093,0.003357494715601206,-0.08605587482452393,-0.07630205899477005,0.08294945955276489,-0.24999143183231354,0.1275274008512497,0.056566473096609116,-0.043813709169626236,-0.03489787504076958,-0.021210046485066414,-0.06187207251787186,-0.05339730903506279,0.14396600425243378,-0.29407426714897156,0.24189069867134094,0.20443150401115417,0.0121007626876235,0.24432314932346344,0.08542387932538986,0.06388036906719208,-0.000728155835531652,-0.1101747676730156,-0.2139977663755417,-0.03759406507015228,0.10777879506349564,-0.0618569441139698,0.09008156508207321,0.06842263042926788]', NULL, 'pelamar', 31, 75, NULL, '8226880839', 'ila', 'ila@gmail.com', '08225675834', 'diterima', NULL, NULL, '2026-11-14 00:45:24', '2026-11-16 05:08:04'),
(77, 'Fikri', NULL, NULL, NULL, NULL, NULL, 'fikri753@gmail.com', NULL, '$2y$12$1d34QoFc6vrT59yOkH5Clui8SSFgO2t62hiMLw/lBvXZl/kLVBQoG', NULL, NULL, 'admin', NULL, NULL, NULL, '081234567890', NULL, NULL, NULL, '1', NULL, NULL, '2026-11-25 00:08:59', NULL);

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
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_receiver_id_foreign` (`receiver_id`),
  ADD KEY `chats_sender_id_receiver_id_index` (`sender_id`,`receiver_id`),
  ADD KEY `chats_is_read_index` (`is_read`),
  ADD KEY `chats_created_at_index` (`created_at`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_siswa_id_foreign` (`siswa_id`),
  ADD KEY `users_pembimbing_lapangan_id_foreign` (`pembimbing_lapangan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensis`
--
ALTER TABLE `absensis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `alur`
--
ALTER TABLE `alur`
  MODIFY `id_alur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_pembimbing_lapangan_id_foreign` FOREIGN KEY (`pembimbing_lapangan_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
