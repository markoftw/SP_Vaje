-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Gostitelj: localhost
-- Čas nastanka: 06. avg 2015 ob 00.51
-- Različica strežnika: 5.5.44-0ubuntu0.14.04.1
-- Različica PHP: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Zbirka podatkov: `oglasi`
--

-- --------------------------------------------------------

--
-- Struktura tabele `kategorije`
--

CREATE TABLE IF NOT EXISTS `kategorije` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategorija` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_slovenian_ci NOT NULL,
  `podkategorija` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Odloži podatke za tabelo `kategorije`
--

INSERT INTO `kategorije` (`id`, `kategorija`, `podkategorija`) VALUES
(1, 'Računalništvo', 0),
(2, 'Avdio, video', 0),
(3, 'Televizije', 2),
(4, 'Sprejemniki', 2),
(5, 'Laptopi', 1),
(6, 'Bela tehnika', 0),
(7, 'Knjige', 0),
(8, 'Oblačila', 0),
(9, 'Komponente', 1),
(10, 'Diski', 9),
(11, 'Živali', 0),
(12, 'Igrače', 0),
(13, 'Hrana za živali', 11),
(14, 'Procesorji', 9),
(15, 'Grafične kartice', 9),
(16, 'SSD', 10),
(17, 'HDD', 10),
(18, 'AMD', 15),
(19, 'NVIDIA', 15);

-- --------------------------------------------------------

--
-- Struktura tabele `komentarji`
--

CREATE TABLE IF NOT EXISTS `komentarji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uporabnik_id` int(11) NOT NULL,
  `oglas_id` int(11) NOT NULL,
  `komentar` text NOT NULL,
  `ocena` decimal(10,2) NOT NULL,
  `st_ocen` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Odloži podatke za tabelo `komentarji`
--

INSERT INTO `komentarji` (`id`, `uporabnik_id`, `oglas_id`, `komentar`, `ocena`, `st_ocen`) VALUES
(1, 8, 13, 'ttt', 0.00, 0),
(2, 13, 13, 'sss', 0.00, 0),
(3, 13, 13, 'ssss', 0.00, 0),
(4, 13, 13, 'abc', 0.00, 0),
(5, 13, 13, '123', 0.00, 0),
(7, 8, 14, 'test2\n\n\naaa', 18.00, 4),
(8, 13, 14, 'urejen komentar', 3.00, 2),
(9, 13, 14, 'aaaaaaaa', 12.00, 3),
(18, 8, 11, 'sadsadsa', 6.00, 2),
(23, 13, 11, 'asdasfsdfsdaf', 7.00, 2);

-- --------------------------------------------------------

--
-- Struktura tabele `oglasi`
--

CREATE TABLE IF NOT EXISTS `oglasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uporabnik_id` int(11) NOT NULL,
  `kategorija_id` int(11) NOT NULL,
  `naslov` varchar(255) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `opis` text CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `ustvarjeno` datetime NOT NULL,
  `zapadlost` datetime NOT NULL,
  `ogledi` int(11) NOT NULL,
  `cena` decimal(6,2) NOT NULL,
  `zaloga` int(11) NOT NULL,
  `ocena` decimal(10,2) NOT NULL,
  `st_ocen` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Odloži podatke za tabelo `oglasi`
--

INSERT INTO `oglasi` (`id`, `uporabnik_id`, `kategorija_id`, `naslov`, `opis`, `ustvarjeno`, `zapadlost`, `ogledi`, `cena`, `zaloga`, `ocena`, `st_ocen`) VALUES
(4, 7, 2, 'Naslov oglasa', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2015-03-17 23:07:43', '2015-04-16 23:07:43', 1, 0.00, 0, 0.00, 0),
(7, 8, 2, 'Naslov oglasa - urejeno', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2015-03-18 20:37:56', '2015-04-17 20:37:56', 12, 0.00, 0, 0.00, 0),
(8, 9, 2, 'zapadel', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2015-03-19 07:02:46', '2015-03-18 07:02:46', 2, 0.00, 0, 0.00, 0),
(9, 9, 2, 'nekaj', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2015-03-19 07:02:46', '2015-04-18 14:01:27', 5, 0.00, 0, 0.00, 0),
(10, 13, 2, 'Naslov oglasa', 'grgfdgfd', '2015-03-19 19:39:45', '2015-03-18 19:39:45', 2, 0.00, 0, 0.00, 0),
(11, 13, 12, 'Naslov oglasa', 'knjiga', '2015-03-24 13:32:15', '2015-04-23 13:32:15', 221, 10.99, 1, 10.00, 2),
(13, 13, 18, 'Naslov oglasa', 'fdsdsfgetge', '2015-03-24 13:47:18', '2015-04-23 13:47:18', 73, 50.50, 2, 5.00, 1),
(14, 13, 18, 'Naslov oglasa', 'fwefwe', '2015-03-24 21:35:45', '2015-04-23 21:35:45', 192, 12.00, 3, 40.00, 12);

-- --------------------------------------------------------

--
-- Struktura tabele `uporabniki`
--

CREATE TABLE IF NOT EXISTS `uporabniki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uporabnisko_ime` varchar(25) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `geslo` varchar(50) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `mail` varchar(255) NOT NULL,
  `ime` varchar(50) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `priimek` varchar(50) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `naslov` varchar(255) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `posta` int(4) DEFAULT NULL,
  `telefon` int(9) DEFAULT NULL,
  `spol` int(1) DEFAULT NULL,
  `starost` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uporabnisko_ime` (`uporabnisko_ime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Odloži podatke za tabelo `uporabniki`
--

INSERT INTO `uporabniki` (`id`, `uporabnisko_ime`, `geslo`, `mail`, `ime`, `priimek`, `naslov`, `posta`, `telefon`, `spol`, `starost`) VALUES
(7, 'testacc', '373b31162f38de84ef2318d633cbb43825740385', 'test@test.com', 'test', 'test2', NULL, NULL, NULL, NULL, NULL),
(13, 'Marko', '7288edd0fc3ffcbe93a0cf06e3568e28521687bc', 'asd@asd.com', 'Marko', 'Smej', '', 0, 0, NULL, 0),

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
