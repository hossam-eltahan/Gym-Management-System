-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2024 at 03:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `membershiphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `membership_type` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `renew_duration` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `renew_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `member_id`, `membership_type`, `amount`, `renew_duration`, `total_amount`, `renew_date`, `expiry_date`) VALUES
(1, 4, 'Basic', 300.00, 1, 300.00, '2024-09-12', '2024-10-12'),
(4, 6, 'Basic', 300.00, 1, 300.00, '2024-09-12', '2024-10-12'),
(5, 6, 'Basic', 300.00, 1, 300.00, '2024-09-12', '2024-10-12'),
(6, 6, 'Basic', 300.00, 1, 300.00, '2024-09-12', '2024-10-12'),
(7, 13, 'Basic', 300.00, 1, 300.00, '2024-09-13', '2024-10-13'),
(8, 6, 'Basic', 300.00, 1, 300.00, '2024-09-13', '2024-10-13'),
(9, 5, 'Basic', 300.00, 1, 300.00, '2024-09-13', '2024-10-13'),
(10, 6, 'Basic', 300.00, 1, 300.00, '2024-09-13', '2024-10-13'),
(11, 6, 'Basic', 300.00, 1, 300.00, '2024-09-13', '2024-10-13'),
(12, 14, 'Basic', 300.00, 1, 300.00, '2024-09-13', '2024-10-13'),
(13, 15, 'Basic', 300.00, 1, 300.00, '2024-09-13', '2024-10-13'),
(14, 17, 'Basic', 300.00, 1, 300.00, '2024-09-14', '2024-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postcode` varchar(20) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `membership_type` int(11) NOT NULL,
  `membership_number` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(255) NOT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `fullname`, `dob`, `gender`, `contact_number`, `email`, `address`, `country`, `postcode`, `occupation`, `membership_type`, `membership_number`, `created_at`, `photo`, `expiry_date`) VALUES
(4, 'Qwerty', '1990-12-12', 'Male', '1010101012', 'qwerty@mail.com', '77 asd', 'aaaaa', '8888', 'addddd', 1, 'CA-610243', '2024-02-04 03:40:16', 'default.jpg', '2024-10-12'),
(5, 'Demo Test', '1990-12-12', 'Female', '7412121455', 'demo@test.com', '77 address', 'testCounty', '1010', 'aaaaaa', 1, 'CA-373031', '2024-02-04 12:23:22', 'default.jpg', '2024-10-13'),
(6, 'Member A', '1990-12-12', 'Female', '1111111100', 'membera@test.com', '11 test', 'TestCountry', '1111', 'Demo', 1, 'CA-159695', '2024-02-05 01:12:53', 'default.jpg', '2024-10-13'),
(9, 'Random Updated', '1989-04-12', 'Female', '1010101010', 'random1989@mail.com', '12 demo', 'qweee', '1111', 'wwwwww', 3, 'CA-871386', '2024-02-05 02:55:03', '1707101703_65c04e07c6d1b.png', '2025-02-05'),
(10, 'Testing Member', '1985-12-12', 'Female', '1212121212', 'testing@mail.com', '77 demo', 'demooo', '1111', 'demodemo', 1, 'CA-519259', '2024-02-05 05:21:32', 'default.jpg', '2024-10-12'),
(13, 'hossam', '2004-02-18', 'Male', '01271191616', 'hossameltahan2004@gmail.com', 'Abusir-samanoud-gharbeia', 'Egypt', '31622', 'active', 1, 'CA-929975', '2024-09-11 19:17:08', 'WhatsApp Image 2024-04-27 at 06.35.55_ffe74ffe_1726082275.jpg', '2024-10-13'),
(14, 'seif waleed elfeky', '2004-03-06', 'Male', '01098025066', 'seifwaleed@gmail.com', 'kafrelthooaban', 'Egypt', '31622', 'awfa', 1, 'CA-599726', '2024-09-11 19:29:57', '1726082997_66e1efb5819e5.jpg', '2024-10-13'),
(15, 'nader', '2017-02-02', 'Male', '01111112', 'nader@gmail.com', '?????? ????? ???????', 'Egypt', '31622', 'no', 1, 'CA-295374', '2024-09-13 15:30:39', 'default.jpg', '2024-10-13'),
(16, 'member 5', '2000-11-11', 'Male', '0123456789', 'member5@gmail.com', 'ElKEMAN', 'Egypt', '000', 'no', 1, 'CA-963013', '2024-09-14 00:04:51', 'default.jpg', NULL),
(17, 'zizo', '2020-11-11', 'Male', '0123654789', 'zizo@gmail.com', 'kafrelthooaban', 'Egypt', '31622', 'no', 1, 'CA-298412', '2024-09-14 00:33:27', 'default.jpg', '2024-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `membership_types`
--

CREATE TABLE `membership_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `membership_types`
--

INSERT INTO `membership_types` (`id`, `type`, `amount`) VALUES
(1, 'Basic', 300),
(3, 'Gold', 1000),
(4, 'Silver', 750),
(6, 'Bronze', 500),
(10, 'Premium', 1200);

-- --------------------------------------------------------

--
-- Table structure for table `renew`
--

CREATE TABLE `renew` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `renew_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `renew`
--

INSERT INTO `renew` (`id`, `member_id`, `total_amount`, `renew_date`) VALUES
(27, 6, 300.00, '2024-09-12'),
(28, 6, 300.00, '2024-09-12'),
(29, 6, 300.00, '2024-09-12'),
(30, 6, 300.00, '2024-09-12'),
(31, 6, 300.00, '2024-09-12'),
(32, 5, 300.00, '2024-09-12'),
(33, 10, 300.00, '2024-09-12'),
(34, 10, 300.00, '2024-09-12'),
(35, 10, 300.00, '2024-09-12'),
(36, 4, 300.00, '2024-09-12'),
(37, 4, 300.00, '2024-09-12'),
(38, 4, 300.00, '2024-09-12'),
(39, 6, 300.00, '2024-09-12'),
(40, 6, 300.00, '2024-09-12'),
(41, 6, 300.00, '2024-09-12'),
(42, 13, 300.00, '2024-09-13'),
(43, 6, 300.00, '2024-09-13'),
(44, 5, 300.00, '2024-09-13'),
(45, 6, 300.00, '2024-09-13'),
(46, 6, 300.00, '2024-09-13'),
(47, 14, 300.00, '2024-09-13'),
(48, 15, 300.00, '2024-09-13'),
(49, 17, 300.00, '2024-09-14');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `system_name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `gym_address` varchar(255) DEFAULT NULL,
  `gym_contact` varchar(255) DEFAULT NULL,
  `gym_email` varchar(255) DEFAULT NULL,
  `gym_manager` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `system_name`, `logo`, `currency`, `gym_address`, `gym_contact`, `gym_email`, `gym_manager`) VALUES
(1, 'Hossam GYM', 'uploads/vecteezy_fitness-and-gym-logo_18795372.ico', '$', 'Abusir-samanoud-gharbeia', '01271191616', 'hossameltahan2004@gmail.com', 'hossam eltahan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `registration_date`, `updated_date`) VALUES
(1, 'admin@mail.com', '0192023a7bbd73250516f069df18b500', '2024-02-02 01:34:26', '2024-09-11 19:10:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_type` (`membership_type`);

--
-- Indexes for table `membership_types`
--
ALTER TABLE `membership_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renew`
--
ALTER TABLE `renew`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `membership_types`
--
ALTER TABLE `membership_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `renew`
--
ALTER TABLE `renew`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`membership_type`) REFERENCES `membership_types` (`id`);

--
-- Constraints for table `renew`
--
ALTER TABLE `renew`
  ADD CONSTRAINT `renew_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
