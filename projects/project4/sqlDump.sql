-- Adminer 4.8.1 MySQL 8.0.31-0ubuntu0.22.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `Project4` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `Project4`;

DROP TABLE IF EXISTS `Administrators`;
CREATE TABLE `Administrators` (
                                  `AdminId` int NOT NULL AUTO_INCREMENT,
                                  `UserName` varchar(255) NOT NULL,
                                  `HashPassword` varchar(255) NOT NULL,
                                  PRIMARY KEY (`AdminId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `Administrators` (`AdminId`, `UserName`, `HashPassword`) VALUES
    (1,	'admin',	'$2y$10$Qmo52oPG/KgAMROJVc1wQ.HAu7G3d7DDu6mbAujIeJaM05.6pS8Y2');

DROP TABLE IF EXISTS `Attacks`;
CREATE TABLE `Attacks` (
                           `AttackId` int NOT NULL AUTO_INCREMENT,
                           `AttackName` varchar(255) NOT NULL,
                           `MainAttribute` varchar(255) NOT NULL,
                           PRIMARY KEY (`AttackId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `Class_Attacks`;
CREATE TABLE `Class_Attacks` (
                                 `ClassId` int NOT NULL,
                                 `AttackId` int NOT NULL,
                                 PRIMARY KEY (`ClassId`,`AttackId`),
                                 KEY `Class_Attacks_Attacks` (`AttackId`),
                                 CONSTRAINT `Class_Attacks_Attacks` FOREIGN KEY (`AttackId`) REFERENCES `Attacks` (`AttackId`),
                                 CONSTRAINT `Class_Attacks_Classes` FOREIGN KEY (`ClassId`) REFERENCES `Classes` (`ClassId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `Classes`;
CREATE TABLE `Classes` (
                           `ClassId` int NOT NULL AUTO_INCREMENT,
                           `Name` varchar(255) NOT NULL,
                           `Strength` int NOT NULL,
                           `Perception` int NOT NULL,
                           `Endurance` int NOT NULL,
                           `Charisma` int NOT NULL,
                           `Intelligence` int NOT NULL,
                           `Agility` int NOT NULL,
                           `Luck` int NOT NULL,
                           PRIMARY KEY (`ClassId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `Consumables`;
CREATE TABLE `Consumables` (
                               `ConsumableId` int NOT NULL,
                               `Description` varchar(255) NOT NULL,
                               `HealthRecovery` int NOT NULL,
                               `StaminaRecovery` int NOT NULL,
                               `ManaRecovery` int NOT NULL,
                               `StrengthBoost` int NOT NULL,
                               `PerceptionBoost` int NOT NULL,
                               `EnduranceBoost` int NOT NULL,
                               `CharismaBoost` int NOT NULL,
                               `IntelligenceBoost` int NOT NULL,
                               `AgilityBoost` int NOT NULL,
                               `LuckBoost` int NOT NULL,
                               `Duration` int NOT NULL,
                               PRIMARY KEY (`ConsumableId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `Enemies`;
CREATE TABLE `Enemies` (
                           `EnemyId` int NOT NULL AUTO_INCREMENT,
                           `EnemyName` varchar(255) NOT NULL,
                           `EnemyHealth` int NOT NULL,
                           `Experience` int NOT NULL,
                           `Strength` int NOT NULL,
                           `Perception` int NOT NULL,
                           `Endurance` int NOT NULL,
                           `Charisma` int NOT NULL,
                           `Intelligence` int NOT NULL,
                           `Agility` int NOT NULL,
                           `Luck` int NOT NULL,
                           PRIMARY KEY (`EnemyId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `Items`;
CREATE TABLE `Items` (
                         `ItemId` int NOT NULL AUTO_INCREMENT,
                         `Name` varchar(255) NOT NULL,
                         `Description` varchar(255) NOT NULL,
                         `Value` int NOT NULL,
                         `Defence` int NOT NULL,
                         `AttackStrength` int NOT NULL,
                         PRIMARY KEY (`ItemId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `Player_Class`;
CREATE TABLE `Player_Class` (
                                `PlayerId` int NOT NULL,
                                `ClassId` int NOT NULL,
                                `Strength` int NOT NULL,
                                `Perception` int NOT NULL,
                                `Endurance` int NOT NULL,
                                `Charisma` int NOT NULL,
                                `Intelligence` int NOT NULL,
                                `Agility` int NOT NULL,
                                `Luck` int NOT NULL,
                                PRIMARY KEY (`PlayerId`,`ClassId`),
                                KEY `Player_Class_Classes` (`ClassId`),
                                CONSTRAINT `Player_Class_Classes` FOREIGN KEY (`ClassId`) REFERENCES `Classes` (`ClassId`),
                                CONSTRAINT `Player_Class_Players` FOREIGN KEY (`PlayerId`) REFERENCES `Players` (`PlayerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `Player_Consumables`;
CREATE TABLE `Player_Consumables` (
                                      `ConsumableId` int NOT NULL,
                                      `PlayerId` int NOT NULL,
                                      `Quantity` int NOT NULL,
                                      PRIMARY KEY (`ConsumableId`,`PlayerId`),
                                      KEY `Player_Consumables_Players` (`PlayerId`),
                                      CONSTRAINT `Player_Consumables_Consumables` FOREIGN KEY (`ConsumableId`) REFERENCES `Consumables` (`ConsumableId`),
                                      CONSTRAINT `Player_Consumables_Players` FOREIGN KEY (`PlayerId`) REFERENCES `Players` (`PlayerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `Player_Items`;
CREATE TABLE `Player_Items` (
                                `PlayerId` int NOT NULL,
                                `ItemId` int NOT NULL,
                                `Quantity` int NOT NULL,
                                PRIMARY KEY (`PlayerId`,`ItemId`),
                                KEY `Player_Items_Items` (`ItemId`),
                                CONSTRAINT `Player_Items_Items` FOREIGN KEY (`ItemId`) REFERENCES `Items` (`ItemId`),
                                CONSTRAINT `Player_Items_Players` FOREIGN KEY (`PlayerId`) REFERENCES `Players` (`PlayerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `Players`;
CREATE TABLE `Players` (
                           `PlayerId` int NOT NULL AUTO_INCREMENT,
                           `Name` varchar(255) NOT NULL,
                           `Level` int NOT NULL,
                           `Experience` int NOT NULL,
                           `HashPassword` varchar(255) NOT NULL,
                           PRIMARY KEY (`PlayerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `Quests`;
CREATE TABLE `Quests` (
                          `QuestId` int NOT NULL AUTO_INCREMENT,
                          `QuestName` varchar(255) NOT NULL,
                          `QuestDescription` varchar(255) NOT NULL,
                          PRIMARY KEY (`QuestId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- 2022-12-06 15:59:24

