-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2022 at 07:46 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cv_algroup`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `stok` int(50) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `stok`, `keterangan`, `satuan`) VALUES
('BRG-001', 'Asbes ukuran 150 x 105', 8, NULL, 'lembar'),
('BRG-002', 'Baja Ringan C100', 63, NULL, 'mm'),
('BRG-003', 'Balok Meranti 6 x 12', 11, NULL, 'batang'),
('BRG-004', 'Batu Bata Merah Ekspose', 147, NULL, 'm3'),
('BRG-005', 'Genteng Beton AM Flat', 25, NULL, 'buah'),
('BRG-006', 'Genteng Tanah Liat Garuda', 122, NULL, 'buah'),
('BRG-007', 'Genteng Beton Triple S Flat', 12, NULL, '12'),
('BRG-008', 'Kayu Borneo (2x3) ', 25, NULL, 'batang');

-- --------------------------------------------------------

--
-- Table structure for table `tb_brg_keluar`
--

CREATE TABLE `tb_brg_keluar` (
  `id_brg_keluar` varchar(100) NOT NULL,
  `id_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `tgl_brg_keluar` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `jumlah` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_brg_keluar`
--

INSERT INTO `tb_brg_keluar` (`id_brg_keluar`, `id_barang`, `nama_barang`, `tgl_brg_keluar`, `keterangan`, `jumlah`) VALUES
('BRG-K-001', 'BRG-001', 'Asbes ukuran 150 x 105', '2022-02-01', 'Keperluan - Asbes ukuran 150 x 105', 85),
('BRG-K-002', 'BRG-002', 'Baja Ringan C100', '2022-02-02', 'Keperluan - Baja Ringan C100', 34),
('BRG-K-003', 'BRG-003', 'Balok Meranti 6 x 12', '2022-02-04', 'Keperluan - Balok Meranti 6 x 12', 161),
('BRG-K-004', 'BRG-004', 'Batu Bata Merah Ekspose', '2022-02-05', 'Keperluan - Batu Bata Merah Ekspose', 44),
('BRG-K-005', 'BRG-005', 'Genteng Beton AM Flat', '2022-02-06', 'Keperluan - Genteng Beton AM Flat', 63),
('BRG-K-006', 'BRG-006', 'Genteng Tanah Liat Garuda', '2022-02-07', 'Keperluan - Genteng Tanah Liat Garuda', 96),
('BRG-K-007', 'BRG-008', 'Kayu Borneo (2x3) ', '2022-02-08', 'Kayu Borneo (2x3) ', 117);

-- --------------------------------------------------------

--
-- Table structure for table `tb_brg_masuk`
--

CREATE TABLE `tb_brg_masuk` (
  `id_brg_masuk` varchar(100) NOT NULL,
  `id_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `tgl_brg_masuk` varchar(255) NOT NULL,
  `satuan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_brg_masuk`
--

INSERT INTO `tb_brg_masuk` (`id_brg_masuk`, `id_barang`, `nama_barang`, `jumlah`, `supplier`, `tgl_brg_masuk`, `satuan`) VALUES
('BRG-M-001', 'BRG-001', 'Asbes ukuran 150 x 105', 46, 'SPR-001', '2022-01-02', 'lembar'),
('BRG-M-002', 'BRG-002', 'Baja Ringan C100', 78, 'SPR-002', '2022-01-04', 'mm'),
('BRG-M-003', 'BRG-003', 'Balok Meranti 6 x 12', 100, 'SPR-001', '2022-01-05', 'batang'),
('BRG-M-004', 'BRG-004', 'Batu Bata Merah Ekspose', 175, 'SPR-002', '2022-01-09', 'm3'),
('BRG-M-005', 'BRG-005', 'Genteng Beton AM Flat', 49, 'SPR-003', '2022-01-13', 'buah'),
('BRG-M-006', 'BRG-006', 'Genteng Tanah Liat Garuda', 179, 'SPR-005', '2022-01-12', 'buah'),
('BRG-M-007', 'BRG-008', 'Kayu Borneo (2x3) ', 142, 'SPR-001', '2022-01-17', 'batang');

-- --------------------------------------------------------

--
-- Table structure for table `tb_history`
--

CREATE TABLE `tb_history` (
  `id_history` int(255) NOT NULL,
  `h_id_pengajuan` varchar(100) NOT NULL,
  `h_tgl_pengajuan` varchar(50) NOT NULL,
  `h_user_pengaju` varchar(10) NOT NULL,
  `h_judul_pengajuan` varchar(255) NOT NULL,
  `h_status_pengajuan` varchar(10) DEFAULT NULL,
  `h_user_penyetuju` varchar(10) DEFAULT NULL,
  `h_tgl_setuju` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_history`
--

INSERT INTO `tb_history` (`id_history`, `h_id_pengajuan`, `h_tgl_pengajuan`, `h_user_pengaju`, `h_judul_pengajuan`, `h_status_pengajuan`, `h_user_penyetuju`, `h_tgl_setuju`) VALUES
(9, 'PJU0001', '2021-08-24', '4', 'Kebutuhan Kelas XA', '1', NULL, '0'),
(10, 'PJU0002', '2021-08-24', '2', 'Kebutuhan Staf', '1', NULL, '0'),
(11, 'PJU0003', '2021-08-24', '2', 'Kebutuhan Guru', '1', NULL, '0'),
(12, 'PJS0001', '2021-08-24', '1', 'AKO', '2', NULL, '0'),
(13, 'PJU0003', '2021-08-24', '2', 'Kebutuhan Guru', '2', '1', '2021-08-24'),
(14, 'PJU0001', '2021-08-24', '4', 'Kebutuhan Kelas XA', '2', '1', '2021-08-24'),
(15, 'PJU0001', '2021-08-24', '4', 'Kebutuhan Kelas XA', '3', '3', '2021-08-24'),
(16, 'PJS0001', '2021-08-24', '1', 'AKO', '4', '3', '2021-08-24'),
(17, 'PJU0002', '2021-08-24', '2', 'Kebutuhan Staf', '4', '1', '2021-11-29'),
(18, 'PJS0002', '2021-11-29', '1', 'Daniar Ganteng', '2', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_perencanaan_brg`
--

CREATE TABLE `tb_perencanaan_brg` (
  `id_perencanaan_d` int(11) NOT NULL,
  `id_perencanaan` varchar(100) NOT NULL,
  `tgl_perencanaan` varchar(50) NOT NULL,
  `user_perencana` varchar(10) NOT NULL,
  `barang_p` varchar(255) NOT NULL,
  `jumlah_p` int(50) NOT NULL,
  `status_perencana` varchar(10) NOT NULL,
  `file_perencana` varchar(255) DEFAULT NULL,
  `judul_perencanaan` varchar(255) DEFAULT NULL,
  `file_balasan` varchar(255) DEFAULT NULL,
  `keterangan` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_perencanaan_brg`
--

INSERT INTO `tb_perencanaan_brg` (`id_perencanaan_d`, `id_perencanaan`, `tgl_perencanaan`, `user_perencana`, `barang_p`, `jumlah_p`, `status_perencana`, `file_perencana`, `judul_perencanaan`, `file_balasan`, `keterangan`) VALUES
(44, 'PRC-001', '2021-06-02', '4', 'BRG-001', 1, '2', 'Perencanaan Ke-1.pdf', 'Perencanaan Ke-1', 'Balasan Perencanaan Ke-1.pdf', 'Saya Terima - 1'),
(45, 'PRC-001', '2021-06-02', '4', 'BRG-002', 2, '2', 'Perencanaan Ke-1.pdf', 'Perencanaan Ke-1', 'Balasan Perencanaan Ke-1.pdf', 'Saya Terima - 1'),
(46, 'PRC-002', '2021-06-23', '4', 'BRG-001', 2, '2', 'Perencanaan Ke-2.pdf', 'Perencanaan Ke-2', 'Balasan Perencanaan Ke-2.pdf', 'Saya Terima - 2'),
(47, 'PRC-002', '2021-06-23', '4', 'BRG-002', 3, '2', 'Perencanaan Ke-2.pdf', 'Perencanaan Ke-2', 'Balasan Perencanaan Ke-2.pdf', 'Saya Terima - 2'),
(48, 'PRC-003', '2021-07-11', '4', 'BRG-001', 2, '2', 'Perencanaan Ke-3.pdf', 'Perencanaan Ke-3', 'Balasan Perencanaan Ke-3.pdf', 'Saya Terima - 3'),
(49, 'PRC-003', '2021-07-11', '4', 'BRG-002', 2, '2', 'Perencanaan Ke-3.pdf', 'Perencanaan Ke-3', 'Balasan Perencanaan Ke-3.pdf', 'Saya Terima - 3'),
(50, 'PRC-004', '2021-08-15', '5', 'BRG-001', 1, '2', 'Perencanaan Ke-4.pdf', 'Perencanaan Ke-4', 'Balasan Perencanaan Ke-4.pdf', 'Saya Terima - 4'),
(51, 'PRC-004', '2021-08-15', '5', 'BRG-002', 1, '2', 'Perencanaan Ke-4.pdf', 'Perencanaan Ke-4', 'Balasan Perencanaan Ke-4.pdf', 'Saya Terima - 4'),
(52, 'PRC-005', '2021-09-12', '5', 'BRG-001', 3, '2', 'Perencanaan Ke-5.pdf', 'Perencanaan Ke-5', 'Balasan Perencanaan Ke-5.pdf', 'Saya Terima - 5'),
(53, 'PRC-005', '2021-09-12', '5', 'BRG-002', 3, '2', 'Perencanaan Ke-5.pdf', 'Perencanaan Ke-5', 'Balasan Perencanaan Ke-5.pdf', 'Saya Terima - 5'),
(54, 'PRC-006', '2021-10-27', '2', 'BRG-001', 4, '2', 'Perencanaan Ke-6.pdf', 'Perencanaan Ke-6', 'Balasan Perencanaan Ke-6.pdf', 'Saya Terima - 6'),
(55, 'PRC-006', '2021-10-27', '2', 'BRG-002', 4, '2', 'Perencanaan Ke-6.pdf', 'Perencanaan Ke-6', 'Balasan Perencanaan Ke-6.pdf', 'Saya Terima - 6'),
(56, 'PRC-007', '2021-11-25', '4', 'BRG-001', 3, '2', 'Perencanaan Ke-7.pdf', 'Perencanaan Ke-7', 'Balasan Perencanaan Ke-7.pdf', 'Saya Terima - 7'),
(57, 'PRC-007', '2021-11-25', '4', 'BRG-002', 3, '2', 'Perencanaan Ke-7.pdf', 'Perencanaan Ke-7', 'Balasan Perencanaan Ke-7.pdf', 'Saya Terima - 7'),
(58, 'PRC-008', '2021-12-23', '4', 'BRG-001', 2, '2', 'Perencanaan Ke-8.pdf', 'Perencanaan Ke-8', 'Balasan Perencanaan Ke-8.pdf', 'Saya Terima - 8'),
(59, 'PRC-008', '2021-12-23', '4', 'BRG-003', 2, '2', 'Perencanaan Ke-8.pdf', 'Perencanaan Ke-8', 'Balasan Perencanaan Ke-8.pdf', 'Saya Terima - 8'),
(60, 'PRC-009', '2022-01-04', '4', 'BRG-001', 5, '2', 'Perencanaan Ke-9.pdf', 'Perencanaan Ke-9', 'Balasan Perencanaan Ke-9.pdf', 'Saya Terima - 9'),
(61, 'PRC-009', '2022-01-04', '4', 'BRG-003', 5, '2', 'Perencanaan Ke-9.pdf', 'Perencanaan Ke-9', 'Balasan Perencanaan Ke-9.pdf', 'Saya Terima - 9'),
(62, 'PRC-010', '2021-02-02', '4', 'BRG-007', 53, '2', 'Genteng Beton Feb.pdf', 'Genten Beton Feb', 'Balasan Genteng Beton Feb.pdf', 'Saya Terima - 10'),
(63, 'PRC-011', '2021-03-03', '4', 'BRG-007', 107, '2', 'Genteng Beton Mar.pdf', 'Genten Beton Mar', 'Balasan Genteng Beton Mar.pdf', 'Saya Terima - 11'),
(64, 'PRC-012', '2021-04-04', '4', 'BRG-007', 73, '2', 'Genteng Beton Apr.pdf', 'Genten Beton Apr', 'Balasan Genteng Beton Apr.pdf', 'Saya Terima - 12'),
(65, 'PRC-013', '2021-05-05', '4', 'BRG-007', 21, '2', 'Genteng Beton May.pdf', 'Genten Beton May', 'Balasan Genteng Beton May.pdf', 'Saya Terima - 13'),
(66, 'PRC-014', '2021-06-02', '4', 'BRG-007', 144, '2', 'Genteng Beton Juni.pdf', 'Genten Beton Jun', 'Balasan Genteng Beton Juni.pdf', 'Saya Terima - 14'),
(67, 'PRC-015', '2021-07-01', '4', 'BRG-007', 115, '2', 'Genteng Beton Juli.pdf', 'Genten Beton Juli', 'Balasan Genteng Beton Juli.pdf', 'Saya Terima - 15'),
(68, 'PRC-016', '2021-08-03', '4', 'BRG-007', 156, '2', 'Genteng Beton Agustus.pdf', 'Genten Beton Agust', 'Balasan Genteng Beton Agustus.pdf', 'Saya Terima - 16'),
(69, 'PRC-017', '2021-09-01', '4', 'BRG-007', 60, '2', 'Genteng Beton September.pdf', 'Genten Beton September', 'Balasan Genteng Beton September.pdf', 'Saya Terima - 17'),
(70, 'PRC-018', '2021-10-05', '4', 'BRG-007', 67, '2', 'Genteng Beton Oktober.pdf', 'Genten Beton Okotber', 'Balasan Genteng Beton Oktober.pdf', 'Saya Terima - 18'),
(71, 'PRC-019', '2021-11-09', '4', 'BRG-007', 95, '2', 'Genteng Beton November.pdf', 'Genten Beton November', 'Balasan Genteng Beton November.pdf', 'Saya Terima - 19'),
(72, 'PRC-020', '2021-12-01', '4', 'BRG-007', 183, '2', 'Genteng Beton Desember.pdf', 'Genten Beton December', 'Balasan Genteng Beton Desember.pdf', 'Saya Terima - 20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` varchar(100) NOT NULL,
  `nama_supplier` varchar(250) NOT NULL,
  `alamat_supplier` varchar(500) NOT NULL,
  `telepon_supplier` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `nama_supplier`, `alamat_supplier`, `telepon_supplier`) VALUES
('SPR-001', 'PT Hakaru Metalindo', 'Jl. Dipati Ukur No.248, Lebakgede, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132', '081293090001'),
('SPR-002', 'PT Thaha Wood', 'Jl. Purnawarman No.13-15, Babakan Ciamis, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40117', '081293090002'),
('SPR-003', 'CV Nobel Bangun Perkasa', 'Jl. Tengku Angkasa No.32A, Lebakgede, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132', '081293090003'),
('SPR-004', 'CV Niaga Baja', 'Cihampelas Walk, GF, Jl. Cihampelas No.160, Cipaganti, Kecamatan Coblong, Kota Bandung, Jawa Barat 40131', '081293090004'),
('SPR-005', 'CV Mandiri Jaya Keramik', 'Bandung Indah Plaza, Lt. 2, Jl. Merdeka No.56, Citarum, Kec. Bandung Wetan, Kota Bandung, Jawa Barat 40115', '081293090005'),
('SPR-006', 'TB Lancar Bangunan', 'grand yogya kepatihan, Balonggede, Kec. Regol, Kota Bandung, Jawa Barat 40251', '081293090006');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp_users` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `nohp_users`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin', 'superadmin@gmail.com', NULL, '$2y$10$a6q7Hnbqp0x3rB6PIOqFa.5UoaegFAqzGyLQG2.y.fh/PV46zRlJa', NULL, '7fw9K2YwxQR46bGDjybZ6ppFfx9CNRmm2zbdxzsnrf604udnUJrLj3kuJP3F', NULL, NULL),
(2, 'Staf', 'staf', 'staf@gmail.com', NULL, '$2y$10$Ep7zRk3S12X2fyx4C/1jJ.potrRKTJoJ/UWKsaQFU8hUkdB/x7MSK', NULL, 'mqu37lGJ5IfBCgdYFRnMcCMAeSJicnvWNS6VO629uWAF5E8jxiwEptEDVrG4', NULL, NULL),
(3, 'Ketua', 'ketua', 'ketua@gmail.com', NULL, '$2y$10$v0YnDkQfq.m0atfnHt0k6ecnTfjpYFwSTwBX7xq.IwiMygfDInIzm', NULL, 'ZtR4H2PvVecm8GE62oaZ84hcvEUrHor3mkU78wxHfvYVTzx3WjXe8Cd4lvkn', NULL, NULL),
(4, 'Admin', 'staf', 'admin@gmail.com', NULL, '$2y$10$0pH1sxs47o5x0MeVuRswd.9FgBWCU/nZs7BeIykZWe5rJXAyFZNwS', NULL, 'uwY6q9FvrCaNOWNL6VxALQw9as29K9C0QkLQv7ZA1LmzArdY58sdkmiwHzzF', NULL, NULL),
(5, 'Maman', 'staf', 'maman@gmail.com', NULL, '$2y$10$/Vivdc8mQI1QzaF5UYQuy.7dssC2eB/1hNbYgYMPntBUWbeZOdAmm', NULL, 'BYWUD6ZTeBQfM8FIYo0BUzEcnJjGitWTgLp1NE0BvK9hwINrPOHqoWolSnJB', NULL, NULL),
(6, 'Rainad', 'ketua', 'rainad@gmail.com', NULL, '$2y$10$Lch.D2lVSmjDeNEpw9UJ3eqnOKq0bIRWuK/4wJtUSgkApdeiaWogi', NULL, 'rLiC5YNT7muyXGP74tZ5MlLLNKxoBG4XXZffc05bGXmMaRs7yBSlDrSHbnXg', NULL, NULL),
(7, 'Azmi', 'ketua', 'azmi@gmail.com', NULL, '$2y$10$rEaST2.DuPGfhumLxP/tMuTv9GYHh1hDdFuVVinvUdJmi/y24Lyl2', NULL, 'w8RdJ4lNzVDUq1PUxJmHpclhghMf1O3bSMCfstkm4qGJwVYUqpJLmtLUN6Wd', NULL, NULL),
(8, 'Super Admin 2', 'superadmin', 'superadmin2@gmail.com', NULL, '$2y$10$lXeiqYgrsMnNwwFE6YzuQOgeMHKUKRD5pT1LjduWeO9MGAxeuU.F2', NULL, NULL, '2021-12-22 00:54:08', '2021-12-22 00:54:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_brg_keluar`
--
ALTER TABLE `tb_brg_keluar`
  ADD PRIMARY KEY (`id_brg_keluar`);

--
-- Indexes for table `tb_brg_masuk`
--
ALTER TABLE `tb_brg_masuk`
  ADD PRIMARY KEY (`id_brg_masuk`);

--
-- Indexes for table `tb_history`
--
ALTER TABLE `tb_history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `tb_perencanaan_brg`
--
ALTER TABLE `tb_perencanaan_brg`
  ADD PRIMARY KEY (`id_perencanaan_d`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_history`
--
ALTER TABLE `tb_history`
  MODIFY `id_history` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_perencanaan_brg`
--
ALTER TABLE `tb_perencanaan_brg`
  MODIFY `id_perencanaan_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
