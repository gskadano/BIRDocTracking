-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2015 at 09:33 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bir_dwts2`
--

-- --------------------------------------------------------

--
-- Table structure for table `agencycperson`
--

CREATE TABLE IF NOT EXISTS `agencycperson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `phoneNumber` varchar(45) DEFAULT NULL,
  `telNumber` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `companyAgency_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_agencyCPerson_companyAgency1_idx` (`companyAgency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) NOT NULL,
  `categoryDesc` varchar(255) DEFAULT NULL,
  `categoryCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categoryUpdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `companyagency`
--

CREATE TABLE IF NOT EXISTS `companyagency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyAgencyCode` varchar(45) DEFAULT NULL,
  `companyAgencyName` varchar(100) NOT NULL,
  `companyAgencyDesc` varchar(255) DEFAULT NULL,
  `companyAgencyCreate` datetime DEFAULT CURRENT_TIMESTAMP,
  `companyAgencyUpdate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `docstatus`
--

CREATE TABLE IF NOT EXISTS `docstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `docStatusName` varchar(45) NOT NULL,
  `docStatusDesc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_tracking_number` varchar(45) DEFAULT NULL,
  `documentName` varchar(100) DEFAULT NULL,
  `documentDesc` varchar(255) DEFAULT NULL,
  `documentTargetDate` date DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `priority_id` int(11) NOT NULL,
  `documentComment` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `companyAgency_id` int(11) NOT NULL,
  `documentImage` blob,
  `section_id` int(11) NOT NULL,
  `documentCreate` datetime DEFAULT CURRENT_TIMESTAMP,
  `documentUpdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_document_user1_idx` (`user_id`),
  KEY `fk_document_type1_idx` (`type_id`),
  KEY `fk_document_priority1_idx` (`priority_id`),
  KEY `fk_document_companyAgency1_idx` (`companyAgency_id`),
  KEY `fk_document_category1_idx` (`category_id`),
  KEY `fk_document_section1_idx` (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Triggers `document`
--
DROP TRIGGER IF EXISTS `tg_dtn_insert`;
DELIMITER //
CREATE TRIGGER `tg_dtn_insert` BEFORE INSERT ON `document`
 FOR EACH ROW BEGIN

  declare DTN varchar(20); 
  
  INSERT INTO table_seq VALUES (NULL, CURDATE());  
  
  SET DTN = CONCAT(DATE_FORMAT(NOW(), "%Y%m%d-"),
      (SELECT sectionNum from section where id = NEW.section_id),"-",
      LPAD(LAST_INSERT_ID(), 4, '0'));
  
  SET NEW.document_tracking_number = DTN;
  
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `docworkflow`
--

CREATE TABLE IF NOT EXISTS `docworkflow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `user_receive` int(11) NOT NULL,
  `docStatus_id` int(11) NOT NULL,
  `docWorkflowComment` varchar(255) DEFAULT NULL,
  `timeAccepted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `timeRelease` datetime NOT NULL,
  `totalTimeSpent` varchar(45) DEFAULT NULL,
  `user_release` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_docWorkflow_document1_idx` (`document_id`),
  KEY `fk_docWorkflow_docStatus1_idx` (`docStatus_id`),
  KEY `fk_docWorkflow_user1_idx` (`user_receive`),
  KEY `fk_docWorkflow_user2_idx` (`user_release`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Triggers `docworkflow`
--
DROP TRIGGER IF EXISTS `tg_insert_total_time`;
DELIMITER //
CREATE TRIGGER `tg_insert_total_time` BEFORE UPDATE ON `docworkflow`
 FOR EACH ROW BEGIN

  declare DTN varchar(20); 
  declare day varchar(20);
  declare oras varchar(20);
  
  SET oras = (SELECT DATE_FORMAT(TIMEDIFF(NEW.timeRelease, NEW.timeAccepted), "%Hhour/s %imin/s %ssec/s"));
  SET day = (SELECT DATEDIFF(DATE_FORMAT(NEW.timeRelease, "%Y-%m-%d"), DATE_FORMAT(NEW.timeAccepted, "%Y-%m-%d")));
  
  
  SET NEW.totalTimeSpent = CONCAT(day, "day/s,", oras);
  
  
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pendingdoc`
--

CREATE TABLE IF NOT EXISTS `pendingdoc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pendingDocFName` varchar(100) NOT NULL,
  `pendingDocSection` varchar(100) DEFAULT NULL,
  `pendingDocName` varchar(100) NOT NULL,
  `pendingDocTimeRelease` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `positionCode` varchar(45) DEFAULT NULL,
  `positionName` varchar(100) NOT NULL,
  `positionDesc` varchar(255) DEFAULT NULL,
  `positionNotes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `positionCode`, `positionName`, `positionDesc`, `positionNotes`) VALUES
(1, 'RCV - MMS', 'Receiver', 'Receives document', 'Receiving department - MMS');

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE IF NOT EXISTS `priority` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `priorityName` varchar(100) NOT NULL,
  `priorityDesc` varchar(255) DEFAULT NULL,
  `priorityCreate` datetime DEFAULT CURRENT_TIMESTAMP,
  `priorityUpdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sectionNum` varchar(45) DEFAULT NULL,
  `sectionCode` varchar(45) DEFAULT NULL,
  `sectionName` varchar(100) NOT NULL,
  `sectionDesc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `sectionNum`, `sectionCode`, `sectionName`, `sectionDesc`) VALUES
(1, '01', 'CMS', 'Career Management Section', ''),
(2, '02', 'MMS', 'Manpower Management Section', '');

-- --------------------------------------------------------

--
-- Table structure for table `tableseq`
--

CREATE TABLE IF NOT EXISTS `tableseq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeName` varchar(100) NOT NULL,
  `typeDesc` varchar(255) DEFAULT NULL,
  `typeCreate` datetime DEFAULT CURRENT_TIMESTAMP,
  `typeUpdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `userFName` varchar(45) NOT NULL,
  `userMName` varchar(45) DEFAULT NULL,
  `userLName` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_position_idx` (`position_id`),
  KEY `fk_user_section1_idx` (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agencycperson`
--
ALTER TABLE `agencycperson`
  ADD CONSTRAINT `fk_agencyCPerson_companyAgency1` FOREIGN KEY (`companyAgency_id`) REFERENCES `companyagency` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `fk_document_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_document_companyAgency1` FOREIGN KEY (`companyAgency_id`) REFERENCES `companyagency` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_document_priority1` FOREIGN KEY (`priority_id`) REFERENCES `priority` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_document_section1` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_document_type1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_document_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `docworkflow`
--
ALTER TABLE `docworkflow`
  ADD CONSTRAINT `fk_docWorkflow_docStatus1` FOREIGN KEY (`docStatus_id`) REFERENCES `docstatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docWorkflow_document1` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docWorkflow_user1` FOREIGN KEY (`user_receive`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docWorkflow_user2` FOREIGN KEY (`user_release`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_position` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_section1` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `e-daily` ON SCHEDULE EVERY 1 DAY STARTS '2015-04-27 00:00:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Descriptive comment' DO TRUNCATE table_seq$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
