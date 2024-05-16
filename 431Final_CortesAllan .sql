-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2024 at 03:13 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `431Final_CortesAllan`
--
CREATE DATABASE IF NOT EXISTS `431Final_CortesAllan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `431Final_CortesAllan`;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `idx` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `FName` varchar(100) NOT NULL,
  `LName` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_lists`
--

DROP TABLE IF EXISTS `user_lists`;
CREATE TABLE `user_lists` (
  `list_idx` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `User_idx` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_lists_items`
--

DROP TABLE IF EXISTS `user_lists_items`;
CREATE TABLE `user_lists_items` (
  `item_idx` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isChecked` tinyint(1) DEFAULT 0,
  `list_idx` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`idx`);

--
-- Indexes for table `user_lists`
--
ALTER TABLE `user_lists`
  ADD PRIMARY KEY (`list_idx`),
  ADD KEY `fk_user_table` (`User_idx`);

--
-- Indexes for table `user_lists_items`
--
ALTER TABLE `user_lists_items`
  ADD PRIMARY KEY (`item_idx`),
  ADD KEY `fk_TDL` (`list_idx`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_lists`
--
ALTER TABLE `user_lists`
  MODIFY `list_idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_lists_items`
--
ALTER TABLE `user_lists_items`
  MODIFY `item_idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_lists`
--
ALTER TABLE `user_lists`
  ADD CONSTRAINT `fk_user_table` FOREIGN KEY (`User_idx`) REFERENCES `Users` (`idx`);

--
-- Constraints for table `user_lists_items`
--
ALTER TABLE `user_lists_items`
  ADD CONSTRAINT `fk_TDL` FOREIGN KEY (`list_idx`) REFERENCES `user_lists` (`list_idx`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
