-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 10, 2021 at 10:01 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `email_sub`
--

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `email_id`, `email`, `host`, `created_date`) VALUES
(3, '1cda5c9fbb', 'dbzx@hotmail.com', 'hotmail', '2021-08-08 12:33:34'),
(7, '8cf145f94b', 'ab@gmail.com', 'gmail', '2021-08-08 16:06:56'),
(8, '5d9112d411', 'gw@outlook.lv', 'outlook', '2021-08-08 16:23:22'),
(9, 'a330964920', 'vova@yahoo.lv', 'yahoo', '2021-08-08 17:27:44'),
(13, '3c3131b81a', 'h@gmail.com', 'gmail', '2021-08-08 19:39:37'),
(14, 'e0cfdabf7f', 'fdb@a.lv', 'a', '2021-08-09 03:37:01'),
(15, '0d72026a49', 'timeis@wrong.com', 'wrong', '2021-08-09 04:35:50'),
(16, '1416205968', 'nowwhatistime@gmail.com', 'gmail', '2021-08-09 04:39:38'),
(17, '567bcc3061', 'subscribed@gmail.com', 'gmail', '2021-08-09 04:41:17'),
(18, '342c0c7bca', 'a@b.lv', 'b', '2021-08-09 06:15:54'),
(21, 'ad12efc052', 'qwerty@gmail.com', 'gmail', '2021-08-09 06:49:55'),
(22, '38d891375b', 'last@one.lv', 'one', '2021-08-09 12:13:27'),
(33, 'fbe7d86264', 'tnrs@dfnbzdf.co', 'dfnbzdf', '2021-08-10 07:47:43'),
(34, '1a0286796b', 'zsgnbzd@fnxggdb.co', 'fnxggdb', '2021-08-10 07:49:11'),
(35, '7ae5433767', 'hbasdhg@sgfnfgxsd.com', 'sgfnfgxsd', '2021-08-10 07:56:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
