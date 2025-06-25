-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2025 at 11:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test1`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Gender` enum('Male','Female','Others') NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(250) DEFAULT NULL,
  `PhoneNo` bigint(10) NOT NULL,
  `Course` varchar(50) NOT NULL,
  `Languages` varchar(250) NOT NULL,
  `Resume` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `FirstName`, `LastName`, `Gender`, `Email`, `Password`, `PhoneNo`, `Course`, `Languages`, `Resume`) VALUES
(1, 'Mariya', 'Divya', 'Female', 'div@gmail.com', '$2y$10$FaTPSFT567KlU1rPnhv0uOtEyZnXthdK2Q/VzTKAr6bIgAOcmn4Gm', 6381047529, 'MCA', 'Tamil, English', '1750839299_S.Mariya Divya(Resume).pdf'),
(2, 'Raja', 'Jenifer', 'Male', 'jeri@gmail.com', '$2y$10$U/XutO2R9UtuXRAC2lD4KemWY/pmvIrUzstQ7p/5RNvdtEjaFIq16', 7418000108, 'B.Sc CS', 'Tamil, English', '1750841727_S.Mariya Divya(Resume).docx'),
(3, 'Aashika', 'Banu', 'Female', 'ash@gmail.com', '$2y$10$N/LB/Az0SaFVUt8NQZ2hyOBYZ7Pr/9OIOJywO/CuoFmnGTEJwcAl6', 9812046209, 'MCA', 'Tamil, English', '1750842251_Divya(Resume).pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
