/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=``*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=`NO_AUTO_VALUE_ON_ZERO` */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`STBD` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `STBD`;

DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
	`UserID` INT NOT NULL AUTO_INCREMENT,
	`Email` varchar(45) NOT NULL UNIQUE,
	`Password` varchar(50) NOT NULL,
	`FirstName` varchar(30) NOT NULL,
	`LastName` varchar(30) NOT NULL,
	`AddressLine1` varchar(60) NOT NULL,
	`City` varchar(30) NOT NULL,
	`Country` varchar(30) NOT NULL,
	`Postcode` varchar(8) NOT NULL,
	`Telephone1` INT(11) NOT NULL,
	`Telephone2` INT(11),
	`Salt` INT NOT NULL,
	PRIMARY KEY (`UserID`)
);

DROP TABLE IF EXISTS `VendorUser`;
CREATE TABLE `VendorUser` (
	`VendorUserID` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`Name` varchar(45) NOT NULL,
	`Category` varchar(20) NOT NULL,
	`Tags` varchar(300) NOT NULL,
	`AddressLine1` varchar(45) NOT NULL,
	`AddressLine2` varchar(45),
	`City` varchar(30) NOT NULL,
	`Postcode` varchar(8) NOT NULL,
	`Website` varchar(50),
	`Email` varchar(45) NOT NULL,
	`Telephone1` INT(11) NOT NULL,
	`Telephone2` INT(11),
	`Facebook` varchar(50),
	`Instagram` varchar(50),
	`Twitter` varchar(50),
	`IsOwner` boolean NOT NULL,
	PRIMARY KEY (`VendorUserID`)
);


DROP TABLE IF EXISTS `Messages`;
CREATE TABLE `Messages` (
	`Sender` varchar(45) NOT NULL,
	`Receiver` varchar(45) NOT NULL,
	`Subject` varchar(100),
	`Read` boolean NOT NULL,
	`Content` TEXT,
	`Timestamp` DATETIME
);


DROP TABLE IF EXISTS `VendorPage`;
CREATE TABLE `VendorPage` (
	`VendorPageID` INT AUTO_INCREMENT UNIQUE,
	`Name` varchar(30) NOT NULL,
	`Category` varchar(20) NOT NULL,
	`AddressLine1` varchar(45) NOT NULL,
	`AddressLine2` varchar(45),
	`City` varchar(30) NOT NULL,
	`Postcode` varchar(8) NOT NULL,
	`Website` varchar(50),
	`Email` varchar(45) NOT NULL,
	`Telephone1` INT(11) NOT NULL,
	`Telephone2` INT(11),
	`Facebook` varchar(50),
	`Instagram` varchar(50),
	`Twitter` varchar(50),
	`IsClaimed` boolean NOT NULL,
	PRIMARY KEY(`VendorPageID`)
);

DROP TABLE IF EXISTS `Review`;
CREATE TABLE `Review` (
	`User` varchar(45) NOT NULL,
	`ReviewID` INT NOT NULL UNIQUE AUTO_INCREMENT,
	`PageID` INT NOT NULL,
	`Professionalism` INT(1) NOT NULL,
	`Flexibility` INT(1) NOT NULL,
	`Value` INT(1) NOT NULL,
	`Rating` INT(1) NOT NULL,
	`Recommeded` BOOLEAN NOT NULL,
	`Content` TEXT,
	`Timestamp` DATETIME,
	PRIMARY KEY(`ReviewID`)

	
);

DROP TABLE IF EXISTS `VendorReply`;
CREATE TABLE `VendorReply` (
	`User` varchar(45) NOT NULL,
	`ReplyID` INT NOT NULL UNIQUE AUTO_INCREMENT,
	`ReviewID` INT NOT NULL,
	`Content` TEXT,
	`Timestamp` DATETIME,
	PRIMARY KEY(`ReplyID`)
);

ALTER TABLE `Messages` ADD CONSTRAINT `messages_fk_0` FOREIGN KEY (`Sender`) REFERENCES `Users` (`Email`);
ALTER TABLE `Messages` ADD CONSTRAINT `messages_fk_1` FOREIGN KEY (`Sender`) REFERENCES `VendorUser` (`Email`);
ALTER TABLE `Messages` ADD CONSTRAINT `messages_fk_2` FOREIGN KEY (`Receiver`) REFERENCES `Users` (`Email`);
ALTER TABLE `Messages` ADD CONSTRAINT `messages_fk_3` FOREIGN KEY (`Receiver`) REFERENCES `VendorUser` (`Email`);
ALTER TABLE `Review` ADD CONSTRAINT `review_fk_0` FOREIGN KEY (`User`) REFERENCES `Users` (`Email`);
ALTER TABLE `Review` ADD CONSTRAINT `review_fk_1` FOREIGN KEY (`PageID`) REFERENCES `VendorPage` (`VendorPageID`);
ALTER TABLE `VendorReply` ADD CONSTRAINT `reply_fk_0` FOREIGN KEY (`User`) REFERENCES `VendorUser` (`Email`);
ALTER TABLE `VendorReply` ADD CONSTRAINT `reply_fk_1` FOREIGN KEY (`ReviewID`) REFERENCES `Review` (`ReviewID`);

-- ALTER TABLE `TraderStock` ADD CONSTRAINT `TraderStock_fk1` FOREIGN KEY (`Ticker`) REFERENCES `Stocks`(`Ticker`);

-- ALTER TABLE `Errors` ADD CONSTRAINT `Errors_fk0` FOREIGN KEY (`Type`) REFERENCES `ErrorPriority`(`Type`);

-- ALTER TABLE `Errors` ADD CONSTRAINT `Errors_fk1` FOREIGN KEY (`BuyerEmail`) REFERENCES `Trader`(`Email`);

-- ALTER TABLE `Errors` ADD CONSTRAINT `Errors_fk2` FOREIGN KEY (`SellerEmail`) REFERENCES `Trader`(`Email`);

-- ALTER TABLE `Errors` ADD CONSTRAINT `Errors_fk3` FOREIGN KEY (`Ticker`) REFERENCES `Stocks`(`Ticker`);

-- ALTER TABLE `PastPrices` ADD CONSTRAINT `PastPrices_fk0` FOREIGN KEY (`Ticker`) REFERENCES `Stocks`(`Ticker`);