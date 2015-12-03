-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2015 at 06:12 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdp2015`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `beasiswa`
--

CREATE TABLE IF NOT EXISTS `beasiswa` (
  `id` varchar(15) NOT NULL,
  `informasi_beasiswa_nama_beasiswa` varchar(30) NOT NULL,
  `mahasiswa_nrp` varchar(9) NOT NULL,
  `tanggal_create` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `beasiswa`
--

INSERT INTO `beasiswa` (`id`, `informasi_beasiswa_nama_beasiswa`, `mahasiswa_nrp`, `tanggal_create`, `status`) VALUES
('BPP201508010001', 'Prestasi', '213116256', '2015-08-01', '1'),
('BPP201508010002', 'Prestasi', '213116267', '2015-08-01', '1'),
('BPP201508010003', 'Sosial Ekonomi', '213116270', '2015-08-01', '1'),
('BPP201508010004', 'Sosial Ekonomi', '213180292', '2015-08-01', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon_mahasiswa`
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
-- Dumping data untuk tabel `calon_mahasiswa`
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
-- Struktur dari tabel `data_umum`
--

CREATE TABLE IF NOT EXISTS `data_umum` (
  `index` varchar(50) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_umum`
--

INSERT INTO `data_umum` (`index`, `value`) VALUES
('lama_sks', '3000'),
('tahun_ajaran_sekarang', 'GENAP 2014/2015'),
('valnilai_A_to_IPK', '4.00'),
('valnilai_B+_to_IPK', '3.75'),
('valnilai_B_to_IPK', '3.50'),
('valnilai_C+_to_IPK', '3.25'),
('valnilai_C_to_IPK', '3.00'),
('valnilai_D_to_IPK', '2.00'),
('valnilai_E_to_IPK', '1.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dispensasi`
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
-- Struktur dari tabel `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `nip` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor_telepon` varchar(12) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `kepala_jurusan_id` varchar(8) DEFAULT NULL COMMENT 'mereference pada informasi_kurikulum_id ke 0 (belakangnya)',
  `jumlah_sks_mengajar` int(10) unsigned NOT NULL DEFAULT '0',
  `status` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `nomor_telepon`, `email`, `password`, `kepala_jurusan_id`, `jumlah_sks_mengajar`, `status`) VALUES
('DO001', 'Jaya Pranata,S.Kom', '087859038021', 'jaya@gmail.com', 'jaya', NULL, 0, '1'),
('DO002', 'Eka Rahayu Setyaningsih ,S.Kom., M.Kom.', '0317673023', 'eka@gmail.com', 'eka', NULL, 0, '1'),
('DO003', 'Jenny Ngo,Dr., M.Sc.Ed.', '031654654', 'jennyngo@gmail.com', 'jngojngo', NULL, 0, '1'),
('DO004', 'Edwin Pramana,Ir., M.AppSc.', '0384752132', 'edwin@stts.edu', 'edwin', 'S1INF150', 0, '1'),
('DO005', 'Arya Tandy Hermawan,Ir., M.T.', '038539283', 'arya@stts.edu', 'arya', NULL, 0, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `drevisi_penilaian`
--

CREATE TABLE IF NOT EXISTS `drevisi_penilaian` (
  `id` varchar(10) NOT NULL,
  `hrevisi_penilaian_id` varchar(9) NOT NULL,
  `mahasiswa_nrp` varchar(9) NOT NULL,
  `nilai_akhir_sebelum` tinyint(3) unsigned NOT NULL,
  `nilai_akhir_sesudah` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drevisi_penilaian`
--

INSERT INTO `drevisi_penilaian` (`id`, `hrevisi_penilaian_id`, `mahasiswa_nrp`, `nilai_akhir_sebelum`, `nilai_akhir_sesudah`) VALUES
('DNR1511001', 'NR1511001', '213116181', 35, 60),
('DNR1511002', 'NR1511001', '213116261', 52, 80),
('DNR1511003', 'NR1511001', '213116268', 0, 20),
('DNR1511004', 'NR1511002', '213116178', 72, 88),
('DNR1511005', 'NR1511002', '213116195', 91, 95),
('DNR1511006', 'NR1511002', '213116230', 56, 100);

-- --------------------------------------------------------

--
-- Stand-in structure for view `getgrade`
--
CREATE TABLE IF NOT EXISTS `getgrade` (
`mahasiswa_nrp` varchar(9)
,`nama` varchar(50)
,`nilai_grade` varchar(1)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hrevisi_penilaian`
--

CREATE TABLE IF NOT EXISTS `hrevisi_penilaian` (
  `id` varchar(9) NOT NULL,
  `kelas_id` varchar(6) NOT NULL,
  `catatan` text,
  `status_revisi` tinyint(1) NOT NULL,
  `tanggal_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrevisi_penilaian`
--

INSERT INTO `hrevisi_penilaian` (`id`, `kelas_id`, `catatan`, `status_revisi`, `tanggal_create`) VALUES
('NR1511001', 'K15001', 'Ganti Grade', 2, '2015-11-29 00:00:00'),
('NR1511002', 'K15001', 'Coba lagi\r\n', 0, '2015-11-29 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi_beasiswa`
--

CREATE TABLE IF NOT EXISTS `informasi_beasiswa` (
  `nama_beasiswa` varchar(30) NOT NULL,
  `aspek_dipotong` varchar(10) NOT NULL,
  `berapa_dipotong` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `informasi_beasiswa`
--

INSERT INTO `informasi_beasiswa` (`nama_beasiswa`, `aspek_dipotong`, `berapa_dipotong`) VALUES
('Kerja Sama', 'USP', 100),
('Minat Bakat', 'SPP', 6),
('PMB', 'USP', 25),
('Prestasi', 'SKS', 10),
('Sosial Ekonomi', 'SPP', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi_kurikulum`
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
-- Dumping data untuk tabel `informasi_kurikulum`
--

INSERT INTO `informasi_kurikulum` (`id`, `jurusan`, `tahun_angkatan`, `kategori`, `harga_usp`, `harga_spp`, `harga_sks`, `sks`) VALUES
('D3INF131', 'D3-Informatika', '2013/2014', 1, 7000000, 200000, 250000, 88),
('D3INF150', 'D3-Informatika', '2015/2016', 0, 0, 0, 0, 88),
('S1DKV131', 'S1-Desain Komunikasi Visual', '2013/2014', 1, 8000000, 175000, 200000, 144),
('S1DKV132', 'S1-Desain Komunikasi Visual', '2013/2014', 2, 9500000, 175000, 200000, 144),
('S1DKV133', 'S1-Desain Komunikasi Visual', '2013/2014', 3, 11000000, 175000, 200000, 144),
('S1DKV141', 'S1-Desain Komunikasi Visual', '2014/2015', 1, 9000000, 200000, 250000, 144),
('S1DKV142', 'S1-Desain Komunikasi Visual', '2014/2015', 2, 10500000, 200000, 250000, 144),
('S1DKV143', 'S1-Desain Komunikasi Visual', '2014/2015', 3, 12000000, 200000, 250000, 144),
('S1DKV150', 'S1-Desain Komunikasi Visual', '2015/2016', 0, 0, 0, 0, 144),
('S1INF131', 'S1-Informatika', '2013/2014', 1, 10000000, 250000, 300000, 144),
('S1INF132', 'S1-informatika', '2013/2014', 2, 12500000, 250000, 300000, 144),
('S1INF133', 'S1-Informatika', '2013/2014', 3, 15000000, 250000, 300000, 144),
('S1INF141', 'S1-Informatika', '2014/2015', 1, 11000000, 300000, 325000, 144),
('S1INF142', 'S1-Informatika', '2014/2015', 2, 13500000, 300000, 325000, 144),
('S1INF143', 'S1-Informatika', '2014/2015', 3, 16000000, 300000, 325000, 144),
('S1INF150', 'S1-Informatika', '2015/2016', 0, 0, 0, 0, 144),
('S1SIB131', 'S1-Sistem Informasi Bisnis', '2013/2014', 1, 9500000, 200000, 250000, 144),
('S1SIB132', 'S1-Sistem Informasi Bisnis', '2013/2014', 2, 11500000, 200000, 250000, 144),
('S1SIB133', 'S1-Sistem Informasi Bisnis', '2013/2014', 3, 13500000, 200000, 250000, 144),
('S1SIB141', 'S1-Sistem Informasi Bisnis', '2014/2015', 1, 10500000, 250000, 275000, 144),
('S1SIB142', 'S1-Sistem Informasi Bisnis', '2014/2015', 2, 12500000, 250000, 275000, 144),
('S1SIB143', 'S1-Sistem Informasi Bisnis', '2014/2015', 3, 14500000, 250000, 275000, 144),
('S1SIB150', 'S1-Sistem Informasi Bisnis', '2015/2016', 0, 0, 0, 0, 144);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id` varchar(9) NOT NULL,
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
  `jumlah_mahasiswa` int(3) unsigned NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `tanggal_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `mata_kuliah_id`, `ruangan_id`, `dosen_nip`, `hari`, `jam_mulai`, `persentase_uts`, `persentase_uas`, `persentase_tugas`, `tambahan_grade`, `status_konfirmasi`, `komentar_kajur`, `kelas_id`, `jumlah_mahasiswa`, `tahun_ajaran`, `tanggal_create`, `tanggal_update`, `status`) VALUES
('K15001', 'A', 'MK001', 'R0003', 'DO001', '1', '08:00:00', 30, 30, 40, 10, 3, 'Lain kali jangan sampai mayoritas kelas F', NULL, 0, 'GASAL 2014/2015', '2015-11-12 21:56:10', '2015-11-29 22:58:13', 1),
('K15002', 'B', 'MK001', 'R0004', 'DO002', '1', '08:30:00', 30, 30, 40, 0, 0, '', NULL, 0, 'GASAL 2014/2015', '2015-11-12 21:56:58', '2015-11-12 21:56:58', 1),
('K15003', 'A', 'MK003', 'R0008', 'DO003', '2', '13:00:00', 30, 30, 40, 0, 0, '', NULL, 0, 'GASAL 2014/2015', '2015-11-12 21:57:39', '2015-11-12 21:57:39', 1),
('K15004', 'B', 'MK003', 'R0006', 'DO001', '3', '13:00:00', 30, 30, 40, 20, 0, '', NULL, 0, 'GASAL 2014/2015', '2015-11-12 21:57:39', '2015-11-29 23:22:36', 1),
('K15005', '-', 'MK005', 'R0004', 'DO001', '4', '15:30:00', 30, 30, 40, 0, 0, '', NULL, 0, 'GASAL 2014/2015', '2015-11-12 21:58:53', '2015-11-29 23:12:45', 1),
('K15006', '-', 'MK005', NULL, NULL, NULL, '08:00:00', 30, 30, 40, 0, 0, '', 'K15005', 0, 'GASAL 2014/2015', '2015-11-12 21:58:53', '2015-11-12 21:58:53', 1),
('K15007', 'A', 'MK007', 'R0007', 'DO003', '2', '10:30:00', 30, 30, 40, 0, 0, '', NULL, 0, 'GENAP 2014/2015', '2015-11-12 21:59:24', '2015-11-12 21:59:24', 1),
('K15008', 'B', 'MK007', 'R0006', 'DO002', '2', '10:30:00', 30, 30, 40, 0, 0, '', NULL, 0, 'GENAP 2014/2015', '2015-11-12 21:59:24', '2015-11-12 21:59:24', 1),
('K15009', 'A', 'MK009', 'R0004', 'DO004', '2', '10:30:00', 30, 30, 40, 0, 0, '', NULL, 0, 'GENAP 2014/2015', '2015-11-12 21:59:56', '2015-11-12 21:59:56', 1),
('K15010', 'B', 'MK009', 'R0001', 'DO004', '3', '10:30:00', 30, 30, 40, 0, 0, '', NULL, 0, 'GENAP 2014/2015', '2015-11-12 21:59:56', '2015-11-12 21:59:56', 1),
('K15011', '-', 'MK011', 'R0009', 'DO001', '4', '13:00:00', 30, 30, 40, 0, 0, '', NULL, 0, 'GENAP 2014/2015', '2015-11-12 22:00:53', '2015-11-12 22:00:53', 1),
('K15012', '-', 'MK011', NULL, NULL, '5', '15:30:00', 30, 30, 40, 0, 0, '', 'K15011', 0, 'GENAP 2014/2015', '2015-11-12 22:00:53', '2015-11-12 22:00:53', 1),
('K15013', '-', 'MK011', NULL, NULL, '1', '15:30:00', 30, 30, 40, 0, 0, '', 'K15011', 0, 'GENAP 2014/2015', '2015-11-12 22:01:10', '2015-11-12 22:01:10', 1);


-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_mahasiswa`
--

CREATE TABLE IF NOT EXISTS `kelas_mahasiswa` (
  `mahasiswa_nrp` varchar(9) NOT NULL COMMENT 'NYY',
  `kelas_id` varchar(9) NOT NULL,
  `mata_kuliah_id` varchar(6) NOT NULL,
  `status_ambil` varchar(10) NOT NULL,
  `semester` tinyint(2) unsigned NOT NULL,
  `nilai_id` varchar(9) DEFAULT NULL COMMENT 'nilai sebenarnya'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='mahasiswa mengambil kelas';

--
-- Dumping data untuk tabel `kelas_mahasiswa`
--


INSERT INTO `kelas_mahasiswa` (`mahasiswa_nrp`, `kelas_id`, `mata_kuliah_id`, `status_ambil`, `semester`, `nilai_id`) VALUES
('213116176', 'K15001', 'MK001', 'A', 1, 'N6176001'),
('213116176', 'K15005', 'MK005', 'A', 1, 'N6176002'),
('213116178', 'K15001', 'MK001', 'A', 1, 'N6178001'),
('213116178', 'K15005', 'MK005', 'A', 1, 'N6178002'),
('213116181', 'K15001', 'MK001', 'A', 1, 'N6181001'),
('213116181', 'K15005', 'MK005', 'A', 1, 'N6181002'),
('213116193', 'K15001', 'MK001', 'A', 1, 'N6193001'),
('213116193', 'K15005', 'MK005', 'A', 1, 'N6193002'),
('213116195', 'K15001', 'MK001', 'A', 1, 'N6195001'),
('213116195', 'K15005', 'MK005', 'A', 1, 'N6195002'),
('213116196', 'K15001', 'MK001', 'A', 1, 'N6196001'),
('213116196', 'K15005', 'MK005', 'A', 1, 'N6196002'),
('213116200', 'K15001', 'MK001', 'A', 1, 'N6200001'),
('213116200', 'K15005', 'MK005', 'A', 1, 'N6200002'),
('213116230', 'K15001', 'MK001', 'A', 1, 'N6230001'),
('213116230', 'K15005', 'MK005', 'A', 1, 'N6230002'),
('213116241', 'K15001', 'MK001', 'A', 1, 'N6241001'),
('213116241', 'K15005', 'MK005', 'A', 1, 'N6241002'),
('213116249', 'K15004', 'MK003', 'A', 1, 'N6249001'),
('213116249', 'K15006', 'MK005', 'A', 1, 'N6249002'),
('213116256', 'K15004', 'MK003', 'A', 1, 'N6256001'),
('213116256', 'K15006', 'MK005', 'A', 1, 'N6256002'),
('213116261', 'K15004', 'MK003', 'd', 1, 'N6261001'),
('213116261', 'K15006', 'MK005', 'A', 1, 'N6261002'),
('213116267', 'K15004', 'MK003', 'A', 1, 'N6267001'),
('213116267', 'K15006', 'MK005', 'A', 1, 'N6267002'),
('213116268', 'K15004', 'MK003', 'A', 1, 'N6268001'),
('213116268', 'K15006', 'MK005', 'A', 1, 'N6268002'),
('213116270', 'K15004', 'MK003', 'A', 1, 'N6270001'),
('213116270', 'K15006', 'MK005', 'A', 1, 'N6270002'),
('213116278', 'K15004', 'MK003', 'A', 1, 'N6278001'),
('213116278', 'K15006', 'MK005', 'A', 1, 'N6278002'),
('213180292', 'K15006', 'MK005', 'A', 1, 'N0292001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_verifikasi`
--

CREATE TABLE IF NOT EXISTS `kode_verifikasi` (
  `id` varchar(6) NOT NULL COMMENT '6 digit angka kode verifikasi',
  `nomor_registrasi_id` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tanggal_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE IF NOT EXISTS `kota` (
  `id` varchar(6) NOT NULL,
  `provinsi_id` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id`, `provinsi_id`, `nama`) VALUES
('KO001', 'PRO01', 'banda aceh'),
('KO002', 'PRO01', 'langsa'),
('KO003', 'PRO01', 'lhokseumawe'),
('KO004', 'PRO01', 'sabang'),
('KO005', 'PRO01', 'sabulussalam'),
('KO006', 'PRO02', 'denpasar'),
('KO007', 'PRO03', 'cilegon'),
('KO008', 'PRO03', 'serang'),
('KO009', 'PRO03', 'tangerang'),
('KO010', 'PRO03', 'tangerang selatan'),
('KO011', 'PRO04', 'bengkulu'),
('KO012', 'PRO05', 'gorontalo'),
('KO013', 'PRO06', 'jakarta barat'),
('KO014', 'PRO06', 'jakarta pusat'),
('KO015', 'PRO06', 'jakarta selatan'),
('KO016', 'PRO06', 'jakarta timur'),
('KO017', 'PRO06', 'jakarta utara'),
('KO018', 'PRO07', 'jambi'),
('KO019', 'PRO07', 'sungai penuh'),
('KO020', 'PRO08', 'bandung'),
('KO021', 'PRO08', 'banjar'),
('KO022', 'PRO08', 'bekasi'),
('KO023', 'PRO08', 'bogor'),
('KO024', 'PRO08', 'cimahi'),
('KO025', 'PRO08', 'cirebon'),
('KO026', 'PRO08', 'depok'),
('KO027', 'PRO08', 'sukabumi'),
('KO028', 'PRO08', 'tasikmalaya'),
('KO029', 'PRO09', 'magelang'),
('KO030', 'PRO09', 'pekalongan'),
('KO031', 'PRO09', 'salatiga'),
('KO032', 'PRO09', 'semarang'),
('KO033', 'PRO09', 'surakarta'),
('KO034', 'PRO09', 'tegal'),
('KO035', 'PRO10', 'batu'),
('KO036', 'PRO10', 'blitar'),
('KO037', 'PRO10', 'kediri'),
('KO038', 'PRO10', 'madiun'),
('KO039', 'PRO10', 'malang'),
('KO040', 'PRO10', 'mojokerto'),
('KO041', 'PRO10', 'pasuruan'),
('KO042', 'PRO10', 'probolinggo'),
('KO043', 'PRO11', 'ketapang'),
('KO044', 'PRO11', 'mempawah'),
('KO045', 'PRO11', 'pontianak'),
('KO046', 'PRO11', 'sambas'),
('KO047', 'PRO11', 'sintang'),
('KO048', 'PRO11', 'singkawang'),
('KO049', 'PRO12', 'banjarbaru'),
('KO050', 'PRO12', 'banjarmasin'),
('KO051', 'PRO13', 'muara teweh'),
('KO052', 'PRO13', 'palangka raya'),
('KO053', 'PRO13', 'sampit'),
('KO054', 'PRO14', 'balikpapan'),
('KO055', 'PRO14', 'bontang'),
('KO056', 'PRO14', 'samarinda'),
('KO057', 'PRO15', 'tarakan'),
('KO058', 'PRO16', 'pangkal pinang'),
('KO059', 'PRO17', 'batam'),
('KO060', 'PRO17', 'tanjung pinang'),
('KO061', 'PRO18', 'bandar lampung'),
('KO062', 'PRO18', 'metro'),
('KO063', 'PRO19', 'ambon'),
('KO064', 'PRO19', 'tual'),
('KO065', 'PRO20', 'sofifi'),
('KO066', 'PRO20', 'ternate'),
('KO067', 'PRO20', 'tidore kepulauan'),
('KO068', 'PRO21', 'bima'),
('KO069', 'PRO21', 'mataram'),
('KO070', 'PRO22', 'kupang'),
('KO071', 'PRO23', 'jayapura'),
('KO072', 'PRO24', 'sorong'),
('KO073', 'PRO25', 'dumai'),
('KO074', 'PRO25', 'pekanbaru'),
('KO075', 'PRO26', 'mamuju'),
('KO076', 'PRO27', 'makassar'),
('KO077', 'PRO27', 'palopo'),
('KO078', 'PRO27', 'parepare'),
('KO079', 'PRO28', 'luwuk'),
('KO080', 'PRO28', 'palu'),
('KO081', 'PRO28', 'poso'),
('KO082', 'PRO28', 'yango'),
('KO083', 'PRO29', 'bau-bau'),
('KO084', 'PRO29', 'kendari'),
('KO085', 'PRO30', 'bitung'),
('KO086', 'PRO30', 'kotamobagu'),
('KO087', 'PRO30', 'manado'),
('KO088', 'PRO30', 'tomohon'),
('KO089', 'PRO34', 'yogyakarta'),
('KO090', 'PRO10', 'surabaya'),
('KOT91', 'PRO31', 'kabupaten asahan'),
('KOT92', 'PRO31', 'kabupaten batubara'),
('KOT93', 'PRO31', 'kabupaten dairi'),
('KOT94', 'PRO32', 'kabupaten banyuasin'),
('KOT95', 'PRO32', 'kabupaten empat lawang'),
('KOT96', 'PRO32', 'kabupaten lahat'),
('KOT97', 'PRO33', 'kabupaten agam'),
('KOT98', 'PRO33', 'kabupaten dharmasraya'),
('KOT99', 'PRO33', 'kabupaten kepulauan mentawai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_penilaian`
--

CREATE TABLE IF NOT EXISTS `log_penilaian` (
  `id` varchar(11) NOT NULL,
  `keterangan` text,
  `tanggal_create` datetime NOT NULL,
  `kelas_id` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_penilaian`
--

INSERT INTO `log_penilaian` (`id`, `keterangan`, `tanggal_create`, `kelas_id`) VALUES
('NL151129001', NULL, '2015-11-29 23:22:31', 'K15004');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_penilaian_nilai`
--

CREATE TABLE IF NOT EXISTS `log_penilaian_nilai` (
  `nilai_id` varchar(9) NOT NULL,
  `log_penilaian_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_penilaian_nilai`
--

INSERT INTO `log_penilaian_nilai` (`nilai_id`, `log_penilaian_id`) VALUES
('N6249001', 'NL151129001'),
('N6256001', 'NL151129001'),
('N6261001', 'NL151129001'),
('N6267001', 'NL151129001'),
('N6268001', 'NL151129001'),
('N6270001', 'NL151129001'),
('N6278001', 'NL151129001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `nrp` varchar(9) NOT NULL,
  `nomor_registrasi_id` varchar(6) NOT NULL,
  `nip_dosen` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
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
  `dosen_nip` varchar(5) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nrp`, `nomor_registrasi_id`, `email`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `kewarganegaraan`, `status_sosial`, `agama`, `alamat`, `provinsi`, `kota`, `kodepos`, `nomor_hp`, `relasi`, `nama_wali`, `alamat_wali`, `provinsi_wali`, `kota_wali`, `nomor_telp_wali`, `pekerjaan_wali`, `status_perwalian`, `sks`, `ipk`, `semester`, `informasi_kurikulum_id`, `dosen_nip`, `status`) VALUES
('213116176', 'fdse45', 'chinam@gmail.com', 'Chinam', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '1', 5, 'S1INF131', '', 1),
('213116178', 'wertiu', 'andregozzidhy@gmail.com', 'Andre Gozzidhy', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '2', 5, 'S1INF131', '', 1),
('213116181', 'kikio0', 'angelineizumi@gmail.com', 'Angeline Izumi', 'P', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0.5', 5, 'S1INF131', '', 1),
('213116193', 'qw5678', 'christianlimanto@gmail.com', 'Christian Limanto', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '2', 5, 'S1INF131', '', 1),
('213116195', 'fe56ty', 'cynthiawangsawinata@gmail.com', 'Cynthia Wangsawinata', 'P', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '2', 5, 'S1INF131', '', 1),
('213116196', 'wqw123', 'danielstelar@gmail.com', 'Daniel Stelar', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '2', 5, 'S1INF131', '', 1),
('213116200', 'zx45mn', 'daniel@gmail.com', 'Daniel', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '1.5', 5, 'S1INF131', '', 1),
('213116230', 'f6t75y', 'ivanderwilson@gmail.com', 'Ivander Wilson', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '1', 5, 'S1INF131', '', 1),
('213116241', 'jjhy77', 'lukaskristanto@gmail.com', 'Lukas Kristanto', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '2', 5, 'S1INF131', '', 1),
('213116249', 'd91o04', 'melanialani@gmail.com', 'Melania Laniwati', 'P', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 5, 'S1INF131', '', 1),
('213116256', '12po09', 'raymondwongso@gmail.com', 'Raymond Wongso Hartanto', 'L', 'Surabaya', '1995-11-02', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 5, 'S1INF131', '', 1),
('213116261', 'kli908', 'rickysaid@gmail.com', 'Ricky Said', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 5, 'S1INF131', '', 1),
('213116267', 'a7i4r1', 'stefanietanujaya@gmail.com', 'Stefanie Tanujaya', 'P', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 5, 'S1INF131', '', 1),
('213116268', 'jj876u', 'stefanuskurniawan@gmail.com', 'Stefanus Kurniawan', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 5, 'S1INF131', '', 1),
('213116270', 'kl09op', 'sugihartojohanes@gmail.com', 'Sugiharto Johanes', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 5, 'S1INF131', '', 1),
('213116278', 'gty564', 'yudhadarmawan@gmail.com', 'Yudha Darmawan', 'L', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 5, 'S1INF131', '', 1),
('213180292', 'fewq23', 'nancyyonata@gmail.com', 'Nancy Yonata', 'P', 'Surabaya', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 0, '0', 5, 'S1INF131', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_kuliah`
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
  `major` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mata_kuliah`
--


INSERT INTO `mata_kuliah` (`id`, `nama`, `deskripsi`, `semester`, `jumlah_sks`, `informasi_kurikulum_id`, `lulus_minimal`, `berpraktikum`, `major`, `status`) VALUES
('MK001', 'Algoritma dan Programming', 'Alpro 1', 1, 3, 'S1INF131', 'C', 0, '', 1),
('MK002', 'Intro to Programming', 'ITP', 1, 3, 'S1INF131', 'C', 1, '', 1),
('MK003', 'Internet dan World Wide Web', 'IWWW', 1, 3, 'S1INF131', 'C', 0, '', 1),
('MK004', 'Intro to Information Technology', 'IIT', 1, 3, 'S1INF131', 'C', 0, '', 1),
('MK005', 'Religion', 'Agama', 1, 3, 'S1INF131', 'C', 0, '', 1),
('MK006', 'Indonesian Language', 'BI', 1, 3, 'S1INF131', 'D', 0, '', 1),
('MK007', 'Algoritma dan Programming 2', 'Alpro 2', 2, 3, 'S1INF131', 'C', 0, '', 1),
('MK008', 'Pemrograman Visual', 'PV', 2, 3, 'S1INF131', 'C', 1, '', 1),
('MK009', 'Database', 'db', 2, 3, 'S1INF131', 'C', 1, '', 1),
('MK010', 'Computer Network', 'Jarkom', 2, 3, 'S1INF131', 'D', 0, '', 1),
('MK011', 'English', 'English', 2, 2, 'S1INF131', 'D', 0, '', 1),
('MK012', 'Logic Mathematics', 'LogMat', 2, 2, 'S1INF131', 'D', 0, '', 1),
('MK013', 'Mathematics', 'Mat', 2, 2, 'S1INF131', 'D', 0, '', 1),
('MK014', 'ICT Global Trend', NULL, 1, 3, 'S1SIB131', 'C', 0, '', 1),
('MK015', 'Matematika Bisnis', NULL, 1, 3, 'S1SIB131', 'D', 0, '', 1),
('MK016', 'Analisa dan Desain Sistem', 'ADS', 3, 3, 'S1INF131', 'C', 0, '', 1),
('MK017', 'Interaksi Manusia dan Komputer', 'IMK', 5, 3, 'S1INF131', 'D', 0, '', 1),
('MK018', 'Struktur Data', 'Strukdat', 3, 3, 'S1INF131', 'C', 0, '', 1),
('MK019', 'Framework Aplikasi Internet', 'FAI', 5, 3, 'S1INF131', 'C', 1, '', 1);


-- --------------------------------------------------------

--
-- Struktur dari tabel `merger`
--

CREATE TABLE IF NOT EXISTS `merger` (
  `jurusan` varchar(8) NOT NULL,
  `kode` int(11) NOT NULL,
  `Nama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
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
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id`, `uts`, `uas`, `tugas`, `nilai_akhir`, `nilai_akhir_grade`, `nilai_grade`, `value_nilai_grade`) VALUES
('N0292001', 30, 0, 0, 9, 9, 'F', 0),
('N0292002', 0, 0, 0, 0, 0, 'T', 0),
('N0292003', 0, 0, 0, 0, 0, 'T', 0),
('N0292004', 0, 0, 0, 0, 0, 'T', 0),
('N6176001', 89, 57, 30, 56, 66, 'D', 6),
('N6176002', 0, 0, 0, 0, 0, 'F', 0),
('N6176003', 0, 0, 0, 0, 0, 'T', 0),
('N6176004', 0, 0, 0, 0, 0, 'T', 0),
('N6178001', 100, 100, 29, 72, 82, 'A', 12),
('N6178002', 0, 0, 0, 0, 0, 'F', 0),
('N6178003', 0, 0, 0, 0, 0, 'T', 0),
('N6178004', 0, 0, 0, 0, 0, 'T', 0),
('N6181001', 20, 29, 50, 35, 60, 'E', 3),
('N6181002', 0, 0, 0, 0, 0, 'F', 0),
('N6181003', 0, 0, 0, 0, 0, 'T', 0),
('N6181004', 0, 0, 0, 0, 0, 'T', 0),
('N6193001', 40, 80, 100, 76, 86, 'A', 12),
('N6193002', 0, 0, 0, 0, 0, 'F', 0),
('N6193003', 0, 0, 0, 0, 0, 'T', 0),
('N6193004', 0, 0, 0, 0, 0, 'T', 0),
('N6195001', 100, 69, 100, 91, 100, 'A', 12),
('N6195002', 0, 0, 0, 0, 0, 'F', 0),
('N6195003', 0, 0, 0, 0, 0, 'T', 0),
('N6195004', 0, 0, 0, 0, 0, 'T', 0),
('N6196001', 29, 29, 69, 45, 55, 'F', 12),
('N6196002', 0, 0, 0, 0, 0, 'F', 0),
('N6196003', 0, 0, 0, 0, 0, 'T', 0),
('N6196004', 0, 0, 0, 0, 0, 'T', 0),
('N6200001', 76, 69, 49, 63, 73, 'C', 9),
('N6200002', 0, 0, 0, 0, 0, 'F', 0),
('N6200003', 0, 0, 0, 0, 0, 'T', 0),
('N6200004', 0, 0, 0, 0, 0, 'T', 0),
('N6230001', 100, 49, 29, 56, 66, 'D', 6),
('N6230002', 0, 0, 0, 0, 0, 'F', 0),
('N6230003', 0, 0, 0, 0, 0, 'T', 0),
('N6230004', 0, 0, 0, 0, 0, 'T', 0),
('N6241001', 100, 29, 100, 79, 89, 'A', 12),
('N6241002', 0, 0, 0, 0, 0, 'F', 0),
('N6241003', 0, 0, 0, 0, 0, 'T', 0),
('N6241004', 0, 0, 0, 0, 0, 'T', 0),
('N6249001', 80, 91, 98, 91, 100, 'A', 0),
('N6249002', 0, 0, 0, 0, 0, 'F', 0),
('N6249003', 0, 0, 0, 0, 0, 'T', 0),
('N6249004', 0, 0, 0, 0, 0, 'T', 0),
('N6256001', 95, 75, 92, 88, 100, 'A', 0),
('N6256002', 0, 0, 0, 0, 0, 'F', 0),
('N6256003', 0, 0, 0, 0, 0, 'T', 0),
('N6256004', 0, 0, 0, 0, 0, 'T', 0),
('N6261001', 46, 54, 54, 52, 72, 'C', 0),
('N6261002', 0, 0, 0, 0, 0, 'F', 0),
('N6261003', 0, 0, 0, 0, 0, 'T', 0),
('N6261004', 0, 0, 0, 0, 0, 'T', 0),
('N6267001', 85, 45, 65, 65, 85, 'A', 0),
('N6267002', 0, 0, 0, 0, 0, 'F', 0),
('N6267003', 0, 0, 0, 0, 0, 'T', 0),
('N6267004', 0, 0, 0, 0, 0, 'T', 0),
('N6268001', 85, 90, 84, 86, 100, 'A', 0),
('N6268002', 0, 0, 0, 0, 0, 'F', 0),
('N6268003', 0, 0, 0, 0, 0, 'T', 0),
('N6268004', 0, 0, 0, 0, 0, 'T', 0),
('N6270001', 50, 68, 58, 59, 79, 'B', 0),
('N6270002', 50, 0, 0, 15, 15, 'F', 0),
('N6270003', 0, 0, 0, 0, 0, 'T', 0),
('N6270004', 0, 0, 0, 0, 0, 'T', 0),
('N6278001', 57, 102, 58, 71, 91, 'A', 0),
('N6278002', 25, 0, 0, 8, 8, 'F', 0),
('N6278003', 0, 0, 0, 0, 0, 'T', 0),
('N6278004', 0, 0, 0, 0, 0, 'T', 0);

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

--
-- Dumping data for table `nilai_semester`
--

INSERT INTO `nilai_semester` (`mahasiswa_nrp`, `semester`, `ips`, `tahun_ajaran`) VALUES
('213116176', 1, '1', 'GASAL 2014/2015'),
('213116178', 1, '2', 'GASAL 2014/2015'),
('213116181', 1, '0.5', 'GASAL 2014/2015'),
('213116193', 1, '2', 'GASAL 2014/2015'),
('213116195', 1, '2', 'GASAL 2014/2015'),
('213116196', 1, '2', 'GASAL 2014/2015'),
('213116200', 1, '1.5', 'GASAL 2014/2015'),
('213116230', 1, '1', 'GASAL 2014/2015'),
('213116241', 1, '2', 'GASAL 2014/2015');


-- --------------------------------------------------------

--
-- Struktur dari tabel `nomor_registrasi`
--

CREATE TABLE IF NOT EXISTS `nomor_registrasi` (
  `id` varchar(6) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = belum terpakai, 1 = sudah terpakai untuk registrasi'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nomor_registrasi`
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
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE IF NOT EXISTS `notifikasi` (
  `id` int(12) NOT NULL,
  `mahasiswa_nrp` varchar(9) DEFAULT NULL,
  `dosen_nip` varchar(11) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text,
  `tanggal_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_baca` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `mahasiswa_nrp`, `dosen_nip`, `judul`, `isi`, `tanggal_create`, `status_baca`) VALUES
(1, '213116241', 'DO001', 'Pemberitahuan Perwalian', 'Perwalian anda ditolak, harap menemui Saya secepatnya', '2015-11-29 16:40:39', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
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
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `jumlah`, `tanggal_bayar`, `calon_mahasiswa_nomor_registrasi`, `mahasiswa_nrp`, `status`, `status_lihat`) VALUES
('UPP201508010001', 3300000, '2015-08-10', '', '213116256', '1', '0'),
('UPP201508010002', 3300000, '2015-08-10', '', '213116270', '1', '0'),
('UPP201508010003', 3300000, '2015-08-10', '', '213116268', '1', '0'),
('UPP201510010001', 3300000, '2015-10-10', '', '213116256', '1', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE IF NOT EXISTS `provinsi` (
  `id` varchar(6) NOT NULL,
  `nama` varchar(50) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `nama`) VALUES
('PRO01', 'aceh'),
('PRO02', 'bali'),
('PRO03', 'banten'),
('PRO04', 'bengkulu'),
('PRO05', 'gorontalo'),
('PRO06', 'DKI jakarta'),
('PRO07', 'jambi'),
('PRO08', 'jawa barat'),
('PRO09', 'jawa tengah'),
('PRO10', 'jawa timur'),
('PRO11', 'kalimantan barat'),
('PRO12', 'kalimantan selatan'),
('PRO13', 'kalimantan tengah'),
('PRO14', 'kalimantan timur'),
('PRO15', 'kalimantan utara'),
('PRO16', 'kepulauan bangka belitung'),
('PRO17', 'kepulauan riau'),
('PRO18', 'lampung'),
('PRO19', 'maluku'),
('PRO20', 'maluku utara'),
('PRO21', 'nusa tenggara barat'),
('PRO22', 'nusa tenggara timur'),
('PRO23', 'papua'),
('PRO24', 'papua barat'),
('PRO25', 'riau'),
('PRO26', 'sulawesi barat'),
('PRO27', 'sulawesi selatan'),
('PRO28', 'sulawesi tengah'),
('PRO29', 'sulawesi tenggara'),
('PRO30', 'sulawesi utara'),
('PRO31', 'sumatera barat'),
('PRO32', 'sumatera selatan'),
('PRO33', 'sumatera utara'),
('PRO34', 'daerah istimewa yogyakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE IF NOT EXISTS `ruangan` (
  `id` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kapasitas` int(3) DEFAULT '0',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ruangan`
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
-- Struktur dari tabel `syarat_matakuliah`
--

CREATE TABLE IF NOT EXISTS `syarat_matakuliah` (
  `id_matakuliah` varchar(5) NOT NULL,
  `id_syarat_matakuliah` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `syarat_matakuliah`
--

INSERT INTO `syarat_matakuliah` (`id_matakuliah`, `id_syarat_matakuliah`) VALUES
('MK007', 'MK001'),
('MK008', 'MK001'),
('MK008', 'MK002'),
('MK017', 'MK002'),
('MK015', 'MK004'),
('MK014', 'MK007'),
('MK020', 'MK008'),
('MK016', 'MK009'),
('MK020', 'MK009'),
('MK019', 'MK013'),
('MK024', 'MK014'),
('MK029', 'MK014'),
('MK021', 'MK016'),
('MK032', 'MK021'),
('MK037', 'MK029'),
('MK029', 'MK031'),
('MK040', 'MK031'),
('MK039', 'MK032');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
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
-- Dumping data untuk tabel `tagihan`
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
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` varchar(9) NOT NULL DEFAULT '',
  `password` varchar(20) DEFAULT NULL,
  `peran` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
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
('DO003', 'jngojngo', 'dosen_ketuabau'),
('DO004', 'edwin', 'dosen');

-- --------------------------------------------------------

--
-- Struktur untuk view `getgrade`
--
DROP TABLE IF EXISTS `getgrade`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getgrade` AS select `kelas_mahasiswa`.`mahasiswa_nrp` AS `mahasiswa_nrp`,`mata_kuliah`.`nama` AS `nama`,`nilai`.`nilai_grade` AS `nilai_grade` from ((`nilai` join `kelas_mahasiswa`) join `mata_kuliah`) where ((`kelas_mahasiswa`.`nilai_id` = `nilai`.`id`) and (`kelas_mahasiswa`.`mata_kuliah_id` = `mata_kuliah`.`id`));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beasiswa`
--
ALTER TABLE `beasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_beasiswa_informasi_beasiswa` (`informasi_beasiswa_nama_beasiswa`);

--
-- Indexes for table `calon_mahasiswa`
--
ALTER TABLE `calon_mahasiswa`
  ADD PRIMARY KEY (`nomor_registrasi_id`),
  ADD KEY `informasi_kurikulum_id` (`informasi_kurikulum_id`),
  ADD KEY `nomor_registrasi_id` (`nomor_registrasi_id`) USING BTREE;

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hrevisi_drevisi` (`hrevisi_penilaian_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kelas_mata_kuliah` (`mata_kuliah_id`),
  ADD KEY `fk_kelas_ruangan` (`ruangan_id`),
  ADD KEY `fk_dosen_kelas` (`dosen_nip`),
  ADD KEY `fk_kelas_kelas` (`kelas_id`);

--
-- Indexes for table `kelas_mahasiswa`
--
ALTER TABLE `kelas_mahasiswa`
  ADD PRIMARY KEY (`mahasiswa_nrp`,`kelas_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `fk_kelas_mahasiswa_mata_kuliah` (`mata_kuliah_id`),
  ADD KEY `fk_kelas_mahasiswa_nilai` (`nilai_id`);

--
-- Indexes for table `kode_verifikasi`
--
ALTER TABLE `kode_verifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nomor_registrasi_id` (`nomor_registrasi_id`) USING BTREE;

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provinsi_id` (`provinsi_id`) USING BTREE;

--
-- Indexes for table `log_penilaian`
--
ALTER TABLE `log_penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_penilaian_nilai`
--
ALTER TABLE `log_penilaian_nilai`
  ADD PRIMARY KEY (`nilai_id`,`log_penilaian_id`),
  ADD KEY `log_penilaian_id` (`log_penilaian_id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nrp`),
  ADD UNIQUE KEY `nomor_registrasi_id_2` (`nomor_registrasi_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `nomor_registrasi_id` (`nomor_registrasi_id`),
  ADD KEY `informasi_kurikulum_id` (`informasi_kurikulum_id`);

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
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
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
  ADD PRIMARY KEY (`id_matakuliah`,`id_syarat_matakuliah`),
  ADD KEY `id_syarat_matakuliah` (`id_syarat_matakuliah`),
  ADD KEY `id_syarat_matakuliah_2` (`id_syarat_matakuliah`),
  ADD KEY `id_syarat_matakuliah_3` (`id_syarat_matakuliah`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `beasiswa`
--
ALTER TABLE `beasiswa`
  ADD CONSTRAINT `fk_beasiswa_informasi_beasiswa` FOREIGN KEY (`informasi_beasiswa_nama_beasiswa`) REFERENCES `informasi_beasiswa` (`nama_beasiswa`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `calon_mahasiswa`
--
ALTER TABLE `calon_mahasiswa`
  ADD CONSTRAINT `fk_informasi_kurikulum_id_calon_mahasiswa` FOREIGN KEY (`informasi_kurikulum_id`) REFERENCES `informasi_kurikulum` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nomor_registrasi_id_calon_mahasiswa` FOREIGN KEY (`nomor_registrasi_id`) REFERENCES `nomor_registrasi` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `drevisi_penilaian`
--
ALTER TABLE `drevisi_penilaian`
  ADD CONSTRAINT `fk_hrevisi_drevisi` FOREIGN KEY (`hrevisi_penilaian_id`) REFERENCES `hrevisi_penilaian` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `fk_dosen_kelas` FOREIGN KEY (`dosen_nip`) REFERENCES `dosen` (`nip`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_kelas_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_kelas_mata_kuliah` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mata_kuliah` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_kelas_ruangan` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas_mahasiswa`
--
ALTER TABLE `kelas_mahasiswa`
ADD CONSTRAINT `fk_kelas_mahasiswa_mata_kuliah` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mata_kuliah` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `fk_kelas_mahasiswa_nilai` FOREIGN KEY (`nilai_id`) REFERENCES `nilai` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `kelas_mahasiswa_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `kelas_mahasiswa_ibfk_2` FOREIGN KEY (`mahasiswa_nrp`) REFERENCES `mahasiswa` (`nrp`) ON DELETE CASCADE;


--
-- Ketidakleluasaan untuk tabel `kode_verifikasi`
--
ALTER TABLE `kode_verifikasi`
  ADD CONSTRAINT `fk_nomor_registrasi_id_kode_verifikasi` FOREIGN KEY (`nomor_registrasi_id`) REFERENCES `nomor_registrasi` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD CONSTRAINT `fk_provinsi_id_kota` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsi` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_penilaian_nilai`
--
ALTER TABLE `log_penilaian_nilai`
  ADD CONSTRAINT `log_penilaian_nilai_ibfk_1` FOREIGN KEY (`nilai_id`) REFERENCES `nilai` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `log_penilaian_nilai_ibfk_2` FOREIGN KEY (`log_penilaian_id`) REFERENCES `log_penilaian` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
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
