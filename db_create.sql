-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 14, 2014 at 07:46 PM
-- Server version: 5.1.71
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Table structure for table `common_month`
--

DROP TABLE IF EXISTS `common_month`;
CREATE TABLE IF NOT EXISTS `common_month` (
  `month` datetime NOT NULL,
  PRIMARY KEY (`month`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `common_language`
--

DROP TABLE IF EXISTS `common_language`;
CREATE TABLE IF NOT EXISTS `common_language` (
  `iso` char(2) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`iso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `common_language`
--

INSERT INTO `common_language` (`iso`, `language`) VALUES
('en', 'English'),
('fr', 'French'),
('de', 'German'),
('nl', 'Dutch'),
('es', 'Spanish'),
('it', 'Italian'),
('pt', 'Portuguese'),
('pl', 'Polish'),
('ru', 'Russian'),
('da', 'Danish'),
('hu', 'Hungarian'),
('sv', 'Swedish'),
('nb', 'Norwegian Bokmål'),
('fi', 'Finnish'),
('zh', 'Chinese'),
('el', 'Greek'),
('he', 'Hebrew'),
('ja', 'Japanese'),
('lt', 'Lithuanian'),
('ca', 'Catalan');

--
-- Table structure for table `common_contactrange`
--

DROP TABLE IF EXISTS `common_contactrange`;
CREATE TABLE IF NOT EXISTS `common_contactrange` (
  `range` varchar(20) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `low` int(8) NOT NULL,
  `high` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `common_contactrange`
--

INSERT INTO `common_contactrange` (`range`, `low`, `high`) VALUES
('less than 250', 0, 250),
('250 to 1,000', 250, 1000),
('1,000 to 2,500', 1000, 2500),
('2,500 to 10,000', 2500, 10000),
('10,000 to 25,000', 10000, 25000),
('25,000 to 100,000', 25000, 100000),
('100,000 to 250,000', 100000, 250000),
('250,000 and up', 250000, 90000000);

--
-- Table structure for table `github_commit`
--

DROP TABLE IF EXISTS `github_commit`;
CREATE TABLE IF NOT EXISTS `github_commit` (
  `repository` varchar(100) CHARACTER SET ascii NOT NULL,
  `hash` char(40) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `author_login` varchar(100) CHARACTER SET ascii NOT NULL,
  `author_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `committer_login` varchar(100) CHARACTER SET ascii NOT NULL,
  `committer_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `hash` (`hash`),
  KEY `repository` (`repository`),
  KEY `author_login` (`author_login`),
  KEY `author_date` (`author_date`),
  KEY `committer_login` (`committer_login`),
  KEY `committer_date` (`committer_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `github_user`
--

DROP TABLE IF EXISTS `github_user`;
CREATE TABLE IF NOT EXISTS `github_user` (
  `id` int(11) NOT NULL,
  `login` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `avatar_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jira_issue`
--

DROP TABLE IF EXISTS `jira_issue`;
CREATE TABLE IF NOT EXISTS `jira_issue` (
  `jira_id` int(11) NOT NULL COMMENT 'Needed only for proper display in PHPMyAdmin',
  `project` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `issue` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `priority` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reporter` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `assignee` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `resolution` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `resolved` datetime DEFAULT NULL,
  PRIMARY KEY (`jira_id`),
  UNIQUE KEY `issue` (`issue`),
  KEY `created` (`created`),
  KEY `resolved` (`resolved`),
  KEY `reporter` (`reporter`),
  KEY `assignee` (`assignee`),
  KEY `status` (`status`),
  KEY `resolution` (`resolution`),
  KEY `type` (`type`),
  KEY `priority` (`priority`),
  KEY `project` (`project`),
  KEY `updated` (`updated`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jira_version`
--

DROP TABLE IF EXISTS `jira_version`;
CREATE TABLE IF NOT EXISTS `jira_version` (
  `issue` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('Affects','Fix') COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  KEY `issue` (`issue`),
  KEY `version` (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pingback_extension`
--

DROP TABLE IF EXISTS `pingback_extension`;
CREATE TABLE IF NOT EXISTS `pingback_extension` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_sites` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pingback_site`
--

DROP TABLE IF EXISTS `pingback_site`;
CREATE TABLE IF NOT EXISTS `pingback_site` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(32) COLLATE ascii_bin DEFAULT NULL,
  `version` text COLLATE ascii_bin,
  `lang` text COLLATE ascii_bin,
  `uf` text COLLATE ascii_bin,
  `ufv` text COLLATE ascii_bin,
  `civi_country` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `geoip_country` VARCHAR(50) COLLATE ascii_bin DEFAULT NULL,
  `DB` char(2) COLLATE ascii_bin DEFAULT NULL,
  `MySQL` text COLLATE ascii_bin,
  `PHP` text COLLATE ascii_bin,
  `first_ping_id` bigint(20) unsigned NOT NULL,
  `first_timestamp` timestamp NULL DEFAULT NULL,
  `last_ping_id` bigint(20) unsigned NOT NULL,
  `last_timestamp` timestamp NULL DEFAULT NULL,
  `num_pings` int(11) unsigned DEFAULT '1',
  `is_active` int(1) unsigned DEFAULT NULL,
  `Contact` int(11) unsigned DEFAULT NULL,
  `Contribution` int(11) unsigned DEFAULT NULL,
  `Participant` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`),
  KEY `first_timestamp` (`first_timestamp`),
  KEY `last_ping_id` (`last_ping_id`),
  KEY `last_timestamp` (`last_timestamp`),
  KEY `is_active` (`is_active`),
  KEY `DB` (`DB`)
) ENGINE=MyISAM  DEFAULT CHARSET=ascii COLLATE=ascii_bin AUTO_INCREMENT=120191 ;

-- --------------------------------------------------------

--
-- Table structure for table `pingback_cohort`
--

CREATE TABLE IF NOT EXISTS `pingback_cohort` (
  `cohort` char(7) COLLATE ascii_bin NOT NULL,
  `month` char(7) COLLATE ascii_bin NOT NULL,
  `num_sites` int(11) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `sourceforge_download`
--

DROP TABLE IF EXISTS `sourceforge_download`;
CREATE TABLE IF NOT EXISTS `sourceforge_download` (
  `type` char(1) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `label` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
