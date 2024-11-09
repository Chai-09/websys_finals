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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `user_role` varchar(10) NOT NULL DEFAULT 'user',
  `status` varchar(8) NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_role`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Paul Aeron Guillermo', 'paulaeronguillermo@gmail.com', '$2y$10$EBUTGzt9uv5BWzxpFFaB2e6PVCtdZE7okxTkm3R7NfiTzxzpLxfQK', 'head_admin', 'Active', '2024-10-25 21:20:36', '2024-10-25 21:20:36'),
(7, 'Amiel Bicaldo', 'amiel@gmail.com', '$2y$10$4c/UFgNmHKWLP7odWHtjP.fu6mp.3Evk4N2G/5PWze3vJvKcZQxHe', 'worker', 'Active', '2024-10-25 21:30:55', '2024-10-25 21:30:55'),
(8, 'ernesto', 'gabe@gmail.com', '$2y$10$PNcbajAc/.QhPRS0K46qz.0iZ6TJqfjz6qGaxp8t3gW8b6sJFaxHq', 'user', 'Active', '2024-10-25 23:29:01', '2024-10-25 23:29:01'),
(9, 'Jay \"Sarap\" San Pascual Jr.', 'jay@gmail.com', '$2y$10$VV9E3koLk2X6MsKJKiptRul5fjFESwbF5hXZdhhrNx/E.JSKM4gYW', 'worker', 'Active', '2024-10-26 21:52:39', '2024-10-26 21:52:39'),
(12, 'brandon', 'brandon@gmail.com', '$2y$10$RpjXmLHlQwXJ7rbInE5KC..G/yIbBd6RDmtGbcQZjp3blrQ2wFRly', 'user', 'Active', '2024-11-04 09:18:37', '2024-11-04 09:18:37'),
(13, 'Him', 'him@gmail.com', '$2y$10$5.gEMqSSd.r3tSpuA0xxr.bq60TGY523lU/EkkY4.ExFJWHp8hRfW', 'worker', 'Active', '2024-11-04 09:45:26', '2024-11-04 09:45:26'),
(14, 'moist', 'moist@gmail.com', '$2y$10$KDJTet0zdq.tBGp/JDbhvu8Og751Ik/1rOoSeHv1UtCA/YwI6Jb4W', 'user', 'Active', '2024-11-08 20:21:22', '2024-11-08 20:21:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
