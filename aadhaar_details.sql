-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 06, 2022 at 04:26 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aadhaar_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `aadhaar_details`
--

CREATE TABLE `aadhaar_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `gender` varchar(6) NOT NULL,
  `date_of_birth` date NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `aadhaar_no` varchar(12) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aadhaar_details`
--

INSERT INTO `aadhaar_details` (`id`, `name`, `address`, `gender`, `date_of_birth`, `contact_number`, `aadhaar_no`, `father_name`, `created_at`, `updated_at`) VALUES
(1, 'Chirag Gupta', 'Azad nagar', 'Male', '2000-11-06', '9711672424', '123456789123', 'Sanjay Gupta', '2022-10-06 16:20:40', '2022-10-06 16:20:40'),
(2, 'Aftab', 'East Azad nagar', 'Male', '2012-10-01', '1234567891', '123452789123', 'aftab', '2022-10-06 16:24:11', '2022-10-06 16:24:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aadhaar_details`
--
ALTER TABLE `aadhaar_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aadhaar_no` (`aadhaar_no`),
  ADD UNIQUE KEY `contact_number` (`contact_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aadhaar_details`
--
ALTER TABLE `aadhaar_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
