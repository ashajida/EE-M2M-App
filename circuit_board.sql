-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2019 at 12:04 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `circuit_board`
--

-- --------------------------------------------------------

--
-- Table structure for table `board_status`
--

CREATE TABLE `board_status` (
  `switchOne` varchar(4) NOT NULL,
  `switchTwo` varchar(4) NOT NULL,
  `switchThree` varchar(4) NOT NULL,
  `switchFour` varchar(4) NOT NULL,
  `fan` varchar(10) NOT NULL,
  `temperature` int(4) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keypad` int(1) NOT NULL,
  `id` int(11) NOT NULL,
  `msisdn` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `board_status`
--

INSERT INTO `board_status` (`switchOne`, `switchTwo`, `switchThree`, `switchFour`, `fan`, `temperature`, `date`, `keypad`, `id`, `msisdn`) VALUES
('OFF', 'ON', 'OFF', 'ON', 'REVE', 12, '2000-02-22 00:00:00', 2, 3, '447817814149');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(19, '$_norah', '$2y$10$v7D.NV73Yku74iRVVgCsGOPleUKgaoHOIUZDtvcaSznZCJ7euPvt2'),
(20, '$_adam', '$2y$10$lKYvNe8a5V15D/xbbpBnleo7yy1KYrAMuXRLLfLdOqtDBo1H/eHzO'),
(21, '$_ash', '$2y$10$0HOO3tC8G/QF2NJUV3JJ6eu1AzmkGlYc32Qn1HAboDdy/NFp49Bxm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `board_status`
--
ALTER TABLE `board_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `board_status`
--
ALTER TABLE `board_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
