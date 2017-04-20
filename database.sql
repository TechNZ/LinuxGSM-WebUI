-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.17-0ubuntu0.16.04.2 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for database_name
DROP DATABASE IF EXISTS `database_name`;
CREATE DATABASE IF NOT EXISTS `database_name` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `database_name`;

-- Dumping structure for table database_name.ftpgroup
DROP TABLE IF EXISTS `ftpgroup`;
CREATE TABLE IF NOT EXISTS `ftpgroup` (
  `groupname` varchar(16) NOT NULL,
  `gid` smallint(6) NOT NULL DEFAULT '5500',
  `members` varchar(16) NOT NULL,
  KEY `groupname` (`groupname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ProFTP group table';

-- Dumping data for table database_name.ftpgroup: 1 rows
/*!40000 ALTER TABLE `ftpgroup` DISABLE KEYS */;
INSERT INTO `ftpgroup` (`groupname`, `gid`, `members`) VALUES
	('admin', 999, 'techie');
/*!40000 ALTER TABLE `ftpgroup` ENABLE KEYS */;

-- Dumping structure for table database_name.ftpuser
DROP TABLE IF EXISTS `ftpuser`;
CREATE TABLE IF NOT EXISTS `ftpuser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(32) NOT NULL DEFAULT '',
  `passwd` varchar(32) NOT NULL DEFAULT '',
  `uid` smallint(6) NOT NULL DEFAULT '999',
  `gid` smallint(6) NOT NULL DEFAULT '999',
  `homedir` varchar(255) NOT NULL DEFAULT '/home/ftpd/%u',
  `shell` varchar(16) NOT NULL DEFAULT '/sbin/nologin',
  `count` int(11) NOT NULL DEFAULT '0',
  `accessed` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='ProFTP user table';

-- Dumping data for table database_name.ftpuser: 3 rows
/*!40000 ALTER TABLE `ftpuser` DISABLE KEYS */;
INSERT INTO `ftpuser` (`id`, `userid`, `passwd`, `uid`, `gid`, `homedir`, `shell`, `count`, `accessed`, `modified`) VALUES
	(1, 'techie', '{md5}X03MO1qnZdYdgyfeuILPmQ==', 999, 999, '/home/ftpd/%u', '/sbin/nologin', 50, '2017-04-10 20:39:31', '2017-04-04 19:03:24'),
/*!40000 ALTER TABLE `ftpuser` ENABLE KEYS */;

-- Dumping structure for table database_name.servers
DROP TABLE IF EXISTS `servers`;
CREATE TABLE IF NOT EXISTS `servers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servername` varchar(255) NOT NULL,
  `serverfolder` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table database_name.servers: ~6 rows (approximately)
/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
INSERT INTO `servers` (`id`, `servername`, `serverfolder`) VALUES
	(1, 'Team Fortress Instaspawn', 'TF_IS'),
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;

-- Dumping structure for table database_name.servers_default
DROP TABLE IF EXISTS `servers_default`;
CREATE TABLE IF NOT EXISTS `servers_default` (
  `id` int(11) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table database_name.servers_default: ~5 rows (approximately)
/*!40000 ALTER TABLE `servers_default` DISABLE KEYS */;
INSERT INTO `servers_default` (`id`, `active`) VALUES
	(1, b'0'),
/*!40000 ALTER TABLE `servers_default` ENABLE KEYS */;

-- Dumping structure for table database_name.servers_techie
DROP TABLE IF EXISTS `servers_techie`;
CREATE TABLE IF NOT EXISTS `servers_techie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table database_name.servers_techie: ~5 rows (approximately)
/*!40000 ALTER TABLE `servers_techie` DISABLE KEYS */;
INSERT INTO `servers_admin` (`id`, `active`) VALUES
	(1, b'1'),
/*!40000 ALTER TABLE `servers_techie` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
