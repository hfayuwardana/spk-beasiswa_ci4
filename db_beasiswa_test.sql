-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2021 at 10:18 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_beasiswa_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_akun`
--

CREATE TABLE `tb_akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_akun`
--

INSERT INTO `tb_akun` (`id_akun`, `username`, `password`) VALUES
(1, 'admin', 'pass4admin'),
(3, 'admin2', 'pass4admin2'),
(4, 'admin3', 'admin3'),
(5, 'admin4', 'admin4'),
(6, 'admin5', 'admin5'),
(9, 'admin97', 'pass4admin97'),
(10, 'admin98', 'pass4admin98'),
(11, 'admin99', 'pass4admin99'),
(12, 'admin100', 'pass4admin100'),
(13, 'admin101', 'pass4admin101'),
(14, 'admin102', 'pass4admin102'),
(19, 'admin1000', 'pass4admin1000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_beasiswa`
--

CREATE TABLE `tb_beasiswa` (
  `id_beasiswa` int(11) NOT NULL,
  `nama_beasiswa` varchar(250) NOT NULL,
  `nama_penyelenggara` varchar(250) NOT NULL,
  `tahun` year(4) NOT NULL,
  `kuota` int(11) NOT NULL,
  `status` enum('Belum','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_beasiswa`
--

INSERT INTO `tb_beasiswa` (`id_beasiswa`, `nama_beasiswa`, `nama_penyelenggara`, `tahun`, `kuota`, `status`) VALUES
(1, 'BNI Ceria', 'Bank BNI', 2021, 15, 'Belum'),
(2, 'Djarum', 'PT Djarum', 2020, 12, 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bobot`
--

CREATE TABLE `tb_bobot` (
  `id_bobot` int(11) NOT NULL,
  `id_beasiswa` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bobot`
--

INSERT INTO `tb_bobot` (`id_bobot`, `id_beasiswa`, `id_kriteria`, `value`, `keterangan`) VALUES
(1, 1, 1, 1, '2.00 - 2.50'),
(2, 1, 1, 2, '2.51 - 3.00'),
(3, 1, 1, 3, '3.01 - 3.50'),
(4, 1, 1, 4, '3.51 - 4.00'),
(5, 1, 2, 1, '3-4'),
(6, 1, 2, 2, '5-6'),
(7, 1, 2, 3, '7-8'),
(8, 1, 3, 1, '< 500.000'),
(9, 1, 3, 2, '500.000 - 1.000.000'),
(10, 1, 3, 3, '1.000.001 - 1.499.999'),
(11, 1, 3, 4, '>= 1.500.000'),
(12, 1, 4, 1, '0-1'),
(13, 1, 4, 2, '2-3'),
(14, 1, 4, 3, '4-5'),
(15, 1, 4, 4, '>=6');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_beasiswa` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_hasil`
--

INSERT INTO `tb_hasil` (`id_hasil`, `id_beasiswa`, `id_mahasiswa`, `nilai`) VALUES
(1, 1, 1, 0.98);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kecocokan`
--

CREATE TABLE `tb_kecocokan` (
  `id_kecocokan` int(11) NOT NULL,
  `id_beasiswa` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kecocokan`
--

INSERT INTO `tb_kecocokan` (`id_kecocokan`, `id_beasiswa`, `id_kriteria`, `id_mahasiswa`, `nilai`) VALUES
(1, 1, 1, 1, 3),
(2, 1, 2, 1, 1),
(3, 1, 3, 1, 4),
(4, 1, 4, 1, 1),
(5, 1, 1, 2, 3),
(6, 1, 2, 2, 2),
(7, 1, 3, 2, 2),
(8, 1, 4, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `sifat` enum('max','min') NOT NULL,
  `bobot` double NOT NULL,
  `id_beasiswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `nama_kriteria`, `sifat`, `bobot`, `id_beasiswa`) VALUES
(1, 'IPK', 'max', 0.6, 1),
(2, 'Semester', 'min', 0.2, 1),
(3, 'Penghasilan Orangtua', 'min', 0.1, 1),
(4, 'Jumlah Saudara', 'max', 0.1, 1),
(5, 'IPK', 'max', 0.5, 2),
(6, 'Semester', 'min', 0.2, 2),
(7, 'Penghasilan Orangtua', 'min', 0.15, 2),
(8, 'Jumlah Saudara', 'max', 0.15, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` varchar(7) NOT NULL,
  `nama_mhs` varchar(250) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `gol_darah` enum('A','B','AB','O') NOT NULL,
  `nama_ibu` varchar(250) NOT NULL,
  `semester` enum('3','4','5','6','7','8') NOT NULL,
  `ipk` double NOT NULL,
  `penghasilan_ortu` decimal(15,2) NOT NULL,
  `jml_saudara` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`id_mahasiswa`, `nim`, `nama_mhs`, `tempat_lahir`, `tgl_lahir`, `alamat`, `gol_darah`, `nama_ibu`, `semester`, `ipk`, `penghasilan_ortu`, `jml_saudara`) VALUES
(1, '1903510', 'Yuyu', 'Palembang', '2021-04-30', 'Jln. Anu', 'A', 'Ada deh', '4', 3.27, '1600000.00', 1),
(2, '1903511', 'Agung', 'Aceh', '2021-04-01', 'Jln. Kenanga', 'A', 'Aging', '3', 3.4, '7000000.00', 4),
(3, '1903512', 'Yua', 'Palembang', '2021-05-03', 'Jln. Mawar, No. Sekian sekian sekian', 'A', 'Siapaya', '4', 3.22, '2600000.00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `tb_beasiswa`
--
ALTER TABLE `tb_beasiswa`
  ADD PRIMARY KEY (`id_beasiswa`);

--
-- Indexes for table `tb_bobot`
--
ALTER TABLE `tb_bobot`
  ADD PRIMARY KEY (`id_bobot`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_beasiswa` (`id_beasiswa`);

--
-- Indexes for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_beasiswa` (`id_beasiswa`);

--
-- Indexes for table `tb_kecocokan`
--
ALTER TABLE `tb_kecocokan`
  ADD PRIMARY KEY (`id_kecocokan`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_beasiswa` (`id_beasiswa`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`),
  ADD KEY `id_beasiswa` (`id_beasiswa`);

--
-- Indexes for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_akun`
--
ALTER TABLE `tb_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_beasiswa`
--
ALTER TABLE `tb_beasiswa`
  MODIFY `id_beasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_bobot`
--
ALTER TABLE `tb_bobot`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kecocokan`
--
ALTER TABLE `tb_kecocokan`
  MODIFY `id_kecocokan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_bobot`
--
ALTER TABLE `tb_bobot`
  ADD CONSTRAINT `tb_bobot_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `tb_kriteria` (`id_kriteria`),
  ADD CONSTRAINT `tb_bobot_ibfk_2` FOREIGN KEY (`id_beasiswa`) REFERENCES `tb_beasiswa` (`id_beasiswa`);

--
-- Constraints for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD CONSTRAINT `tb_hasil_ibfk_1` FOREIGN KEY (`id_beasiswa`) REFERENCES `tb_mahasiswa` (`id_mahasiswa`),
  ADD CONSTRAINT `tb_hasil_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tb_mahasiswa` (`id_mahasiswa`),
  ADD CONSTRAINT `tb_hasil_ibfk_3` FOREIGN KEY (`id_beasiswa`) REFERENCES `tb_beasiswa` (`id_beasiswa`);

--
-- Constraints for table `tb_kecocokan`
--
ALTER TABLE `tb_kecocokan`
  ADD CONSTRAINT `tb_kecocokan_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tb_mahasiswa` (`id_mahasiswa`),
  ADD CONSTRAINT `tb_kecocokan_ibfk_2` FOREIGN KEY (`id_beasiswa`) REFERENCES `tb_beasiswa` (`id_beasiswa`),
  ADD CONSTRAINT `tb_kecocokan_ibfk_3` FOREIGN KEY (`id_kriteria`) REFERENCES `tb_kriteria` (`id_kriteria`),
  ADD CONSTRAINT `tb_kecocokan_ibfk_4` FOREIGN KEY (`id_beasiswa`) REFERENCES `tb_beasiswa` (`id_beasiswa`);

--
-- Constraints for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD CONSTRAINT `tb_kriteria_ibfk_1` FOREIGN KEY (`id_beasiswa`) REFERENCES `tb_beasiswa` (`id_beasiswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;