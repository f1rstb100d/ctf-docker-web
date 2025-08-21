CREATE DATABASE IF NOT EXISTS web;

USE web;

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(255) PRIMARY KEY,
  `password` varchar(255) NOT NULL,
  `balance` DECIMAL(10,2) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `users`(username, password, balance) values ('user','password', 500.00), ('admin','1Q2W3E4R', 15000.00);
