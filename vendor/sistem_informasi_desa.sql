-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Mar 2024 pada 01.59
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_informasi_desa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `bg` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id`, `image`, `bg`) VALUES
(1, '460536758.jpg', '#4e73de');

-- --------------------------------------------------------

--
-- Struktur dari tabel `desa`
--

CREATE TABLE `desa` (
  `id_desa` int(11) NOT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `desa` varchar(75) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `desa`
--

INSERT INTO `desa` (`id_desa`, `id_kecamatan`, `desa`, `created_at`, `updated_at`) VALUES
(1, 1, 'Delo', '2024-02-28 10:54:58', '2024-02-28 10:55:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id_kabupaten` int(11) NOT NULL,
  `id_provinsi` int(11) DEFAULT NULL,
  `kabupaten` varchar(75) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kabupaten`
--

INSERT INTO `kabupaten` (`id_kabupaten`, `id_provinsi`, `kabupaten`, `created_at`, `updated_at`) VALUES
(2, 1, 'Sabu Raijua', '2024-02-28 10:38:51', '2024-02-28 10:38:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `id_kabupaten` int(11) DEFAULT NULL,
  `kecamatan` varchar(75) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `id_kabupaten`, `kecamatan`, `created_at`, `updated_at`) VALUES
(1, 2, 'Sabu Barat', '2024-02-28 10:49:11', '2024-02-28 10:49:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontak`
--

CREATE TABLE `kontak` (
  `id_kontak` int(11) NOT NULL,
  `username` varchar(75) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` char(12) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `misi`
--

CREATE TABLE `misi` (
  `id` int(11) NOT NULL,
  `misi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `misi`
--

INSERT INTO `misi` (`id`, `misi`) VALUES
(1, '<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur, saepe dolor ratione reiciendis quae cum beatae iste quidem sunt aliquid provident culpa, mollitia maxime atque eveniet, eius laboriosam facilis porro omnis at commodi assumenda? Asperiores adipisci iste at laudantium commodi exercitationem voluptatem tenetur, animi temporibus sed nam dicta quae saepe.</p>\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE `provinsi` (
  `id_provinsi` int(11) NOT NULL,
  `provinsi` varchar(75) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `provinsi`
--

INSERT INTO `provinsi` (`id_provinsi`, `provinsi`, `created_at`, `updated_at`) VALUES
(1, 'Nusa Tenggara Timur', '2024-02-28 10:28:33', '2024-02-28 10:28:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rt`
--

CREATE TABLE `rt` (
  `id_rt` int(11) NOT NULL,
  `id_rw` int(11) DEFAULT NULL,
  `rt` char(10) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rt`
--

INSERT INTO `rt` (`id_rt`, `id_rw`, `rt`, `created_at`, `updated_at`) VALUES
(6, 7, '001', '2024-02-29 05:49:19', '2024-02-29 05:49:19'),
(7, 13, '014', '2024-02-29 05:49:28', '2024-02-29 05:49:28'),
(8, 14, '015', '2024-02-29 05:53:06', '2024-02-29 05:53:06'),
(9, 8, '002', '2024-02-29 05:54:56', '2024-02-29 05:54:56'),
(10, 7, '002', '2024-02-29 09:37:02', '2024-02-29 09:37:02'),
(11, 12, '011', '2024-02-29 23:03:43', '2024-02-29 23:03:43'),
(12, 11, '010', '2024-03-01 06:03:15', '2024-03-01 06:03:15'),
(13, 10, '008', '2024-03-01 07:49:51', '2024-03-01 07:49:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rw`
--

CREATE TABLE `rw` (
  `id_rw` int(11) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `rw` char(10) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rw`
--

INSERT INTO `rw` (`id_rw`, `id_desa`, `rw`, `created_at`, `updated_at`) VALUES
(7, 1, '001', '2024-02-29 05:47:27', '2024-02-29 05:47:27'),
(8, 1, '002', '2024-02-29 05:47:32', '2024-02-29 05:47:32'),
(9, 1, '003', '2024-02-29 05:47:38', '2024-02-29 05:47:38'),
(10, 1, '004', '2024-02-29 05:47:43', '2024-02-29 05:47:43'),
(11, 1, '005', '2024-02-29 05:47:49', '2024-02-29 05:47:49'),
(12, 1, '006', '2024-02-29 05:47:54', '2024-02-29 05:47:54'),
(13, 1, '007', '2024-02-29 05:47:59', '2024-02-29 05:47:59'),
(14, 1, '008', '2024-02-29 05:48:06', '2024-02-29 05:48:06'),
(15, 1, '009', '2024-02-29 05:48:11', '2024-02-29 05:48:11'),
(16, 1, '010', '2024-02-29 05:48:19', '2024-02-29 05:48:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suket_domisili`
--

CREATE TABLE `suket_domisili` (
  `id_suket_domisili` int(11) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `no_surat` varchar(75) DEFAULT NULL,
  `nama_p1` varchar(75) DEFAULT NULL,
  `jabatan_p1` varchar(50) DEFAULT NULL,
  `jk_p1` varchar(35) DEFAULT NULL,
  `alamat_p1` varchar(225) DEFAULT NULL,
  `nama_p2` varchar(75) DEFAULT NULL,
  `tempat_lahir_p2` varchar(35) DEFAULT NULL,
  `tgl_lahir_p2` date DEFAULT NULL,
  `jk_p2` varchar(35) DEFAULT NULL,
  `alamat_p2` varchar(225) DEFAULT NULL,
  `agama_p2` varchar(35) DEFAULT NULL,
  `pekerjaan_p2` varchar(50) DEFAULT NULL,
  `sejak_tgl_p2` date DEFAULT NULL,
  `tgl_surat_p2` date DEFAULT current_timestamp(),
  `ket_p2` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `suket_domisili`
--

INSERT INTO `suket_domisili` (`id_suket_domisili`, `id_desa`, `no_surat`, `nama_p1`, `jabatan_p1`, `jk_p1`, `alamat_p1`, `nama_p2`, `tempat_lahir_p2`, `tgl_lahir_p2`, `jk_p2`, `alamat_p2`, `agama_p2`, `pekerjaan_p2`, `sejak_tgl_p2`, `tgl_surat_p2`, `ket_p2`, `created_at`, `updated_at`) VALUES
(5, 1, '179/ SKETB / DS.DL / VI/ 2021', 'ADRIANA HILA KORE', 'Sekretaris Desa', 'Perempuan', 'RT 001, RW 001, Desa Delo, Kec. Sabu Barat, Kab. Sabu Raijua, Prov. Nusa Tenggara Timur', 'VERLY APRIYANTO BOLA NGURU', 'Jamikerata', '2006-11-08', 'Laki-laki', 'RT 014, RW 007, Desa Delo, Kec. Sabu Barat, Kab. Sabu Raijua, Prov. Nusa Tenggara Timur', 'Kristen', 'Pelajar', '2006-11-08', '2021-06-11', 'akan melanjutkan studi ke Kupang di SMK Negeri 3 Kupang', '2024-02-29 05:52:29', '2024-02-29 05:52:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suket_kelahiran`
--

CREATE TABLE `suket_kelahiran` (
  `id_suket_kelahiran` int(11) NOT NULL,
  `id_desa` int(11) NOT NULL,
  `no_surat` varchar(75) DEFAULT NULL,
  `nama_p1` varchar(75) DEFAULT NULL,
  `jabatan_p1` varchar(50) DEFAULT NULL,
  `alamat_p1` varchar(225) DEFAULT NULL,
  `nama_p2` varchar(75) DEFAULT NULL,
  `jk_p2` varchar(35) DEFAULT NULL,
  `tempat_lahir_p2` varchar(35) DEFAULT NULL,
  `tgl_lahir_p2` date DEFAULT NULL,
  `alamat_p2` varchar(225) NOT NULL,
  `anak_ke_p2` int(11) DEFAULT NULL,
  `nama_ayah` varchar(75) DEFAULT NULL,
  `umur_ayah` int(11) DEFAULT NULL,
  `alamat_ayah` varchar(225) DEFAULT NULL,
  `pekerjaan_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(75) DEFAULT NULL,
  `umur_ibu` int(11) DEFAULT NULL,
  `alamat_ibu` varchar(225) DEFAULT NULL,
  `pekerjaan_ibu` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `suket_kelahiran`
--

INSERT INTO `suket_kelahiran` (`id_suket_kelahiran`, `id_desa`, `no_surat`, `nama_p1`, `jabatan_p1`, `alamat_p1`, `nama_p2`, `jk_p2`, `tempat_lahir_p2`, `tgl_lahir_p2`, `alamat_p2`, `anak_ke_p2`, `nama_ayah`, `umur_ayah`, `alamat_ayah`, `pekerjaan_ayah`, `nama_ibu`, `umur_ibu`, `alamat_ibu`, `pekerjaan_ibu`, `created_at`, `updated_at`) VALUES
(1, 1, '009 /SKK/DS.DL-SR/I/2024', 'DANIEL LOGO', 'Kepala Desa', 'Desa Delo, Kec. Sabu Barat, Kab. Sabu Raijua, Prov. Nusa Tenggara Timur', 'RIFAN HAPR', 'Laki-laki', 'Muli', '1985-09-01', 'RT 015, RW 008, Desa Delo, Kec. Sabu Barat, Kab. Sabu Raijua, Prov. Nusa Tenggara Timur', 4, '', 0, '', '', 'RIBKA LUDJI WOLO', 0, '', '', '2024-02-29 05:16:51', '2024-02-29 05:45:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suket_kematian`
--

CREATE TABLE `suket_kematian` (
  `id_suket_kematian` int(11) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `id_desa_kematian` int(11) DEFAULT NULL,
  `no_surat` varchar(75) DEFAULT NULL,
  `nama_p1` varchar(75) DEFAULT NULL,
  `jabatan_p1` varchar(50) DEFAULT NULL,
  `alamat_p1` varchar(225) DEFAULT NULL,
  `nama_p2` varchar(75) DEFAULT NULL,
  `tempat_lahir_p2` varchar(35) DEFAULT NULL,
  `tgl_lahir_p2` date DEFAULT NULL,
  `jk_p2` varchar(35) NOT NULL,
  `alamat_p2` varchar(225) DEFAULT NULL,
  `agama_p2` varchar(35) DEFAULT NULL,
  `tgl_kematian` date DEFAULT NULL,
  `waktu_kematian` time DEFAULT NULL,
  `pekerjaan_p2` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `suket_kematian`
--

INSERT INTO `suket_kematian` (`id_suket_kematian`, `id_desa`, `id_desa_kematian`, `no_surat`, `nama_p1`, `jabatan_p1`, `alamat_p1`, `nama_p2`, `tempat_lahir_p2`, `tgl_lahir_p2`, `jk_p2`, `alamat_p2`, `agama_p2`, `tgl_kematian`, `waktu_kematian`, `pekerjaan_p2`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '092/ DS.DL /SKK/ V/ 2023', 'DANIEL LOGO', 'Kepala Desa', 'Desa Delo, Kec. Sabu Barat, Kab. Sabu Raijua, Prov. Nusa Tenggara Timur', 'DOMINGGUS ROHI', 'Delo', '1942-07-25', 'Laki-laki', 'RT 002, RW 001, Desa Delo, Kec. Sabu Barat, Kab. Sabu Raijua, Prov. Nusa Tenggara Timur', 'Kristen', '2001-03-02', '03:30:00', 'Petani/Pekebun', '2024-02-29 09:33:30', '2024-02-29 09:47:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suket_non_kk`
--

CREATE TABLE `suket_non_kk` (
  `id_suket_non_kk` int(11) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `no_surat` varchar(75) DEFAULT NULL,
  `nama_p1` varchar(75) DEFAULT NULL,
  `jabatan_p1` varchar(50) DEFAULT NULL,
  `alamat_p1` varchar(225) DEFAULT NULL,
  `nama_p2` varchar(75) DEFAULT NULL,
  `jk_p2` varchar(35) DEFAULT NULL,
  `tempat_lahir_p2` varchar(35) DEFAULT NULL,
  `tgl_lahir_p2` date DEFAULT NULL,
  `pekerjaan_p2` varchar(50) DEFAULT NULL,
  `agama_p2` varchar(35) DEFAULT NULL,
  `kewarganegaraan` varchar(50) DEFAULT NULL,
  `alamat_p2` varchar(225) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `suket_non_kk`
--

INSERT INTO `suket_non_kk` (`id_suket_non_kk`, `id_desa`, `no_surat`, `nama_p1`, `jabatan_p1`, `alamat_p1`, `nama_p2`, `jk_p2`, `tempat_lahir_p2`, `tgl_lahir_p2`, `pekerjaan_p2`, `agama_p2`, `kewarganegaraan`, `alamat_p2`, `created_at`, `updated_at`) VALUES
(1, 1, '140/DS.DL/ SKET.BMKK/VII/ 2023', 'Adriana Hila Kore', 'Sekretaris Desa', 'Desa Delo, Kec. Sabu Barat, Kab. Sabu Raijua, Prov. Nusa Tenggara Timur', 'PETRONELA HILA KORE', 'Perempuan', 'Delo', '1992-01-24', 'Petani/Pekebun', 'Kristen', 'Indonesia', 'RT 001, RW 001, Desa Delo, Kec. Sabu Barat, Kab. Sabu Raijua, Prov. Nusa Tenggara Timur', '2024-02-29 21:44:41', '2024-02-29 21:45:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suket_tidak_mampu`
--

CREATE TABLE `suket_tidak_mampu` (
  `id_suket_tidak_mampu` int(11) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `no_surat` varchar(75) DEFAULT NULL,
  `nama_p1` varchar(75) DEFAULT NULL,
  `jabatan_p1` varchar(50) DEFAULT NULL,
  `alamat_p1` varchar(225) DEFAULT NULL,
  `nama_ayah` varchar(75) DEFAULT NULL,
  `umur_ayah` int(11) DEFAULT NULL,
  `alamat_ayah` varchar(225) DEFAULT NULL,
  `pekerjaan_ayah` varchar(50) DEFAULT NULL,
  `agama_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(75) DEFAULT NULL,
  `umur_ibu` int(11) DEFAULT NULL,
  `alamat_ibu` varchar(225) DEFAULT NULL,
  `pekerjaan_ibu` varchar(50) DEFAULT NULL,
  `agama_ibu` varchar(50) DEFAULT NULL,
  `nama_anak` varchar(75) DEFAULT NULL,
  `tempat_lahir_anak` varchar(50) DEFAULT NULL,
  `tgl_lahir_anak` date DEFAULT NULL,
  `nik_anak` char(20) DEFAULT NULL,
  `no_kk_anak` char(20) DEFAULT NULL,
  `jk_anak` varchar(35) DEFAULT NULL,
  `umur_anak` int(11) DEFAULT NULL,
  `alamat_anak` varchar(225) DEFAULT NULL,
  `pekerjaan_anak` varchar(50) DEFAULT NULL,
  `agama_anak` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `suket_tidak_mampu`
--

INSERT INTO `suket_tidak_mampu` (`id_suket_tidak_mampu`, `id_desa`, `no_surat`, `nama_p1`, `jabatan_p1`, `alamat_p1`, `nama_ayah`, `umur_ayah`, `alamat_ayah`, `pekerjaan_ayah`, `agama_ayah`, `nama_ibu`, `umur_ibu`, `alamat_ibu`, `pekerjaan_ibu`, `agama_ibu`, `nama_anak`, `tempat_lahir_anak`, `tgl_lahir_anak`, `nik_anak`, `no_kk_anak`, `jk_anak`, `umur_anak`, `alamat_anak`, `pekerjaan_anak`, `agama_anak`, `created_at`, `updated_at`) VALUES
(1, 1, '119/SKET. TM/ DS. DL/VII/2023', 'ADRIANA HILA KORE', 'Sekretaris Desa Delo', 'Desa Delo, Kec. Sabu Barat, Kab. Sabu Raijua, Prov. Nusa Tenggara Timur', 'OKTOVIANUS KABO', 51, 'RT 011, RW 006, Desa Delo, Kec. Sabu Barat, Kab. Sabu Raijua, Prov. Nusa Tenggara Timur', 'Petani/Pekebun', 'Kristen', 'MARTHA NAWA', 47, 'RT 011, RW 006, Desa Delo, Kec. Sabu Barat, Kab. Sabu Raijua, Prov. Nusa Tenggara Timur', 'Petani/Pekebun', 'Kristen', 'JUNIALDI ERIKSON HUKI', 'Terupulomi', '2005-06-12', '5320011206050001', '5320010902120080', 'Laki-laki', 18, 'RT 011, RW 006, Desa Delo, Kec. Sabu Barat, Kab. Sabu Raijua, Prov. Nusa Tenggara Timur', 'Mahasiswa', 'Kristen', '2024-02-29 22:53:54', '2024-02-29 23:06:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suket_usaha`
--

CREATE TABLE `suket_usaha` (
  `id_suket_usaha` int(11) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `id_rt` int(11) DEFAULT NULL,
  `no_surat` varchar(75) DEFAULT NULL,
  `nama_p1` varchar(75) DEFAULT NULL,
  `jabatan_p1` varchar(50) DEFAULT NULL,
  `alamat_p1` varchar(225) DEFAULT NULL,
  `nama_p2` varchar(75) DEFAULT NULL,
  `tempat_lahir_p2` varchar(50) DEFAULT NULL,
  `tgl_lahir_p2` date DEFAULT NULL,
  `alamat_p2` varchar(225) DEFAULT NULL,
  `agama_p2` varchar(35) NOT NULL,
  `pekerjaan_p2` varchar(50) DEFAULT NULL,
  `ket_p2` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `suket_usaha`
--

INSERT INTO `suket_usaha` (`id_suket_usaha`, `id_desa`, `id_rt`, `no_surat`, `nama_p1`, `jabatan_p1`, `alamat_p1`, `nama_p2`, `tempat_lahir_p2`, `tgl_lahir_p2`, `alamat_p2`, `agama_p2`, `pekerjaan_p2`, `ket_p2`, `created_at`, `updated_at`) VALUES
(1, 1, 8, '200/DS.DL/SKET.U/XI/2023', 'DANIEL LOGO', 'Kepala Desa Delo', 'Desa Delo, Kec. Sabu Barat, Kab. Sabu Raijua, Prov. Nusa Tenggara Timur', 'YOSINA RADJA MODJO', 'Menia', '1952-03-17', 'RT 010, RW 005, Desa Delo, Kec. Sabu Barat, Kab. Sabu Raijua, Prov. Nusa Tenggara Timur', 'Kristen', 'Petani/Pekebun', 'Pedagang Kaki Lima dengan jenis usaha hasil pertanian', '2024-03-01 07:48:01', '2024-03-01 11:51:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_active` int(11) DEFAULT 2,
  `en_user` varchar(75) DEFAULT NULL,
  `token` char(6) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT 'default.svg',
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(75) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `id_active`, `en_user`, `token`, `name`, `image`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'VINI', 'default.svg', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '2024-02-15 09:47:54', '2024-02-15 09:47:54');

--
-- Trigger `users`
--
DELIMITER $$
CREATE TRIGGER `insert_users` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    SET NEW.id_role = (
        SELECT id_role
        FROM `user_role`
        ORDER BY id_role DESC
        LIMIT 1
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id_access_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id_access_menu`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_sub_menu`
--

CREATE TABLE `user_access_sub_menu` (
  `id_access_sub_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_sub_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_sub_menu`
--

INSERT INTO `user_access_sub_menu` (`id_access_sub_menu`, `id_role`, `id_sub_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(8, 1, 9),
(9, 1, 10),
(10, 1, 11),
(11, 1, 12),
(12, 1, 13),
(13, 1, 14),
(14, 1, 16),
(15, 1, 17),
(16, 1, 18),
(17, 1, 19),
(18, 1, 20),
(19, 1, 21),
(21, 1, 23),
(22, 1, 24),
(23, 1, 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `menu`) VALUES
(1, 'User Management'),
(2, 'Menu Management'),
(3, 'Struktur'),
(4, 'Surat Keterangan'),
(5, 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'Administrator'),
(3, 'Penduduk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_status`
--

CREATE TABLE `user_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_status`
--

INSERT INTO `user_status` (`id_status`, `status`) VALUES
(1, 'Active'),
(2, 'No Active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_sub_menu` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `id_active` int(11) DEFAULT 2,
  `title` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_sub_menu`, `id_menu`, `id_active`, `title`, `url`, `icon`) VALUES
(1, 1, 1, 'Users', 'users', 'fas fa-users'),
(2, 1, 1, 'Role', 'role', 'fas fa-user-cog'),
(3, 2, 1, 'Menu', 'menu', 'fas fa-fw fa-folder'),
(4, 2, 1, 'Sub Menu', 'sub-menu', 'fas fa-fw fa-folder-open'),
(5, 2, 1, 'Menu Access', 'menu-access', 'fas fa-user-lock'),
(6, 2, 1, 'Sub Menu Access', 'sub-menu-access', 'fas fa-user-lock'),
(9, 3, 1, 'Provinsi', 'provinsi', 'fas fa-list-ol'),
(10, 3, 1, 'Kabupaten', 'kabupaten', 'fas fa-list-ol'),
(11, 3, 1, 'kecamatan', 'kecamatan', 'fas fa-list-ol'),
(12, 3, 1, 'Desa', 'desa', 'fas fa-list-ol'),
(13, 3, 1, 'RW', 'rw', 'fas fa-list-ol'),
(14, 3, 1, 'RT', 'rt', 'fas fa-list-ol'),
(16, 4, 1, 'Domisili', 'domisili', 'fas fa-list-ol'),
(17, 4, 1, 'Kelahiran', 'kelahiran', 'fas fa-list-ol'),
(18, 4, 1, 'Kematian', 'kematian', 'fas fa-list-ol'),
(19, 4, 1, 'Belum Memiliki KK', 'belum-memiliki-kk', 'fas fa-list-ol'),
(20, 4, 1, 'Tidak Mampu', 'tidak-mampu', 'fas fa-list-ol'),
(21, 4, 1, 'Usaha', 'usaha', 'fas fa-list-ol'),
(23, 5, 1, 'Kontak', 'kontak', 'fas fa-comments'),
(24, 5, 1, 'Visi', 'visi', 'fas fa-list-ul'),
(25, 5, 1, 'Misi', 'misi', 'fas fa-list-ul');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visi`
--

CREATE TABLE `visi` (
  `id` int(11) NOT NULL,
  `visi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `visi`
--

INSERT INTO `visi` (`id`, `visi`) VALUES
(1, '<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur, saepe dolor ratione reiciendis quae cum beatae iste quidem sunt aliquid provident culpa, mollitia maxime atque eveniet, eius laboriosam facilis porro omnis at commodi assumenda? Asperiores adipisci iste at laudantium commodi exercitationem voluptatem tenetur, animi temporibus sed nam dicta quae saepe.</p>\r\n');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`id_desa`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

--
-- Indeks untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`),
  ADD KEY `id_provinsi` (`id_provinsi`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`),
  ADD KEY `id_kabupaten` (`id_kabupaten`);

--
-- Indeks untuk tabel `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indeks untuk tabel `misi`
--
ALTER TABLE `misi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id_provinsi`);

--
-- Indeks untuk tabel `rt`
--
ALTER TABLE `rt`
  ADD PRIMARY KEY (`id_rt`),
  ADD KEY `id_rw` (`id_rw`);

--
-- Indeks untuk tabel `rw`
--
ALTER TABLE `rw`
  ADD PRIMARY KEY (`id_rw`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indeks untuk tabel `suket_domisili`
--
ALTER TABLE `suket_domisili`
  ADD PRIMARY KEY (`id_suket_domisili`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indeks untuk tabel `suket_kelahiran`
--
ALTER TABLE `suket_kelahiran`
  ADD PRIMARY KEY (`id_suket_kelahiran`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indeks untuk tabel `suket_kematian`
--
ALTER TABLE `suket_kematian`
  ADD PRIMARY KEY (`id_suket_kematian`),
  ADD KEY `id_desa` (`id_desa`),
  ADD KEY `id_desa_kematian` (`id_desa_kematian`);

--
-- Indeks untuk tabel `suket_non_kk`
--
ALTER TABLE `suket_non_kk`
  ADD PRIMARY KEY (`id_suket_non_kk`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indeks untuk tabel `suket_tidak_mampu`
--
ALTER TABLE `suket_tidak_mampu`
  ADD PRIMARY KEY (`id_suket_tidak_mampu`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indeks untuk tabel `suket_usaha`
--
ALTER TABLE `suket_usaha`
  ADD PRIMARY KEY (`id_suket_usaha`),
  ADD KEY `id_desa` (`id_desa`),
  ADD KEY `id_rt` (`id_rt`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_active` (`id_active`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id_access_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD PRIMARY KEY (`id_access_sub_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_sub_menu` (`id_sub_menu`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_active` (`id_active`);

--
-- Indeks untuk tabel `visi`
--
ALTER TABLE `visi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `desa`
--
ALTER TABLE `desa`
  MODIFY `id_desa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id_kabupaten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `misi`
--
ALTER TABLE `misi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id_provinsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rt`
--
ALTER TABLE `rt`
  MODIFY `id_rt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `rw`
--
ALTER TABLE `rw`
  MODIFY `id_rw` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `suket_domisili`
--
ALTER TABLE `suket_domisili`
  MODIFY `id_suket_domisili` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `suket_kelahiran`
--
ALTER TABLE `suket_kelahiran`
  MODIFY `id_suket_kelahiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `suket_kematian`
--
ALTER TABLE `suket_kematian`
  MODIFY `id_suket_kematian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `suket_non_kk`
--
ALTER TABLE `suket_non_kk`
  MODIFY `id_suket_non_kk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `suket_tidak_mampu`
--
ALTER TABLE `suket_tidak_mampu`
  MODIFY `id_suket_tidak_mampu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `suket_usaha`
--
ALTER TABLE `suket_usaha`
  MODIFY `id_suket_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  MODIFY `id_access_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `visi`
--
ALTER TABLE `visi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `desa`
--
ALTER TABLE `desa`
  ADD CONSTRAINT `desa_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD CONSTRAINT `kabupaten_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD CONSTRAINT `kecamatan_ibfk_1` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rt`
--
ALTER TABLE `rt`
  ADD CONSTRAINT `rt_ibfk_1` FOREIGN KEY (`id_rw`) REFERENCES `rw` (`id_rw`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rw`
--
ALTER TABLE `rw`
  ADD CONSTRAINT `rw_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `suket_domisili`
--
ALTER TABLE `suket_domisili`
  ADD CONSTRAINT `suket_domisili_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `suket_kelahiran`
--
ALTER TABLE `suket_kelahiran`
  ADD CONSTRAINT `suket_kelahiran_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `suket_kematian`
--
ALTER TABLE `suket_kematian`
  ADD CONSTRAINT `suket_kematian_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suket_kematian_ibfk_2` FOREIGN KEY (`id_desa_kematian`) REFERENCES `desa` (`id_desa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `suket_non_kk`
--
ALTER TABLE `suket_non_kk`
  ADD CONSTRAINT `suket_non_kk_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `suket_tidak_mampu`
--
ALTER TABLE `suket_tidak_mampu`
  ADD CONSTRAINT `suket_tidak_mampu_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `suket_usaha`
--
ALTER TABLE `suket_usaha`
  ADD CONSTRAINT `suket_usaha_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suket_usaha_ibfk_2` FOREIGN KEY (`id_rt`) REFERENCES `rt` (`id_rt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD CONSTRAINT `user_access_sub_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_access_sub_menu_ibfk_2` FOREIGN KEY (`id_sub_menu`) REFERENCES `user_sub_menu` (`id_sub_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_sub_menu_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
