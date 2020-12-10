-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 01, 2020 at 02:16 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pusdiklat_uty_asli`
--

-- --------------------------------------------------------

--
-- Table structure for table `boking_kelas`
--

CREATE TABLE `boking_kelas` (
  `id` int(11) NOT NULL,
  `id_akun_user` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_tarif` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `tanggal_pesan` datetime NOT NULL,
  `status_boking` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `boking_kelas`
--

INSERT INTO `boking_kelas` (`id`, `id_akun_user`, `id_kelas`, `id_tarif`, `id_ujian`, `tanggal_pesan`, `status_boking`, `is_active`, `date_created`) VALUES
(6, 14, 5, 33, 44, '2020-09-26 00:00:00', 'Terboking', 0, 1601129043),
(7, 12, 3, 29, 47, '2020-09-26 00:00:00', 'Terboking', 0, 1601129146);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `nama`, `value`) VALUES
(1, 'kepala', 'Umar Zaky, M.Cs.'),
(2, 'sidebar', '0'),
(3, 'nama', 'Pusdiklat & Sertifikasi UTY');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alias` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama`, `alias`) VALUES
(1, 'Fakultas Bisnis, Psikologi dan Komunikasi', 'FBPK'),
(2, 'Fakultas Teknologi Informasi dan Elektro', 'FTIE'),
(3, 'Fakultas Sains dan Teknologi', 'FST'),
(4, 'Fakultas Humaniora, Pendidikan dan Pariwisata', 'FHPP');

-- --------------------------------------------------------

--
-- Table structure for table `history_user`
--

CREATE TABLE `history_user` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ip_address` varchar(128) NOT NULL,
  `browser` varchar(256) NOT NULL,
  `sistem_operasi` varchar(256) NOT NULL,
  `status` varchar(38) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history_user`
--

INSERT INTO `history_user` (`id`, `id_user`, `ip_address`, `browser`, `sistem_operasi`, `status`, `time`) VALUES
(804, 1, '::1', 'Chrome 84.0.4147.125', 'Mac OS X', 'logout', 1597943553),
(805, 1, '::1', 'Chrome 84.0.4147.125', 'Mac OS X', 'login', 1597943556),
(806, 2, '::1', 'Chrome 84.0.4147.125', 'Mac OS X', 'logout', 1597943767),
(807, 1, '::1', 'Chrome 84.0.4147.125', 'Mac OS X', 'login', 1597943903),
(808, 1, '::1', 'Chrome 84.0.4147.125', 'Mac OS X', 'logout', 1597943919),
(809, 1, '::1', 'Chrome 84.0.4147.125', 'Mac OS X', 'login', 1597945534),
(810, 1, '::1', 'Chrome 84.0.4147.125', 'Mac OS X', 'login', 1597950760),
(811, 1, '::1', 'Chrome 84.0.4147.125', 'Mac OS X', 'logout', 1597950796),
(812, 1, '::1', 'Chrome 84.0.4147.125', 'Mac OS X', 'login', 1597983302),
(813, 1, '::1', 'Chrome 84.0.4147.125', 'Mac OS X', 'logout', 1597984092),
(814, 1, '::1', 'Chrome 84.0.4147.125', 'Mac OS X', 'login', 1597984294),
(815, 1, '::1', 'Chrome 84.0.4147.125', 'Mac OS X', 'logout', 1597984698),
(816, 1, '::1', 'Chrome 84.0.4147.125', 'Mac OS X', 'login', 1597990038),
(817, 1, '::1', 'Chrome 84.0.4147.125', 'Mac OS X', 'logout', 1597990136),
(818, 1, '::1', 'Chrome 84.0.4147.125', 'Mac OS X', 'login', 1598004388),
(819, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598012847),
(820, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598016530),
(821, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598016661),
(822, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598020152),
(823, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598020284),
(824, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598021863),
(825, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598023578),
(826, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598023653),
(827, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598024442),
(828, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598024452),
(829, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598027099),
(830, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598027177),
(831, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598047227),
(832, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598047291),
(833, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598047395),
(834, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598048589),
(835, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598048593),
(836, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598048647),
(837, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598048651),
(838, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598048679),
(839, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598048683),
(840, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598048700),
(841, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598048704),
(842, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598050272),
(843, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598050276),
(844, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598050288),
(845, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598050292),
(846, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598050304),
(847, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598050309),
(848, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598066325),
(849, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598066385),
(850, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598066399),
(851, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598066409),
(852, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598174438),
(853, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598174933),
(854, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598800671),
(855, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598800792),
(856, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598800796),
(857, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598800804),
(858, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598800808),
(859, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598801560),
(860, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598801563),
(861, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598801587),
(862, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598801591),
(863, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598801633),
(864, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598801636),
(865, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598801671),
(866, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598801676),
(867, 1, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598801749),
(868, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'login', 1598801753),
(869, 15, '::1', 'Chrome 84.0.4147.135', 'Mac OS X', 'logout', 1598802672),
(870, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600067480),
(871, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600067714),
(872, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600067718),
(873, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600069667),
(874, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600069670),
(875, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600070560),
(876, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600070564),
(877, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600193865),
(878, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600194192),
(879, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600194195),
(880, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600194290),
(881, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600194295),
(882, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600194518),
(883, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600194522),
(884, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600194990),
(885, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600195039),
(886, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600228259),
(887, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600229041),
(888, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600229087),
(889, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600230256),
(890, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600230262),
(891, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600232334),
(892, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600232337),
(893, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600233070),
(894, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600233073),
(895, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600254387),
(896, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600265898),
(897, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600265908),
(898, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600330506),
(899, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600330513),
(900, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600330523),
(901, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600330583),
(902, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600330587),
(903, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600331046),
(904, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600666094),
(905, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600666409),
(906, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600666448),
(907, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600666457),
(908, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600666460),
(909, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600666627),
(910, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600666632),
(911, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600666696),
(912, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600666803),
(913, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600667026),
(914, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600667031),
(915, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600667118),
(916, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600667123),
(917, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600668411),
(918, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600668438),
(919, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600669383),
(920, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600776809),
(921, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600780209),
(922, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600780348),
(923, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600780410),
(924, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600780413),
(925, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600780435),
(926, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600780442),
(927, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600780461),
(928, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600780523),
(929, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600780556),
(930, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600780559),
(931, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600780580),
(932, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600780584),
(933, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600780898),
(934, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600780906),
(935, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600780922),
(936, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600780925),
(937, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600780941),
(938, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600780945),
(939, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600781266),
(940, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600782066),
(941, 12, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600782158),
(942, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600782162),
(943, 15, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600783771),
(944, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1600936611),
(945, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1600939830),
(946, 6, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1601117551),
(947, 6, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1601117560),
(948, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'login', 1601117564),
(949, 1, '::1', 'Chrome 85.0.4183.102', 'Mac OS X', 'logout', 1601117688),
(950, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601120521),
(951, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601120612),
(952, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601120654),
(953, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601120927),
(954, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601120934),
(955, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601121290),
(956, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601121295),
(957, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601121625),
(958, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601121632),
(959, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601122337),
(960, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601122344),
(961, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601122738),
(962, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601122741),
(963, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601122831),
(964, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601122836),
(965, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601123372),
(966, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601123376),
(967, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601123976),
(968, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601123985),
(969, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601124050),
(970, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601124054),
(971, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601124082),
(972, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601124086),
(973, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601124251),
(974, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601124255),
(975, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601124320),
(976, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601124324),
(977, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601124387),
(978, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601124394),
(979, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601125539),
(980, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601125543),
(981, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601125633),
(982, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601125640),
(983, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601125669),
(984, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601125673),
(985, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601126012),
(986, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601126015),
(987, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601126267),
(988, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601126271),
(989, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601126386),
(990, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601126389),
(991, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601126437),
(992, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601126459),
(993, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601126482),
(994, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601126485),
(995, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601126506),
(996, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601126514),
(997, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601126526),
(998, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601126529),
(999, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601126538),
(1000, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601126647),
(1001, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601127296),
(1002, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601127299),
(1003, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601128122),
(1004, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601128146),
(1005, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601128158),
(1006, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601128353),
(1007, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601128395),
(1008, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601128397),
(1009, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601128407),
(1010, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601128969),
(1011, 14, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601129054),
(1012, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601129057),
(1013, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601129082),
(1014, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601129086),
(1015, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601129159),
(1016, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601129162),
(1017, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601129172),
(1018, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601129177),
(1019, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601129660),
(1020, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601129665),
(1021, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601140571),
(1022, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601144040),
(1023, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601144043),
(1024, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601144078),
(1025, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601144083),
(1026, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601144190),
(1027, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601144193),
(1028, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601144225),
(1029, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601144229),
(1030, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601145308),
(1031, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601145316),
(1032, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601145366),
(1033, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601145369),
(1034, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601145411),
(1035, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601198130),
(1036, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601198534),
(1037, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601198542),
(1038, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601198788),
(1039, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601198791),
(1040, 6, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601198802),
(1041, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601198805),
(1042, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601204125),
(1043, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601353353),
(1044, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601353368),
(1045, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601353373),
(1046, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601354045),
(1047, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601354049),
(1048, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601354153),
(1049, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601354160),
(1050, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601356957),
(1051, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601356960),
(1052, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601357216),
(1053, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601357224),
(1054, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601358050),
(1055, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601358061),
(1056, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601394842),
(1057, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601394895),
(1058, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601394898),
(1059, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601394920),
(1060, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601394924),
(1061, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601447711),
(1062, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601448838),
(1063, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601448841),
(1064, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601448957),
(1065, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601448961),
(1066, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601448969),
(1067, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601448972),
(1068, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601449031),
(1069, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601449036),
(1070, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601449252),
(1071, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601449257),
(1072, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601449405),
(1073, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601449408),
(1074, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601451417),
(1075, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601451420),
(1076, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601451459),
(1077, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601451462),
(1078, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601451466),
(1079, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601523781),
(1080, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601523835),
(1081, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601523839),
(1082, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601658615),
(1083, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601658622),
(1084, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601658627),
(1085, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601658861),
(1086, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601658864),
(1087, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601659917),
(1088, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601660474),
(1089, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601661724),
(1090, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601715233),
(1091, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601715921),
(1092, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601794498),
(1093, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601795466),
(1094, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601796136),
(1095, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601797415),
(1096, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601797418),
(1097, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601797432),
(1098, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601797435),
(1099, 15, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601797446),
(1100, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601797930),
(1101, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601798491),
(1102, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601800432),
(1103, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601800491),
(1104, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601800508),
(1105, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601800514),
(1106, 18, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601801603),
(1107, 18, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601801635),
(1108, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601801638),
(1109, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601801657),
(1110, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601822532),
(1111, 1, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'logout', 1601823217),
(1112, 12, '::1', 'Chrome 85.0.4183.121', 'Mac OS X', 'login', 1601823222),
(1113, 20, '::1', 'Chrome 87.0.4280.67', 'Mac OS X', 'login', 1606788905),
(1114, 20, '::1', 'Chrome 87.0.4280.67', 'Mac OS X', 'logout', 1606788927);

-- --------------------------------------------------------

--
-- Table structure for table `institusi`
--

CREATE TABLE `institusi` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `institusi`
--

INSERT INTO `institusi` (`id`, `nama`) VALUES
(1, 'Universitas Teknologi Yogyakarta');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pendaftar`
--

CREATE TABLE `jenis_pendaftar` (
  `id` int(11) NOT NULL,
  `nama_jenis` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_pendaftar`
--

INSERT INTO `jenis_pendaftar` (`id`, `nama_jenis`) VALUES
(1, 'Internal (Mahasiswa UTY)'),
(2, 'Internal (Dosen UTY)'),
(3, 'Internal (Karyawan UTY)'),
(4, 'Eksternal Kerjasama (SMK N 1 Klaten)'),
(5, 'Partner'),
(6, 'Eksternal');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_sertifikasi`
--

CREATE TABLE `jenis_sertifikasi` (
  `id_sertifikasi` int(11) NOT NULL,
  `nama_sertifikasi` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_sertifikasi`
--

INSERT INTO `jenis_sertifikasi` (`id_sertifikasi`, `nama_sertifikasi`) VALUES
(1, 'Microsoft Office Specialist'),
(2, 'Microsoft Technology Acsociate'),
(3, 'Microsoft Certified Education'),
(4, 'Microsoft Technical Academi');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_ujian`
--

CREATE TABLE `jenis_ujian` (
  `id_ujian` int(11) NOT NULL,
  `jenis_sertifikasi` varchar(256) NOT NULL,
  `id_sertifikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_ujian`
--

INSERT INTO `jenis_ujian` (`id_ujian`, `jenis_sertifikasi`, `id_sertifikasi`) VALUES
(44, 'Word', 1),
(45, 'Excel', 1),
(46, 'Powerpoint', 1),
(47, 'Programming Java ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `ruangan` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `kuota` int(11) NOT NULL,
  `sisa_kuota` int(11) NOT NULL,
  `id_proctor` int(11) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `ruangan`, `lokasi`, `tanggal`, `kuota`, `sisa_kuota`, `id_proctor`, `status`) VALUES
(1, 'Reguler A', '', '', '1601223960', 20, 0, 6, 'Buka'),
(2, 'Reguler B', '', '', '1591092600', 20, 0, 7, 'Buka'),
(3, 'Reguler C', '', '', '1601140020', 20, 16, 6, 'Buka'),
(5, 'Reguler D', 'LK 7', 'Kampus 1 UTY', '1601140080', 20, 16, 6, 'Buka');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_kat`
--

CREATE TABLE `pembayaran_kat` (
  `id` int(11) NOT NULL,
  `status_pembayaran` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pembayaran_kat`
--

INSERT INTO `pembayaran_kat` (`id`, `status_pembayaran`) VALUES
(1, 'Lunas'),
(2, 'Belum lunas'),
(3, 'Belum bayar');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id` int(11) NOT NULL,
  `id_akun_user` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_boking` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `no_slip` varchar(100) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `bukti_bayar` varchar(500) NOT NULL,
  `status` enum('Pending','Terverifikasi','') NOT NULL,
  `presensi` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id`, `id_akun_user`, `id_kelas`, `id_boking`, `id_ujian`, `no_slip`, `tanggal_bayar`, `bukti_bayar`, `status`, `presensi`, `nilai`, `keterangan`) VALUES
(6, 14, 5, 6, 44, '123', '2020-09-26', 'CamScanner_08-03-2020_15_41_42_15.jpg', 'Terverifikasi', 1, 900, 'Lulus'),
(7, 12, 3, 7, 47, '000', '2020-09-26', 'CamScanner_08-03-2020_15_41_42_16.jpg', 'Terverifikasi', 1, 80, 'Lulus');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `akreditas` varchar(5) NOT NULL,
  `id_fakultas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `nama`, `akreditas`, `id_fakultas`) VALUES
(1, 'D3 Akuntansi', 'A', 1),
(2, 'S1 Hubungan Internasional', 'C', 1),
(3, 'S1 Psikologi', 'B', 1),
(4, 'S1 Manajemen', 'A', 1),
(5, 'S1 Akuntansi ', 'A', 1),
(6, 'S1 Ilmu Komunikasi', 'B', 1),
(7, 'D3 Sistem Informasi', 'A', 2),
(8, 'S1 Teknik Komputer', 'B', 2),
(9, 'S1 Informatika', 'A', 2),
(10, 'S1 Sistem Informasi ', 'B', 2),
(11, 'S1 Data Science', 'C', 2),
(12, 'S1 Informatika Medis ', 'C', 2),
(13, 'S1 Teknik Elektro ', 'B', 2),
(14, 'S1 Teknik Industri', 'B', 3),
(15, 'S1 Arsitektur', 'A', 3),
(16, 'S1 Teknik Sipil ', 'B', 3),
(17, 'S1 Perencanaan Wilayah Kota', 'B', 3),
(18, 'S1 Perencanaan Wilayah Kota', 'B', 4),
(19, 'D3 Bahasa Jepang', 'B', 4),
(20, 'S1 Sastra Inggris', 'B', 4),
(21, 'S1 Bimbingan dan Konseling', 'B', 4),
(22, 'S1 Pendidikan Bahasa Inggris', 'B', 4),
(23, 'S1 Pendidikan Teknologi Informasi', 'B', 4),
(24, 'D4 Destinasi Pariwisata', 'C', 4);

-- --------------------------------------------------------

--
-- Table structure for table `saran`
--

CREATE TABLE `saran` (
  `id_saran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sertifikasi_kat`
--

CREATE TABLE `sertifikasi_kat` (
  `id` int(11) NOT NULL,
  `nama_sertifikasi` varchar(130) NOT NULL,
  `alias` varchar(256) NOT NULL,
  `std_nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sertifikasi_kat`
--

INSERT INTO `sertifikasi_kat` (`id`, `nama_sertifikasi`, `alias`, `std_nilai`) VALUES
(1, 'Microsoft Office Specialist', 'MOS', 700),
(2, 'Microsoft Technology Associate', 'MTA', 70),
(3, 'Microsoft Certified Educator', 'MCE', 70),
(4, 'Microsoft Technical Certifications', 'MTC', 70);

-- --------------------------------------------------------

--
-- Table structure for table `spesifikasi`
--

CREATE TABLE `spesifikasi` (
  `id` int(11) NOT NULL,
  `id_sertifikasi` int(11) NOT NULL,
  `spesifikasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `spesifikasi`
--

INSERT INTO `spesifikasi` (`id`, `id_sertifikasi`, `spesifikasi`) VALUES
(1, 1, 'Word office 365/2019'),
(2, 1, 'Word 2016'),
(3, 1, 'Word 2013'),
(4, 1, 'Word 2010'),
(5, 1, 'Word expert office 365/2019'),
(6, 1, 'Word expert 2016'),
(7, 1, 'Word expert 2013'),
(8, 1, 'Word expert 2010'),
(9, 1, 'Excel office 365/2019'),
(10, 1, 'Excel 2016'),
(11, 1, 'Excel 2013'),
(12, 1, 'Excel 2010'),
(13, 1, 'Excel expert office 365/2019'),
(14, 1, 'Excel expert 2016'),
(15, 1, 'Excel expert 2013'),
(16, 1, 'Excel expert 2010'),
(17, 1, 'PowerPoint office 365/2019'),
(18, 1, 'PowerPoint 2016'),
(19, 1, 'PowerPoint 2013'),
(20, 1, 'PowerPoint 2010'),
(21, 1, 'Outlook 2016'),
(22, 1, 'Outlook 2013'),
(23, 1, 'Outlook 2010'),
(24, 1, 'Access 2016'),
(25, 1, 'Access 2013'),
(26, 1, 'Access 2010'),
(27, 1, 'SharePoint 2013'),
(28, 1, 'SharePoint 2010'),
(29, 1, 'OneNote 2013'),
(30, 1, 'OneNote 2010'),
(31, 2, 'Software Development Fundamentals (98-361)'),
(32, 2, 'Cloud Fundamentals (98-369)'),
(33, 2, 'Mobility and Device Fundamentals (98-368)'),
(34, 2, 'HTML5 Application Development Fundamentals (98-375)'),
(35, 2, 'Introduction to Programming using Block-Based Languages (98-380)'),
(36, 2, 'Introduction to Programming using Python (98-381)'),
(37, 2, 'Introduction to Programming using JavaScript (98-382)'),
(38, 2, 'Introduction to Programming using HTML and CSS(98-383)'),
(39, 2, 'Introduction to Programming using Java (98-388)'),
(40, 2, 'Windows Operating System Fundamentals (98-349) '),
(41, 2, 'Windows Server Administration Fundamentals (98-365)'),
(42, 2, 'Networking Fundamentals (98-366)'),
(43, 2, 'Security Fundamentals (98-367)'),
(44, 2, 'Database Fundamentals (98-364)'),
(45, 3, 'Technology Literacy for Educators'),
(46, 4, 'Azure Fundamentals(AZ-900)'),
(47, 4, 'Microsoft 365 Fundamentals(MS-900)'),
(48, 4, 'Microsoft Dynamics 365 Fundamentals(MB-901)'),
(49, 4, 'Microsoft Power Platform Fundamentals(PL-900)');

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `id` int(11) NOT NULL,
  `tarif` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`id`, `tarif`, `id_jenis`, `id_ujian`) VALUES
(29, 150000, 1, 44),
(30, 150000, 1, 45),
(31, 150000, 1, 46),
(33, 200000, 1, 44),
(34, 200000, 1, 44);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `no_identitas` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` varchar(128) NOT NULL,
  `jns_kelamin` varchar(20) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `institusi` int(11) NOT NULL,
  `program_studi` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `last_active` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL,
  `img_identitas` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `no_identitas`, `nama_lengkap`, `tempat_lahir`, `tgl_lahir`, `jns_kelamin`, `no_hp`, `id_jenis`, `institusi`, `program_studi`, `email`, `username`, `password`, `role`, `last_active`, `is_active`, `img_identitas`, `image`) VALUES
(1, '', '', '', '', '', '', 0, 0, 0, 'adminsystem@gmail.com', 'admin-system', '$2y$10$W5AOOKL7ubySPJV1KMHAGu4FniYXsyuVtlCnAm3aEhP0CjdnqY/Eq', 1, '1601823217', 1, '', 'default.svg'),
(2, '', '', '', '', '', '', 0, 0, 0, 'trainingbahasa@gmail.com', 'training-bahasa', '$2y$10$W5AOOKL7ubySPJV1KMHAGu4FniYXsyuVtlCnAm3aEhP0CjdnqY/Eq', 2, '0000000000', 1, '', 'default.svg'),
(3, '', '', '', '', '', '', 0, 0, 0, 'exambahasa@gmail.com', 'exam-bahasa', '$2y$10$W5AOOKL7ubySPJV1KMHAGu4FniYXsyuVtlCnAm3aEhP0CjdnqY/Eq', 3, '0000000000', 1, '', 'default.svg'),
(4, '', '', '', '', '', '', 0, 0, 0, 'trainingsertifikasi@gmail.com', 'training-sertifikasi', '$2y$10$W5AOOKL7ubySPJV1KMHAGu4FniYXsyuVtlCnAm3aEhP0CjdnqY/Eq', 4, '0000000000', 1, '', 'default.svg'),
(5, '', '', '', '', '', '', 0, 0, 0, 'examsertifikasi@gmail.com', 'exam-sertifikasi', '$2y$10$W5AOOKL7ubySPJV1KMHAGu4FniYXsyuVtlCnAm3aEhP0CjdnqY/Eq', 5, '0000000000', 1, '', 'default.svg'),
(6, '', '', '', '', '', '', 0, 0, 0, 'proctor1@gmail.com', 'proctor-1', '$2y$10$W5AOOKL7ubySPJV1KMHAGu4FniYXsyuVtlCnAm3aEhP0CjdnqY/Eq', 7, '1601198802', 1, '', 'default.svg'),
(7, '', '', '', '', '', '', 0, 0, 0, 'proctor2@gmail.com', 'proctor-2', '$2y$10$W5AOOKL7ubySPJV1KMHAGu4FniYXsyuVtlCnAm3aEhP0CjdnqY/Eq', 7, '0000000000', 1, '', 'default.svg'),
(12, '5170411373', 'Jody Septiawan', 'Amasing Kota', '1999-09-03', '1', '081241535360', 1, 1, 9, 'jody.septiawan5@gmail.com', 'jodyseptiawan', '$2y$10$W5AOOKL7ubySPJV1KMHAGu4FniYXsyuVtlCnAm3aEhP0CjdnqY/Eq', 6, 'Online', 1, '', 'default.svg'),
(14, '5170411336', 'Ilham Fathullah', '', '1111-11-11', '1', '111111111', 4, 1, 0, 'ilhamfathullah@yahoo.co.id', 'ilham_fathulah', '$2y$10$W5AOOKL7ubySPJV1KMHAGu4FniYXsyuVtlCnAm3aEhP0CjdnqY/Eq', 6, '1601129054', 1, '', 'default.svg'),
(15, '', '', '', '', '', '', 0, 0, 0, 'pusdiklat@gmail.com', 'admin-pusdiklat', '$2y$10$W5AOOKL7ubySPJV1KMHAGu4FniYXsyuVtlCnAm3aEhP0CjdnqY/Eq', 11, '1601797446', 1, '', 'default.svg'),
(18, '5170411356', 'Rahmad Kurniadi', '', '2020-10-31', '1', '0823747782', 1, 1, 9, 'rahmadkurniadi@gmail.com', 'rahmadkurniadi', '$2y$10$1HdZklNZUmEHQvvTla9G0ODZH/YPvtVm7bsCGbMfNLqzNVavooc0O', 6, '1601801635', 1, '', 'default.svg'),
(19, '5170411330', 'Ade Rohmat Maulana', '', '2004-06-10', '1', '081236735473', 1, 1, 9, 'aderohmat@gmail.com', 'aderohmat', '$2y$10$6g5IwCdt8QxwdBv3MWb/NeiHsP3MFfXJYj0F5X17UBI1Hi3LvHeAa', 6, '0000000000', 1, '', 'default.svg'),
(20, '517399', 'hamdi', '', '2020-12-01', '1', '081234399', 1, 1, 13, 'hamdi@gmail.com', 'hamdi', '$2y$10$xerJp/pzZINMyxHQPBKRZ.FwtQQjFHmz7d4IWEwDD491rKmzP4qxu', 6, '1606788927', 1, '', 'default.svg');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 11),
(2, 1, 10),
(3, 1, 12),
(4, 11, 5),
(5, 11, 6),
(6, 11, 7),
(7, 11, 8),
(8, 11, 9),
(9, 1, 13),
(10, 1, 14),
(11, 1, 15),
(12, 6, 4),
(14, 7, 16),
(15, 6, 2),
(16, 6, 1),
(17, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `title`, `is_active`) VALUES
(1, 'Pelatihan Bahasa', 1),
(2, 'Ujian Bahasa', 1),
(3, 'Pelatihan Sertifikasi', 1),
(4, 'Ujian Sertifikasi', 1),
(6, 'Admin Pelatihan Bahasa', 1),
(7, 'Admin Ujian Bahasa', 1),
(8, 'Admin Pelatihan Sertifikasi', 1),
(9, 'Admin Ujian Sertifikasi', 1),
(10, 'Kelola User', 1),
(11, 'Kelola Menu', 1),
(13, 'Kelola Sertifikasi', 1),
(14, 'Kelola Bahasa', 0),
(15, 'Kelola Data Umum', 1),
(16, 'Proctor Ujian Sertifikasi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(130) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'Admin System'),
(2, 'Admin Pelatihan Bahasa'),
(3, 'Admin Ujian Bahasa'),
(4, 'Admin Pelatihan Sertifikasi'),
(5, 'Admin Ujian Sertifikasi'),
(6, 'User'),
(7, 'Proctor Ujian Sertifikasi'),
(8, 'Proctor Pelatihan Sertifikasi\r\n'),
(9, 'Proctor Ujian Bahasa'),
(10, 'Proctor Pelatihan Bahasa'),
(11, 'Admin pusdiklat');

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
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 10, 'Member', 'kelola_user/member', 'fa fa-cog', 1),
(2, 10, 'Admin & Staff', 'kelola_user/admin', 'fa fa-cog', 1),
(3, 11, 'Menu management', 'kelola_web/menu', 'fa fa-cog', 1),
(4, 11, 'Menu akses', 'kelola_web/menuakses', 'fa fa-cog', 1),
(5, 15, 'Fakultas', 'kelola_web/fakultas', 'fa fa-cog', 1),
(6, 15, 'Institusi', 'kelola_web/institusi', 'fa fa-cog', 1),
(7, 13, 'Spesifikasi', 'kelola_web/spesifikasi', 'fa fa-cog', 1),
(8, 15, 'Program Studi', 'kelola_web/prodi', 'fa fa-cog', 1),
(9, 13, 'Sertifikasi', 'kelola_web/sertifikasi', 'fa fa-cog', 1),
(10, 9, 'Jadwal & kelas', 'kelola_sertifikasi/kelas', 'fa fa-fw fa-folder-open', 1),
(11, 9, 'Laporan', 'rekap', 'fa fa-fw fa-folder-open', 1),
(12, 8, 'Coming Soon', 'admin', 'fa fa-fw fa-folder-open', 1),
(13, 6, 'Coming Soon', 'admin', 'fa fa-fw fa-folder-open', 1),
(14, 7, 'Coming Soon', 'admin', 'fa fa-fw fa-folder-open', 1),
(15, 9, 'Kelas', 'admin/kelas', 'fa fa-fw fa-folder-open', 1),
(16, 15, 'Jenis Pendaftar', 'kelola_web/jenis_pendaftar', 'fa fa-cog', 1),
(17, 9, 'Verifikasi Pembayaran', 'admin/verifikasi_pembayaran', 'fa fa-fw fa-folder-open', 1),
(18, 4, 'Ujian Sertifikasi', 'sertifikasi/ujian_sertifikasi', 'fa fa-fw fa-folder-open', 1),
(19, 4, 'Status Pendaftaran', 'sertifikasi/status_pendaftaran', 'fa fa-fw fa-folder-open', 1),
(20, 10, 'Role', 'kelola_user/role', 'fa fa-cog', 1),
(21, 16, 'Presensi & Nilai', 'ptr', 'fa fa-university', 1),
(22, 1, 'Coming Soon', 'mbr', 'fa fa-fw fa-folder-open	', 1),
(23, 2, 'Coming Soon', 'mbr', 'fa fa-fw fa-folder-open	', 1),
(24, 3, 'Coming Soon', 'mbr', 'fa fa-fw fa-folder-open	', 1),
(25, 9, 'Tarif', 'admin/tarif', 'fa fa-fw fa-folder-open	', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boking_kelas`
--
ALTER TABLE `boking_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_user`
--
ALTER TABLE `history_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institusi`
--
ALTER TABLE `institusi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_pendaftar`
--
ALTER TABLE `jenis_pendaftar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran_kat`
--
ALTER TABLE `pembayaran_kat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saran`
--
ALTER TABLE `saran`
  ADD PRIMARY KEY (`id_saran`);

--
-- Indexes for table `sertifikasi_kat`
--
ALTER TABLE `sertifikasi_kat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spesifikasi`
--
ALTER TABLE `spesifikasi`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boking_kelas`
--
ALTER TABLE `boking_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `history_user`
--
ALTER TABLE `history_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1115;

--
-- AUTO_INCREMENT for table `institusi`
--
ALTER TABLE `institusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jenis_pendaftar`
--
ALTER TABLE `jenis_pendaftar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran_kat`
--
ALTER TABLE `pembayaran_kat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `saran`
--
ALTER TABLE `saran`
  MODIFY `id_saran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sertifikasi_kat`
--
ALTER TABLE `sertifikasi_kat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `spesifikasi`
--
ALTER TABLE `spesifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
