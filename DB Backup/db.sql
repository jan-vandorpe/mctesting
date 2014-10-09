-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 09 okt 2014 om 11:39
-- Serverversie: 5.6.16
-- PHP-versie: 5.5.9

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
-- Tabelstructuur voor tabel `antwoorden`
--

CREATE TABLE IF NOT EXISTS `antwoorden` (
  `vraagid` int(11) NOT NULL,
  `antwoordid` int(11) NOT NULL,
  `antwoordtekst` text NOT NULL,
  `media` varchar(100) DEFAULT NULL,
  `toegevoegdOp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`vraagid`,`antwoordid`),
  KEY `vraagid` (`vraagid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `catnaam` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `actief` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE IF NOT EXISTS `gebruikers` (
  `rijksregisternr` varchar(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `voornaam` varchar(25) NOT NULL,
  `familienaam` varchar(25) NOT NULL,
  `wachtwoord` varchar(80) NOT NULL,
  `gebruikerstype` int(1) DEFAULT NULL,
  `actief` tinyint(1) NOT NULL DEFAULT '1',
  `toegevoegd` datetime NOT NULL,
  PRIMARY KEY (`rijksregisternr`),
  KEY `gebruikerscategorie` (`gebruikerstype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`rijksregisternr`, `email`, `voornaam`, `familienaam`, `wachtwoord`, `gebruikerstype`, `actief`, `toegevoegd`) VALUES
('12345678933', 'admin@email.be', 'admin', 'admin', '$2a$10$8UO0ME/Mn8IlaISL2/V9U.MEfoRIQx7TVy/MC9NXb4amXxKqp7PDq', 3, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikerscategorie`
--

CREATE TABLE IF NOT EXISTS `gebruikerscategorie` (
  `typeid` int(1) NOT NULL DEFAULT '0',
  `typenaam` varchar(20) NOT NULL,
  `clearancelevel` int(11) NOT NULL,
  PRIMARY KEY (`typeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `gebruikerscategorie`
--

INSERT INTO `gebruikerscategorie` (`typeid`, `typenaam`, `clearancelevel`) VALUES
(1, 'gebruiker', 0),
(2, 'beheerder', 0),
(3, 'admin', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `vraagid` int(11) NOT NULL,
  `mediaid` int(11) NOT NULL,
  `filename` varchar(130) NOT NULL,
  PRIMARY KEY (`vraagid`,`mediaid`),
  KEY `vraagid` (`vraagid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sessie`
--

CREATE TABLE IF NOT EXISTS `sessie` (
  `sessieid` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date NOT NULL,
  `testid` int(11) NOT NULL,
  `sessieww` varchar(50) NOT NULL,
  `actief` tinyint(1) NOT NULL DEFAULT '1',
  `aangemaaktOp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sessieid`),
  KEY `testid` (`testid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=84 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sessiegebruiker`
--

CREATE TABLE IF NOT EXISTS `sessiegebruiker` (
  `sessieid` int(11) NOT NULL,
  `rijksregisternr` varchar(11) NOT NULL,
  `score` int(11) NOT NULL,
  `percentage` decimal(3,0) NOT NULL,
  `geslaagd` tinyint(1) NOT NULL,
  `afgelegd` tinyint(1) DEFAULT NULL,
  `actief` tinyint(1) NOT NULL,
  PRIMARY KEY (`sessieid`,`rijksregisternr`),
  KEY `gebruikerid` (`rijksregisternr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sessiegebruikerantwoorden`
--

CREATE TABLE IF NOT EXISTS `sessiegebruikerantwoorden` (
  `sessieid` int(11) NOT NULL,
  `gebruikerid` varchar(11) NOT NULL,
  `vraagid` int(11) NOT NULL,
  `correct` tinyint(1) NOT NULL,
  PRIMARY KEY (`sessieid`,`gebruikerid`,`vraagid`),
  KEY `vraagid` (`vraagid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sessiegebruikercategoriepercentages`
--

CREATE TABLE IF NOT EXISTS `sessiegebruikercategoriepercentages` (
  `sessieid` int(11) NOT NULL,
  `rijksregisternr` varchar(11) NOT NULL,
  `testid` int(11) NOT NULL,
  `subcatid` int(11) NOT NULL,
  `score` int(5) NOT NULL,
  `percentage` int(5) NOT NULL,
  PRIMARY KEY (`sessieid`,`rijksregisternr`,`testid`,`subcatid`),
  KEY `fk_test12` (`testid`),
  KEY `fk_subcat12` (`subcatid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `subcategorie`
--

CREATE TABLE IF NOT EXISTS `subcategorie` (
  `subcatid` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL,
  `subcatnaam` tinytext NOT NULL,
  `actief` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`subcatid`),
  KEY `catid` (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `testid` int(11) NOT NULL AUTO_INCREMENT,
  `testnaam` tinytext NOT NULL,
  `maxduur` int(3) NOT NULL,
  `aantalvragen` int(11) NOT NULL,
  `maxscore` int(11) NOT NULL,
  `tebehalenscore` int(11) NOT NULL,
  `beheerder` varchar(11) NOT NULL,
  `actief` tinyint(1) NOT NULL DEFAULT '1',
  `gepubliceerd` tinyint(1) NOT NULL DEFAULT '0',
  `toegevoegdOp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`testid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=115 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `testsubcat`
--

CREATE TABLE IF NOT EXISTS `testsubcat` (
  `testid` int(11) NOT NULL,
  `subcatid` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `totgewicht` int(11) NOT NULL,
  `tebehalenscore` int(11) NOT NULL,
  PRIMARY KEY (`testid`,`subcatid`),
  KEY `subcatid` (`subcatid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `testvragen`
--

CREATE TABLE IF NOT EXISTS `testvragen` (
  `testid` int(11) NOT NULL,
  `vraagid` int(11) NOT NULL,
  KEY `testid` (`testid`,`vraagid`),
  KEY `vraagid` (`vraagid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vraag`
--

CREATE TABLE IF NOT EXISTS `vraag` (
  `subcatid` int(11) NOT NULL,
  `vraagid` int(11) NOT NULL AUTO_INCREMENT,
  `vraagtekst` text NOT NULL,
  `gewicht` int(11) NOT NULL,
  `correctantwoord` int(11) NOT NULL,
  `actief` tinyint(1) NOT NULL DEFAULT '1',
  `toegevoegdOp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`vraagid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=184 ;

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `antwoorden`
--
ALTER TABLE `antwoorden`
  ADD CONSTRAINT `antwoorden_ibfk_1` FOREIGN KEY (`vraagid`) REFERENCES `vraag` (`vraagid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD CONSTRAINT `gebruikers_ibfk_1` FOREIGN KEY (`gebruikerstype`) REFERENCES `gebruikerscategorie` (`typeid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`vraagid`) REFERENCES `vraag` (`vraagid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `sessie`
--
ALTER TABLE `sessie`
  ADD CONSTRAINT `sessie_ibfk_1` FOREIGN KEY (`testid`) REFERENCES `test` (`testid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `sessiegebruiker`
--
ALTER TABLE `sessiegebruiker`
  ADD CONSTRAINT `sessiegebruiker_ibfk_1` FOREIGN KEY (`sessieid`) REFERENCES `sessie` (`sessieid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sessiegebruiker_ibfk_2` FOREIGN KEY (`rijksregisternr`) REFERENCES `gebruikers` (`rijksregisternr`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `sessiegebruikerantwoorden`
--
ALTER TABLE `sessiegebruikerantwoorden`
  ADD CONSTRAINT `sessiegebruikerantwoorden_ibfk_1` FOREIGN KEY (`sessieid`) REFERENCES `sessiegebruiker` (`sessieid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `sessiegebruikercategoriepercentages`
--
ALTER TABLE `sessiegebruikercategoriepercentages`
  ADD CONSTRAINT `fk_sessieid12` FOREIGN KEY (`sessieid`) REFERENCES `sessie` (`sessieid`),
  ADD CONSTRAINT `fk_subcat12` FOREIGN KEY (`subcatid`) REFERENCES `subcategorie` (`subcatid`),
  ADD CONSTRAINT `fk_test12` FOREIGN KEY (`testid`) REFERENCES `test` (`testid`);

--
-- Beperkingen voor tabel `subcategorie`
--
ALTER TABLE `subcategorie`
  ADD CONSTRAINT `subcategorie_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `categorie` (`catid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `testsubcat`
--
ALTER TABLE `testsubcat`
  ADD CONSTRAINT `testsubcat_ibfk_2` FOREIGN KEY (`testid`) REFERENCES `test` (`testid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `testsubcat_ibfk_3` FOREIGN KEY (`subcatid`) REFERENCES `subcategorie` (`subcatid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `testvragen`
--
ALTER TABLE `testvragen`
  ADD CONSTRAINT `testvragen_ibfk_2` FOREIGN KEY (`testid`) REFERENCES `test` (`testid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `testvragen_ibfk_3` FOREIGN KEY (`vraagid`) REFERENCES `vraag` (`vraagid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
