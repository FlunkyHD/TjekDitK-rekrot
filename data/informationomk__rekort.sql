-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Vært: localhost
-- Genereringstid: 08. 02 2018 kl. 10:58:07
-- Serverversion: 5.6.17
-- PHP-version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mort9941`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `informationomkørekort`
--

CREATE TABLE IF NOT EXISTS `informationomkørekort` (
  `Brugernavn` varchar(15) COLLATE latin1_danish_ci NOT NULL DEFAULT '',
  `Navn` text COLLATE latin1_danish_ci,
  `Adgangskode` varchar(15) COLLATE latin1_danish_ci DEFAULT NULL,
  `CPR-Nummer` varchar(11) COLLATE latin1_danish_ci DEFAULT NULL,
  `Adresse` varchar(50) COLLATE latin1_danish_ci DEFAULT NULL,
  `Kørekort Dato` varchar(10) COLLATE latin1_danish_ci DEFAULT NULL,
  PRIMARY KEY (`Brugernavn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci;

--
-- Data dump for tabellen `informationomkørekort`
--

INSERT INTO `informationomkørekort` (`Brugernavn`, `Navn`, `Adgangskode`, `CPR-Nummer`, `Adresse`, `Kørekort Dato`) VALUES
('mort9941', 'Morten Jørgensen', '1234', '18-08-1234', 'Xdvej 47', '29-05-2032');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
