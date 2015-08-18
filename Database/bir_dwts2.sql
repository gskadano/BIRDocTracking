-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2015 at 06:14 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDesc`, `categoryCreate`, `categoryUpdate`) VALUES
(1, 'qwe', 'qwe', '2015-08-11 14:48:58', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `companyagency`
--

INSERT INTO `companyagency` (`id`, `companyAgencyCode`, `companyAgencyName`, `companyAgencyDesc`, `companyAgencyCreate`, `companyAgencyUpdate`) VALUES
(1, 'DOH', 'qw', 'qw', '2015-08-11 14:48:18', '2015-08-11 14:48:18');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `document_tracking_number`, `documentName`, `documentDesc`, `documentTargetDate`, `category_id`, `type_id`, `priority_id`, `documentComment`, `user_id`, `companyAgency_id`, `documentImage`, `section_id`, `documentCreate`, `documentUpdate`) VALUES
(1, '20150811-01-0001', 'sample', 'sample', '2015-08-31', 1, 1, 1, 'sample', 66, 1, 0x736c696465342e6a7067, 1, '2015-08-11 14:49:45', NULL),
(2, '20150814-01-0002', 'dfergtyui', 'qwertyu', '2015-08-31', 1, 1, 1, 'qwertuil', 63, 1, 0x736467686a, 1, '2015-08-14 11:43:17', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `positionCode`, `positionName`, `positionDesc`, `positionNotes`) VALUES
(1, 'RCV - MMS', 'Receiver', 'Receives document', 'Receiving department - MMS'),
(2, 'Admin', 'System Administrator', 'Admin', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`id`, `priorityName`, `priorityDesc`, `priorityCreate`, `priorityUpdate`) VALUES
(1, 'Urgent', 'urgent', NULL, NULL);

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
-- Table structure for table `table_seq`
--

CREATE TABLE IF NOT EXISTS `table_seq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `table_seq`
--

INSERT INTO `table_seq` (`id`, `timestamp`) VALUES
(1, '2015-08-11'),
(2, '2015-08-14');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `typeName`, `typeDesc`, `typeCreate`, `typeUpdate`) VALUES
(1, 'qwe', 'qwe', '2015-08-11 14:49:31', NULL);

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
  `status` smallint(6) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_position_idx` (`position_id`),
  KEY `fk_user_section1_idx` (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `position_id`, `section_id`, `userFName`, `userMName`, `userLName`, `username`, `password_hash`, `auth_key`, `status`, `email`, `created_at`, `updated_at`) VALUES
(63, 1, 2, 'Meynard', '', 'Denoyo', 'mrdenoyo', '$2y$13$pFcOlbO0nQ7z/sLxsIIweOYru8ntLZt7yEanC6gDLEIX2t5ulYUqW', 'm8uOappqhMfr16Mg7Oq75u87xf6pA63F', 10, 'mrdenoyo@bir.gov.ph', '2015-08-05 01:54:03', NULL),
(66, 1, 2, 'Jerica', '', 'Flores', 'jnflores', '$2y$13$fp2O8weiZEV8J0mYspe3qOWCeqjO/9ktMypv9Cd5fzlEy6z4SXjgu', 'il47I_GU13g5Ch0QCs0J3GKCCJCXJPFf', 10, 'jnflores@bir.gov.ph', '2015-08-05 02:00:45', NULL),
(68, 1, 1, 'Cherry Mae', '', 'Buaquina', 'csbuaquina', '$2y$13$ZogjLUOUyBylXHLgX2KKk.SZVYuMu5Rx6JcWLqg1y971RxB8mya1.', 'E93d-D7stRyrPYSbmMRouGVIzcQotLWu', 10, 'csbuaquina@bir.gov.ph', '2015-08-05 02:04:45', '2015-08-11 06:03:14'),
(70, 1, 2, 'Gene Anthony', '', 'Kadano', 'gskadano', '$2y$13$eoHZUJ/OZbi3HMX/Sg4wK.DUu6wSYwX79OK3fNigwhB0i8acPguK6', 'KKDoJ0HHa1LBXPV2zpxeLuQ0GiKJWc8y', 10, 'gskadano@bir.gov.ph', '2015-08-05 02:09:53', NULL),
(71, 1, 2, 'Mark Joshua', '', 'Ronquillo', 'mdronquillo', '$2y$13$H/78kPkVMIy7.CsCJ6/iteAqwjafi37JA8nNINKwU1HKBZJYtykKK', 'tZtbwyTQCa8MLwavgBlzKlQpXqLSfP9y', 10, 'mdronquillo@bir.gov.ph', '2015-08-05 02:15:28', NULL),
(72, 1, 2, 'John Michael', '', 'Santos', 'jmsantos', '$2y$13$hx04BenmWP/qhn.XpAw7R.1LUPOk23RzcnUJPz3kmd1W.CvlCQvgW', 'h8lPi0RE0QRy-I5LBGyNW1PEAnT0PucM', 10, 'jmsantos@bir.gov.ph', '2015-08-06 13:52:36', NULL),
(73, 1, 2, 'Christine', '', 'Ferrer', 'cjferrer', '$2y$13$u02SALvZ7Ko.3OQXewRkR.cz3NBl1IV7W2/Zs8HEBa98S5u9p5av2', 'ARYFmjh-GAjqMNt2X0bvwwwcRzGBJpnA', 10, 'cjferrer@bir.gov.ph', '2015-08-06 13:54:00', NULL),
(78, 1, 1, 'Alexis', '', 'Cuntapay', 'alexiscntp', '$2y$13$gxjXtmX85fQyZAUgbkNxGOwsgqVPZmXhxQH5TuBShCxE1fqWqbQwe', 'uuAiN7ada_quF9PtJpf2w0xwZr-C64cI', 10, 'alexiscntp', '2015-08-07 19:54:17', '2015-08-07 21:55:42'),
(81, 1, 1, 'Carlos', '', 'Nerez', 'cdbnerez', '$2y$13$7Ovx6hSC2telKNjzwnvbCuIXgTVPSJYiAVd3JW.IBTst3nsxVK6/m', 'S_EukEPBCElE_0y_fsomVwwMZy5tPZ9p', 10, 'cdbnerez@bir.gov.ph', '2015-08-07 20:18:17', '2015-08-07 22:19:12'),
(83, 1, 2, 'Mark Ervin', '', 'Barbasa', 'mmbarbasa', '$2y$13$9hHiuQs5ckkNINYRMuSw3enR.627UNZ2yJWEaxuZag0fbDU6W.0IW', 'aV3B8UEZk9b3Zm39Dzq0vpg2_7tp674p', 10, 'mmbarbasa@bir.gov.ph', '2015-08-07 20:28:18', '2015-08-07 22:28:32');

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
CREATE DEFINER=`root`@`localhost` EVENT `e-daily` ON SCHEDULE EVERY 1 DAY STARTS '2015-04-27 15:00:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Descriptive comment' DO TRUNCATE table_seq$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
