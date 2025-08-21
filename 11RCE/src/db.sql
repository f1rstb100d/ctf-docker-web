CREATE DATABASE IF NOT EXISTS web;

USE web;

CREATE TABLE IF NOT EXISTS `flag` (
  `flag` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `flag` values ('FLAG');

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `users` values ('admin','7788');