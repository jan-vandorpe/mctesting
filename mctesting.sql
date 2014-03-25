-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 25 mrt 2014 om 09:49
-- Serverversie: 5.6.11
-- PHP-versie: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `mctesting`
--
CREATE DATABASE IF NOT EXISTS `mctesting` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mctesting`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE IF NOT EXISTS `gebruikers` (
  `rijksregisternr` bigint(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `voornaam` varchar(25) NOT NULL,
  `familienaam` varchar(25) NOT NULL,
  `wachtwoord` varchar(30) NOT NULL,
  `gebruikerscategorie` int(1) NOT NULL,
  PRIMARY KEY (`rijksregisternr`),
  KEY `gebruikerscategorie` (`gebruikerscategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`rijksregisternr`, `email`, `voornaam`, `familienaam`, `wachtwoord`, `gebruikerscategorie`) VALUES
(2147483647, 'bert_mortier@hotmail.com', 'bert', 'mortier', 'mqoisfgqmoruig', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikerscategorie`
--

CREATE TABLE IF NOT EXISTS `gebruikerscategorie` (
  `gebruikerscategorieid` int(11) NOT NULL,
  `gebruikerscategorienaam` varchar(20) NOT NULL,
  PRIMARY KEY (`gebruikerscategorieid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `gebruikerscategorie`
--

INSERT INTO `gebruikerscategorie` (`gebruikerscategorieid`, `gebruikerscategorienaam`) VALUES
(1, 'gebruiker'),
(2, 'beheerder'),
(3, 'admin');

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD CONSTRAINT `gebruikers_ibfk_1` FOREIGN KEY (`gebruikerscategorie`) REFERENCES `gebruikerscategorie` (`gebruikerscategorieid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
