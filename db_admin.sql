-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2020 at 10:07 AM
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
  `namaguru` varchar(50) NOT NULL,
  `jeniskelamin` varchar(15) DEFAULT NULL,
  `tempatlahir` varchar(25) DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `alamatguru` varchar(80) DEFAULT NULL,
  `notelpseluler` char(15) DEFAULT NULL,
  `emailguru` varchar(30) DEFAULT NULL,
  `kodejurusan` char(10) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  `tglperbaharui` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`nip`, `namaguru`, `jeniskelamin`, `tempatlahir`, `tgllahir`, `alamatguru`, `notelpseluler`, `emailguru`, `kodejurusan`, `iduser`, `tglperbaharui`, `is_active`) VALUES
('19801203202105001', 'Najwa Shihab', 'Perempuan', 'Jakarta', '1980-12-03', 'Jl. Kenari No.103 Kaswari', '085896600511', 'mbanana@gmail.com', 'AKL', 1, '2020-12-03 14:27:08', 1);

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
('AKL', 'Akuntansi dan Keuangan Lembaga', '19801203202105001', 1, '2020-12-03 14:26:45');

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
('XIAKL', 'AKL', 'AKL', 'XI', 2019, 1, 1, '2020-12-03 14:28:14');

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
(1, 'KD 1.1', 'Larangan pergaulan bebas dan perbuatan zina', NULL, '1 (Satu)', 70, 'MP001', '1'),
(2, 'KD 1.2', 'Makna beriman kepada malaikat - malaikat Allah SWT', NULL, '1 (Satu)', 70, 'MP001', '1'),
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
('MP001', 'Pendidikan Agama dan Budi Pekerti', 'I', 'Muatan Nasional', 'Semua Jurusan', 70, '1'),
('MP002', 'Bahasa Indonesia', 'I', 'Muatan Nasional', 'Semua Jurusan', 70, '1'),
('MP003', 'Matematika', 'I', 'Muatan Nasional', 'Semua Jurusan', 70, '1'),
('MP004', 'Sejarah Indonesia', 'I', 'Muatan Nasional', 'Semua Jurusan', 70, '1');

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
(1, 'MP001', '19801203202105001', 1, 'XIAKL', '2018 / 2019'),
(2, 'MP002', '19801203202105001', 1, 'XIAKL', '2018 / 2019'),
(3, 'MP003', '19801203202105001', 1, 'XIAKL', '2018 / 2019'),
(4, 'MP004', '19801203202105001', 1, 'XIAKL', '2018 / 2019');

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
  `is_active` int(11) DEFAULT NULL,
  `iduser` varchar(20) DEFAULT NULL,
  `tglperbaharui` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`nis`, `namasiswa`, `nisn`, `jeniskelamin`, `tempatlahir`, `tgllahir`, `alamatsiswa`, `notelpseluler`, `emailsiswa`, `asalsekolah`, `tglmasuk`, `nama_ayah`, `nama_ibu`, `kodekelas`, `kodejurusan`, `semester_aktif`, `is_active`, `iduser`, `tglperbaharui`) VALUES
('171800001', 'Putri Anne Saloka', '0206774005', 'Perempuan', 'Padang', '2000-11-09', 'Padang Pariaman', '09876654321', 'putrianne@gmail.com', 'SMPN 113 Jakarta Selatan', '2020-07-13', 'Hermawan Adi', 'Endang Dwi Nurhasanah', 'XIAKL', 'AKL', 4, 1, '1', '2020-12-04 05:23:58');

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
(5, 1, 4);

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
(13, 4, 'Modul Mengajar', 'master/mengajar', 'fas fa-fw fa-university', 1);

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
  MODIFY `idmengajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
