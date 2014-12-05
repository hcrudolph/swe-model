-- phpMyAdmin SQL Dump
-- version 4.0.10.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 26. Nov 2014 um 22:04
-- Server Version: 5.1.73
-- PHP-Version: 5.3.3
 
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+01:00";
 
 
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
 
--
-- Datenbank: `fitness`
--
 
-- --------------------------------------------------------
 
--
-- Tabellenstruktur für Tabelle `accounts`
--
 
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` smallint unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Tabellenstruktur für Tabelle `accounts_certificates`
--
 
CREATE TABLE IF NOT EXISTS `accounts_certificates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,	
  `certificate_id` int unsigned NOT NULL,
  `account_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `certificate_id` (`certificate_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Tabellenstruktur für Tabelle `accounts_trainings`
--
 
CREATE TABLE IF NOT EXISTS `accounts_trainings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int unsigned NOT NULL,
  `downloadlink` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Tabellenstruktur für Tabelle `bills`
--
 
CREATE TABLE IF NOT EXISTS `bills` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int unsigned NOT NULL,
  `year` year(4) NOT NULL,
  `month` smallint unsigned NOT NULL,
  `tariff_id` int unsigned NOT NULL,
  `payed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  KEY `tariff_id` (`tariff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Tabellenstruktur für Tabelle `certificates`
--
 
CREATE TABLE IF NOT EXISTS `certificates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Tabellenstruktur für Tabelle `courses`
--
 
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `category` smallint unsigned DEFAULT NULL,
  `maxcount` int unsigned NOT NULL,
  `mincount` int unsigned NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Tabellenstruktur für Tabelle `accounts_courses`
--
 
CREATE TABLE IF NOT EXISTS `accounts_courses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `course_room_time_id` int unsigned NOT NULL,
  `account_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_room_time_id` (`course_room_time_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Tabellenstruktur für Tabelle `courses_rooms_times`
--
 
CREATE TABLE IF NOT EXISTS `courses_rooms_times` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int unsigned NOT NULL,
  `room_id` int unsigned NOT NULL,
  `director` int unsigned NOT NULL,
  `begin` datetime NOT NULL,
  `end` datetime NOT NULL,
  `presetup` datetime NOT NULL,
  `postsetup` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  KEY `room_id` (`room_id`),
  KEY `director` (`director`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Tabellenstruktur für Tabelle `people`
--
 
CREATE TABLE IF NOT EXISTS `people` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int unsigned NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `plz` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `housenumber` smallint unsigned NOT NULL,
  `hnextra` varchar(5)  NOT NULL,
  `birthdate` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Tabellenstruktur für Tabelle `posts`
--
 
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int unsigned NOT NULL,
  `heading` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `visiblebegin` date NOT NULL,
  `visibleend` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Tabellenstruktur für Tabelle `rooms`
--
 
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Tabellenstruktur für Tabelle `tariffs`
--
 
CREATE TABLE IF NOT EXISTS `tariffs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `term` smallint unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
 
--
-- Constraints der exportierten Tabellen
--
 
--
-- Constraints der Tabelle `accounts_certificates`
--
ALTER TABLE `accounts_certificates`
  ADD CONSTRAINT `accounts_certificates_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `accounts_certificates_ibfk_1` FOREIGN KEY (`certificate_id`) REFERENCES `certificates` (`id`);
 
--
-- Constraints der Tabelle `accounts_trainings`
--
ALTER TABLE `accounts_trainings`
  ADD CONSTRAINT `accounts_trainings_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);
 
--
-- Constraints der Tabelle `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`tariff_id`) REFERENCES `tariffs` (`id`),
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);
 
--
-- Constraints der Tabelle `accounts_courses`
--
ALTER TABLE `accounts_courses`
  ADD CONSTRAINT `accounts_courses_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accounts_courses_ibfk_1` FOREIGN KEY (`course_room_time_id`) REFERENCES `courses_rooms_times` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
 
--
-- Constraints der Tabelle `courses_rooms_times`
--
ALTER TABLE `courses_rooms_times`
  ADD CONSTRAINT `courses_rooms_times_ibfk_3` FOREIGN KEY (`director`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_rooms_times_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_rooms_times_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
 
--
-- Constraints der Tabelle `people`
--
ALTER TABLE `people`
  ADD CONSTRAINT `people_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
 
--
-- Constraints der Tabelle `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);
 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
