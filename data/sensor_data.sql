-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2023 at 01:30 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kopi`
--

-- --------------------------------------------------------

--
-- Table structure for table `sensor_data`
--

CREATE TABLE `sensor_data` (
  `id` int(11) NOT NULL,
  `tanggaljam` datetime DEFAULT NULL,
  `suhu` int(11) DEFAULT NULL,
  `pH` int(11) DEFAULT NULL,
  `kelembaban` int(11) DEFAULT NULL,
  `kondisi` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sensor_data`
--

INSERT INTO `sensor_data` (`id`, `tanggaljam`, `suhu`, `pH`, `kelembaban`, `kondisi`) VALUES
(1, '2023-12-30 22:18:20', 31, 3, 32, 1),
(2, '2023-12-29 00:54:40', 27, 6, 68, 2),
(3, '2023-12-14 05:17:04', 32, 2, 33, 3),
(4, '2023-12-06 19:34:20', 15, 4, 36, 1),
(5, '2023-12-03 06:25:09', 28, 0, 63, 2),
(6, '2023-12-02 02:38:32', 24, 7, 79, 1),
(7, '2023-11-30 07:48:12', 33, 8, 77, 2),
(8, '2023-11-30 04:14:25', 16, 7, 77, 2),
(9, '2023-11-24 22:49:05', 27, 6, 35, 1),
(10, '2023-11-20 05:45:56', 32, 10, 57, 3),
(11, '2023-11-10 02:25:34', 17, 10, 32, 3),
(12, '2023-11-02 16:57:13', 32, 3, 79, 2),
(13, '2023-10-17 04:50:45', 27, 8, 68, 2),
(14, '2023-09-24 04:01:09', 31, 0, 44, 1),
(15, '2023-09-21 19:57:54', 17, 0, 73, 2),
(16, '2023-09-07 12:30:17', 15, 14, 32, 2),
(17, '2023-08-28 03:07:10', 25, 10, 32, 3),
(18, '2023-08-12 00:44:20', 28, 8, 80, 1),
(19, '2023-08-08 22:57:26', 28, 11, 66, 1),
(20, '2023-07-15 02:47:12', 35, 2, 31, 3),
(21, '2023-07-15 02:42:37', 34, 13, 78, 3),
(22, '2023-07-02 12:15:04', 16, 14, 64, 2),
(23, '2023-06-30 19:47:21', 29, 1, 70, 3),
(24, '2023-06-14 22:35:30', 24, 5, 46, 3),
(25, '2023-06-08 04:45:52', 35, 14, 64, 2),
(26, '2023-05-20 00:46:47', 35, 6, 69, 2),
(27, '2023-05-19 09:54:11', 20, 7, 32, 2),
(28, '2023-05-19 00:12:06', 29, 13, 78, 2),
(29, '2023-05-15 22:04:07', 31, 9, 77, 1),
(30, '2023-05-15 12:22:24', 29, 9, 64, 1),
(31, '2023-05-07 11:11:29', 35, 9, 39, 3),
(32, '2023-05-07 08:57:49', 17, 11, 57, 2),
(33, '2023-04-21 17:48:52', 27, 11, 80, 2),
(34, '2023-04-13 09:20:13', 15, 14, 66, 2),
(35, '2023-04-09 10:25:11', 15, 14, 31, 2),
(36, '2023-04-08 06:17:08', 29, 1, 75, 1),
(37, '2023-03-27 04:38:08', 17, 0, 66, 1),
(38, '2023-03-13 17:10:55', 28, 6, 57, 2),
(39, '2023-03-13 02:41:14', 20, 2, 52, 2),
(40, '2023-03-10 18:17:15', 26, 8, 31, 3),
(41, '2023-03-07 19:52:27', 20, 5, 47, 3),
(42, '2023-02-18 11:59:58', 33, 14, 31, 2),
(43, '2023-02-16 01:37:48', 31, 14, 78, 1),
(44, '2023-02-09 13:49:12', 24, 4, 49, 3),
(45, '2023-02-07 14:04:29', 25, 2, 65, 3),
(46, '2023-02-03 02:39:40', 29, 6, 78, 1),
(47, '2023-01-30 16:28:06', 31, 6, 45, 1),
(48, '2023-01-22 22:39:12', 19, 12, 67, 3),
(49, '2023-01-12 15:45:13', 22, 12, 34, 1),
(50, '2023-01-10 18:44:06', 16, 3, 39, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sensor_data`
--
ALTER TABLE `sensor_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sensor_data`
--
ALTER TABLE `sensor_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
