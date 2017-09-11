-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2017 at 03:17 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nkit_pim_simbarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbarang`
--

CREATE TABLE IF NOT EXISTS `tbarang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(24) NOT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `tahun_pengadaan` varchar(4) NOT NULL,
  `waktu_pengadaan` date NOT NULL,
  `jenis_aset` varchar(32) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `id_kondisi` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbarang`
--

INSERT INTO `tbarang` (`id_barang`, `kode_barang`, `nama_barang`, `tahun_pengadaan`, `waktu_pengadaan`, `jenis_aset`, `id_ruangan`, `id_kondisi`) VALUES
(1, '01.02.200.02.01.0001', 'Meja Resepsionis', '2017', '0000-00-00', 'Aset', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkondisi`
--

CREATE TABLE IF NOT EXISTS `tkondisi` (
  `id_kondisi` int(11) NOT NULL,
  `kondisi` varchar(32) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tkondisi`
--

INSERT INTO `tkondisi` (`id_kondisi`, `kondisi`, `keterangan`) VALUES
(1, 'B', 'Barang dalam kondisi baik'),
(2, 'KB', 'Kondisi barang kurang baik'),
(3, 'R', 'Kondisi barang rusak');

-- --------------------------------------------------------

--
-- Table structure for table `tpengguna`
--

CREATE TABLE IF NOT EXISTS `tpengguna` (
  `id_admin` int(3) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telpon` varchar(12) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pass_view` varchar(100) NOT NULL,
  `level` varchar(17) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tpengguna`
--

INSERT INTO `tpengguna` (`id_admin`, `nama`, `alamat`, `no_telpon`, `username`, `password`, `pass_view`, `level`) VALUES
(3, 'Siran Tajudin Noor', 'Banjarbaru', '05117458888', 'admin', '2d241bcc81f41bf1afec03e81b24f9bb', 'admin12345678', '1'),
(4, 'Misran Ali Saiba', 'Banjarbaru', '083434912999', 'mimin', '2d241bcc81f41bf1afec03e81b24f9bb', 'admin12345678', '2');

-- --------------------------------------------------------

--
-- Table structure for table `truangan`
--

CREATE TABLE IF NOT EXISTS `truangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(100) NOT NULL,
  `pengelola_ruangan` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `truangan`
--

INSERT INTO `truangan` (`id_ruangan`, `nama_ruangan`, `pengelola_ruangan`) VALUES
(1, 'Sekretariat', 'Fairuz Nadir'),
(2, 'Aula', 'Khalid Bouhlarouz');

-- --------------------------------------------------------

--
-- Table structure for table `ttandatangan`
--

CREATE TABLE IF NOT EXISTS `ttandatangan` (
  `id_tertanda` int(11) NOT NULL,
  `nip_tertanda` varchar(22) NOT NULL,
  `nama_tertanda` varchar(100) NOT NULL,
  `pangkat_tertanda` varchar(64) NOT NULL,
  `jabatan_tertanda` varchar(120) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ttandatangan`
--

INSERT INTO `ttandatangan` (`id_tertanda`, `nip_tertanda`, `nama_tertanda`, `pangkat_tertanda`, `jabatan_tertanda`) VALUES
(2, '19850601 201504 1 001', 'Fathul Hafidh, S.Kom., M.Kom', 'Pembina', 'Kepala Bidang Huru Hara');

-- --------------------------------------------------------

--
-- Table structure for table `ttestimoni`
--

CREATE TABLE IF NOT EXISTS `ttestimoni` (
  `kd_bt` int(10) NOT NULL,
  `nama` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(32) NOT NULL,
  `pesan` text NOT NULL,
  `tampilkan` varchar(10) NOT NULL DEFAULT 'belum'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ttestimoni`
--

INSERT INTO `ttestimoni` (`kd_bt`, `nama`, `tanggal`, `email`, `pesan`, `tampilkan`) VALUES
(6, 'Arif Setiawan', '2016-07-14 16:00:00', 'arif73@gmail.com', 'Mudah digunakan dan merupakan proses transparansi pemerintahan kita', '1'),
(7, 'Khalid Bouhlarouz', '2016-08-26 16:00:00', 'cumie.banzhar@gmail.com', 'Banjarbaru kota idaman, Alhamdulillah kegiatan politik di kota ini selalu damai.', '2'),
(9, 'Supian', '2017-05-03 16:00:00', 'supian@mail.net', 'Apa kabar kanca seberataan', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbarang`
--
ALTER TABLE `tbarang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `jenis_aset` (`jenis_aset`),
  ADD KEY `id_kondisi` (`id_kondisi`),
  ADD KEY `id_lokasi` (`id_ruangan`);

--
-- Indexes for table `tkondisi`
--
ALTER TABLE `tkondisi`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- Indexes for table `tpengguna`
--
ALTER TABLE `tpengguna`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `truangan`
--
ALTER TABLE `truangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `ttandatangan`
--
ALTER TABLE `ttandatangan`
  ADD PRIMARY KEY (`id_tertanda`);

--
-- Indexes for table `ttestimoni`
--
ALTER TABLE `ttestimoni`
  ADD PRIMARY KEY (`kd_bt`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbarang`
--
ALTER TABLE `tbarang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tkondisi`
--
ALTER TABLE `tkondisi`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tpengguna`
--
ALTER TABLE `tpengguna`
  MODIFY `id_admin` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `truangan`
--
ALTER TABLE `truangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ttandatangan`
--
ALTER TABLE `ttandatangan`
  MODIFY `id_tertanda` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ttestimoni`
--
ALTER TABLE `ttestimoni`
  MODIFY `kd_bt` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
