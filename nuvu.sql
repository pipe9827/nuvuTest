-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 18, 2020 at 02:31 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nuvu`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `cedula` varchar(40) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `celular` varchar(30) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `fecha_expiracion` varchar(20) NOT NULL,
  `cvv` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `cedula`, `nombre`, `apellidos`, `celular`, `correo`, `marca`, `numero`, `fecha_expiracion`, `cvv`) VALUES
(1, '1094968497', 'Andres', 'Sabogal Rada', '3207935720', 'afsabogalr@gmail.com', 'Visa', '10948765467', '2020-11-21', '478'),
(7, '7562019', 'jhon james', 'sabogal Trujillo', '3155398026', 'jhon@hotmail.com', 'visa', '10948765467', '2020-11-26', '527'),
(8, '10941111', 'michael no', 'colabora', '121872871', 'nocolabora@gmail.com', 'Visa', '56789', '2020-11-26', '765');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
(1, 'felipe', '$2y$12$tKaVDtorkqX9ExFzkRJ.Nu4zFF1byAhAHIQ12v9rM3nAZqidi.NU2'),
(2, 'guiomar', '$2y$12$df.jAKDelPEgCp/NHScgJe2wTL2u/qpw37BOl./xzvLXWn8Nsp33i'),
(3, 'admin', '$2y$12$oD9jgJYHH/K6lRQrSLoYguoEFZ0SW3NUG9iAcxMTWRmQnVhhyp96u'),
(4, 'manuela', '$2y$12$V.78952lXCkeGnLbUSXf4.Fn7Mnry2nNADUZ6aAeHwxVBjo6ABiKm'),
(5, 'natalia', '$2y$12$/gKqokh5H29R.WNH4r0k6uSz/pwtwP/sPx9.pHXwbIrOGByd0.88a'),
(6, 'admin2', '$2y$12$7h6on3YhXNfhXindU4nL4.NsrPE47et3Kideh9LelozAIgh0a0hH2'),
(7, 'admin3', '$2y$12$OtGmPS6xEWJt8apOGmrGOeqCaWUPJ7/DSxCiauNPXxyUFa3T0CHwe'),
(8, 'a', '$2y$12$a5.8RGMZoloKB7P1ZHZyx.6zHeMn3.RWnb9SRFi5xQzDcTPDJLni6'),
(9, 'pipe', '$2y$12$ih30Tno0gYGVWMaNmpbS4.1UC2Gl4OMWktYOs2xMTsx/HKwIB9YH6'),
(10, 'pipe', '$2y$12$l7kEyb1nK90Sx2oy/xG.w.fBcKGWKKYshPyLZgrJRm3Ub/LNWDDKS'),
(11, 'pluto', '$2y$12$P05ZAhPsFWhiaro4HjI6IOFQLhiBJlTz7GDOSUxBrUcrD.XKipjca');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
