-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 30, 2016 at 08:06 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wuftarchive`
--

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

CREATE TABLE `relations` (
  `video_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relations`
--

INSERT INTO `relations` (`video_id`, `tag_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 3),
(4, 4),
(5, 4),
(21, 3),
(23, 3),
(24, 3),
(27, 0),
(27, 1),
(28, 0),
(28, 1),
(29, 0),
(29, 1),
(30, 0),
(30, 1),
(31, 3),
(31, 2),
(32, 3),
(33, 3),
(33, 2),
(34, 3),
(34, 2),
(35, 3),
(35, 2),
(36, 3),
(36, 2),
(37, 3),
(37, 2),
(37, 1),
(38, 3),
(38, 2),
(38, 1),
(39, 3),
(40, 3),
(41, 3),
(42, 3),
(42, 1),
(42, 2),
(43, 3),
(44, 6),
(44, 7),
(43, 8),
(43, 9),
(43, 10),
(43, 11),
(43, 12),
(45, 12),
(51, 17),
(52, 17),
(53, 17);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `video_id` int(4) NOT NULL,
  `requester` text NOT NULL,
  `tag` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `video_id`, `requester`, `tag`) VALUES
(20, 54, 'Andrew Briz', 'Government'),
(21, 54, 'Andrew Briz', 'Gainesville Police Department'),
(22, 54, 'Andrew Briz', ' Marion County Sheriff\\''s Office'),
(23, 54, 'Andrew Briz', 'Alachua County Sheriff\\''s Office');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'cars'),
(2, 'students'),
(3, 'UF'),
(4, 'basketball'),
(5, 'police'),
(7, 'Gainesville'),
(8, 'Alachua County'),
(9, 'Marion County'),
(10, 'Football'),
(11, 'Police'),
(12, 'Ocala'),
(13, 'Downtown'),
(14, 'Micanopy'),
(15, 'Beaty Towers'),
(16, 'Weimer Hall'),
(17, 'O''Dome'),
(18, 'Running/Walking');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49),
(50),
(51),
(52),
(53);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
