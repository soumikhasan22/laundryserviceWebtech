-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2024 at 08:47 PM
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
-- Database: `db_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `laundry_requests`
--

CREATE TABLE `laundry_requests` (
  `request_id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `customer_contact` varchar(20) DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `pickup_time` time DEFAULT NULL,
  `laundered_items` text DEFAULT NULL,
  `special_instruction` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laundry_requests`
--

INSERT INTO `laundry_requests` (`request_id`, `customer_name`, `customer_address`, `customer_contact`, `pickup_date`, `pickup_time`, `laundered_items`, `special_instruction`) VALUES
(19438, 'hasan', 'rr', '01823456783', '2024-09-20', '23:55:00', 'rrrr', 'rrrrrrrr'),
(19461, 'hh', 'hh', '01714242062', '2024-09-05', '23:59:00', 'h', 'h'),
(73016, 'soumik', 'kk', '01717242062', '2024-09-27', '23:55:00', 'kk', 'kk'),
(75162, 'fahad', 'rrrr', '01714242062', '2024-09-05', '00:32:00', 'llll', 'llll');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `request_id` int(11) NOT NULL,
  `delivery_status` varchar(50) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `review_star` int(11) DEFAULT NULL,
  `review_comment` text DEFAULT NULL,
  `shop_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`request_id`, `delivery_status`, `payment_status`, `review_star`, `review_comment`, `shop_name`) VALUES
(19438, 'delivered', 'paid', 1, 'kk', 'qq'),
(19461, 'pending', 'unpaid', 2, 'hh', NULL),
(73016, 'delivered', 'paid', 2, 'kk', 'ss'),
(75162, 'pending', 'unpaid', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laundry_requests`
--
ALTER TABLE `laundry_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`request_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
