-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 17 apr 2014 om 14:57
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
(5, 99, 'Testantwoord'),
(11, 0, 'BelgiÃ«'),
(11, 1, 'China'),
(11, 2, 'BraziliÃ«'),
(11, 3, 'Rusland'),
(12, 0, 'A'),
(12, 1, '2'),
(12, 2, 'Kleine friet met mayo'),
(12, 3, 'Bram?'),
(13, 0, '2 mei'),
(13, 1, '17 juni'),
(13, 2, '25 mei'),
(13, 3, '5 november'),
(14, 0, 'ja'),
(14, 1, 'nee'),
(14, 2, 'kweetnie'),
(15, 0, 'Een stok'),
(15, 1, 'Een bal'),
(15, 2, 'Hoepels'),
(15, 3, 'AK47'),
(16, 0, 'Bram'),
(16, 1, 'Hendrik'),
(16, 2, 'Jan'),
(16, 3, 'Bert2'),
(17, 0, 'a'),
(17, 1, 'a'),
(17, 2, 'a'),
(17, 3, 'a'),
(18, 0, 'a'),
(18, 1, 'a'),
(18, 2, 'a'),
(18, 3, 'a'),
(19, 0, 'a'),
(19, 1, 'a'),
(19, 2, 'a'),
(19, 3, 'a'),
(20, 0, 'Linker arm'),
(20, 1, 'Rechter arm'),
(20, 2, 'Beide benen'),
(20, 3, 'Alle ledematen');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bramsessie`
--

CREATE TABLE IF NOT EXISTS `bramsessie` (
  `sessieid` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date NOT NULL,
  `testid` int(11) NOT NULL,
  `sessieww` varchar(50) NOT NULL,
  `actief` tinyint(1) NOT NULL,
  PRIMARY KEY (`sessieid`),
  KEY `testid` (`testid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Gegevens worden uitgevoerd voor tabel `bramsessie`
--

INSERT INTO `bramsessie` (`sessieid`, `datum`, `testid`, `sessieww`, `actief`) VALUES
(1, '2014-04-01', 1, '1', 0),
(2, '2014-04-17', 0, 'hihiiiiiiiiiiiiiiiiiiiiiii', 1),
(3, '2014-04-08', 3, 'testr', 1),
(4, '2014-04-25', 5, 'thomas', 1),
(5, '2014-04-25', 5, 'thomas', 1),
(6, '2014-04-27', 4, 'thomas2', 1),
(7, '2014-04-27', 4, 'thomas2', 1),
(8, '2014-04-03', 0, '4', 1),
(9, '2014-04-15', 0, '8', 1),
(10, '2014-04-15', 0, '8', 1),
(11, '2014-04-01', 0, '9', 1),
(12, '2014-04-01', 0, '9', 1),
(13, '2014-04-01', 0, '10', 1),
(14, '2014-04-01', 0, '10', 1),
(15, '2014-04-01', 0, '11', 1),
(16, '2014-04-17', 0, 'testt10', 1),
(17, '2014-04-16', 1, 'aze', 1),
(18, '2012-02-01', 8, 'protprot', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bramsessiegebruiker`
--

CREATE TABLE IF NOT EXISTS `bramsessiegebruiker` (
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
-- Gegevens worden uitgevoerd voor tabel `bramsessiegebruiker`
--

INSERT INTO `bramsessiegebruiker` (`sessieid`, `rijksregisternr`, `score`, `percentage`, `geslaagd`, `afgelegd`, `actief`) VALUES
(1, '12345678900', 1, '50', 1, 1, 0),
(5, '12345678900', 0, '0', 0, 1, 1),
(5, '44475888888', 0, '0', 0, 1, 1),
(5, '46737215184', 0, '0', 0, 1, 1),
(8, '12345678900', 0, '0', 0, 0, 1),
(18, '32165498723', 0, '0', 0, 0, 1),
(18, '44475888888', 0, '0', 0, 0, 1),
(18, '46737215184', 0, '0', 0, 0, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bramtest`
--

CREATE TABLE IF NOT EXISTS `bramtest` (
  `testid` int(11) NOT NULL AUTO_INCREMENT,
  `testnaam` tinytext NOT NULL,
  `maxduur` int(3) NOT NULL,
  `aantalvragen` int(11) NOT NULL,
  `maxscore` int(11) NOT NULL,
  `beheerder` varchar(11) NOT NULL,
  `aanmaaktijdstip` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`testid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Gegevens worden uitgevoerd voor tabel `bramtest`
--

INSERT INTO `bramtest` (`testid`, `testnaam`, `maxduur`, `aantalvragen`, `maxscore`, `beheerder`, `aanmaaktijdstip`) VALUES
(1, 'PHP FOR BEGINNERS', 1, 4, 4, '3', '2014-04-15 07:08:26'),
(3, 'PHP FOR EXPERTS', 4, 20, 20, '6', '2014-04-15 07:08:26'),
(4, 'WORD FOR BEGINNERS', 4, 20, 20, '6', '2014-04-15 07:08:26'),
(5, 'WORD FOR EXPERTS', 4, 20, 20, '6', '2014-04-15 07:08:26'),
(6, 'azer', 100, 2, 2, '98765432100', '2014-04-17 07:21:50'),
(7, 'testtest', 100, 2, 2, '98765432100', '2014-04-17 07:22:12'),
(8, 'testertjes007', 30, 4, 4, '98765432100', '2014-04-17 08:47:18'),
(9, 'testertjes007', 30, 4, 4, '98765432100', '2014-04-17 08:47:26'),
(10, 'testmetVragenUpload', 100, 3, 3, '98765432100', '2014-04-17 09:16:49'),
(11, 'testmetVragenUpload', 100, 3, 3, '98765432100', '2014-04-17 09:16:52'),
(12, 'testmetVragenUpload', 100, 3, 3, '98765432100', '2014-04-17 09:16:54'),
(13, 'testmetVragenUpload', 100, 3, 3, '98765432100', '2014-04-17 09:16:55'),
(14, 'testmetvragenupload2', 100, 2, 5, '98765432100', '2014-04-17 09:17:24'),
(15, 'testmetvragenupload2', 100, 2, 5, '98765432100', '2014-04-17 09:19:04'),
(16, 'testmetvragenupload2', 100, 2, 5, '98765432100', '2014-04-17 09:19:07'),
(17, 'testmetvragenupload3', 100, 3, 6, '98765432100', '2014-04-17 09:19:22'),
(18, 'testmetvragenupload3', 100, 3, 6, '98765432100', '2014-04-17 09:20:05'),
(19, 'bertje', 1, 1, 1, '98765432100', '2014-04-17 09:29:19'),
(20, 'bertje', 2, 1, 1, '98765432100', '2014-04-17 09:31:32'),
(21, 'bertje', 22, 2, 2, '98765432100', '2014-04-17 09:31:41'),
(22, 'bertje', 333, 2, 2, '98765432100', '2014-04-17 09:31:52'),
(23, 'bertje2', 1, 2, 2, '98765432100', '2014-04-17 09:32:30'),
(24, 'bertje2', 1, 2, 2, '98765432100', '2014-04-17 09:47:01'),
(25, 'bertje2', 1, 2, 2, '98765432100', '2014-04-17 09:47:02'),
(26, 'bertje2', 1, 2, 2, '98765432100', '2014-04-17 09:48:11');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bramtestvragen`
--

CREATE TABLE IF NOT EXISTS `bramtestvragen` (
  `testid` int(11) NOT NULL,
  `vraagid` int(11) NOT NULL,
  KEY `testid` (`testid`,`vraagid`),
  KEY `vraagid` (`vraagid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `bramtestvragen`
--

INSERT INTO `bramtestvragen` (`testid`, `vraagid`) VALUES
(15, 14),
(15, 16),
(16, 14),
(16, 16),
(17, 13),
(17, 14),
(17, 16),
(18, 13),
(18, 14),
(18, 16),
(19, 5),
(20, 3),
(21, 5),
(21, 13),
(22, 5),
(22, 13),
(23, 11),
(23, 15),
(24, 11),
(24, 15),
(25, 11),
(25, 15),
(26, 11),
(26, 15);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bramupload`
--

CREATE TABLE IF NOT EXISTS `bramupload` (
  `nummer` int(11) NOT NULL AUTO_INCREMENT,
  `code` text NOT NULL,
  PRIMARY KEY (`nummer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Gegevens worden uitgevoerd voor tabel `bramupload`
--

INSERT INTO `bramupload` (`nummer`, `code`) VALUES
(2, '<p>aqZER TGRF</p>'),
(27, '<p>test</p>\r\n<p>&lt;html&gt;testtest&lt;/html&gt;</p>\r\n<p>&lt;mistypeditisgeentag&gt;testinfaketag&lt;/stopfaketag&gt;</p>\r\n<p>&lt;faketag&gt;&lt;/faketag&gt;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>'),
(28, '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: rgb(51, 51, 51); font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; text-align: center; background-color: rgba(0, 0, 0, 0.0980392);">test</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: rgb(51, 51, 51); font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; text-align: center; background-color: rgba(0, 0, 0, 0.0980392);"><code>&lt;html&gt;testtest&lt;/html&gt;</code></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: rgb(51, 51, 51); font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; text-align: center; background-color: rgba(0, 0, 0, 0.0980392);"><code>&lt;mistypeditisgeentag&gt;testinfaketag&lt;/stopfaketag&gt;</code></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: rgb(51, 51, 51); font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; text-align: center; background-color: rgba(0, 0, 0, 0.0980392);"><code>&lt;faketag&gt;&lt;/faketag&gt;</code></p>'),
(29, '<p>&lt;tag&gt;&lt;/tag&gt;</p>\r\n<p>&lt;code&gt;&lt;html&gt;Egad, a monster&lt;/html&gt;&lt;/code&gt;</p>\r\n<p>&lt;php&gt;if(){crashtime;}&lt;/php&gt;&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><code>&lt;php&gt;if(){crashtime v2.0;}&lt;/php&gt;&nbsp;</code></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>'),
(30, '<p>gewone zin</p>\r\n<p>&nbsp;</p>\r\n<p>&lt;php&gt;code&lt;/php&gt;</p>\r\n<p>&nbsp;</p>\r\n<p>&lt;code&gt;test&lt;/code&gt;</p>\r\n<p>&nbsp;</p>\r\n<p><code>&lt;code&gt;test&lt;/code&gt;</code></p>'),
(31, '<div class="form-group">\r\n<div class="col-lg-1">&nbsp;</div>\r\n&lt;div class="dikke_brol"&gt;BRAM TOCH&lt;/div&gt;</div>\r\n<div class="form-group">&nbsp;</div>'),
(32, '<div class="form-group">\r\n<div class="col-lg-1">&nbsp;</div>\r\n<code>&lt;div class="dikke_brol"&gt;BRAM TOCH&lt;/div&gt;</code></div>\r\n<div class="form-group">&nbsp;</div>'),
(33, ''),
(34, ''),
(35, '<p><code>&lt;div class="test2"&gt;BRAM BRAM BRAM BRAM&lt;/div&gt;</code></p>'),
(36, '<p>&nbsp; &nbsp;&lt;div class="col-lg-5 centeren" style="width:900px;height:300px;" &gt;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;textarea class="form-control allowcode mceNoEditor" name="codeTeUploaden" id="codeTeUploaden" placeholder="testme code" style="height:190px;"&gt;&lt;/textarea&gt;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class="form-group"&gt;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class="col-lg-3"&gt;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class="col-lg-4 centeren"&gt;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;input type="submit" name="gebrknop" class="form-control"&gt;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</p>'),
(37, '<p><code>&lt;div class="col-lg-5 centeren" style="width:900px;height:300px;" &gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;textarea class="form-control allowcode mceNoEditor" name="codeTeUploaden" id="codeTeUploaden" placeholder="testme code" style="height:190px;"&gt;&lt;/textarea&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class="form-group"&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class="col-lg-3"&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class="col-lg-4 centeren"&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;input type="submit" name="gebrknop" class="form-control"&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</code></p>\r\n<p>&nbsp;</p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</code></p>'),
(38, '<p><code>&lt;div class="col-lg-5 centeren" style="width:900px;height:300px;" &gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;textarea class="form-control allowcode mceNoEditor" name="codeTeUploaden" id="codeTeUploaden" placeholder="testme code" style="height:190px;"&gt;&lt;/textarea&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class="form-group"&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class="col-lg-3"&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class="col-lg-4 centeren"&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;input type="submit" name="gebrknop" class="form-control"&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</code></p>\r\n<p>&nbsp;</p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</code></p>'),
(39, '<p><code>&lt;div class="col-lg-5 centeren" style="width:900px;height:300px;" &gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;textarea class="form-control allowcode mceNoEditor" name="codeTeUploaden" id="codeTeUploaden" placeholder="testme code" style="height:190px;"&gt;&lt;/textarea&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class="form-group"&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class="col-lg-3"&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;div class="col-lg-4 centeren"&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;input type="submit" name="gebrknop" class="form-control"&gt;</code></p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</code></p>\r\n<p>&nbsp;</p>\r\n<p><code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</code></p>'),
(40, '<p>&lt;div class="container-fluid maincontainer"&gt;</p>\r\n<p>&nbsp; &nbsp; &lt;h1 class="headerpage"&gt;Welkom op de testing website van de VDAB&lt;/h1&gt;</p>\r\n<p>&lt;/div&gt;</p>');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `catnaam` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `actief` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `categorie`
--

INSERT INTO `categorie` (`catid`, `catnaam`, `actief`) VALUES
(1, 'cultuur', 1),
(2, 'sport', 1),
(3, 'programma', 1),
(4, 'test', 1),
(5, 'Lege testcategorie', 1);

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
('12345678900', 'gebruiker@email.be', 'gebruiker', 'gebruikerfnaam', 'qsdf', 1, 1),
('12345678933', 'bert@email.be', 'Bert', 'Mortier', 'qsdf', 3, 1),
('32165498722', 'hendrik@email.be', 'Hendrik', 'De Buck', 'qsdf', 3, 1),
('32165498723', '', 'nummerEEN', 'testgebruiker', '', 1, 1),
('32165498755', 'thomas@email.be', 'Thomas', 'Deserranno', 'azerty', 3, 1),
('44475888888', '', 'p', 'o', '', 1, 1),
('45678901230', 'beheerder@email.be', 'beheerder', 'beheerderfnaam', 'qsdf', 2, 1),
('45781273864', '', 'tester', 'ulrich', '', 1, 1),
('46737215184', '', 'retsr', 'testr', '', 1, 1),
('78451545454', '', 'nummerTWEE', 'testgebruiker', '', 1, 1),
('98765432100', 'bram@email.be', 'Bram', 'Peters', 'wxcv', 3, 1);

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
(12, 1, 'lazarus-1.0.14-fpc-2.6.2-win32.exe');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `sessie`
--

INSERT INTO `sessie` (`sessieid`, `datum`, `testid`, `sessieww`, `actief`) VALUES
(1, '2014-04-01', 1, '1', 0),
(2, '2014-04-17', 1, 'domkalf', 1),
(3, '2014-04-17', 1, 'koekoek', 0);

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
(1, '12345678900', 1, '50', 1, 1, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

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
(7, 3, 'htmlcss', 1),
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
(41, 4, 'testtestest5', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `test`
--

INSERT INTO `test` (`testid`, `testnaam`, `maxduur`, `aantalvragen`, `maxscore`, `tebehalenscore`, `beheerder`, `actief`) VALUES
(1, 'o', 1, 1, 1, 0, '1', 1);

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
  PRIMARY KEY (`vraagid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Gegevens worden uitgevoerd voor tabel `vraag`
--

INSERT INTO `vraag` (`subcatid`, `vraagid`, `vraagtekst`, `gewicht`, `correctantwoord`, `actief`) VALUES
(1, 1, 'Welke film won in 2012 de Oscar voor beste buitenlandse film?', 1, 2, 1),
(4, 2, 'Wie won in 2011 de Ronde van Vlaanderen?', 1, 0, 1),
(1, 3, 'De Belgische regeringsformatie van 2012 brak alle vorige records qua duurtijd, na hoeveel dagen na de verkiezing was er een regering?', 1, 3, 1),
(2, 4, 'De winter 2011-2012 kende toch een lange vorstperiode met 14 opeenvolgende ijsdagen. De vorige winter, 2010-2011, kende in totaal hoeveel ijsdagen?', 1, 3, 1),
(2, 5, 'In China is 2012 het jaar van', 1, 1, 1),
(7, 6, 'als Paul zijn naam doorstuurt via een webformulier, bemerkt hij in de adresbalk het url http://www.vdab.be/inschrijven.php?naam=Paul. \r\ndit duidt erop dat het attribuut method van het form element van de formulierpagina de volgende waarde heeft:', 1, 0, 1),
(7, 7, 'Gegeven de volgende HTML:\r\n<body>\r\n<p>de eenzame herder</p>\r\n<div>springt over\r\n<div>het gekke schaap</div>\r\n</div>\r\n</body>   \r\nen volgende CSS\r\nbody { font-size: 100%; }\r\ndiv  { font-size: 1.25em; }        \r\ndan heeft de tekst "het gekke schaap" in een standaardbrowser een lettergrootte van', 3, 3, 1),
(7, 8, 'Gegeven de volgende HTML:\r\n<ul>\r\n  <li>dieren\r\n    <ul>\r\n      <li>koe</li>\r\n       <li>schaap</li>\r\n       <li>kip</li>\r\n    </ul>\r\n  </li>\r\n  <li>planten</li>\r\n</ul>\r\nwelke CSS code kleurt het woord "dieren" zwart en het woord "kip" rood?', 2, 3, 1),
(7, 9, 'Dezelfde webpagina bevat meerdere talen in hun eigen karakters, zoals Arabisch, Chinees en Engels. \r\nWelk van onderstaande predikaten, elementen en attributen maakt dit mogelijk?', 2, 2, 1),
(7, 10, 'De juiste manier om een javascript te koppelen aan een HTML pagina is:', 1, 0, 1),
(5, 11, 'Wat is het gastland voor de wereldbeker voetbal in 2014?', 1, 2, 1),
(11, 12, 'Testvraag 1130', 5, 2, 1),
(1, 13, 'Wat is de datum van de volgende verkiezingen?', 1, 2, 1),
(3, 14, 'kunst testvraag', 1, 0, 1),
(36, 15, 'Welk(e) voorwerp(en) gebruik je bij fierljeppen', 1, 0, 1),
(3, 16, 'Wie heeft de Rechtvaardige Rechters gestolen?', 4, 2, 1),
(7, 17, 'Vul hier uw vraag in', 1, 0, 1),
(7, 18, 'Vul hier uw vraag in', 1, 0, 1),
(7, 19, 'Vul hier uw vraag in', 1, 0, 1),
(35, 20, 'Indien je in een team tegen Thomas zou spelen, welk ledemaat bewerk je eerst?', 1, 2, 1);

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
