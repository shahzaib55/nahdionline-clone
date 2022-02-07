--
-- Database: `databas`
--
CREATE DATABASE databas;
-- --------------------------------------------------------
USE databas;
--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS`users` (
  `user_id` int(30) NOT NULL AUTO_INCREMENT,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `user_email` varchar(80) NOT NULL,
  `user_mobileno` bigint(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) 

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS`product_category` (
  `category_id` int(30) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `category_description` varchar(100) NOT NULL
   PRIMARY KEY (`category_id`)
)
--
-- Insert data into table `users`
--
INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_email`, `user_mobileno`, `user_password`) VALUES
(1, 'usman', 'ali', 'ab@gmail.com', 123, 'admin'),
(2, 'bilal', 'haider', 'haider@gmail.com', 304, '12345'),
(4, 'waseem', 'abbas', 'waseem@gmail.com', 3333, '54321');


--
-- Insert data into table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'category1', 'this is category 1.'),
(4, 'category2', 'this is category 2.'),
(6, 'category3', 'this is category 3.');