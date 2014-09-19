-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 18 sep 2014 om 12:58
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
  `media` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`vraagid`,`antwoordid`),
  KEY `vraagid` (`vraagid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `antwoorden`
--

INSERT INTO `antwoorden` (`vraagid`, `antwoordid`, `antwoordtekst`, `media`) VALUES
(1, 0, 'Rundskop', NULL),
(1, 1, 'In Darkness', NULL),
(1, 2, 'A Separation', NULL),
(1, 3, 'Footnote', NULL),
(2, 0, 'Nick Nuyens', NULL),
(2, 1, 'Tom Boonen', NULL),
(2, 2, 'Philippe Gilbert', NULL),
(2, 3, 'Fabian Cancellara', NULL),
(3, 0, '356', NULL),
(3, 1, '485', NULL),
(3, 2, '510', NULL),
(3, 3, '541', NULL),
(4, 0, '5', NULL),
(4, 1, '8', NULL),
(4, 2, '11', NULL),
(4, 3, '15', NULL),
(5, 0, 'Het varken', NULL),
(5, 1, 'De draak', NULL),
(5, 2, 'De slang', NULL),
(5, 3, 'De rat', NULL),
(5, 99, 'Testantwoord', NULL),
(11, 0, 'BelgiÃ«', NULL),
(11, 1, 'China', NULL),
(11, 2, 'BraziliÃ«', NULL),
(11, 3, 'Rusland', NULL),
(12, 0, 'A', NULL),
(12, 1, '2', NULL),
(12, 2, 'Kleine friet met mayo', NULL),
(12, 3, 'Bram?', NULL),
(13, 0, '2 mei', NULL),
(13, 1, '17 juni', NULL),
(13, 2, '25 mei', NULL),
(13, 3, '5 november', NULL),
(14, 0, 'ja', NULL),
(14, 1, 'nee', NULL),
(14, 2, 'kweetnie', NULL),
(15, 0, 'Een stok', NULL),
(15, 1, 'Een bal', NULL),
(15, 2, 'Hoepels', NULL),
(15, 3, 'AK47', NULL),
(16, 0, 'Bram', NULL),
(16, 1, 'Hendrik', NULL),
(16, 2, 'Jan', NULL),
(16, 3, 'Bert2', NULL),
(17, 0, 'a', NULL),
(17, 1, 'a', NULL),
(17, 2, 'a', NULL),
(17, 3, 'a', NULL),
(18, 0, 'a', NULL),
(18, 1, 'a', NULL),
(18, 2, 'a', NULL),
(18, 3, 'a', NULL),
(19, 0, 'a', NULL),
(19, 1, 'a', NULL),
(19, 2, 'a', NULL),
(19, 3, 'a', NULL),
(20, 0, 'Linker arm', NULL),
(20, 1, 'Rechter arm', NULL),
(20, 2, 'Beide benen', NULL),
(20, 3, 'Alle ledematen', NULL),
(21, 0, '<p>Jamarie Pfaff</p>', NULL),
(21, 1, '<p>Eddy Wally</p>', NULL),
(21, 2, '<p>Arne Slabbinck</p>', NULL),
(22, 0, '<p>A</p>', NULL),
(22, 1, '<p>B</p>', NULL),
(23, 0, '<p>A</p>', NULL),
(23, 1, '<p>B</p>', NULL),
(24, 0, '<p>A</p>', NULL),
(24, 1, '<p>B</p>', NULL),
(25, 0, '<p>a</p>', NULL),
(25, 1, '<p>b</p>', NULL),
(26, 0, '<p>ze</p>', NULL),
(26, 1, '<p>r</p>', NULL),
(27, 0, '<p>zef</p>', NULL),
(27, 1, '<p>zef</p>', NULL),
(28, 0, '<p>er</p>', NULL),
(28, 1, '<p>er</p>', NULL),
(29, 0, '<p>er</p>', NULL),
(29, 1, '<p>er</p>', NULL),
(30, 0, '<p>er</p>', NULL),
(30, 1, '<p>er</p>', NULL),
(31, 0, '<p>er</p>', NULL),
(31, 1, '<p>er</p>', NULL),
(32, 0, '<p>er</p>', NULL),
(32, 1, '<p>er</p>', NULL),
(33, 0, '<p>test</p>', NULL),
(33, 1, '<p>test</p>', NULL),
(34, 0, '<p>test</p>', NULL),
(34, 1, '<p>test</p>', NULL),
(35, 0, '<p>test</p>', NULL),
(35, 1, '<p>test</p>', NULL),
(36, 0, '<p>test</p>', NULL),
(36, 1, '<p>test</p>', NULL),
(37, 0, '<p>ef</p>', NULL),
(37, 1, '<p>zef</p>', NULL),
(38, 0, '<p>e</p>', NULL),
(38, 1, '<p>a</p>', '55804_pasta.jpg'),
(39, 0, '<p>no image</p>', NULL),
(39, 1, '<p>image</p>', 'b9cc4_cheese.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Gegevens worden uitgevoerd voor tabel `categorie`
--

INSERT INTO `categorie` (`catid`, `catnaam`, `actief`) VALUES
(1, 'cultuur', 1),
(2, 'sport', 1),
(3, 'programma', 1),
(4, 'test', 1),
(5, 'Lege testcategorie', 1),
(7, '', 1);

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
  PRIMARY KEY (`rijksregisternr`),
  KEY `gebruikerscategorie` (`gebruikerstype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`rijksregisternr`, `email`, `voornaam`, `familienaam`, `wachtwoord`, `gebruikerstype`, `actief`) VALUES
('05927674012', '', 'Vansteenkiste', 'Jarni', '', 1, 1),
('12345678900', 'gebruiker@email.be', 'gebruiker', 'gebruikerfnaam', '$2a$10$oW9JzL3c63G2AvIMMBkn8eXU.oBRuTWqBESC6J/ozhf6jgyVkqeBy', 1, 1),
('12345678933', 'bert@email.be', 'Bert', 'Mortier', '$2a$10$J/iBOEeRch4C2S.ZQNaFdOY2Ei4B07fl29Ij0D0nx1d7om/99Posy', 3, 1),
('32165498722', 'hendrik@email.be', 'Hendrik', 'De Buck', '$2a$10$erfWDDsxR1Gxygb1da501.h3TCyaSN1vS1XHm9/.5Ya185Wd31uaC', 3, 1),
('32165498723', '', 'nummerEEN', 'testgebruiker', '', 1, 1),
('32165498755', 'thomas@email.be', 'Thomas', 'Deserranno', '$2a$10$F55ibf0044.ysSuHu0GNGeG1pXCRFPCjIJaUJ8VnY8UqI8dTRS5Ty', 3, 1),
('45645645645', '', 'Jemoeder', 'Tuur', '', 1, 0),
('45678901230', 'beheerder@email.be', 'beheerder', 'beheerderfnaam', '$2a$10$Yc/z/l7dz9RPY0L2Ou6ftOKlVwRvzFVn5qH7pz7XI5bcBpZnqIK8K', 2, 1),
('46737215184', '', 'retsr', 'testr', '', 1, 0),
('78451545454', '', 'nummerTWEE', 'testgebruiker', '', 1, 1),
('78945612312', '', 'Slabbinck', 'Arne', '', 1, 1),
('78945641523', '', 'Jan', 'Vandorpe', '', 1, 1),
('98765432100', 'bram@email.be', 'Bram', 'Peters', '$2a$10$jP3CzzLnjX/1azG1LD2Kkuuy/ZCm7K2sOCs9NSNkCtII9Rdlwt6A2', 3, 1),
('99999999999', '', 'Slabbinck', 'Arne', '', 1, 1);

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
(21, 0, 'arne.png'),
(22, 0, 'gmap.png'),
(22, 1, 'green80.png'),
(22, 2, 'grijs185x120.gif'),
(22, 3, 'groep.jpg'),
(22, 4, 'hanne.jpg'),
(22, 5, 'hannelore.jpg'),
(22, 6, 'html_code.jpg'),
(26, 0, 'hanne.jpg'),
(37, 0, 'env3.jpg'),
(37, 1, 'env4.jpg'),
(37, 2, 'flipboard.jpg'),
(38, 0, '66fb5_anchovies.jpg'),
(38, 1, '82003_cheese.jpg'),
(39, 0, '56af3_olives.jpg'),
(39, 1, '7d5d3_pasta.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Gegevens worden uitgevoerd voor tabel `sessie`
--

INSERT INTO `sessie` (`sessieid`, `datum`, `testid`, `sessieww`, `actief`) VALUES
(15, '2010-09-14', 29, 'sam', 1),
(16, '2014-09-11', 30, 'test', 1),
(17, '0000-00-00', 29, 'qsdf', 1),
(18, '2014-09-11', 31, 'test', 1),
(19, '0000-00-00', 29, 'qsdf', 1),
(20, '0000-00-00', 29, 'aaaa', 1),
(23, '0000-00-00', 32, 'qsdf', 1),
(24, '0000-00-00', 29, 'test', 1),
(25, '2014-09-18', 29, 'test', 1);

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
(15, '32165498723', 3, '75', 1, 1, 0),
(15, '78945641523', 0, '0', 0, 1, 0),
(16, '12345678900', 5, '56', 0, 1, 0),
(17, '12345678900', 0, '0', 0, NULL, 0),
(17, '32165498723', 0, '0', 0, NULL, 0),
(18, '12345678900', 0, '0', 0, NULL, 0),
(24, '12345678900', 2, '50', 0, 1, 0),
(25, '12345678900', 1, '25', 0, 1, 0);

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
(15, '32165498723', 1, 0),
(15, '32165498723', 3, 1),
(15, '32165498723', 4, 1),
(15, '32165498723', 5, 1),
(15, '78945641523', 1, 0),
(15, '78945641523', 3, 0),
(15, '78945641523', 4, 0),
(15, '78945641523', 5, 0),
(16, '12345678900', 22, 1),
(16, '12345678900', 23, 0),
(16, '12345678900', 24, 1),
(16, '12345678900', 26, 1),
(16, '12345678900', 27, 0),
(16, '12345678900', 33, 1),
(16, '12345678900', 34, 0),
(16, '12345678900', 35, 1),
(16, '12345678900', 36, 0),
(24, '12345678900', 1, 1),
(24, '12345678900', 3, 0),
(24, '12345678900', 4, 0),
(24, '12345678900', 5, 1),
(25, '12345678900', 1, 0),
(25, '12345678900', 3, 0),
(25, '12345678900', 4, 0),
(25, '12345678900', 5, 1);

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
(25, '12345678900', 29, 1, 0, 0),
(25, '12345678900', 29, 2, 1, 50);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Gegevens worden uitgevoerd voor tabel `subcategorie`
--

INSERT INTO `subcategorie` (`subcatid`, `catid`, `subcatnaam`, `actief`) VALUES
(1, 1, 'politiek', 1),
(2, 1, 'landen', 0),
(3, 1, 'kunst', 0),
(4, 2, 'wielrennen', 0),
(5, 2, 'voetbal', 0),
(6, 2, 'andere', 0),
(7, 3, 'htmlcss', 1),
(8, 3, 'javascript', 0),
(9, 3, 'php', 0),
(10, 3, 'sql', 0),
(11, 4, 'testsubcategorie', 1),
(12, 4, 'testsubcategorie2', 1),
(28, 1, 'beeldhouwen', 0),
(35, 2, 'hockey', 0),
(36, 2, 'fierljeppen', 0),
(37, 4, '1', 0),
(38, 4, '2', 0),
(39, 4, '3', 0),
(40, 4, 'testtestest4', 0),
(41, 4, 'testtestest5', 0),
(42, 1, '', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Gegevens worden uitgevoerd voor tabel `test`
--

INSERT INTO `test` (`testid`, `testnaam`, `maxduur`, `aantalvragen`, `maxscore`, `tebehalenscore`, `beheerder`, `actief`) VALUES
(29, 'Politiek', 50, 4, 4, 60, '45678901230', 1),
(30, 'test', 50, 9, 9, 60, '45678901230', 1),
(31, 'kl', 15, 2, 4, 60, '45678901230', 1),
(32, 'test test', 15, 3, 7, 60, '12345678933', 1),
(33, 'lll', 60, 2, 2, 60, '45678901230', 1),
(34, 'lll', 50, 2, 2, 60, '45678901230', 1);

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
(29, 1, 2, 2, 50),
(29, 2, 2, 2, 50),
(30, 11, 9, 9, 50),
(31, 11, 2, 4, 50),
(32, 11, 3, 7, 50),
(33, 1, 2, 2, 50),
(34, 1, 2, 2, 50);

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
(29, 1),
(29, 3),
(29, 4),
(29, 5),
(30, 22),
(30, 23),
(30, 24),
(30, 26),
(30, 27),
(30, 33),
(30, 34),
(30, 35),
(30, 36),
(31, 36),
(31, 39),
(32, 12),
(32, 22),
(32, 23),
(33, 1),
(33, 3),
(34, 1),
(34, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

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
(35, 20, 'Indien je in een team tegen Thomas zou spelen, welk ledemaat bewerk je eerst?', 1, 2, 1),
(3, 21, '<p>Wie is deze bekende persoon?</p>', 1, 2, 1),
(11, 22, '<p>&lt;p&gt;test test&lt;/p&gt;</p>\r\n<p>&lt;img src="#"&gt;</p>\r\n<p>wut wut</p>\r\n<p>wut</p>', 1, 0, 1),
(11, 23, '<ul>\r\n<li>Bullet list test</li>\r\n<li>line 2</li>\r\n</ul>\r\n<p style="text-align: justify;">justified text</p>\r\n<p style="text-align: right;">right align</p>\r\n<p style="text-align: center;">center</p>\r\n<p style="text-align: left;">left</p>\r\n<p style="text-align: left;"><strong>bold</strong>&nbsp;<em>italic</em></p>\r\n<ol>\r\n<li>1</li>\r\n<li>2</li>\r\n<li>3</li>\r\n<li>four</li>\r\n</ol>\r\n<pre>Pre test<br />&lt;div&gt;div test&lt;/div&gt;<br />&lt;div style="color:red"&gt;color test&lt;/div&gt;</pre>', 1, 0, 1),
(11, 24, '<p>&lt;p&gt;test&lt;/p&gt;</p>\r\n<p>&lt;div style="color:red"&gt;color test&lt;/div&gt;</p>\r\n<p>&lt;code&gt;</p>\r\n<p>if then else&lt;p&gt;do&lt;/p&gt;</p>\r\n<p>Â  Â  &lt;aside&gt;&lt;/aside&gt;</p>\r\n<p>&lt;/code&gt;</p>\r\n<p><strong>bold</strong></p>\r\n<p><em>italic</em></p>\r\n<ul>\r\n<li>bullet</li>\r\n<li>list</li>\r\n<li>test</li>\r\n</ul>\r\n<p>Â </p>', 1, 0, 1),
(1, 25, '<p>test</p>', 1, 0, 1),
(11, 26, '<p>A</p>', 1, 0, 1),
(11, 27, '<p>zefzef</p>', 1, 0, 1),
(1, 28, '<p>er</p>', 1, 0, 1),
(1, 29, '<p>er</p>', 1, 0, 1),
(1, 30, '<p>er</p>', 1, 0, 1),
(1, 31, '<p>er</p>', 1, 0, 1),
(1, 32, '<p>er</p>', 1, 0, 1),
(11, 33, '<p>test</p>', 1, 0, 1),
(11, 34, '<p>test</p>', 1, 0, 1),
(11, 35, '<p>test</p>', 1, 0, 1),
(11, 36, '<p>test</p>', 1, 0, 1),
(1, 37, '<p>zef</p>', 1, 0, 1),
(1, 38, '<p>test</p>', 1, 0, 1),
(11, 39, '<p>test image upload</p>', 3, 0, 1);

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
