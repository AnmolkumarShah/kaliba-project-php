-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:4000
-- Generation Time: Jun 16, 2021 at 09:43 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kaliba_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`item_id`, `item_name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Tea', 15, '2021-06-09 23:34:14', NULL),
(2, 'Coffee', 20, '2021-06-09 23:35:20', NULL),
(3, 'Samosa', 25, '2021-06-09 23:35:45', NULL),
(4, 'Tarri Poha', 20, '2021-06-09 23:36:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_table`
--

CREATE TABLE `orders_table` (
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` double NOT NULL,
  `received_by` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_table`
--

INSERT INTO `orders_table` (`order_id`, `item_id`, `quantity`, `total_amount`, `received_by`, `order_date`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 50, 7, '2021-06-10 13:54:40', '2021-06-10 13:54:40', NULL),
(2, 4, 5, 100, 6, '2021-06-10 13:56:11', '2021-06-10 13:56:11', NULL),
(3, 1, 1, 15, 6, '2021-06-10 14:00:00', '2021-06-10 14:00:00', NULL),
(4, 1, 2, 30, 6, '2021-06-10 14:00:23', '2021-06-10 14:00:23', NULL),
(5, 1, 2, 30, 7, '2021-06-10 14:56:21', '2021-06-10 14:56:21', NULL),
(6, 2, 1, 20, 7, '2021-06-10 15:01:53', '2021-06-10 15:01:53', NULL),
(11, 3, 2, 50, 8, '2021-06-10 15:09:09', '2021-06-10 15:09:09', NULL),
(12, 1, 1, 15, 8, '2021-06-10 15:15:44', '2021-06-10 15:15:44', NULL),
(13, 1, 3, 45, 8, '2021-06-10 15:19:51', '2021-06-10 15:19:51', NULL),
(14, 1, 2, 30, 7, '2021-06-10 15:25:21', '2021-06-10 15:25:21', NULL),
(15, 4, 2, 40, 7, '2021-06-11 13:17:03', '2021-06-11 13:17:03', NULL),
(16, 3, 4, 100, 8, '2021-06-11 13:23:27', '2021-06-11 13:23:27', NULL),
(17, 2, 5, 100, 8, '2021-06-11 13:28:48', '2021-06-11 13:28:48', NULL),
(22, 4, 1, 20, 8, '2021-06-16 00:44:52', '2021-06-16 00:44:52', NULL),
(23, 1, 2, 30, 7, '2021-06-16 12:11:34', '2021-06-16 12:11:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`user_id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(6, 'Sham', 'sham@gmail.com', '123456', '2021-06-10 11:36:53', NULL),
(7, 'Ram', 'ram@gmail.com', '123456', '2021-06-10 11:37:45', NULL),
(8, 'Komal', 'komal@gmail.com', '123456', '2021-06-10 11:38:32', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders_table`
--
ALTER TABLE `orders_table`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `received_by` (`received_by`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders_table`
--
ALTER TABLE `orders_table`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders_table`
--
ALTER TABLE `orders_table`
  ADD CONSTRAINT `orders_table_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`),
  ADD CONSTRAINT `orders_table_ibfk_2` FOREIGN KEY (`received_by`) REFERENCES `users_table` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
