-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 09:18 AM
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
-- Database: `umkmgrow`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `idbatch` int(11) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `harga` varchar(11) NOT NULL,
  `idKelas` int(11) NOT NULL,
  `status` enum('aktif','expired') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`idbatch`, `tanggal`, `harga`, `idKelas`, `status`) VALUES
(8, 'Batch 1 : 16 Mei - 9 Juli 2025', '250.000', 7, 'aktif'),
(9, 'Batch 1: 20 Mei - 20 Juni 2025', '250.000', 8, 'aktif'),
(10, 'Batch 1 : 15 Agustus - 15 September 2025', '250.000', 9, 'aktif'),
(13, 'Batch 1 : 16 Mei - 17 Juli 2025', '500000', 12, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `infoevent`
--

CREATE TABLE `infoevent` (
  `idEvent` int(11) NOT NULL,
  `namaEvent` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal` varchar(50) DEFAULT NULL,
  `lokasi` varchar(150) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `infoevent`
--

INSERT INTO `infoevent` (`idEvent`, `namaEvent`, `deskripsi`, `tanggal`, `lokasi`, `gambar`) VALUES
(3, 'Surabaya Expo 2025', 'Kegiatan expo bazar terbesar di Surabaya diadakan oleh PT Sinar jaya', '20 Juni - 20 Juli 2025', 'Jl. Medokan Asri Barat 2 no 33, Rungkut, Surabaya', 'Sbyexpo.png');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `idKelas` int(11) NOT NULL,
  `namaKelas` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `jenis` enum('Bootcamp','Private Mentoring') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`idKelas`, `namaKelas`, `deskripsi`, `gambar`, `jenis`) VALUES
(7, 'Digital Marketing', 'Pelajari seputar strategi marketing di dunia digital untuk menjangkau pasar lebih luas ', 'DigitalMarketing.png', 'Bootcamp'),
(8, 'Branding Desain & Produk', 'Pelajari seputar bagaimana membangun branding desain untuk menarik konsumen', 'Brandingdesain.png', 'Bootcamp'),
(9, 'Manajemen Keuangan', 'Pelajari bagaimana cara mengatur strategi keuangan', 'Keuangan.png', 'Bootcamp'),
(12, 'Manajemen Produk', 'Konsultasikan bagaimana cara memanajemen produk dengan baik ', 'manajemen produk.png', 'Private Mentoring');

-- --------------------------------------------------------

--
-- Table structure for table `kelaskeranjang`
--

CREATE TABLE `kelaskeranjang` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `kode_va` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelaskeranjang`
--

INSERT INTO `kelaskeranjang` (`id`, `email`, `kelas_id`, `batch_id`, `metode_pembayaran`, `kode_va`) VALUES
(26, 'budi123@gmail.com', 7, 8, NULL, NULL),
(28, 'farahfaizah2705@gmail.com', 7, 8, NULL, NULL),
(29, 'farahfaizah2705@gmail.com', 8, 9, NULL, NULL),
(30, 'farahfaizah2705@gmail.com', 8, 9, NULL, NULL),
(31, 'budi123@gmail.com', 7, 8, NULL, NULL),
(32, 'farahfaizah2705@gmail.com', 7, 8, NULL, NULL),
(33, 'budi123@gmail.com', 8, 9, 'OVO', 'OVO304724'),
(34, 'budi123@gmail.com', 12, 13, 'OVO', 'OVO980009'),
(35, 'farahfaizah2705@gmail.com', 7, 8, 'Gopay', 'GOPAY275833'),
(36, 'lisa123@gmail.com', 12, 13, 'BNI', 'BNI770101'),
(37, 'budi123@gmail.com', 8, 9, 'Gopay', 'GOPAY591507'),
(38, 'sela123@gmail.com', 12, 13, 'BNI', 'BNI613433');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `namalengkap` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `namalengkap`, `password_hash`, `created_at`) VALUES
(4, 'lisa123@gmail.com', 'Lisa', 'Oktavia Lisa', '$2y$10$Ztan6fyb7dnhvtYgWSi9mOL/VhkkPsyaHyioixrpMM0BoTY4FPCYW', '2025-04-04 03:49:55'),
(5, 'farahfaizah2705@gmail.com', 'Farah', 'Farah Faizah', '$2y$10$CVK0ett1VGesFPWj.5eA/Ong/SCPUq0d/kADoDW2Y4F3AOwr4zkPC', '2025-04-04 03:50:52'),
(6, 'budi123@gmail.com', 'Farah Faizah', 'Budi', '$2y$10$MBedG1.F9I4hPqLH61U.reBYXlNdqNfOFHdrpf.pIEV8Bm/3AWQWq', '2025-04-04 04:52:05'),
(7, 'sela123@gmail.com', 'Sela', 'Sela Halimatus', '$2y$10$iC/mqQUXyaFkZugQE1erW.E/3iQ5M23f3EIotL2hXTRt0LetstwZy', '2025-04-10 13:57:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`idbatch`),
  ADD KEY `fk_idKelas` (`idKelas`);

--
-- Indexes for table `infoevent`
--
ALTER TABLE `infoevent`
  ADD PRIMARY KEY (`idEvent`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`idKelas`);

--
-- Indexes for table `kelaskeranjang`
--
ALTER TABLE `kelaskeranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelaskeranjang_ibfk_1` (`kelas_id`),
  ADD KEY `kelaskeranjang_ibfk_2` (`batch_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `idbatch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `infoevent`
--
ALTER TABLE `infoevent`
  MODIFY `idEvent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `idKelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kelaskeranjang`
--
ALTER TABLE `kelaskeranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batch`
--
ALTER TABLE `batch`
  ADD CONSTRAINT `fk_idKelas` FOREIGN KEY (`idKelas`) REFERENCES `kelas` (`idKelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelaskeranjang`
--
ALTER TABLE `kelaskeranjang`
  ADD CONSTRAINT `kelaskeranjang_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`idKelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kelaskeranjang_ibfk_2` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`idbatch`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
