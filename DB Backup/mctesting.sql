-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 30 apr 2014 om 12:53
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
CREATE DATABASE IF NOT EXISTS `mctesting` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(5, 3, 'De rat'),
(11, 0, 'BelgiÃ«'),
(11, 1, 'China'),
(11, 2, 'BraziliÃ«'),
(11, 3, 'Rusland'),
(13, 0, '2 mei'),
(13, 1, '17 juni'),
(13, 2, '25 mei'),
(13, 3, '5 november'),
(14, 1, 'antwoord 1'),
(14, 2, 'antwoord 2'),
(15, 0, 'Een stok'),
(15, 1, 'Een bal'),
(15, 2, 'Hoepels'),
(15, 3, 'AK47'),
(16, 0, 'Bram'),
(16, 1, 'Hendrik'),
(16, 2, 'Jan'),
(16, 3, 'Bert2'),
(23, 0, '<p>20px</p>'),
(23, 1, '<p>22px</p>'),
(23, 2, '<p>24px</p>'),
(23, 3, '<p>25px</p>'),
(24, 0, '<p><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">ul&gt;ul {color:red}</span></p>'),
(24, 1, '<p><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">ul+ul {color:red}</span></p>'),
(24, 2, '<p><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">ul:ul {color:red}</span></p>'),
(24, 3, '<p><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">ul ul {color:red}</span></p>'),
(25, 0, '<p><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">&lt;script src="mijnscript"&gt;&lt;/script&gt;</span></p>'),
(25, 1, '<p><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">&lt;script href="mijnscript" /&gt;</span></p>'),
(25, 2, '<p><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">&lt;link src="mijnscript"&gt;&lt;/link&gt;</span></p>'),
(25, 3, '<p><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">&lt;link href="mijnscript" /&gt;</span></p>'),
(26, 0, '<p><code><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">ul&gt;ul {color:red};</span></code></p>'),
(26, 1, '<p><code>ul+ul {color:red};</code></p>'),
(26, 2, '<p><code>ul:ul {color:red};</code></p>'),
(26, 3, '<p><code>ul ul {color:red}</code></p>'),
(27, 0, '<p><span style="color: #252525; font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">Auguste Rodin</span></p>'),
(27, 1, '<p><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">Auguste&nbsp;Gauguin</span></p>'),
(27, 2, '<p><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">Auguste&nbsp;C&eacute;zanne</span></p>'),
(28, 0, '<p>Apollo</p>'),
(28, 1, '<p>Hermes</p>'),
(28, 2, '<p>Zeus</p>'),
(28, 3, '<p>Poseidon</p>'),
(29, 0, '<p>Holland</p>'),
(29, 1, '<p>Nederland</p>'),
(29, 2, '<p>Frankrijk</p>'),
(29, 3, '<p>Duitsland</p>'),
(30, 0, '<p>bloem</p>'),
(30, 1, '<p>melk</p>'),
(30, 2, '<p>water</p>'),
(30, 3, '<p>nootmuskaat</p>'),
(31, 0, '<p>ja</p>'),
(31, 1, '<p>nee</p>'),
(32, 0, '<p>1, 2, 3</p>'),
(32, 1, '<p>2, 2, 2</p>'),
(32, 2, '<p>3, 1, 2</p>'),
(33, 0, '<p>0,5 kg</p>'),
(33, 1, '<p>0,75 kg</p>'),
(33, 2, '<p>1,25kg</p>'),
(33, 3, '<p>1,5kg</p>'),
(34, 0, '<p>Verenigde Staten</p>'),
(34, 1, '<p>Japan</p>'),
(34, 2, '<p>Duitsland</p>'),
(34, 3, '<p>Sovietunie</p>'),
(35, 0, '<p>2</p>'),
(35, 1, '<p>2</p>'),
(35, 2, '<p>2</p>'),
(35, 3, '<p>2</p>'),
(36, 0, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>'),
(36, 1, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>'),
(36, 2, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>'),
(36, 3, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>'),
(37, 0, '<p>&nbsp; &nbsp;&nbsp;</p>'),
(37, 1, '<p>&nbsp; &nbsp;</p>'),
(38, 0, 'veel'),
(38, 1, 'weining'),
(39, 0, '<p>Een error.</p>'),
(39, 1, '<p>niets.</p>'),
(39, 2, '<p>de eerste rij, ongeacht de sortering.</p>'),
(39, 3, '<p>de rij met <code>''id''=1.</code></p>'),
(39, 4, '<p>alles.</p>'),
(40, 0, '<p>Fabian Cancellara</p>'),
(40, 1, '<p>Tom Boonen</p>'),
(40, 2, '<p>Hendrik Debuck</p>'),
(41, 0, '<p>foto 1</p>'),
(41, 1, '<p>foto 2</p>'),
(41, 2, '<p>foto 3</p>'),
(41, 3, '<p>foto 4</p>'),
(42, 0, '<p>foto 1</p>'),
(42, 1, '<p>foto 2</p>'),
(42, 2, '<p>foto 3</p>'),
(43, 0, '<p>P-40 Warhawk</p>'),
(43, 1, '<p>P-39 Airacobra</p>'),
(43, 2, '<p>P-51 Mustang</p>'),
(43, 3, '<p>P-38 Lightning</p>'),
(43, 4, '<p>F4U Corsair</p>'),
(44, 0, '<p>Blauw</p>'),
(44, 1, '<p>Wit</p>'),
(44, 2, '<p>Rood</p>'),
(44, 3, '<p>Geel</p>'),
(45, 0, '<p>Eiwit</p>'),
(45, 1, '<p>Eigeel</p>'),
(45, 2, '<p>Melk</p>');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `catnaam` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `actief` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Gegevens worden uitgevoerd voor tabel `categorie`
--

INSERT INTO `categorie` (`catid`, `catnaam`, `actief`) VALUES
(1, 'Cultuur', 1),
(2, 'Sport', 1),
(3, 'Programma', 1),
(4, 'Test', 1),
(5, 'Lege testcategorie', 1),
(6, 'Keuken', 1),
(7, 'Bouw', 1),
(8, 'Leetspeak', 1),
(9, 'Luchtvaart', 1),
(10, 'Horeca', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorie_backup`
--

CREATE TABLE IF NOT EXISTS `categorie_backup` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `catnaam` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `actief` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Gegevens worden uitgevoerd voor tabel `categorie_backup`
--

INSERT INTO `categorie_backup` (`catid`, `catnaam`, `actief`) VALUES
(1, 'Cultuur', 1),
(2, 'Sport', 1),
(3, 'Programma', 1),
(4, 'Test', 1),
(5, 'Lege testcategorie', 1),
(6, 'Keuken', 1),
(7, 'Bouw', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE IF NOT EXISTS `gebruikers` (
  `rijksregisternr` varchar(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `voornaam` varchar(25) NOT NULL,
  `familienaam` varchar(25) NOT NULL,
  `wachtwoord` varchar(30) NOT NULL,
  `gebruikerstype` int(1) DEFAULT NULL,
  `actief` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`rijksregisternr`),
  KEY `gebruikerscategorie` (`gebruikerstype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`rijksregisternr`, `email`, `voornaam`, `familienaam`, `wachtwoord`, `gebruikerstype`, `actief`) VALUES
('11223344551', '', 'Marc', 'Verhaeghe', '', 1, 1),
('12345678900', 'gebruiker@email.be', 'gebruiker', 'gebruikerfnaam', '', 1, 1),
('12345678901', '', 'Kurt', 'Debruyn', '', 1, 1),
('12345678933', 'bert@email.be', 'Bert', 'Mortier', 'qsdf', 3, 1),
('12345678987', '', 'TestVnaam', 'TestFnaam', '', 1, 1),
('32165498722', 'hendrik@email.be', 'Hendrik', 'De Buck', 'qsdf', 3, 1),
('32165498755', 'thomas@email.be', 'Thomas', 'Deserranno', 'azerty', 3, 1),
('33333333333', '', 'qsdfgqer', 'eh', '', 1, 1),
('44444444444', '', 'TesterVoornaam', 'TesterAchternaam', '', 1, 1),
('45678901230', 'beheerder@email.be', 'beheerder', 'beheerderfnaam', 'qsdf', 2, 1),
('55544466633', '', 'qrfgqrfg', 'qsdfghqr', '', 1, 1),
('88888888800', '', 'OverflowVN1', 'Overflow1', '', 1, 1),
('88888888801', '', 'OFVN', 'OF', '', 1, 1),
('88888888802', '', 'OFVN', 'OF', '', 1, 1),
('88888888803', '', 'OFVN', 'OF', '', 1, 1),
('88888888804', '', 'OFVN', 'OF', '', 1, 1),
('88888888805', '', 'OFVN', 'OF', '', 1, 1),
('88888888806', '', 'OFVN', 'OF', '', 1, 1),
('88888888807', '', 'OFVN', 'OF', '', 1, 1),
('88888888808', '', 'OFVN', 'OF', '', 1, 1),
('88888888809', '', 'OFVN', 'OF', '', 1, 1),
('88888888810', '', 'OFVN', 'OF', '', 1, 1),
('88888888811', '', 'OFVN', 'OF', '', 1, 1),
('88888888812', '', 'OFVN', 'OF', '', 1, 1),
('88888888813', '', 'OFVN', 'OF', '', 1, 1),
('88888888814', '', 'OFVN', 'OF', '', 1, 1),
('88888888815', '', 'OFVN', 'OF', '', 1, 1),
('88888888816', '', 'OFVN', 'OF', '', 1, 1),
('88888888817', '', 'OFVN', 'OF', '', 1, 1),
('88888888818', '', 'OFVN', 'OF', '', 1, 1),
('88888888819', '', 'OFVN', 'OF', '', 1, 1),
('88888888820', '', 'OFVN', 'OF', '', 1, 1),
('88888888821', '', 'OFVN', 'OF', '', 1, 1),
('88888888822', '', 'OFVN', 'OF', '', 1, 1),
('88888888823', '', 'OFVN', 'OF', '', 1, 1),
('88888888824', '', 'OFVN', 'OF', '', 1, 1),
('88888888825', '', 'OFVN', 'OF', '', 1, 1),
('88888888826', '', 'OFVN', 'OF', '', 1, 1),
('88888888827', '', 'OFVN', 'OF', '', 1, 1),
('88888888828', '', 'OFVN', 'OF', '', 1, 1),
('88888888829', '', 'OFVN', 'OF', '', 1, 1),
('88888888830', '', 'OFVN', 'Of', '', 1, 1),
('88888888855', '', 'OFVN', 'OF', '', 1, 1),
('98745632112', '', 'Annick', 'DeCorte', '', 1, 1),
('98765432100', 'bram@email.be', 'Bram', 'Peters', 'wxcv', 3, 1),
('99999999999', '', 'test', 'tester', '', 1, 1);

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

--
-- Gegevens worden uitgevoerd voor tabel `media`
--

INSERT INTO `media` (`vraagid`, `mediaid`, `filename`) VALUES
(3, 0, 'china.jpg'),
(4, 0, 'ijs.jpg'),
(12, 0, 'Git-1.9.0-preview20140217.exe'),
(12, 1, 'lazarus-1.0.14-fpc-2.6.2-win32.exe'),
(27, 0, 'DeDenker.jpg'),
(31, 0, 'china.jpg'),
(31, 1, 'DeDenker.jpg'),
(31, 2, 'ijs.jpg'),
(40, 0, 'boonen.jpg'),
(41, 0, 'f4u.jpg'),
(41, 1, 'f8f.jpg'),
(41, 2, 'spitfire.jpg'),
(41, 3, 'warbird.jpg'),
(42, 0, 'f4u.jpg'),
(42, 1, 'f8f.jpg'),
(42, 2, 'spitfire.jpg'),
(43, 0, 'formation.jpg');

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
  PRIMARY KEY (`sessieid`),
  KEY `testid` (`testid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Gegevens worden uitgevoerd voor tabel `sessie`
--

INSERT INTO `sessie` (`sessieid`, `datum`, `testid`, `sessieww`, `actief`) VALUES
(29, '2014-04-29', 33, 'lol', 1),
(31, '2014-04-25', 34, 'cultuur1', 1),
(32, '2014-04-25', 35, 'protprot', 1),
(33, '2014-04-09', 34, 'cultuur 2', 1),
(34, '2014-04-09', 34, 'cultuur 2', 1),
(35, '2014-04-09', 34, 'cultuur 2', 1),
(36, '2014-04-25', 36, 'protprot', 1),
(37, '2014-04-17', 34, 'crashtest', 1),
(38, '2014-04-26', 37, 'OF', 1),
(39, '2014-04-30', 37, 'OF2', 1),
(40, '2014-04-27', 37, 'ooo', 1),
(41, '2014-04-01', 38, 'crash', 1),
(42, '2014-04-24', 39, 'sport4', 1),
(43, '2014-04-28', 40, 'koekoek', 1),
(44, '2014-04-29', 40, 'abc', 1),
(45, '2014-04-28', 40, 'protprot', 1),
(46, '2014-04-25', 34, 'dddddddd', 1),
(47, '2014-04-30', 41, 'Bouw32', 1),
(48, '2014-04-29', 42, 'yolo', 1),
(49, '2014-04-30', 43, 'bert', 1),
(50, '2014-05-01', 44, 'PHP55', 1),
(51, '2014-04-30', 45, 'sport3', 1),
(52, '2014-04-30', 46, 'lucht', 1),
(53, '2014-04-30', 46, 'lucht', 1),
(54, '2014-04-30', 47, 'keuken1', 1);

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
  `afgelegd` tinyint(1) DEFAULT '0',
  `actief` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sessieid`,`rijksregisternr`),
  KEY `gebruikerid` (`rijksregisternr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `sessiegebruiker`
--

INSERT INTO `sessiegebruiker` (`sessieid`, `rijksregisternr`, `score`, `percentage`, `geslaagd`, `afgelegd`, `actief`) VALUES
(29, '12345678900', 0, '0', 0, 0, 1),
(29, '44444444444', 2, '67', 0, 1, 1),
(29, '99999999999', 3, '100', 0, 1, 1),
(31, '12345678900', 0, '0', 0, 0, 1),
(31, '44444444444', 1, '17', 0, 1, 1),
(31, '99999999999', 0, '0', 0, 1, 1),
(32, '12345678900', 0, '0', 0, 0, 1),
(32, '44444444444', 0, '0', 0, 0, 1),
(32, '99999999999', 0, '0', 0, 0, 1),
(35, '12345678900', 0, '0', 0, 0, 1),
(36, '44444444444', 0, '0', 0, 1, 1),
(38, '88888888800', 0, '0', 0, 1, 1),
(38, '88888888801', 0, '0', 0, 0, 1),
(38, '88888888802', 0, '0', 0, 0, 1),
(38, '88888888803', 0, '0', 0, 0, 1),
(38, '88888888804', 0, '0', 0, 0, 1),
(38, '88888888805', 0, '0', 0, 0, 1),
(38, '88888888806', 0, '0', 0, 0, 1),
(38, '88888888807', 0, '0', 0, 0, 1),
(38, '88888888808', 0, '0', 0, 0, 1),
(38, '88888888809', 0, '0', 0, 0, 1),
(38, '88888888810', 1, '100', 0, 1, 1),
(38, '88888888811', 0, '0', 0, 0, 1),
(38, '88888888812', 0, '0', 0, 0, 1),
(38, '88888888813', 0, '0', 0, 0, 1),
(38, '88888888814', 0, '0', 0, 0, 1),
(38, '88888888815', 0, '0', 0, 0, 1),
(38, '88888888816', 0, '0', 0, 0, 1),
(38, '88888888817', 0, '0', 0, 0, 1),
(38, '88888888818', 0, '0', 0, 0, 1),
(38, '88888888819', 0, '0', 0, 0, 1),
(39, '88888888800', 0, '0', 0, 1, 1),
(39, '88888888801', 0, '0', 0, 0, 1),
(39, '88888888802', 0, '0', 0, 0, 1),
(39, '88888888803', 1, '100', 1, 1, 1),
(39, '88888888804', 0, '0', 0, 0, 1),
(39, '88888888805', 0, '0', 0, 0, 1),
(39, '88888888806', 0, '0', 0, 0, 1),
(39, '88888888807', 0, '0', 0, 0, 1),
(39, '88888888808', 0, '0', 0, 0, 1),
(39, '88888888809', 0, '0', 0, 0, 1),
(39, '88888888810', 0, '0', 0, 0, 1),
(39, '88888888811', 0, '0', 0, 0, 1),
(39, '88888888812', 0, '0', 0, 0, 1),
(39, '88888888813', 0, '0', 0, 0, 1),
(39, '88888888814', 0, '0', 0, 0, 1),
(39, '88888888815', 0, '0', 0, 0, 1),
(39, '88888888816', 0, '0', 0, 0, 1),
(39, '88888888817', 0, '0', 0, 0, 1),
(39, '88888888818', 0, '0', 0, 0, 1),
(39, '88888888819', 0, '0', 0, 0, 1),
(39, '88888888820', 0, '0', 0, 0, 1),
(39, '88888888821', 0, '0', 0, 0, 1),
(39, '88888888822', 0, '0', 0, 0, 1),
(39, '88888888823', 0, '0', 0, 0, 1),
(39, '88888888824', 0, '0', 0, 0, 1),
(39, '88888888825', 0, '0', 0, 0, 1),
(39, '88888888826', 0, '0', 0, 0, 1),
(39, '88888888827', 0, '0', 0, 0, 1),
(39, '88888888828', 0, '0', 0, 0, 1),
(39, '88888888829', 0, '0', 0, 0, 1),
(39, '88888888830', 1, '100', 0, 1, 1),
(39, '88888888855', 0, '0', 0, 0, 1),
(40, '12345678900', 0, '0', 0, 0, 1),
(40, '33333333333', 0, '0', 0, 0, 1),
(40, '44444444444', 0, '0', 0, 0, 1),
(40, '55544466633', 0, '0', 0, 0, 1),
(40, '88888888800', 0, '0', 0, 0, 1),
(40, '88888888801', 0, '0', 0, 0, 1),
(40, '88888888802', 0, '0', 0, 0, 1),
(40, '88888888803', 0, '0', 0, 0, 1),
(40, '88888888804', 0, '0', 0, 0, 1),
(40, '88888888805', 0, '0', 0, 0, 1),
(40, '88888888806', 0, '0', 0, 0, 1),
(40, '88888888807', 0, '0', 0, 0, 1),
(40, '88888888808', 0, '0', 0, 0, 1),
(40, '88888888809', 0, '0', 0, 0, 1),
(40, '88888888810', 0, '0', 0, 0, 1),
(40, '88888888811', 0, '0', 0, 0, 1),
(40, '88888888812', 0, '0', 0, 0, 1),
(40, '88888888813', 0, '0', 0, 0, 1),
(40, '88888888814', 0, '0', 0, 0, 1),
(40, '88888888815', 0, '0', 0, 0, 1),
(40, '88888888816', 0, '0', 0, 0, 1),
(40, '88888888817', 0, '0', 0, 0, 1),
(40, '88888888818', 0, '0', 0, 0, 1),
(40, '88888888819', 0, '0', 0, 0, 1),
(40, '88888888820', 0, '0', 0, 0, 1),
(40, '88888888821', 0, '0', 0, 0, 1),
(40, '88888888822', 0, '0', 0, 0, 1),
(40, '88888888823', 0, '0', 0, 0, 1),
(40, '88888888824', 0, '0', 0, 0, 1),
(40, '88888888825', 0, '0', 0, 0, 1),
(40, '88888888826', 0, '0', 0, 0, 1),
(40, '88888888827', 0, '0', 0, 0, 1),
(40, '88888888828', 0, '0', 0, 0, 1),
(40, '88888888829', 0, '0', 0, 0, 1),
(40, '88888888830', 0, '0', 0, 0, 1),
(40, '88888888855', 0, '0', 0, 0, 1),
(40, '99999999999', 0, '0', 0, 0, 1),
(41, '12345678900', 0, '0', 0, 0, 1),
(41, '44444444444', 1, '25', 0, 1, 1),
(41, '99999999999', 0, '0', 0, 0, 1),
(42, '12345678900', 0, '0', 0, 0, 1),
(42, '44444444444', 0, '0', 0, 0, 1),
(42, '99999999999', 0, '0', 0, 0, 1),
(43, '12345678900', 2, '100', 0, 1, 1),
(43, '12345678901', 1, '50', 0, 1, 1),
(44, '12345678900', 2, '100', 0, 1, 1),
(44, '12345678901', 2, '100', 1, 1, 1),
(45, '88888888811', 0, '0', 0, 0, 1),
(45, '88888888812', 0, '0', 0, 0, 1),
(45, '88888888823', 0, '0', 0, 0, 1),
(45, '88888888824', 0, '0', 0, 0, 1),
(47, '12345678900', 0, '0', 0, 0, 1),
(48, '12345678900', 5, '100', 1, 1, 1),
(48, '12345678901', 5, '100', 1, 1, 1),
(49, '12345678901', 0, '0', 0, 0, 1),
(50, '12345678900', 0, '0', 0, 0, 1),
(50, '12345678901', 1, '17', 0, 1, 1),
(50, '12345678987', 0, '0', 0, 0, 1),
(50, '44444444444', 0, '0', 0, 0, 1),
(50, '99999999999', 0, '0', 0, 0, 1),
(51, '12345678900', 0, '0', 0, 0, 1),
(51, '12345678901', 0, '0', 0, 0, 1),
(52, '12345678900', 1, '25', 0, 1, 1),
(52, '12345678901', 4, '100', 1, 1, 1),
(53, '12345678900', 0, '0', 0, 0, 1),
(53, '12345678901', 0, '0', 0, 0, 1),
(54, '11223344551', 2, '67', 1, 1, 1),
(54, '12345678900', 0, '0', 0, 0, 1),
(54, '12345678901', 0, '0', 0, 0, 1);

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

--
-- Gegevens worden uitgevoerd voor tabel `sessiegebruikerantwoorden`
--

INSERT INTO `sessiegebruikerantwoorden` (`sessieid`, `gebruikerid`, `vraagid`, `correct`) VALUES
(29, '2147483647', 2, 1),
(29, '2147483647', 11, 0),
(29, '2147483647', 15, 1),
(29, '99999999999', 2, 1),
(29, '99999999999', 11, 1),
(29, '99999999999', 15, 1),
(31, '44444444444', 1, 0),
(31, '44444444444', 4, 0),
(31, '44444444444', 5, 1),
(31, '44444444444', 27, 0),
(31, '44444444444', 28, 0),
(31, '44444444444', 29, 0),
(31, '99999999999', 1, 0),
(31, '99999999999', 4, 0),
(31, '99999999999', 5, 0),
(31, '99999999999', 27, 0),
(31, '99999999999', 28, 0),
(31, '99999999999', 29, 0),
(36, '44444444444', 1, 0),
(38, '88888888800', 30, 1),
(38, '88888888810', 30, 1),
(39, '88888888800', 30, 0),
(39, '88888888803', 30, 1),
(39, '88888888830', 30, 1),
(41, '44444444444', 27, 1),
(41, '44444444444', 28, 0),
(41, '44444444444', 29, 1),
(41, '44444444444', 31, 1),
(43, '12345678900', 32, 1),
(43, '12345678900', 33, 1),
(43, '12345678901', 32, 0),
(43, '12345678901', 33, 1),
(44, '12345678900', 32, 1),
(44, '12345678900', 33, 1),
(44, '12345678901', 32, 1),
(44, '12345678901', 33, 1),
(48, '12345678900', 4, 1),
(48, '12345678900', 5, 1),
(48, '12345678900', 29, 1),
(48, '12345678900', 34, 1),
(48, '12345678901', 4, 1),
(48, '12345678901', 5, 1),
(48, '12345678901', 29, 1),
(48, '12345678901', 34, 1),
(50, '12345678901', 23, 0),
(50, '12345678901', 25, 1),
(50, '12345678901', 26, 0),
(50, '12345678901', 39, 0),
(52, '12345678900', 41, 0),
(52, '12345678900', 42, 1),
(52, '12345678900', 43, 1),
(52, '12345678901', 41, 1),
(52, '12345678901', 42, 1),
(52, '12345678901', 43, 1),
(54, '11223344551', 44, 0),
(54, '11223344551', 45, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Gegevens worden uitgevoerd voor tabel `subcategorie`
--

INSERT INTO `subcategorie` (`subcatid`, `catid`, `subcatnaam`, `actief`) VALUES
(1, 1, 'politiek', 1),
(2, 1, 'landen', 1),
(3, 1, 'kunst', 1),
(4, 2, 'wielrennen', 1),
(5, 2, 'voetbal', 1),
(6, 2, 'andere', 1),
(7, 3, 'htmlcss', 0),
(8, 3, 'javascript', 1),
(9, 3, 'php', 1),
(10, 3, 'sql', 1),
(11, 4, 'testsubcategorie', 1),
(12, 4, 'testsubcategorie2', 1),
(28, 1, 'beeldhouwen', 1),
(35, 2, 'hockey', 1),
(36, 2, 'fierljeppen', 1),
(37, 4, '1', 0),
(38, 4, '2', 0),
(39, 4, '3', 0),
(40, 4, 'testtestest4', 0),
(41, 4, 'testtestest5', 0),
(42, 6, 'IngrediÃ«nten', 1),
(43, 6, 'Potten en pannen', 1),
(44, 7, 'Metselen', 1),
(45, 1, '', 1),
(46, 9, 'Ww2', 1),
(47, 10, 'Keukenmedewerker', 1);

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
  PRIMARY KEY (`testid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Gegevens worden uitgevoerd voor tabel `test`
--

INSERT INTO `test` (`testid`, `testnaam`, `maxduur`, `aantalvragen`, `maxscore`, `tebehalenscore`, `beheerder`, `actief`) VALUES
(32, 'GebruikDezeTestThomas', 123, 6, 9, 60, '98765432100', 1),
(33, 'Sport 2', 120, 3, 3, 60, '32165498755', 1),
(34, 'Cultuur 1', 350, 6, 6, 60, '98765432100', 1),
(35, 'tester V2001', 200, 2, 5, 60, '98765432100', 1),
(36, '1vraag', 200, 1, 1, 60, '98765432100', 1),
(37, 'OverFlowCheck', 123, 1, 1, 60, '98765432100', 1),
(38, 'crashtest', 123, 4, 4, 60, '98765432100', 1),
(39, 'Sport 4', 43, 2, 2, 60, '98765432100', 1),
(40, 'Bouw oriÃ«ntering eindtest', 10, 2, 2, 60, '98765432100', 1),
(41, 'Bouw 32', 350, 1, 1, 60, '98765432100', 1),
(42, 'Landen shuffletest', 15, 4, 5, 60, '98765432100', 1),
(43, 'bertjewertje', 123, 1, 1, 60, '98765432100', 1),
(44, 'PHP 55', 543, 4, 6, 60, '98765432100', 1),
(45, 'Sport 3', 15, 4, 4, 60, '98765432100', 1),
(46, 'Warbirds', 10, 3, 4, 60, '32165498755', 1),
(47, 'Keuken 1', 15, 2, 3, 60, '32165498755', 1);

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

--
-- Gegevens worden uitgevoerd voor tabel `testsubcat`
--

INSERT INTO `testsubcat` (`testid`, `subcatid`, `aantal`, `totgewicht`, `tebehalenscore`) VALUES
(32, 1, 3, 3, 50),
(32, 2, 1, 1, 50),
(32, 3, 2, 5, 50),
(33, 4, 1, 1, 50),
(33, 5, 1, 1, 50),
(33, 36, 1, 1, 50),
(34, 1, 1, 1, 50),
(34, 2, 3, 3, 50),
(34, 28, 2, 2, 50),
(35, 3, 1, 4, 50),
(35, 28, 1, 1, 50),
(36, 1, 1, 1, 50),
(37, 42, 1, 1, 50),
(38, 2, 1, 1, 50),
(38, 28, 3, 3, 50),
(39, 5, 1, 1, 50),
(39, 36, 1, 1, 50),
(40, 44, 2, 2, 50),
(41, 44, 1, 1, 50),
(42, 2, 4, 5, 50),
(43, 42, 1, 1, 50),
(44, 7, 2, 4, 50),
(44, 8, 1, 1, 50),
(44, 10, 1, 1, 50),
(45, 4, 2, 2, 50),
(45, 5, 1, 1, 50),
(45, 36, 1, 1, 50),
(46, 46, 3, 4, 50),
(47, 47, 2, 3, 50);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `testvragen`
--

CREATE TABLE IF NOT EXISTS `testvragen` (
  `testid` int(11) NOT NULL,
  `vraagid` int(11) NOT NULL,
  PRIMARY KEY (`testid`,`vraagid`),
  KEY `testid` (`testid`,`vraagid`),
  KEY `vraagid` (`vraagid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `testvragen`
--

INSERT INTO `testvragen` (`testid`, `vraagid`) VALUES
(32, 1),
(34, 1),
(36, 1),
(33, 2),
(45, 2),
(32, 3),
(32, 4),
(34, 4),
(42, 4),
(34, 5),
(42, 5),
(33, 11),
(39, 11),
(45, 11),
(32, 13),
(32, 14),
(33, 15),
(39, 15),
(45, 15),
(32, 16),
(35, 16),
(44, 23),
(44, 25),
(44, 26),
(34, 27),
(38, 27),
(34, 28),
(35, 28),
(38, 28),
(34, 29),
(38, 29),
(42, 29),
(37, 30),
(38, 31),
(40, 32),
(41, 32),
(40, 33),
(42, 34),
(43, 38),
(44, 39),
(45, 40),
(46, 41),
(46, 42),
(46, 43),
(47, 44),
(47, 45);

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
  PRIMARY KEY (`vraagid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Gegevens worden uitgevoerd voor tabel `vraag`
--

INSERT INTO `vraag` (`subcatid`, `vraagid`, `vraagtekst`, `gewicht`, `correctantwoord`, `actief`) VALUES
(1, 1, 'Welke film won in 2012 de Oscar voor beste buitenlandse film?', 1, 2, 1),
(4, 2, 'Wie won in 2011 de Ronde van Vlaanderen?', 1, 0, 1),
(1, 3, 'De Belgische regeringsformatie van 2012 brak alle vorige records qua duurtijd, na hoeveel dagen na de verkiezing was er een regering?', 1, 3, 1),
(2, 4, 'De winter 2011-2012 kende toch een lange vorstperiode met 14 opeenvolgende ijsdagen. De vorige winter, 2010-2011, kende in totaal hoeveel ijsdagen?', 1, 3, 1),
(2, 5, 'In China is 2012 het jaar van', 1, 1, 1),
(5, 11, 'Wat is het gastland voor de wereldbeker voetbal in 2014?', 1, 2, 1),
(11, 12, 'Testvraag 1130', 5, 2, 1),
(1, 13, 'Wat is de datum van de volgende verkiezingen?', 1, 2, 1),
(3, 14, 'kunst testvraag', 1, 0, 1),
(36, 15, 'Welk(e) voorwerp(en) gebruik je bij fierljeppen', 1, 0, 1),
(3, 16, 'Wie heeft de Rechtvaardige Rechters gestolen?', 4, 2, 1),
(7, 23, '<p><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">Gegeven de volgende HTML:</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">&lt;body&gt;</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">&lt;p&gt;de eenzame herder&lt;/p&gt;</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">&lt;div&gt;springt over</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">&lt;div&gt;het gekke schaap&lt;/div&gt;</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">&lt;/div&gt;</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">&lt;/body&gt; </span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">en volgende CSS</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">body { font-size: 100%; }</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">div { font-size: 1.25em; } </span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">dan heeft de tekst "het gekke schaap" in een standaardbrowser een lettergrootte van</span></p>', 3, 1, 1),
(7, 24, '<p><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">Gegeven de volgende HTML:</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">&lt;ul&gt;</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;li&gt;dieren</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;ul&gt;</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;li&gt;koe&lt;/li&gt;</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;li&gt;schaap&lt;/li&gt;</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;li&gt;kip&lt;/li&gt;</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;/ul&gt;</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;/li&gt;</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;li&gt;planten&lt;/li&gt;</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">&lt;/ul&gt;</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">welke CSS code kleurt het woord "dieren" zwart en het woord "kip" rood?</span></p>', 2, 2, 1),
(8, 25, '<p><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">De juiste manier om een javascript te koppelen aan een HTML pagina is:</span></p>', 1, 0, 1),
(7, 26, '<p><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">Gegeven de volgende HTML:</span><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><code><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">&lt;ul&gt;</span></code><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><code><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;li&gt;dieren</span></code><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><code><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;ul&gt;</span></code><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><code><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;li&gt;koe&lt;/li&gt;</span></code><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><code><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;li&gt;schaap&lt;/li&gt;</span></code><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><code><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;li&gt;kip&lt;/li&gt;</span></code><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><code><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;/ul&gt;</span></code><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><code><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;/li&gt;</span></code><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><code><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;"> &lt;li&gt;planten&lt;/li&gt;</span></code><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><code><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">&lt;/ul&gt;</span></code><br style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;" /><span style="font-family: arial, sans, sans-serif; font-size: 13px; white-space: pre-wrap;">welke CSS code kleurt het woord "dieren" zwart en het woord "kip" rood?</span></p>', 1, 0, 1),
(28, 27, '<p>De denker is een bronzen kunstwerk van welke beeldhouwwerker?</p>', 1, 0, 1),
(28, 28, '<p><strong style="color: #252525; font-family: sans-serif; font-size: 14px; line-height: 22.399999618530273px;">Kolossus van Rodos </strong>stelt welke god voor?</p>', 1, 0, 1),
(2, 29, '<p>Wat is geen buurland van Belgi&euml;?</p>', 1, 0, 1),
(42, 30, '<p>Wat hoort niet thuis in een<strong> witte saus</strong>?</p>', 1, 2, 1),
(28, 31, '<p>Kan dit crashen ?</p>', 1, 0, 1),
(44, 32, '<p>Wat is de juiste verhouding (in volgorde) van zand, cement en water om klassieke mortel te maken?</p>', 1, 2, 1),
(44, 33, '<p>Wat is het gewicht van een rode baksteen type 765?</p>', 1, 1, 1),
(2, 34, '<p>In welk land werd voor het eerst een atoombom tot ontploffing gebracht?</p>', 2, 0, 1),
(1, 35, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>', 1, 0, 1),
(1, 36, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>', 1, 0, 1),
(1, 37, '<p>&nbsp; &nbsp; &nbsp;&nbsp;</p>', 1, 0, 1),
(42, 38, '<p>hoe keukenprinses is bertje</p>', 1, 4, 1),
(10, 39, '<p><code>select * from ''tabel'' where 1</code> geeft welk resultaat?</p>', 1, 4, 1),
(4, 40, '<p>wie is dit?</p>', 1, 1, 1),
(46, 41, '<p>wat hoort niet niet thuis in de rij van foto''s?</p>', 1, 0, 1),
(46, 42, '<p>welk vliegtuig vloog niet voor de us navy?</p>', 2, 2, 1),
(46, 43, '<p>identificeer het type waarmee de flight lead vliegt.</p>', 1, 1, 1),
(47, 44, '<p>welke kleur hebben de snijplanken voor vis?</p>', 1, 1, 1),
(47, 45, '<p>naast boter en bloem, wat moet je nog toevoegen om een bechamel saus te maken?</p>', 2, 2, 1);

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
