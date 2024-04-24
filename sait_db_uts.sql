-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 04:49 PM
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
-- Database: `sait_db_uts`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `alamat`, `tanggal_lahir`) VALUES
('sv_001', 'joko', 'bantul', '1999-12-07'),
('sv_002', 'paul', 'sleman', '2000-10-10'),
('sv_003', 'andy', 'surabaya', '2000-02-09');

-- --------------------------------------------------------

--
-- Stand-in structure for view `mahasiswa_mata_kuliah`
-- (See below for the actual view)
--
CREATE TABLE `mahasiswa_mata_kuliah` (
`id_perkuliahan` int(11)
,`nim` varchar(10)
,`nama_mahasiswa` varchar(100)
,`alamat` varchar(255)
,`tanggal_lahir` date
,`kode_mk` varchar(10)
,`nama_mk` varchar(100)
,`sks` int(11)
,`nilai` float
);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `kode_mk` varchar(10) NOT NULL,
  `nama_mk` varchar(100) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`kode_mk`, `nama_mk`, `sks`) VALUES
('svpl_001', 'database', 2),
('svpl_002', 'kecerdasan artifisial', 2),
('svpl_003', 'interopabilitas', 2);

-- --------------------------------------------------------

--
-- Table structure for table `perkuliahan`
--

CREATE TABLE `perkuliahan` (
  `id_perkuliahan` int(11) NOT NULL,
  `nim` varchar(10) DEFAULT NULL,
  `kode_mk` varchar(10) DEFAULT NULL,
  `nilai` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perkuliahan`
--

INSERT INTO `perkuliahan` (`id_perkuliahan`, `nim`, `kode_mk`, `nilai`) VALUES
(2, 'sv_001', 'svpl_002', 87),
(3, 'sv_001', 'svpl_003', 88),
(4, 'sv_002', 'svpl_001', 98),
(11, 'sv_003', 'svpl_003', 78),
(12, 'sv_003', 'svpl_001', 90),
(13, 'sv_001', 'svpl_001', 80),
(14, 'sv_001', 'svpl_002', 90),
(15, 'sv_001', 'svpl_003', 87),
(16, 'sv_001', 'svpl_002', 84),
(18, 'sv_002', 'svpl_001', 54),
(19, 'sv_002', 'svpl_001', 98);

-- --------------------------------------------------------

--
-- Structure for view `mahasiswa_mata_kuliah`
--
DROP TABLE IF EXISTS `mahasiswa_mata_kuliah`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mahasiswa_mata_kuliah`  AS SELECT `p`.`id_perkuliahan` AS `id_perkuliahan`, `m`.`nim` AS `nim`, `m`.`nama` AS `nama_mahasiswa`, `m`.`alamat` AS `alamat`, `m`.`tanggal_lahir` AS `tanggal_lahir`, `mk`.`kode_mk` AS `kode_mk`, `mk`.`nama_mk` AS `nama_mk`, `mk`.`sks` AS `sks`, `p`.`nilai` AS `nilai` FROM ((`perkuliahan` `p` join `mahasiswa` `m` on(`p`.`nim` = `m`.`nim`)) join `mata_kuliah` `mk` on(`p`.`kode_mk` = `mk`.`kode_mk`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`kode_mk`);

--
-- Indexes for table `perkuliahan`
--
ALTER TABLE `perkuliahan`
  ADD PRIMARY KEY (`id_perkuliahan`),
  ADD KEY `nim` (`nim`),
  ADD KEY `kode_mk` (`kode_mk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perkuliahan`
--
ALTER TABLE `perkuliahan`
  MODIFY `id_perkuliahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `perkuliahan`
--
ALTER TABLE `perkuliahan`
  ADD CONSTRAINT `perkuliahan_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`),
  ADD CONSTRAINT `perkuliahan_ibfk_2` FOREIGN KEY (`kode_mk`) REFERENCES `mata_kuliah` (`kode_mk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
