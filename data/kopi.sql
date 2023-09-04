-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2023 at 01:45 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(12) NOT NULL,
  `password` varchar(64) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `details`) VALUES
('admin', 'admin', 'Admin 2'),
('gesangpj', 'admin', 'Admin 1');

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE `sensor` (
  `tanggaljam` datetime NOT NULL,
  `suhu` int(11) NOT NULL,
  `pH` int(11) NOT NULL,
  `kelembapan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sensor_data`
--

CREATE TABLE `sensor_data` (
  `id` int(11) NOT NULL,
  `tanggaljam` datetime DEFAULT NULL,
  `suhu` int(11) DEFAULT NULL,
  `pH` int(11) DEFAULT NULL,
  `kelembapan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sensor_data`
--

INSERT INTO `sensor_data` (`id`, `tanggaljam`, `suhu`, `pH`, `kelembapan`) VALUES
(1, '2023-12-17 21:14:16', 26, 13, 38),
(2, '2023-12-10 12:26:39', 33, 1, 77),
(3, '2023-12-07 01:01:10', 27, 6, 75),
(4, '2023-11-13 20:37:37', 28, 6, 77),
(5, '2023-11-10 07:55:08', 19, 3, 40),
(6, '2023-11-10 04:35:03', 32, 12, 73),
(7, '2023-11-09 06:33:33', 32, 0, 55),
(8, '2023-11-01 09:35:36', 34, 9, 35),
(9, '2023-10-25 21:22:57', 34, 14, 48),
(10, '2023-09-28 09:04:53', 21, 12, 79),
(11, '2023-09-09 12:40:29', 17, 1, 44),
(12, '2023-09-02 23:21:33', 30, 7, 58),
(13, '2023-08-29 16:43:27', 25, 13, 43),
(14, '2023-08-16 19:48:56', 29, 10, 50),
(15, '2023-08-14 11:18:00', 20, 3, 76),
(16, '2023-07-18 13:18:33', 18, 11, 66),
(17, '2023-07-17 08:39:47', 23, 14, 76),
(18, '2023-07-12 07:52:15', 31, 12, 67),
(19, '2023-06-29 13:32:10', 18, 7, 50),
(20, '2023-06-24 11:08:31', 24, 13, 52),
(21, '2023-06-16 00:50:02', 33, 5, 59),
(22, '2023-06-15 15:00:19', 19, 1, 52),
(23, '2023-06-14 03:25:19', 17, 13, 40),
(24, '2023-06-11 02:58:26', 19, 4, 44),
(25, '2023-05-30 04:57:41', 18, 2, 42),
(26, '2023-05-25 15:04:12', 31, 3, 79),
(27, '2023-05-19 19:05:23', 34, 13, 79),
(28, '2023-05-16 02:31:24', 19, 9, 48),
(29, '2023-04-28 18:32:25', 18, 8, 46),
(30, '2023-04-28 15:29:16', 17, 3, 63),
(31, '2023-04-22 15:01:48', 34, 6, 39),
(32, '2023-04-21 19:15:16', 29, 5, 70),
(33, '2023-04-18 08:08:55', 16, 10, 65),
(34, '2023-04-12 18:08:20', 17, 13, 60),
(35, '2023-04-08 22:22:46', 16, 3, 33),
(36, '2023-04-05 10:44:17', 28, 11, 70),
(37, '2023-04-01 01:07:42', 25, 6, 55),
(38, '2023-03-26 15:33:26', 17, 4, 41),
(39, '2023-03-24 15:48:36', 23, 9, 42),
(40, '2023-03-18 00:26:49', 25, 8, 59),
(41, '2023-03-10 10:09:58', 26, 7, 47),
(42, '2023-03-07 22:35:37', 24, 1, 42),
(43, '2023-03-07 11:42:57', 19, 5, 62),
(44, '2023-03-04 12:06:48', 23, 5, 51),
(45, '2023-02-12 04:21:53', 24, 10, 56),
(46, '2023-02-11 20:35:38', 32, 1, 69),
(47, '2023-02-10 09:52:01', 19, 0, 34),
(48, '2023-02-04 03:02:23', 21, 11, 71),
(49, '2023-01-21 10:57:00', 32, 3, 71),
(50, '2023-01-06 18:55:17', 29, 12, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`tanggaljam`);

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
