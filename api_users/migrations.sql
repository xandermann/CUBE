CREATE DATABASE IF NOT EXISTS users;
USE users;

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;

SET NAMES utf8mb4;

-- DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uuid` varchar(36) NOT NULL COMMENT 'uuid v4',
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(36) NOT NULL,
  `gender` varchar(8) NOT NULL COMMENT 'male / female',
  `email` varchar(32) NOT NULL,
  `authorized` tinyint(4) unsigned NOT NULL COMMENT '1/0',
  `role` varchar(8) NOT NULL COMMENT 'admin/player',
  `password` varchar(256) NOT NULL,
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `users` (`uuid`, `firstname`, `lastname`, `gender`, `email`, `authorized`, `role`, `password`) VALUES
('73bfbbbd-a783-4107-b585-b29661a6f6fe',	'Alexandre',	'H',	'male',	'alex@alex.alex',	0,	'player',	'$2a$10$W3Yr0GAHG0cudAZ2DOZaruJc5yS1gGEHP0r2YDWwAw1829Nad50Du'),
('a2b87c63-08cf-427b-b457-95e590c3ed0e',	'cc',	'cc',	'male',	'f@f.f',	1,	'player',	'$2a$10$m5Dx5n43xH1w0Gyr7rp0aebPD2iVcEb/B4X116fZzo1A.uYPhGhMa');


/*
SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` char(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authorized` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `gender`, `email`, `password`, `authorized`, `role`) VALUES
(1,	'John1',	'Doe1',	'',	'a@a.a',	'a',	'',	'');

INSERT INTO `users` (`id`, `firstname`, `lastname`, `gender`, `email`, `password`, `authorized`, `role`) VALUES
(1,	'John2',	'Doe2',	'',	'b@b.b',	'b',	'',	'');
*/