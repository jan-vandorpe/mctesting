-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 02 okt 2014 om 09:13
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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `antwoorden`
--

CREATE TABLE IF NOT EXISTS `antwoorden` (
  `vraagid` int(11) NOT NULL,
  `antwoordid` int(11) NOT NULL,
  `antwoordtekst` text NOT NULL,
  `media` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`vraagid`,`antwoordid`),
  KEY `vraagid` (`vraagid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `antwoorden`
--

INSERT INTO `antwoorden` (`vraagid`, `antwoordid`, `antwoordtekst`, `media`) VALUES
(54, 0, '<p>Belgi&euml;</p>', NULL),
(54, 1, '<p>Nederland</p>', NULL),
(54, 2, '<p>Engeland</p>', NULL),
(54, 3, '<p>Frankrijk</p>', NULL),
(55, 0, '<p>Sarand&euml;</p>', NULL),
(55, 1, '<p>Tirana</p>', NULL),
(55, 2, '<p>Durr&euml;s</p>', NULL),
(56, 0, '<p>US</p>', NULL),
(56, 1, '<p>Frankrijk</p>', NULL),
(56, 2, '<p>Canada</p>', NULL),
(56, 3, '<p>Luxemburg</p>', NULL),
(57, 0, '<p>Amazone rivier</p>', NULL),
(57, 1, '<p>De Nijl</p>', NULL),
(58, 0, '<p>Stag Party</p>', NULL),
(58, 1, '<p>Playbook</p>', NULL),
(59, 0, '<p>Sherlock</p>', NULL),
(59, 1, '<p>Study In Scarlet</p>', NULL),
(59, 2, '<p>Sherlock Holmes</p>', NULL),
(60, 0, '<p>Viktor</p>', NULL),
(60, 1, '<p>Wiktor</p>', NULL),
(61, 0, '<p>Louvre</p>', NULL),
(61, 1, '<p>D''orsay</p>', NULL),
(62, 0, '<p>US</p>', NULL),
(62, 1, '<p>Duitsland</p>', NULL),
(62, 2, '<p>Brazili&euml;</p>', NULL),
(63, 0, '<p>1 keer</p>', NULL),
(63, 1, '<p>2 keer</p>', NULL),
(63, 2, '<p>3 keer</p>', NULL),
(63, 3, '<p>5 keer</p>', NULL),
(64, 0, '<p>Adolf Hitler</p>', NULL),
(64, 1, '<p>George I</p>', NULL),
(64, 2, '<p>Charles Curtis</p>', NULL),
(65, 0, '<p>4 cm</p>', NULL),
(65, 1, '<p>5 cm</p>', NULL),
(65, 2, '<p>10 cm</p>', NULL),
(66, 0, '<p>60 min</p>', NULL),
(66, 1, '<p>70 min</p>', NULL),
(66, 2, '<p>90 min</p>', NULL),
(67, 0, '<p>Hyperlinks and Text Markup Language</p>', NULL),
(67, 1, '<p>Hyper Text Markup Language</p>', NULL),
(67, 2, '<p>Home Tool Markup Language</p>', NULL),
(68, 0, '<p>Mozilla</p>', NULL),
(68, 1, '<p>Google</p>', NULL),
(68, 2, '<p>Microsoft</p>', NULL),
(68, 3, '<p>The World Wide Web Consortium</p>', NULL),
(69, 0, '<p>Creative Style Sheets</p>', NULL),
(69, 1, '<p>Colorful Style Sheets</p>', NULL),
(69, 2, '<p>Cascading Style Sheets</p>', NULL),
(69, 3, '<p>Computer Style Sheets</p>', NULL),
(70, 0, '<p>&lt;javascript&gt;</p>', NULL),
(70, 1, '<p>&lt;js&gt;</p>', NULL),
(70, 2, '<p>&lt;scripting&gt;</p>', NULL),
(70, 3, '<p>&lt;script&gt;</p>', NULL),
(71, 0, '<p>#demo.innerHTML = "Hello World!";</p>', NULL),
(71, 1, '<p>document.getElementByName("p").innerHTML = "Hello World!";</p>', NULL),
(71, 2, '<p>document.getElement("p").innerHTML = "Hello World!";</p>', NULL),
(71, 3, '<p>document.getElementById("demo").innerHTML = "Hello World!";</p>', NULL),
(72, 0, '<p>EXTRACT</p>', NULL),
(72, 1, '<p>OPEN</p>', NULL),
(72, 2, '<p>SELECT</p>', NULL),
(72, 3, '<p>GET</p>', NULL),
(73, 0, '<p>Private Home Page</p>', NULL),
(73, 1, '<p>Personal Hypertext Processor</p>', NULL),
(73, 2, '<p>PHP: Hypertext Preprocessor</p>', NULL),
(73, 3, '<p>Personal Home Page</p>', NULL),
(74, 0, '<p>Beeld van Zeus te Olympia</p>', '30cac_zeus-300x232.jpg'),
(74, 1, '<p>Moai beelden op Paaseiland</p>', '73dab_Moai.jpg'),
(74, 2, '<p>Hangende tuinen van Babylon</p>', '23d57_Hanging_Gardens_of_Babylon.jpg'),
(74, 3, '<p>Piramide van Cheops</p>', '014c0_Pyramide_Kheops.JPG'),
(82, 0, '<p>1</p>', NULL),
(82, 1, '<p>2</p>', NULL),
(82, 2, '<p>3</p>', NULL),
(84, 0, '<p>sdf</p>', NULL),
(84, 1, '<p>qsdf</p>', NULL),
(85, 0, '<p>efe</p>', NULL),
(85, 1, '<p>efef</p>', NULL),
(85, 2, '<p>efef</p>', NULL),
(86, 0, '<p>kl</p>', NULL),
(86, 1, '<p>n,;</p>', NULL),
(87, 0, '<p>f</p>', NULL),
(87, 1, '<p>f</p>', NULL),
(88, 0, '<p>fff</p>', NULL),
(88, 1, '<p>fff</p>', NULL),
(89, 0, '<p>efe</p>', NULL),
(89, 1, '<p>efef</p>', NULL),
(90, 0, '<p>ffffff</p>', NULL),
(90, 1, '<p>ffffff</p>', NULL),
(91, 0, '<p>rgrg</p>', NULL),
(91, 1, '<p>rgrg</p>', NULL),
(92, 0, '<p>rgrgr</p>', NULL),
(92, 1, '<p>rgrg</p>', NULL),
(93, 0, '<p>"r</p>', NULL),
(93, 1, '<p>''g</p>', NULL),
(94, 0, '<p>rg</p>', NULL),
(94, 1, '<p>rg</p>', NULL),
(95, 0, '<p>erg</p>', NULL),
(95, 1, '<p>rgerg</p>', NULL),
(96, 0, '<p>rg</p>', NULL),
(96, 1, '<p>rg</p>', NULL),
(97, 0, '<p>eqrge</p>', NULL),
(97, 1, '<p>rgqrg</p>', NULL),
(98, 0, '<p>zd</p>', NULL),
(98, 1, '<p>zd</p>', NULL),
(99, 0, '<p>zd</p>', NULL),
(99, 1, '<p>zd</p>', NULL),
(100, 0, '<p>zdzd</p>', NULL),
(100, 1, '<p>zdzd</p>', NULL),
(101, 0, '<p>ef</p>', NULL),
(101, 1, '<p>ef</p>', NULL),
(102, 0, '<p>efef</p>', NULL),
(102, 1, '<p>efef</p>', NULL),
(103, 0, '<p>&sect;y&sect;y</p>', NULL),
(103, 1, '<p>&sect;y&sect;y</p>', NULL),
(104, 0, '<p>hryh</p>', NULL),
(104, 1, '<p>thhr</p>', NULL),
(105, 0, '<p>ef</p>', NULL),
(105, 1, '<p>ef</p>', NULL),
(106, 0, '<p>efef</p>', NULL),
(106, 1, '<p>efef</p>', NULL),
(107, 0, '<p>rrg</p>', NULL),
(107, 1, '<p>rrg</p>', NULL),
(108, 0, '<p>rgrg</p>', NULL),
(108, 1, '<p>rgrg</p>', NULL),
(109, 0, '<p>r''r</p>', NULL),
(109, 1, '<p>r''r</p>', NULL),
(110, 0, '<p>ol</p>', NULL),
(110, 1, '<p>ol</p>', NULL),
(110, 2, '<p>ollo</p>', NULL),
(111, 0, '<p>ololo</p>', NULL),
(111, 1, '<p>olololol</p>', NULL),
(111, 2, 'test', NULL),
(112, 0, '<p>fgfg</p>', NULL),
(112, 1, '<p>fgfg</p>', NULL),
(113, 0, '<p>Volleybal</p>', NULL),
(113, 1, '<p>Voetbal</p>', NULL),
(113, 2, '<p>Basketbal</p>', NULL),
(114, 0, '<p>1</p>', '4dbdc_zilver-voor-red-lions-op-ek-hockey-id4815654-1000x800-n_zps3d0de9b9.jpg'),
(114, 1, '<p>2</p>', '14b21_basketbal.jpg'),
(114, 2, '<p>3</p>', '79561_voetbal.jpg'),
(115, 0, '<p>Crunch</p>', NULL),
(115, 1, '<p>Scrum</p>', NULL),
(115, 2, '<p>Plunge</p>', NULL),
(116, 0, '<p>qsd</p>', NULL),
(116, 1, '<p>qsd</p>', NULL),
(117, 0, '<p>1</p>', '84b41_basketbal.jpg'),
(117, 1, '<p>2</p>', '6fdd1_zilver-voor-red-lions-op-ek-hockey-id4815654-1000x800-n_zps3d0de9b9.jpg'),
(117, 2, '<p>3</p>', '282dd_voetbal.jpg'),
(118, 0, '<p>A</p>', NULL),
(118, 1, '<p>B</p>', 'a032c_anchovies.jpg'),
(118, 2, '<p>C</p>', NULL),
(118, 3, '<p>D</p>', '4f1b8_pasta.jpg'),
(119, 0, '<p>er</p>', NULL),
(119, 1, '<p>er</p>', '4cc37_wallpaper.jpg'),
(119, 2, '<p>rr</p>', NULL),
(120, 0, '<p>Ja</p>', NULL),
(120, 1, '<p>Neen</p>', NULL),
(120, 2, '<p>Misschien?</p>', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `catnaam` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `actief` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Gegevens worden uitgevoerd voor tabel `categorie`
--

INSERT INTO `categorie` (`catid`, `catnaam`, `actief`) VALUES
(1, 'cultuur', 0),
(2, 'sport', 1),
(3, 'programma', 1),
(8, 'Heftruck bestuurder', 1),
(9, 'Bouw', 1);

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
('12312312384', '', 'Slabbinck', 'Arne', '', 1, 1, '2014-09-25 11:18:13'),
('12312314255', '', 'arne3', 'slabbinck3', '', 1, 1, '2014-09-25 09:23:16'),
('12318515612', '', 'Slabbinck', 'Arne', '', 1, 1, '2014-09-25 11:19:59'),
('12345248654', '', 'wxcv', 'wxcv', '', 1, 1, '2014-09-25 10:46:54'),
('12345556789', '', 'gebr', 'Test', '', 1, 1, '2014-09-24 09:44:02'),
('12345645612', 'testy@test.be', 'testy', 'testbeheerder', '$2a$10$8UO0ME/Mn8IlaISL2/V9U.MEfoRIQx7TVy/MC9NXb4amXxKqp7PDq', 2, 1, '2014-09-25 08:56:07'),
('12345678900', '', 'Nick', 'Vanpraet', '', 1, 1, '2014-09-24 08:18:06'),
('12345678901', '', 'Kurt', 'Debruyne', '', 1, 1, '2014-09-24 09:38:43'),
('12345678933', 'sam@email.be', 'Sam', 'Bourgeois', '$2a$10$8UO0ME/Mn8IlaISL2/V9U.MEfoRIQx7TVy/MC9NXb4amXxKqp7PDq', 3, 1, '0000-00-00 00:00:00'),
('12345678999', '', 'Test', 'Gebruiker', '', 1, 1, '2014-09-24 09:44:02'),
('12365478998', '', 'degrasponny', 'ronny', '', 1, 1, '2014-09-30 09:22:44'),
('12378065485', '', 'pkn', '&', '', 1, 1, '2014-10-02 08:17:25'),
('15948726356', '', 'a', 'juin', '', 1, 1, '2014-09-30 09:31:33'),
('15948746356', '', 'a', 'juin', '', 1, 1, '2014-09-30 10:29:12'),
('15975312122', '', '^$ùµçà', 'éééé', '', 1, 1, '2014-09-25 10:56:52'),
('32165498722', 'hendrik@email.be', 'Hendrik', 'De Buck', '$2a$10$erfWDDsxR1Gxygb1da501.h3TCyaSN1vS1XHm9/.5Ya185Wd31uaC', 3, 0, '0000-00-00 00:00:00'),
('32165498755', 'thomas@email.be', 'Thomas', 'Deserranno', '$2a$10$F55ibf0044.ysSuHu0GNGeG1pXCRFPCjIJaUJ8VnY8UqI8dTRS5Ty', 3, 0, '0000-00-00 00:00:00'),
('32165498774', '', 'qsdf', 'jaak', '', 1, 1, '2014-09-30 09:22:44'),
('44444544484', '', 'Lucky', 'Strike', '', 1, 1, '2014-09-25 08:30:50'),
('44448887554', '', 'xcvxw', 'vv', '', 1, 1, '2014-09-25 10:46:31'),
('44455545441', '', 'Toetsenbord ', 'Computer', '', 1, 1, '2014-09-30 08:17:34'),
('44478895621', '', 'Arne', 'Slabbinck', '', 1, 1, '2014-09-25 10:27:10'),
('44555454545', '', 'CLÍMACO  ', 'peñjata', '', 1, 1, '2014-09-30 11:04:26'),
('45451512311', '', 'Met', 'Puntjes', '', 1, 1, '2014-09-25 10:42:58'),
('45645612111', '', 'arne2', 'slabbinck2', '', 1, 1, '2014-09-25 09:23:16'),
('45678901230', 'beheerder@email.be', 'Beheerder', 'Beheerdernaam', '$2a$10$F55ibf0044.ysSuHu0GNGeG1pXCRFPCjIJaUJ8VnY8UqI8dTRS5Ty', 2, 1, '0000-00-00 00:00:00'),
('47589658528', '', 'CLÍMACO  ', 'peñjata', '', 1, 1, '2014-09-30 11:04:26'),
('47989658528', '', 'aa', 'bb', '', 1, 1, '2014-09-25 08:44:44'),
('48596258559', '', 'A', 'B', '', 1, 1, '2014-09-25 09:51:51'),
('48652315678', '', 'E', 'F', '', 1, 1, '2014-09-25 09:51:51'),
('48691329852', '', 'Bril', 'Doos', '', 1, 1, '2014-09-25 09:51:51'),
('55588874235', '', 'arne', 'slabbinck', '', 1, 1, '2014-09-25 08:44:44'),
('55588888666', '', 'arne', 'µù$^µ$=', '', 1, 1, '2014-09-25 10:58:57'),
('56852145986', '', 'C', 'D', '', 1, 1, '2014-09-25 09:51:51'),
('58585252564', '', 'arne1', 'slabbinck1', '', 1, 1, '2014-09-25 09:23:16'),
('58845645672', '', 'nanana', '$^$slabsab', '', 1, 1, '2014-09-25 11:04:38'),
('65458654862', '', 'xwcv', 'wxcv', '', 1, 1, '2014-09-25 10:46:54'),
('66655855441', '', 'Sam', 'Bourgois', '', 1, 1, '2014-09-25 10:27:10'),
('66655858541', 'stevie@test.be', 'Steve', 'Jobs', '$2a$10$jQGIHeHR4GbqsgmbREVIKenqN.xOveCTjWuylpF5Q.zVAWPc3IwOu', 2, 1, '2014-09-25 09:04:41'),
('66655895441', '', 'Jarni', 'Vansteenkiste', '', 1, 1, '2014-09-25 10:27:10'),
('66666666662', '', 'Hond', 'Kakkerlak', '', 1, 1, '2014-09-25 08:21:50'),
('66695558421', '', 'arne', 'slabbinck', '', 1, 1, '2014-09-25 08:21:58'),
('66695848652', '', 'Marl', 'Boro', '', 1, 1, '2014-09-25 08:30:50'),
('67655195441', '', 'aaa', 'bbb', '', 1, 1, '2014-09-25 10:27:10'),
('67655895441', '', 'Nog', 'Eentje', '', 1, 1, '2014-09-25 10:27:10'),
('69988552541', '', 'Streepjes', 'Swag', '', 1, 1, '2014-09-25 10:48:46'),
('74775884695', '', 'Mac', 'Apple', '', 1, 1, '2014-09-25 09:04:41'),
('78951589912', '', 'arne', 'slabbinck', '', 1, 1, '2014-09-25 09:23:16'),
('85214796325', '', 'decrossmol', 'pol', '', 1, 1, '2014-09-30 09:22:44'),
('88888844512', '', 'Nijlpaard', 'Olifant', '', 1, 1, '2014-09-25 08:21:50'),
('88888888882', '', 'Giraffe', 'Olifant', '', 1, 1, '2014-09-25 08:21:50'),
('89998225462', '', 'Nog', 'Eentje', '', 1, 1, '2014-09-30 08:17:34'),
('98653524755', '', 'G', 'H', '', 1, 1, '2014-09-25 09:51:51'),
('98765432100', 'bram@email.be', 'Bram', 'Peters', '$2a$10$jP3CzzLnjX/1azG1LD2Kkuuy/ZCm7K2sOCs9NSNkCtII9Rdlwt6A2', 3, 0, '0000-00-00 00:00:00'),
('99966655854', '', 'Arne', 'Slabbinck', '', 1, 1, '2014-09-24 08:20:36'),
('99985558621', '', 'Muis', 'Scherm', '', 1, 1, '2014-09-30 08:17:34'),
('99999999992', '', 'Muis', 'Kat', '', 1, 1, '2014-09-25 08:21:50');

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
(60, 0, '7c778_frankenstein.jpg'),
(61, 0, '73a38_monalisa.jpg'),
(61, 1, 'cb97c_voetbal.jpg'),
(73, 0, '948a7_php.jpg'),
(113, 0, 'cb97c_voetbal.jpg'),
(118, 0, '01c4c_wallpaper.jpg'),
(119, 0, '6b179_olives.jpg'),
(119, 1, 'e6703_anchovies.jpg'),
(120, 0, 'deb11_opct_84fcc45d3d38b72d77634167d1ca4162c521e180 (1).jpg'),
(120, 1, 'f9798_twitter.png'),
(120, 2, '44d95_fb2.png');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Gegevens worden uitgevoerd voor tabel `sessie`
--

INSERT INTO `sessie` (`sessieid`, `datum`, `testid`, `sessieww`, `actief`) VALUES
(60, '2014-09-24', 50, 'test', 1),
(61, '2014-09-24', 48, 'sugar', 1),
(62, '2014-09-26', 50, 'test', 1),
(63, '2014-10-02', 59, 'test', 1),
(64, '2014-10-03', 55, 'test', 1);

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

--
-- Gegevens worden uitgevoerd voor tabel `sessiegebruiker`
--

INSERT INTO `sessiegebruiker` (`sessieid`, `rijksregisternr`, `score`, `percentage`, `geslaagd`, `afgelegd`, `actief`) VALUES
(60, '99966655854', 2, '50', 0, 1, 0),
(61, '12345556789', 3, '50', 0, 1, 0),
(61, '12345678999', 3, '50', 0, 1, 0),
(61, '99966655854', 5, '83', 1, 1, 0),
(62, '12345556789', 0, '0', 0, NULL, 0),
(62, '12345678900', 4, '100', 1, 1, 0),
(62, '12345678901', 2, '50', 0, 1, 0),
(62, '12345678999', 2, '50', 0, 1, 0),
(62, '44444544484', 2, '50', 0, 1, 0),
(62, '47989658528', 0, '0', 0, NULL, 0),
(62, '66655858541', 0, '0', 0, NULL, 0),
(62, '66695848652', 0, '0', 0, NULL, 0),
(62, '74775884695', 0, '0', 0, NULL, 0),
(63, '12345678900', 7, '78', 0, 1, 0),
(64, '74775884695', 0, '0', 0, NULL, 0);

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
(60, '99966655854', 58, 0),
(60, '99966655854', 59, 0),
(60, '99966655854', 60, 1),
(60, '99966655854', 61, 1),
(62, '12345678900', 58, 1),
(62, '12345678900', 59, 1),
(62, '12345678900', 60, 1),
(62, '12345678900', 61, 1),
(62, '12345678901', 58, 1),
(62, '12345678901', 59, 0),
(62, '12345678901', 60, 0),
(62, '12345678901', 61, 1),
(62, '12345678999', 58, 0),
(62, '12345678999', 59, 1),
(62, '12345678999', 60, 0),
(62, '12345678999', 61, 1),
(62, '44444544484', 58, 0),
(62, '44444544484', 59, 1),
(62, '44444544484', 60, 1),
(62, '44444544484', 61, 0),
(63, '12345678900', 55, 1),
(63, '12345678900', 56, 1),
(63, '12345678900', 57, 1),
(63, '12345678900', 58, 1),
(63, '12345678900', 59, 0),
(63, '12345678900', 60, 0),
(63, '12345678900', 61, 1),
(63, '12345678900', 74, 0);

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

--
-- Gegevens worden uitgevoerd voor tabel `sessiegebruikercategoriepercentages`
--

INSERT INTO `sessiegebruikercategoriepercentages` (`sessieid`, `rijksregisternr`, `testid`, `subcatid`, `score`, `percentage`) VALUES
(60, '99966655854', 50, 3, 1, 100),
(60, '99966655854', 50, 46, 1, 33),
(61, '12345556789', 48, 2, 0, 0),
(61, '12345556789', 48, 3, 1, 50),
(61, '12345556789', 48, 46, 2, 100),
(61, '12345678900', 48, 2, 2, 100),
(61, '12345678900', 48, 3, 2, 100),
(61, '12345678900', 48, 46, 2, 100),
(61, '12345678999', 48, 2, 0, 0),
(61, '12345678999', 48, 3, 1, 50),
(61, '12345678999', 48, 46, 2, 100),
(61, '99966655854', 48, 2, 1, 50),
(61, '99966655854', 48, 3, 2, 100),
(61, '99966655854', 48, 46, 2, 100),
(62, '12345678900', 50, 3, 1, 100),
(62, '12345678900', 50, 46, 3, 100),
(62, '12345678901', 50, 3, 1, 100),
(62, '12345678901', 50, 46, 1, 33),
(62, '12345678999', 50, 3, 1, 100),
(62, '12345678999', 50, 46, 1, 33),
(62, '44444544484', 50, 3, 0, 0),
(62, '44444544484', 50, 46, 2, 67),
(63, '12345678900', 59, 2, 3, 100),
(63, '12345678900', 59, 3, 3, 100),
(63, '12345678900', 59, 46, 1, 33);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `subcategorie`
--

CREATE TABLE IF NOT EXISTS `subcategorie` (
  `subcatid` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL,
  `subcatnaam` tinytext NOT NULL,
  `actief` tinyint(1) NOT NULL,
  PRIMARY KEY (`subcatid`),
  KEY `catid` (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Gegevens worden uitgevoerd voor tabel `subcategorie`
--

INSERT INTO `subcategorie` (`subcatid`, `catid`, `subcatnaam`, `actief`) VALUES
(1, 1, 'politiek', 1),
(2, 1, 'landen', 1),
(3, 1, 'kunst', 1),
(4, 2, 'wielrennen', 0),
(5, 2, 'voetbal', 1),
(6, 2, 'andere', 1),
(7, 3, 'htmlcss', 1),
(8, 3, 'javascript', 1),
(9, 3, 'php', 1),
(10, 3, 'sql', 1),
(28, 1, 'beeldhouwen', 1),
(35, 2, 'hockey', 1),
(46, 1, 'Literatuur', 1),
(47, 2, 'Volleybal', 1),
(48, 8, 'Mechanica', 0),
(49, 1, 'Efef', 1),
(50, 9, 'Shilders', 0),
(51, 9, 'Supermechanica', 0),
(52, 9, 'Superbouw', 0);

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
  PRIMARY KEY (`testid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- Gegevens worden uitgevoerd voor tabel `test`
--

INSERT INTO `test` (`testid`, `testnaam`, `maxduur`, `aantalvragen`, `maxscore`, `tebehalenscore`, `beheerder`, `actief`, `gepubliceerd`) VALUES
(48, 'Cultuur 1', 50, 6, 6, 60, '12345678933', 1, 1),
(49, 'Web 1', 60, 7, 7, 60, '12345678933', 1, 1),
(50, 'Cultuur 2', 30, 4, 6, 60, '12345678933', 1, 1),
(55, 'Evenwicht', 5, 1, 1, 60, '12345678933', 1, 1),
(57, 'PDF test', 18, 8, 8, 60, '32165498722', 1, 1),
(59, 'Er was eens een kikker', 69, 8, 9, 60, '32165498722', 1, 1),
(60, 'Sportdiversiteit', 50, 4, 4, 60, '32165498722', 1, 1),
(61, 'Programmeren 1', 40, 6, 6, 70, '12345645612', 1, 1),
(62, 'Nog maar eens', 69, 2, 4, 60, '32165498722', 1, 1),
(63, 'fhf', 60, 3, 3, 60, '12345678933', 1, 1),
(64, 'Cultuur 5', 70, 3, 5, 90, '12345678933', 1, 1),
(68, 'Cultuur 4', 40, 5, 7, 60, '12345678933', 1, 1),
(69, 'Cultuur 3', 40, 9, 11, 60, '12345678933', 1, 1),
(70, 'Web4', 60, 8, 9, 60, '12345678933', 1, 1),
(71, 'Web5', 50, 1, 2, 60, '12345678933', 1, 1),
(72, 'Snoopdoooggg', 10, 1, 1, 60, '32165498722', 1, 1);

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
(48, 2, 2, 2, 50),
(48, 3, 2, 2, 50),
(48, 46, 2, 2, 60),
(49, 7, 3, 3, 50),
(49, 8, 2, 2, 50),
(49, 9, 1, 1, 50),
(49, 10, 1, 1, 50),
(50, 3, 1, 1, 50),
(50, 46, 3, 3, 50),
(55, 48, 1, 1, 50),
(57, 7, 3, 3, 50),
(57, 8, 3, 3, 50),
(57, 9, 1, 1, 50),
(57, 10, 1, 1, 50),
(59, 2, 3, 3, 50),
(59, 3, 2, 3, 50),
(59, 46, 3, 3, 50),
(60, 6, 4, 4, 50),
(61, 7, 3, 3, 60),
(61, 8, 3, 3, 70),
(62, 3, 1, 3, 50),
(62, 46, 1, 1, 50),
(63, 7, 3, 3, 50),
(64, 46, 1, 1, 50),
(68, 2, 2, 2, 50),
(69, 46, 3, 3, 50),
(70, 8, 3, 3, 50),
(71, 7, 1, 2, 50),
(72, 28, 1, 1, 50);

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

--
-- Gegevens worden uitgevoerd voor tabel `testvragen`
--

INSERT INTO `testvragen` (`testid`, `vraagid`) VALUES
(48, 55),
(48, 56),
(48, 58),
(48, 59),
(48, 61),
(48, 74),
(49, 67),
(49, 68),
(49, 69),
(49, 70),
(49, 71),
(49, 72),
(49, 73),
(50, 58),
(50, 59),
(50, 60),
(50, 61),
(55, 82),
(57, 67),
(57, 68),
(57, 69),
(57, 70),
(57, 71),
(57, 72),
(57, 73),
(57, 84),
(59, 55),
(59, 56),
(59, 57),
(59, 58),
(59, 59),
(59, 60),
(59, 61),
(59, 74),
(60, 64),
(60, 113),
(60, 114),
(60, 115),
(61, 67),
(61, 68),
(61, 69),
(61, 70),
(61, 71),
(61, 84),
(62, 60),
(62, 61),
(63, 67),
(63, 68),
(63, 69),
(64, 58),
(68, 57),
(69, 60),
(70, 84),
(71, 119),
(72, 120);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=121 ;

--
-- Gegevens worden uitgevoerd voor tabel `vraag`
--

INSERT INTO `vraag` (`subcatid`, `vraagid`, `vraagtekst`, `gewicht`, `correctantwoord`, `actief`) VALUES
(5, 54, '<p>Uit welk land is voetbal afkomstig?</p>', 1, 2, 1),
(2, 55, '<p>Wat is de hoofdstad van Albani&euml;?</p>', 1, 1, 1),
(2, 56, '<p>Welk land heeft de langste kustlijn?</p>', 1, 2, 1),
(2, 57, '<p>Wat is de langste rivier?</p>', 1, 1, 1),
(46, 58, '<p>Wat wou Hugh Heffner als eerste naam voor de Playboy?</p>', 1, 0, 1),
(46, 59, '<p>In welk boek kwam Sherlock Holmes voor het eerst voor?</p>', 1, 1, 1),
(46, 60, '<p>Wat was Frakenstein zijn eerste naam?</p>', 1, 0, 1),
(3, 61, '<p>In welk museum vind u de Mona Lisa?</p>', 3, 0, 1),
(5, 62, '<p>Welk land heeft de meeste voetbal WK&rsquo;s gewonnen?</p>', 1, 2, 1),
(47, 63, '<p>Hoeveel keer mag een volleybal geraakt worden tot hij weer over het net gaat?</p>', 1, 2, 1),
(6, 64, '<p>Wie opende officieel de Olympische spelen van 1936?</p>', 1, 0, 1),
(35, 65, '<p>Hoe groot is de maximumdiameter van een hockeystok?</p>', 1, 1, 1),
(35, 66, '<p>Hoelang duurt een hockeywedstrijd?</p>', 1, 1, 1),
(7, 67, '<p>Waar staat HTML voor?</p>', 1, 1, 1),
(7, 68, '<p>Wie maakt de Web standaards?</p>', 1, 3, 1),
(7, 69, '<p>Waar staat CSS voor?</p>', 1, 2, 1),
(8, 70, '<p>In welk HTML element stoppen we JavaScript?</p>', 1, 3, 1),
(8, 71, '<p>Wat is de correcte JavaScript syntax om de inhoud van onderstaande HTML element te wijzigen?</p>\n<blockquote>\n&lt;p id="demo"&gt;This is a demonstration.&lt;/p&gt;\n</blockquote>', 1, 3, 1),
(10, 72, '<p>Welke SQL statement wordt gebruikt om data op te halen uit een database?</p>', 1, 2, 1),
(9, 73, '<p>Waar staat PHP voor?</p>', 1, 2, 1),
(3, 74, '<p>Wat hoort niet bij de rest?</p>', 1, 1, 1),
(48, 82, '<p>Hoeveel wielen heeft een driewieler</p>', 1, 2, 1),
(51, 83, '<p>qsdfqsdf</p>', 1, 0, 1),
(8, 84, '<p>qsdfqsdf</p>', 1, 0, 1),
(48, 85, '<p>zjfkzejf</p>', 1, 0, 1),
(50, 86, '<p>jkl</p>', 1, 0, 1),
(50, 87, '<p>f</p>', 1, 0, 1),
(50, 88, '<p>ffff</p>', 1, 0, 1),
(50, 89, '<p>fef</p>', 1, 0, 1),
(50, 90, '<p>fffff</p>', 1, 0, 1),
(50, 91, '<p style="text-align: justify;">rgrg</p>', 1, 0, 1),
(50, 92, '<p>grgrg</p>', 1, 0, 1),
(50, 93, '<p>rr</p>', 1, 0, 1),
(50, 94, '<p>gh</p>', 1, 0, 1),
(50, 95, '<p>rg</p>', 1, 0, 1),
(50, 96, '<p>gheg</p>', 1, 0, 1),
(50, 97, '<p>erg</p>', 1, 0, 1),
(50, 98, '<p>zd</p>', 1, 0, 1),
(50, 99, '<p>zdzd</p>', 1, 0, 1),
(50, 100, '<p>zdz</p>', 1, 0, 1),
(50, 101, '<p>ef</p>', 1, 1, 1),
(50, 102, '<p>zef</p>', 1, 0, 1),
(50, 103, '<p>&sect;''&sect;</p>', 1, 0, 1),
(50, 104, '<p>rgh</p>', 1, 0, 1),
(50, 105, '<p>zef</p>', 1, 0, 1),
(50, 106, '<p>efef</p>', 1, 0, 1),
(50, 107, '<p>erg</p>', 1, 0, 1),
(50, 108, '<p>db</p>', 1, 0, 1),
(50, 109, '<p>''r</p>', 1, 0, 1),
(50, 110, '<p>lo</p>', 1, 0, 1),
(50, 111, '<p>olol</p>', 1, 0, 1),
(48, 112, '<p>fgf</p>', 1, 0, 1),
(6, 113, '<p>Welke sport wordt weergegeven op deze afbeelding.</p>', 1, 1, 1),
(6, 114, '<p>Welke foto representeerd de sport Basketbal?</p>', 1, 0, 1),
(6, 115, '<p>Wat gebeurd er in de volgende foto</p>', 1, 1, 1),
(3, 116, '<p>qsdf</p>', 1, 0, 1),
(6, 117, '<p>Welke sport representeerd basketbal?</p>', 1, 0, 1),
(7, 118, '<p>test</p>', 1, 3, 1),
(7, 119, '<p>er</p>', 2, 1, 1),
(28, 120, '<p>Dit is een vraag waar er meerdere afbeeldingen verschijnen die ook mooi moeten weergegeven worden in de .PDF</p>', 1, 2, 1);

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
