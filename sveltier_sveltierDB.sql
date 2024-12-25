-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 25, 2024 at 11:41 AM
-- Server version: 8.0.40-cll-lve
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sveltier_sveltierDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id_user` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `namalengkap` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah_login` int NOT NULL,
  `last_login` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `saldo` int NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id_user`, `namalengkap`, `username`, `password`, `jumlah_login`, `last_login`, `role`, `saldo`, `status`, `create_time`) VALUES
('Fpc0IosZ0L', 'zulfikar', 'zul123', '9f590a6942dd59a6e94df2f314b7ccd23a9a6293', 3, '2024-12-25 11:39:03', 'common', 0, 'On', '2024-12-24 21:12:05'),
('t04CzrJe5h', 'herdo dimas pratirto', 'herdo22', 'c0818b88f21035d89c35dd848a6e3cd1103181f2', 60, '2024-12-25 11:38:06', 'admin', 0, 'On', '2024-11-30 07:26:13'),
('yZSQzwpxRJ', 'tappa imanuddin', 'tapha123', '96b464d165f19a67b9821cc212678996788f6a81', 25, '2024-12-25 04:06:25', 'common', 0, 'Off', '2024-12-07 10:29:53');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id_history` varchar(255) NOT NULL,
  `id_transaction` varchar(255) NOT NULL,
  `id_pemilik` varchar(255) NOT NULL,
  `id_pembeli` varchar(255) NOT NULL,
  `id_produk` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `time_transaction` varchar(255) NOT NULL,
  `time_complete` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id_history`, `id_transaction`, `id_pemilik`, `id_pembeli`, `id_produk`, `status`, `time_transaction`, `time_complete`) VALUES
('8eBftH9PQm', 'On3ykEoTSW', 't04CzrJe5h', 'yZSQzwpxRJ', 'fgDkMFyXTo', 'done', '2024-12-13 13:59:11', '2024-12-13 07:17:26'),
('CgRsKGYWGK', 'i5agiAXNQb', 't04CzrJe5h', 'yZSQzwpxRJ', 'fgDkMFyXTo', 'done', '2024-12-14 09:36:54', '2024-12-14 02:39:29'),
('FOmN9n6Qk8', 'exPDnWJQdU', 't04CzrJe5h', 'yZSQzwpxRJ', 'fgDkMFyXTo', 'done', '2024-12-13 14:23:05', '2024-12-13 07:23:58'),
('qYA2hlGIxp', 'didKvhSl9x', 't04CzrJe5h', 'yZSQzwpxRJ', 'fgDkMFyXTo', 'done', '2024-12-14 06:34:34', '2024-12-13 23:35:31');

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` varchar(255) NOT NULL,
  `id_transaksi` varchar(255) NOT NULL,
  `pemasukan_client` int NOT NULL,
  `pemasukan_owner` int NOT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `id_transaksi`, `pemasukan_client`, `pemasukan_owner`, `tanggal_masuk`) VALUES
('FQ5iqGeVDe', 'i5agiAXNQb', 600000, 2000, '2024-12-14 02:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `pendingupload`
--

CREATE TABLE `pendingupload` (
  `id_pending` varchar(255) NOT NULL,
  `id_pemilik` varchar(255) NOT NULL,
  `id_produk` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` int NOT NULL,
  `status` varchar(255) NOT NULL,
  `time_pending` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `foto_produk` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi_produk` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `file_produk` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori_produk` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `harga_produk` int NOT NULL,
  `pemilik_produk` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `produk_dilihat` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `foto_produk`, `deskripsi_produk`, `file_produk`, `kategori_produk`, `harga_produk`, `pemilik_produk`, `produk_dilihat`, `status`, `tanggal_upload`) VALUES
('fgDkMFyXTo', 'produk 1', 'picfile/42462mountain_99130.png', 'wewewewewewewewewewewewewewewewewewewewewewewewewewewewewewewewewewewewewewewew', 'file/MAS AIO v2.8 - Password=zone94.zip', 'softwareapp', 600000, 'herdo22', 64, 'approve', '2024-12-25 04:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(255) NOT NULL,
  `id_pemilik` varchar(255) NOT NULL,
  `id_pembeli` varchar(255) NOT NULL,
  `id_produk` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` int NOT NULL,
  `foto_bukti` varchar(255) NOT NULL,
  `total_pembayaran` int NOT NULL,
  `status_transaksi` varchar(255) NOT NULL,
  `time_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pemilik`, `id_pembeli`, `id_produk`, `nama_produk`, `harga_produk`, `foto_bukti`, `total_pembayaran`, `status_transaksi`, `time_transaksi`) VALUES
('UaPJ3Vfs96', 't04CzrJe5h', 'Fpc0IosZ0L', 'fgDkMFyXTo', 'produk 1', 600000, 'none', 602000, 'pending', '2024-12-25 04:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `userreport`
--

CREATE TABLE `userreport` (
  `id_report` varchar(255) NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` longtext NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tanggal_report` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`);

--
-- Indexes for table `pendingupload`
--
ALTER TABLE `pendingupload`
  ADD PRIMARY KEY (`id_pending`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `userreport`
--
ALTER TABLE `userreport`
  ADD PRIMARY KEY (`id_report`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
