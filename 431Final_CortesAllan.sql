-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2024 at 08:46 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `idx` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `FName` varchar(100) NOT NULL,
  `LName` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`idx`, `user_id`, `password`, `FName`, `LName`, `date`, `email`) VALUES
(6, 1771629954439, '$2y$10$5DrmPbPHvs9/iTXPkihPbO9MaVJ8gM/SyZtYi51yiKEAinNgHanau', 'Allan', 'Cortes', '2024-04-22 23:41:05', 'test@test.com'),
(7, 698, '$2y$10$zWko5pLkoIx1RDjqmXWJxO.KIfb9rS5du/ViSR3maH6rXKADb1YNO', 'Alan', 'al', '2024-04-22 23:47:55', 'te@test.com'),
(8, 51091786567, '$2y$10$uCi0/G2MOxZ7UOUju6J9.u.8vMSc/mDYGwZUNUsrO17a4tgf7dl5C', 'Allan', 'Cortes', '2024-04-22 23:49:12', 'Nalla@test.cp'),
(9, 367286276921, '$2y$10$hlljdS0MKVCdHmFe76HbxuiTntNBjk9D6PPvlS8X8jAQSzwfyqDnm', 'Allan', 'Cortes', '2024-04-23 00:04:57', 'ts@tes.com'),
(10, 685380309903748927, '$2y$10$u.sKqFNuoHY6uW7k57Nlx.bPuGk6VM8Mj87vt5fyKMkHGiMobd/UC', 'Allan', 'Cortes', '2024-04-23 00:07:00', 'test@tes23t.com'),
(11, 58031427964114, '$2y$10$rDBN5C3vOPJ4gsmdTmtVFOoCpYvPH0JL1dzDDl/Lp2eRPaaaFzlLm', 'Allan', 'Cortes', '2024-04-24 22:15:17', 'test123@test.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_lists`
--

CREATE TABLE `user_lists` (
  `list_idx` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `User_idx` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_lists`
--

INSERT INTO `user_lists` (`list_idx`, `name`, `created`, `User_idx`) VALUES
(14, 'Monday', '2024-04-30 00:20:04', 6),
(15, 'Tuesday', '2024-04-30 05:17:18', 6),
(16, 'Wednesday', '2024-04-30 05:17:36', 6),
(17, 'thursday', '2024-04-30 05:17:44', 6),
(18, 'friday', '2024-04-30 05:17:59', 6),
(19, 'saturday', '2024-04-30 06:17:10', 6),
(20, 'Sunday', '2024-04-30 06:35:57', 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_lists_items`
--

CREATE TABLE `user_lists_items` (
  `item_idx` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isChecked` tinyint(1) DEFAULT 0,
  `list_idx` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_lists_items`
--

INSERT INTO `user_lists_items` (`item_idx`, `text`, `created`, `isChecked`, `list_idx`) VALUES
(1, 'Dishes', '2024-04-29 17:20:04', 0, 14),
(2, 'Clean Car', '2024-04-29 17:20:04', 0, 14),
(3, 'Clean SHower', '2024-04-29 17:20:04', 0, 14),
(4, 'Laundry', '2024-04-29 17:20:04', 0, 14),
(5, 'Feed kid', '2024-04-29 22:17:18', 0, 15),
(6, 'Feed Dog', '2024-04-29 22:17:18', 0, 15),
(7, 'Feed Self', '2024-04-29 22:17:18', 0, 15),
(8, 'Pay water', '2024-04-29 22:17:36', 0, 16),
(9, 'Pay gas', '2024-04-29 22:17:36', 0, 16),
(10, 'pay myself', '2024-04-29 22:17:36', 0, 16),
(11, 'pay tax', '2024-04-29 22:17:36', 0, 16),
(12, 'sleep early', '2024-04-29 22:17:44', 0, 17),
(13, 'watch basketball', '2024-04-29 22:17:59', 0, 18),
(14, 'cry because my team lost', '2024-04-29 22:17:59', 0, 18),
(15, 'idk', '2024-04-29 23:17:10', 0, 19),
(16, '', '2024-04-29 23:35:57', 0, 20);

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
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_lists`
--
ALTER TABLE `user_lists`
  MODIFY `list_idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_lists_items`
--
ALTER TABLE `user_lists_items`
  MODIFY `item_idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
