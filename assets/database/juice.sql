-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2021 at 09:01 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xyz`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `receipt_no` int(11) NOT NULL,
  `per` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `price`, `qty`, `date`, `receipt_no`, `per`) VALUES
(24, 110, 10, '2021-10-19', 1, 15),
(26, 50, 4, '2021-10-19', 2, 15),
(27, 70, 10, '2021-10-19', 3, 15),
(24, 110, 5, '2021-10-20', 4, 20),
(24, 100, 5, '2021-10-20', 5, 20),
(21, 15, 50, '2021-10-21', 6, 0),
(21, 15, 1, '2021-10-21', 7, 0),
(21, 15, 1, '2021-10-21', 8, 0),
(21, 15, 1, '2021-10-21', 9, 0),
(21, 15, 1, '2021-10-21', 10, 0),
(21, 15, 1, '2021-10-21', 11, 0),
(21, 15, 1, '2021-10-21', 12, 0),
(21, 15, 1, '2021-10-21', 13, 0),
(21, 15, 1, '2021-10-21', 14, 0),
(21, 15, 1, '2021-10-21', 15, 0),
(21, 15, 1, '2021-10-21', 16, 0),
(21, 15, 1, '2021-10-21', 17, 0),
(21, 15, 1, '2021-10-21', 18, 0),
(21, 15, 1, '2021-10-21', 19, 0),
(18, 20, 10, '2021-10-21', 20, 0),
(21, 15, 10, '2021-10-21', 21, 0),
(18, 20, 10, '2021-10-21', 22, 44),
(21, 15, 10, '2021-10-21', 23, 33),
(21, 15, 10, '2021-10-21', 24, 33);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) DEFAULT NULL,
  `total_qty` int(11) DEFAULT NULL,
  `rem_qty` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `total_qty`, `rem_qty`, `date`) VALUES
(17, 100, 70, '2021-10-13'),
(18, 500, 500, '2021-10-13'),
(19, 200, 200, '2021-10-13'),
(21, 50, 50, '2021-10-13'),
(17, 100, 100, '2021-10-12'),
(22, 10, 5, '2021-10-13'),
(17, 100, 100, '2021-10-14'),
(22, 50, 20, '2021-10-14'),
(17, 10, -16, '2021-10-15'),
(17, 40, -441, '2021-10-18'),
(22, 100, -138, '2021-10-18'),
(20, 200, 178, '2021-10-18'),
(18, 100, 19, '2021-10-18'),
(24, 40, -35, '2021-10-18'),
(19, 100, 84, '2021-10-18'),
(21, 100, 99, '2021-10-18'),
(23, 100, 100, '2021-10-18'),
(17, 5, -5, '2021-10-19'),
(19, 100, 89, '2021-10-19'),
(24, 20, 10, '2021-10-19'),
(26, 10, 4, '2021-10-19'),
(27, 20, 10, '2021-10-19'),
(24, 10, 0, '2021-10-20'),
(21, 100, 7, '2021-10-21'),
(18, 34, 14, '2021-10-21');

-- --------------------------------------------------------

--
-- Table structure for table `item_list`
--

CREATE TABLE `item_list` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `percentage` float NOT NULL DEFAULT 20
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`id`, `name`, `price`, `percentage`) VALUES
(17, 'Apple', 40, 20),
(18, 'Watermelon', 20, 44),
(19, 'Lemon', 25, 0),
(20, 'Orange', 50, 0),
(21, 'Muskmelon', 15, 33),
(22, 'Pinaple', 50, 0),
(23, 'Mango', 70, 0),
(24, 'Kiwi', 100, 20),
(25, 'Banana', 60, 15),
(26, 'Tomato', 50, 20),
(27, 'Custard Apple', 90, 20),
(29, 'Guava', 110, 15);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `role`) VALUES
('chakram', '*EB3494DA620D4E2E6BC9B303F70245E2DB8BB912', 'ChakramAdmin'),
('juice', '*A3500A3EB9359DBBFB3D833BEBFBD55738B1156A', 'JuiceAdmin'),
('siet_admin', '*5E63CCEB02EA26E74AC90305DAEC59ECE2A508D1', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `stock_update`
--

CREATE TABLE `stock_update` (
  `id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_update`
--

INSERT INTO `stock_update` (`id`, `qty`, `date`) VALUES
(17, 100, '2021-10-13'),
(18, 500, '2021-10-13'),
(19, 200, '2021-10-13'),
(21, 50, '2021-10-13'),
(22, 10, '2021-10-13'),
(17, 100, '2021-10-14'),
(22, 50, '2021-10-14'),
(17, 10, '2021-10-15'),
(17, 40, '2021-10-18'),
(22, 100, '2021-10-18'),
(20, 200, '2021-10-18'),
(18, 100, '2021-10-18'),
(24, 40, '2021-10-18'),
(19, 100, '2021-10-18'),
(21, 100, '2021-10-18'),
(23, 100, '2021-10-18'),
(17, 5, '2021-10-19'),
(19, 100, '2021-10-19'),
(24, 20, '2021-10-19'),
(26, 10, '2021-10-19'),
(27, 20, '2021-10-19'),
(24, 10, '2021-10-20'),
(21, 100, '2021-10-21'),
(18, 34, '2021-10-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`receipt_no`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD KEY `id` (`id`);

--
-- Indexes for table `item_list`
--
ALTER TABLE `item_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `stock_update`
--
ALTER TABLE `stock_update`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `receipt_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `billing_ibfk_1` FOREIGN KEY (`id`) REFERENCES `item_list` (`id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`id`) REFERENCES `item_list` (`id`);

--
-- Constraints for table `stock_update`
--
ALTER TABLE `stock_update`
  ADD CONSTRAINT `stock_update_ibfk_1` FOREIGN KEY (`id`) REFERENCES `item_list` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
