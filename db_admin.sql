-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 02:33 PM
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
-- Database: `db_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `kodeabsen` varchar(20) NOT NULL,
  `tglabsen` date NOT NULL,
  `nis` int(11) NOT NULL,
  `keterangan` varchar(10) NOT NULL,
  `idagenda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_agenda`
--

CREATE TABLE `tb_agenda` (
  `idagenda` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_ke` int(2) NOT NULL,
  `kodekelas` varchar(15) NOT NULL,
  `idkd` int(11) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `nip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `nip` varchar(30) NOT NULL,
  `kodeguru` varchar(10) DEFAULT NULL,
  `namaguru` varchar(50) NOT NULL,
  `jeniskelamin` varchar(15) NOT NULL,
  `tempatlahir` varchar(25) DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `alamatguru` varchar(80) DEFAULT NULL,
  `notelpseluler` char(15) DEFAULT NULL,
  `emailguru` varchar(30) DEFAULT NULL,
  `kodejurusan` char(10) NOT NULL,
  `iduser` int(11) DEFAULT NULL,
  `tglperbaharui` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`nip`, `kodeguru`, `namaguru`, `jeniskelamin`, `tempatlahir`, `tgllahir`, `alamatguru`, `notelpseluler`, `emailguru`, `kodejurusan`, `iduser`, `tglperbaharui`, `is_active`) VALUES
('11111', 'ARF', 'Ust. Arifin, S.Pd.I', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11112', 'EVI', 'Evi Apriyanti, S.Pd.I', 'Perempuan', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11113', 'MD', 'Merda Budi H, S.IP., M.M.', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11114', 'YU', 'Yuyun Yuniasih, S.Pd. MM.', 'Perempuan', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11115', 'ZF', 'Zafar Sidik, S.Pd., S.IP., M.M', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11116', 'NI', 'Novi Indriyani, S.Pd', 'Perempuan', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11117', 'PY', 'Panji Yusuf, SS.', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11118', 'ARYO', 'Moch. Aryo, S.Pd', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11119', 'DP', 'Deri Prayoga, S.Pd', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11120', 'DS', 'Dedi Sopyandi, S.Pd', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11121', 'IRF', 'Irfan Abdurrahman, M.Pd', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11122', 'WIN', 'Winekas, S.Pd', 'Perempuan', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11123', 'GAL', 'Galih Nidiasari', 'Perempuan', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11124', 'RAT', 'Ratna Siti Nurhayati, S.Pd', 'Perempuan', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11125', 'ANN', 'Anna Rachmawati, S.Pd', 'Perempuan', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11126', 'AS', 'Ahmad Sandi, S.Pd', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11127', 'RIS', 'Rismat Maulana, S.Pd', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11128', 'EJ', 'Neneng Jajah, S.Pd', 'Perempuan', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11129', 'AGS', 'Agustina C Juwita, M.Pd', 'Perempuan', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11130', 'SRI', 'Sri Nuraeni, S.Pd', 'Perempuan', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11131', 'JB', ' Juli Budi Satya, S.Ip., M.Si', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'OTKP', NULL, '2020-12-28 04:40:34', 1),
('11132', 'IM', ' Imas Nurhasanah, S.Pd., M.Si', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'OTKP', NULL, '2020-12-28 04:40:34', 1),
('11133', 'OP', 'Opick Satriayi, S.Pd', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'OTKP', NULL, '2020-12-28 04:40:34', 1),
('11134', 'ELENA', 'Elenna', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'OTKP', NULL, '2020-12-28 04:40:34', 1),
('11135', 'RD', 'Rida Junita, SE', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'OTKP', NULL, '2020-12-28 04:40:34', 1),
('11136', 'DIANA', 'Radiana Ambarsari, SE', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'OTKP', NULL, '2020-12-28 04:40:34', 1),
('11137', 'DD', ' Dadang Hidayat, S.E., M.M', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'OTKP', NULL, '2020-12-28 04:40:34', 1),
('11138', 'DS', 'Desi Tri Pratiwi, S.Pd', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'OTKP', NULL, '2020-12-28 04:40:34', 1),
('11139', 'JKR', 'Jakaria, S.Pd., M.Si', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'OTKP', NULL, '2020-12-28 04:40:34', 1),
('11140', 'ZL', 'Zain Lisa, SE, MM', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'AKL', NULL, '2020-12-28 04:40:34', 1),
('11141', 'SW', 'Sri Wulan, SE', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'AKL', NULL, '2020-12-28 04:40:34', 1),
('11142', 'RAY', 'Raya Nurfala, S.Pd', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'AKL', NULL, '2020-12-28 04:40:34', 1),
('11143', 'HER', 'Heri Setiawan, S.Pd', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'AKL', NULL, '2020-12-28 04:40:34', 1),
('11144', 'ERICK', 'Erick Andika, M.Kom', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'TKJ', NULL, '2020-12-28 04:40:34', 1),
('11145', 'AZIS', 'Azis Sumadullah, A.Md.Kom', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'TKJ', NULL, '2020-12-28 04:40:34', 1),
('11146', 'SANDI', 'Sandi Putra Cahya Permadi, A.Md.Kom', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'TKJ', NULL, '2020-12-28 04:40:34', 1),
('11147', 'IH', 'Ihsan, S.Kom', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'RPL', NULL, '2020-12-28 04:40:34', 1),
('11148', 'WK', 'Weli Kusnadi, S.Kom, M.Kom', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'RPL', NULL, '2020-12-28 04:40:34', 1),
('11149', 'RI', 'Riki Iskandar', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'RPL', NULL, '2020-12-28 04:40:34', 1),
('11150', 'LUT', 'Lufti M Yassin, S.Pd', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'PSPT', NULL, '2020-12-28 04:40:34', 1),
('11151', 'SAM', 'Samwiel A. Nugraha, S.Pd', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'PSPT', NULL, '2020-12-28 04:40:34', 1),
('11152', 'TE', 'Tatang Erwanto', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'PSPT', NULL, '2020-12-28 04:40:34', 1),
('11153', 'AGUS', 'Agus Permana, SM', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'PSPT', NULL, '2020-12-28 04:40:34', 1),
('11154', 'ADIT', 'Adit Bahrun Nur Pratama, S.Kom', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'PSPT', NULL, '2020-12-28 04:40:34', 1),
('11155', 'NILA', 'Nila Natalia', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'ANM', NULL, '2020-12-28 04:40:34', 1),
('11156', 'AN', 'Moch. Asep Nazmudin, S.Kom', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'ANM', NULL, '2020-12-28 04:40:34', 1),
('11157', 'IKH', 'Ikhsan Fikri Salmi, S.Ds', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'ANM', NULL, '2020-12-28 04:40:34', 1),
('11158', 'SP', 'Septiawan', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'ANM', NULL, '2020-12-28 04:40:34', 1),
('11159', 'NDEN', 'Nenden Muslihat', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'ANM', NULL, '2020-12-28 04:40:34', 1),
('11160', 'DY', 'Dinny Yulanda, P.Si', 'Perempuan', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11161', 'MF', 'M Fiuji Hardiansyah', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1),
('11162', 'JM', 'Joko Mulyantoro, S.Pd', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, '-', NULL, '2020-12-28 04:40:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `kodejurusan` char(10) NOT NULL,
  `namajurusan` varchar(50) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `iduser` int(11) NOT NULL,
  `tglperbaharui` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`kodejurusan`, `namajurusan`, `nip`, `iduser`, `tglperbaharui`) VALUES
('AKL', 'Akuntansi dan Keuangan Lembaga', '11143', 1, '2020-12-28 04:49:35'),
('ANM', 'Animasi', '11157', 1, '2020-12-28 04:49:51'),
('OTKP', 'Otomatisasi Tata Kelola Perkantoran', '11135', 1, '2020-12-28 04:50:04'),
('PSPT', 'Produksi dan Siaran Program Televisi', '11150', 1, '2020-12-28 04:50:14'),
('RPL', 'Rekayasa Perangkat Lunak', '11148', 1, '2020-12-28 04:50:24'),
('TKJ', 'Teknik Komputer dan Jaringan', '11145', 1, '2020-12-28 04:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `kodekelas` char(10) NOT NULL,
  `kodejurusan` char(10) DEFAULT NULL,
  `namakelas` varchar(30) DEFAULT NULL,
  `kelas` char(3) DEFAULT NULL,
  `angkatankelas` int(11) NOT NULL,
  `is_active` int(1) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  `tglperbaharui` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`kodekelas`, `kodejurusan`, `namakelas`, `kelas`, `angkatankelas`, `is_active`, `iduser`, `tglperbaharui`) VALUES
('XIAKL', 'AKL', 'AKL', 'XI', 2019, 1, 1, '2020-12-03 14:28:14'),
('XIANM', 'ANM', 'Animasi', 'XI', 2019, 1, 1, '2020-12-27 16:05:29'),
('XIOTKP1', 'OTKP', 'OTKP 1', 'XI', 2019, 1, 1, '2020-12-27 16:07:00'),
('XIOTKP2', 'OTKP', 'OTKP 2', 'XI', 2019, 1, 1, '2020-12-27 16:07:25'),
('XIPSPT1', 'PSPT', 'PSPT 1', 'XI', 2019, 1, 1, '2020-12-27 16:06:02'),
('XIPSPT2', 'PSPT', 'PSPT 2', 'XI', 2019, 1, 1, '2020-12-27 16:06:31'),
('XIRPL', 'RPL', 'RPL', 'XI', 2019, 1, 1, '2020-12-27 16:04:20'),
('XITKJ', 'TKJ', 'TKJ', 'XI', 2019, 1, 1, '2020-12-27 16:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas_history`
--

CREATE TABLE `tb_kelas_history` (
  `idhistory` int(11) NOT NULL,
  `kodekelas` varchar(15) NOT NULL,
  `tahunajar` int(11) DEFAULT NULL,
  `semesteraktif` int(11) DEFAULT 1,
  `nip` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kompdasar`
--

CREATE TABLE `tb_kompdasar` (
  `idkd` int(11) NOT NULL,
  `kodekd` varchar(15) NOT NULL,
  `namakd` varchar(256) NOT NULL,
  `keterangankd` text DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `kkm` double DEFAULT NULL,
  `kodemapel` varchar(20) NOT NULL,
  `iduser` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kompdasar`
--

INSERT INTO `tb_kompdasar` (`idkd`, `kodekd`, `namakd`, `keterangankd`, `semester`, `kkm`, `kodemapel`, `iduser`) VALUES
(1, 'KD 1.1', 'Larangan pergaulan bebas dan perbuatan zina', NULL, '4 (Empat)', 70, 'MP001', '1'),
(2, 'KD 1.2', 'Makna beriman kepada malaikat - malaikat Allah SWT', NULL, '4 (Empat)', 70, 'MP001', '1'),
(3, 'KD 1.3', 'Semangat menuntut ilmu dan menyampaikannya kepada sesama', NULL, '1 (Satu)', 70, 'MP001', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `kodemapel` varchar(20) NOT NULL,
  `namamapel` varchar(256) DEFAULT NULL,
  `tingkatan` varchar(10) NOT NULL,
  `kelompok` varchar(70) DEFAULT NULL,
  `kodejurusan` varchar(30) NOT NULL,
  `kkm` double DEFAULT NULL,
  `iduser` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mapel`
--

INSERT INTO `tb_mapel` (`kodemapel`, `namamapel`, `tingkatan`, `kelompok`, `kodejurusan`, `kkm`, `iduser`) VALUES
('MP001', 'Pendidikan Agama dan Budi Pekerti', 'II', 'Muatan Nasional', 'Semua Jurusan', 75, '1'),
('MP002', 'Bahasa Indonesia', 'II', 'Muatan Nasional', 'Semua Jurusan', 75, '1'),
('MP003', 'Matematika', 'II', 'Muatan Nasional', 'Semua Jurusan', 75, '1'),
('MP004', 'Sejarah Indonesia', 'I', 'Muatan Nasional', 'Semua Jurusan', 70, '1'),
('MP005', 'Pendidikan Pancasila dan Kewarganegaraan', 'II', 'Muatan Nasional', 'Semua Jurusan', 75, '1'),
('MP006', 'Bahasa Inggris', 'II', 'Muatan Nasional', 'Semua Jurusan', 75, '1'),
('MP007', 'Kewirausahaan', 'II', 'Muatan Kewilayahan', 'Semua Jurusan', 75, '1'),
('MP008', 'Pendidikan Jasmani Olahraga dan Kesehatan', 'II', 'Muatan Kewilayahan', 'Semua Jurusan', 75, '1'),
('MP009', 'Bahasa Jepang', 'II', 'Muatan Kewilayahan', 'Semua Jurusan', 75, '1'),
('MP010', 'Pemodelan Perangkat Lunak', 'II', 'C3. Kompetensi Keahlian', 'RPL', 75, '1'),
('MP011', 'Basis Data', 'II', 'C3. Kompetensi Keahlian', 'RPL', 75, '1'),
('MP012', 'Pemrograman Berorientasi Objek', 'II', 'C3. Kompetensi Keahlian', 'RPL', 75, '1'),
('MP013', 'Pemrograman Web dan Perangkat Bergerak', 'II', 'C3. Kompetensi Keahlian', 'RPL', 75, '1'),
('MP014', 'Produk Kreatif dan Kewirausahaan', 'II', 'C3. Kompetensi Keahlian', 'RPL', 75, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mengajar`
--

CREATE TABLE `tb_mengajar` (
  `idmengajar` int(11) NOT NULL,
  `kodemapel` varchar(15) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `semester` int(3) NOT NULL,
  `kodekelas` varchar(15) NOT NULL,
  `periode_mengajar` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mengajar`
--

INSERT INTO `tb_mengajar` (`idmengajar`, `kodemapel`, `nip`, `semester`, `kodekelas`, `periode_mengajar`) VALUES
(6, 'MP001', '11111', 4, 'XIRPL', '2020 / 2021'),
(7, 'MP005', '11113', 4, 'XIRPL', '2020 / 2021'),
(8, 'MP002', '11117', 4, 'XIRPL', '2020 / 2021'),
(9, 'MP003', '11128', 4, 'XIRPL', '2020 / 2021'),
(10, 'MP006', '11123', 4, 'XIRPL', '2020 / 2021'),
(11, 'MP008', '11120', 4, 'XIRPL', '2020 / 2021'),
(12, 'MP009', '11130', 4, 'XIRPL', '2020 / 2021'),
(13, 'MP010', '11147', 4, 'XIRPL', '2020 / 2021'),
(14, 'MP011', '11148', 4, 'XIRPL', '2020 / 2021'),
(15, 'MP013', '11147', 4, 'XIRPL', '2020 / 2021'),
(16, 'MP014', '11148', 4, 'XIRPL', '2020 / 2021'),
(17, 'MP012', '11147', 4, 'XIRPL', '2020 / 2021'),
(18, 'MP001', '11111', 4, 'XITKJ', '2020 / 2021'),
(19, 'MP001', '11111', 4, 'XIPSPT1', '2020 / 2021'),
(20, 'MP001', '11111', 4, 'XIPSPT2', '2020 / 2021'),
(21, 'MP001', '11111', 4, 'XIANM', '2020 / 2021');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `idnilai` int(11) NOT NULL,
  `pts` double NOT NULL,
  `pat` double NOT NULL,
  `id_agenda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_penugasan`
--

CREATE TABLE `tb_nilai_penugasan` (
  `id` int(11) NOT NULL,
  `nama` varchar(15) NOT NULL,
  `idkd` int(11) NOT NULL,
  `nilai` double NOT NULL,
  `ket` varchar(15) NOT NULL,
  `idnilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_portofolio`
--

CREATE TABLE `tb_nilai_portofolio` (
  `id` int(11) NOT NULL,
  `nama` varchar(15) NOT NULL,
  `idkd` int(11) NOT NULL,
  `nilai` double NOT NULL,
  `ket` varchar(15) NOT NULL,
  `idnilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_produk`
--

CREATE TABLE `tb_nilai_produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(15) NOT NULL,
  `idkd` int(11) NOT NULL,
  `nilai` double NOT NULL,
  `ket` varchar(15) NOT NULL,
  `idnilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_proses`
--

CREATE TABLE `tb_nilai_proses` (
  `id` int(11) NOT NULL,
  `nama` varchar(10) NOT NULL,
  `idkd` int(11) NOT NULL,
  `nilai` double NOT NULL,
  `ket` varchar(15) NOT NULL,
  `idnilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_proyek`
--

CREATE TABLE `tb_nilai_proyek` (
  `id` int(11) NOT NULL,
  `nama` varchar(15) NOT NULL,
  `idkd` int(11) NOT NULL,
  `nilai` double NOT NULL,
  `ket` varchar(15) NOT NULL,
  `idnilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nis` varchar(15) NOT NULL,
  `namasiswa` varchar(70) NOT NULL,
  `nisn` varchar(30) DEFAULT NULL,
  `jeniskelamin` char(15) DEFAULT NULL,
  `tempatlahir` varchar(30) DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `alamatsiswa` varchar(70) DEFAULT NULL,
  `notelpseluler` varchar(15) DEFAULT NULL,
  `emailsiswa` varchar(50) DEFAULT NULL,
  `asalsekolah` varchar(50) DEFAULT NULL,
  `tglmasuk` date DEFAULT NULL,
  `nama_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `kodekelas` char(10) DEFAULT NULL,
  `kodejurusan` char(10) DEFAULT NULL,
  `semester_aktif` int(2) NOT NULL,
  `is_active` int(11) DEFAULT 1,
  `iduser` varchar(20) DEFAULT NULL,
  `tglperbaharui` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`nis`, `namasiswa`, `nisn`, `jeniskelamin`, `tempatlahir`, `tgllahir`, `alamatsiswa`, `notelpseluler`, `emailsiswa`, `asalsekolah`, `tglmasuk`, `nama_ayah`, `nama_ibu`, `kodekelas`, `kodejurusan`, `semester_aktif`, `is_active`, `iduser`, `tglperbaharui`) VALUES
('171800001', 'Muhammad Adriansyah', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800002', 'Jalilah Anandita Nurki', NULL, 'Perempuan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800003', 'Arif Arif', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800004', 'Bobi Barlih Brajamusti', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800005', 'Rivan Derian', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800006', 'Muhammad Dias', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800007', 'Mochammad Dyas Tm', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800008', 'Wildan Faizal N', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800009', 'Zaldy Fardhany', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800010', 'Aden Faturahman', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800011', 'Rana Jaksi Cahya', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800012', 'Isa Kawsar Tolu', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800013', 'Nandika Kurniawan', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800014', 'M. Yusuf Maulana', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800015', 'Ismi Maulida Mustari', NULL, 'Perempuan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800016', 'Rehan Maulidzia Putrra', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800017', 'Pebi Pebrian', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800018', 'Andhika Putra Haryadi', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800019', 'Indi Rahma Putri', NULL, 'Perempuan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800020', 'Adityan Ramadhan', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800021', 'Ardy Ramdani', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800022', 'Edo Ramdani', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800023', 'M. Denise Riswansyah', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800024', 'Muhammad Rizal Septian', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800025', 'Muhammad Rizki Pauzi', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800026', 'Fahad Sarif Ramdan', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800027', 'Fajar Selamat Maulana', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800028', 'Muhammad Sufyan Tsauri', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800029', 'Yuni Yuningsih', NULL, 'Perempuan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800030', 'Maulana Yusuf', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23'),
('171800031', 'Ahmad Ziriel', NULL, 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XIRPL', 'RPL', 4, 1, NULL, '2020-12-27 16:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Donald Trump', 'donaldtrump@gmail.com', 'default.jpg', '$2y$10$fmeY74FbRmBbcvdc4Aq5yeAuNIrlqZl5yUr7uthz4yxkZjmRNpqou', 1, 1, 1607003180),
(2, 'Anya Geraldine', 'anyaa@gmail.com', 'default.jpg', '$2y$10$zlA0Vf2J5OxU/gwKvJ3NWutEvYXnpaW9k91eRwlr0j65sk/VlxKS.', 2, 1, 1607003226);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(5, 1, 4),
(7, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `urutan`) VALUES
(1, 'Admin', 1),
(2, 'User', 5),
(3, 'Menu', 4),
(4, 'Master', 2),
(5, 'Guru', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Superadmin'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(4, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(5, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(6, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(7, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(8, 4, 'Modul Guru', 'master/guru', 'fas fa-fw fa-user-graduate', 1),
(9, 4, 'Modul Jurusan', 'master/jurusan', 'fas fa-fw fa-tags', 1),
(10, 4, 'Modul Kelas', 'master/kelas', 'fas fa-fw fa-chalkboard', 1),
(11, 4, 'Modul Siswa', 'master/siswa', 'fas fa-fw fa-users', 1),
(12, 4, 'Modul Mata Pelajaran', 'master/mapel', 'fas fa-fw fa-book', 1),
(13, 4, 'Modul Mengajar', 'master/mengajar', 'fas fa-fw fa-archive', 1),
(14, 5, 'Daftar Ampu', 'guru/ampu', 'fas fa-fw fa-pencil-alt', 1),
(15, 5, 'Agenda Kegiatan', 'guru', 'fas fa-fw fa-clipboard', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`kodeabsen`);

--
-- Indexes for table `tb_agenda`
--
ALTER TABLE `tb_agenda`
  ADD PRIMARY KEY (`idagenda`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`kodejurusan`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`kodekelas`);

--
-- Indexes for table `tb_kelas_history`
--
ALTER TABLE `tb_kelas_history`
  ADD PRIMARY KEY (`idhistory`);

--
-- Indexes for table `tb_kompdasar`
--
ALTER TABLE `tb_kompdasar`
  ADD PRIMARY KEY (`idkd`);

--
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`kodemapel`);

--
-- Indexes for table `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  ADD PRIMARY KEY (`idmengajar`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`idnilai`);

--
-- Indexes for table `tb_nilai_penugasan`
--
ALTER TABLE `tb_nilai_penugasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_nilai_portofolio`
--
ALTER TABLE `tb_nilai_portofolio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_nilai_proses`
--
ALTER TABLE `tb_nilai_proses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_nilai_proyek`
--
ALTER TABLE `tb_nilai_proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_agenda`
--
ALTER TABLE `tb_agenda`
  MODIFY `idagenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kelas_history`
--
ALTER TABLE `tb_kelas_history`
  MODIFY `idhistory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kompdasar`
--
ALTER TABLE `tb_kompdasar`
  MODIFY `idkd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  MODIFY `idmengajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `idnilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_nilai_penugasan`
--
ALTER TABLE `tb_nilai_penugasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_nilai_portofolio`
--
ALTER TABLE `tb_nilai_portofolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_nilai_proses`
--
ALTER TABLE `tb_nilai_proses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_nilai_proyek`
--
ALTER TABLE `tb_nilai_proyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
