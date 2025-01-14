-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 02:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bazarezerwacji`
--

-- --------------------------------------------------------

--
-- Table structure for table `loty`
--

CREATE TABLE `loty` (
  `id_lotu` int(11) NOT NULL,
  `numer_lotu` varchar(7) NOT NULL,
  `miejsce_wylotu` varchar(255) NOT NULL,
  `miejsce_przylotu` varchar(255) NOT NULL,
  `data_lotu` date NOT NULL,
  `cena_eko` decimal(10,0) NOT NULL,
  `cena_biz` decimal(10,0) NOT NULL,
  `liczba_miejsc_eko` int(11) NOT NULL,
  `liczba_miejsc_biz` int(11) NOT NULL,
  `godzina_wylotu` time NOT NULL,
  `godzina_przylotu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loty`
--

INSERT INTO `loty` (`id_lotu`, `numer_lotu`, `miejsce_wylotu`, `miejsce_przylotu`, `data_lotu`, `cena_eko`, `cena_biz`, `liczba_miejsc_eko`, `liczba_miejsc_biz`, `godzina_wylotu`, `godzina_przylotu`) VALUES
(37, 'WAWKRK1', 'Warszawa', 'Krakow', '2025-03-01', 200, 400, 150, 30, '08:00:00', '09:00:00'),
(38, 'KRKWAW1', 'Krakow', 'Warszawa', '2025-03-07', 200, 400, 150, 30, '10:00:00', '11:00:00'),
(39, 'WAWGDN1', 'Warszawa', 'Gdansk', '2025-03-01', 180, 360, 150, 30, '10:00:00', '11:00:00'),
(40, 'GDNWAW1', 'Gdansk', 'Warszawa', '2025-03-07', 180, 360, 150, 30, '12:00:00', '13:00:00'),
(41, 'WROKRK1', 'Wroclaw', 'Krakow', '2025-03-01', 190, 380, 150, 30, '12:00:00', '13:00:00'),
(42, 'KRKWRO1', 'Krakow', 'Wroclaw', '2025-03-07', 190, 380, 150, 30, '14:00:00', '15:00:00'),
(43, 'WAWKRK2', 'Warszawa', 'Krakow', '2025-03-02', 200, 400, 150, 30, '08:00:00', '09:00:00'),
(44, 'KRKWAW2', 'Krakow', 'Warszawa', '2025-03-08', 200, 400, 150, 30, '10:00:00', '11:00:00'),
(45, 'WAWGDN2', 'Warszawa', 'Gdansk', '2025-03-02', 180, 360, 150, 30, '10:00:00', '11:00:00'),
(46, 'GDNWAW2', 'Gdansk', 'Warszawa', '2025-03-08', 180, 360, 150, 30, '12:00:00', '13:00:00'),
(47, 'WROKRK2', 'Wroclaw', 'Krakow', '2025-03-02', 190, 380, 150, 30, '12:00:00', '13:00:00'),
(48, 'KRKWRO2', 'Krakow', 'Wroclaw', '2025-03-08', 190, 380, 150, 30, '14:00:00', '15:00:00'),
(49, 'WAWKRK3', 'Warszawa', 'Krakow', '2025-03-03', 200, 400, 150, 30, '08:00:00', '09:00:00'),
(50, 'KRKWAW3', 'Krakow', 'Warszawa', '2025-03-09', 200, 400, 150, 30, '10:00:00', '11:00:00'),
(51, 'WAWGDN3', 'Warszawa', 'Gdansk', '2025-03-03', 180, 360, 150, 30, '10:00:00', '11:00:00'),
(52, 'GDNWAW3', 'Gdansk', 'Warszawa', '2025-03-09', 180, 360, 150, 30, '12:00:00', '13:00:00'),
(53, 'WROKRK3', 'Wroclaw', 'Krakow', '2025-03-03', 190, 380, 150, 30, '12:00:00', '13:00:00'),
(54, 'KRKWRO3', 'Krakow', 'Wroclaw', '2025-03-09', 190, 380, 150, 30, '14:00:00', '15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rezerwacje`
--

CREATE TABLE `rezerwacje` (
  `id_rezerwacji` int(11) NOT NULL,
  `id_lotu` int(11) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `liczba_pasazerow` int(11) NOT NULL,
  `klasa` varchar(255) NOT NULL,
  `cena` decimal(10,0) NOT NULL,
  `odprawa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loty`
--
ALTER TABLE `loty`
  ADD PRIMARY KEY (`id_lotu`);

--
-- Indexes for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD PRIMARY KEY (`id_rezerwacji`),
  ADD KEY `fk_id_lotu` (`id_lotu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loty`
--
ALTER TABLE `loty`
  MODIFY `id_lotu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `id_rezerwacji` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD CONSTRAINT `fk_id_lotu` FOREIGN KEY (`id_lotu`) REFERENCES `loty` (`id_lotu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
