-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3307
-- Létrehozás ideje: 2021. Okt 04. 15:43
-- Kiszolgáló verziója: 10.4.13-MariaDB
-- PHP verzió: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `webmotion`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL,
  `name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '',
  `tax_number` varchar(13) COLLATE utf8_hungarian_ci NOT NULL,
  `country` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `post_code` varchar(10) COLLATE utf8_hungarian_ci NOT NULL,
  `city` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `street` varchar(128) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL,
  `name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `tax_number` varchar(13) COLLATE utf8_hungarian_ci NOT NULL,
  `country` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `post_code` varchar(10) COLLATE utf8_hungarian_ci NOT NULL,
  `city` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `street` varchar(128) COLLATE utf8_hungarian_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `net` double NOT NULL DEFAULT 0,
  `vat` double NOT NULL DEFAULT 0,
  `gross` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
