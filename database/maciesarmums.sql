-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 07:13 AM
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
-- Database: `maciesarmums`
--

-- --------------------------------------------------------

--
-- Table structure for table `apmacibas`
--

CREATE TABLE `apmacibas` (
  `ID` int(11) NOT NULL,
  `Nosaukums` varchar(50) NOT NULL,
  `Apraksts` varchar(255) NOT NULL,
  `Attels` varchar(255) NOT NULL,
  `Statuss` enum('Iesniegts','Atverts','Apstiprinats','Noraidits','Slepts') NOT NULL,
  `Veidotajs` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Dumping data for table `apmacibas`
--

INSERT INTO `apmacibas` (`ID`, `Nosaukums`, `Apraksts`, `Attels`, `Statuss`, `Veidotajs`) VALUES
(1, 'Test', 'daddadadada', 'https://www.imgacademy.com/sites/default/files/img-academy-boarding-school-worlds-most-dedicated.jpg', 'Iesniegts', 'Niks'),
(2, 'Test2', 'adadda', 'https://www.imgacademy.com/sites/default/files/img-academy-boarding-school-worlds-most-dedicated.jpg', 'Apstiprinats', '');

-- --------------------------------------------------------

--
-- Table structure for table `testuser`
--

CREATE TABLE `testuser` (
  `id` int(11) NOT NULL,
  `lietotajvards` varchar(50) NOT NULL,
  `parole` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Dumping data for table `testuser`
--

INSERT INTO `testuser` (`id`, `lietotajvards`, `parole`) VALUES
(3, 'admin', '$2y$10$NNHcIdYh7t9J9WDjNzPVbOqYJ6XaQ08VlpFlWBiWBTo5ds4CeofAy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apmacibas`
--
ALTER TABLE `apmacibas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Veidotajs_FK_1` (`Veidotajs`);

--
-- Indexes for table `testuser`
--
ALTER TABLE `testuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apmacibas`
--
ALTER TABLE `apmacibas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `testuser`
--
ALTER TABLE `testuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
