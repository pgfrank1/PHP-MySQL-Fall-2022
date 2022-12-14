-- Adminer 4.8.1 MySQL 8.0.31-0ubuntu0.22.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `Administrators`;
CREATE TABLE `Administrators` (
                                  `AdminId` int NOT NULL AUTO_INCREMENT,
                                  `UserName` varchar(255) NOT NULL,
                                  `HashPassword` varchar(255) NOT NULL,
                                  PRIMARY KEY (`AdminId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `Administrators` (`AdminId`, `UserName`, `HashPassword`) VALUES
                                                                         (1,	'admin',	'$2y$10$Qmo52oPG/KgAMROJVc1wQ.HAu7G3d7DDu6mbAujIeJaM05.6pS8Y2'),
                                                                         (3,	'TEST',	'$2y$10$P41Kce52nhEB2Q6j9sB6te2m16STiG5GxkojuyUdqmbGxvBcOou..'),
                                                                         (4,	'teee',	'$2y$10$OwaJ.CFc0kLYHv99M9YO1.sRwSQOkEI5Z3hZ4RYupTv4N1sZKUj6q');

DROP TABLE IF EXISTS `Attacks`;
CREATE TABLE `Attacks` (
                           `AttackId` int NOT NULL AUTO_INCREMENT,
                           `AttackName` varchar(255) NOT NULL,
                           `MainAttribute` varchar(255) NOT NULL,
                           PRIMARY KEY (`AttackId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `Attacks` (`AttackId`, `AttackName`, `MainAttribute`) VALUES
                                                                      (1,	'testtt',	'Charisma'),
                                                                      (2,	'eeeeeee',	'Intelligence'),
                                                                      (3,	'asdasdas',	'Charisma'),
                                                                      (9,	'43455',	'Endurance'),
                                                                      (10,	'fsdf',	'Endurance'),
                                                                      (11,	'pppp',	'Perception'),
                                                                      (12,	'234234',	'Intelligence'),
                                                                      (13,	'vvffv',	'Strength'),
                                                                      (14,	'xcvcv',	'Intelligence'),
                                                                      (15,	'fdfdfdfdf',	'Endurance');

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

INSERT INTO `Classes` (`ClassId`, `Name`, `Strength`, `Perception`, `Endurance`, `Charisma`, `Intelligence`, `Agility`, `Luck`) VALUES
                                                                                                                                    (6,	'Knight',	12,	10,	12,	8,	8,	8,	10),
                                                                                                                                    (7,	'Assassin',	8,	12,	8,	10,	10,	12,	10),
                                                                                                                                    (8,	'Mage',	8,	10,	8,	12,	12,	10,	10),
                                                                                                                                    (9,	'Archer',	10,	12,	10,	8,	8,	12,	10);

DROP TABLE IF EXISTS `Consumables`;
CREATE TABLE `Consumables` (
                               `ConsumableId` int NOT NULL AUTO_INCREMENT,
                               `Name` varchar(255) NOT NULL,
                               `Description` varchar(255) NOT NULL,
                               `Value` int NOT NULL,
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

INSERT INTO `Consumables` (`ConsumableId`, `Name`, `Description`, `Value`, `HealthRecovery`, `StaminaRecovery`, `ManaRecovery`, `StrengthBoost`, `PerceptionBoost`, `EnduranceBoost`, `CharismaBoost`, `IntelligenceBoost`, `AgilityBoost`, `LuckBoost`, `Duration`) VALUES
                                                                                                                                                                                                                                                                         (2,	'Health Potion',	'Regain health by drinking this potion',	30,	50,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
                                                                                                                                                                                                                                                                         (3,	'Stamina Potion',	'Restores your stamina',	20,	0,	50,	0,	0,	0,	0,	0,	0,	0,	0,	0),
                                                                                                                                                                                                                                                                         (4,	'Mana Potion',	'Restores your mana',	30,	0,	0,	50,	0,	0,	0,	0,	0,	0,	0,	0);

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

INSERT INTO `Enemies` (`EnemyId`, `EnemyName`, `EnemyHealth`, `Experience`, `Strength`, `Perception`, `Endurance`, `Charisma`, `Intelligence`, `Agility`, `Luck`) VALUES
    (1,	'test',	1,	1,	1,	1,	1,	1,	1,	1,	1);

DROP TABLE IF EXISTS `Items`;
CREATE TABLE `Items` (
                         `ItemId` int NOT NULL AUTO_INCREMENT,
                         `Name` varchar(255) NOT NULL,
                         `Description` varchar(255) NOT NULL,
                         `Equip_Slot` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                         `Value` int NOT NULL,
                         `Defence` int NOT NULL,
                         `AttackStrength` int NOT NULL,
                         PRIMARY KEY (`ItemId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `Items` (`ItemId`, `Name`, `Description`, `Equip_Slot`, `Value`, `Defence`, `AttackStrength`) VALUES
                                                                                                              (3,	'Leather Helmet',	'A simple helment made of leather',	'Head',	15,	5,	0),
                                                                                                              (4,	'Steel Helmet',	'Helmet made of steel',	'Head',	50,	10,	0);

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


-- 2022-12-09 14:28:25
