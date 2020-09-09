-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_sipeg
CREATE DATABASE IF NOT EXISTS `db_sipeg` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_sipeg`;

-- Dumping structure for table db_sipeg.mutasi_pegawai
CREATE TABLE IF NOT EXISTS `mutasi_pegawai` (
  `id_mutasi_pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `id_mutasi` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `unit_asal` varchar(255) DEFAULT NULL,
  `unit_tujuan` varchar(255) DEFAULT NULL,
  `status_mutasi` varchar(2) DEFAULT NULL COMMENT 'mutasi internal/eksternal jika',
  PRIMARY KEY (`id_mutasi_pegawai`),
  KEY `FK_mutasi_pegawai_tb_mutasi` (`id_mutasi`),
  KEY `FK_mutasi_pegawai_tb_pegawai` (`id_pegawai`),
  CONSTRAINT `FK_mutasi_pegawai_tb_mutasi` FOREIGN KEY (`id_mutasi`) REFERENCES `tb_mutasi` (`id_mutasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_mutasi_pegawai_tb_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `tb_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COMMENT='tabel many to many mutasi dan pegawai\r\n';

-- Dumping data for table db_sipeg.mutasi_pegawai: ~5 rows (approximately)
/*!40000 ALTER TABLE `mutasi_pegawai` DISABLE KEYS */;
INSERT INTO `mutasi_pegawai` (`id_mutasi_pegawai`, `id_mutasi`, `id_pegawai`, `unit_asal`, `unit_tujuan`, `status_mutasi`) VALUES
	(15, 10, 101, 'Dinas Pendidikan', 'SD N 2 Semaraputa Tengah', '1'),
	(16, 10, 102, 'Dinas Pendidikan', 'SD N 2 Semaraputa Tengah', '1'),
	(17, 11, 102, 'SD N 2 Semaraputa Tengah', 'SMP N 2 Semarapura', '1'),
	(20, 10, 76, 'Dinas Pendidikan', 'SD N 2 sp tengah', '1'),
	(21, 10, 75, 'Dinas Pendidikan', 'SMP N 3 SEMARAPURA', '1');
/*!40000 ALTER TABLE `mutasi_pegawai` ENABLE KEYS */;

-- Dumping structure for table db_sipeg.tb_jabatan
CREATE TABLE IF NOT EXISTS `tb_jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`),
  UNIQUE KEY `nama_jabatan` (`nama_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sipeg.tb_jabatan: ~17 rows (approximately)
/*!40000 ALTER TABLE `tb_jabatan` DISABLE KEYS */;
INSERT INTO `tb_jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
	(35, 'Ka. Bidang Pembinaan Ketenagaan'),
	(34, 'Ka. Bidang Pembinaan Pendidikan Dasar'),
	(33, 'Ka. Bidang Pendidikan Anak Usia Dini & Pendidikan Non Formal'),
	(39, 'Ka. Seksi Kelembagaan & Sarana Prasarana Pada Bidang Pembinaan Pend. Anak Usia Dini'),
	(42, 'Ka. Seksi Kelembagaan & Sarana Prasarana Pada Bidang Pembinaan Pend. Dasar'),
	(46, 'Ka. Seksi Kurikulum & Penilaian pada Bidang Pembinaan Pend. Anak Usia Dini'),
	(40, 'Ka. Seksi Kurikulum & Penilaian pada Bidang Pend. Dasar'),
	(43, 'Ka. Seksi Pendidikan Tenaga Kependidikan Anak Usia Dini & Pend. Non Formal'),
	(41, 'Ka. Seksi pendidikan Tenaga Kependidikan Sekolah Dasar'),
	(44, 'Ka. Seksi Pendidikan Tenaga Kependidikan Sekolah Menengah Pertama'),
	(45, 'Ka. Seksi Peserta Didik dan Pembagunan Karakter Pada Bidang Pebinaan Pendidikan Dasar'),
	(37, 'Ka. Seksi Peserta Didik dan Pembangunan karakter Pada Bidang Pembinaan Pendidikan Anak Usia Dini'),
	(38, 'Ka. Sub. Bagian Perencanaan dan Keuangan'),
	(36, 'Ka. Sub. Bagian Umum dan Kepegawaian'),
	(31, 'Kepala Dinas'),
	(32, 'Sekretaris'),
	(47, 'Staff');
/*!40000 ALTER TABLE `tb_jabatan` ENABLE KEYS */;

-- Dumping structure for table db_sipeg.tb_mutasi
CREATE TABLE IF NOT EXISTS `tb_mutasi` (
  `id_mutasi` int(11) NOT NULL AUTO_INCREMENT,
  `no_sk` varchar(255) DEFAULT NULL,
  `tgl_mutasi` date DEFAULT NULL,
  PRIMARY KEY (`id_mutasi`),
  UNIQUE KEY `no_sk` (`no_sk`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sipeg.tb_mutasi: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_mutasi` DISABLE KEYS */;
INSERT INTO `tb_mutasi` (`id_mutasi`, `no_sk`, `tgl_mutasi`) VALUES
	(10, '111/KLK/111', '2020-08-26'),
	(11, '222/KLK/222', '2020-08-27');
/*!40000 ALTER TABLE `tb_mutasi` ENABLE KEYS */;

-- Dumping structure for table db_sipeg.tb_pangkat
CREATE TABLE IF NOT EXISTS `tb_pangkat` (
  `id_pangkat` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pangkat` varchar(255) DEFAULT NULL,
  `golongan` varchar(5) DEFAULT NULL,
  `ruang` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_pangkat`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sipeg.tb_pangkat: ~9 rows (approximately)
/*!40000 ALTER TABLE `tb_pangkat` DISABLE KEYS */;
INSERT INTO `tb_pangkat` (`id_pangkat`, `nama_pangkat`, `golongan`, `ruang`) VALUES
	(37, 'Pembina Utama Muda', 'IV', 'c'),
	(38, 'Pembina Tingkat I', 'IV', 'b'),
	(39, 'Pembina', 'IV', 'a'),
	(40, 'Penata Tingkat I', 'III', 'd'),
	(41, 'Penata', 'III', 'c'),
	(42, 'Penata Muda Tingkat I', 'III', 'b'),
	(44, 'Penata Muda', 'III', 'a'),
	(45, 'Pengatur Tingkat I', 'II', 'd'),
	(46, 'Pengatur', 'II', 'c');
/*!40000 ALTER TABLE `tb_pangkat` ENABLE KEYS */;

-- Dumping structure for table db_sipeg.tb_pegawai
CREATE TABLE IF NOT EXISTS `tb_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `jns_kelamin` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tmp_lahir` varchar(100) DEFAULT NULL,
  `status_kawin` varchar(20) DEFAULT NULL,
  `jumlah_anak` int(11) DEFAULT NULL,
  `pend_terakhir` varchar(100) DEFAULT NULL,
  `id_pangkat` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `tempat_bekerja` varchar(255) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `tgl_pensiun` date DEFAULT NULL,
  PRIMARY KEY (`id_pegawai`),
  UNIQUE KEY `nip` (`nip`),
  KEY `FK_tb_pegawai_tb_jabatan` (`id_jabatan`),
  KEY `FK_tb_pegawai_tb_pangkat` (`id_pangkat`),
  CONSTRAINT `FK_tb_pegawai_tb_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id_jabatan`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_tb_pegawai_tb_pangkat` FOREIGN KEY (`id_pangkat`) REFERENCES `tb_pangkat` (`id_pangkat`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_tb_pegawai_tb_user` FOREIGN KEY (`id_pegawai`) REFERENCES `tb_user` (`id_user`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sipeg.tb_pegawai: ~32 rows (approximately)
/*!40000 ALTER TABLE `tb_pegawai` DISABLE KEYS */;
INSERT INTO `tb_pegawai` (`id_pegawai`, `nip`, `jns_kelamin`, `tgl_lahir`, `tmp_lahir`, `status_kawin`, `jumlah_anak`, `pend_terakhir`, `id_pangkat`, `id_jabatan`, `tempat_bekerja`, `agama`, `alamat`, `tgl_pensiun`) VALUES
	(72, '196712311989011016', 'Laki-Laki', '1967-12-31', NULL, 'Sudah Menikah', NULL, 'Magister (S2)', 37, 31, 'Dinas Pendidikan', 'Hindu', 'Klungkung', '2025-12-31'),
	(73, '196712101994121007', 'Laki-Laki', '1967-12-10', NULL, 'Sudah Menikah', NULL, 'Magister (S2)', 38, 32, 'Dinas Pendidikan', 'Hindu', 'Klungkung', '2025-12-10'),
	(74, '197202031994011001', 'Laki-Laki', '1972-02-03', NULL, NULL, NULL, 'Sarjana (S1)', 38, 33, 'Dinas Pendidikan', 'Hindu', 'Klungkung', '2030-02-03'),
	(75, '196612281989021002', 'Laki-Laki', '1966-12-28', NULL, 'Sudah Menikah', NULL, 'Sarjana (S1)', 39, 34, 'SMP N 3 SEMARAPURA', 'Hindu', 'Klungkung', '2024-12-28'),
	(76, '196712311993031110', 'Laki-Laki', '1967-12-31', NULL, 'Sudah Menikah', NULL, 'SMA Sederajat', 39, 35, 'SD N 2 sp tengah', 'Hindu', 'Klungkung', '2025-12-31'),
	(77, '196806151991031017', 'Laki-Laki', '1968-06-15', NULL, NULL, NULL, 'Sarjana (S1)', 40, 36, 'Dinas Pendidikan', 'Hindu', 'Klungkung', '2026-06-15'),
	(78, '196605211990032010', 'Perempuan', '1966-05-21', NULL, NULL, NULL, 'Sarjana (S1)', 40, 37, 'Dinas Pendidikan', NULL, 'Klungkung', '2024-05-21'),
	(79, '198111202006041013', 'Laki-Laki', '1981-11-20', NULL, NULL, NULL, 'SMA Sederajat', 40, 38, 'Dinas Pendidikan', NULL, 'Klungkung', '2039-11-20'),
	(80, '197010302005011005', 'Laki-Laki', '1970-10-30', NULL, NULL, NULL, 'Sarjana (S1)', 40, 39, 'Dinas Pendidikan', NULL, 'Klungkung', '2028-10-30'),
	(81, '196711131992031008', 'Laki-Laki', '1967-11-13', NULL, NULL, NULL, 'Sarjana (S1)', 40, 40, 'Dinas Pendidikan', NULL, 'Klungkung', '2025-11-13'),
	(82, '197012302000122003', 'Perempuan', '1970-12-30', NULL, NULL, NULL, 'Sarjana (S1)', 41, 41, 'Dinas Pendidikan', NULL, 'Klungkung', '2028-12-30'),
	(83, '198507282010011026', 'Laki-Laki', '1985-07-28', NULL, NULL, NULL, 'Magister (S2)', 41, 42, 'Dinas Pendidikan', NULL, 'Klungkung', '2043-07-28'),
	(84, '197005072007072038', 'Perempuan', '1970-05-07', NULL, NULL, NULL, 'Sarjana (S1)', 42, 43, 'Dinas Pendidikan', NULL, 'Klungkung', '2028-05-07'),
	(85, '198009222011011004', 'Laki-Laki', '1980-09-22', NULL, NULL, NULL, 'Sarjana (S1)', 41, 44, 'Dinas Pendidikan', NULL, 'Klungkung', '2038-09-22'),
	(86, '198109042006042008', 'Perempuan', '1981-09-04', NULL, NULL, NULL, 'Sarjana (S1)', 41, 45, 'Dinas Pendidikan', NULL, 'Klungkung', '2039-09-04'),
	(87, '198209292007011012', 'Laki-Laki', '1982-09-29', NULL, NULL, NULL, 'Sarjana (S1)', 41, 46, 'Dinas Pendidikan', NULL, 'Klungkung', '2040-09-29'),
	(88, '197306172000032011', 'Perempuan', '1973-06-17', NULL, NULL, NULL, 'Sarjana (S1)', 41, 47, 'Dinas Pendidikan', NULL, 'Klungkung', '2031-06-17'),
	(89, '197609072011012004', 'Perempuan', '1976-09-07', NULL, NULL, NULL, 'Sarjana (S1)', 41, 47, 'Dinas Pendidikan', NULL, 'Klungkung', '2034-09-07'),
	(90, '196212311988031205', 'Laki-Laki', '1962-12-31', NULL, NULL, NULL, 'SMA Sederajat', 42, 47, 'Dinas Pendidikan', NULL, 'Klungkung', '2020-12-31'),
	(91, '196212101985031026', 'Laki-Laki', '1962-12-10', NULL, NULL, NULL, 'SMA Sederajat', 42, 47, 'Dinas Pendidikan', NULL, 'Klungkung', '2020-12-10'),
	(92, '196412311986031270', 'Laki-Laki', '1964-12-31', NULL, NULL, NULL, 'SMA Sederajat', 42, 47, 'Dinas Pendidikan', NULL, 'Klungkung', '2022-12-31'),
	(93, '196711202014061001', 'Laki-Laki', '1967-11-20', NULL, NULL, NULL, 'Sarjana (S1)', 42, 47, 'Dinas Pendidikan', NULL, 'klungkung', '2025-11-20'),
	(94, '198408152009022010', 'Perempuan', '1984-08-15', NULL, NULL, NULL, 'Sarjana (S1)', 42, 47, 'Dinas Pendidikan', NULL, 'Klungkung', '2042-08-15'),
	(95, '197310152009011009', 'Laki-Laki', '1973-10-15', NULL, NULL, NULL, 'Sarjana (S1)', 42, 47, 'Dinas Pendidikan', 'Hindu', 'Klungkung', '2031-10-15'),
	(96, '198006102000051001', 'Laki-Laki', '1980-06-10', NULL, NULL, NULL, 'Sarjana (S1)', 44, 47, 'Dinas Pendidikan', NULL, 'Klungkung', '2038-06-10'),
	(97, '198603232010011029', 'Laki-Laki', '1986-03-23', NULL, NULL, NULL, 'Sarjana (S1)', 44, 47, 'Dinas Pendidikan', NULL, 'Klungkung', '2044-03-23'),
	(98, '198405172006042017', 'Perempuan', '1984-05-17', NULL, NULL, NULL, 'Sarjana (S1)', 44, 47, 'Dinas Pendidikan', 'Hindu', 'Klungkung', '2042-05-17'),
	(99, '196510262006041006', 'Laki-Laki', '1965-10-26', '', NULL, NULL, 'Sarjana (S1)', 44, 47, 'Dinas Pendidikan', NULL, 'Klungkung', '2023-10-26'),
	(100, '198305102010012012', 'Perempuan', '1983-05-10', NULL, NULL, NULL, 'Sarjana (S1)', 44, 47, 'Dinas Pendidikan', 'Hindu', 'Klungkung', '2041-05-10'),
	(101, '196212312006042047', 'Perempuan', '1962-12-31', NULL, NULL, NULL, 'SMA Sederajat', 45, 47, 'SD N 2 Semaraputa Tengah', NULL, 'Klungkung', '2020-12-31'),
	(102, '197401102000051001', 'Laki-Laki', '1974-01-10', NULL, NULL, NULL, 'SMA Sederajat', 46, 47, 'SD N 2 sp tengah', NULL, 'Klungkung', '2032-01-10'),
	(103, '199701011111111001', 'Laki-Laki', '1997-01-01', 'Klungkung', 'Belum Menikah', NULL, 'Sarjana (S1)', 40, 47, 'klungkung', 'Hindu', 'Budaga', '2055-01-01');
/*!40000 ALTER TABLE `tb_pegawai` ENABLE KEYS */;

-- Dumping structure for table db_sipeg.tb_pesan
CREATE TABLE IF NOT EXISTS `tb_pesan` (
  `id_pesan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(11) DEFAULT NULL,
  `id_mutasi_pegawai` int(11) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL COMMENT '1 pensiun, 2mutasi',
  `status` varchar(2) DEFAULT NULL,
  `tgl_pesan` date DEFAULT NULL,
  PRIMARY KEY (`id_pesan`),
  UNIQUE KEY `id_mutasi_pegawai` (`id_mutasi_pegawai`),
  KEY `id_pegawai` (`id_pegawai`),
  CONSTRAINT `FK__tb_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `tb_pegawai` (`id_pegawai`),
  CONSTRAINT `FK_tb_pesan_mutasi_pegawai` FOREIGN KEY (`id_mutasi_pegawai`) REFERENCES `mutasi_pegawai` (`id_mutasi_pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sipeg.tb_pesan: ~7 rows (approximately)
/*!40000 ALTER TABLE `tb_pesan` DISABLE KEYS */;
INSERT INTO `tb_pesan` (`id_pesan`, `id_pegawai`, `id_mutasi_pegawai`, `jenis`, `status`, `tgl_pesan`) VALUES
	(1, 90, NULL, 'pensiun', '1', '2020-09-02'),
	(2, 91, NULL, 'pensiun', '1', '2020-09-02'),
	(3, 101, NULL, 'pensiun', '1', '2020-09-02'),
	(4, 101, 15, 'mutasi', '2', '2020-08-30'),
	(5, 102, 16, 'mutasi', '2', '2020-08-30'),
	(6, 76, 20, 'mutasi', '2', '2020-08-30'),
	(7, 75, 21, 'mutasi', '2', '2020-08-30');
/*!40000 ALTER TABLE `tb_pesan` ENABLE KEYS */;

-- Dumping structure for table db_sipeg.tb_skp
CREATE TABLE IF NOT EXISTS `tb_skp` (
  `id_skp` int(11) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(11) DEFAULT NULL,
  `nama_atasan_pejpen` varchar(200) DEFAULT NULL,
  `nip_atasan_pejpen` varchar(50) DEFAULT NULL,
  `status_atasan_pejpen` varchar(50) DEFAULT NULL,
  `nama_pejpen` varchar(200) DEFAULT NULL,
  `nip_pejpen` varchar(50) DEFAULT NULL,
  `status_pejpen` varchar(50) DEFAULT NULL,
  `tahun_skp` varchar(4) DEFAULT NULL,
  `nilai_skp` double DEFAULT NULL,
  `nilai_pelayanan` double DEFAULT NULL,
  `nilai_integritas` double DEFAULT NULL,
  `nilai_komitmen` double DEFAULT NULL,
  `nilai_disiplin` double DEFAULT NULL,
  `nilai_kerjasama` double DEFAULT NULL,
  `nilai_kepemimpinan` double DEFAULT NULL,
  PRIMARY KEY (`id_skp`),
  KEY `FK_tb_skp_tb_pegawai` (`id_pegawai`),
  CONSTRAINT `FK_tb_skp_tb_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `tb_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sipeg.tb_skp: ~6 rows (approximately)
/*!40000 ALTER TABLE `tb_skp` DISABLE KEYS */;
INSERT INTO `tb_skp` (`id_skp`, `id_pegawai`, `nama_atasan_pejpen`, `nip_atasan_pejpen`, `status_atasan_pejpen`, `nama_pejpen`, `nip_pejpen`, `status_pejpen`, `tahun_skp`, `nilai_skp`, `nilai_pelayanan`, `nilai_integritas`, `nilai_komitmen`, `nilai_disiplin`, `nilai_kerjasama`, `nilai_kepemimpinan`) VALUES
	(1, 72, 'I Wayan Suwirta', NULL, 'Bupati', 'I Gede Putu Winastra', '196307211988031013', 'PNS', '2016', 85.5, 81, 91, 86, 90, 85, 80),
	(2, 74, 'I GEDE PUTU WINASTRA', '196307211988031013', 'PNS', 'I KETUT SUJANA', '196712101994121000', 'PNS', '2016', 82.17, 80, 80, 91, 81, 81, 80),
	(3, 72, 'I Wayan Suwirta', NULL, 'Bupati', 'I GEDE PUTU WINASTRA', '196307211988031013', 'PNS', '2017', 87.17, 85, 91, 87, 90, 85, 85),
	(4, 72, 'I Wayan Suwirta', NULL, 'Bupati', 'I Gede Putu Winastra', '196307211988031013', 'PNS', '2020', 88.7, 88, 89, 89, 90, 97, 88),
	(5, 72, 'I Wayan Suwirta', NULL, 'Bupati', 'I Gede Putu Winastra', '196307211988031013', 'PNS', '2019', 88, 88, 96, 95, 97, 89, 93),
	(6, 72, 'I Wayan Suwirta', NULL, 'Bupati', 'I Gede Putu Winastra', '196307211988031013', 'PNS', '2021', 88, 89, 98, 97, 86, 89, 95);
/*!40000 ALTER TABLE `tb_skp` ENABLE KEYS */;

-- Dumping structure for table db_sipeg.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(2) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sipeg.tb_user: ~33 rows (approximately)
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` (`id_user`, `email`, `password`, `role`, `status`, `foto`, `nama`) VALUES
	(64, 'admin@gmail.com', '$2y$10$NfLUHYWPnjujLJmYYUrj8eMVvsEDQBCHq3uj2zklIqtu58zFjooF6', '3', '1', '1598409288_185fba7449db4992b09f.png', 'Admin Disdik'),
	(72, 'DewaGdeDarmawan@gmail.com', '$2y$10$XGQgA/Dqeo2Ox20InepEJubXZvtX828UoXEnpVCweeO8QHsibJuHy', '1', '1', '1598462509_bae60c5e2e21701893e4.png', 'Dewa Gde Darmawan, S.Pd., M.Pd.'),
	(73, 'IKetutSujana@gmail.com', '$2y$10$gM1hYXDExYakLxJUzwFhEe7FgKIgy18VkfR66YFMcOVdZc/dadXQC', '1', '1', '1598462655_c86ce509bce3291b59b3.png', 'Drs. I Ketut Sujana, M.Pd.H.'),
	(74, 'IWayanSarjana@gmail.com', '$2y$10$As9uFE1oEzKh6ybXiDaene0vzvkBTk0cBG6JhMg6EVs7ThFh6ryFK', '1', '1', '1598462844_e3d1a455817721fde6c0.png', 'I Wayan Sarjana, S.Pd.'),
	(75, 'IKetutSuastana@gmail.com', '$2y$10$zGePhPWbf4UABMXUhRBqSOEFY3LBI0EnjTYwv1IpfNsGlg8Cvnp0a', '1', '1', '1598462968_249ce94395a388ba3396.png', 'I Ketut Suastana, S.Pd.'),
	(76, 'IKetutBudiarta@gmail.com', '$2y$10$bdRoJ6k0dFZxHiGjubRK3eYrlzilnzyd/Ps.Z.3eGzXy86SFtPOpS', '1', '1', '1598463070_5d494b151d8fc165fcb4.png', 'I Ketut Budiarta, SH., M.Si'),
	(77, 'IGedeBambangGunawan@gmail.com', '$2y$10$nTL9I32Cc7OBOaP4QFuSUuyDWkPtLXJK6rs3XZak0RVtfzt87rRAe', '1', '1', '1598463197_e171f5b172009be57110.png', 'I Gede Bambang Gunawan, SH.'),
	(78, 'NiNyomanRudani@gmail.com', '$2y$10$mvqARDhMehqerq7VQXVh7exupa8gRrQj6NqPnFjfO8M7cxL.N2O1W', '1', '1', '1598463335_6aa86ba5224173ec5bae.png', 'Ni Nyoman Rudani, SH.'),
	(79, 'IWayanSukrana@gmail.com', '$2y$10$evfpSPmkXrkfrhx9rUqWFukAg0OKG272/YLsJ0wtmtwTwirv0usx6', '1', '1', '1598463491_2db858d66c38f870c792.png', 'I Wayan Sukrana, ST.'),
	(80, 'IGedeOkaPurwita@gmail.com', '$2y$10$HzfGQqpBzRpVr7JlfQiK7OJfWrWyQaWc.JPUFJ/5dOhvLV9u5B5Sy', '1', '1', '1598463591_10a54f5630659334f9ff.png', 'I Gede Oka Purwita, ST.'),
	(81, 'IMadeArdhana@gmail.com', '$2y$10$7kSN6P7piJv.moE1Uru60OrljJWIzS13Bk4W8tjGAVl6Y/PHdy6N.', '1', '1', '1598463679_3e75f08ccf4f5f1b2f9a.png', 'I Made Ardhana, SH.'),
	(82, 'DewaAyuKetutSomantini@gmail.com', '$2y$10$iUjZkptXw/XqNuv1bz5TseDjXd1p9WIIp101o8tHHiudVU3YO0RqO', '1', '1', '1598463823_4d1a3d95c52314ba68d2.png', 'Dewa Ayu Ketut Somantini, S.Sos.'),
	(83, 'IWayanDidikAdiprayogi@gmail.com', '$2y$10$UgUlYH18C111eDObb22KNOFN2Zv43/KRwOJEHX3UyHn3EdI3uLrn2', '1', '1', '1598463934_c57cba1ea170f0e6d953.png', 'I Wayan Didik Adiprayogi, ST., MM'),
	(84, 'DesakKetutAlitSuarsini@gmail.com', '$2y$10$cDnWxMHSYyO.Et4HQw.Cx.ZKcSXO5P54qPmMTEYtnBy8wBJc77JOa', '1', '1', '1598464352_ea85d865a7533cce051f.png', 'Desak Ketut Alit Suarsini, S.Pd'),
	(85, 'IKetutSuartika@gmail.com', '$2y$10$48PLI65i7LuyVF6CSt90JubNJRGN4fTlxL3cZ2wabpdojvIBKlXly', '1', '1', '1598464554_585826c5685aefb5c3c3.png', 'I Ketut Suartika, S.E.'),
	(86, 'NiKomangSukreni@gmail.com', '$2y$10$/5uP3JQF5sGNFJeHSRvGKuh05OxlCemrvmDl26qIIaw0WtdiVcAIK', '1', '1', '1598464647_5eca0ddeb0bd6e77f687.png', 'Ni Komang Sukreni, S.E.'),
	(87, 'INyomanSubagiarta@gmail.com', '$2y$10$1uX1ZpsYegRTADwFkbbBHe524d/u9GrSMhW6z.o.F0EXimtMHW6cK', '1', '1', '1598464754_8320744891bf71e4e856.png', 'I Nyoman Subagiarta, SH.H'),
	(88, 'LuhEkaRatnawati@gmail.com', '$2y$10$.XsS3ZpJdgOkaVBKFF3gmO2zj1V3gVpqALW4jwrHCCDCH811hE3dS', '1', '1', '1598464837_12cdc8b18c96bd6368a2.png', 'Luh Eka Ratnawati, SH.'),
	(89, 'KadekSriAryanti@gmail.com', '$2y$10$ycAWR73iqGkcYVR3W4qxc.Jzxrc3pBhBwl0nc1yMuLuimnaYJPyHu', '1', '1', '1598464991_56b2e0248df0719efb4f.png', 'Kadek Sri Aryanti R, S.E.'),
	(90, 'INyomanSuparta@gmail.com', '$2y$10$NgKA8A2ZJEMD80KZEnkbRu6S71fIK7bolMDGIG0WDopBX45xvzace', '1', '1', '1598465052_8d36916f2753962f51ca.png', 'I Nyoman Suparta'),
	(91, 'INyomanSuwasta@gmail.com', '$2y$10$v8emYGSUlJsP7/l9Wtcl0.p6TIXq6Bv.qnXRVYQc2nCTgGWvxWZ6K', '1', '1', '1598465125_2d3553cd52c9eb619830.png', 'I Nyoman Suwasta'),
	(92, 'INyomanSudianta@gmail.com', '$2y$10$LaBy6ZRRYCy6fDSPdxcqU.2b9i/f6Ad6.ddD797XkuQvJC6sNZcii', '1', '1', '1598465233_429cb15bfdbabbc0bdd2.png', 'I Nyoman Sudianta'),
	(93, 'AARaiSubawaSanjaya@gmail.com', '$2y$10$HKU6daeEcqb6e9UP7r/f.OlJWg/QtX3FNilzXiNa/trm4yghPoO4C', '1', '1', '1598465315_30dc4f283e244224ed17.png', 'A.A Rai Subawa Sanjaya, S.Pd.'),
	(94, 'NiWayanKertiSuryaningsih@gmail.com', '$2y$10$Hf7ZmC6MwRukGUZ7Ck4OwO4mPydSY2FcFwVv5F757MMPcBDvx0HW.', '1', '1', '1598465402_649ebbb21fadf065295a.png', 'Ni Wayan Kerti Suryaningsih, S.Sos.'),
	(95, 'CokordaGedeBrasikaPutra@gmail.com', '$2y$10$fqnn/AoSPAYWEvO4aIU90O5Dw1Pson5LD12sZEJQoqIY3ZhZTH4w.', '1', '1', '1598465511_3adba23091019127408b.png', 'Cokorda Gede Brasika Putra, SH.'),
	(96, 'IKomangSumendra@gmail.com', '$2y$10$JncmI5W4ZFn4bC4/bgygr.i5E8w2mmWXe11jI.Hw4YWRcXe/G8sFi', '1', '1', '1598465600_31139a1357cbbd5abecd.png', 'I Komang Sumendra, SH.'),
	(97, 'IKetutWekaWiraPutra@gmail.com', '$2y$10$sspMBWNRB9jdnaWTGcVh1eSx/EPogx40HZ3fmtn8YvoCOGQBNJXBK', '1', '1', '1598465704_48543319ab4b3989bc4b.png', 'I Ketut Weka Wira Putra, S.Kom'),
	(98, 'NiNyomanSuparniti@gmail.com', '$2y$10$KN80rtjCH7gPhTXYskIY5uS2M85JclC93RCl74TPN9uh/MCoHASbm', '1', '1', '1598465774_82963e640186fb3c3277.png', 'Ni Nyoman Suparniti, S.A.P.'),
	(99, 'AnakAgungGedeNgurah@gmail.com', '$2y$10$VaaZAuYioW0/P0WkdhUoGeLO8IAxtoU.8cYn3a0dBqbBx7aeK4y6K', '1', '1', '1598465857_039dd37772baab692a1c.png', 'Anak Agung Gede Ngurah, S.A.P.'),
	(100, 'NiNyomanSuriatini@gmail.com', '$2y$10$V916KAfhskWjUUk/3oLBy.cX6v5ZrNU5/p.h4LDWy5ZUxXbg0hsYy', '1', '1', '1598466394_353715c6e475c46e770c.png', 'Ni Nyoman Suriatini, S.A.P.'),
	(101, 'IdaAyuKartini@gmail.com', '$2y$10$tAk9sBAlfXpJQYRP1OrmSeDYj/PE8crmGefUt2IJFAY9QbdKjOiqq', '1', '1', '1598466512_5229b097c54ccd428dc1.png', 'Ida Ayu Kartini'),
	(102, 'IMadeAriana@gmail.com', '$2y$10$dbn.gEfDN80Ztn.NRbSLJuLF..5YxrfUqCPH779ApAeomerPH/gVi', '1', '1', '1598466566_a8402e751d2c1285bd0b.png', 'I Made Ariana'),
	(103, 'asigede428@gmail.com', '$2y$10$JASvVfHsHVayuGlVEOR03e7nETgRgdfCsWF72JWp.PHGzic5KCEwe', '1', '1', '1598846430_5f02c9d2dc1e26da45e1.jpg', 'I Gede Agus Supriawan');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
