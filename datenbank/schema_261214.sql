SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `accounts` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` smallint(5) unsigned NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `accounts_certificates` (
`id` int(10) unsigned NOT NULL,
  `certificate_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `accounts_dates` (
`id` int(10) unsigned NOT NULL,
  `date_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `accounts_trainings` (
`id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `downloadlink` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `bills` (
`id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `year` year(4) NOT NULL,
  `month` smallint(5) unsigned NOT NULL,
  `tariff_id` int(10) unsigned NOT NULL,
  `payed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `certificates` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `courses` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `category` smallint(5) unsigned DEFAULT NULL,
  `maxcount` int(10) unsigned DEFAULT NULL,
  `mincount` int(10) unsigned DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `dates` (
`id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `room_id` int(10) unsigned NOT NULL,
  `director` int(10) unsigned NOT NULL,
  `begin` datetime NOT NULL,
  `end` datetime NOT NULL,
  `mincount` int(10) unsigned DEFAULT NULL,
  `maxcount` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `people` (
`id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plz` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `housenumber` smallint(5) unsigned NOT NULL,
  `hnextra` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `heading` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `visiblebegin` date DEFAULT NULL,
  `visibleend` date DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `rooms` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `tariffs` (
`id` int(10) unsigned NOT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `term` smallint(5) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;


ALTER TABLE `accounts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `accounts_certificates`
 ADD PRIMARY KEY (`id`), ADD KEY `certificate_id` (`certificate_id`), ADD KEY `account_id` (`account_id`);

ALTER TABLE `accounts_dates`
 ADD PRIMARY KEY (`id`), ADD KEY `date_id` (`date_id`), ADD KEY `account_id` (`account_id`);

ALTER TABLE `accounts_trainings`
 ADD PRIMARY KEY (`id`), ADD KEY `account_id` (`account_id`);

ALTER TABLE `bills`
 ADD PRIMARY KEY (`id`), ADD KEY `account_id` (`account_id`), ADD KEY `tariff_id` (`tariff_id`);

ALTER TABLE `certificates`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

ALTER TABLE `courses`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

ALTER TABLE `dates`
 ADD PRIMARY KEY (`id`), ADD KEY `course_id` (`course_id`), ADD KEY `room_id` (`room_id`), ADD KEY `director` (`director`);

ALTER TABLE `people`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `account_id` (`account_id`);

ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`), ADD KEY `account_id` (`account_id`);

ALTER TABLE `rooms`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

ALTER TABLE `tariffs`
 ADD PRIMARY KEY (`id`);


ALTER TABLE `accounts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `accounts_certificates`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `accounts_dates`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `accounts_trainings`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `bills`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `certificates`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `courses`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `dates`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `people`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `posts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `rooms`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `tariffs`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

ALTER TABLE `accounts_certificates`
ADD CONSTRAINT `accounts_certificates_ibfk_1` FOREIGN KEY (`certificate_id`) REFERENCES `certificates` (`id`),
ADD CONSTRAINT `accounts_certificates_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);

ALTER TABLE `accounts_dates`
ADD CONSTRAINT `accounts_dates_ibfk_1` FOREIGN KEY (`date_id`) REFERENCES `dates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `accounts_dates_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `accounts_trainings`
ADD CONSTRAINT `accounts_trainings_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);

ALTER TABLE `bills`
ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`tariff_id`) REFERENCES `tariffs` (`id`);

ALTER TABLE `dates`
ADD CONSTRAINT `dates_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `dates_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `dates_ibfk_3` FOREIGN KEY (`director`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `people`
ADD CONSTRAINT `people_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `posts`
ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
