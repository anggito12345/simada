-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2019 at 07:30 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aset`
--

-- --------------------------------------------------------

--
-- Table structure for table `detil_aset_lainnya`
--

CREATE TABLE `detil_aset_lainnya` (
  `id` int(11) NOT NULL,
  `pidinventaris` int(11) DEFAULT NULL,
  `buku_judul` varchar(255) DEFAULT NULL,
  `buku_spesifikasi` varchar(255) DEFAULT NULL,
  `seni_asal` varchar(255) DEFAULT NULL,
  `seni_pencipta` varchar(255) DEFAULT NULL,
  `seni_bahan` varchar(255) DEFAULT NULL,
  `ternak_jenis` varchar(255) DEFAULT NULL,
  `ternak_ukuran` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `foto` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detil_bangunan`
--

CREATE TABLE `detil_bangunan` (
  `id` int(11) NOT NULL,
  `pidinventaris` int(11) DEFAULT NULL,
  `konstruksi` varchar(255) DEFAULT NULL,
  `bertingkat` varchar(255) DEFAULT NULL,
  `beton` varchar(255) DEFAULT NULL,
  `luasbangunan` smallint(6) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `idkota` int(11) DEFAULT NULL,
  `idkecamatan` int(11) DEFAULT NULL,
  `idkelurahan` int(11) DEFAULT NULL,
  `koordinatlokasi` varchar(255) DEFAULT NULL,
  `koordinattanah` varchar(255) DEFAULT NULL,
  `tgldokumen` date DEFAULT NULL,
  `nodokumen` varchar(255) DEFAULT NULL,
  `luastanah` smallint(6) DEFAULT NULL,
  `statustanah` varchar(255) DEFAULT NULL,
  `kodetanah` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `foto` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detil_jalan`
--

CREATE TABLE `detil_jalan` (
  `id` int(11) NOT NULL,
  `pidinventaris` int(11) DEFAULT NULL,
  `konstruksi` varchar(255) DEFAULT NULL,
  `panjang` smallint(6) DEFAULT NULL,
  `lebar` smallint(6) DEFAULT NULL,
  `luas` smallint(6) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `idkota` int(11) DEFAULT NULL,
  `idkecamatan` int(11) DEFAULT NULL,
  `idkelurahan` int(11) DEFAULT NULL,
  `koordinatlokasi` varchar(255) DEFAULT NULL,
  `koordinattanah` varchar(255) DEFAULT NULL,
  `tgldokumen` varchar(255) DEFAULT NULL,
  `nodokumen` varchar(255) DEFAULT NULL,
  `luastanah` varchar(255) DEFAULT NULL,
  `statustanah` varchar(255) DEFAULT NULL,
  `kodetanah` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `foto` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detil_konstruksi`
--

CREATE TABLE `detil_konstruksi` (
  `id` int(11) NOT NULL,
  `pidinventaris` int(11) DEFAULT NULL,
  `konstruksi` varchar(255) DEFAULT NULL,
  `bertingkat` varchar(255) DEFAULT NULL,
  `beton` varchar(255) DEFAULT NULL,
  `luasbangunan` smallint(6) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `idkota` int(11) DEFAULT NULL,
  `idkecamatan` int(11) DEFAULT NULL,
  `idkelurahan` int(11) DEFAULT NULL,
  `koordinatlokasi` varchar(255) DEFAULT NULL,
  `koordinattanah` varchar(255) DEFAULT NULL,
  `tglmulai` date DEFAULT NULL,
  `tgldokumen` date DEFAULT NULL,
  `nodokumen` varchar(255) DEFAULT NULL,
  `luastanah` smallint(6) DEFAULT NULL,
  `statustanah` varchar(255) DEFAULT NULL,
  `kodetanah` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `foto` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detil_mesin`
--

CREATE TABLE `detil_mesin` (
  `id` int(11) NOT NULL,
  `pidinventaris` int(11) DEFAULT NULL,
  `merk` int(11) DEFAULT NULL,
  `ukuran` varchar(255) DEFAULT NULL,
  `bahan` varchar(255) DEFAULT NULL,
  `nopabrik` varchar(255) DEFAULT NULL,
  `norangka` varchar(255) DEFAULT NULL,
  `nomesin` varchar(255) DEFAULT NULL,
  `nopol` varchar(255) DEFAULT NULL,
  `bpkb` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `foto` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detil_tanah`
--

CREATE TABLE `detil_tanah` (
  `id` int(11) NOT NULL,
  `pidinventaris` int(11) DEFAULT NULL,
  `luas` smallint(6) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `idkota` int(11) DEFAULT NULL,
  `idkecamatan` int(11) DEFAULT NULL,
  `idkelurahan` int(11) DEFAULT NULL,
  `koordinatlokasi` varchar(255) DEFAULT NULL,
  `koordinattanah` varchar(255) DEFAULT NULL,
  `hak` varchar(255) DEFAULT NULL,
  `status_sertifikat` varchar(255) DEFAULT NULL,
  `tgl_sertifikat` date DEFAULT NULL,
  `nomor_sertifikat` varchar(255) DEFAULT NULL,
  `penggunaan` varchar(255) DEFAULT NULL,
  `keterangan` varchar(500) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `id` int(11) NOT NULL,
  `noreg` varchar(255) DEFAULT NULL,
  `pidbarang` int(11) DEFAULT NULL,
  `pidopd` varchar(255) DEFAULT NULL,
  `pidlokasi` int(11) DEFAULT NULL,
  `tgl_perolehan` date DEFAULT NULL,
  `tgl_sensus` date DEFAULT NULL,
  `volume` smallint(6) DEFAULT NULL,
  `pembagi` smallint(6) DEFAULT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `perolehan` varchar(50) DEFAULT NULL,
  `kondisi` varchar(50) DEFAULT NULL,
  `lokasi_detil` varchar(255) DEFAULT NULL,
  `umur_ekonomis` smallint(6) DEFAULT NULL,
  `keterangan` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id`, `noreg`, `pidbarang`, `pidopd`, `pidlokasi`, `tgl_perolehan`, `tgl_sensus`, `volume`, `pembagi`, `satuan`, `harga_satuan`, `perolehan`, `kondisi`, `lokasi_detil`, `umur_ekonomis`, `keterangan`) VALUES
(1, '455', 6, 'Pendidikan', 3333, '2019-09-01', '2019-09-01', 1, 10, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(2, '554', 8, 'Dinas Pendidikan', 12222, '2019-09-01', '2019-09-01', 1, 10, 'Hektar', 800000, 'Pembelian', NULL, NULL, NULL, NULL),
(3, '554', 8, 'Dinas Pendidikan', NULL, '2019-09-01', NULL, 1, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(4, '554', 8, 'Dinas Pendidikan', NULL, '2019-09-01', NULL, 1, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(5, '554', 8, 'Dinas Pendidikan', NULL, '2019-09-01', NULL, 1, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(6, '554', 8, 'Dinas Pendidikan', NULL, '2019-09-01', NULL, 1, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(7, '554', 8, 'Dinas Pendidikan', NULL, '2019-09-01', NULL, 1, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(8, '554', 8, 'Dinas Pendidikan', NULL, '2019-09-01', NULL, 1, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(9, '554', 8, 'Dinas Pendidikan', NULL, '2019-09-01', NULL, 1, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(10, '554', 8, 'Dinas Pendidikan', NULL, '2019-09-01', NULL, 1, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(11, '554', 8, 'Dinas Pendidikan', NULL, '2019-09-01', NULL, 1, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(12, '111', 10, 'Dinas Pendidikan', 6755, '2019-09-02', '2019-09-01', 1, 100, 'Unit', 9000, 'Pembelian', NULL, NULL, NULL, NULL),
(13, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(14, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(15, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(16, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(17, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(18, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(19, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(20, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(21, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(22, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(23, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(24, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(25, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(26, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(27, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(28, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(29, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(30, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(31, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(32, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(33, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(34, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(35, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(36, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(37, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(38, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(39, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(40, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(41, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(42, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(43, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(44, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(45, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(46, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(47, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(48, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(49, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(50, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(51, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(52, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(53, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(54, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(55, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(56, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(57, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(58, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(59, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(60, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(61, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(62, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(63, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(64, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(65, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(66, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(67, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(68, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(69, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(70, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(71, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(72, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(73, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(74, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(75, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(76, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(77, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(78, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(79, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(80, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(81, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(82, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(83, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(84, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(85, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(86, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(87, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(88, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(89, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(90, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(91, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(92, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(93, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(94, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(95, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(96, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(97, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(98, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(99, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(100, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(101, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(102, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(103, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(104, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(105, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(106, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(107, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(108, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(109, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(110, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL),
(111, '111', 10, 'Dinas Pendidikan', NULL, '2019-09-02', NULL, 1, NULL, 'Unit', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_alamat`
--

CREATE TABLE `m_alamat` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `kodepos` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_alamat`
--

INSERT INTO `m_alamat` (`id`, `pid`, `nama`, `jenis`, `kodepos`) VALUES
(1, NULL, 'Jawa Barat', 'Propinsi', NULL),
(2, 1, 'Kota Bandung', 'Kota', NULL),
(3, 2, 'Andir', 'Kecamatan', NULL),
(4, 3, 'Kebon Jeruk', 'Kelurahan/Desa', NULL),
(5, 3, 'Ciroyom', 'Kelurahan/Desa', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_barang`
--

CREATE TABLE `m_barang` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `kodetampil` varchar(255) DEFAULT NULL,
  `kode_rek` varchar(255) DEFAULT NULL,
  `nama_rek_aset` varchar(255) DEFAULT NULL,
  `jenis_barang` int(11) DEFAULT NULL,
  `umur_ekononomis` smallint(6) DEFAULT NULL,
  `aset` varchar(255) DEFAULT NULL,
  `obyek` varchar(255) DEFAULT NULL,
  `rincianobyek` varchar(255) DEFAULT NULL,
  `subrincianobyek` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_barang`
--

INSERT INTO `m_barang` (`id`, `pid`, `kodetampil`, `kode_rek`, `nama_rek_aset`, `jenis_barang`, `umur_ekononomis`, `aset`, `obyek`, `rincianobyek`, `subrincianobyek`) VALUES
(1, NULL, NULL, '13', 'ASET TETAP', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, NULL, '131', 'TANAH', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, NULL, '1311', 'TANAH', NULL, NULL, NULL, 'TANAH', NULL, NULL),
(4, 3, NULL, '13111', 'TANAH PERSIL', NULL, NULL, NULL, 'TANAH', NULL, NULL),
(5, 4, NULL, '131111', 'TANAH BANGUNAN PERUMAHAN/G.TEMPAT TINGGAL', NULL, NULL, NULL, 'TANAH', 'TANAH PERSIL', 'TANAH BANGUNAN PERUMAHAN/G.TEMPAT TINGGAL'),
(6, 5, NULL, '1311111', 'Tanah Bangunan Rumah Negara Golongan I', NULL, NULL, NULL, 'TANAH', 'TANAH PERSIL', 'TANAH BANGUNAN PERUMAHAN/G.TEMPAT TINGGAL'),
(7, 5, NULL, '1311112', 'Tanah Bangunan Rumah Negara Golongan II', NULL, NULL, NULL, 'TANAH', 'TANAH PERSIL', 'TANAH BANGUNAN PERUMAHAN/G.TEMPAT TINGGAL'),
(8, 5, NULL, '1311113', 'Tanah Bangunan Rumah Negara Golongan III', NULL, NULL, NULL, 'TANAH', 'TANAH PERSIL', 'TANAH BANGUNAN PERUMAHAN/G.TEMPAT TINGGAL'),
(9, 5, NULL, '1311114', 'Tanah Bangunan Rumah Negara Tanpa Golongan', NULL, NULL, NULL, 'TANAH', 'TANAH PERSIL', 'TANAH BANGUNAN PERUMAHAN/G.TEMPAT TINGGAL'),
(10, 5, NULL, '1311115', 'Tanah Bangunan Mess/Wisma/Asrama', NULL, NULL, NULL, 'TANAH', 'TANAH PERSIL', 'TANAH BANGUNAN PERUMAHAN/G.TEMPAT TINGGAL'),
(11, 5, NULL, '1311116', 'Tanah Bangunan Peristirahatan/Bungalaow/Cottage', NULL, NULL, NULL, 'TANAH', 'TANAH PERSIL', 'TANAH BANGUNAN PERUMAHAN/G.TEMPAT TINGGAL'),
(12, 5, NULL, '1311117', 'Tanah Bangunan Rumah Penjaga', NULL, NULL, NULL, 'TANAH', 'TANAH PERSIL', 'TANAH BANGUNAN PERUMAHAN/G.TEMPAT TINGGAL'),
(13, 5, NULL, '1311118', 'Tanah Bangunan Rumah LP', NULL, NULL, NULL, 'TANAH', 'TANAH PERSIL', 'TANAH BANGUNAN PERUMAHAN/G.TEMPAT TINGGAL'),
(14, 5, NULL, '1311119', 'Tanah Bangunan Rumah Tahanan/Rutan', NULL, NULL, NULL, 'TANAH', 'TANAH PERSIL', 'TANAH BANGUNAN PERUMAHAN/G.TEMPAT TINGGAL'),
(15, 5, NULL, '13111110', 'Tanah Bangunan Flat/Rumah Susun', NULL, NULL, NULL, 'TANAH', 'TANAH PERSIL', 'TANAH BANGUNAN PERUMAHAN/G.TEMPAT TINGGAL'),
(16, 5, NULL, '13111111', 'Tanah Kaveling Tanah Matang', NULL, NULL, NULL, 'TANAH', 'TANAH PERSIL', 'TANAH BANGUNAN PERUMAHAN/G.TEMPAT TINGGAL');

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_barang`
--

CREATE TABLE `m_jenis_barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_opd`
--

CREATE TABLE `m_jenis_opd` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_jenis_opd`
--

INSERT INTO `m_jenis_opd` (`id`, `nama`, `aktif`) VALUES
(1, 'OPD', 1),
(2, 'Bidang', 1),
(3, 'Bagian', 1),
(4, 'UPT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_kondisi`
--

CREATE TABLE `m_kondisi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kondisi`
--

INSERT INTO `m_kondisi` (`id`, `nama`, `aktif`) VALUES
(1, 'Baik', 1),
(2, 'Kurang Baik', 1),
(3, 'Rusak Berat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_lokasi`
--

CREATE TABLE `m_lokasi` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_merk_barang`
--

CREATE TABLE `m_merk_barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_merk_barang`
--

INSERT INTO `m_merk_barang` (`id`, `nama`, `aktif`) VALUES
(1, 'Toyota', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_organisasi`
--

CREATE TABLE `m_organisasi` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_organisasi`
--

INSERT INTO `m_organisasi` (`id`, `pid`, `nama`, `jenis`, `alamat`, `aktif`) VALUES
(1, NULL, 'Gubenur', NULL, NULL, 1),
(2, 1, 'BPKAD', NULL, NULL, 1),
(3, NULL, 'Pendidikan', 'Bidang', NULL, 1),
(4, 3, 'Dinas Pendidikan', 'OPD', NULL, 1),
(5, 4, 'KCD 1', 'UPT', NULL, 1),
(6, 5, 'SMK 5', 'Sekolah', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_penggunaan`
--

CREATE TABLE `m_penggunaan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_perolehan`
--

CREATE TABLE `m_perolehan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_perolehan`
--

INSERT INTO `m_perolehan` (`id`, `nama`, `aktif`) VALUES
(1, 'Pembelian', 1),
(2, 'Hadiah/Hibah', 1),
(3, 'Lainnya', 1),
(4, 'Mutasi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_satuan_barang`
--

CREATE TABLE `m_satuan_barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT NULL,
  `bisadibagi` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_satuan_barang`
--

INSERT INTO `m_satuan_barang` (`id`, `nama`, `aktif`, `bisadibagi`) VALUES
(1, 'Unit', 1, 1),
(2, 'Buah', 1, 1),
(3, 'Hektar', 1, 1),
(4, 'Meter', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pemeliharaan`
--

CREATE TABLE `pemeliharaan` (
  `id` int(11) NOT NULL,
  `pidinventaris` int(11) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `uraian` varchar(255) DEFAULT NULL,
  `persh` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nokontrak` varchar(255) DEFAULT NULL,
  `tglkontrak` date DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  `menambah` tinyint(4) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penghapusan`
--

CREATE TABLE `penghapusan` (
  `id` int(11) NOT NULL,
  `pidinventaris` int(11) DEFAULT NULL,
  `noreg` varchar(255) DEFAULT NULL,
  `tglhapus` date DEFAULT NULL,
  `kriteria` varchar(255) DEFAULT NULL,
  `kondisi` varchar(255) DEFAULT NULL,
  `harga_apprisal` varchar(255) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nosk` varchar(255) DEFAULT NULL,
  `tglsk` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detil_aset_lainnya`
--
ALTER TABLE `detil_aset_lainnya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detil_bangunan`
--
ALTER TABLE `detil_bangunan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detil_jalan`
--
ALTER TABLE `detil_jalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detil_konstruksi`
--
ALTER TABLE `detil_konstruksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detil_mesin`
--
ALTER TABLE `detil_mesin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detil_tanah`
--
ALTER TABLE `detil_tanah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_alamat`
--
ALTER TABLE `m_alamat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_jenis_barang`
--
ALTER TABLE `m_jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_jenis_opd`
--
ALTER TABLE `m_jenis_opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_kondisi`
--
ALTER TABLE `m_kondisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_lokasi`
--
ALTER TABLE `m_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_merk_barang`
--
ALTER TABLE `m_merk_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_organisasi`
--
ALTER TABLE `m_organisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_penggunaan`
--
ALTER TABLE `m_penggunaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_perolehan`
--
ALTER TABLE `m_perolehan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_satuan_barang`
--
ALTER TABLE `m_satuan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penghapusan`
--
ALTER TABLE `penghapusan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detil_aset_lainnya`
--
ALTER TABLE `detil_aset_lainnya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detil_bangunan`
--
ALTER TABLE `detil_bangunan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detil_jalan`
--
ALTER TABLE `detil_jalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detil_konstruksi`
--
ALTER TABLE `detil_konstruksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detil_mesin`
--
ALTER TABLE `detil_mesin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detil_tanah`
--
ALTER TABLE `detil_tanah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `m_alamat`
--
ALTER TABLE `m_alamat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `m_jenis_barang`
--
ALTER TABLE `m_jenis_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_jenis_opd`
--
ALTER TABLE `m_jenis_opd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_kondisi`
--
ALTER TABLE `m_kondisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_lokasi`
--
ALTER TABLE `m_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_merk_barang`
--
ALTER TABLE `m_merk_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_organisasi`
--
ALTER TABLE `m_organisasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_penggunaan`
--
ALTER TABLE `m_penggunaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_perolehan`
--
ALTER TABLE `m_perolehan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_satuan_barang`
--
ALTER TABLE `m_satuan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penghapusan`
--
ALTER TABLE `penghapusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
