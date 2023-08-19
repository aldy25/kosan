-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2023 at 02:20 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kosan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_data` int(255) NOT NULL,
  `kodkun` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_data`, `kodkun`, `nama`, `alamat`) VALUES
(1, '7062631', 'nama admin 1', 'desa suka dana ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akun`
--

CREATE TABLE `tbl_akun` (
  `id_data` int(255) NOT NULL,
  `kode_akun` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL COMMENT 'allow/block',
  `level` varchar(255) NOT NULL COMMENT 'admin/pemilik/user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_akun`
--

INSERT INTO `tbl_akun` (`id_data`, `kode_akun`, `username`, `password`, `status`, `level`) VALUES
(7, '6433844', 'aldy25', '$2y$10$MM3TJphVDijSsyLNJoRWCeNwSVEjHI.WneigrUvb1esaaEXXM5K.i', 'allow', 'user'),
(8, '7065168', 'pemilik1', '$2y$10$BhtqpjKQz9ZIWBUOpzHtpeuBSQjmAmb7Yxt0Rw8bdf8ype4Hyf2u2', 'Allow', 'pemilik'),
(9, '8486961', 'user1', '$2y$10$b/tvbSc6THSUs0y7gkzll.jkRjTP0z9H4inp3.pi3eJdi.6afinGy', 'Allow', 'user'),
(10, '7062631', 'admin1', '$2y$10$FYTfCpNXLFQ7HpmJcvL.teN1Kr5AkHi02v5Nu520xxV3xevUvYF8q', 'Allow', 'admin'),
(11, '23371004', 'pengguna1', '$2y$10$hlV/N0vSksOLe67s6zOw8egIl6Xo1P5YENXhp9gHWSec4Q0CjHRDG', 'Allow', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kosan`
--

CREATE TABLE `tbl_kosan` (
  `id_kosan` int(255) NOT NULL,
  `nama_kosan` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `harga` int(255) NOT NULL,
  `jumlah_kamar` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `map` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `kode_kos` varchar(255) NOT NULL,
  `pemilik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kosan`
--

INSERT INTO `tbl_kosan` (`id_kosan`, `nama_kosan`, `alamat`, `harga`, `jumlah_kamar`, `status`, `map`, `gambar`, `kode_kos`, `pemilik`) VALUES
(5, 'kosan melati', 'Jl. Melati No.58, RT.2/RW.7, West Cilandak, Cilandak, South Jakarta City, Jakarta 12430', 5000000, 1, 'Soldout', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4854.401380105138!2d106.80293060884337!3d-6.284655253472537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1db11d12fcb%3A0xee57f67b54c3a593!2sKost%20Melati%2058!5e0!3m2!1sid!2sid!4v1658235236', 'galeri6_4.jpg', '23630969', '3605455');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemilik`
--

CREATE TABLE `tbl_pemilik` (
  `id_data` int(255) NOT NULL,
  `akun` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat_pemilik` text NOT NULL,
  `jenkel` varchar(255) NOT NULL,
  `kode_pemilik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pemilik`
--

INSERT INTO `tbl_pemilik` (`id_data`, `akun`, `nama`, `no_hp`, `alamat_pemilik`, `jenkel`, `kode_pemilik`) VALUES
(1, '7065168', 'nama pemilik1', '085266935709', 'jambi', 'Laki-laki', '3605455');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `id_pesanan` int(255) NOT NULL,
  `kosan` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL,
  `verifikasi` varchar(255) NOT NULL,
  `lama_waktu` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id_pesanan`, `kosan`, `user`, `waktu`, `bukti_bayar`, `verifikasi`, `lama_waktu`) VALUES
(7, '23630969', '28352775', '19-07-2022', 'galeri3_13.jpg', 'Sudah Terverifikasi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(255) NOT NULL,
  `kodkun` varchar(255) NOT NULL,
  `kode_user` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `kodkun`, `kode_user`, `nama`, `alamat`) VALUES
(7, '6433844', '24677616', 'Aldy nifratama', 'desa suka dana'),
(8, '8486961', '20982158', 'nama user 1', 'desa sukadana'),
(9, '23371004', '28352775', 'nama samaran', 'mendalo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_data`),
  ADD KEY `kodkun` (`kodkun`);

--
-- Indexes for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  ADD PRIMARY KEY (`id_data`),
  ADD KEY `kode_akun` (`kode_akun`);

--
-- Indexes for table `tbl_kosan`
--
ALTER TABLE `tbl_kosan`
  ADD PRIMARY KEY (`id_kosan`),
  ADD KEY `kode_kos` (`kode_kos`),
  ADD KEY `pemilik` (`pemilik`);

--
-- Indexes for table `tbl_pemilik`
--
ALTER TABLE `tbl_pemilik`
  ADD PRIMARY KEY (`id_data`),
  ADD KEY `akun` (`akun`),
  ADD KEY `kode_pemilik` (`kode_pemilik`);

--
-- Indexes for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `kosan` (`kosan`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `kodkun` (`kodkun`),
  ADD KEY `kode_user` (`kode_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_data` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  MODIFY `id_data` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_kosan`
--
ALTER TABLE `tbl_kosan`
  MODIFY `id_kosan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_pemilik`
--
ALTER TABLE `tbl_pemilik`
  MODIFY `id_data` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id_pesanan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD CONSTRAINT `tbl_admin_ibfk_1` FOREIGN KEY (`kodkun`) REFERENCES `tbl_akun` (`kode_akun`);

--
-- Constraints for table `tbl_kosan`
--
ALTER TABLE `tbl_kosan`
  ADD CONSTRAINT `tbl_kosan_ibfk_1` FOREIGN KEY (`pemilik`) REFERENCES `tbl_pemilik` (`kode_pemilik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pemilik`
--
ALTER TABLE `tbl_pemilik`
  ADD CONSTRAINT `tbl_pemilik_ibfk_1` FOREIGN KEY (`akun`) REFERENCES `tbl_akun` (`kode_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD CONSTRAINT `tbl_pesanan_ibfk_1` FOREIGN KEY (`user`) REFERENCES `tbl_user` (`kode_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pesanan_ibfk_2` FOREIGN KEY (`kosan`) REFERENCES `tbl_kosan` (`kode_kos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`kodkun`) REFERENCES `tbl_akun` (`kode_akun`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
