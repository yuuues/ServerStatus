-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.5.43-0+deb7u1-log - (Debian)
-- SO del servidor:              debian-linux-gnu
-- HeidiSQL Versión:             9.4.0.5174
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla t_ServerStatus.attempts
CREATE TABLE IF NOT EXISTS `attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(39) NOT NULL,
  `expiredate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla t_ServerStatus.attempts: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `attempts` ENABLE KEYS */;

-- Volcando estructura para tabla t_ServerStatus.config
CREATE TABLE IF NOT EXISTS `config` (
  `setting` varchar(100) NOT NULL,
  `value` varchar(100) DEFAULT NULL,
  UNIQUE KEY `setting` (`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla t_ServerStatus.config: ~38 rows (aproximadamente)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
REPLACE INTO `config` (`setting`, `value`) VALUES
	('attack_mitigation_time', '+30 minutes'),
	('attempts_before_ban', '10'),
	('attempts_before_verify', '5'),
	('bcrypt_cost', '10'),
	('cookie_domain', NULL),
	('cookie_forget', '+30 minutes'),
	('cookie_http', '0'),
	('cookie_name', 'KY_authID'),
	('cookie_path', '/'),
	('cookie_remember', '+1 month'),
	('cookie_secure', '0'),
	('emailmessage_suppress_activation', '0'),
	('emailmessage_suppress_reset', '0'),
	('mail_charset', 'UTF-8'),
	('password_min_score', '3'),
	('request_key_expiration', '+10 minutes'),
	('site_activation_page', 'activate'),
	('site_email', 'Kytoh@users.noreply.github.com'),
	('site_key', 'nlduijohqaspuiejknqwpu21h3iey2'),
	('site_name', 'KY-Status'),
	('site_password_reset_page', 'reset'),
	('site_timezone', 'Europe/Paris'),
	('site_url', 'https://github.com/Kytoh/ServerStatus'),
	('smtp', '0'),
	('smtp_auth', '1'),
	('smtp_host', 'smtp.example.com'),
	('smtp_password', 'password'),
	('smtp_port', '25'),
	('smtp_security', NULL),
	('smtp_username', 'email@example.com'),
	('table_attempts', 'attempts'),
	('table_requests', 'requests'),
	('table_sessions', 'sessions'),
	('table_users', 'users'),
	('verify_email_max_length', '100'),
	('verify_email_min_length', '5'),
	('verify_email_use_banlist', '1'),
	('verify_password_min_length', '3');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Volcando estructura para tabla t_ServerStatus.requests
CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `rkey` varchar(20) NOT NULL,
  `expire` datetime NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Volcando estructura para tabla t_ServerStatus.servers
CREATE TABLE IF NOT EXISTS `servers` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  `url` varchar(65) NOT NULL,
  `location` varchar(65) NOT NULL,
  `host` varchar(65) NOT NULL,
  `type` varchar(65) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando estructura para tabla t_ServerStatus.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `expiredate` datetime NOT NULL,
  `ip` varchar(39) NOT NULL,
  `agent` varchar(200) NOT NULL,
  `cookie_crc` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Volcando estructura para tabla t_ServerStatus.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla t_ServerStatus.users: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `email`, `password`, `isactive`, `dt`) VALUES
	(1, 'test', '$2y$10$qnKx.R/fd3CecJ0TWmEHderYqth5/EiqpPr2XRasQsTk3KrZB/nUS', 1, '2016-12-29 14:58:40');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
