CREATE DATABASE IF NOT EXISTS web;

USE web;

CREATE TABLE IF NOT EXISTS `flag` (
  `flag` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `flag` values ('FLAG');

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `profile` TEXT
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO users (username, password, profile) VALUES ('admin', 'admin_password', 'flag{Pr1v1l3g3_3sc4l4t10n_Byp4ss}');
INSERT INTO users (username, password, profile) VALUES ('alice', 'alice_pass', 'Nothing interesting here');
INSERT INTO users (username, password, profile) VALUES ('bob', 'bob_pass', 'Just a regular user');
INSERT INTO users (username, password, profile) VALUES ('charlie', 'charlie_pass', 'No secrets here');