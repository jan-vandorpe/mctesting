-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 08 apr 2014 om 10:25
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
-- Tabelstructuur voor tabel `antwoorden`
--

CREATE TABLE IF NOT EXISTS `antwoorden` (
  `vraagid` int(11) NOT NULL,
  `antwoordid` int(11) NOT NULL,
  `antwoordtekst` text NOT NULL,
  PRIMARY KEY (`vraagid`,`antwoordid`),
  KEY `vraagid` (`vraagid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `antwoorden`
--

INSERT INTO `antwoorden` (`vraagid`, `antwoordid`, `antwoordtekst`) VALUES
(1, 0, 'Rundskop'),
(1, 1, 'In Darkness'),
(1, 2, 'A Separation'),
(1, 3, 'Footnote'),
(2, 0, 'Nick Nuyens'),
(2, 1, 'Tom Boonen'),
(2, 2, 'Philippe Gilbert'),
(2, 3, 'Fabian Cancellara'),
(3, 0, '356'),
(3, 1, '485'),
(3, 2, '510'),
(3, 3, '541'),
(4, 0, '5'),
(4, 1, '8'),
(4, 2, '11'),
(4, 3, '15'),
(5, 0, 'Het varken'),
(5, 1, 'De draak'),
(5, 2, 'De slang'),
(5, 3, 'De rat');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `catnaam` tinytext NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `categorie`
--

INSERT INTO `categorie` (`catid`, `catnaam`) VALUES
(1, 'testcategorie');

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
  `gebruikerstype` int(1) DEFAULT NULL,
  PRIMARY KEY (`rijksregisternr`),
  KEY `gebruikerscategorie` (`gebruikerstype`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`rijksregisternr`, `email`, `voornaam`, `familienaam`, `wachtwoord`, `gebruikerstype`) VALUES
(12345678900, 'gebruiker@email.be', 'gebruiker', 'gebruiker', 'qsdf', 1),
(12345678933, 'bert@email.be', 'Bert', 'Mortier', 'qsdf', 3),
(32165498722, 'hendrik@email.be', 'Hendrik', 'De Buck', 'qsdf', 3),
(32165498755, 'thomas@email.be', 'Thomas', 'Deserranno', 'azerty', 3),
(45678901230, 'beheerder@email.be', 'beheerder', 'beheerder', 'qsdf', 2),
(98765432100, 'bram@email.be', 'Bram', 'Peters', 'wxcv', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikerscategorie`
--

CREATE TABLE IF NOT EXISTS `gebruikerscategorie` (
  `typeid` int(1) NOT NULL DEFAULT '0',
  `typenaam` varchar(20) NOT NULL,
  `clearancelevel` int(11) NOT NULL,
  PRIMARY KEY (`typeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `media`
--

INSERT INTO `media` (`vraagid`, `mediaid`, `filename`) VALUES
(3, 0, 'china.jpg'),
(4, 0, 'ijs.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sessie`
--

CREATE TABLE IF NOT EXISTS `sessie` (
  `sessieid` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date NOT NULL,
  `testid` int(11) NOT NULL,
  `sessieww` varchar(50) NOT NULL,
  PRIMARY KEY (`sessieid`),
  KEY `testid` (`testid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sessiegebruiker`
--

CREATE TABLE IF NOT EXISTS `sessiegebruiker` (
  `sessieid` int(11) NOT NULL,
  `rijksregisternr` bigint(11) NOT NULL,
  `score` int(11) NOT NULL,
  `percentage` decimal(2,2) NOT NULL,
  `geslaagd` tinyint(1) NOT NULL,
  PRIMARY KEY (`sessieid`,`rijksregisternr`),
  KEY `gebruikerid` (`rijksregisternr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sessiegebruikerantwoorden`
--

CREATE TABLE IF NOT EXISTS `sessiegebruikerantwoorden` (
  `sessieid` int(11) NOT NULL,
  `gebruikerid` int(11) NOT NULL,
  `vraagid` int(11) NOT NULL,
  `correct` tinyint(1) NOT NULL,
  PRIMARY KEY (`sessieid`,`gebruikerid`,`vraagid`),
  KEY `vraagid` (`vraagid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `subcategorie`
--

CREATE TABLE IF NOT EXISTS `subcategorie` (
  `subcatid` int(11) NOT NULL AUTO_INCREMENT,
  `subcatnaam` tinytext NOT NULL,
  `catid` int(11) NOT NULL,
  PRIMARY KEY (`subcatid`),
  KEY `catid` (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `subcategorie`
--

INSERT INTO `subcategorie` (`subcatid`, `subcatnaam`, `catid`) VALUES
(1, 'film', 1),
(2, 'sport', 1),
(3, 'politiek', 1),
(4, 'varia', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `testid` int(11) NOT NULL AUTO_INCREMENT,
  `testnaam` tinytext NOT NULL,
  `maxduur` decimal(2,2) NOT NULL,
  `aantalvragen` int(11) NOT NULL,
  `maxscore` int(11) NOT NULL,
  `beheerder` int(11) NOT NULL,
  PRIMARY KEY (`testid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `testvragen`
--

CREATE TABLE IF NOT EXISTS `testvragen` (
  `testid` int(11) NOT NULL,
  `vraagid` int(11) NOT NULL,
  KEY `testid` (`testid`,`vraagid`),
  KEY `vraagid` (`vraagid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vraag`
--

CREATE TABLE IF NOT EXISTS `vraag` (
  `vraagid` int(11) NOT NULL AUTO_INCREMENT,
  `vraagtekst` text NOT NULL,
  `subcatid` int(11) NOT NULL,
  `gewicht` int(11) NOT NULL,
  `correctantwoord` int(11) NOT NULL,
  PRIMARY KEY (`vraagid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `vraag`
--

INSERT INTO `vraag` (`vraagid`, `vraagtekst`, `subcatid`, `gewicht`, `correctantwoord`) VALUES
(1, 'Welke film won in 2012 de Oscar voor beste buitenlandse film?', 1, 1, 3),
(2, 'Wie won in 2011 de Ronde van Vlaanderen?', 2, 2, 5),
(3, 'De Belgische regeringsformatie van 2012 brak alle vorige records qua duurtijd, na hoeveel dagen na de verkiezing was er een regering?', 3, 1, 12),
(4, 'De winter 2011-2012 kende toch een lange vorstperiode met 14 opeenvolgende ijsdagen. De vorige winter, 2010-2011, kende in totaal hoeveel ijsdagen?', 4, 2, 16),
(5, 'In China is 2012 het jaar van', 4, 1, 18);

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
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`vraagid`) REFERENCES `vraag` (`vraagid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `sessiegebruiker_ibfk_2` FOREIGN KEY (`rijksregisternr`) REFERENCES `gebruikers` (`rijksregisternr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `sessiegebruikerantwoorden`
--
ALTER TABLE `sessiegebruikerantwoorden`
  ADD CONSTRAINT `sessiegebruikerantwoorden_ibfk_1` FOREIGN KEY (`sessieid`) REFERENCES `sessiegebruiker` (`sessieid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `subcategorie`
--
ALTER TABLE `subcategorie`
  ADD CONSTRAINT `subcategorie_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `categorie` (`catid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `testsubcat`
--
ALTER TABLE `testsubcat`
  ADD CONSTRAINT `testsubcat_ibfk_1` FOREIGN KEY (`subcatid`) REFERENCES `subcategorie` (`subcatid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `testsubcat_ibfk_2` FOREIGN KEY (`testid`) REFERENCES `test` (`testid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `testvragen`
--
ALTER TABLE `testvragen`
  ADD CONSTRAINT `testvragen_ibfk_1` FOREIGN KEY (`vraagid`) REFERENCES `vraag` (`vraagid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `testvragen_ibfk_2` FOREIGN KEY (`testid`) REFERENCES `test` (`testid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
