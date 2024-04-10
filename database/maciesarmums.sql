-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2024 at 09:59 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

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
  `Nosaukums` varchar(50) COLLATE utf8_latvian_ci NOT NULL,
  `Apraksts` varchar(255) COLLATE utf8_latvian_ci NOT NULL,
  `Attels` varchar(255) COLLATE utf8_latvian_ci NOT NULL,
  `Statuss` enum('Iesniegts','Atverts','Apstiprinats','Noraidits','Slepts') COLLATE utf8_latvian_ci NOT NULL,
  `Veidotajs` varchar(50) COLLATE utf8_latvian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Dumping data for table `apmacibas`
--

INSERT INTO `apmacibas` (`ID`, `Nosaukums`, `Apraksts`, `Attels`, `Statuss`, `Veidotajs`) VALUES
(1, 'Test', 'daddadadada', 'https://www.imgacademy.com/sites/default/files/img-academy-boarding-school-worlds-most-dedicated.jpg', 'Iesniegts', 'Niks'),
(2, 'Test2', 'adadda', 'https://www.imgacademy.com/sites/default/files/img-academy-boarding-school-worlds-most-dedicated.jpg', 'Apstiprinats', ''),
(5, 'testssssss', 'dadadsdad', 'nav', 'Atverts', '');

-- --------------------------------------------------------

--
-- Table structure for table `lietot_piet`
--

CREATE TABLE `lietot_piet` (
  `id` int(11) NOT NULL,
  `lietotajvards` varchar(50) COLLATE utf8_latvian_ci NOT NULL,
  `vards` varchar(50) COLLATE utf8_latvian_ci NOT NULL,
  `uzvards` varchar(50) COLLATE utf8_latvian_ci NOT NULL,
  `loma` varchar(50) COLLATE utf8_latvian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Dumping data for table `lietot_piet`
--

INSERT INTO `lietot_piet` (`id`, `lietotajvards`, `vards`, `uzvards`, `loma`) VALUES
(16, 'test', 'Niks', 'Leimanis', 'Administrators');

-- --------------------------------------------------------

--
-- Table structure for table `logfiles`
--

CREATE TABLE `logfiles` (
  `ID` int(11) NOT NULL,
  `Autors` varchar(50) COLLATE utf8_latvian_ci NOT NULL,
  `Apraksts` varchar(255) COLLATE utf8_latvian_ci NOT NULL,
  `Laiks` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pirkumi`
--

CREATE TABLE `pirkumi` (
  `ID` int(11) NOT NULL,
  `PirkumsID` varchar(255) COLLATE utf8_latvian_ci NOT NULL,
  `Pircejs` varchar(50) COLLATE utf8_latvian_ci NOT NULL,
  `Cena` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lietotajvards` varchar(50) COLLATE utf8_latvian_ci NOT NULL,
  `epasts` varchar(120) COLLATE utf8_latvian_ci NOT NULL,
  `vards` varchar(50) COLLATE utf8_latvian_ci NOT NULL,
  `uzvards` varchar(50) COLLATE utf8_latvian_ci NOT NULL,
  `reg_laiks` timestamp NOT NULL DEFAULT current_timestamp(),
  `parole` varchar(120) COLLATE utf8_latvian_ci NOT NULL,
  `loma` enum('Lietotajs','Veidotajs','Moderators','Administrators') COLLATE utf8_latvian_ci NOT NULL,
  `attels` varchar(255) COLLATE utf8_latvian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `lietotajvards`, `epasts`, `vards`, `uzvards`, `reg_laiks`, `parole`, `loma`, `attels`) VALUES
(3, 'admin', '', '0', '0', '2024-03-06 08:47:18', '$2y$10$NNHcIdYh7t9J9WDjNzPVbOqYJ6XaQ08VlpFlWBiWBTo5ds4CeofAy', 'Administrators', ''),
(4, 'test', 'epasts@nekas.lv', 'Niks', 'Leimanis', '2024-03-25 11:40:24', '$2y$10$y4z3i0I3WR8iwXZTdO.ir.8afVfoFffUpmaki0nbU2/80W/anq82a', 'Administrators', '');

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
-- Indexes for table `lietot_piet`
--
ALTER TABLE `lietot_piet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logfiles`
--
ALTER TABLE `logfiles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pirkumi`
--
ALTER TABLE `pirkumi`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apmacibas`
--
ALTER TABLE `apmacibas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lietot_piet`
--
ALTER TABLE `lietot_piet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `logfiles`
--
ALTER TABLE `logfiles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pirkumi`
--
ALTER TABLE `pirkumi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
