-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 20, 2020 at 11:24 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medic`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `spesialis` varchar(255) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `jadwal_hari` varchar(255) NOT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `nama`, `spesialis`, `telepon`, `jadwal_hari`, `jam_buka`, `jam_tutup`, `foto`, `created_by`, `deleted_at`) VALUES
(1, 'Dr. Gunawans', 'Jantung', '081000', 'senin,rabu,kamis,jumat,sabtu', '14:00:00', '12:02:00', '1598343005.jpg', 3, NULL),
(2, 'Dr. Maria Oz Ava', 'Hati', '081111', 'senin,rabu,kamis,jumat', '14:00:00', '12:02:00', '1598345853.jpg', 3, NULL),
(3, 'Sdf', 'Sdf', 'sdf', 'senin,selasa,rabu,kamis,jumat,sabtu,minggu', '16:01:00', '16:00:00', '1598345984.jpg', 3, '2020-08-25 05:06:04'),
(4, 'Dr. Melinda Sari', 'Gigi', '0810000', 'senin,selasa,rabu,kamis,jumat,sabtu,minggu', '17:00:00', '21:00:00', '1598452570.jpg', 4, NULL),
(5, 'Dr. Squidee', 'Hati', '0819991213', 'senin,selasa,rabu,kamis,jumat,sabtu,minggu', '02:45:00', '02:48:00', '1605379522.jpg', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laboratorium`
--

CREATE TABLE `laboratorium` (
  `id` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `nama_lab` varchar(255) NOT NULL,
  `jadwal_hari` varchar(255) NOT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `laboratorium`
--

INSERT INTO `laboratorium` (`id`, `id_dokter`, `nama_lab`, `jadwal_hari`, `jam_buka`, `jam_tutup`, `created_by`, `deleted_at`) VALUES
(1, 1, 'Lab Empedu', 'senin,selasa,rabu,kamis,jumat,sabtu', '10:00:00', '20:00:00', 3, NULL),
(2, 2, 'Lab Mata', 'senin,rabu,kamis,jumat,sabtu', '14:00:00', '12:02:00', 3, NULL),
(3, 4, 'Lab Ginjal', 'senin,selasa,rabu,kamis,jumat', '08:00:00', '12:00:00', 4, NULL),
(4, 5, 'Lab Hati', 'senin,selasa,rabu,kamis,jumat,sabtu,minggu', '03:45:00', '04:45:00', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `id` int(11) NOT NULL,
  `id_rumahsakit` int(11) NOT NULL,
  `jenis` enum('dokter','laboratorium') NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `id_lab` int(11) NOT NULL,
  `jadwal_hari` varchar(255) NOT NULL,
  `jadwal_jam` varchar(30) NOT NULL,
  `status` enum('menunggu','diterima','ditolak') NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `notif_ke` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`id`, `id_rumahsakit`, `jenis`, `id_dokter`, `id_lab`, `jadwal_hari`, `jadwal_jam`, `status`, `keterangan`, `notif_ke`, `created_by`, `deleted_at`) VALUES
(1, 3, 'dokter', 1, 0, 'kamis', '', 'diterima', 'jadwal 8.00 - 8.30', '', 11, NULL),
(2, 4, 'laboratorium', 4, 3, 'minggu', '', 'menunggu', '', '', 11, NULL),
(3, 3, 'dokter', 2, 0, 'senin', '', 'menunggu', '', '', 11, '2020-09-04 04:29:43'),
(5, 3, 'dokter', 2, 0, 'minggu', '12:01 - 03:43', 'ditolak', 'tidak ada dokter', '', 11, NULL),
(7, 3, 'dokter', 1, 0, 'senin', ' - ', 'diterima', 'ok', '', 11, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rumah_sakit`
--

CREATE TABLE `rumah_sakit` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL,
  `status` enum('waiting','active') NOT NULL DEFAULT 'waiting',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rumah_sakit`
--

INSERT INTO `rumah_sakit` (`id`, `nama`, `alamat`, `telepon`, `email`, `foto`, `jam_buka`, `jam_tutup`, `status`, `created_at`, `created_by`, `deleted_at`) VALUES
(3, 'Rumah Sakit Dirman', 'Jl. Lorem Ipsum Dirman, 23, Bandung', '0810001', 'rsdirman@gmail.com', NULL, '06:00:00', '21:00:00', 'active', '2020-08-24 15:32:19', 10, NULL),
(4, 'Rumah Sakit Kasih Toni', 'Jl. Lorem Ipsum Denpasar Selatan', '08222222', 'rstoni@gmail.com', NULL, '06:00:00', '23:00:00', 'active', '2020-08-26 14:35:16', 9, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','admin_rs','pasien') NOT NULL DEFAULT 'pasien',
  `status` enum('waiting','active') NOT NULL DEFAULT 'waiting',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `status`, `created_at`, `deleted_at`) VALUES
(8, 'admin@gmail.com', '$2y$12$dJGcZZbC/E9bpgU2MloYn.vDlhWOrJQ800IURqbikHoFsjla3pQN.', 'admin', 'active', '2020-08-26 14:29:12', NULL),
(9, 'toni@gmail.com', '$2y$12$rqLSmNwLwF/IVwlqKyxt4OI4EZ9MwPkvI4LsU4Nzn2GGIYg1Pc0B2', 'admin_rs', 'active', '2020-08-26 14:35:16', NULL),
(10, 'dirman@gmail.com', '$2y$12$g9RkkFXtya7bpmov5Pgaeuj2jfLPAqkxTvjMQcHLbr/tUecTT/Qpi', 'admin_rs', 'active', '2020-08-24 16:27:36', NULL),
(11, 'wendi@gmail.com', '$2y$12$2QnriAxg6V5xU.aJZGixReLk7Su.wPU5QWcyHWcUeyOPkjiUQ9zlO', 'pasien', 'active', '2020-08-26 14:32:20', NULL),
(13, 'test@gmail.com', '$2y$12$yKs3R9S0ZVfX3nIXkJTIWuoN5iSXLpFlhkCOveMZelpnbuPnqqR4q', 'pasien', 'active', '2020-11-15 11:59:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL DEFAULT 'Laki-laki',
  `golongan_darah` enum('A','AB','B','O') NOT NULL DEFAULT 'A',
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `golongan_darah`, `alamat`, `telepon`, `foto`, `created_at`) VALUES
(8, 'Admin Medic', 'Amlapura', '1990-10-10', 'Laki-laki', 'A', 'Puputan Baru, Denpasar', '081000000', '', 0),
(9, 'Toni Hananta', 'Lorem', '1993-10-10', 'Laki-laki', 'A', NULL, NULL, '', 0),
(10, 'Jang Dirman', 'Bandung', '1992-10-12', 'Laki-laki', 'A', 'Jl. Lorem Ipsam, Bandung', '0809090', '1598448929.jpg', 0),
(11, 'Wendi Harniyasih', 'Bundang', '1995-08-10', 'Perempuan', 'A', 'Jl. Lorem Ipsum Dolor', '081000', '1598452753.jpg', 0),
(13, 'Test', 'Test', '1992-12-12', 'Laki-laki', 'A', NULL, NULL, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rumah_sakit`
--
ALTER TABLE `rumah_sakit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `laboratorium`
--
ALTER TABLE `laboratorium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rumah_sakit`
--
ALTER TABLE `rumah_sakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
