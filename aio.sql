-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 19, 2021 at 03:11 AM
-- Server version: 5.7.19
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `access_room_karyawan`
--

CREATE TABLE `access_room_karyawan` (
  `id_access_room_karyawan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_room_karyawan`
--

INSERT INTO `access_room_karyawan` (`id_access_room_karyawan`, `id_karyawan`, `id_room`) VALUES
(4, 2, 1),
(5, 2, 2),
(6, 2, 5),
(7, 1, 1),
(8, 1, 2),
(9, 1, 3),
(10, 1, 4),
(11, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id_department` int(11) NOT NULL,
  `nama_department` varchar(100) NOT NULL,
  `created_at` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id_department`, `nama_department`, `created_at`, `deleted`) VALUES
(1, 'Engineering', 1600321453, 0),
(2, 'IT', 1600321909, 0),
(3, 'HRD', 1600323237, 0),
(4, 'Production PET', 1600328092, 0),
(5, 'Production OC3', 1600328100, 0),
(6, 'Purchasing', 1600333212, 0);

-- --------------------------------------------------------

--
-- Table structure for table `department_section`
--

CREATE TABLE `department_section` (
  `id_section` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `nama_section` varchar(100) NOT NULL,
  `created_at` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_section`
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
-- Table structure for table `device_rfid`
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
-- Dumping data for table `device_rfid`
--

INSERT INTO `device_rfid` (`id_device_rfid`, `id_department`, `status`, `data_rfid`, `created_at`, `deleted`) VALUES
(1, 1, 0, '-', 1601257352, 0),
(2, 1, 0, '-', 1601258495, 0);

-- --------------------------------------------------------

--
-- Table structure for table `free_access_room`
--

CREATE TABLE `free_access_room` (
  `id_free_access_room` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
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
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_section`, `id_position`, `nik`, `password`, `nama_karyawan`, `status`, `uid_rfid`, `disable_remarks`, `foto`, `created_at`, `deleted`) VALUES
(1, 1, 6, '180517', '$2a$08$yGVioDCvSJVV8E9Ooummpejb3o94mBWdl5jYrlYzbHdURR8kBNjES', 'Tyto Mysterious', 1, '206B74D9', 0, '20613183535fa34dbe8c103.jpg', 1601077104, 0),
(2, 2, 1, '44422', '$2a$08$3Jp2CTUo89Hou3tcARQz0e2bqjfydL9mAafU/ts3G7a7Hsn1R3SGe', 'Agung', 1, 'F077EDA9', 0, 'default.png', 1601204028, 0),
(3, 1, 1, '22334', '$2a$08$XiYG8uspIU9vVringU2snO6ZVwe50nF1dI8u5rG2gMek7YAyqPkkq', 'Prasetyo', 1, 'B099DFA8', 0, 'default.png', 1601212842, 0),
(4, 1, 3, '44789', '$2a$08$8eYU8n2d2g71dKYjhcLYbucw9C6jlSyaKOcvu9BEwhozFSTd.Elp6', 'Ziya Keinarra', 1, 'CFB12AE2', 0, 'default.png', 1601831062, 0),
(5, 5, 2, '88908', '$2a$08$9bruH/I9Y1xpPheV4C7/D.tkVrD.NMoDQU7ud9XfEE659Abz/3CEi', 'Indrawan', 1, '8FBDDAE1', 0, 'default.png', 1601864946, 0),
(6, 1, 4, '999111', '$2a$08$ZCLq00Bq2B1hXNlAfyrKDebTHQj/Ei8DZS5d/k5xbvDbnsBRH1xzC', 'Santoso', 0, 'FF33BC12', 0, 'default.png', 1603263158, 0),
(7, 7, 2, '888999', '$2a$08$2e1Muilk8a4NS3LXlIV7yeoSdiFW9KWzMuXDzJ5kfKZiN.bcEfxmW', 'Deddy Corbuzier', 1, 'CCA123BB', 0, 'default.png', 1603263290, 0),
(8, 6, 2, '11223344', '$2a$08$pzLt7nL26IotBEg9Kwyu9O63g26pvhsO6y6ZXLi82Gek7S5xY.WTm', 'User Testing', 1, 'c61b5e2b', 0, 'default.png', 1603374186, 0);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `remarks_log` varchar(200) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `access_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `id_room`, `id_karyawan`, `remarks_log`, `keterangan`, `access_time`) VALUES
(1, 2, 1, '-', 'Access Granted', 1603092407),
(2, 2, 1, '-', 'Access Granted', 1603092668),
(3, 2, 1, '-', 'Access Granted', 1603092694),
(4, 6, 1, '-', 'Department Tidak Sesuai', 1603092793),
(5, 1, 1, '-', 'Access Granted', 1603092852),
(6, 1, 2, '-', 'Access Denied, Card Disable', 1603093396),
(7, 1, 2, '-', 'Access Granted', 1603093494),
(8, 2, 2, '-', 'Access Granted', 1603093505),
(9, 1, 2, '-', 'Access Denied, belum isi remarks', 1603262425),
(10, 1, 2, '-', 'Access Denied, belum isi remarks', 1603262434),
(11, 1, 2, '-', 'Access Denied, belum isi remarks', 1603262443),
(12, 1, 2, 'Welding', 'Access Granted', 1603262656),
(13, 1, 4, '-', 'Access Denied, Card Disable', 1603262743),
(14, 1, 4, '-', 'Access Denied, Card Disable', 1603262940),
(15, 1, 4, '-', 'Access Denied, Card Disable', 1603262986),
(16, 1, 4, '-', 'Access Denied, Card Disable', 1603263367),
(17, 1, 4, '-', 'Access Denied, Card Disable', 1603263526),
(18, 1, 4, '-', 'Access Denied, Card Disable', 1603263535),
(19, 1, 4, 'pengecualian, tanpa remarks', 'Access Granted', 1603263640),
(20, 1, 1, '-', 'Access Denied, belum isi remarks', 1603263662),
(21, 1, 7, 'lainnya - mengelas', 'Access Granted', 1603329596),
(22, 1, 7, '-', 'Access Denied, belum isi remarks', 1603329673),
(23, 1, 7, '-', 'Access Denied, belum isi remarks', 1603329706),
(24, 1, 7, 'Borrow Tool - caliper', 'Access Granted', 1603329813),
(25, 1, 1, '-', 'Access Denied, belum isi remarks', 1603339451),
(26, 1, 1, 'Repair Equipment', 'Access Granted', 1603339465),
(27, 1, 1, '-', 'Access Denied, belum isi remarks', 1603358975),
(28, 1, 1, '-', 'Access Denied, belum isi remarks', 1603359271),
(29, 1, 1, '-', 'Access Denied, belum isi remarks', 1603359337),
(30, 1, 1, 'Borrow Tool - bor', 'Access Granted', 1603359591),
(31, 1, 1, 'Borrow Tool - bor', 'Access Granted', 1603359816),
(32, 1, 1, 'Borrow Tool - bor', 'Access Granted', 1603359827),
(33, 1, 1, 'Borrow Tool - bor', 'Access Granted', 1603360370),
(34, 1, 1, 'Borrow Tool - bor', 'Access Granted', 1603360377),
(35, 1, 1, 'Borrow Tool - bor', 'Access Granted', 1603360384),
(36, 1, 1, 'Borrow Tool - bor', 'Access Granted', 1603360562),
(37, 4, 8, '-', 'Access Granted', 1603374469),
(38, 4, 8, '-', 'Access Granted', 1603401252),
(39, 4, 1, '-', 'Access Granted', 1603401261),
(40, 4, 8, '-', 'Access Granted', 1603402711),
(41, 4, 8, '-', 'Access Granted', 1603410967),
(42, 4, 1, '-', 'Access Granted', 1603411181),
(43, 4, 1, '-', 'Access Granted', 1603411190),
(44, 4, 8, '-', 'Access Granted', 1603412134),
(45, 4, 1, '-', 'Access Granted', 1603412145),
(46, 4, 1, '-', 'Access Granted', 1603412281),
(47, 4, 8, '-', 'Access Granted', 1603412293),
(48, 4, 8, '-', 'Access Granted', 1603412618),
(49, 4, 8, '-', 'Access Granted', 1603412800),
(50, 4, 1, '-', 'Access Granted', 1603413046),
(51, 4, 1, '-', 'Access Granted', 1603413394),
(52, 4, 1, '-', 'Access Granted', 1603413653),
(53, 4, 1, '-', 'Access Granted', 1603414130),
(54, 4, 1, '-', 'Access Granted', 1603414469),
(55, 4, 8, '-', 'Access Granted', 1603414656),
(56, 4, 8, '-', 'Access Granted', 1603414831),
(57, 4, 8, '-', 'Access Granted', 1603415640),
(58, 4, 1, '-', 'Access Granted', 1603415795),
(59, 4, 8, '-', 'Access Granted', 1603415813),
(60, 4, 8, '-', 'Access Granted', 1603416324),
(61, 4, 1, '-', 'Access Granted', 1603417335),
(62, 4, 8, '-', 'Access Granted', 1603419256),
(63, 4, 8, '-', 'Access Granted', 1603422564),
(64, 4, 1, '-', 'Access Granted', 1603427516),
(65, 4, 8, '-', 'Access Granted', 1603427523),
(66, 6, 8, '-', 'Department Tidak Sesuai', 1603430924),
(67, 6, 1, '-', 'Department Tidak Sesuai', 1603430928),
(68, 6, 1, '-', 'Department Tidak Sesuai', 1603431456),
(69, 6, 1, '-', 'Department Tidak Sesuai', 1603435185),
(70, 3, 1, '-', 'Access Granted', 1603437084),
(71, 3, 8, '-', 'Access Granted', 1603437645),
(72, 3, 8, '-', 'Access Granted', 1603437727),
(73, 3, 1, '-', 'Access Granted', 1603437734),
(74, 3, 1, '-', 'Access Granted', 1603438014),
(75, 3, 1, '-', 'Access Granted', 1603438738),
(76, 3, 1, '-', 'Access Granted', 1603438784),
(77, 3, 1, '-', 'Access Granted', 1603438853),
(78, 3, 1, '-', 'Access Granted', 1603438914),
(79, 3, 1, '-', 'Access Granted', 1603438957),
(80, 3, 1, '-', 'Access Granted', 1603439101),
(81, 3, 1, '-', 'Access Granted', 1603439110),
(82, 3, 1, '-', 'Access Granted', 1603439120),
(83, 3, 8, '-', 'Access Granted', 1603439134),
(84, 3, 1, '-', 'Access Granted', 1603439226),
(85, 3, 1, '-', 'Access Granted', 1603439233),
(86, 3, 1, '-', 'Access Granted', 1603439240),
(87, 3, 1, '-', 'Access Granted', 1603439247),
(88, 3, 1, '-', 'Access Granted', 1603439254),
(89, 3, 1, '-', 'Access Granted', 1603439262),
(90, 3, 1, '-', 'Access Granted', 1603439277),
(91, 3, 8, '-', 'Access Granted', 1603439678),
(92, 3, 8, '-', 'Access Granted', 1603439759),
(93, 3, 8, '-', 'Access Granted', 1603439768),
(94, 3, 8, '-', 'Access Granted', 1603439827),
(95, 3, 8, '-', 'Access Granted', 1603439834),
(96, 3, 8, '-', 'Access Granted', 1603439841),
(97, 3, 8, '-', 'Access Granted', 1603439868),
(98, 3, 8, '-', 'Access Granted', 1603439891),
(99, 3, 1, '-', 'Access Granted', 1603439951),
(100, 3, 1, '-', 'Access Granted', 1603440984),
(101, 3, 1, '-', 'Access Granted', 1603447898),
(102, 3, 1, '-', 'Access Granted', 1603447929),
(103, 3, 1, '-', 'Access Granted', 1603447938),
(104, 3, 1, '-', 'Access Granted', 1603447950),
(105, 3, 1, '-', 'Access Granted', 1603447957),
(106, 3, 8, '-', 'Access Granted', 1603448203),
(107, 3, 8, '-', 'Access Granted', 1603448211),
(108, 3, 8, '-', 'Access Granted', 1603448219),
(109, 3, 8, '-', 'Access Granted', 1603448256),
(110, 3, 8, '-', 'Access Granted', 1603448302),
(111, 3, 8, '-', 'Access Granted', 1603448310),
(112, 3, 8, '-', 'Access Granted', 1603448317),
(113, 3, 8, '-', 'Access Granted', 1603448325),
(114, 3, 8, '-', 'Access Granted', 1603448331),
(115, 3, 8, '-', 'Access Granted', 1603448339),
(116, 3, 1, '-', 'Access Granted', 1603448586),
(117, 3, 8, '-', 'Access Granted', 1603448763),
(118, 3, 8, '-', 'Access Granted', 1603449120),
(119, 3, 8, '-', 'Access Granted', 1603449318),
(120, 3, 1, '-', 'Access Granted', 1603449327),
(121, 3, 1, '-', 'Access Granted', 1603449549),
(122, 3, 1, '-', 'Access Granted', 1603449923),
(123, 3, 1, '-', 'Access Granted', 1603449933),
(124, 3, 8, '-', 'Access Granted', 1603449941),
(125, 3, 1, '-', 'Access Granted', 1603449957),
(126, 3, 8, '-', 'Access Granted', 1603449966),
(127, 3, 1, '-', 'Access Granted', 1603449976),
(128, 3, 8, '-', 'Access Granted', 1603449995),
(129, 3, 1, '-', 'Access Granted', 1603450034),
(130, 3, 8, '-', 'Access Granted', 1603450042),
(131, 3, 8, '-', 'Access Granted', 1603450055),
(132, 3, 1, '-', 'Access Granted', 1603450124),
(133, 3, 1, '-', 'Access Granted', 1603452569),
(134, 3, 8, '-', 'Access Granted', 1603452577),
(135, 3, 1, '-', 'Access Granted', 1603452746),
(136, 3, 8, '-', 'Access Granted', 1603452755),
(137, 3, 8, '-', 'Access Granted', 1603452767),
(138, 3, 1, '-', 'Access Granted', 1603452777),
(139, 3, 8, '-', 'Access Granted', 1603452890),
(140, 3, 8, '-', 'Access Granted', 1603453022),
(141, 3, 8, '-', 'Access Granted', 1603456635),
(142, 3, 1, '-', 'Access Granted', 1603456642),
(143, 3, 8, '-', 'Access Granted', 1603460231),
(144, 3, 1, '-', 'Access Granted', 1603460243),
(145, 3, 1, '-', 'Access Granted', 1603460302),
(146, 3, 1, '-', 'Access Granted', 1603460311),
(147, 3, 1, '-', 'Access Granted', 1603460319),
(148, 3, 1, '-', 'Access Granted', 1603460361),
(149, 3, 8, '-', 'Access Granted', 1603460370),
(150, 3, 8, '-', 'Access Granted', 1603461068),
(151, 3, 8, '-', 'Access Granted', 1603461440),
(152, 3, 8, '-', 'Access Granted', 1603462471),
(153, 3, 1, '-', 'Access Granted', 1603462570),
(154, 3, 1, '-', 'Access Granted', 1603491261),
(155, 3, 8, '-', 'Access Granted', 1603491275),
(156, 3, 1, '-', 'Access Granted', 1603491291),
(157, 3, 1, '-', 'Access Granted', 1603492110),
(158, 3, 1, '-', 'Access Granted', 1603492134),
(159, 3, 1, '-', 'Access Granted', 1603492154),
(160, 3, 8, '-', 'Access Granted', 1603492170),
(161, 3, 8, '-', 'Access Granted', 1603493842),
(162, 3, 1, '-', 'Access Granted', 1603493854),
(163, 3, 1, '-', 'Access Granted', 1603505942),
(164, 3, 1, '-', 'Access Granted', 1603509586),
(165, 3, 1, '-', 'Access Granted', 1603510222),
(166, 3, 8, '-', 'Access Granted', 1603510266),
(167, 3, 8, '-', 'Access Granted', 1603510335),
(168, 3, 1, '-', 'Access Granted', 1603510877),
(169, 3, 8, '-', 'Access Granted', 1603511599),
(170, 3, 1, '-', 'Access Granted', 1603511607),
(171, 3, 1, '-', 'Access Granted', 1603511624),
(172, 3, 8, '-', 'Access Granted', 1603511631),
(173, 3, 1, '-', 'Access Granted', 1603511645),
(174, 3, 8, '-', 'Access Granted', 1603511653),
(175, 3, 1, '-', 'Access Granted', 1603511739),
(176, 1, 1, '-', 'Access Denied, belum isi remarks', 1603513624),
(177, 1, 1, '-', 'Access Denied, belum isi remarks', 1603513795),
(178, 1, 1, 'Cutting', 'Access Granted', 1603513851),
(179, 1, 8, '-', 'Access Denied, belum isi remarks', 1603513869),
(180, 1, 1, 'Cutting', 'Access Granted', 1603513881),
(181, 1, 1, 'Cutting', 'Access Granted', 1603513985),
(182, 1, 8, '-', 'Access Denied, belum isi remarks', 1603514873),
(183, 1, 1, 'Cutting', 'Access Granted', 1603514878),
(184, 1, 1, 'Cutting', 'Access Granted', 1603516980),
(185, 1, 8, '-', 'Access Denied, belum isi remarks', 1603516989),
(186, 1, 1, 'Cutting', 'Access Granted', 1603517023),
(187, 1, 1, 'Cutting', 'Access Granted', 1603517031),
(188, 1, 1, '-', 'Access Denied, belum isi remarks', 1603518790),
(189, 1, 1, '-', 'Access Denied, belum isi remarks', 1603518797),
(190, 1, 1, '-', 'Access Denied, belum isi remarks', 1603518828),
(191, 1, 8, '-', 'Access Denied, belum isi remarks', 1603518833),
(192, 1, 1, '-', 'Access Denied, belum isi remarks', 1603519924),
(193, 1, 1, 'Repair Equipment', 'Access Granted', 1603519943),
(194, 1, 1, 'Repair Equipment', 'Access Granted', 1603519978),
(195, 6, 1, '-', 'Department Tidak Sesuai', 1603525053),
(196, 6, 8, '-', 'Department Tidak Sesuai', 1603525057),
(197, 6, 8, '-', 'Department Tidak Sesuai', 1603525463),
(198, 6, 8, '-', 'Access Granted', 1603525537),
(199, 6, 8, '-', 'Access Granted', 1603525548),
(200, 6, 1, '-', 'Access Granted', 1603525556),
(201, 6, 1, '-', 'Access Granted', 1603526538),
(202, 6, 1, '-', 'Access Granted', 1603529571),
(203, 6, 1, '-', 'Access Granted', 1603529837),
(204, 1, 1, '-', 'Access Denied, belum isi remarks', 1603536272),
(205, 1, 1, '-', 'Access Denied, belum isi remarks', 1603536277),
(206, 1, 1, 'Welding', 'Access Granted', 1603536722),
(207, 1, 1, 'Welding', 'Access Granted', 1603538989),
(208, 1, 1, '-', 'Access Denied, belum isi remarks', 1603585377),
(209, 1, 1, 'Cutting', 'Access Granted', 1603585489),
(210, 1, 1, 'Cutting', 'Access Granted', 1603585498),
(211, 1, 1, 'Cutting', 'Access Granted', 1603585665),
(212, 1, 1, 'Cutting', 'Access Granted', 1603585691),
(213, 1, 8, '-', 'Access Denied, belum isi remarks', 1603585698),
(214, 1, 8, '-', 'Access Denied, belum isi remarks', 1603585818),
(215, 1, 1, 'Cutting', 'Access Granted', 1603585837),
(216, 1, 1, 'Cutting', 'Access Granted', 1603586101),
(217, 1, 1, 'Cutting', 'Access Granted', 1603586115),
(218, 1, 1, 'Cutting', 'Access Granted', 1603586222),
(219, 1, 1, 'Cutting', 'Access Granted', 1603586255),
(220, 1, 1, 'Cutting', 'Access Granted', 1603586360),
(221, 1, 1, 'Cutting', 'Access Granted', 1603586380),
(222, 1, 1, 'Cutting', 'Access Granted', 1603586594),
(223, 1, 1, 'Cutting', 'Access Granted', 1603586615),
(224, 1, 1, 'Cutting', 'Access Granted', 1603586867),
(225, 1, 1, 'Cutting', 'Access Granted', 1603586906),
(226, 1, 1, 'Cutting', 'Access Granted', 1603586923),
(227, 1, 1, 'Cutting', 'Access Granted', 1603586935),
(228, 1, 1, 'Cutting', 'Access Granted', 1603587212),
(229, 1, 1, 'Cutting', 'Access Granted', 1603587442),
(230, 1, 1, 'Cutting', 'Access Granted', 1603589077),
(231, 1, 1, '-', 'Access Denied, belum isi remarks', 1603589106),
(232, 1, 1, 'Lathe', 'Access Granted', 1603589142),
(233, 1, 1, 'Lathe', 'Access Granted', 1603589153),
(234, 1, 1, 'Lathe', 'Access Granted', 1603589162),
(235, 1, 1, '-', 'Access Denied, belum isi remarks', 1603597135),
(236, 1, 8, '-', 'Access Denied, belum isi remarks', 1603597140),
(237, 1, 8, '-', 'Access Denied, belum isi remarks', 1603597146),
(238, 1, 8, '-', 'Access Denied, belum isi remarks', 1603600515),
(239, 1, 8, '-', 'Access Denied, belum isi remarks', 1603604226),
(240, 1, 1, '-', 'Access Denied, belum isi remarks', 1603604231),
(241, 1, 1, '-', 'Access Denied, belum isi remarks', 1603604235),
(242, 1, 1, '-', 'Access Denied, belum isi remarks', 1603604241),
(243, 1, 8, '-', 'Access Denied, belum isi remarks', 1603604267),
(244, 1, 8, '-', 'Access Denied, belum isi remarks', 1603606463),
(245, 1, 8, '-', 'Access Denied, belum isi remarks', 1603606497),
(246, 1, 1, 'Hydrolic ', 'Access Granted', 1603606503),
(247, 1, 1, 'Hydrolic ', 'Access Granted', 1603606511),
(248, 1, 1, 'Hydrolic ', 'Access Granted', 1603606522),
(249, 1, 1, 'Hydrolic ', 'Access Granted', 1603606530),
(250, 1, 1, 'Hydrolic ', 'Access Granted', 1603606540),
(251, 1, 1, 'Hydrolic ', 'Access Granted', 1603606553),
(252, 1, 1, 'Hydrolic ', 'Access Granted', 1603606572),
(253, 1, 8, '-', 'Access Denied, belum isi remarks', 1603606609),
(254, 1, 8, '-', 'Access Denied, belum isi remarks', 1603606617),
(255, 1, 1, 'Hydrolic ', 'Access Granted', 1603606624),
(256, 1, 1, 'Hydrolic ', 'Access Granted', 1603606646),
(257, 1, 1, 'Hydrolic ', 'Access Granted', 1603606664),
(258, 1, 1, 'Hydrolic ', 'Access Granted', 1603606678),
(259, 1, 1, 'Hydrolic ', 'Access Granted', 1603606688),
(260, 1, 1, 'Hydrolic ', 'Access Granted', 1603606729),
(261, 1, 1, 'Hydrolic ', 'Access Granted', 1603608108),
(262, 3, 1, '-', 'Access Granted', 1603608573),
(263, 6, 1, '-', 'Access Granted', 1603608906),
(264, 3, 1, '-', 'Access Granted', 1603608984),
(265, 3, 1, '-', 'Access Granted', 1603609042),
(266, 3, 1, '-', 'Access Granted', 1603609061),
(267, 1, 1, 'Hydrolic ', 'Access Granted', 1603609130),
(268, 1, 1, 'Hydrolic ', 'Access Granted', 1603609142),
(269, 1, 5, '-', 'Access Denied, belum isi remarks', 1604896553),
(270, 1, 4, 'pengecualian, tanpa remarks', 'Access Granted', 1604896566),
(271, 1, 4, 'pengecualian, tanpa remarks', 'Access Granted', 1604896722),
(272, 1, 4, 'pengecualian, tanpa remarks', 'Access Granted', 1605144322),
(273, 1, 1, '-', 'Access Granted, Free Access Room', 1605144352),
(274, 6, 1, '-', 'Access Granted, Free Access Room', 1605144381),
(275, 5, 1, '-', 'Access Granted, Free Access Room', 1605144390),
(276, 4, 1, '-', 'Access Granted, Free Access Room', 1605144394),
(277, 3, 1, '-', 'Access Granted, Free Access Room', 1605144399),
(278, 2, 1, '-', 'Access Granted, Free Access Room', 1605144402),
(279, 6, 1, '-', 'Access Granted, Free Access Room', 1605144422),
(280, 6, 1, '-', 'Access Granted', 1605144436),
(281, 6, 1, '-', 'Access Granted', 1605144448),
(282, 6, 1, '-', 'Department Tidak Sesuai', 1605144484),
(283, 6, 1, '-', 'Access Denied, Department Tidak Sesuai', 1605144517),
(284, 6, 1, '-', 'Access Granted, Free Access Room', 1605144536),
(285, 6, 1, '-', 'Access Granted, Free Access Room', 1605152490),
(286, 3, 4, '-', 'Access Granted', 1605152552),
(287, 1, 4, 'pengecualian, tanpa remarks', 'Access Granted', 1605152557),
(288, 4, 4, '-', 'Access Denied, akses ruangan ditolak', 1605152589),
(289, 1, 4, 'pengecualian, tanpa remarks', 'Access Granted', 1605152797),
(290, 1, 4, '-', 'Access Denied, belum isi remarks', 1605152821),
(291, 1, 4, '-', 'Access Denied, akses ruangan ditolak', 1605152844),
(292, 1, 4, '-', 'Access Denied, belum isi remarks', 1605152876),
(293, 1, 4, '-', 'Access Denied, akses ruangan ditolak', 1605152962),
(294, 1, 4, '-', 'Access Denied, belum isi remarks', 1605152975),
(295, 1, 4, 'Repair Equipment', 'Access Granted', 1605153054),
(296, 1, 3, '-', 'Access Denied, akses ruangan ditolak', 1605158875),
(297, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606012229),
(298, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606012267),
(299, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606012275),
(300, 1, 1, '-', 'Access Granted', 1606012329),
(301, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606012347),
(302, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606012444),
(303, 1, 1, '-', 'Access Granted', 1606012454),
(304, 1, 1, '-', 'Access Granted', 1606013051),
(305, 1, 1, '-', 'Access Granted', 1606013081),
(306, 1, 8, '-', 'Access Denied, akses ruangan ditolak', 1606013093),
(307, 1, 8, '-', 'Access Denied, akses ruangan ditolak', 1606013362),
(308, 1, 1, '-', 'Access Granted', 1606013369),
(309, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606013480),
(310, 1, 1, '-', 'Access Granted', 1606013554),
(311, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606013574),
(312, 1, 8, '-', 'Access Denied, Department Tidak Sesuai', 1606013940),
(313, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606013993),
(314, 1, 1, '-', 'Access Denied, belum isi remarks', 1606014009),
(315, 1, 8, '-', 'Access Denied, akses ruangan ditolak', 1606014017),
(316, 1, 8, '-', 'Access Denied, akses ruangan ditolak', 1606014222),
(317, 1, 1, '-', 'Access Denied, belum isi remarks', 1606014229),
(318, 1, 1, '-', 'Access Denied, belum isi remarks', 1606021511),
(319, 1, 8, '-', 'Access Denied, akses ruangan ditolak', 1606021525),
(320, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606021556),
(321, 1, 8, '-', 'Access Denied, akses ruangan ditolak', 1606021564),
(322, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606023953),
(323, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606023961),
(324, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606023969),
(325, 1, 8, '-', 'Access Denied, akses ruangan ditolak', 1606023978),
(326, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606023989),
(327, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606024009),
(328, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606025740),
(329, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606025749),
(330, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606028848),
(331, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606028860),
(332, 1, 1, 'pengecualian, tanpa remarks', 'Access Granted', 1606029277),
(333, 1, 2, 'Welding', 'Access Granted', 1610012080),
(334, 5, 2, '-', 'Access Denied, belum isi remarks', 1610012451),
(335, 5, 2, 'lainnya - Photocopy', 'Access Granted', 1610012528),
(336, 5, 1, '-', 'Access Denied, belum isi remarks', 1610012727),
(337, 1, 1, '-', 'Access Denied, belum isi remarks', 1610012738),
(338, 1, 1, 'Repair Equipment', 'Access Granted', 1610012763);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id_position` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
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
-- Table structure for table `public_reader_rfid`
--

CREATE TABLE `public_reader_rfid` (
  `id_public_reader_rfid` int(11) NOT NULL,
  `uid_rfid` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `token` int(11) NOT NULL,
  `last_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `public_reader_rfid`
--

INSERT INTO `public_reader_rfid` (`id_public_reader_rfid`, `uid_rfid`, `status`, `token`, `last_update`) VALUES
(1, '8999f3b3', 0, 5433, 1605279244);

-- --------------------------------------------------------

--
-- Table structure for table `public_remarks`
--

CREATE TABLE `public_remarks` (
  `id_public_remarks` int(11) NOT NULL,
  `remarks_activity` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `public_remarks`
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
-- Table structure for table `remarks_room`
--

CREATE TABLE `remarks_room` (
  `id_remarks_room` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `remarks_text` varchar(200) NOT NULL,
  `waktu_remarks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `remarks_room`
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
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id_room` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `nama_room` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `need_remarks` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `flag_dashboard` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id_room`, `id_department`, `nama_room`, `type`, `need_remarks`, `created_at`, `deleted`, `flag_dashboard`) VALUES
(1, 1, 'Workshop', 'public', 1, 1601043846, 0, 0),
(2, 2, 'Ruang Tunggu', 'public', 0, 1601044256, 0, 1),
(3, 1, 'Boiler 12 Tph', 'restricted', 0, 1601044279, 0, 0),
(4, 1, 'Compressor High Presssure', 'restricted', 0, 1601045652, 0, 0),
(5, 5, 'Production Workshop', 'public', 1, 1603092753, 0, 0),
(6, 2, 'Admin IT Support', 'restricted', 0, 1603092788, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `secret_key`
--

CREATE TABLE `secret_key` (
  `id_key` int(11) NOT NULL,
  `key` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secret_key`
--

INSERT INTO `secret_key` (`id_key`, `key`) VALUES
(1, 'AIOsdLock2020');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` tinyint(2) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_department`, `nama`, `email`, `username`, `password`, `image`, `role`, `deleted`) VALUES
(1, 0, 'Tyto Mulyono', 'tyto@tytomulyono.com', 'tyto', '$2a$08$3WyRJUHBqEG.sQ4yYTLxqOAXyqApz5/4AMZ73kauVsah1QfyKe7yC', 'superadmin.jpg', 1, 0),
(2, 3, 'Admin', 'admin@email.com', 'admin', '$2a$08$3WyRJUHBqEG.sQ4yYTLxqOAXyqApz5/4AMZ73kauVsah1QfyKe7yC', 'defaultadmin.png', 2, 0),
(3, 1, 'Muhammad Arham Ananta', 'arham@gmail.com', 'arham', '$2a$08$1sTh66XJ0NKD9fgsWSoAs.tmDDmRIs.J1mCbUxXxFJRQfg/KtUVoW', '15903374425f6e0a401d7dc.jpg', 2, 0),
(4, 2, 'Ziya Keinarra', 'ziyakeinarra@gmail.com', 'ziya', '$2a$08$4m1RKvjw.U1nG/TEVlks3esPBKWikJ1ZoqOf.k4.h35Mj8WCJzHna', '6163073855f6e06da8b856.jpg', 2, 0),
(5, 6, 'Aeni Mustofiah', 'aenimustafiah@gmail.com', 'aeni', '$2a$08$XFrcMy17eddsemES7QB9wubpsdohWnzKVzrtsLNAv05p2i5In/5VO', '9537669455f6bf17db6af6.jpg', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_room_karyawan`
--
ALTER TABLE `access_room_karyawan`
  ADD PRIMARY KEY (`id_access_room_karyawan`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id_department`);

--
-- Indexes for table `department_section`
--
ALTER TABLE `department_section`
  ADD PRIMARY KEY (`id_section`);

--
-- Indexes for table `device_rfid`
--
ALTER TABLE `device_rfid`
  ADD PRIMARY KEY (`id_device_rfid`);

--
-- Indexes for table `free_access_room`
--
ALTER TABLE `free_access_room`
  ADD PRIMARY KEY (`id_free_access_room`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id_position`);

--
-- Indexes for table `public_reader_rfid`
--
ALTER TABLE `public_reader_rfid`
  ADD PRIMARY KEY (`id_public_reader_rfid`);

--
-- Indexes for table `public_remarks`
--
ALTER TABLE `public_remarks`
  ADD PRIMARY KEY (`id_public_remarks`);

--
-- Indexes for table `remarks_room`
--
ALTER TABLE `remarks_room`
  ADD PRIMARY KEY (`id_remarks_room`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id_room`);

--
-- Indexes for table `secret_key`
--
ALTER TABLE `secret_key`
  ADD PRIMARY KEY (`id_key`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_room_karyawan`
--
ALTER TABLE `access_room_karyawan`
  MODIFY `id_access_room_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id_department` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department_section`
--
ALTER TABLE `department_section`
  MODIFY `id_section` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `device_rfid`
--
ALTER TABLE `device_rfid`
  MODIFY `id_device_rfid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `free_access_room`
--
ALTER TABLE `free_access_room`
  MODIFY `id_free_access_room` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=339;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id_position` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `public_reader_rfid`
--
ALTER TABLE `public_reader_rfid`
  MODIFY `id_public_reader_rfid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `public_remarks`
--
ALTER TABLE `public_remarks`
  MODIFY `id_public_remarks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `remarks_room`
--
ALTER TABLE `remarks_room`
  MODIFY `id_remarks_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `secret_key`
--
ALTER TABLE `secret_key`
  MODIFY `id_key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
