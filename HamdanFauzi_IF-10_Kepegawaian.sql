-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2025 at 07:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pegawai`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'Viktor');

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `bulan` varchar(20) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `masuk` int(5) NOT NULL,
  `alfa` int(5) NOT NULL,
  `izin` int(5) NOT NULL,
  `potongan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`bulan`, `nip`, `masuk`, `alfa`, `izin`, `potongan`) VALUES
('052024', '10012211', 25, 1, 2, 50000),
('052024', '10012222', 26, 1, 1, 30000),
('052024', '10012233', 26, 2, 0, 20000),
('052024', '10012244', 24, 3, 2, 70000),
('052024', '10012255', 28, 0, 0, 0),
('052024', '10012277', 26, 1, 1, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `id_golongan` varchar(5) NOT NULL,
  `nama_golongan` varchar(10) NOT NULL,
  `tunjangan_keluarga` int(10) NOT NULL,
  `asuransi` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`id_golongan`, `nama_golongan`, `tunjangan_keluarga`, `asuransi`) VALUES
('A001', 'Golongan A', 1000000, 1000000),
('A002', 'Golongan B', 1500000, 1200000),
('A003', 'Golongan C', 2000000, 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` varchar(5) NOT NULL,
  `nama_jabatan` varchar(40) NOT NULL,
  `gaji_pokok` int(10) NOT NULL,
  `tunjangan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `gaji_pokok`, `tunjangan`) VALUES
('J001', 'Manager', 20000000, 5000000),
('J002', 'Software Engineer', 12000000, 3000000),
('J003', 'Web Developer', 8000000, 2500000),
('J004', 'IT Support Specialist', 8000000, 2000000),
('J005', 'UI/UX Designer', 6000000, 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(20) NOT NULL,
  `nama_pegawai` varchar(40) NOT NULL,
  `id_jabatan` varchar(5) NOT NULL,
  `id_golongan` varchar(5) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama_pegawai`, `id_jabatan`, `id_golongan`, `status`) VALUES
('10012211', 'Joko Satrio', 'J001', 'A001', 'Belum Menikah'),
('10012222', 'Kiki', 'J002', 'A003', 'Menikah'),
('10012233', 'Ramdan', 'J003', 'A002', 'Belum Menikah'),
('10012244', 'Erpin', 'J004', 'A002', 'Belum Menikah'),
('10012255', 'Naufal', 'J005', 'A003', 'Menikah'),
('10012277', 'Kaka', 'J002', 'A001', 'Menikah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD UNIQUE KEY `nip_2` (`nip`),
  ADD KEY `nip` (`nip`),
  ADD KEY `nip_3` (`nip`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id_golongan`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_golongan` (`id_golongan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `fk_gaji_pegawai` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`id_golongan`) REFERENCES `golongan` (`id_golongan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
