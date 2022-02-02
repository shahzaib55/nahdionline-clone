-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Feb 01, 2022 at 02:12 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databas`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_quantity` int(100) NOT NULL,
  `product_usefor` varchar(250) NOT NULL,
  `product_description` varchar(250) NOT NULL,
  `category_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_image`, `product_quantity`, `product_usefor`, `product_description`, `category_id`) VALUES
(2, 'xyz', 50, 'image.jpdg', 5, 'xyz,abc,efg', 'this is description', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `category_id` int(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'yyy', 'this is description');

-- --------------------------------------------------------

--
-- Table structure for table `users_admin`
--

CREATE TABLE `users_admin` (
  `user_id` int(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_roll` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_admin`
--

INSERT INTO `users_admin` (`user_id`, `user_name`, `user_email`, `user_password`, `user_roll`) VALUES
(1, 'ali', 'ali@gmail.com', 'ali123', 'true'),
(2, 'usman', 'usman@gmail.com', 'usman123', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `user_customer`
--

CREATE TABLE `user_customer` (
  `user_id` int(100) NOT NULL,
  `user_firstname` varchar(100) NOT NULL,
  `user_lastname` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_mobileno` bigint(50) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_did` (`category_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `users_admin`
--
ALTER TABLE `users_admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_customer`
--
ALTER TABLE `user_customer`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_admin`
--
ALTER TABLE `users_admin`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_customer`
--
ALTER TABLE `user_customer`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
