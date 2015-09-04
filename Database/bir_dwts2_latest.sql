-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2015 at 01:16 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDesc`, `categoryCreate`, `categoryUpdate`) VALUES
(1, 'Category Sample 3', 'Category Sample 3', '2015-08-11 14:48:58', '0000-00-00 00:00:00'),
(2, 'Category Sample 1', 'Category Sample 1', '2015-08-27 13:53:21', '0000-00-00 00:00:00'),
(3, 'Category Sample 2', 'Category Sample 2', '2015-08-27 13:53:43', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `companyagency`
--

INSERT INTO `companyagency` (`id`, `companyAgencyCode`, `companyAgencyName`, `companyAgencyDesc`, `companyAgencyCreate`, `companyAgencyUpdate`) VALUES
(1, 'DOH', 'Department of Health', 'Department of Health', '2015-08-11 14:48:18', '2015-08-11 14:48:18'),
(2, 'BIR', 'Bureau of Internal Revenue', 'Bureau of Internal Revenue', '2015-08-27 14:03:54', '2015-08-27 14:03:54');

-- --------------------------------------------------------

--
-- Table structure for table `docstatus`
--

CREATE TABLE IF NOT EXISTS `docstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `docStatusName` varchar(45) NOT NULL,
  `docStatusDesc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `docstatus`
--

INSERT INTO `docstatus` (`id`, `docStatusName`, `docStatusDesc`) VALUES
(1, 'Ongiong', NULL),
(2, 'Finish', NULL);

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
  `documentImage` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `document_tracking_number`, `documentName`, `documentDesc`, `documentTargetDate`, `category_id`, `type_id`, `priority_id`, `documentComment`, `user_id`, `companyAgency_id`, `documentImage`, `section_id`, `documentCreate`, `documentUpdate`) VALUES
(2, '20150814-01-0002', 'Testing2', 'Testing2', '2015-08-31', 1, 1, 1, 'Testing2', 68, 1, 'uploads/images/70-nanorust-cleans-arsenic.jpg', 1, '2015-08-14 11:43:17', '2015-09-01 23:02:09'),
(3, '20150826-02-0003', 'Testing3', 'Testing3', '2015-08-31', 1, 2, 3, 'Testing', 70, 1, 'uploads/images/23-Nanotech PPT_GeneAnthonyKadano.pptx', 2, '2015-08-26 23:47:26', '2015-09-01 23:02:36'),
(4, '20150826-06-0004', 'Testing4', 'Testing4', '2015-08-31', 1, 2, 3, 'Testing', 70, 1, 'uploads/images/79-Medical.jpg', 6, '2015-08-26 23:54:11', '2015-09-01 23:03:01'),
(5, '20150826-06-0005', 'Testing5', 'Testing5', '2015-08-29', 1, 1, 1, 'Testing', 70, 1, 'uploads/images/10-bdo.png', 6, '2015-08-26 23:58:19', '2015-09-01 23:03:27'),
(16, '20150827-06-0016', 'Testing6', 'Testing6', '2015-08-29', 1, 2, 3, 'Testing', 70, 1, 'uploads/images/30-bsp.jpg', 6, '2015-08-27 10:29:06', '2015-09-01 23:03:42');

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
  `timeAccepted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `timeRelease` datetime DEFAULT NULL,
  `totalTimeSpent` varchar(45) DEFAULT NULL,
  `user_release` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_docWorkflow_document1_idx` (`document_id`),
  KEY `fk_docWorkflow_docStatus1_idx` (`docStatus_id`),
  KEY `fk_docWorkflow_user1_idx` (`user_receive`),
  KEY `fk_docWorkflow_user2_idx` (`user_release`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `docworkflow`
--

INSERT INTO `docworkflow` (`id`, `document_id`, `user_receive`, `docStatus_id`, `docWorkflowComment`, `timeAccepted`, `timeRelease`, `totalTimeSpent`, `user_release`) VALUES
(25, 16, 68, 1, NULL, '2015-09-03 23:10:35', '2015-09-04 01:10:35', '1day/s,01hour/s 54min/s 59s', 70),
(26, 3, 68, 1, NULL, '2015-09-03 23:12:05', '2015-09-04 01:12:05', '1day/s,01hour/s 54min/s 08s', 70),
(27, 4, 68, 1, NULL, '2015-09-03 23:13:13', '2015-09-04 07:13:13', NULL, 70),
(29, 3, 70, 1, NULL, '2015-09-03 23:15:40', '2015-09-04 07:15:40', NULL, 68),
(31, 3, 68, 1, NULL, '2015-09-03 23:16:18', '2015-09-04 01:20:31', '0day/s,18hour/s 04min/s 13s', 70),
(32, 16, 68, 1, NULL, '2015-09-03 23:18:52', '2015-09-04 07:25:18', '0day/s,00hour/s 06min/s 26s', 70),
(33, 4, 68, 1, NULL, '2015-09-03 23:19:50', '2015-09-04 11:52:07', '0day/s,04hour/s 32min/s 17s', 70),
(34, 3, 70, 1, NULL, '2015-09-03 23:24:57', '2015-09-04 13:05:21', '0day/s,05hour/s 40min/s 24s', 81),
(35, 16, 70, 1, NULL, '2015-09-03 23:27:58', NULL, NULL, NULL),
(36, 4, 70, 1, NULL, '2015-09-04 03:52:35', NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pendingdoc`
--

INSERT INTO `pendingdoc` (`id`, `pendingDocFName`, `pendingDocSection`, `pendingDocName`, `pendingDocTimeRelease`) VALUES
(2, 'Nerez, Carlos', 'Manpower Management Section', 'Testing3', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `positionCode`, `positionName`, `positionDesc`, `positionNotes`) VALUES
(1, 'RCV - MMS', 'Receiver - MMS Department', 'Receives document for MMS Department', 'Receiving department - MMS'),
(2, 'DC', 'Department Chief', 'Department Chief', 'Admin'),
(3, 'RCV - CMS', 'Receiver - CMS Department', 'Receives document for CMS Department', 'Receiver - CMS Department'),
(4, 'RCV - IRS', 'Receiver - IRS Department', 'Receives document for IRS Department', 'Receiver - IRS Department'),
(5, 'RCV - PEMS', 'Receiver - PEMS Department', 'Receives document for PEMS Department', 'Receiver - PEMS Department'),
(6, 'RCV - PS', 'Receiver - PS Department', 'Receives document for PS Department', 'Receiver - PS Department'),
(7, 'RCV - CBS', 'Receiver - CBS Department', 'Receives document for CBS Department', 'Receiver - CBS Department'),
(8, 'ADC', 'Assistant Department Chief', 'Assistant Department Chief', 'Admin'),
(9, 'SC - MMS', 'Section Chief - MMS', 'Section Chief of MMS Department', 'Section Chief of MMS Department'),
(10, 'SC - CMS', 'Section Chief - CMS', 'Section Chief of CMS Department', 'Section Chief of CMS Department'),
(11, 'SC - IRS', 'Section Chief - IRS', 'Section Chief of IRS Department', 'Section Chief of IRS Department'),
(12, 'SC - PEMS', 'Section Chief - PEMS', 'Section Chief of PEMS Department', 'Section Chief of PEMS Department'),
(13, 'SC - PS', 'Section Chief - PS', 'Section Chief of PS Department', 'Section Chief of PS Department'),
(14, 'SC - CBS', 'Section Chief - CBS', 'Section Chief of CBS Department', 'Section Chief of CBS Department'),
(15, 'ASC - MMS', 'Assistant Section Chief - MMS', 'Assistant Section Chief - MMS Department', 'Assistant Section Chief - MMS Department'),
(16, 'ASC - CMS', 'Assistant Section Chief - CMS', 'Assistant Section Chief - CMS Department', 'Assistant Section Chief - CMS Department'),
(17, 'ASC - IRS', 'Assistant Section Chief - IRS', 'Assistant Section Chief - IRS Department', 'Assistant Section Chief - IRS Department'),
(18, 'ASC - PEMS', 'Assistant Section Chief - PEMS', 'Assistant Section Chief - PEMS Department', 'Assistant Section Chief - PEMS Department'),
(19, 'ASC - PS', 'Assistant Section Chief - PS', 'Assistant Section Chief - PS Department', 'Assistant Section Chief - PS Department'),
(20, 'ASC - CBS', 'Assistant Section Chief - CBS', 'Assistant Section Chief - CBS Department', 'Assistant Section Chief - CBS Department');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`id`, `priorityName`, `priorityDesc`, `priorityCreate`, `priorityUpdate`) VALUES
(1, 'Urgent', 'Urgent Priority', NULL, '2015-08-25 12:28:16'),
(3, 'Normal', 'Normal Priority', '2015-08-25 12:28:47', '2015-08-25 12:28:58');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `sectionNum`, `sectionCode`, `sectionName`, `sectionDesc`) VALUES
(1, '01', 'CMS', 'Career Management Section', ''),
(2, '02', 'MMS', 'Manpower Management Section', ''),
(3, '03', 'IRS', 'IRS', ''),
(4, '04', 'PEMS', 'PEMS', ''),
(5, '05', 'PS', 'PS', ''),
(6, '06', 'CBS', 'CBS', ''),
(7, '07', 'ADMIN', 'System Administrator', '');

-- --------------------------------------------------------

--
-- Table structure for table `table_seq`
--

CREATE TABLE IF NOT EXISTS `table_seq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `table_seq`
--

INSERT INTO `table_seq` (`id`, `timestamp`) VALUES
(1, '2015-08-11'),
(2, '2015-08-14'),
(3, '2015-08-26'),
(4, '2015-08-26'),
(5, '2015-08-26'),
(6, '2015-08-27'),
(7, '2015-08-27'),
(8, '2015-08-27'),
(9, '2015-08-27'),
(10, '2015-08-27'),
(11, '2015-08-27'),
(12, '2015-08-27'),
(13, '2015-08-27'),
(14, '2015-08-27'),
(15, '2015-08-27'),
(16, '2015-08-27');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `typeName`, `typeDesc`, `typeCreate`, `typeUpdate`) VALUES
(1, 'Type 1', 'Type 1', '2015-08-11 14:49:31', '2015-08-27 13:57:42'),
(2, 'Type 2', 'Sample Type 2', '2015-08-25 12:29:24', '2015-08-25 12:32:18');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `position_id`, `section_id`, `userFName`, `userMName`, `userLName`, `username`, `password_hash`, `auth_key`, `status`, `email`, `created_at`, `updated_at`) VALUES
(63, 2, 7, 'Meynard', '', 'Denoyo', 'mrdenoyo', '$2y$13$PAruKAN2qL4dACugy9X4MehgZBai5dda7AVfTV0hRhw/cbdU1fIay', 'YDZB3_Mf3TEXaTrXOU-3nvLHLxtdQ_a3', 10, 'mrdenoyo@bir.gov.ph', '2015-08-05 01:54:03', '2015-08-25 09:11:16'),
(66, 1, 2, 'Jerica', '', 'Flores', 'jnflores', '$2y$13$fp2O8weiZEV8J0mYspe3qOWCeqjO/9ktMypv9Cd5fzlEy6z4SXjgu', 'il47I_GU13g5Ch0QCs0J3GKCCJCXJPFf', 10, 'jnflores@bir.gov.ph', '2015-08-05 02:00:45', NULL),
(68, 1, 1, 'Cherry Mae', '', 'Buaquina', 'csbuaquina', '$2y$13$ZogjLUOUyBylXHLgX2KKk.SZVYuMu5Rx6JcWLqg1y971RxB8mya1.', 'E93d-D7stRyrPYSbmMRouGVIzcQotLWu', 10, 'csbuaquina@bir.gov.ph', '2015-08-05 02:04:45', '2015-08-11 06:03:14'),
(70, 2, 3, 'Gene Anthony', '', 'Kadano', 'gskadano', '$2y$13$FNwvrN4ao2BSiKf29U4nwuiojLf2ITNbfVZdLFrMYsjp4Fsi/W1Vi', 'GgdqE8luQUa0DuSe-zRDiEs4H_kYiYfz', 10, 'gskadano@bir.gov.ph', '2015-08-05 02:09:53', '2015-08-27 08:36:01'),
(72, 6, 5, 'John Michael', '', 'Santos', 'jmsantos', '$2y$13$V0IE5keeSAtFvu0ucOrL5.cFFtmm21LZaftoCdidiVVWJrd6HwaMq', 'Z4xoedqVs7JbXDYkb0DtCP9iKbcJ7cKo', 10, 'jmsantos@bir.gov.ph', '2015-08-06 13:52:36', '2015-08-25 08:54:59'),
(73, 7, 6, 'Christine', '', 'Ferrer', 'cjferrer', '$2y$13$h2vwuYHc2FwrTmofHK2ko.qVutAUXiXF9LTZA.9A8YHFfK3gIVMze', 'INvsstbermme7fyiLKp4ms8nupmR0VAn', 10, 'cjferrer@bir.gov.ph', '2015-08-06 13:54:00', '2015-08-25 08:55:20'),
(78, 10, 1, 'Alexis', '', 'Cuntapay', 'alexiscntp', '$2y$13$W7eIm5Z0QdreDyuhS4Eiz.v5sigOegLQwRpqNYqecAO/XreMs05k6', 's3uwj1wnmv76sOFUdBXs1Y_BH9i9NGtq', 10, 'alexiscntp', '2015-08-07 19:54:17', '2015-08-25 09:12:12'),
(81, 16, 1, 'Carlos', '', 'Nerez', 'cdbnerez', '$2y$13$vzV.iBCgobPGCpjgf/AZO.idg0rPjEcE3YYxMzZaZv63EoRxEQp/O', 'RufDdf-uQ5QlVmuXd_xMbX3NXGhaWIgf', 10, 'cdbnerez@bir.gov.ph', '2015-08-07 20:18:17', '2015-09-04 13:15:23'),
(83, 9, 2, 'Mark Ervin', '', 'Barbasa', 'mmbarbasa', '$2y$13$6qhlooK7nnSBfYP.zBEZyO3kVrogY3tWZjsGpoRGPNyssg8M81GBm', 'YkXD7EGoloaVS8T8roAaQHCqkxPRp7wW', 10, 'mmbarbasa@bir.gov.ph', '2015-08-07 20:28:18', '2015-08-25 09:13:11'),
(84, 2, 2, 'Mark Joshua', '', 'Ronquillo', 'mdronquillo', '$2y$13$z3bkXU9IS9PFDvYYjX//bOxQwnBJdhoasCBryHmRFGMpXSG/xsZiq', '6-4ekmIYD4Uk3u_eW5RxzUjqIveqSvD4', 10, 'mdronquillo@bir.gov.ph', '2015-09-01 07:06:57', NULL);

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
