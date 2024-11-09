-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 01:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `websys_finals`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `date_selected` date NOT NULL,
  `time_selected` varchar(255) NOT NULL,
  `time_of_booking` datetime NOT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `date_selected`, `time_selected`, `time_of_booking`, `worker_id`, `customer_id`) VALUES
(19, '2024-11-21', '01:00 PM', '2024-11-09 19:51:14', 7, 8),
(20, '2024-11-19', '11:00 AM', '2024-11-09 20:15:59', 7, 12),
(21, '2024-11-13', '09:00 AM', '2024-11-09 20:16:08', 9, 12),
(22, '2024-11-29', '09:00 AM', '2024-11-09 20:16:19', 13, 12),
(23, '2024-11-19', '01:00 PM', '2024-11-09 20:16:32', 9, 8),
(24, '2024-11-23', '09:00 AM', '2024-11-09 20:16:45', 13, 8),
(25, '2024-11-20', '12:00 PM', '2024-11-09 20:17:16', 7, 14),
(26, '2024-11-10', '01:00 PM', '2024-11-09 20:17:22', 9, 14),
(27, '2024-11-23', '10:00 AM', '2024-11-09 20:17:29', 13, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker_id` (`worker_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
