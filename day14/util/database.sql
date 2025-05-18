-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2025 at 07:15 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `accountId` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `user_type` enum('admin','users') NOT NULL,
  `isLogin` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accountId`, `email`, `username`, `password`, `user_type`, `isLogin`, `created_at`) VALUES
(24, 'Anuada@gmail.com', 'ericson12', '$2y$10$BA.wvrJi5SwMnTXhsFVDZuGHtC8SQoOm4LkQlvsmtMoNKugTHYmR.', 'admin', 1, '2025-05-17 16:49:26'),
(26, 'mike@gmail.com', 'mike12', '$2y$10$mqJ74zrkU.8sjppiABqHKeQ.e1.b.3EkMFNdu2Dq5h1Za4DLXwOUC', 'admin', 1, '2025-05-17 16:53:30'),
(28, 'milo@gmail.com', 'milo', '$2y$10$2PsqyOblt6s91wxUSmwdve1wbjle8uOU3TyfOfSSP3QS3DIvH2fv6', 'users', 0, '2025-05-18 16:12:58'),
(29, 'eric@gmail.com', 'd', '$2y$10$s.uKRpNbnUZQ0JW3dTluCeJpljkkTaYLJ3.yQkpLKKDBGm/wHSk36', 'users', 0, '2025-05-18 16:17:26'),
(31, 'sdffsfd@', 'fffg', '$2y$10$L.BvHrhILbKWUBuQdbcksOUABzUDPw8HrYMTtl/xuDxawoFua1UGm', 'admin', 0, '2025-05-18 17:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `accountId` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `contactNo` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `accountId`, `fname`, `lname`, `contactNo`, `address`) VALUES
(7, 24, 'Ericson', 'Anuada', '097834334', 'Cebu City'),
(8, 26, 'MIke', 'Garlon', '879342', 'jomar'),
(9, 31, 'sds', 'sdfdsf', '657', 'fdfd@');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `accountId` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `contactNo` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `accountId`, `fname`, `lname`, `contactNo`, `address`) VALUES
(2, 28, 'Micheals', 'Libatoxz', '096475843', 'San Miguel'),
(3, 29, 'Jhon', 'loyd', '123', 'Lorega');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`accountId`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`),
  ADD KEY `admin_ibfk_1` (`accountId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `users_ibfk_1` (`accountId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
