-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Feb 2022 pada 17.39
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aio`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `access_room_karyawan`
--

CREATE TABLE `access_room_karyawan` (
  `id_access_room_karyawan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `access_room_karyawan`
--

INSERT INTO `access_room_karyawan` (`id_access_room_karyawan`, `id_karyawan`, `id_room`) VALUES
(4, 2, 1),
(5, 2, 2),
(6, 2, 5),
(7, 1, 1),
(8, 1, 2),
(9, 1, 3),
(10, 1, 4),
(11, 1, 5),
(12, 8, 1),
(13, 8, 2),
(14, 8, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `department`
--

CREATE TABLE `department` (
  `id_department` int(11) NOT NULL,
  `nama_department` varchar(100) NOT NULL,
  `exclude` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `department`
--

INSERT INTO `department` (`id_department`, `nama_department`, `exclude`, `created_at`, `deleted`) VALUES
(1, 'Engineering', 1, 1600321453, 0),
(2, 'IT', 0, 1600321909, 0),
(3, 'HRD', 0, 1600323237, 0),
(4, 'Production PET', 0, 1600328092, 0),
(5, 'Production OC3', 0, 1600328100, 0),
(6, 'Purchasing', 0, 1600333212, 0),
(7, 'Office', 0, 1643389273, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `department_section`
--

CREATE TABLE `department_section` (
  `id_section` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `nama_section` varchar(100) NOT NULL,
  `created_at` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `department_section`
--

INSERT INTO `department_section` (`id_section`, `id_department`, `nama_section`, `created_at`, `deleted`) VALUES
(1, 1, 'Utilty', 1600328033, 0),
(2, 4, 'PET 2nd', 1600328111, 0),
(3, 5, 'OC 3rd ', 1600328128, 0),
(4, 1, 'Maintenance', 1600333163, 0),
(5, 6, 'Admin Purchasing', 1600333252, 0),
(6, 3, 'Recruitment', 1600333369, 0),
(7, 2, 'Jaringan', 1605151831, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `device_rfid`
--

CREATE TABLE `device_rfid` (
  `id_device_rfid` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `data_rfid` varchar(100) NOT NULL,
  `created_at` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `device_rfid`
--

INSERT INTO `device_rfid` (`id_device_rfid`, `id_department`, `status`, `data_rfid`, `created_at`, `deleted`) VALUES
(1, 1, 0, '-', 1601257352, 0),
(2, 1, 0, '-', 1601258495, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `free_access_room`
--

CREATE TABLE `free_access_room` (
  `id_free_access_room` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `id_position` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `uid_rfid` varchar(20) NOT NULL,
  `disable_remarks` tinyint(1) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `control_room` int(11) NOT NULL DEFAULT 0,
  `monitoring_room` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_section`, `id_position`, `nik`, `password`, `nama_karyawan`, `status`, `uid_rfid`, `disable_remarks`, `foto`, `created_at`, `deleted`, `control_room`, `monitoring_room`) VALUES
(1, 1, 6, '180517', '$2a$08$yGVioDCvSJVV8E9Ooummpejb3o94mBWdl5jYrlYzbHdURR8kBNjES', 'Tyto Mysterious', 1, 'ca355ad', 1, '20613183535fa34dbe8c103.jpg', 1601077104, 0, 1, 1),
(2, 2, 1, '44422', '$2a$08$YBcsIMBVrhKw1MyXm761Gejhxx9AMUU1FGwk3SrG7ScnyFVhSvFey', 'Agung', 1, 'F077EDA9', 0, 'default.png', 1601204028, 0, 0, 1),
(3, 1, 1, '22334', '$2a$08$XiYG8uspIU9vVringU2snO6ZVwe50nF1dI8u5rG2gMek7YAyqPkkq', 'Prasetyo', 1, 'B099DFA8', 0, 'default.png', 1601212842, 0, 0, 0),
(4, 1, 3, '44789', '$2a$08$8eYU8n2d2g71dKYjhcLYbucw9C6jlSyaKOcvu9BEwhozFSTd.Elp6', 'Ziya Keinarra', 1, 'CFB12AE2', 0, 'default.png', 1601831062, 0, 0, 0),
(5, 5, 2, '88908', '$2a$08$9bruH/I9Y1xpPheV4C7/D.tkVrD.NMoDQU7ud9XfEE659Abz/3CEi', 'Indrawan', 1, '8FBDDAE1', 0, 'default.png', 1601864946, 0, 0, 0),
(6, 1, 4, '999111', '$2a$08$.BcR7hfXdq/vgVyPuUMkRe96VO51NKUkJ3EX3EroOKDCVF1dSyNHW', 'Santoso', 0, 'FF33BC12', 0, 'default.png', 1603263158, 0, 0, 0),
(7, 7, 2, '888999', '$2a$08$qqRs/amSWxz1up6n2v2LzOnJJ2R/LbVpHxAezH7ieLtnUwWMDSifu', 'Deddy Corbuzier', 1, 'CCA123BB', 0, 'default.png', 1603263290, 0, 0, 0),
(8, 6, 2, '11223344', '$2a$08$..NhvpD4ToNUmqyuHIOnX.T0Bkdzg45HIudrh76cZ6RuejXQe9hwS', 'User Testing', 1, 'c61b5e2b', 0, 'default.png', 1603374186, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `remarks_log` varchar(200) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `access_time` int(11) NOT NULL,
  `cam` varchar(128) DEFAULT NULL,
  `send_notif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `id_room`, `id_karyawan`, `remarks_log`, `keterangan`, `access_time`, `cam`, `send_notif`) VALUES
(1, 2, 1, '-', 'Access Granted', 1603092407, NULL, NULL),
(2, 2, 1, '-', 'Access Granted', 1603092668, NULL, NULL),
(3, 2, 1, '-', 'Access Granted', 1603092694, NULL, NULL),
(4, 6, 1, '-', 'Department Tidak Sesuai', 1603092793, NULL, NULL),
(5, 1, 1, '-', 'Access Granted', 1603092852, NULL, NULL),
(6, 1, 2, '-', 'Access Denied, Card Disable', 1603093396, NULL, NULL),
(7, 1, 2, '-', 'Access Granted', 1603093494, NULL, NULL),
(8, 2, 2, '-', 'Access Granted', 1603093505, NULL, NULL),
(9, 1, 2, '-', 'Access Denied, belum isi remarks', 1603262425, NULL, NULL),
(10, 1, 2, '-', 'Access Denied, belum isi remarks', 1603262434, NULL, NULL),
(11, 1, 2, '-', 'Access Denied, belum isi remarks', 1603262443, NULL, NULL),
(12, 1, 2, 'Welding', 'Access Granted', 1603262656, NULL, NULL),
(13, 1, 4, '-', 'Access Denied, Card Disable', 1603262743, NULL, NULL),
(14, 1, 4, '-', 'Access Denied, Card Disable', 1603262940, NULL, NULL),
(15, 1, 4, '-', 'Access Denied, Card Disable', 1603262986, NULL, NULL),
(16, 1, 4, '-', 'Access Denied, Card Disable', 1603263367, NULL, NULL),
(17, 1, 4, '-', 'Access Denied, Card Disable', 1603263526, NULL, NULL),
(18, 1, 4, '-', 'Access Denied, Card Disable', 1603263535, NULL, NULL),
(19, 1, 4, 'pengecualian, tanpa remarks', 'Access Granted', 1603263640, NULL, NULL),
(20, 1, 1, '-', 'Access Denied, belum isi remarks', 1603263662, NULL, NULL),
(21, 1, 7, 'lainnya - mengelas', 'Access Granted', 1603329596, NULL, NULL),
(22, 1, 7, '-', 'Access Denied, belum isi remarks', 1603329673, NULL, NULL),
(23, 1, 7, '-', 'Access Denied, belum isi remarks', 1603329706, NULL, NULL),
(24, 1, 7, 'Borrow Tool - caliper', 'Access Granted', 1603329813, NULL, NULL),
(25, 1, 1, '-', 'Access Denied, belum isi remarks', 1603339451, NULL, NULL),
(26, 1, 1, 'Repair Equipment', 'Access Granted', 1603339465, NULL, NULL),
(27, 1, 1, '-', 'Access Denied, belum isi remarks', 1603358975, NULL, NULL),
(28, 1, 1, '-', 'Access Denied, belum isi remarks', 1603359271, NULL, NULL),
(29, 1, 1, '-', 'Access Denied, belum isi remarks', 1603359337, NULL, NULL),
(30, 1, 1, 'Borrow Tool - bor', 'Access Granted', 1603359591, NULL, NULL),
(31, 1, 1, 'Borrow Tool - bor', 'Access Granted', 1603359816, NULL, NULL),
(32, 1, 1, 'Borrow Tool - bor', 'Access Granted', 1603359827, NULL, NULL),
(33, 1, 1, 'Borrow Tool - bor', 'Access Granted', 1603360370, NULL, NULL),
(34, 1, 1, 'Borrow Tool - bor', 'Access Granted', 1603360377, NULL, NULL),
(35, 1, 1, 'Borrow Tool - bor', 'Access Granted', 1603360384, NULL, NULL),
(36, 1, 1, 'Borrow Tool - bor', 'Access Granted', 1603360562, NULL, NULL),
(37, 4, 8, '-', 'Access Granted', 1603374469, NULL, NULL),
(38, 4, 8, '-', 'Access Granted', 1603401252, NULL, NULL),
(39, 4, 1, '-', 'Access Granted', 1603401261, NULL, NULL),
(40, 4, 8, '-', 'Access Granted', 1603402711, NULL, NULL),
(41, 4, 8, '-', 'Access Granted', 1603410967, NULL, NULL),
(42, 4, 1, '-', 'Access Granted', 1603411181, NULL, NULL),
(43, 4, 1, '-', 'Access Granted', 1603411190, NULL, NULL),
(44, 4, 8, '-', 'Access Granted', 1603412134, NULL, NULL),
(45, 4, 1, '-', 'Access Granted', 1603412145, NULL, NULL),
(46, 4, 1, '-', 'Access Granted', 1603412281, NULL, NULL),
(47, 4, 8, '-', 'Access Granted', 1603412293, NULL, NULL),
(48, 4, 8, '-', 'Access Granted', 1603412618, NULL, NULL),
(49, 4, 8, '-', 'Access Granted', 1603412800, NULL, NULL),
(50, 4, 1, '-', 'Access Granted', 1603413046, NULL, NULL),
(51, 4, 1, '-', 'Access Granted', 1603413394, NULL, NULL),
(52, 4, 1, '-', 'Access Granted', 1603413653, NULL, NULL),
(53, 4, 1, '-', 'Access Granted', 1603414130, NULL, NULL),
(54, 4, 1, '-', 'Access Granted', 1603414469, NULL, NULL),
(55, 4, 8, '-', 'Access Granted', 1603414656, NULL, NULL),
(56, 4, 8, '-', 'Access Granted', 1603414831, NULL, NULL),
(57, 4, 8, '-', 'Access Granted', 1603415640, NULL, NULL),
(58, 4, 1, '-', 'Access Granted', 1603415795, NULL, NULL),
(59, 4, 8, '-', 'Access Granted', 1603415813, NULL, NULL),
(60, 4, 8, '-', 'Access Granted', 1603416324, NULL, NULL),
(61, 4, 1, '-', 'Access Granted', 1603417335, NULL, NULL),
(62, 4, 8, '-', 'Access Granted', 1603419256, NULL, NULL),
(63, 4, 8, '-', 'Access Granted', 1603422564, NULL, NULL),
(64, 4, 1, '-', 'Access Granted', 1603427516, NULL, NULL),
(65, 4, 8, '-', 'Access Granted', 1603427523, NULL, NULL),
(66, 6, 8, '-', 'Department Tidak Sesuai', 1603430924, NULL, NULL),
(67, 6, 1, '-', 'Department Tidak Sesuai', 1603430928, NULL, NULL),
(68, 6, 1, '-', 'Department Tidak Sesuai', 1603431456, NULL, NULL),
(69, 6, 1, '-', 'Department Tidak Sesuai', 1603435185, NULL, NULL),
(70, 3, 1, '-', 'Access Granted', 1603437084, NULL, NULL),
(71, 3, 8, '-', 'Access Granted', 1603437645, NULL, NULL),
(72, 3, 8, '-', 'Access Granted', 1603437727, NULL, NULL),
(73, 3, 1, '-', 'Access Granted', 1603437734, NULL, NULL),
(74, 3, 1, '-', 'Access Granted', 1603438014, NULL, NULL),
(75, 3, 1, '-', 'Access Granted', 1603438738, NULL, NULL),
(76, 3, 1, '-', 'Access Granted', 1603438784, NULL, NULL),
(77, 3, 1, '-', 'Access Granted', 1603438853, NULL, NULL),
(78, 3, 1, '-', 'Access Granted', 1603438914, NULL, NULL),
(79, 3, 1, '-', 'Access Granted', 1603438957, NULL, NULL),
(80, 3, 1, '-', 'Access Granted', 1603439101, NULL, NULL),
(81, 3, 1, '-', 'Access Granted', 1603439110, NULL, NULL),
(82, 3, 1, '-', 'Access Granted', 1603439120, NULL, NULL),
(83, 3, 8, '-', 'Access Granted', 1603439134, NULL, NULL),
(84, 3, 1, '-', 'Access Granted', 1603439226, NULL, NULL),
(85, 3, 1, '-', 'Access Granted', 1603439233, NULL, NULL),
(86, 3, 1, '-', 'Access Granted', 1603439240, NULL, NULL),
(87, 3, 1, '-', 'Access Granted', 1603439247, NULL, NULL),
(88, 3, 1, '-', 'Access Granted', 1603439254, NULL, NULL),
(89, 3, 1, '-', 'Access Granted', 1603439262, NULL, NULL),
(90, 3, 1, '-', 'Access Granted', 1603439277, NULL, NULL),
(91, 3, 8, '-', 'Access Granted', 1603439678, NULL, NULL),
(92, 3, 8, '-', 'Access Granted', 1603439759, NULL, NULL),
(93, 3, 8, '-', 'Access Granted', 1603439768, NULL, NULL),
(94, 3, 8, '-', 'Access Granted', 1603439827, NULL, NULL),
(95, 3, 8, '-', 'Access Granted', 1603439834, NULL, NULL),
(96, 3, 8, '-', 'Access Granted', 1603439841, NULL, NULL),
(97, 3, 8, '-', 'Access Granted', 1603439868, NULL, NULL),
(98, 3, 8, '-', 'Access Granted', 1603439891, NULL, NULL),
(99, 3, 1, '-', 'Access Granted', 1603439951, NULL, NULL),
(100, 3, 1, '-', 'Access Granted', 1603440984, NULL, NULL),
(101, 3, 1, '-', 'Access Granted', 1603447898, NULL, NULL),
(102, 3, 1, '-', 'Access Granted', 1603447929, NULL, NULL),
(103, 3, 1, '-', 'Access Granted', 1603447938, NULL, NULL),
(104, 3, 1, '-', 'Access Granted', 1603447950, NULL, NULL),
(105, 3, 1, '-', 'Access Granted', 1603447957, NULL, NULL),
(106, 3, 8, '-', 'Access Granted', 1603448203, NULL, NULL),
(107, 3, 8, '-', 'Access Granted', 1603448211, NULL, NULL),
(108, 3, 8, '-', 'Access Granted', 1603448219, NULL, NULL),
(109, 3, 8, '-', 'Access Granted', 1603448256, NULL, NULL),
(110, 3, 8, '-', 'Access Granted', 1603448302, NULL, NULL),
(111, 3, 8, '-', 'Access Granted', 1603448310, NULL, NULL),
(112, 3, 8, '-', 'Access Granted', 1603448317, NULL, NULL),
(113, 3, 8, '-', 'Access Granted', 1603448325, NULL, NULL),
(114, 3, 8, '-', 'Access Granted', 1603448331, NULL, NULL),
(115, 3, 8, '-', 'Access Granted', 1603448339, NULL, NULL),
(116, 3, 1, '-', 'Access Granted', 1603448586, NULL, NULL),
(117, 3, 8, '-', 'Access Granted', 1603448763, NULL, NULL),
(118, 3, 8, '-', 'Access Granted', 1603449120, NULL, NULL),
(119, 3, 8, '-', 'Access Granted', 1603449318, NULL, NULL),
(120, 3, 1, '-', 'Access Granted', 1603449327, NULL, NULL),
(121, 3, 1, '-', 'Access Granted', 1603449549, NULL, NULL),
(122, 3, 1, '-', 'Access Granted', 1603449923, NULL, NULL),
(123, 3, 1, '-', 'Access Granted', 1603449933, NULL, NULL),
(124, 3, 8, '-', 'Access Granted', 1603449941, NULL, NULL),
(125, 3, 1, '-', 'Access Granted', 1603449957, NULL, NULL),
(126, 3, 8, '-', 'Access Granted', 1603449966, NULL, NULL),
(127, 3, 1, '-', 'Access Granted', 1603449976, NULL, NULL),
(128, 3, 8, '-', 'Access Granted', 1603449995, NULL, NULL),
(129, 3, 1, '-', 'Access Granted', 1603450034, NULL, NULL),
(130, 3, 8, '-', 'Access Granted', 1603450042, NULL, NULL),
(131, 3, 8, '-', 'Access Granted', 1603450055, NULL, NULL),
(132, 3, 1, '-', 'Access Granted', 1603450124, NULL, NULL),
(133, 3, 1, '-', 'Access Granted', 1603452569, NULL, NULL),
(134, 3, 8, '-', 'Access Granted', 1603452577, NULL, NULL),
(135, 3, 1, '-', 'Access Granted', 1603452746, NULL, NULL),
(136, 3, 8, '-', 'Access Granted', 1603452755, NULL, NULL),
(137, 3, 8, '-', 'Access Granted', 1603452767, NULL, NULL),
(138, 3, 1, '-', 'Access Granted', 1603452777, NULL, NULL),
(139, 3, 8, '-', 'Access Granted', 1603452890, NULL, NULL),
(140, 3, 8, '-', 'Access Granted', 1603453022, NULL, NULL),
(141, 3, 8, '-', 'Access Granted', 1603456635, NULL, NULL),
(142, 3, 1, '-', 'Access Granted', 1603456642, NULL, NULL),
(143, 3, 8, '-', 'Access Granted', 1603460231, NULL, NULL),
(144, 3, 1, '-', 'Access Granted', 1603460243, NULL, NULL),
(145, 3, 1, '-', 'Access Granted', 1603460302, NULL, NULL),
(146, 3, 1, '-', 'Access Granted', 1603460311, NULL, NULL),
(147, 3, 1, '-', 'Access Granted', 1603460319, NULL, NULL),
(148, 3, 1, '-', 'Access Granted', 1603460361, NULL, NULL),
(149, 3, 8, '-', 'Access Granted', 1603460370, NULL, NULL),
(150, 3, 8, '-', 'Access Granted', 1603461068, NULL, NULL),
(151, 3, 8, '-', 'Access Granted', 1603461440, NULL, NULL),
(152, 3, 8, '-', 'Access Granted', 1603462471, NULL, NULL),
(153, 3, 1, '-', 'Access Granted', 1603462570, NULL, NULL),
(154, 3, 1, '-', 'Access Granted', 1603491261, NULL, NULL),
(155, 3, 8, '-', 'Access Granted', 1603491275, NULL, NULL),
(156, 3, 1, '-', 'Access Granted', 1603491291, NULL, NULL),
(157, 3, 1, '-', 'Access Granted', 1603492110, NULL, NULL),
(158, 3, 1, '-', 'Access Granted', 1603492134, NULL, NULL),
(159, 3, 1, '-', 'Access Granted', 1603492154, NULL, NULL),
(160, 3, 8, '-', 'Access Granted', 1603492170, NULL, NULL),
(161, 3, 8, '-', 'Access Granted', 1603493842, NULL, NULL),
(162, 3, 1, '-', 'Access Granted', 1603493854, NULL, NULL),
(163, 3, 1, '-', 'Access Granted', 1603505942, NULL, NULL),
(164, 3, 1, '-', 'Access Granted', 1603509586, NULL, NULL),
(165, 3, 1, '-', 'Access Granted', 1603510222, NULL, NULL),
(166, 3, 8, '-', 'Access Granted', 1603510266, NULL, NULL),
(167, 3, 8, '-', 'Access Granted', 1603510335, NULL, NULL),
(168, 3, 1, '-', 'Access Granted', 1603510877, NULL, NULL),
(169, 3, 8, '-', 'Access Granted', 1603511599, NULL, NULL),
(170, 3, 1, '-', 'Access Granted', 1603511607, NULL, NULL),
(171, 3, 1, '-', 'Access Granted', 1603511624, NULL, NULL),
(172, 3, 8, '-', 'Access Granted', 1603511631, NULL, NULL),
(173, 3, 1, '-', 'Access Granted', 1603511645, NULL, NULL),
(174, 3, 8, '-', 'Access Granted', 1603511653, NULL, NULL),
(175, 3, 1, '-', 'Access Granted', 1603511739, NULL, NULL),
(176, 1, 1, '-', 'Access Denied, belum isi remarks', 1603513624, NULL, NULL),
(177, 1, 1, '-', 'Access Denied, belum isi remarks', 1603513795, NULL, NULL),
(178, 1, 1, 'Cutting', 'Access Granted', 1603513851, NULL, NULL),
(179, 1, 8, '-', 'Access Denied, belum isi remarks', 1603513869, NULL, NULL),
(180, 1, 1, 'Cutting', 'Access Granted', 1603513881, NULL, NULL),
(181, 1, 1, 'Cutting', 'Access Granted', 1603513985, NULL, NULL),
(182, 1, 8, '-', 'Access Denied, belum isi remarks', 1603514873, NULL, NULL),
(183, 1, 1, 'Cutting', 'Access Granted', 1603514878, NULL, NULL),
(184, 1, 1, 'Cutting', 'Access Granted', 1603516980, NULL, NULL),
(185, 1, 8, '-', 'Access Denied, belum isi remarks', 1603516989, NULL, NULL),
(186, 1, 1, 'Cutting', 'Access Granted', 1603517023, NULL, NULL),
(187, 1, 1, 'Cutting', 'Access Granted', 1603517031, NULL, NULL),
(188, 1, 1, '-', 'Access Denied, belum isi remarks', 1603518790, NULL, NULL),
(189, 1, 1, '-', 'Access Denied, belum isi remarks', 1603518797, NULL, NULL),
(190, 1, 1, '-', 'Access Denied, belum isi remarks', 1603518828, NULL, NULL),
(191, 1, 8, '-', 'Access Denied, belum isi remarks', 1603518833, NULL, NULL),
(192, 1, 1, '-', 'Access Denied, belum isi remarks', 1603519924, NULL, NULL),
(193, 1, 1, 'Repair Equipment', 'Access Granted', 1603519943, NULL, NULL),
(194, 1, 1, 'Repair Equipment', 'Access Granted', 1603519978, NULL, NULL),
(195, 6, 1, '-', 'Department Tidak Sesuai', 1603525053, NULL, NULL),
(196, 6, 8, '-', 'Department Tidak Sesuai', 1603525057, NULL, NULL),
(197, 6, 8, '-', 'Department Tidak Sesuai', 1603525463, NULL, NULL),
(198, 6, 8, '-', 'Access Granted', 1603525537, NULL, NULL),
(199, 6, 8, '-', 'Access Granted', 1603525548, NULL, NULL),
(200, 6, 1, '-', 'Access Granted', 1603525556, NULL, NULL),
(201, 6, 1, '-', 'Access Granted', 1603526538, NULL, NULL),
(202, 6, 1, '-', 'Access Granted', 1603529571, NULL, NULL),
(203, 6, 1, '-', 'Access Granted', 1603529837, NULL, NULL),
(204, 1, 1, '-', 'Access Denied, belum isi remarks', 1603536272, NULL, NULL),
(205, 1, 1, '-', 'Access Denied, belum isi remarks', 1603536277, NULL, NULL),
(206, 1, 1, 'Welding', 'Access Granted', 1603536722, NULL, NULL),
(207, 1, 1, 'Welding', 'Access Granted', 1603538989, NULL, NULL),
(208, 1, 1, '-', 'Access Denied, belum isi remarks', 1603585377, NULL, NULL),
(209, 1, 1, 'Cutting', 'Access Granted', 1603585489, NULL, NULL),
(210, 1, 1, 'Cutting', 'Access Granted', 1603585498, NULL, NULL),
(211, 1, 1, 'Cutting', 'Access Granted', 1603585665, NULL, NULL),
(212, 1, 1, 'Cutting', 'Access Granted', 1603585691, NULL, NULL),
(213, 1, 8, '-', 'Access Denied, belum isi remarks', 1603585698, NULL, NULL),
(214, 1, 8, '-', 'Access Denied, belum isi remarks', 1603585818, NULL, NULL),
(215, 1, 1, 'Cutting', 'Access Granted', 1603585837, NULL, NULL),
(216, 1, 1, 'Cutting', 'Access Granted', 1603586101, NULL, NULL),
(217, 1, 1, 'Cutting', 'Access Granted', 1603586115, NULL, NULL),
(218, 1, 1, 'Cutting', 'Access Granted', 1603586222, NULL, NULL),
(219, 1, 1, 'Cutting', 'Access Granted', 1603586255, NULL, NULL),
(220, 1, 1, 'Cutting', 'Access Granted', 1603586360, NULL, NULL),
(221, 1, 1, 'Cutting', 'Access Granted', 1603586380, NULL, NULL),
(222, 1, 1, 'Cutting', 'Access Granted', 1603586594, NULL, NULL),
(223, 1, 1, 'Cutting', 'Access Granted', 1603586615, NULL, NULL),
(224, 1, 1, 'Cutting', 'Access Granted', 1603586867, NULL, NULL),
(225, 1, 1, 'Cutting', 'Access Granted', 1603586906, NULL, NULL),
(226, 1, 1, 'Cutting', 'Access Granted', 1603586923, NULL, NULL),
(227, 1, 1, 'Cutting', 'Access Granted', 1603586935, NULL, NULL),
(228, 1, 1, 'Cutting', 'Access Granted', 1603587212, NULL, NULL),
(229, 1, 1, 'Cutting', 'Access Granted', 1603587442, NULL, NULL),
(230, 1, 1, 'Cutting', 'Access Granted', 1603589077, NULL, NULL),
(231, 1, 1, '-', 'Access Denied, belum isi remarks', 1603589106, NULL, NULL),
(232, 1, 1, 'Lathe', 'Access Granted', 1603589142, NULL, NULL),
(233, 1, 1, 'Lathe', 'Access Granted', 1603589153, NULL, NULL),
(234, 1, 1, 'Lathe', 'Access Granted', 1603589162, NULL, NULL),
(235, 1, 1, '-', 'Access Denied, belum isi remarks', 1603597135, NULL, NULL),
(236, 1, 8, '-', 'Access Denied, belum isi remarks', 1603597140, NULL, NULL),
(237, 1, 8, '-', 'Access Denied, belum isi remarks', 1603597146, NULL, NULL),
(238, 1, 8, '-', 'Access Denied, belum isi remarks', 1603600515, NULL, NULL),
(239, 1, 8, '-', 'Access Denied, belum isi remarks', 1603604226, NULL, NULL),
(240, 1, 1, '-', 'Access Denied, belum isi remarks', 1603604231, NULL, NULL),
(241, 1, 1, '-', 'Access Denied, belum isi remarks', 1603604235, NULL, NULL),
(242, 1, 1, '-', 'Access Denied, belum isi remarks', 1603604241, NULL, NULL),
(243, 1, 8, '-', 'Access Denied, belum isi remarks', 1603604267, NULL, NULL),
(244, 1, 8, '-', 'Access Denied, belum isi remarks', 1603606463, NULL, NULL),
(245, 1, 8, '-', 'Access Denied, belum isi remarks', 1603606497, NULL, NULL),
(246, 1, 1, 'Hydrolic ', 'Access Granted', 1603606503, NULL, NULL),
(247, 1, 1, 'Hydrolic ', 'Access Granted', 1603606511, NULL, NULL),
(248, 1, 1, 'Hydrolic ', 'Access Granted', 1603606522, NULL, NULL),
(249, 1, 1, 'Hydrolic ', 'Access Granted', 1603606530, NULL, NULL),
(250, 1, 1, 'Hydrolic ', 'Access Granted', 1603606540, NULL, NULL),
(251, 1, 1, 'Hydrolic ', 'Access Granted', 1603606553, NULL, NULL),
(252, 1, 1, 'Hydrolic ', 'Access Granted', 1603606572, NULL, NULL),
(253, 1, 8, '-', 'Access Denied, belum isi remarks', 1603606609, NULL, NULL),
(254, 1, 8, '-', 'Access Denied, belum isi remarks', 1603606617, NULL, NULL),
(255, 1, 1, 'Hydrolic ', 'Access Granted', 1603606624, NULL, NULL),
(256, 1, 1, 'Hydrolic ', 'Access Granted', 1603606646, NULL, NULL),
(257, 1, 1, 'Hydrolic ', 'Access Granted', 1603606664, NULL, NULL),
(258, 1, 1, 'Hydrolic ', 'Access Granted', 1603606678, NULL, NULL),
(259, 1, 1, 'Hydrolic ', 'Access Granted', 1603606688, NULL, NULL),
(260, 1, 1, 'Hydrolic ', 'Access Granted', 1603606729, NULL, NULL),
(261, 1, 1, 'Hydrolic ', 'Access Granted', 1603608108, NULL, NULL),
(262, 3, 1, '-', 'Access Granted', 1603608573, NULL, NULL),
(263, 6, 1, '-', 'Access Granted', 1603608906, NULL, NULL),
(264, 3, 1, '-', 'Access Granted', 1603608984, NULL, NULL),
(265, 3, 1, '-', 'Access Granted', 1603609042, NULL, NULL),
(266, 3, 1, '-', 'Access Granted', 1603609061, NULL, NULL),
(267, 1, 1, 'Hydrolic ', 'Access Granted', 1603609130, NULL, NULL),
(268, 1, 1, 'Hydrolic ', 'Access Granted', 1603609142, NULL, NULL),
(269, 1, 5, '-', 'Access Denied, belum isi remarks', 1604896553, NULL, NULL),
(270, 1, 4, 'pengecualian, tanpa remarks', 'Access Granted', 1604896566, NULL, NULL),
(271, 1, 4, 'pengecualian, tanpa remarks', 'Access Granted', 1604896722, NULL, NULL),
(272, 1, 4, 'pengecualian, tanpa remarks', 'Access Granted', 1605144322, NULL, NULL),
(273, 1, 1, '-', 'Access Granted, Free Access Room', 1605144352, NULL, NULL),
(274, 6, 1, '-', 'Access Granted, Free Access Room', 1605144381, NULL, NULL),
(275, 5, 1, '-', 'Access Granted, Free Access Room', 1605144390, NULL, NULL),
(276, 4, 1, '-', 'Access Granted, Free Access Room', 1605144394, NULL, NULL),
(277, 3, 1, '-', 'Access Granted, Free Access Room', 1605144399, NULL, NULL),
(278, 2, 1, '-', 'Access Granted, Free Access Room', 1605144402, NULL, NULL),
(279, 6, 1, '-', 'Access Granted, Free Access Room', 1605144422, NULL, NULL),
(280, 6, 1, '-', 'Access Granted', 1605144436, NULL, NULL),
(281, 6, 1, '-', 'Access Granted', 1605144448, NULL, NULL),
(282, 6, 1, '-', 'Department Tidak Sesuai', 1605144484, NULL, NULL),
(283, 6, 1, '-', 'Access Denied, Department Tidak Sesuai', 1605144517, NULL, NULL),
(284, 6, 1, '-', 'Access Granted, Free Access Room', 1605144536, NULL, NULL),
(285, 6, 1, '-', 'Access Granted, Free Access Room', 1605152490, NULL, NULL),
(286, 3, 4, '-', 'Access Granted', 1605152552, NULL, NULL),
(287, 1, 4, 'pengecualian, tanpa remarks', 'Access Granted', 1605152557, NULL, NULL),
(288, 4, 4, '-', 'Access Denied, akses ruangan ditolak', 1605152589, NULL, NULL),
(289, 1, 4, 'pengecualian, tanpa remarks', 'Access Granted', 1611819862, NULL, NULL),
(290, 1, 4, '-', 'Access Denied, belum isi remarks', 1605152821, NULL, NULL),
(291, 1, 4, '-', 'Access Denied, akses ruangan ditolak', 1605152844, NULL, NULL),
(292, 1, 4, '-', 'Access Denied, belum isi remarks', 1605152876, NULL, NULL),
(293, 1, 4, '-', 'Access Denied, akses ruangan ditolak', 1605152962, NULL, NULL),
(294, 1, 4, '-', 'Access Denied, belum isi remarks', 1605152975, NULL, NULL),
(295, 1, 4, 'Repair Equipment', 'Access Granted', 1611819862, NULL, NULL),
(296, 1, 3, '-', 'Access Denied, akses ruangan ditolak', 1605158875, NULL, NULL),
(297, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606012229, NULL, NULL),
(298, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606012267, NULL, NULL),
(299, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606012275, NULL, NULL),
(300, 1, 1, '-', 'Access Granted', 1606012329, NULL, NULL),
(301, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606012347, NULL, NULL),
(302, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606012444, NULL, NULL),
(303, 1, 1, '-', 'Access Granted', 1606012454, NULL, NULL),
(304, 1, 1, '-', 'Access Granted', 1606013051, NULL, NULL),
(305, 1, 1, '-', 'Access Granted', 1606013081, NULL, NULL),
(306, 1, 8, '-', 'Access Denied, akses ruangan ditolak', 1606013093, NULL, NULL),
(307, 1, 8, '-', 'Access Denied, akses ruangan ditolak', 1606013362, NULL, NULL),
(308, 1, 1, '-', 'Access Granted', 1606013369, NULL, NULL),
(309, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606013480, NULL, NULL),
(310, 1, 1, '-', 'Access Granted', 1606013554, NULL, NULL),
(311, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606013574, NULL, NULL),
(312, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606013940, NULL, NULL),
(313, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606013993, NULL, NULL),
(314, 1, 1, '-', 'Access Denied, belum isi remarks', 1606014009, NULL, NULL),
(315, 1, 8, '-', 'Access Denied, akses ruangan ditolak', 1606014017, NULL, NULL),
(316, 1, 8, '-', 'Access Denied, akses ruangan ditolak', 1606014222, NULL, NULL),
(317, 1, 1, '-', 'Access Denied, belum isi remarks', 1606014229, NULL, NULL),
(318, 1, 1, '-', 'Access Denied, belum isi remarks', 1606021511, NULL, NULL),
(319, 1, 8, '-', 'Access Denied, akses ruangan ditolak', 1606021525, NULL, NULL),
(320, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606021556, NULL, NULL),
(321, 1, 8, '-', 'Access Denied, akses ruangan ditolak', 1606021564, NULL, NULL),
(322, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606023953, NULL, NULL),
(323, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606023961, NULL, NULL),
(324, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606023969, NULL, NULL),
(325, 1, 8, '-', 'Access Denied, akses ruangan ditolak', 1606023978, NULL, NULL),
(326, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606023989, NULL, NULL),
(327, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606024009, NULL, NULL),
(328, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606025740, NULL, NULL),
(329, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606025749, NULL, NULL),
(330, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606028848, NULL, NULL),
(331, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606028860, NULL, NULL),
(332, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606029277, NULL, NULL),
(333, 1, 2, 'Welding', 'Access Granted', 1610012080, NULL, NULL),
(334, 5, 2, '-', 'Access Denied, belum isi remarks', 1611819862, NULL, NULL),
(335, 5, 2, 'lainnya - Photocopy', 'Access Granted', 1624175509, NULL, NULL),
(336, 5, 1, '-', 'Access Denied, belum isi remarks', 1611819862, NULL, NULL),
(337, 1, 1, '-', 'Access Denied, belum isi remarks', 1611819862, NULL, NULL),
(338, 1, 1, 'Repair Equipment', 'Access Granted', 1611819862, NULL, NULL),
(339, 1, 1, '-', 'Access Denied, belum isi remarks', 1611979776, NULL, NULL),
(340, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1611979810, NULL, NULL),
(341, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1611979900, NULL, NULL),
(342, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1611979941, NULL, NULL),
(343, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1611980476, NULL, NULL),
(344, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1612187162, NULL, NULL),
(345, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1612581462, NULL, NULL),
(346, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1612581471, NULL, NULL),
(347, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1612581480, NULL, NULL),
(348, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1612581490, NULL, NULL),
(349, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1612692505, NULL, NULL),
(350, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1614135189, NULL, NULL),
(351, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1621234187, NULL, NULL),
(352, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1621234470, NULL, NULL),
(353, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1624175509, NULL, NULL),
(354, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1624340068, NULL, NULL),
(355, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1624340080, '15012022_20-36-11_94079411361e2cdcbc41a7.jpeg', NULL),
(356, 8, 8, '', '', 1603339451, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `position`
--

CREATE TABLE `position` (
  `id_position` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `position`
--

INSERT INTO `position` (`id_position`, `position`, `ket`) VALUES
(1, 'S1', 'Staff'),
(2, 'S2', 'Leader'),
(3, 'S3', 'Superviser'),
(4, 'M1', 'Manager'),
(5, 'M2', '-'),
(6, 'M3', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `public_reader_rfid`
--

CREATE TABLE `public_reader_rfid` (
  `id_public_reader_rfid` int(11) NOT NULL,
  `uid_rfid` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `token` int(11) NOT NULL,
  `last_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `public_reader_rfid`
--

INSERT INTO `public_reader_rfid` (`id_public_reader_rfid`, `uid_rfid`, `status`, `token`, `last_update`) VALUES
(1, '8999f3b3', 0, 5433, 1605279244);

-- --------------------------------------------------------

--
-- Struktur dari tabel `public_remarks`
--

CREATE TABLE `public_remarks` (
  `id_public_remarks` int(11) NOT NULL,
  `remarks_activity` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `public_remarks`
--

INSERT INTO `public_remarks` (`id_public_remarks`, `remarks_activity`) VALUES
(1, 'Welding'),
(2, 'Repair Equipment'),
(3, 'Milling'),
(4, 'Borrow Tool'),
(5, 'Cutting'),
(6, 'Lathe'),
(7, 'Hydrolic '),
(8, 'lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `remarks_room`
--

CREATE TABLE `remarks_room` (
  `id_remarks_room` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `remarks_text` varchar(200) NOT NULL,
  `waktu_remarks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `remarks_room`
--

INSERT INTO `remarks_room` (`id_remarks_room`, `id_room`, `id_karyawan`, `remarks_text`, `waktu_remarks`) VALUES
(1, 1, 2, 'Welding', 1603261685),
(2, 1, 7, '4 - bor', 1603229287),
(3, 1, 7, 'Hydrolic ', 1603229556),
(4, 1, 7, 'lainnya - mengelas', 1603229570),
(5, 1, 7, 'Borrow Tool - bor', 1603229637),
(6, 1, 7, 'Borrow Tool - caliper', 1603329809),
(7, 1, 1, 'Repair Equipment', 1603339462),
(8, 1, 1, 'Borrow Tool - bor', 1603359483),
(9, 1, 1, 'Cutting', 1603513847),
(10, 1, 1, 'Repair Equipment', 1603519940),
(11, 1, 1, 'Welding', 1603536717),
(12, 1, 1, 'Cutting', 1603585485),
(13, 1, 1, 'Lathe', 1603589139),
(14, 1, 1, 'Hydrolic ', 1603606478),
(15, 1, 4, 'Repair Equipment', 1605153036),
(16, 1, 2, 'Welding', 1610011972),
(17, 5, 2, 'lainnya - Photocopy', 1610012524),
(18, 1, 1, 'Repair Equipment', 1610012756);

-- --------------------------------------------------------

--
-- Struktur dari tabel `room`
--

CREATE TABLE `room` (
  `id_room` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `nama_room` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `need_remarks` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `flag_dashboard` tinyint(1) NOT NULL,
  `flag_dashboard_dua` tinyint(4) NOT NULL DEFAULT 0,
  `flag_dashboard_tiga` tinyint(4) NOT NULL DEFAULT 0,
  `flag_dashboard_empat` tinyint(4) NOT NULL DEFAULT 0,
  `open` tinyint(1) NOT NULL,
  `auto` tinyint(1) NOT NULL,
  `relay_open` tinyint(1) NOT NULL,
  `img_room` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `room`
--

INSERT INTO `room` (`id_room`, `id_department`, `nama_room`, `type`, `need_remarks`, `created_at`, `deleted`, `flag_dashboard`, `flag_dashboard_dua`, `flag_dashboard_tiga`, `flag_dashboard_empat`, `open`, `auto`, `relay_open`, `img_room`) VALUES
(1, 1, 'Workshop', 'public', 1, 1601043846, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(2, 2, 'Ruang Tunggu', 'public', 0, 1601044256, 0, 0, 1, 0, 0, 0, 0, 0, 0),
(3, 1, 'Boiler 12 Tph', 'restricted', 0, 1601044279, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 1, 'Compressor High Presssure', 'restricted', 0, 1601045652, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 5, 'Production Workshop', 'public', 1, 1603092753, 0, 0, 0, 1, 0, 0, 0, 0, 0),
(6, 2, 'Admin IT Support', 'restricted', 0, 1603092788, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 1, 'Office of Purchasing', 'restricted', 0, 1643389317, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 7, 'Pintu Office 1', 'public', 0, 1643389333, 0, 0, 0, 0, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `secret_key`
--

CREATE TABLE `secret_key` (
  `id_key` int(11) NOT NULL,
  `key` varchar(100) NOT NULL,
  `descripction` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `secret_key`
--

INSERT INTO `secret_key` (`id_key`, `key`, `descripction`) VALUES
(1, 'TZKlock2021', 'Secret Key'),
(2, '1059144067:AAECI0pEjtuwBlfGKvb4W0mWB6MjzMj56Nk', 'Token Telegram');

-- --------------------------------------------------------

--
-- Struktur dari tabel `telegram`
--

CREATE TABLE `telegram` (
  `id_telegram` int(11) NOT NULL,
  `id_room` int(11) DEFAULT NULL,
  `id_chat` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `enable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `telegram`
--

INSERT INTO `telegram` (`id_telegram`, `id_room`, `id_chat`, `id_karyawan`, `enable`) VALUES
(1, 1, 98388, 1, 0),
(2, 1, 75647, 2, 0),
(4, 2, 334543, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `control_room` tinyint(4) NOT NULL DEFAULT 0,
  `monitoring_room` tinyint(4) NOT NULL DEFAULT 0,
  `role` tinyint(2) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_department`, `nama`, `email`, `username`, `password`, `image`, `control_room`, `monitoring_room`, `role`, `deleted`) VALUES
(1, 0, 'Tyto Mulyono', 'tyto@tytomulyono.com', 'tyto', '$2a$08$3WyRJUHBqEG.sQ4yYTLxqOAXyqApz5/4AMZ73kauVsah1QfyKe7yC', 'superadmin.png', 0, 0, 1, 0),
(2, 3, 'Admin', 'admin@email.com', 'admin', '$2a$08$3WyRJUHBqEG.sQ4yYTLxqOAXyqApz5/4AMZ73kauVsah1QfyKe7yC', 'defaultadmin.png', 1, 1, 2, 0),
(3, 1, 'Muhammad Arham Ananta', 'arham@gmail.com', 'arham', '$2a$08$1sTh66XJ0NKD9fgsWSoAs.tmDDmRIs.J1mCbUxXxFJRQfg/KtUVoW', '15903374425f6e0a401d7dc.jpg', 0, 0, 2, 0),
(4, 2, 'Ziya Keinarra', 'ziyakeinarra@gmail.com', 'ziya', '$2a$08$4m1RKvjw.U1nG/TEVlks3esPBKWikJ1ZoqOf.k4.h35Mj8WCJzHna', '6163073855f6e06da8b856.jpg', 0, 0, 2, 0),
(5, 6, 'Aeni Mustofiah', 'aenimustafiah@gmail.com', 'aeni', '$2a$08$XFrcMy17eddsemES7QB9wubpsdohWnzKVzrtsLNAv05p2i5In/5VO', '9537669455f6bf17db6af6.jpg', 0, 0, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `access_room_karyawan`
--
ALTER TABLE `access_room_karyawan`
  ADD PRIMARY KEY (`id_access_room_karyawan`);

--
-- Indeks untuk tabel `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id_department`);

--
-- Indeks untuk tabel `department_section`
--
ALTER TABLE `department_section`
  ADD PRIMARY KEY (`id_section`);

--
-- Indeks untuk tabel `device_rfid`
--
ALTER TABLE `device_rfid`
  ADD PRIMARY KEY (`id_device_rfid`);

--
-- Indeks untuk tabel `free_access_room`
--
ALTER TABLE `free_access_room`
  ADD PRIMARY KEY (`id_free_access_room`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id_position`);

--
-- Indeks untuk tabel `public_reader_rfid`
--
ALTER TABLE `public_reader_rfid`
  ADD PRIMARY KEY (`id_public_reader_rfid`);

--
-- Indeks untuk tabel `public_remarks`
--
ALTER TABLE `public_remarks`
  ADD PRIMARY KEY (`id_public_remarks`);

--
-- Indeks untuk tabel `remarks_room`
--
ALTER TABLE `remarks_room`
  ADD PRIMARY KEY (`id_remarks_room`);

--
-- Indeks untuk tabel `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id_room`);

--
-- Indeks untuk tabel `secret_key`
--
ALTER TABLE `secret_key`
  ADD PRIMARY KEY (`id_key`);

--
-- Indeks untuk tabel `telegram`
--
ALTER TABLE `telegram`
  ADD PRIMARY KEY (`id_telegram`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `access_room_karyawan`
--
ALTER TABLE `access_room_karyawan`
  MODIFY `id_access_room_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `department`
--
ALTER TABLE `department`
  MODIFY `id_department` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `department_section`
--
ALTER TABLE `department_section`
  MODIFY `id_section` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `device_rfid`
--
ALTER TABLE `device_rfid`
  MODIFY `id_device_rfid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `free_access_room`
--
ALTER TABLE `free_access_room`
  MODIFY `id_free_access_room` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=357;

--
-- AUTO_INCREMENT untuk tabel `position`
--
ALTER TABLE `position`
  MODIFY `id_position` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `public_reader_rfid`
--
ALTER TABLE `public_reader_rfid`
  MODIFY `id_public_reader_rfid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `public_remarks`
--
ALTER TABLE `public_remarks`
  MODIFY `id_public_remarks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `remarks_room`
--
ALTER TABLE `remarks_room`
  MODIFY `id_remarks_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `room`
--
ALTER TABLE `room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `secret_key`
--
ALTER TABLE `secret_key`
  MODIFY `id_key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `telegram`
--
ALTER TABLE `telegram`
  MODIFY `id_telegram` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
