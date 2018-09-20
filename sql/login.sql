-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2018 at 04:46 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

DELIMITER $$
--
-- Procedures
--
CREATE PROCEDURE `insert` (IN `username` VARCHAR(50), IN `pass` VARCHAR(50), IN `name` VARCHAR(50), IN `number` VARCHAR(20), IN `id` VARCHAR(50))  NO SQL
INSERT into login(login.username, login.password, login.full_name, login.mobile_number, login.created_date, login.id) values (username, pass, name, number, CURRENT_DATE, id )$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `mobile_number` varchar(12) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `full_name`, `mobile_number`, `created_date`, `id`) VALUES
('a22ddfsdawds', 'aswd', 'wwda', '24323', '2018-09-20', 'Hj7mtpgis6ew8IJ+9PmA6KdxSU4='),
('a22ddfsdasdawds', 'aswd', 'wwda', '21234323', '2018-09-20', 't9sYkoFSA/bmggCmthBL07zcVPg=');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
