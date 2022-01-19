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