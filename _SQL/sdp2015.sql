-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2015 at 06:29 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sdp2015`
--

-- --------------------------------------------------------

--
-- Table structure for table `beasiswa`
--

CREATE TABLE IF NOT EXISTS `beasiswa` (
  `id` varchar(15) NOT NULL,
  `informasi_beasiswa_nama_beasiswa` varchar(30) NOT NULL,
  `mahasiswa_nrp` varchar(9) NOT NULL,
  `tanggal_create` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beasiswa`
--

INSERT INTO `beasiswa` (`id`, `informasi_beasiswa_nama_beasiswa`, `mahasiswa_nrp`, `tanggal_create`, `status`) VALUES
('BPP201508010001', 'Prestasi', '213116256', '2015-08-01', '1'),
('BPP201508010002', 'Prestasi', '213116267', '2015-08-01', '1'),
('BPP201508010003', 'Sosial Ekonomi', '213116270', '2015-08-01', '1'),
('BPP201508010004', 'Sosial Ekonomi', '213180292', '2015-08-01', '1');

-- --------------------------------------------------------

--
-- Table structure for table `calon_mahasiswa`
--

CREATE TABLE IF NOT EXISTS `calon_mahasiswa` (
  `nomor_registrasi_id` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `kewarganegaraan` varchar(3) DEFAULT NULL,
  `agama` varchar(10) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `provinsi` varchar(30) DEFAULT NULL,
  `kota` varchar(30) DEFAULT NULL,
  `kodepos` varchar(5) DEFAULT NULL,
  `nomor_hp` varchar(12) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `rapor` varchar(100) DEFAULT NULL,
  `nilai_mat` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `nilai_inggris` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `nilai_rata_rata` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `akte_kelahiran` varchar(100) DEFAULT NULL,
  `kartu_keluarga` varchar(100) DEFAULT NULL,
  `nama_sekolah` varchar(30) DEFAULT NULL,
  `alamat_sekolah` varchar(50) DEFAULT NULL,
  `provinsi_sekolah` varchar(30) DEFAULT NULL,
  `kota_sekolah` varchar(30) DEFAULT NULL,
  `kodepos_sekolah` varchar(6) DEFAULT NULL,
  `nomor_telp_sekolah` varchar(12) DEFAULT NULL,
  `relasi` varchar(1) DEFAULT NULL,
  `nama_wali` varchar(50) DEFAULT NULL,
  `alamat_wali` varchar(50) DEFAULT NULL,
  `provinsi_wali` varchar(30) DEFAULT NULL,
  `kota_wali` varchar(30) DEFAULT NULL,
  `kodepos_wali` varchar(6) DEFAULT NULL,
  `nomor_telp_wali` int(12) DEFAULT NULL,
  `pekerjaan_wali` varchar(30) DEFAULT NULL,
  `skhun` varchar(100) DEFAULT NULL,
  `ijazah` varchar(100) DEFAULT NULL,
  `informasi_kurikulum_id` varchar(8) DEFAULT NULL,
  `tanggal_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calon_mahasiswa`
--

INSERT INTO `calon_mahasiswa` (`nomor_registrasi_id`, `email`, `password`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `kewarganegaraan`, `agama`, `alamat`, `provinsi`, `kota`, `kodepos`, `nomor_hp`, `foto`, `rapor`, `nilai_mat`, `nilai_inggris`, `nilai_rata_rata`, `akte_kelahiran`, `kartu_keluarga`, `nama_sekolah`, `alamat_sekolah`, `provinsi_sekolah`, `kota_sekolah`, `kodepos_sekolah`, `nomor_telp_sekolah`, `relasi`, `nama_wali`, `alamat_wali`, `provinsi_wali`, `kota_wali`, `kodepos_wali`, `nomor_telp_wali`, `pekerjaan_wali`, `skhun`, `ijazah`, `informasi_kurikulum_id`, `tanggal_create`, `status`) VALUES
('12po09', 'raymondwongso@gmail.com', '123456', 'Raymond Wongso Hartanto', 'L', 'Surabaya', '1995-11-02', 'WNI', 'Buddha', 'Darmo Harapan Indah VI / WW12A', 'Jawa Timur', 'Surabaya', '60187', '08113192777', '', '', 0, 0, 0, '', '', 'SMAK Frateran', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, 'Go Ong Ka Kiat', 'Darmo Harapan Indah VI / WW12A', 'Jawa Timur', 'Surabaya', '60187', NULL, 'Wirausaha', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('a7i4r1', 'stefanietanujaya@gmail.com', '123456', 'Stefanie Tanujaya', 'P', 'Surabaya', '0000-00-00', 'WNI', 'Buddha', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', 'SMAK St. Louis', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, 'Wirausaha', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('d91o04', 'melanialani@gmail.com', '123456', 'Melania Laniwati', 'P', 'Surabaya', '0000-00-00', 'WNI', '', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', '', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, '', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('f6t75y', 'ivanderwilson@gmail.com', '123456', 'Ivander Wilson', 'L', 'Surabaya', '0000-00-00', 'WNI', '', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', '', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, '', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('fdse45', 'chinam@gmail.com', '123456', 'Chinam', 'L', 'Surabaya', '0000-00-00', 'WNI', '', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', '', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, '', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('fe56ty', 'cynthiawangsawinata@gmail.com', '123456', 'Cynthia Wangsawinata', 'P', 'Surabaya', '0000-00-00', 'WNI', '', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', '', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, '', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('fewq23', 'nancyyonata@gmail.com', '123456', 'Nancy Yonata', 'P', 'Surabaya', '0000-00-00', 'WNI', '', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', '', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, '', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('gty564', 'yudhadarmawan@gmail.com', '123456', 'Yudha Darmawan', 'L', 'Surabaya', '0000-00-00', 'WNI', '', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', '', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, '', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('jj876u', 'stefanuskurniawan@gmail.com', '123456', 'Stefanus Kurniawan', 'L', 'Surabaya', '0000-00-00', 'WNI', '', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', '', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, '', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('jjhy77', 'lukaskristanto@gmail.com', '123456', 'Lukas Kristanto', 'L', 'Surabaya', '0000-00-00', 'WNI', '', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', '', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, '', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('kikio0', 'angelineizumi@gmail.com', '123456', 'Angeline Izumi', 'P', 'Surabaya', '0000-00-00', 'WNI', '', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', '', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, '', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('kl09op', 'sugihartojohanes@gmail.com', '123456', 'Sugiharto Johanes', 'L', 'Surabaya', '0000-00-00', 'WNI', '', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', '', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, '', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('kli908', 'rickysaid@gmail.com', '123456', 'Ricky Said', 'L', 'Surabaya', '0000-00-00', 'WNI', '', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', '', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, '', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('qw5678', 'christianlimanto@gmail.com', '123456', 'Christian Limanto', 'L', 'Surabaya', '0000-00-00', 'WNI', '', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', '', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, '', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('wertiu', 'andregozzidhy@gmail.com', '123456', 'Andre Gozzidhy', 'L', 'Surabaya', '0000-00-00', 'WNI', '', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', '', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, '', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('wqw123', 'danielstelar@gmail.com', '123456', 'Daniel Stelar', 'L', 'Surabaya', '0000-00-00', 'WNI', '', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', '', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, '', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1),
('zx45mn', 'daniel@gmail.com', '123456', 'Daniel', 'L', 'Surabaya', '0000-00-00', 'WNI', '', '', 'Jawa Timur', 'Surabaya', '', '', '', '', 0, 0, 0, '', '', '', NULL, 'Jawa Timur', 'Surabaya', NULL, NULL, NULL, '', '', 'Jawa Timur', 'Surabaya', '', NULL, '', NULL, NULL, 'S1INF131', '2015-11-12 20:45:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_umum`
--

CREATE TABLE IF NOT EXISTS `data_umum` (
  `index` varchar(50) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_umum`
--

INSERT INTO `data_umum` (`index`, `value`) VALUES
('lama_sks', '3000'),
('tahun_ajaran_sekarang', 'GASAL 2014/2015'),
('valnilai_A_to_IPK', '4.00'),
('valnilai_B+_to_IPK', '3.75'),
('valnilai_B_to_IPK', '3.50'),
('valnilai_C+_to_IPK', '3.25'),
('valnilai_C_to_IPK', '3.00'),
('valnilai_D_to_IPK', '2.00'),
('valnilai_E_to_IPK', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `dispensasi`
--

CREATE TABLE IF NOT EXISTS `dispensasi` (
  `id` varchar(15) NOT NULL,
  `nama_dispensasi` varchar(30) NOT NULL,
  `periode_cicilan` tinyint(3) unsigned NOT NULL,
  `tanggal_batas` date NOT NULL,
  `calon_mahasiswa_nomor_registrasi` varchar(6) DEFAULT NULL,
  `mahasiswa_nrp` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `nip` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor_telepon` varchar(12) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `kepala_jurusan_id` varchar(6) DEFAULT NULL COMMENT 'mereference pada jurusan.id',
  `jumlah_sks_mengajar` int(10) unsigned NOT NULL DEFAULT '0',
  `status` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `nomor_telepon`, `email`, `password`, `kepala_jurusan_id`, `jumlah_sks_mengajar`, `status`) VALUES
('DO001', 'Budi Sutanto', NULL, 'budi@stts.edu', 'budibudi', NULL, 0, '1'),
('DO002', 'Stefanie', NULL, 'ste@gmail.com', 'steste', NULL, 0, '1'),
('DO003', 'Jenny Ngo', '031654654', 'jennyngo@gmail.com', 'jngojngo', NULL, 20, '1');

-- --------------------------------------------------------

--
-- Table structure for table `drevisi_penilaian`
--

CREATE TABLE IF NOT EXISTS `drevisi_penilaian` (
  `id` varchar(10) NOT NULL,
  `hrevisi_penilaian_id` varchar(9) NOT NULL,
  `mahasiswa_nrp` varchar(9) NOT NULL,
  `nilai_akhir_sebelum` tinyint(3) unsigned NOT NULL,
  `nilai_akhir_sesudah` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrevisi_penilaian`
--

CREATE TABLE IF NOT EXISTS `hrevisi_penilaian` (
  `id` varchar(9) NOT NULL,
  `kelas_id` varchar(6) NOT NULL,
  `catatan` text,
  `status_revisi` tinyint(1) NOT NULL,
  `tanggal_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `informasi_beasiswa`
--

CREATE TABLE IF NOT EXISTS `informasi_beasiswa` (
  `nama_beasiswa` varchar(30) NOT NULL,
  `aspek_dipotong` varchar(10) NOT NULL,
  `berapa_dipotong` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `informasi_beasiswa`
--

INSERT INTO `informasi_beasiswa` (`nama_beasiswa`, `aspek_dipotong`, `berapa_dipotong`) VALUES
('Kerja Sama', 'USP', 100),
('Minat Bakat', 'SPP', 6),
('PMB', 'USP', 25),
('Prestasi', 'SKS', 10),
('Sosial Ekonomi', 'SPP', 6);

-- --------------------------------------------------------

--
-- Table structure for table `informasi_kurikulum`
--

CREATE TABLE IF NOT EXISTS `informasi_kurikulum` (
  `id` varchar(8) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `tahun_angkatan` varchar(9) NOT NULL,
  `kategori` tinyint(4) NOT NULL,
  `harga_usp` mediumint(8) unsigned NOT NULL,
  `harga_spp` mediumint(8) unsigned NOT NULL,
  `harga_sks` mediumint(8) unsigned NOT NULL,
  `sks` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `informasi_kurikulum`
--

INSERT INTO `informasi_kurikulum` (`id`, `jurusan`, `tahun_angkatan`, `kategori`, `harga_usp`, `harga_spp`, `harga_sks`, `sks`) VALUES
('D3INF131', 'D3-Informatika', '2013/2014', 1, 7000000, 200000, 250000, 88),
('S1DKV131', 'S1-Desain Komunikasi Visual', '2013/2014', 1, 8000000, 175000, 200000, 144),
('S1DKV132', 'S1-Desain Komunikasi Visual', '2013/2014', 2, 9500000, 175000, 200000, 144),
('S1DKV133', 'S1-Desain Komunikasi Visual', '2013/2014', 3, 11000000, 175000, 200000, 144),
('S1DKV141', 'S1-Desain Komunikasi Visual', '2014/2015', 1, 9000000, 200000, 250000, 144),
('S1DKV142', 'S1-Desain Komunikasi Visual', '2014/2015', 2, 10500000, 200000, 250000, 144),
('S1DKV143', 'S1-Desain Komunikasi Visual', '2014/2015', 3, 12000000, 200000, 250000, 144),
('S1INF131', 'S1-Informatika', '2013/2014', 1, 10000000, 250000, 300000, 144),
('S1INF132', 'S1-informatika', '2013/2014', 2, 12500000, 250000, 300000, 144),
('S1INF133', 'S1-Informatika', '2013/2014', 3, 15000000, 250000, 300000, 144),
('S1INF141', 'S1-Informatika', '2014/2015', 1, 11000000, 300000, 325000, 144),
('S1INF142', 'S1-Informatika', '2014/2015', 2, 13500000, 300000, 325000, 144),
('S1INF143', 'S1-Informatika', '2014/2015', 3, 16000000, 300000, 325000, 144),
('S1SIB131', 'S1-Sistem Informasi Bisnis', '2013/2014', 1, 9500000, 200000, 250000, 144),
('S1SIB132', 'S1-Sistem Informasi Bisnis', '2013/2014', 2, 11500000, 200000, 250000, 144),
('S1SIB133', 'S1-Sistem Informasi Bisnis', '2013/2014', 3, 13500000, 200000, 250000, 144),
('S1SIB141', 'S1-Sistem Informasi Bisnis', '2014/2015', 1, 10500000, 250000, 275000, 144),
('S1SIB142', 'S1-Sistem Informasi Bisnis', '2014/2015', 2, 12500000, 250000, 275000, 144),
('S1SIB143', 'S1-Sistem Informasi Bisnis', '2014/2015', 3, 14500000, 250000, 275000, 144);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id` varchar(6) NOT NULL,
  `nama` varchar(1) NOT NULL DEFAULT '-',
  `mata_kuliah_id` varchar(6) NOT NULL,
  `ruangan_id` varchar(5) DEFAULT NULL,
  `dosen_nip` varchar(11) DEFAULT NULL,
  `hari` varchar(1) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `persentase_uts` tinyint(3) unsigned NOT NULL DEFAULT '30',
  `persentase_uas` tinyint(3) unsigned NOT NULL DEFAULT '30',
  `persentase_tugas` tinyint(3) unsigned NOT NULL DEFAULT '40',
  `tambahan_grade` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status_konfirmasi` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `komentar_kajur` text NOT NULL,
  `kelas_id` varchar(6) DEFAULT NULL COMMENT 'buat_gabung kelas',
  `tahun_ajaran` varchar(20) NOT NULL,
  `tanggal_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `mata_kuliah_id`, `ruangan_id`, `dosen_nip`, `hari`, `jam_mulai`, `persentase_uts`, `persentase_uas`, `persentase_tugas`, `tambahan_grade`, `status_konfirmasi`, `komentar_kajur`, `kelas_id`, `tahun_ajaran`, `tanggal_create`, `tanggal_update`, `status`) VALUES
('K15001', '-', 'MK004', 'R0003', 'DO001', '1', '08:00:00', 30, 30, 40, 10, 1, '', NULL, 'GASAL 2014/2015', '2015-11-12 21:56:10', '2015-11-20 15:10:18', 1),
('K15002', '-', 'MK003', 'R0003', 'DO002', '1', '10:30:00', 30, 30, 40, 0, 0, '', NULL, 'GASAL 2014/2015', '2015-11-12 21:56:58', '2015-11-12 21:56:58', 1),
('K15003', '-', 'MK003', 'R0008', 'DO003', '2', '13:00:00', 30, 30, 40, 0, 1, '', NULL, 'GASAL 2014/2015', '2015-11-12 21:57:39', '2015-11-12 21:57:39', 1),
('K15004', '-', 'MK004', 'R0006', 'DO001', '3', '13:00:00', 30, 30, 40, 0, 3, '', NULL, 'GASAL 2014/2015', '2015-11-12 21:57:39', '2015-11-15 21:31:37', 1),
('K15005', '-', 'MK005', 'R0004', 'DO002', '4', '15:30:00', 30, 30, 40, 0, 0, '', NULL, 'GASAL 2014/2015', '2015-11-12 21:58:53', '2015-11-12 21:58:53', 1),
('K15006', '-', 'MK005', 'R0006', 'DO002', '1', '08:00:00', 30, 30, 40, 0, 0, '', NULL, 'GASAL 2014/2015', '2015-11-12 21:58:53', '2015-11-12 21:58:53', 1),
('K15007', '-', 'MK007', 'R0007', 'DO003', '1', '08:00:00', 30, 30, 40, 0, 0, '', NULL, 'GASAL 2014/2015', '2015-11-12 21:59:24', '2015-11-12 21:59:24', 1),
('K15008', '-', 'MK008', 'R0006', 'DO002', '2', '10:30:00', 30, 30, 40, 0, 0, '', NULL, 'GASAL 2014/2015', '2015-11-12 21:59:24', '2015-11-12 21:59:24', 1),
('K15009', '-', 'MK009', 'R0004', 'DO003', '2', '10:30:00', 30, 30, 40, 0, 0, '', NULL, 'GASAL 2014/2015', '2015-11-12 21:59:56', '2015-11-12 21:59:56', 1),
('K15010', '-', 'MK010', 'R0001', 'DO003', '3', '10:30:00', 30, 30, 40, 0, 0, '', NULL, 'GASAL 2014/2015', '2015-11-12 21:59:56', '2015-11-12 21:59:56', 1),
('K15011', '-', 'MK011', 'R0009', 'DO002', '4', '13:00:00', 30, 30, 40, 0, 0, '', NULL, 'GASAL 2014/2015', '2015-11-12 22:00:53', '2015-11-12 22:00:53', 1),
('K15012', '-', 'MK012', 'R0008', 'DO001', '5', '15:30:00', 30, 30, 40, 0, 0, '', NULL, 'GASAL 2014/2015', '2015-11-12 22:00:53', '2015-11-12 22:00:53', 1),
('K15013', '-', 'MK013', 'R0005', 'DO002', '1', '15:30:00', 30, 30, 40, 0, 0, '', NULL, 'GASAL 2014/2015', '2015-11-12 22:01:10', '2015-11-12 22:01:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_mahasiswa`
--

CREATE TABLE IF NOT EXISTS `kelas_mahasiswa` (
  `mahasiswa_nrp` varchar(9) NOT NULL COMMENT 'NYY',
  `kelas_id` varchar(6) NOT NULL,
  `mata_kuliah_id` varchar(6) NOT NULL,
  `status_ambil` varchar(10) NOT NULL,
  `nilai_id` varchar(9) DEFAULT NULL COMMENT 'nilai sebenarnya'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='mahasiswa mengambil kelas';

--
-- Dumping data for table `kelas_mahasiswa`
--

INSERT INTO `kelas_mahasiswa` (`mahasiswa_nrp`, `kelas_id`, `mata_kuliah_id`, `status_ambil`, `nilai_id`) VALUES
('213116176', 'K15001', 'MK001', 'A', 'N61760001'),
('213116178', 'K15001', 'MK001', 'A', 'N61780001'),
('213116181', 'K15001', 'MK001', 'A', 'N61810001'),
('213116193', 'K15001', 'MK001', 'A', 'N61930001'),
('213116195', 'K15001', 'MK001', 'A', 'N61950001'),
('213116196', 'K15001', 'MK001', 'A', 'N61960001'),
('213116200', 'K15001', 'MK001', 'A', 'N62000001'),
('213116230', 'K15001', 'MK001', 'A', 'N62300001'),
('213116241', 'K15001', 'MK001', 'A', 'N62410001'),
('213116256', 'K15001', 'MK001', 'A', 'N62560001'),
('213116256', 'K15002', 'MK002', 'A', 'N62560002'),
('213116256', 'K15003', 'MK003', 'A', 'N62560003'),
('213116256', 'K15004', 'MK004', 'A', 'N62560004'),
('213116256', 'K15012', 'MK012', 'A', 'N62560005'),
('213116256', 'K15013', 'MK013', 'A', 'N62560006'),
('213116261', 'K15001', 'MK001', 'A', 'N62610001'),
('213116270', 'K15001', 'MK001', 'A', 'N62700001'),
('213116270', 'K15006', 'MK006', 'A', 'N62700002'),
('213116270', 'K15007', 'MK007', 'A', 'N62700003'),
('213116270', 'K15008', 'MK008', 'A', 'N62700004');

-- --------------------------------------------------------

--
-- Table structure for table `kode_verifikasi`
--

CREATE TABLE IF NOT EXISTS `kode_verifikasi` (
  `id` varchar(6) NOT NULL COMMENT '6 digit angka kode verifikasi',
  `nomor_registrasi_id` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tanggal_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE IF NOT EXISTS `kota` (
  `id` varchar(6) NOT NULL,
  `provinsi_id` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_penilaian`
--

CREATE TABLE IF NOT EXISTS `log_penilaian` (
  `id` varchar(11) NOT NULL,
  `keterangan` text,
  `tanggal_create` datetime NOT NULL,
  `kelas_id` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_penilaian`
--

INSERT INTO `log_penilaian` (`id`, `keterangan`, `tanggal_create`, `kelas_id`) VALUES
('NL151115001', NULL, '2015-11-15 17:01:25', 'K15001'),
('NL151115002', NULL, '2015-11-15 17:08:53', 'K15001'),
('NL151115003', NULL, '2015-11-15 17:13:38', 'K15001'),
('NL151115004', NULL, '2015-11-15 17:14:31', 'K15001'),
('NL151115005', NULL, '2015-11-15 17:14:57', 'K15001'),
('NL151115006', NULL, '2015-11-15 17:18:35', 'K15001'),
('NL151115007', NULL, '2015-11-15 17:20:25', 'K15001'),
('NL151115008', NULL, '2015-11-15 17:21:09', 'K15001'),
('NL151115009', NULL, '2015-11-15 17:21:15', 'K15001'),
('NL151115010', NULL, '2015-11-15 17:22:39', 'K15001'),
('NL151115011', NULL, '2015-11-15 17:22:48', 'K15001'),
('NL151115012', NULL, '2015-11-15 17:24:04', 'K15001'),
('NL151115013', NULL, '2015-11-15 17:24:23', 'K15001'),
('NL151115014', NULL, '2015-11-15 17:25:28', 'K15001'),
('NL151115015', NULL, '2015-11-15 17:29:39', 'K15001'),
('NL151115016', NULL, '2015-11-15 17:29:47', 'K15001'),
('NL151115017', NULL, '2015-11-15 17:30:40', 'K15001'),
('NL151115018', NULL, '2015-11-15 17:31:05', 'K15001'),
('NL151115019', NULL, '2015-11-15 17:31:23', 'K15001'),
('NL151115020', NULL, '2015-11-15 17:31:48', 'K15001'),
('NL151115021', NULL, '2015-11-15 17:32:01', 'K15001'),
('NL151115022', NULL, '2015-11-15 17:33:49', 'K15001'),
('NL151115023', NULL, '2015-11-15 17:35:04', 'K15001'),
('NL151115024', NULL, '2015-11-15 17:35:43', 'K15001'),
('NL151115025', NULL, '2015-11-15 17:36:08', 'K15001'),
('NL151115026', NULL, '2015-11-15 17:49:35', 'K15001'),
('NL151115027', NULL, '2015-11-15 17:49:52', 'K15001'),
('NL151115028', NULL, '2015-11-15 18:00:12', 'K15001'),
('NL151115029', NULL, '2015-11-15 21:06:20', 'K15001'),
('NL151115030', NULL, '2015-11-15 21:26:24', 'K15004'),
('NL151115031', NULL, '2015-11-15 21:26:48', 'K15004'),
('NL151115032', NULL, '2015-11-15 21:31:37', 'K15004'),
('NL151117001', NULL, '2015-11-17 13:17:43', 'K15001'),
('NL151117002', NULL, '2015-11-17 13:18:57', 'K15001'),
('NL151117003', NULL, '2015-11-17 13:55:22', 'K15001'),
('NL151117004', NULL, '2015-11-17 21:52:30', 'K15001'),
('NL151117005', NULL, '2015-11-17 21:53:34', 'K15001'),
('NL151117006', NULL, '2015-11-17 21:55:05', 'K15001'),
('NL151117007', NULL, '2015-11-17 21:55:17', 'K15001'),
('NL151117008', NULL, '2015-11-17 21:56:57', 'K15001'),
('NL151117009', NULL, '2015-11-17 21:58:29', 'K15001'),
('NL151117010', NULL, '2015-11-17 21:58:39', 'K15001'),
('NL151117011', NULL, '2015-11-17 21:59:45', 'K15001'),
('NL151117012', NULL, '2015-11-17 21:59:57', 'K15001'),
('NL151117013', NULL, '2015-11-17 22:01:05', 'K15001'),
('NL151117014', NULL, '2015-11-17 22:02:12', 'K15001'),
('NL151117015', NULL, '2015-11-17 22:02:58', 'K15001'),
('NL151117016', NULL, '2015-11-17 22:03:02', 'K15001'),
('NL151117017', NULL, '2015-11-17 22:03:08', 'K15001'),
('NL151117018', NULL, '2015-11-17 22:03:12', 'K15001'),
('NL151117019', NULL, '2015-11-17 22:05:26', 'K15001'),
('NL151117020', NULL, '2015-11-17 22:33:49', 'K15001'),
('NL151117021', NULL, '2015-11-17 22:51:48', 'K15001'),
('NL151117022', NULL, '2015-11-17 22:53:33', 'K15001'),
('NL151117023', NULL, '2015-11-17 22:54:04', 'K15001'),
('NL151117024', NULL, '2015-11-17 22:55:14', 'K15001'),
('NL151117025', NULL, '2015-11-17 22:56:56', 'K15001'),
('NL151117026', NULL, '2015-11-17 22:59:40', 'K15001'),
('NL151117027', NULL, '2015-11-17 23:00:00', 'K15001'),
('NL151117028', NULL, '2015-11-17 23:00:29', 'K15001'),
('NL151117029', NULL, '2015-11-17 23:03:23', 'K15001'),
('NL151117030', NULL, '2015-11-17 23:04:10', 'K15001'),
('NL151117031', NULL, '2015-11-17 23:08:40', 'K15001'),
('NL151117032', NULL, '2015-11-18 01:47:12', 'K15001'),
('NL151117033', NULL, '2015-11-18 01:48:11', 'K15001'),
('NL151117034', NULL, '2015-11-18 01:49:09', 'K15001'),
('NL151117035', NULL, '2015-11-18 01:51:03', 'K15001'),
('NL151119001', NULL, '2015-11-20 00:48:05', 'K15001'),
('NL151120001', NULL, '2015-11-20 14:52:43', 'K15001');

-- --------------------------------------------------------

--
-- Table structure for table `log_penilaian_nilai`
--

CREATE TABLE IF NOT EXISTS `log_penilaian_nilai` (
  `nilai_id` varchar(9) NOT NULL,
  `log_penilaian_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_penilaian_nilai`
--

INSERT INTO `log_penilaian_nilai` (`nilai_id`, `log_penilaian_id`) VALUES
('N62560001', 'NL151115001'),
('N62560001', 'NL151115002'),
('N62560001', 'NL151115003'),
('N62700001', 'NL151115004'),
('N62560001', 'NL151115005'),
('N62560001', 'NL151115007'),
('N62560001', 'NL151115008'),
('N62700001', 'NL151115009'),
('N62560001', 'NL151115010'),
('N62560001', 'NL151115011'),
('N62560001', 'NL151115012'),
('N62560001', 'NL151115013'),
('N62560001', 'NL151115014'),
('N62560001', 'NL151115015'),
('N62560001', 'NL151115016'),
('N62560001', 'NL151115017'),
('N62560001', 'NL151115018'),
('N62560001', 'NL151115019'),
('N62560001', 'NL151115020'),
('N62560001', 'NL151115021'),
('N62560001', 'NL151115022'),
('N62560001', 'NL151115023'),
('N62560001', 'NL151115024'),
('N62700001', 'NL151115024'),
('N62560001', 'NL151115025'),
('N62700001', 'NL151115025'),
('N62560001', 'NL151115026'),
('N62560001', 'NL151115027'),
('N62560001', 'NL151115028'),
('N62560001', 'NL151115029'),
('N62560004', 'NL151115030'),
('N62560004', 'NL151115031'),
('N62560004', 'NL151115032'),
('N62560001', 'NL151117001'),
('N62700001', 'NL151117001'),
('N62560001', 'NL151117002'),
('N62560001', 'NL151117003'),
('N62560001', 'NL151117004'),
('N62560001', 'NL151117005'),
('N62560001', 'NL151117006'),
('N62560001', 'NL151117007'),
('N62560001', 'NL151117008'),
('N62560001', 'NL151117009'),
('N62560001', 'NL151117010'),
('N62560001', 'NL151117011'),
('N62700001', 'NL151117012'),
('N62560001', 'NL151117013'),
('N62560001', 'NL151117014'),
('N62560001', 'NL151117015'),
('N62560001', 'NL151117016'),
('N62560001', 'NL151117017'),
('N62560001', 'NL151117018'),
('N62560001', 'NL151117019'),
('N62560001', 'NL151117020'),
('N62560001', 'NL151117021'),
('N62700001', 'NL151117021'),
('N62560001', 'NL151117022'),
('N62700001', 'NL151117022'),
('N62560001', 'NL151117023'),
('N62700001', 'NL151117023'),
('N62560001', 'NL151117024'),
('N62700001', 'NL151117024'),
('N62560001', 'NL151117025'),
('N62700001', 'NL151117025'),
('N62560001', 'NL151117026'),
('N62560001', 'NL151117027'),
('N62560001', 'NL151117028'),
('N62560001', 'NL151117029'),
('N62560001', 'NL151117030'),
('N62700001', 'NL151117030'),
('N62560001', 'NL151117031'),
('N62700001', 'NL151117031'),
('N62560001', 'NL151117032'),
('N62700001', 'NL151117033'),
('N62560001', 'NL151117034'),
('N62560001', 'NL151117035'),
('N61760001', 'NL151119001'),
('N61780001', 'NL151119001'),
('N61810001', 'NL151119001'),
('N61930001', 'NL151119001'),
('N61950001', 'NL151119001'),
('N61960001', 'NL151119001'),
('N62000001', 'NL151119001'),
('N62300001', 'NL151119001'),
('N62410001', 'NL151119001'),
('N62560001', 'NL151119001'),
('N62610001', 'NL151119001'),
('N62700001', 'NL151119001'),
('N61760001', 'NL151120001'),
('N61780001', 'NL151120001'),
('N61810001', 'NL151120001'),
('N61930001', 'NL151120001'),
('N61950001', 'NL151120001'),
('N61960001', 'NL151120001'),
('N62000001', 'NL151120001'),
('N62300001', 'NL151120001'),
('N62410001', 'NL151120001'),
('N62560001', 'NL151120001'),
('N62610001', 'NL151120001'),
('N62700001', 'NL151120001');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `nrp` varchar(9) NOT NULL,
  `nomor_registrasi_id` varchar(6) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kewarganegaraan` varchar(3) NOT NULL,
  `status_sosial` varchar(10) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `kodepos` varchar(5) NOT NULL,
  `nomor_hp` varchar(12) NOT NULL,
  `relasi` varchar(1) NOT NULL,
  `nama_wali` varchar(30) NOT NULL,
  `alamat_wali` varchar(50) NOT NULL,
  `provinsi_wali` varchar(30) NOT NULL,
  `kota_wali` varchar(30) NOT NULL,
  `nomor_telp_wali` varchar(12) NOT NULL,
  `pekerjaan_wali` varchar(30) NOT NULL,
  `status_perwalian` varchar(1) NOT NULL DEFAULT '0',
  `sks` smallint(3) unsigned NOT NULL DEFAULT '0',
  `ipk` varchar(5) NOT NULL DEFAULT '0',
  `semester` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `informasi_kurikulum_id` varchar(8) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nrp`, `nomor_registrasi_id`, `email`, `password`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `kewarganegaraan`, `status_sosial`, `agama`, `alamat`, `provinsi`, `kota`, `kodepos`, `nomor_hp`, `relasi`, `nama_wali`, `alamat_wali`, `provinsi_wali`, `kota_wali`, `nomor_telp_wali`, `pekerjaan_wali`, `status_perwalian`, `sks`, `ipk`, `semester`, `informasi_kurikulum_id`, `status`) VALUES
('213116176', 'fdse45', 'chinam@gmail.com', '123456', 'Chinam', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213116178', 'wertiu', 'andregozzidhy@gmail.com', '123456', 'Andre Gozzidhy', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213116181', 'kikio0', 'angelineizumi@gmail.com', '123456', 'Angeline Izumi', 'P', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213116193', 'qw5678', 'christianlimanto@gmail.com', '123456', 'Christian Limanto', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213116195', 'fe56ty', 'cynthiawangsawinata@gmail.com', '123456', 'Cynthia Wangsawinata', 'P', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213116196', 'wqw123', 'danielstelar@gmail.com', '123456', 'Daniel Stelar', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213116200', 'zx45mn', 'daniel@gmail.com', '123456', 'Daniel', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213116230', 'f6t75y', 'ivanderwilson@gmail.com', '123456', 'Ivander Wilson', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213116241', 'jjhy77', 'lukaskristanto@gmail.com', '123456', 'Lukas Kristanto', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213116249', 'd91o04', 'melanialani@gmail.com', '123456', 'Melania Laniwati', 'P', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213116256', '12po09', 'raymondwongso@gmail.com', '123456', 'Raymond Wongso Hartanto', 'L', 'Surabaya', '1995-11-02', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213116261', 'kli908', 'rickysaid@gmail.com', '123456', 'Ricky Said', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213116267', 'a7i4r1', 'stefanietanujaya@gmail.com', '123456', 'Stefanie Tanujaya', 'P', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213116268', 'jj876u', 'stefanuskurniawan@gmail.com', '123456', 'Stefanus Kurniawan', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213116270', 'kl09op', 'sugihartojohanes@gmail.com', '123456', 'Sugiharto Johanes', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213116278', 'gty564', 'yudhadarmawan@gmail.com', '123456', 'Yudha Darmawan', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1),
('213180292', 'fewq23', 'nancyyonata@gmail.com', '123456', 'Nancy Yonata', 'P', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 1, 'S1INF131', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE IF NOT EXISTS `mata_kuliah` (
  `id` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text,
  `semester` tinyint(2) unsigned NOT NULL,
  `jumlah_sks` tinyint(2) unsigned NOT NULL,
  `informasi_kurikulum_id` varchar(8) DEFAULT NULL,
  `lulus_minimal` varchar(2) NOT NULL,
  `berpraktikum` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id`, `nama`, `deskripsi`, `semester`, `jumlah_sks`, `informasi_kurikulum_id`, `lulus_minimal`, `berpraktikum`, `status`) VALUES
('MK001', 'Algoritma dan Programming', 'Alpro 1', 1, 3, 'S1INF131', 'C', 0, 1),
('MK002', 'Intro to Prgoramming', 'ITP', 1, 3, 'S1INF131', 'C', 1, 1),
('MK003', 'Internet dan World Wide Web', 'IWWW', 1, 3, 'S1INF131', 'C', 0, 1),
('MK004', 'Intro to Information Technology', 'IIT', 1, 3, 'S1INF131', 'C', 0, 1),
('MK005', 'Religion', 'Agama', 1, 3, 'S1INF131', 'C', 0, 1),
('MK006', 'Indonesian Language', 'BI', 1, 3, 'S1INF131', 'D', 0, 1),
('MK007', 'Algoritma dan Programming 2', 'Alpro 2', 2, 3, 'S1INF131', 'C', 0, 1),
('MK008', 'Pemrograman Visual', 'PV', 2, 3, 'S1INF131', 'C', 1, 1),
('MK009', 'Database', 'db', 2, 3, 'S1INF131', 'C', 1, 1),
('MK010', 'Computer Network', 'Jarkom', 2, 3, 'S1INF131', 'D', 0, 1),
('MK011', 'English', 'English', 2, 2, 'S1INF131', 'D', 0, 1),
('MK012', 'Logic Mathematics', 'LogMat', 2, 2, 'S1INF131', 'D', 0, 1),
('MK013', 'Mathematics', 'Mat', 2, 2, 'S1INF131', 'D', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id` varchar(9) NOT NULL,
  `uts` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `uas` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `tugas` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `nilai_akhir` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `nilai_akhir_grade` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `nilai_grade` varchar(2) NOT NULL DEFAULT 'E',
  `value_nilai_grade` tinyint(2) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `uts`, `uas`, `tugas`, `nilai_akhir`, `nilai_akhir_grade`, `nilai_grade`, `value_nilai_grade`) VALUES
('N61760001', 29, 100, 100, 79, 89, 'A', 0),
('N61780001', 49, 90, 30, 54, 64, 'C', 0),
('N61810001', 94, 80, 50, 72, 82, 'A', 0),
('N61930001', 59, 70, 60, 63, 73, 'C+', 0),
('N61950001', 19, 60, 70, 52, 62, 'C', 0),
('N61960001', 40, 50, 80, 59, 69, 'C', 0),
('N62000001', 49, 30, 90, 60, 70, 'C+', 0),
('N62300001', 39, 20, 100, 58, 68, 'C', 0),
('N62410001', 20, 10, 90, 45, 55, 'E', 0),
('N62560001', 0, 0, 0, 0, 10, 'E', 0),
('N62560002', 56, 40, 20, 56, 54, 'A', 0),
('N62560003', 65, 70, 0, 60, 65, 'C', 0),
('N62560004', 30, 40, 79, 53, 53, 'E', 0),
('N62560005', 0, 0, 0, 0, 0, 'T', 0),
('N62560006', 0, 0, 0, 0, 0, 'T', 0),
('N62560007', 0, 0, 0, 0, 0, 'T', 0),
('N62610001', 20, 10, 70, 37, 47, 'E', 0),
('N62670001', 0, 0, 0, 0, 0, 'E', 0),
('N62700001', 60, 50, 60, 57, 67, 'C', 0),
('N62700002', 0, 0, 0, 0, 0, 'T', 0),
('N62700003', 0, 0, 0, 0, 0, 'T', 0),
('N62700004', 0, 0, 0, 0, 0, 'T', 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_semester`
--

CREATE TABLE IF NOT EXISTS `nilai_semester` (
  `mahasiswa_nrp` varchar(9) NOT NULL,
  `semester` tinyint(2) unsigned NOT NULL,
  `ips` varchar(4) NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nomor_registrasi`
--

CREATE TABLE IF NOT EXISTS `nomor_registrasi` (
  `id` varchar(6) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = belum terpakai, 1 = sudah terpakai untuk registrasi'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nomor_registrasi`
--

INSERT INTO `nomor_registrasi` (`id`, `status`) VALUES
('12po09', 0),
('a7i4r1', 0),
('d91o04', 0),
('f6t75y', 0),
('fdse45', 0),
('fe56ty', 0),
('fewq23', 0),
('gty564', 0),
('jj876u', 0),
('jjhy77', 0),
('kikio0', 0),
('kl09op', 0),
('kli908', 0),
('qw5678', 0),
('wertiu', 0),
('wqw123', 0),
('zx45mn', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE IF NOT EXISTS `notifikasi` (
  `id` int(12) NOT NULL,
  `mahasiswa_nrp` varchar(9) DEFAULT NULL,
  `dosen_nip` varchar(11) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text,
  `tanggal_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_baca` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` varchar(15) NOT NULL,
  `jumlah` mediumint(8) unsigned NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `calon_mahasiswa_nomor_registrasi` varchar(6) NOT NULL,
  `mahasiswa_nrp` varchar(9) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  `status_lihat` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `jumlah`, `tanggal_bayar`, `calon_mahasiswa_nomor_registrasi`, `mahasiswa_nrp`, `status`, `status_lihat`) VALUES
('UPP201508010001', 3300000, '2015-08-10', '', '213116256', '1', '0'),
('UPP201508010002', 3300000, '2015-08-10', '', '213116270', '1', '0'),
('UPP201508010003', 3300000, '2015-08-10', '', '213116268', '1', '0'),
('UPP201510010001', 3300000, '2015-10-10', '', '213116256', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE IF NOT EXISTS `provinsi` (
  `id` varchar(6) NOT NULL,
  `nama` varchar(50) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE IF NOT EXISTS `ruangan` (
  `id` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kapasitas` int(3) DEFAULT '0',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama`, `kapasitas`, `status`) VALUES
('R0001', 'B100', 69, 1),
('R0002', 'B301', 40, 1),
('R0003', 'B302', 50, 1),
('R0004', 'B303', 60, 1),
('R0005', 'U101', 20, 1),
('R0006', 'U102', 20, 1),
('R0007', 'U301', 40, 1),
('R0008', 'U302', 40, 1),
('R0009', 'U303', 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `syarat_matakuliah`
--

CREATE TABLE IF NOT EXISTS `syarat_matakuliah` (
  `id_matakuliah` varchar(5) NOT NULL,
  `id_syarat_matakuliah` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE IF NOT EXISTS `tagihan` (
  `id` varchar(15) NOT NULL,
  `jumlah` mediumint(8) unsigned NOT NULL,
  `tanggal_batas` date NOT NULL,
  `calon_mahasiswa_nomor_registrasi` varchar(6) NOT NULL,
  `mahasiswa_nrp` varchar(9) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  `status_lihat` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id`, `jumlah`, `tanggal_batas`, `calon_mahasiswa_nomor_registrasi`, `mahasiswa_nrp`, `status`, `status_lihat`) VALUES
('UPP201508010001', 3300000, '2015-08-10', '', '213116256', '0', '0'),
('UPP201508010002', 3300000, '2015-08-10', '', '213116270', '0', '0'),
('UPP201508010003', 3300000, '2015-08-10', '', '213116268', '0', '0'),
('UPP201510010001', 3300000, '2015-10-10', '', '213116256', '0', '0'),
('UPP201510010002', 3300000, '2015-10-10', '', '213116270', '1', '0'),
('UPP201510010003', 3300000, '2015-10-10', '', '213116268', '1', '0'),
('UPP201512010001', 4800000, '2015-12-10', '', '213116256', '1', '0'),
('UPP201512010002', 4800000, '2015-12-10', '', '213116270', '1', '0'),
('UPP201512010003', 4200000, '2015-12-10', '', '213116268', '1', '0'),
('XPP201510010001', 3300000, '2015-10-20', '', '213116268', '1', '0'),
('XPP201510010002', 3300000, '2015-10-18', '', '213116270', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` varchar(9) NOT NULL DEFAULT '',
  `password` varchar(20) DEFAULT NULL,
  `peran` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `password`, `peran`) VALUES
('213116176', '123456', 'mahasiswa'),
('213116178', '123456', 'mahasiswa'),
('213116181', '123456', 'mahasiswa'),
('213116193', '123456', 'mahasiswa'),
('213116195', '123456', 'mahasiswa'),
('213116196', '123456', 'mahasiswa'),
('213116200', '123456', 'mahasiswa'),
('213116230', '123456', 'mahasiswa'),
('213116241', '123456', 'mahasiswa'),
('213116249', '123456', 'mahasiswa'),
('213116256', '123456', 'mahasiswa'),
('213116261', '123456', 'mahasiswa'),
('213116267', '123456', 'mahasiswa'),
('213116268', '123456', 'mahasiswa'),
('213116270', '123456', 'mahasiswa'),
('213116278', '123456', 'mahasiswa'),
('213180292', '123456', 'mahasiswa'),
('BAU01', 'baubau1', 'karyawan'),
('BAU02', 'baubau2', 'karyawan'),
('DO001', 'budibudi', 'dosen'),
('DO002', 'steste', 'dosen'),
('DO003', 'jngojngo', 'dosen_ketuabau');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beasiswa`
--
ALTER TABLE `beasiswa`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_beasiswa_informasi_beasiswa` (`informasi_beasiswa_nama_beasiswa`);

--
-- Indexes for table `calon_mahasiswa`
--
ALTER TABLE `calon_mahasiswa`
 ADD PRIMARY KEY (`nomor_registrasi_id`), ADD KEY `informasi_kurikulum_id` (`informasi_kurikulum_id`), ADD KEY `nomor_registrasi_id` (`nomor_registrasi_id`) USING BTREE;

--
-- Indexes for table `data_umum`
--
ALTER TABLE `data_umum`
 ADD PRIMARY KEY (`index`);

--
-- Indexes for table `dispensasi`
--
ALTER TABLE `dispensasi`
 ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
 ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `drevisi_penilaian`
--
ALTER TABLE `drevisi_penilaian`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_hrevisi_drevisi` (`hrevisi_penilaian_id`);

--
-- Indexes for table `hrevisi_penilaian`
--
ALTER TABLE `hrevisi_penilaian`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informasi_beasiswa`
--
ALTER TABLE `informasi_beasiswa`
 ADD PRIMARY KEY (`nama_beasiswa`);

--
-- Indexes for table `informasi_kurikulum`
--
ALTER TABLE `informasi_kurikulum`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_kelas_mata_kuliah` (`mata_kuliah_id`), ADD KEY `fk_kelas_ruangan` (`ruangan_id`), ADD KEY `fk_dosen_kelas` (`dosen_nip`), ADD KEY `fk_kelas_kelas` (`kelas_id`);

--
-- Indexes for table `kelas_mahasiswa`
--
ALTER TABLE `kelas_mahasiswa`
 ADD PRIMARY KEY (`mahasiswa_nrp`,`kelas_id`), ADD KEY `kelas_id` (`kelas_id`), ADD KEY `fk_kelas_mahasiswa_mata_kuliah` (`mata_kuliah_id`), ADD KEY `fk_kelas_mahasiswa_nilai` (`nilai_id`);

--
-- Indexes for table `kode_verifikasi`
--
ALTER TABLE `kode_verifikasi`
 ADD PRIMARY KEY (`id`), ADD KEY `nomor_registrasi_id` (`nomor_registrasi_id`) USING BTREE;

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
 ADD PRIMARY KEY (`id`), ADD KEY `provinsi_id` (`provinsi_id`) USING BTREE;

--
-- Indexes for table `log_penilaian`
--
ALTER TABLE `log_penilaian`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_penilaian_nilai`
--
ALTER TABLE `log_penilaian_nilai`
 ADD PRIMARY KEY (`nilai_id`,`log_penilaian_id`), ADD KEY `log_penilaian_id` (`log_penilaian_id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
 ADD PRIMARY KEY (`nrp`), ADD UNIQUE KEY `nomor_registrasi_id_2` (`nomor_registrasi_id`), ADD UNIQUE KEY `email` (`email`), ADD KEY `nomor_registrasi_id` (`nomor_registrasi_id`), ADD KEY `informasi_kurikulum_id` (`informasi_kurikulum_id`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_semester`
--
ALTER TABLE `nilai_semester`
 ADD PRIMARY KEY (`mahasiswa_nrp`,`semester`);

--
-- Indexes for table `nomor_registrasi`
--
ALTER TABLE `nomor_registrasi`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
 ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `syarat_matakuliah`
--
ALTER TABLE `syarat_matakuliah`
 ADD PRIMARY KEY (`id_matakuliah`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
 ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beasiswa`
--
ALTER TABLE `beasiswa`
ADD CONSTRAINT `fk_beasiswa_informasi_beasiswa` FOREIGN KEY (`informasi_beasiswa_nama_beasiswa`) REFERENCES `informasi_beasiswa` (`nama_beasiswa`) ON DELETE CASCADE;

--
-- Constraints for table `calon_mahasiswa`
--
ALTER TABLE `calon_mahasiswa`
ADD CONSTRAINT `fk_informasi_kurikulum_id_calon_mahasiswa` FOREIGN KEY (`informasi_kurikulum_id`) REFERENCES `informasi_kurikulum` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_nomor_registrasi_id_calon_mahasiswa` FOREIGN KEY (`nomor_registrasi_id`) REFERENCES `nomor_registrasi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `drevisi_penilaian`
--
ALTER TABLE `drevisi_penilaian`
ADD CONSTRAINT `fk_hrevisi_drevisi` FOREIGN KEY (`hrevisi_penilaian_id`) REFERENCES `hrevisi_penilaian` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
ADD CONSTRAINT `fk_dosen_kelas` FOREIGN KEY (`dosen_nip`) REFERENCES `dosen` (`nip`) ON DELETE CASCADE,
ADD CONSTRAINT `fk_kelas_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `fk_kelas_mata_kuliah` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mata_kuliah` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `fk_kelas_ruangan` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kelas_mahasiswa`
--
ALTER TABLE `kelas_mahasiswa`
ADD CONSTRAINT `fk_kelas_mahasiswa_mata_kuliah` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mata_kuliah` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `fk_kelas_mahasiswa_nilai` FOREIGN KEY (`nilai_id`) REFERENCES `nilai` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `kelas_mahasiswa_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `kelas_mahasiswa_ibfk_2` FOREIGN KEY (`mahasiswa_nrp`) REFERENCES `mahasiswa` (`nrp`) ON DELETE CASCADE;

--
-- Constraints for table `kode_verifikasi`
--
ALTER TABLE `kode_verifikasi`
ADD CONSTRAINT `fk_nomor_registrasi_id_kode_verifikasi` FOREIGN KEY (`nomor_registrasi_id`) REFERENCES `nomor_registrasi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kota`
--
ALTER TABLE `kota`
ADD CONSTRAINT `fk_provinsi_id_kota` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `log_penilaian_nilai`
--
ALTER TABLE `log_penilaian_nilai`
ADD CONSTRAINT `log_penilaian_nilai_ibfk_1` FOREIGN KEY (`nilai_id`) REFERENCES `nilai` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `log_penilaian_nilai_ibfk_2` FOREIGN KEY (`log_penilaian_id`) REFERENCES `log_penilaian` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
ADD CONSTRAINT `fk_informasi_kurikulum_id_mahasiswa` FOREIGN KEY (`informasi_kurikulum_id`) REFERENCES `informasi_kurikulum` (`id`),
ADD CONSTRAINT `fk_nomor_registrasi_id_mahasiswa` FOREIGN KEY (`nomor_registrasi_id`) REFERENCES `nomor_registrasi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nilai_semester`
--
ALTER TABLE `nilai_semester`
ADD CONSTRAINT `nilai_semester_ibfk_1` FOREIGN KEY (`mahasiswa_nrp`) REFERENCES `mahasiswa` (`nrp`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
