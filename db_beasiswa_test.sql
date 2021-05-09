-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2021 at 02:22 PM
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
(6, 'admin5', 'admin5'),
(9, 'admin97', 'pass4admin97'),
(10, 'admin98', 'pass4admin98'),
(11, 'admin99', 'pass4admin99'),
(12, 'admin100', 'pass4admin100'),
(13, 'admin101', 'pass4admin101'),
(14, 'admin102', 'pass4admin102'),
(19, 'admin1000', 'pass4admin1000'),
(21, 'admin999', 'pass4admin999'),
(22, 'admin9999', 'pass4admin9999');

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
(2, 'Djarum', 'PT Djarum', 2020, 12, 'Belum'),
(4, 'Indonesia Cerdas', 'Persatuan Pemuda Indonesia', 2020, 6, 'Belum');

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
(9, 1, 3, 2, '500.001 - 1.000.000'),
(10, 1, 3, 3, '1.000.001 - 1.499.999'),
(11, 1, 3, 4, '>= 1.500.000'),
(12, 1, 4, 1, '0-1'),
(13, 1, 4, 2, '2-3'),
(14, 1, 4, 3, '4-5'),
(15, 1, 4, 4, '>=6'),
(17, 4, 9, 1, '2.00 - 2.50'),
(18, 4, 9, 2, '2.51 - 3.00'),
(19, 4, 9, 3, '3.01 - 3.50'),
(21, 4, 9, 4, '3.51 - 4.00'),
(22, 4, 10, 1, '3 - 4'),
(23, 4, 10, 2, '5 - 6'),
(24, 4, 10, 3, '7 - 8'),
(25, 4, 11, 1, '<= 500.000'),
(26, 4, 11, 2, '500.001 - 1.000.000'),
(27, 4, 11, 3, '1.000.001 - 1.500.000'),
(29, 4, 11, 4, '>= 1.500.001'),
(30, 4, 14, 1, '0-1'),
(31, 4, 14, 2, '2-3'),
(32, 4, 14, 3, '4-5'),
(33, 4, 14, 4, '>=6'),
(34, 1, 2, 4, '9-10');

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
(1, 1, 1, 0.98),
(5, 4, 2, 0.8033333332400001),
(6, 4, 3, 0.6299999998000001),
(7, 1, 2, 0.8999999999999999),
(8, 4, 1, 0.6699999998),
(9, 1, 3, 0.8333333331999999);

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
(8, 1, 4, 2, 3),
(9, 4, 9, 3, 1),
(10, 4, 10, 3, 2),
(11, 4, 11, 3, 3),
(12, 4, 14, 3, 4),
(13, 4, 9, 2, 4),
(14, 4, 10, 2, 3),
(15, 4, 11, 2, 2),
(16, 4, 14, 2, 1),
(23, 4, 9, 1, 2),
(24, 4, 10, 1, 2),
(25, 4, 11, 1, 3),
(26, 4, 14, 1, 3),
(27, 1, 1, 3, 3),
(28, 1, 2, 3, 3),
(29, 1, 3, 3, 3),
(30, 1, 4, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `sifat` enum('Max','Min') NOT NULL,
  `bobot` double NOT NULL,
  `id_beasiswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `nama_kriteria`, `sifat`, `bobot`, `id_beasiswa`) VALUES
(1, 'IPK', 'Max', 0.6, 1),
(2, 'Semester', 'Min', 0.2, 1),
(3, 'Penghasilan Orangtua', 'Min', 0.1, 1),
(4, 'Jumlah Saudara', 'Max', 0.1, 1),
(5, 'IPK', 'Max', 0.5, 2),
(6, 'Semester', 'Min', 0.2, 2),
(7, 'Penghasilan Orangtua', 'Min', 0.15, 2),
(9, 'IPK', 'Max', 0.36, 4),
(10, 'Semester', 'Min', 0.14, 4),
(11, 'Penghasilan Ortu', 'Min', 0.3, 4),
(14, 'Jumlah Saudara', 'Max', 0.2, 4),
(15, 'Jumlah Saudara', 'Max', 0.15, 2);

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
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_beasiswa`
--
ALTER TABLE `tb_beasiswa`
  MODIFY `id_beasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_bobot`
--
ALTER TABLE `tb_bobot`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_kecocokan`
--
ALTER TABLE `tb_kecocokan`
  MODIFY `id_kecocokan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
