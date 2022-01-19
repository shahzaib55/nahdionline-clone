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
-- Insert data into table `users`
--
INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_email`, `user_mobileno`, `user_password`) VALUES
(1, 'usman', 'ali', 'ab@gmail.com', 123, 'admin'),
(2, 'bilal', 'haider', 'haider@gmail.com', 304, '12345'),
(4, 'waseem', 'abbas', 'waseem@gmail.com', 3333, '54321');