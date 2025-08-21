CREATE DATABASE IF NOT EXISTS web;

USE web;

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL,
  `data` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `news` values (1,'news1 content...'), (2,'news2 content...'), (3,'news3 content...');

CREATE TABLE IF NOT EXISTS `flag` (
  `flag` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `flag` values ('FLAG');

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `users` values ('admin','1q2w3e4r');