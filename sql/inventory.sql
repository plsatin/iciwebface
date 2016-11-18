-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tbComputerInventory`;
CREATE TABLE `tbComputerInventory` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `ComputerTargetId` varchar(256) NOT NULL,
  `ClassID` int(5) NOT NULL,
  `PropertyID` int(5) NOT NULL,
  `Value` varchar(256) NOT NULL,
  `InstanceId` bigint(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `ClassID` (`ClassID`),
  KEY `PropertyID` (`PropertyID`),
  CONSTRAINT `tbComputerInventory_ibfk_2` FOREIGN KEY (`PropertyID`) REFERENCES `tbInventoryProperty` (`PropertyID`),
  CONSTRAINT `tbComputerInventory_ibfk_3` FOREIGN KEY (`ClassID`) REFERENCES `tbInventoryClass` (`ClassID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbComputerTarget`;
CREATE TABLE `tbComputerTarget` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `ComputerTargetId` varchar(256) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `LastReportedInventoryTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbInventoryClass`;
CREATE TABLE `tbInventoryClass` (
  `ClassID` int(5) NOT NULL,
  `Name` varchar(256) NOT NULL,
  PRIMARY KEY (`ClassID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbInventoryProperty`;
CREATE TABLE `tbInventoryProperty` (
  `PropertyID` int(5) NOT NULL,
  `ClassID` int(5) NOT NULL,
  `Name` varchar(256) NOT NULL,
  `Type` varchar(10) NOT NULL,
  PRIMARY KEY (`PropertyID`),
  KEY `ClassID` (`ClassID`),
  CONSTRAINT `tbInventoryProperty_ibfk_1` FOREIGN KEY (`ClassID`) REFERENCES `tbInventoryClass` (`ClassID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2016-11-18 10:25:15
