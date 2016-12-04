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

INSERT INTO `tbInventoryClass` (`ClassID`, `Name`) VALUES
(1,	'Win32_BIOS'),
(2,	'Win32_ComputerSystem'),
(3,	'Win32_DesktopMonitor'),
(4,	'Win32_DiskDrive'),
(5,	'Win32_LogicalDisk'),
(6,	'Win32_NetworkAdapter'),
(7,	'Win32_NetworkAdapterConfiguration'),
(8,	'Win32_OperatingSystem'),
(10,	'Win32_Printer'),
(11,	'Win32_Processor'),
(12,	'Win32_SoundDevice'),
(13,	'Win32_VideoController'),
(15,	'Win32_PhysicalMemory'),
(16,	'Win32_BaseBoard');

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

INSERT INTO `tbInventoryProperty` (`PropertyID`, `ClassID`, `Name`, `Type`) VALUES
(1,	11,	'DeviceID',	'String'),
(2,	11,	'Architecture',	'UInt16'),
(3,	11,	'MaxClockSpeed',	'UInt32'),
(4,	11,	'Name',	'String'),
(5,	1,	'Name',	'String'),
(6,	1,	'Version',	'String'),
(7,	1,	'Manufacturer',	'String'),
(8,	1,	'ReleaseDate',	'DateTime'),
(13,	8,	'Name',	'String'),
(14,	8,	'BuildNumber',	'String'),
(15,	8,	'Caption',	'String'),
(16,	8,	'OSProductSuite',	'UInt32'),
(17,	8,	'OSLanguage',	'UInt32'),
(18,	8,	'OtherTypeDescription',	'String'),
(19,	8,	'ProductType',	'UInt32'),
(20,	8,	'SerialNumber',	'String'),
(21,	8,	'ServicePackMajorVersion',	'UInt16'),
(22,	8,	'ServicePackMinorVersion',	'UInt16'),
(23,	8,	'Version',	'String'),
(24,	4,	'DeviceID',	'String'),
(25,	4,	'Name',	'String'),
(26,	4,	'Caption',	'String'),
(27,	4,	'Manufacturer',	'String'),
(28,	4,	'Model',	'String'),
(29,	4,	'InterfaceType',	'String'),
(30,	4,	'Partitions',	'UInt32'),
(31,	4,	'size',	'UInt64'),
(32,	5,	'DeviceID',	'String'),
(33,	5,	'Name',	'String'),
(34,	5,	'DriveType',	'UInt32'),
(35,	5,	'VolumeName',	'String'),
(36,	5,	'FileSystem',	'String'),
(37,	5,	'Size',	'UInt64'),
(38,	5,	'FreeSpace',	'UInt64'),
(39,	7,	'Index',	'UInt32'),
(40,	7,	'Caption',	'String'),
(41,	7,	'Description',	'String'),
(42,	7,	'DHCPEnabled',	'Boolean'),
(43,	7,	'DHCPLeaseExpires',	'DateTime'),
(44,	7,	'DHCPLeaseObtained',	'DateTime'),
(45,	7,	'DHCPServer',	'String'),
(46,	7,	'DNSDomain',	'String'),
(47,	7,	'DNSEnabledForWINSResolution',	'Boolean'),
(48,	7,	'DNSHostName',	'String'),
(49,	7,	'DomainDNSRegistrationEnabled',	'Boolean'),
(50,	7,	'IPAddress',	'String'),
(51,	7,	'IPFilterSecurityEnabled',	'Boolean'),
(52,	7,	'IPPortSecurityEnabled',	'Boolean'),
(53,	7,	'WINSEnableLMHostsLookup',	'Boolean'),
(54,	7,	'WINSHostLookupFile',	'String'),
(55,	7,	'WINSPrimaryServer',	'String'),
(56,	7,	'WINSScopeID',	'String'),
(57,	7,	'WINSSecondaryServer',	'String'),
(58,	6,	'DeviceID',	'String'),
(59,	6,	'Index',	'UInt32'),
(60,	6,	'Name',	'String'),
(61,	6,	'Caption',	'String'),
(62,	6,	'Description',	'String'),
(63,	6,	'Manufacturer',	'String'),
(64,	6,	'ProductName',	'String'),
(65,	6,	'MACAddress',	'String'),
(66,	6,	'Speed',	'UInt64'),
(67,	6,	'MaxSpeed',	'UInt64'),
(68,	6,	'NetConnectionStatus',	'UInt16'),
(69,	6,	'NetConnectionID',	'String'),
(70,	12,	'DeviceID',	'String'),
(71,	12,	'Name',	'String'),
(72,	12,	'Manufacturer',	'String'),
(73,	13,	'DeviceID',	'String'),
(74,	13,	'Description',	'String'),
(75,	13,	'AdapterRAM',	'UInt32'),
(76,	13,	'DriverDate',	'DateTime'),
(77,	13,	'VideoModeDescription',	'String'),
(78,	3,	'DeviceID',	'String'),
(79,	3,	'Name',	'String'),
(80,	3,	'MonitorManufacturer',	'String'),
(81,	3,	'PixelsPerXLogicalInch',	'UInt32'),
(82,	3,	'PixelsPerYLogicalInch',	'UInt32'),
(83,	3,	'ScreenHeight',	'UInt32'),
(84,	3,	'ScreenWidth',	'UInt32'),
(85,	2,	'Name',	'String'),
(86,	2,	'Manufacturer',	'String'),
(87,	2,	'Model',	'String'),
(88,	2,	'TotalPhysicalMemory',	'UInt64'),
(89,	10,	'DeviceID',	'String'),
(90,	10,	'Name',	'String'),
(91,	10,	'Local',	'Boolean'),
(92,	10,	'Network',	'Boolean'),
(93,	10,	'Location',	'String'),
(94,	10,	'Comment',	'String'),
(95,	10,	'DriverName',	'String'),
(96,	10,	'Shared',	'Boolean'),
(97,	10,	'ShareName',	'String'),
(103,	15,	'Caption',	'String'),
(104,	15,	'Name',	'String'),
(105,	15,	'DeviceLocator',	'String'),
(106,	15,	'Capacity',	'UInt32'),
(107,	15,	'Speed',	'UInt16'),
(108,	15,	'MemoryType',	'UInt16'),
(109,	15,	'Manufacturer',	'String'),
(110,	13,	'DriverVersion',	'String'),
(111,	11,	'NumberOfCores',	'UInt16'),
(112,	11,	'NumberOfLogicalProcessors',	'UInt16'),
(113,	16,	'Manufacturer',	'String'),
(114,	16,	'Product',	'String'),
(115,	16,	'Model',	'String'),
(116,	16,	'SerialNumber',	'String'),
(117,	8,	'OSArchitecture',	'String');

-- 2016-12-04 14:04:20
