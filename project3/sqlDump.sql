-- Adminer 4.8.1 MySQL 8.0.32-0ubuntu0.22.04.2 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `Task`;
CREATE TABLE `Task` (
                        `id` int NOT NULL AUTO_INCREMENT,
                        `description` varchar(500) NOT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `Task` (`id`, `description`) VALUES
                                             (92,	'A new description'),
                                             (106,	'A new description'),
                                             (107,	'A new description'),
                                             (108,	'\'DROP TABLE Task;--'),
                                             (109,	'\'DROP TABLE Task;--');

-- 2023-03-30 21:33:26
