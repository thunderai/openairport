-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2009 at 03:33 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `oa-copy_11_20_2008`
--
CREATE DATABASE `oa-copy_11_20_2008` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `oa-copy_11_20_2008`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_303_main`
--

CREATE TABLE IF NOT EXISTS `tbl_139_303_main` (
  `139_303_id` int(10) NOT NULL auto_increment,
  `139_303_type_cb_int` int(10) default NULL,
  `139_303_type_cb_txt` longtext,
  `139_303_by_cb_int` int(10) default NULL,
  `139_303_by_cb_txt` varchar(50) default NULL,
  `139_303_teacher_signature` longblob,
  `139_303_date` date default NULL,
  `139_303_time` time default NULL,
  `139_303_attendance` longtext,
  `139_303_sylabus` longtext,
  `139_303_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`139_303_id`),
  KEY `139_303_type_cb_int` (`139_303_type_cb_int`),
  KEY `139_303_by_cb_int` (`139_303_by_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_303_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_303_sub_c`
--

CREATE TABLE IF NOT EXISTS `tbl_139_303_sub_c` (
  `conditions_id` int(10) NOT NULL auto_increment,
  `condition_name` text,
  `condition_facility_cb_int` int(10) default NULL,
  `condition_facility_cb_txt` varchar(255) default NULL,
  `condition_type_cb_int` int(10) default NULL,
  `condition_type_cb_txt` varchar(255) default NULL,
  `condition_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`conditions_id`),
  KEY `condition_facility_cb_int` (`condition_facility_cb_int`),
  KEY `condition_type_cb_int` (`condition_type_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `tbl_139_303_sub_c`
--

INSERT INTO `tbl_139_303_sub_c` (`conditions_id`, `condition_name`, `condition_facility_cb_int`, `condition_facility_cb_txt`, `condition_type_cb_int`, `condition_type_cb_txt`, `condition_archived_yn`) VALUES
(1, 'Airport Familiarization, Airport Markings and Lighting (3.b.i)', 28, NULL, 2, NULL, 0),
(2, 'Airport Emergency Plan (3.b.ii)', 28, NULL, 2, NULL, 0),
(3, 'NOTAM Notification Procedures (b.3.iii)', 28, NULL, 2, NULL, 0),
(4, 'Procedures for Pedestrians and Ground Vehicles in Movement Areas (b.3.iv)', 28, NULL, 2, NULL, 0),
(5, 'Discrepancy Reporting Procedures (b.3.v)', 28, NULL, 2, NULL, 0),
(6, 'Airport Communications (c.3)', 16, NULL, 2, NULL, 0),
(7, 'Wildlife Hazard Management (e.5)', 16, NULL, 2, NULL, 0),
(8, 'Airport Condition Reporting - FiCON (e.6)', 16, NULL, 2, NULL, 0),
(9, 'Rescue and Firefighting Personnel Safety (i.2.iii)', 24, NULL, 1, NULL, 0),
(10, 'Use of Fire Hoses, nozzels, turrents, and other applicable apperatus (i.2.v)', 24, NULL, 1, NULL, 0),
(11, 'Application of the types of extingushing agents required for aircraft operations (i.2.vi)', 24, NULL, 1, NULL, 0),
(12, 'Firefighting Operations (i.2.viii)', 24, NULL, 1, NULL, 0),
(13, 'Adapting and using structural rescuse and firefighting methods for aircraft (i.2.ix)', 24, NULL, 1, NULL, 0),
(14, 'Aircraft cargo hazards, including hazardous materials (i.2.x)', 24, NULL, 1, NULL, 0),
(15, 'History of Civil Aviation Security Program', 36, NULL, 6, NULL, 0),
(16, 'A.S.C.s role in Airport Security Program', 36, NULL, 6, NULL, 0),
(17, 'T.S.A.''s role in Regulating Civil Avition Security', 36, NULL, 6, NULL, 0),
(18, 'Part 1540', 36, NULL, 6, NULL, 0),
(19, 'Part 1542', 36, NULL, 6, NULL, 0),
(20, 'Part 1546', 36, NULL, 6, NULL, 0),
(21, 'Part 1548', 36, NULL, 6, NULL, 0),
(22, 'Airport Security Program', 36, NULL, 6, NULL, 0),
(23, 'law Enforcement Resposibilities', 36, NULL, 6, NULL, 0),
(24, 'Incident Management', 36, NULL, 6, NULL, 0),
(25, 'Coordination and Communication with T.S.A.', 36, NULL, 6, NULL, 0),
(26, 'Dissemination of SSI', 36, NULL, 6, NULL, 0),
(27, 'Fire Extinguisher Training', 38, NULL, 7, NULL, 0),
(28, 'Bloodborne Pathogens', 38, NULL, 7, NULL, 0),
(29, 'Confined Space Entry', 38, NULL, 7, NULL, 0),
(30, 'Trenching/Excavation', 38, NULL, 7, NULL, 0),
(31, 'First Aid', 38, NULL, 7, NULL, 0),
(32, 'CPR', 38, NULL, 7, NULL, 0),
(33, 'Herbicide / Pesticide', 38, NULL, 7, NULL, 0),
(34, 'Fire Drills Training', 38, NULL, 7, NULL, 0),
(35, 'Airport Familiarization, Markings, and Lighting', 28, NULL, 8, NULL, 0),
(36, 'Procedures for Pedestriations and Ground Vehicles', 28, NULL, 8, NULL, 0),
(37, 'Airport Communications', 16, NULL, 8, NULL, 0),
(38, 'Wildlife Hazard Management', 16, NULL, 8, NULL, 0),
(39, 'Airport Familiazation, Markings, and Lighting', 28, NULL, 4, NULL, 0),
(40, 'Procedures for Ground Vehicles and Personnel', 28, NULL, 4, NULL, 0),
(41, 'Airport Communications', 16, NULL, 4, NULL, 0),
(42, 'Airport Familiariation, Markings, and Lighting', 28, NULL, 5, NULL, 0),
(43, 'Procedures for Pedistriants and Ground Vehicles', 28, NULL, 5, NULL, 0),
(44, 'Airport Communication', 16, NULL, 5, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_303_sub_c_c`
--

CREATE TABLE IF NOT EXISTS `tbl_139_303_sub_c_c` (
  `conditions_checklists_id` int(10) NOT NULL auto_increment,
  `conditions_checklists_condition_cb_int` int(10) default NULL,
  `conditions_checklists_condition_cb_txt` varchar(255) default NULL,
  `conditions_checklists_inspection_cb_int` int(10) default NULL,
  `conditions_checklists_inspection_cb_txt` varchar(50) default NULL,
  `conditions_checklist_discrepancy_yn` tinyint(1) NOT NULL default '0',
  `conditions_checklist_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`conditions_checklists_id`),
  KEY `conditions_checklists_condition_cb_int` (`conditions_checklists_condition_cb_int`),
  KEY `conditions_checklists_inspection_cb_int` (`conditions_checklists_inspection_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_303_sub_c_c`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_303_sub_c_f`
--

CREATE TABLE IF NOT EXISTS `tbl_139_303_sub_c_f` (
  `facility_id` int(10) NOT NULL auto_increment,
  `facility_name` varchar(50) default NULL,
  `facility_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`facility_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `tbl_139_303_sub_c_f`
--

INSERT INTO `tbl_139_303_sub_c_f` (`facility_id`, `facility_name`, `facility_archived_yn`) VALUES
(1, '139.1', 0),
(2, '139.3', 0),
(3, '139.5', 0),
(4, '139.7', 0),
(5, '139.101', 0),
(6, '139.103', 0),
(7, '139.105', 0),
(8, '139.107', 0),
(9, '139.109', 0),
(10, '139.111', 0),
(11, '139.113', 0),
(12, '139.201', 0),
(13, '139.203', 0),
(14, '139.205', 0),
(15, '139.301', 0),
(16, '139.303', 0),
(17, '139.305', 0),
(18, '139.307', 0),
(19, '139.309', 0),
(20, '139.311', 0),
(21, '139.313', 0),
(22, '139.315', 0),
(23, '139.317', 0),
(24, '139.319', 0),
(25, '139.321', 0),
(26, '139.323', 0),
(27, '139.325', 0),
(28, '139.327', 0),
(29, '139.331', 0),
(30, '139.333', 0),
(31, '139.335', 0),
(32, '139.337', 0),
(33, '139.339', 0),
(34, '139.341', 0),
(35, '139.343', 0),
(36, '1542.2', 0),
(37, '1542.215', 0),
(38, 'CTY.StyMnl - Required', 0),
(39, 'CTY.StyMnl - Additional', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_303_sub_d`
--

CREATE TABLE IF NOT EXISTS `tbl_139_303_sub_d` (
  `Discrepancy_id` int(10) NOT NULL auto_increment,
  `discrepancy_checklist_id` int(10) default NULL,
  `Discrepancy_inspection_id` int(10) default NULL,
  `Discrepancy_by_cb_int` int(10) default NULL,
  `discrepancy_by_cb_text` varchar(255) default NULL,
  `Discrepancy_name` varchar(100) default NULL,
  `discrepancy_remarks` longtext,
  PRIMARY KEY  (`Discrepancy_id`),
  KEY `discrepancy_checklist_id` (`discrepancy_checklist_id`),
  KEY `Discrepancy_inspection_id` (`Discrepancy_inspection_id`),
  KEY `Discrepancy_by_cb_int` (`Discrepancy_by_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Not Used ???' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_303_sub_d`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_303_sub_sa`
--

CREATE TABLE IF NOT EXISTS `tbl_139_303_sub_sa` (
  `Discrepancy_id` int(10) NOT NULL auto_increment,
  `discrepancy_checklist_id` int(10) default NULL,
  `Discrepancy_inspection_id` int(10) default NULL,
  `Discrepancy_by_cb_int` int(10) default NULL,
  `discrepancy_by_cb_text` varchar(255) default NULL,
  `discrepancy_student_cb_int` int(11) default NULL,
  `discrepancy_student_cb_text` int(11) default NULL,
  PRIMARY KEY  (`Discrepancy_id`),
  KEY `discrepancy_checklist_id` (`discrepancy_checklist_id`),
  KEY `Discrepancy_inspection_id` (`Discrepancy_inspection_id`),
  KEY `Discrepancy_by_cb_int` (`Discrepancy_by_cb_int`),
  KEY `discrepancy_student_cb_int` (`discrepancy_student_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_303_sub_sa`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_303_sub_sa_a`
--

CREATE TABLE IF NOT EXISTS `tbl_139_303_sub_sa_a` (
  `discrepancy_archeived_id` int(10) NOT NULL auto_increment,
  `discrepancy_archeived_inspection_id` int(10) default NULL,
  `discrepancy_archieved_by_cb_int` int(10) default NULL,
  `discrepancy_archieved_by_cb_txt` varchar(255) default NULL,
  `discrepancy_archieved_reason` longtext,
  `discrepancy_archieved_date` date default NULL,
  `discrepancy_archieved_time` time default NULL,
  `discrepancy_archieved_yn` tinyint(1) NOT NULL,
  `discrepancy_archieved_timestamp` timestamp NULL default CURRENT_TIMESTAMP,
  `discrepancy_archieved_signature` longblob,
  PRIMARY KEY  (`discrepancy_archeived_id`),
  KEY `discrepancy_id` (`discrepancy_archeived_inspection_id`),
  KEY `discrepancy_archieved_by_cb_int` (`discrepancy_archieved_by_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_303_sub_sa_a`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_303_sub_t`
--

CREATE TABLE IF NOT EXISTS `tbl_139_303_sub_t` (
  `inspection_type_id` int(10) NOT NULL auto_increment,
  `inspection_type` varchar(200) default NULL,
  `inspection_type_short_name` varchar(50) default NULL,
  `inspection_type_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`inspection_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_139_303_sub_t`
--

INSERT INTO `tbl_139_303_sub_t` (`inspection_type_id`, `inspection_type`, `inspection_type_short_name`, `inspection_type_archived_yn`) VALUES
(1, 'Airport Rescue and Fire Fighting Training', 'ARFF Training', 0),
(2, 'Operations Personnel Training', 'Ops Training', 0),
(3, 'Law Enforcement Officer Training', 'LEO Training', 0),
(4, 'Airport Tenant Training', 'Tenant Training', 0),
(5, 'Seasonal Farmer Training', 'Farmer Training', 0),
(6, 'Airport Security Cordinator', 'ASC Training', 0),
(7, 'City - Safety Meeting', 'Safety', 0),
(8, 'Airport - Part Time Employee', 'Apt/Pt', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_303_sub_t_i`
--

CREATE TABLE IF NOT EXISTS `tbl_139_303_sub_t_i` (
  `139327_sub_t_i_id` int(10) NOT NULL auto_increment,
  `139327_sub_t_id_int` int(10) default NULL,
  `139327_sub_t_id_text` varchar(50) default NULL,
  `139327_sub_t_image` text,
  `139327_type_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`139327_sub_t_i_id`),
  KEY `139327_sub_t_id_int` (`139327_sub_t_id_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_139_303_sub_t_i`
--

INSERT INTO `tbl_139_303_sub_t_i` (`139327_sub_t_i_id`, `139327_sub_t_id_int`, `139327_sub_t_id_text`, `139327_sub_t_image`, `139327_type_archived_yn`) VALUES
(1, 2, NULL, 'alp_inspection_new4.gif', 0),
(2, 1, NULL, 'alp_inspection_new4.gif', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_327_main`
--

CREATE TABLE IF NOT EXISTS `tbl_139_327_main` (
  `inspection_system_id` int(10) NOT NULL auto_increment,
  `type_of_inspection_cb_int` int(10) default NULL,
  `type_of_inspection_cb_txt` longtext,
  `inspection_completed_by_cb_int` int(10) default NULL,
  `inspection_completed_by_cb_txt` varchar(50) default NULL,
  `inspecton_inspector_signature` longblob,
  `139327_date` date default NULL,
  `139327_time` time default NULL,
  `139327_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`inspection_system_id`),
  KEY `type_of_inspection_cb_int` (`type_of_inspection_cb_int`),
  KEY `inspection_completed_by_cb_int` (`inspection_completed_by_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_327_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_327_sub_a`
--

CREATE TABLE IF NOT EXISTS `tbl_139_327_sub_a` (
  `archived_id` int(10) NOT NULL auto_increment,
  `archived_inspection_id` int(10) default NULL,
  `archived_by_cb_int` int(10) default NULL,
  `archived_by_cb_txt` varchar(50) default NULL,
  `archived_reason` longtext,
  `archived_yn` tinyint(1) NOT NULL,
  `archived_date` date default NULL,
  `archived_time` time default NULL,
  `archived_signature` longblob,
  `archived_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`archived_id`),
  KEY `archieved_inspection_id` (`archived_inspection_id`),
  KEY `archived_by_cb_int` (`archived_by_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_327_sub_a`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_327_sub_c`
--

CREATE TABLE IF NOT EXISTS `tbl_139_327_sub_c` (
  `conditions_id` int(10) NOT NULL auto_increment,
  `condition_name` varchar(50) default NULL,
  `condition_facility_cb_int` int(10) default NULL,
  `condition_facility_cb_txt` varchar(255) default NULL,
  `condition_type_cb_int` int(10) default NULL,
  `condition_type_cb_txt` varchar(255) default NULL,
  `condition_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`conditions_id`),
  KEY `condition_facility_cb_int` (`condition_facility_cb_int`),
  KEY `condition_type_cb_int` (`condition_type_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `tbl_139_327_sub_c`
--

INSERT INTO `tbl_139_327_sub_c` (`conditions_id`, `condition_name`, `condition_facility_cb_int`, `condition_facility_cb_txt`, `condition_type_cb_int`, `condition_type_cb_txt`, `condition_archived_yn`) VALUES
(1, 'Pavement Lip Over 3"', 1, 'Pavement Areas', 1, 'Regularly Scheduled Inspection Checklist', 0),
(2, 'Hole 5" Diameter 3" Deep', 1, 'Pavement Areas', 1, 'Regularly Scheduled Inspection Checklist', 0),
(3, 'Cracks / Spalling / Bumps', 1, 'Pavement Areas', 1, 'Regularly Scheduled Inspection Checklist', 0),
(4, 'FOD : Gravel / Debris / Etc.', 1, 'Pavement Areas', 1, 'Regularly Scheduled Inspection Checklist', 0),
(5, 'Rubber Deposits', 1, 'Pavement Areas', 1, 'Regularly Scheduled Inspection Checklist', 0),
(6, 'Ponding / Edge Dams', 1, 'Pavement Areas', 1, 'Regularly Scheduled Inspection Checklist', 0),
(7, 'Ruts / Humps / Erosion', 2, 'Safety Areas', 1, 'Regularly Scheduled Inspection Checklist', 0),
(8, 'Drainage / Construction', 2, 'Safety Areas', 1, 'Regularly Scheduled Inspection Checklist', 0),
(9, 'Objects / Frangible Bases', 2, 'Safety Areas', 1, 'Regularly Scheduled Inspection Checklist', 0),
(10, 'Visible / Standard', 3, 'Markings and Signs', 1, 'Regularly Scheduled Inspection Checklist', 0),
(11, 'Hold Lines / Signs', 3, 'Markings and Signs', 1, 'Regularly Scheduled Inspection Checklist', 0),
(12, 'Frangible Signs', 3, 'Markings and Signs', 1, 'Regularly Scheduled Inspection Checklist', 0),
(13, 'Obscured / Dirty / Faded', 4, 'Lighting', 1, 'Regularly Scheduled Inspection Checklist', 0),
(14, 'Damaged / Missing', 4, 'Lighting', 1, 'Regularly Scheduled Inspection Checklist', 0),
(15, 'Inoperative', 4, 'Lighting', 1, 'Regularly Scheduled Inspection Checklist', 0),
(16, 'Faulty Aim / Adjustment', 4, 'Lighting', 1, 'Regularly Scheduled Inspection Checklist', 0),
(17, 'Rotating Beacon', 5, 'Navigational Aids', 1, 'Regularly Scheduled Inspection Checklist', 0),
(18, 'Wind Indicators', 5, 'Navigational Aids', 1, 'Regularly Scheduled Inspection Checklist', 0),
(19, 'REIL / VASI Systems', 5, 'Navigational Aids', 1, 'Regularly Scheduled Inspection Checklist', 0),
(20, 'Obstruction Lights', 6, 'Obstructions', 1, 'Regularly Scheduled Inspection Checklist', 0),
(21, 'Cranes / Trees', 6, 'Obstructions', 1, 'Regularly Scheduled Inspection Checklist', 0),
(22, 'Surface Conditions', 7, 'Snow and Ice', 1, 'Regularly Scheduled Inspection Checklist', 0),
(23, 'Snowbank Clearance', 7, 'Snow and Ice', 1, 'Regularly Scheduled Inspection Checklist', 0),
(24, 'Lights and Signs Obscured', 7, 'Snow and Ice', 1, 'Regularly Scheduled Inspection Checklist', 0),
(25, 'NAVAIDS / Fire Access', 7, 'Snow and Ice', 1, 'Regularly Scheduled Inspection Checklist', 0),
(26, 'Barricades / Lights', 8, 'Construction', 1, 'Regularly Scheduled Inspection Checklist', 0),
(27, 'Equipment Parking', 8, 'Construction', 1, 'Regularly Scheduled Inspection Checklist', 0),
(28, 'Fencing / Gates', 10, 'Public Protection', 1, 'Regularly Scheduled Inspection Checklist', 0),
(29, 'Signs', 10, 'Public Protection', 1, 'Regularly Scheduled Inspection Checklist', 0),
(30, 'Dead Birds', 11, 'Wildlife Hazards', 1, 'Regularly Scheduled Inspection Checklist', 0),
(31, 'Flocks of Birds / Animals', 11, 'Wildlife Hazards', 1, 'Regularly Scheduled Inspection Checklist', 0),
(32, 'Equipment / Crew Avilable', 9, 'ARFF', 1, 'Regularly Scheduled Inspection Checklist', 0),
(33, 'Communications / Alarm', 9, 'ARFF', 1, 'Regularly Scheduled Inspection Checklist', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_327_sub_c_c`
--

CREATE TABLE IF NOT EXISTS `tbl_139_327_sub_c_c` (
  `conditions_checklists_id` int(10) NOT NULL auto_increment,
  `conditions_checklists_condition_cb_int` int(10) default NULL,
  `conditions_checklists_condition_cb_txt` varchar(255) default NULL,
  `conditions_checklists_inspection_cb_int` int(10) default NULL,
  `conditions_checklists_inspection_cb_txt` varchar(50) default NULL,
  `conditions_checklist_discrepancy_yn` tinyint(1) NOT NULL default '0',
  `conditions_checklist_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`conditions_checklists_id`),
  KEY `conditions_checklists_condition_cb_int` (`conditions_checklists_condition_cb_int`),
  KEY `conditions_checklists_inspection_cb_int` (`conditions_checklists_inspection_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_327_sub_c_c`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_327_sub_c_f`
--

CREATE TABLE IF NOT EXISTS `tbl_139_327_sub_c_f` (
  `facility_id` int(10) NOT NULL auto_increment,
  `facility_name` varchar(50) default NULL,
  `facility_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`facility_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_139_327_sub_c_f`
--

INSERT INTO `tbl_139_327_sub_c_f` (`facility_id`, `facility_name`, `facility_archived_yn`) VALUES
(1, 'Pavement Areas', 0),
(2, 'Safety Areas', 0),
(3, 'Markings and Signs', 0),
(4, 'Lighting', 0),
(5, 'Navigational Aids', 0),
(6, 'Obstructions', 0),
(7, 'Snow and Ice', 0),
(8, 'Construction', 0),
(9, 'ARFF', 0),
(10, 'Public Protection', 0),
(11, 'Wildlife Hazards', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_327_sub_d`
--

CREATE TABLE IF NOT EXISTS `tbl_139_327_sub_d` (
  `Discrepancy_id` int(10) NOT NULL auto_increment,
  `discrepancy_checklist_id` int(10) default NULL,
  `Discrepancy_inspection_id` int(10) default NULL,
  `Discrepancy_by_cb_int` int(10) default NULL,
  `discrepancy_by_cb_text` varchar(255) default NULL,
  `Discrepancy_name` varchar(100) default NULL,
  `discrepancy_remarks` longtext,
  `Discrepancy_date` date default NULL,
  `Discrepancy_time` time default NULL,
  `discrepancy_timestamp` timestamp NULL default CURRENT_TIMESTAMP,
  `Discrepancy_location_x` int(10) default NULL,
  `Discrepancy_location_y` int(10) default NULL,
  `discrepancy_priority` varchar(50) default NULL,
  `discrepancy_quadrent` int(10) default NULL,
  `discrepancy_enteredonpda` tinyint(1) NOT NULL default '0',
  `discrepancy_photo` longblob,
  `discrepancy_sketch` longblob,
  `discrepancy_signature` longblob,
  PRIMARY KEY  (`Discrepancy_id`),
  KEY `discrepancy_checklist_id` (`discrepancy_checklist_id`),
  KEY `Discrepancy_inspection_id` (`Discrepancy_inspection_id`),
  KEY `Discrepancy_by_cb_int` (`Discrepancy_by_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_327_sub_d`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_327_sub_d_a`
--

CREATE TABLE IF NOT EXISTS `tbl_139_327_sub_d_a` (
  `discrepancy_archeived_id` int(10) NOT NULL auto_increment,
  `discrepancy_archeived_inspection_id` int(10) default NULL,
  `discrepancy_archieved_by_cb_int` int(10) default NULL,
  `discrepancy_archieved_by_cb_txt` varchar(255) default NULL,
  `discrepancy_archieved_reason` longtext,
  `discrepancy_archieved_date` date default NULL,
  `discrepancy_archieved_time` time default NULL,
  `discrepancy_archieved_yn` tinyint(1) NOT NULL,
  `discrepancy_archieved_timestamp` timestamp NULL default CURRENT_TIMESTAMP,
  `discrepancy_archieved_signature` longblob,
  PRIMARY KEY  (`discrepancy_archeived_id`),
  KEY `discrepancy_id` (`discrepancy_archeived_inspection_id`),
  KEY `discrepancy_archieved_by_cb_int` (`discrepancy_archieved_by_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_327_sub_d_a`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_327_sub_d_b`
--

CREATE TABLE IF NOT EXISTS `tbl_139_327_sub_d_b` (
  `discrepancy_bounced_id` int(50) NOT NULL auto_increment,
  `discrepancy_bounced_inspection_id` int(10) default NULL,
  `discrepancy_bounced_by_cb_int` int(10) default NULL,
  `discrepancy_bounced_by_cb_txt` varchar(255) default NULL,
  `discrepancy_bounced_comments` longtext,
  `discrepancy_bounced_date` date default NULL,
  `discrepancy_bounced_time` time default NULL,
  `discrepancy_bounced_yn` tinyint(1) NOT NULL,
  `discrepancy_bounced_timestamp` timestamp NULL default CURRENT_TIMESTAMP,
  `discrepancy_bounced_signature` longblob,
  `discrepancy_bounced_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`discrepancy_bounced_id`),
  KEY `discrepancy_id` (`discrepancy_bounced_inspection_id`),
  KEY `discrepancy_bounced_by_cb_int` (`discrepancy_bounced_by_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_327_sub_d_b`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_327_sub_d_d`
--

CREATE TABLE IF NOT EXISTS `tbl_139_327_sub_d_d` (
  `discrepancy_duplicate_id` int(10) NOT NULL auto_increment,
  `discrepancy_duplicate_inspection_id` int(10) default NULL,
  `discrepancy_duplicate_by_cb_int` int(10) default NULL,
  `discrepancy_duplicate_by_cb_txt` varchar(255) default NULL,
  `discrepancy_duplicate_reason` longtext,
  `discrepancy_duplicate_number` int(10) default NULL,
  `discrepancy_duplicate_date` date default NULL,
  `discrepancy_duplicate_time` time default NULL,
  `discrepancy_duplicate_yn` tinyint(1) NOT NULL,
  `discrepancy_duplicate_timestamp` timestamp NULL default CURRENT_TIMESTAMP,
  `discrepancy_duplicate_signature` longblob,
  PRIMARY KEY  (`discrepancy_duplicate_id`),
  KEY `discrepancy_id` (`discrepancy_duplicate_inspection_id`),
  KEY `discrepancy_duplicate_by_cb_int` (`discrepancy_duplicate_by_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_327_sub_d_d`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_327_sub_d_r`
--

CREATE TABLE IF NOT EXISTS `tbl_139_327_sub_d_r` (
  `discrepancy_repaired_id` int(10) NOT NULL auto_increment,
  `discrepancy_repaired_inspection_id` int(10) default NULL,
  `discrepancy_repaired_by_cb_int` int(10) default NULL,
  `discrepancy_repaired_by_cb_txt` varchar(255) default NULL,
  `discrepancy_repaired_comments` longtext,
  `discrepancy_repaired_date` date default NULL,
  `discrepancy_repaired_time` time default NULL,
  `discrepancy_repaired_yn` tinyint(1) NOT NULL,
  `discrepancy_repaired_timestamp` timestamp NULL default CURRENT_TIMESTAMP,
  `discrepancy_repaired_signature` longblob,
  `discrepancy_repaired_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`discrepancy_repaired_id`),
  KEY `discrepancy_id` (`discrepancy_repaired_inspection_id`),
  KEY `discrepancy_repaired_by_cb_int` (`discrepancy_repaired_by_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_327_sub_d_r`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_327_sub_e`
--

CREATE TABLE IF NOT EXISTS `tbl_139_327_sub_e` (
  `error_out_of_order_id` int(10) NOT NULL auto_increment,
  `error_out_of_order_inspection_id` int(10) default NULL,
  `error_out_of_order_by_cb_int` int(10) default NULL,
  `error_out_of_order_by_cb_txt` varchar(50) default NULL,
  `error_out_of_order_reason` longtext,
  `error_out_of_order_yn` tinyint(1) NOT NULL,
  `error_out_of_order_date` date default NULL,
  `error_out_of_order_time` time default NULL,
  `error_out_of_order_signature` longblob,
  `error_out_of_order_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`error_out_of_order_id`),
  KEY `error_out_of_order_inspection_id` (`error_out_of_order_inspection_id`),
  KEY `error_out_of_order_by_cb_int` (`error_out_of_order_by_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_327_sub_e`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_327_sub_t`
--

CREATE TABLE IF NOT EXISTS `tbl_139_327_sub_t` (
  `inspection_type_id` int(10) NOT NULL auto_increment,
  `inspection_type` varchar(200) default NULL,
  `inspection_type_short_name` varchar(50) default NULL,
  `inspection_type_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`inspection_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_139_327_sub_t`
--

INSERT INTO `tbl_139_327_sub_t` (`inspection_type_id`, `inspection_type`, `inspection_type_short_name`, `inspection_type_archived_yn`) VALUES
(1, 'Regularly Scheduled Inspection Checklist', 'RSI CL', 0),
(2, 'Continious Survellance of Airport Activites Checklist', 'CSAA CL', 0),
(3, 'Periodic Condition Evaluation Checklist', 'PCE CL', 0),
(4, 'Special Inspection Checklist', 'SP CL', 0),
(5, 'Pavement Condition Evaluation Checklist', 'PCE CL', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_327_sub_t_i`
--

CREATE TABLE IF NOT EXISTS `tbl_139_327_sub_t_i` (
  `139327_sub_t_i_id` int(10) NOT NULL auto_increment,
  `139327_sub_t_id_int` int(10) default NULL,
  `139327_sub_t_id_text` varchar(50) default NULL,
  `139327_sub_t_image` text,
  `139327_type_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`139327_sub_t_i_id`),
  KEY `139327_sub_t_id_int` (`139327_sub_t_id_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_139_327_sub_t_i`
--

INSERT INTO `tbl_139_327_sub_t_i` (`139327_sub_t_i_id`, `139327_sub_t_id_int`, `139327_sub_t_id_text`, `139327_sub_t_image`, `139327_type_archived_yn`) VALUES
(1, 2, NULL, 'alp_inspection_new4_current.gif', 0),
(2, 1, NULL, 'alp_inspection_new4_current.gif', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_337_main`
--

CREATE TABLE IF NOT EXISTS `tbl_139_337_main` (
  `139337_id` int(10) NOT NULL auto_increment,
  `139337_date` date NOT NULL,
  `139337_time` time NOT NULL,
  `139337_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `139337_author_by_cb_int` int(10) NOT NULL,
  `139337_author_by_cb_txt` text,
  `139337_species_cb_int` int(11) NOT NULL,
  `139337_species_cb_txt` text,
  `139337_activity_cb_int` int(11) NOT NULL,
  `139337_activity_cb_txt` text,
  `139337_action_cb_int` int(11) NOT NULL,
  `139337_action_cb_txt` text,
  `139337_numberofspecies` int(11) NOT NULL,
  `139337_resultsofaction` text,
  `139337_weather` text,
  `139337_locationx` int(11) NOT NULL,
  `139337_locationy` int(11) NOT NULL,
  `139337_archived_yn` tinyint(4) NOT NULL default '0',
  `139337_metar` text,
  PRIMARY KEY  (`139337_id`),
  KEY `139337_author_by_cb_int` (`139337_author_by_cb_int`),
  KEY `139337_species_cb_int` (`139337_species_cb_int`),
  KEY `139337_activity_cb_int` (`139337_activity_cb_int`),
  KEY `139337_action_cb_int` (`139337_action_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_337_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_337_sub_an`
--

CREATE TABLE IF NOT EXISTS `tbl_139_337_sub_an` (
  `139337_sub_an_id` int(11) NOT NULL auto_increment,
  `139337_sub_an_name` text,
  `139337_sub_an_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`139337_sub_an_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_139_337_sub_an`
--

INSERT INTO `tbl_139_337_sub_an` (`139337_sub_an_id`, `139337_sub_an_name`, `139337_sub_an_archived_yn`) VALUES
(1, 'Shot', 0),
(2, 'Posioned', 0),
(3, 'Hazed', 0),
(4, 'Trapped', 0),
(5, 'Observed', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_337_sub_ay`
--

CREATE TABLE IF NOT EXISTS `tbl_139_337_sub_ay` (
  `139337_sub_ay_id` int(11) NOT NULL auto_increment,
  `139337_sub_ay_name` text,
  `139337_sub_ay_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`139337_sub_ay_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_139_337_sub_ay`
--

INSERT INTO `tbl_139_337_sub_ay` (`139337_sub_ay_id`, `139337_sub_ay_name`, `139337_sub_ay_archived_yn`) VALUES
(1, 'Grazing', 0),
(2, 'Flying in the area', 0),
(3, 'Sitting', 0),
(4, 'Trapped', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_337_sub_s`
--

CREATE TABLE IF NOT EXISTS `tbl_139_337_sub_s` (
  `139337_sub_s_id` int(11) NOT NULL auto_increment,
  `139337_sub_s_name` text,
  `139337_sub_s_archived_yn` tinyint(4) default '0',
  `139337_sub_s_statepermit` tinyint(1) default '0',
  `139337_sub_s_federalpermit` tinyint(1) default '0',
  `139337_sub_s_category` text,
  PRIMARY KEY  (`139337_sub_s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `tbl_139_337_sub_s`
--

INSERT INTO `tbl_139_337_sub_s` (`139337_sub_s_id`, `139337_sub_s_name`, `139337_sub_s_archived_yn`, `139337_sub_s_statepermit`, `139337_sub_s_federalpermit`, `139337_sub_s_category`) VALUES
(2, 'Pheasant', 0, 1, 0, 'Resident Game Birds'),
(3, 'Grouse', 0, 1, 0, 'Resident Game Birds'),
(4, 'Quail', 0, 1, 0, 'Resident Game Birds'),
(5, 'Partridge', 0, 1, 0, 'Resident Game Birds'),
(6, 'Turkey', 0, 1, 0, 'Resident Game Birds'),
(7, 'Starlings', 0, 0, 0, 'Resident Non Game Birds'),
(8, 'House Sparrow', 0, 0, 0, 'Resident Non Game Birds'),
(9, 'Rock Dove (feral pigeon)', 0, 0, 0, 'Resident Non Game Birds'),
(10, 'Ducks', 0, 1, 1, 'Migratory Game Birds'),
(11, 'Geese', 0, 1, 1, 'Migratory Game Birds'),
(12, 'Coots', 0, 1, 1, 'Migratory Game Birds'),
(13, 'Snipe', 0, 1, 1, 'Migratory Game Birds'),
(14, 'Sandhill Crane', 0, 1, 1, 'Migratory Game Birds'),
(15, 'Woodcock', 0, 1, 1, 'Migratory Game Birds'),
(16, 'Crows', 0, 1, 1, 'Migratory Game Birds'),
(17, 'Mourning Doves', 0, 1, 1, 'Migratory Game Birds'),
(18, 'Grackels', 0, 0, 0, 'Depredation Order Birds'),
(19, 'Blackbirds', 0, 0, 0, 'Depredation Order Birds'),
(20, 'Cowbirds', 0, 0, 0, 'Depredation Order Birds'),
(21, 'Deer', 0, 1, 0, 'Game Mammals'),
(22, 'Elk', 0, 1, 0, 'Game Mammals'),
(23, 'Antelope', 0, 1, 0, 'Game Mammals'),
(24, 'Bighorn Sheep', 0, 1, 0, 'Game Mammals'),
(25, 'Mountain Goat', 0, 1, 0, 'Game Mammals'),
(27, 'Moose', 0, 1, 0, 'Game Mammals'),
(28, 'Tree Squirrels', 0, 1, 0, 'Game Mammals'),
(29, 'Cottontail Rabbit', 0, 1, 0, 'Game Mammals'),
(30, 'Coyote', 0, 0, 0, 'Predators/Varmits'),
(31, 'Red Fox', 0, 0, 0, 'Predators/Varmits'),
(32, 'Gray Fox', 0, 0, 0, 'Predators/Varmits'),
(33, 'Skunks', 0, 0, 0, 'Predators/Varmits'),
(34, 'Gophers', 0, 0, 0, 'Predators/Varmits'),
(35, 'Ground Squirrels', 0, 0, 0, 'Predators/Varmits'),
(36, 'Chipmunks', 0, 0, 0, 'Predators/Varmits'),
(38, 'Jack Rabbits', 0, 0, 0, 'Predators/Varmits'),
(39, 'Marmots', 0, 0, 0, 'Predators/Varmits'),
(40, 'Porcupine', 0, 0, 0, 'Predators/Varmits'),
(41, 'Prairie Dog', 0, 0, 0, 'Predators/Varmits'),
(42, 'Raccoon', 0, 1, 0, 'Furbearers'),
(44, 'Badger', 0, 1, 0, 'Furbearers'),
(45, 'Muskrat', 0, 1, 0, 'Furbearers'),
(46, 'Bobcat', 0, 1, 0, 'Furbearers'),
(47, 'Weasel', 0, 1, 0, 'Furbearers'),
(48, 'Mink', 0, 1, 0, 'Furbearers'),
(49, 'Opossum', 0, 1, 0, 'Furbearers'),
(50, 'Lynx', 0, 1, 0, 'Protected Furbearers'),
(51, 'Wolf', 0, 1, 0, 'Protected Furbearers'),
(52, 'Swift Fox', 0, 1, 0, 'Protected Furbearers'),
(53, 'Black Bear', 0, 1, 0, 'Protected Furbearers'),
(54, 'Pine Marten', 0, 1, 0, 'Protected Furbearers'),
(55, 'Fisher', 0, 1, 0, 'Protected Furbearers'),
(56, 'River Otter', 0, 1, 0, 'Protected Furbearers'),
(57, 'Mountain Lion', 0, 1, 0, 'Protected Furbearers'),
(58, 'Black-Footed Ferret', 0, 1, 0, 'Protected Furbearers'),
(60, 'Dog', 0, 0, 0, 'Feral Domestic Mammals'),
(61, 'Cats', 0, 0, 0, 'Feral Domestic Mammals'),
(62, 'Gulls: Franklin', 0, 1, 1, 'Migratory Nongame Bird'),
(63, 'Gulls: Herring', 0, 1, 1, 'Migratory Nongame Bird');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_main`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_main` (
  `139339_main_id` int(10) NOT NULL auto_increment,
  `139339_type_cb_int` int(10) default NULL,
  `139339_type_cb_txt` longtext,
  `139339_by_cb_int` int(10) default NULL,
  `139339_by_cb_txt` varchar(50) default NULL,
  `139339_by_signature` longblob,
  `139339_date` date default NULL,
  `139339_time` time default NULL,
  `139339_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `139339_metar` text NOT NULL,
  `139339_notes` longtext NOT NULL,
  PRIMARY KEY  (`139339_main_id`),
  KEY `139339_type_cb_int` (`139339_type_cb_int`),
  KEY `139339_by_cb_int` (`139339_by_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_339_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_main_t`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_main_t` (
  `139339_main_t_id` int(10) NOT NULL auto_increment,
  `139339_main_t_name` text,
  `139339_main_t_purpose` longtext NOT NULL,
  `139339_main_t_type_cb_int` int(10) default NULL,
  `139339_main_t_type_cb_txt` longtext,
  `139339_main_t_notes` longtext NOT NULL,
  `139339_main_t_a_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`139339_main_t_id`),
  KEY `139339_main_t_type_cb_int` (`139339_main_t_type_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tbl_139_339_main_t`
--

INSERT INTO `tbl_139_339_main_t` (`139339_main_t_id`, `139339_main_t_name`, `139339_main_t_purpose`, `139339_main_t_type_cb_int`, `139339_main_t_type_cb_txt`, `139339_main_t_notes`, `139339_main_t_a_yn`) VALUES
(1, 'Clear and Dry - Mu Values over 45', 'Use this template when the field is clear and Dry with Mu values all over 45.', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 1),
(2, 'Clear and Wet - Mu Values over 45', 'Use this template when the field is wet but there are no contamints. All Mu Values are over 45.', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 1),
(3, 'All Surfaces Closed', 'Use this template when all surfaces are closed.', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 1),
(4, 'Snow Operations are under Effect - Basic Template', 'use this template when you are entering a field condition report during snow removal operations.', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 1),
(8, 'Patchy Thin Snow - Mu Values Greater than 45', 'General Purpose Template for use when the field has patchy thin snow with mu values greater than 45. Please change all fields to their actual values before submitting the report.', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 1),
(9, 'Patchy thins snow (all surfaces) - Mu values greater than 45', 'Use this template for general patchy thin snow on all surfaces', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 1),
(10, 'Clear and Dry (all surfaces) - Mu Values over 45', 'Use this most often', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 1),
(11, 'Light Snow (all surfaces) - LowMid Mu Values', 'For Light snow on all surfaces and low to mid mu values', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 1),
(12, 'Blowing Snow on all surfaces - Mus greater than 45', 'For use when there is blowing snow on all surface with mu values greater than 45', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 1),
(13, 'Clear and Wet (all surfaces) - Mu Over 45', 'Clear and Wet with Mu Valeus over 45', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 1),
(14, '30''s &40''s thn sno', 'ease', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 1),
(15, 'thn slush 40"s', 'fun', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 1),
(16, 'rw 30''s tw 20''s', 'ya', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 1),
(17, 'Clear and Dry - All Surfaces - No Mus', 'When clear and dry durring summer', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 0),
(18, 'thn slush 30''s', 'fun', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 0),
(19, 'Thin Slush w/Sand', 'Used for Thin slush and Sand', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 0),
(20, 'Clear/Wet/P1_Sanded - Mu >=45', 'use this template when all Priority One Zones have been or still have sand on them. Mu Values are all over 45.', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 0),
(21, 'thn sno 30''s', 'ease', 1, NULL, 'Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_main_t_cc`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_main_t_cc` (
  `139339_t_cc_id` int(10) NOT NULL auto_increment,
  `139339_t_cc_c_cb_int` int(10) default NULL,
  `139339_t_cc_c_cb_txt` varchar(255) default NULL,
  `139339_t_cc_ficon_cb_int` int(10) default NULL,
  `139339_t_cc_ficon_cb_txt` varchar(50) default NULL,
  `139339_t_cc_d_yn` text,
  `139339_t_cc_a_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`139339_t_cc_id`),
  KEY `139339_cc_c_cb_int` (`139339_t_cc_c_cb_int`),
  KEY `139339_cc_ficon_cb_int` (`139339_t_cc_ficon_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_339_main_t_cc`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_sub_a`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_sub_a` (
  `139339_a_id` int(10) NOT NULL auto_increment,
  `139339_a_inspection_id` int(10) default NULL,
  `139339_a_by_cb_int` int(10) default NULL,
  `139339_a_by_cb_txt` varchar(50) default NULL,
  `139339_a_reason` longtext,
  `139339_a_yn` tinyint(1) NOT NULL,
  `139339_a_date` date default NULL,
  `139339_a_time` time default NULL,
  `139339_a_signature` longblob,
  `139339_a_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`139339_a_id`),
  KEY `139339_a_by_cb_int` (`139339_a_by_cb_int`),
  KEY `139339_a_inspection_id` (`139339_a_inspection_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_339_sub_a`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_sub_c`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_sub_c` (
  `139339_c_id` int(10) NOT NULL auto_increment,
  `139339_c_name` varchar(50) default NULL,
  `139339_c_facility_cb_int` int(10) default NULL,
  `139339_c_facility_cb_txt` varchar(255) default NULL,
  `139339_c_type_cb_int` int(10) default NULL,
  `139339_c_type_cb_txt` varchar(255) default NULL,
  `139339_c_archived_yn` tinyint(1) NOT NULL default '0',
  `139339_cc_type` tinyint(1) NOT NULL,
  `139339_cc_xloc` int(11) default NULL,
  `139339_cc_yloc` int(11) default NULL,
  `139339_c_order` int(10) default NULL,
  PRIMARY KEY  (`139339_c_id`),
  KEY `139339_c_type_cb_int` (`139339_c_type_cb_int`),
  KEY `139339_c_facility_cb_int` (`139339_c_facility_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `tbl_139_339_sub_c`
--

INSERT INTO `tbl_139_339_sub_c` (`139339_c_id`, `139339_c_name`, `139339_c_facility_cb_int`, `139339_c_facility_cb_txt`, `139339_c_type_cb_int`, `139339_c_type_cb_txt`, `139339_c_archived_yn`, `139339_cc_type`, `139339_cc_xloc`, `139339_cc_yloc`, `139339_c_order`) VALUES
(1, 'x1230MuT 1', 4, NULL, 1, NULL, 0, 0, 1, NULL, NULL),
(2, 'x1230MuT 2', 4, NULL, 1, NULL, 0, 0, 2, NULL, NULL),
(3, 'x1230MuT 3', 4, NULL, 1, NULL, 0, 0, 3, NULL, NULL),
(4, 'y1230MuM 1', 4, NULL, 1, NULL, 0, 0, 4, NULL, NULL),
(5, 'y1230MuM 2', 4, NULL, 1, NULL, 0, 0, 5, NULL, NULL),
(6, 'y1230MuM 3', 4, NULL, 1, NULL, 0, 0, 6, NULL, NULL),
(7, 'z1230MuR 1', 4, NULL, 1, NULL, 0, 0, 7, NULL, NULL),
(8, 'z1230MuR 2', 4, NULL, 1, NULL, 0, 0, 8, NULL, NULL),
(9, 'z1230MuR 3', 4, NULL, 1, NULL, 0, 0, 9, NULL, NULL),
(10, 'x1735MuT 1', 3, NULL, 1, NULL, 0, 0, 1, NULL, NULL),
(11, 'x1735MuT 2', 3, NULL, 1, NULL, 0, 0, 2, NULL, NULL),
(12, 'x1735MuT 3', 3, NULL, 1, NULL, 0, 0, 3, NULL, NULL),
(13, 'y1735MuM 1', 3, NULL, 1, NULL, 0, 0, 4, NULL, NULL),
(14, 'y1735MuM 2', 3, NULL, 1, NULL, 0, 0, 5, NULL, NULL),
(15, 'y1735MuM 3', 3, NULL, 1, NULL, 0, 0, 6, NULL, NULL),
(16, 'z1735MuR 1', 3, NULL, 1, NULL, 0, 0, 7, NULL, NULL),
(17, 'z1735MuR 2', 3, NULL, 1, NULL, 0, 0, 8, NULL, NULL),
(18, 'z1735MuR 3', 3, NULL, 1, NULL, 0, 0, 9, NULL, NULL),
(19, 'A - 1 Mu', 8, NULL, 1, NULL, 0, 0, NULL, NULL, NULL),
(20, 'A - 2 Mu', 9, NULL, 1, NULL, 0, 0, NULL, NULL, NULL),
(21, 'A - 3 Mu', 10, NULL, 1, NULL, 0, 0, NULL, NULL, NULL),
(22, 'A - 4 Mu', 11, NULL, 1, NULL, 0, 0, NULL, NULL, NULL),
(23, 'B Mu', 6, NULL, 1, NULL, 0, 0, NULL, NULL, NULL),
(24, 'C - 1 Mu', 12, NULL, 1, NULL, 0, 0, NULL, NULL, NULL),
(25, 'A Mu', 5, NULL, 1, NULL, 0, 0, NULL, NULL, NULL),
(26, 'C Mu', 7, NULL, 1, NULL, 0, 0, NULL, NULL, NULL),
(27, 'C - 2 Mu', 13, NULL, 1, NULL, 0, 0, NULL, NULL, NULL),
(28, 'Rwy 17 / 35 Condition', 3, NULL, 1, NULL, 0, 2, NULL, NULL, NULL),
(29, 'Rwy 12 / 30 Condition', 4, NULL, 1, NULL, 0, 2, NULL, NULL, NULL),
(30, 'A - 1 Condition', 8, NULL, 1, NULL, 0, 2, NULL, NULL, NULL),
(31, 'A - 2 Condition', 9, NULL, 1, NULL, 0, 2, NULL, NULL, NULL),
(32, 'A - 4 Condition', 11, NULL, 1, NULL, 0, 2, NULL, NULL, NULL),
(33, 'A - 3 Condition', 10, NULL, 1, NULL, 0, 2, NULL, NULL, NULL),
(34, 'B Condition', 6, NULL, 1, NULL, 0, 2, NULL, NULL, NULL),
(35, 'C Condition', 7, NULL, 1, NULL, 0, 2, NULL, NULL, NULL),
(36, 'C - 1 Condition', 12, NULL, 1, NULL, 0, 2, NULL, NULL, NULL),
(37, 'C - 2 Condition', 13, NULL, 1, NULL, 0, 2, NULL, NULL, NULL),
(38, 'Rwy 12 / 30 Closed', 4, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(39, 'Rwy 17 / 35 Closed', 3, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(40, 'A Closed', 5, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(41, 'A - 1 Closed', 8, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(42, 'A - 2 Closed', 9, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(43, 'A - 3 Closed', 10, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(44, 'A - 4 Closed', 11, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(45, 'B Closed', 6, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(46, 'C Closed', 7, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(47, 'C - 1 Closed', 12, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(48, 'C - 2 Closed', 13, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(49, 'A Condition', 5, NULL, 1, NULL, 0, 2, NULL, NULL, NULL),
(50, 'In Effect', 14, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(51, 'isfrom17', 15, NULL, 1, NULL, 0, 3, NULL, NULL, NULL),
(52, 'isfrom12', 16, NULL, 1, NULL, 0, 4, NULL, NULL, NULL),
(56, 'terminal ramp Mu', 18, NULL, 1, NULL, 0, 0, NULL, NULL, NULL),
(57, 'terminal ramp Condition', 18, NULL, 1, NULL, 0, 2, NULL, NULL, NULL),
(58, 'terminal ramp closed', 18, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(59, 'garamp Mu', 17, NULL, 1, NULL, 0, 0, NULL, NULL, NULL),
(60, 'garamp Condition', 17, NULL, 1, NULL, 0, 2, NULL, NULL, NULL),
(61, 'garamp closed', 17, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(62, 'cargoramp Mu', 19, NULL, 1, NULL, 0, 0, NULL, NULL, NULL),
(63, 'cargoramp Condition', 19, NULL, 1, NULL, 0, 2, NULL, NULL, NULL),
(64, 'cargoramp Closed', 19, NULL, 1, NULL, 0, 1, NULL, NULL, NULL),
(65, 'fboramp Mu', 20, NULL, 1, NULL, 0, 0, NULL, NULL, NULL),
(66, 'fboramp Condition', 20, NULL, 1, NULL, 0, 2, NULL, NULL, NULL),
(67, 'fboramp Closed', 20, NULL, 1, NULL, 0, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_sub_c_c`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_sub_c_c` (
  `139339_cc_id` int(10) NOT NULL auto_increment,
  `139339_cc_c_cb_int` int(10) default NULL,
  `139339_cc_c_cb_txt` varchar(255) default NULL,
  `139339_cc_ficon_cb_int` int(10) default NULL,
  `139339_cc_ficon_cb_txt` varchar(50) default NULL,
  `139339_cc_d_yn` text,
  `139339_cc_a_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`139339_cc_id`),
  KEY `139339_cc_c_cb_int` (`139339_cc_c_cb_int`),
  KEY `139339_cc_ficon_cb_int` (`139339_cc_ficon_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_339_sub_c_c`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_sub_c_f`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_sub_c_f` (
  `139339_f_id` int(10) NOT NULL auto_increment,
  `139339_f_name` varchar(50) default NULL,
  `139339_f_rwy_yn` tinyint(1) default '0',
  `139339_f_order` int(10) default NULL,
  `139339_f_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`139339_f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_139_339_sub_c_f`
--

INSERT INTO `tbl_139_339_sub_c_f` (`139339_f_id`, `139339_f_name`, `139339_f_rwy_yn`, `139339_f_order`, `139339_f_archived_yn`) VALUES
(3, 'Rwy 17 / 35', 1, 2, 0),
(4, 'Rwy 12 / 30', 1, 3, 0),
(5, 'Twy A', 0, 4, 0),
(6, 'Twy B', 0, 9, 0),
(7, 'Twy C', 0, 10, 0),
(8, 'Twy A - 1', 0, 5, 0),
(9, 'Twy A - 2', 0, 6, 0),
(10, 'Twy A - 3', 0, 7, 0),
(11, 'Twy A - 4', 0, 8, 0),
(12, 'Twy C - 1', 0, 11, 0),
(13, 'Twy C - 2', 0, 12, 0),
(14, 'Snow Operations', 0, 1, 0),
(15, 'Mus From 17 or From 35 ?', 2, 2, 0),
(16, 'Mus From 12 or From 30 ?', 2, 3, 0),
(17, 'G.A. Ramp', 0, 14, 0),
(18, 'Terminal Ramp', 0, 15, 0),
(19, 'Cargo Ramp', 0, 16, 0),
(20, 'FBO Ramp', 0, 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_sub_d`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_sub_d` (
  `Discrepancy_id` int(10) NOT NULL auto_increment,
  `discrepancy_checklist_id` int(10) default NULL,
  `Discrepancy_inspection_id` int(10) default NULL,
  `discrepancy_type_cb_int` int(11) NOT NULL,
  `discrepancy_type_cb_txt` text,
  `Discrepancy_by_cb_int` int(10) default NULL,
  `discrepancy_by_cb_text` varchar(255) default NULL,
  `Discrepancy_name` varchar(100) default NULL,
  `discrepancy_remarks` longtext,
  `Discrepancy_date` date default NULL,
  `Discrepancy_time` time default NULL,
  `discrepancy_timestamp` timestamp NULL default CURRENT_TIMESTAMP,
  `Discrepancy_location_x` int(10) default NULL,
  `Discrepancy_location_y` int(10) default NULL,
  `discrepancy_xpoints` longtext,
  `discrepancy_ypoints` longtext,
  `discrepancy_priority` varchar(50) default NULL,
  `discrepancy_quadrent` int(10) default NULL,
  `discrepancy_enteredonpda` tinyint(1) NOT NULL default '0',
  `discrepancy_photo` longblob,
  `discrepancy_sketch` longblob,
  `discrepancy_signature` longblob,
  PRIMARY KEY  (`Discrepancy_id`),
  KEY `discrepancy_checklist_id` (`discrepancy_checklist_id`),
  KEY `Discrepancy_inspection_id` (`Discrepancy_inspection_id`),
  KEY `Discrepancy_by_cb_int` (`Discrepancy_by_cb_int`),
  KEY `discrepancy_type_cb_int` (`discrepancy_type_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_339_sub_d`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_sub_e`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_sub_e` (
  `139339_eoo_id` int(10) NOT NULL auto_increment,
  `139339_eoo_i_id` int(10) default NULL,
  `139339_eoo_by_cb_int` int(10) default NULL,
  `139339_eoo_by_cb_txt` varchar(50) default NULL,
  `139339_eoo_reason` longtext,
  `139339_eoo_yn` tinyint(1) NOT NULL,
  `139339_eoo_date` date default NULL,
  `139339_eoo_time` time default NULL,
  `139339_eoo_signature` longblob,
  `139339_eoo_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`139339_eoo_id`),
  KEY `139339_eoo_by_cb_int` (`139339_eoo_by_cb_int`),
  KEY `139339_eoo_i_id` (`139339_eoo_i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_339_sub_e`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_sub_n`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_sub_n` (
  `139339_sub_n_id` int(10) NOT NULL auto_increment,
  `139339_sub_n_type_cb_int` int(10) default NULL,
  `139339_sub_n_type_cb_txt` longtext,
  `139339_sub_n_cancelled_id_int` int(11) default NULL,
  `139339_sub_n_by_cb_int` int(10) default NULL,
  `139339_sub_n_by_cb_txt` varchar(50) default NULL,
  `139339_sub_n_can_by_cb_int` int(11) default NULL,
  `139339_sub_n_can_by_cb_txt` text,
  `139339_sub_n_by_signature` longblob,
  `139339_sub_n_date` date default NULL,
  `139339_sub_n_wx_in` text,
  `139339_sub_n_fbo_in` text,
  `139339_sub_n_airline_in` text,
  `139339_sub_n_wx_out` text,
  `139339_sub_n_fbo_out` text,
  `139339_sub_n_airline_out` text,
  `139339_sub_n_time` time default NULL,
  `139339_sub_n_closed_yn` tinyint(1) NOT NULL default '0',
  `139339_sub_n_date_closed` date default NULL,
  `139339_sub_n_time_closed` time default NULL,
  `139339_sub_n_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `139339_sub_n_metar` text NOT NULL,
  `139339_sub_n_notes` longtext NOT NULL,
  `139339_sub_n_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`139339_sub_n_id`),
  KEY `139339_sub_n_type_cb_int` (`139339_sub_n_type_cb_int`),
  KEY `139339_sub_n_by_cb_int` (`139339_sub_n_by_cb_int`),
  KEY `139339_sub_n_cancelled_id_int` (`139339_sub_n_cancelled_id_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_339_sub_n`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_sub_n_a`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_sub_n_a` (
  `139339_a_id` int(10) NOT NULL auto_increment,
  `139339_a_inspection_id` int(10) default NULL,
  `139339_a_by_cb_int` int(10) default NULL,
  `139339_a_by_cb_txt` varchar(50) default NULL,
  `139339_a_reason` longtext,
  `139339_a_yn` tinyint(1) NOT NULL,
  `139339_a_date` date default NULL,
  `139339_a_time` time default NULL,
  `139339_a_signature` longblob,
  `139339_a_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`139339_a_id`),
  KEY `139339_a_by_cb_int` (`139339_a_by_cb_int`),
  KEY `139339_a_inspection_id` (`139339_a_inspection_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_339_sub_n_a`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_sub_n_cc`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_sub_n_cc` (
  `139339_cc_id` int(10) NOT NULL auto_increment,
  `139339_cc_c_cb_int` int(10) default NULL,
  `139339_cc_c_cb_txt` varchar(255) default NULL,
  `139339_cc_ficon_cb_int` int(10) default NULL,
  `139339_cc_ficon_cb_txt` varchar(50) default NULL,
  `139339_cc_d_yn` text,
  `139339_cc_a_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`139339_cc_id`),
  KEY `139339_cc_c_cb_int` (`139339_cc_c_cb_int`),
  KEY `139339_cc_ficon_cb_int` (`139339_cc_ficon_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_339_sub_n_cc`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_sub_n_d`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_sub_n_d` (
  `Discrepancy_id` int(10) NOT NULL auto_increment,
  `discrepancy_checklist_id` int(10) default NULL,
  `Discrepancy_inspection_id` int(10) default NULL,
  `discrepancy_type_cb_int` int(11) NOT NULL,
  `discrepancy_type_cb_txt` text,
  `Discrepancy_by_cb_int` int(10) default NULL,
  `discrepancy_by_cb_text` varchar(255) default NULL,
  `Discrepancy_name` varchar(100) default NULL,
  `discrepancy_remarks` longtext,
  `Discrepancy_date` date default NULL,
  `Discrepancy_time` time default NULL,
  `discrepancy_timestamp` timestamp NULL default CURRENT_TIMESTAMP,
  `Discrepancy_location_x` int(10) default NULL,
  `Discrepancy_location_y` int(10) default NULL,
  `discrepancy_xpoints` longtext,
  `discrepancy_ypoints` longtext,
  `discrepancy_priority` varchar(50) default NULL,
  `discrepancy_quadrent` int(10) default NULL,
  `discrepancy_enteredonpda` tinyint(1) NOT NULL default '0',
  `discrepancy_photo` longblob,
  `discrepancy_sketch` longblob,
  `discrepancy_signature` longblob,
  PRIMARY KEY  (`Discrepancy_id`),
  KEY `discrepancy_checklist_id` (`discrepancy_checklist_id`),
  KEY `Discrepancy_inspection_id` (`Discrepancy_inspection_id`),
  KEY `Discrepancy_by_cb_int` (`Discrepancy_by_cb_int`),
  KEY `discrepancy_type_cb_int` (`discrepancy_type_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Not Used ???' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_339_sub_n_d`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_sub_n_r`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_sub_n_r` (
  `139339_sub_n_r_id` int(10) NOT NULL auto_increment,
  `139339_sub_n_r_cancelled_id_int` int(11) default NULL,
  `139339_sub_n_r_by_cb_int` int(10) default NULL,
  `139339_sub_n_r_by_cb_txt` varchar(50) default NULL,
  `139339_sub_n_r_by_signature` longblob,
  `139339_sub_n_r_date` date default NULL,
  `139339_sub_n_r_wx_in` text,
  `139339_sub_n_r_fbo_in` text,
  `139339_sub_n_r_airline_in` text,
  `139339_sub_n_r_time` time default NULL,
  `139339_sub_n_r_closed_yn` tinyint(1) NOT NULL default '0',
  `139339_sub_nr__timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `139339_sub_n_r_notes` longtext NOT NULL,
  `139339_sub_n_r_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`139339_sub_n_r_id`),
  KEY `139339_sub_n_by_cb_int` (`139339_sub_n_r_by_cb_int`),
  KEY `139339_sub_n_cancelled_id_int` (`139339_sub_n_r_cancelled_id_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_139_339_sub_n_r`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_sub_t`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_sub_t` (
  `139339_type_id` int(10) NOT NULL auto_increment,
  `139339_type` varchar(200) default NULL,
  `139339_type_short_name` varchar(50) default NULL,
  `139339_periodstart` date default NULL,
  `139339_periodend` date default NULL,
  `139339_type_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`139339_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_139_339_sub_t`
--

INSERT INTO `tbl_139_339_sub_t` (`139339_type_id`, `139339_type`, `139339_type_short_name`, `139339_periodstart`, `139339_periodend`, `139339_type_archived_yn`) VALUES
(1, '11/06/2007 - Current', 'Current', '2007-11-06', NULL, 0),
(2, 'Past - 11/6/2007', 'Past', '1970-01-01', '2007-10-01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_139_339_sub_t_i`
--

CREATE TABLE IF NOT EXISTS `tbl_139_339_sub_t_i` (
  `139339_sub_t_i_id` int(10) NOT NULL auto_increment,
  `139339_sub_t_id_int` int(10) default NULL,
  `139339_sub_t_id_text` varchar(50) default NULL,
  `139339_sub_t_image` text,
  `139339_type_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`139339_sub_t_i_id`),
  KEY `139339_sub_t_id_int` (`139339_sub_t_id_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_139_339_sub_t_i`
--

INSERT INTO `tbl_139_339_sub_t_i` (`139339_sub_t_i_id`, `139339_sub_t_id_int`, `139339_sub_t_id_text`, `139339_sub_t_image`, `139339_type_archived_yn`) VALUES
(1, 2, NULL, 'alp_inspection_new4.gif', 0),
(2, 1, NULL, 'alp_inspection_new4_current.gif', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_access_sub_a_k`
--

CREATE TABLE IF NOT EXISTS `tbl_access_sub_a_k` (
  `access_keys_id` int(11) NOT NULL auto_increment,
  `access_keys_date` date default NULL,
  `access_keys_time` time default NULL,
  `access_keys_by_cb_int` int(11) default NULL,
  `access_keys_by_cb_text` text,
  `access_keys_towhom_cb_int` int(11) default NULL,
  `access_keys_towhom_cb_text` text,
  `access_keys_fromwhom_cb_int` int(11) default NULL,
  `access_keys_fromwhom_cb_text` text,
  `access_keys_numberkeys_in` int(11) default NULL,
  `access_keys_numberkeys_out` int(11) default NULL,
  `access_keys_keytype_cb_int` int(11) default NULL,
  `access_keys_keytype_cb_text` text,
  `access_keys_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`access_keys_id`),
  KEY `access_keys_by_cb_int` (`access_keys_by_cb_int`),
  KEY `access_keys_towhom_cb_int` (`access_keys_towhom_cb_int`),
  KEY `access_keys_fromwhom_cb_int` (`access_keys_fromwhom_cb_int`),
  KEY `access_keys_keytype_cb_int` (`access_keys_keytype_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_access_sub_a_k`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_access_sub_a_pc`
--

CREATE TABLE IF NOT EXISTS `tbl_access_sub_a_pc` (
  `access_pc_id` int(11) NOT NULL auto_increment,
  `access_pc_date` date default NULL,
  `access_pc_time` time default NULL,
  `access_pc_by_cb_int` int(11) default NULL,
  `access_pc_by_cb_text` text,
  `access_pc_towhom_cb_int` int(11) default NULL,
  `access_pc_towhom_cb_text` text,
  `access_pc_fromwhom_cb_int` int(11) default NULL,
  `access_pc_fromwhom_cb_text` text,
  `access_pc_numberpc_in` int(11) default NULL,
  `access_pc_numberpc_out` int(11) default NULL,
  `access_pc_number` text COMMENT 'The number of the card(s)',
  `access_pc_keytype_cb_int` int(11) default NULL,
  `access_pc_keytype_cb_text` text,
  `access_pc_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`access_pc_id`),
  KEY `access_keys_by_cb_int` (`access_pc_by_cb_int`),
  KEY `access_keys_towhom_cb_int` (`access_pc_towhom_cb_int`),
  KEY `access_keys_fromwhom_cb_int` (`access_pc_fromwhom_cb_int`),
  KEY `access_keys_keytype_cb_int` (`access_pc_keytype_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_access_sub_a_pc`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_access_sub_a_v`
--

CREATE TABLE IF NOT EXISTS `tbl_access_sub_a_v` (
  `access_v_id` int(11) NOT NULL auto_increment,
  `access_v_date` date default NULL,
  `access_v_time` time default NULL,
  `access_v_by_cb_int` int(11) default NULL,
  `access_v_by_cb_text` text,
  `access_v_towhom_cb_int` int(11) default NULL,
  `access_v_towhom_cb_text` text,
  `access_v_make_txt` text,
  `access_v_model_txt` text,
  `access_v_year_txt` text,
  `access_v_color_txt` text,
  `access_v_plate_txt` text,
  `access_v_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`access_v_id`),
  KEY `access_keys_by_cb_int` (`access_v_by_cb_int`),
  KEY `access_keys_towhom_cb_int` (`access_v_towhom_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_access_sub_a_v`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_121_main`
--

CREATE TABLE IF NOT EXISTS `tbl_activity_121_main` (
  `activity_121_id` int(10) NOT NULL auto_increment COMMENT 'ID',
  `activity_121_date` date NOT NULL COMMENT 'Date',
  `activity_121_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT 'Auto Time',
  `activity_121_author_cb_int` int(10) default NULL COMMENT 'Entry By Int',
  `activity_121_author_cb_txt` text COMMENT 'Entry By Txt',
  `activity_121_sep` int(10) NOT NULL default '0' COMMENT 'Total Landings',
  `activity_121_sdp` int(10) NOT NULL default '0' COMMENT 'Total Lbs In',
  `activity_121_nrdp` int(10) NOT NULL default '0' COMMENT 'Total Lbs Out',
  `activity_121_nrep` int(10) NOT NULL default '0',
  `activity_121_avin` int(11) NOT NULL default '0',
  `activity_121_avout` int(11) NOT NULL default '0',
  `activity_121_operator_cb_int` int(10) default NULL COMMENT 'Operator Int',
  `activity_121_operator_cb_txt` text COMMENT 'Operator Txt',
  `activity_121_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`activity_121_id`),
  KEY `activity_121_author_cb_int` (`activity_121_author_cb_int`),
  KEY `activity_121_operator_cb_int` (`activity_121_operator_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_activity_121_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_121_sub_a`
--

CREATE TABLE IF NOT EXISTS `tbl_activity_121_sub_a` (
  `aircraft_activity_121_id` int(10) NOT NULL auto_increment,
  `aircraft_activity_121_type_cb_int` int(10) default NULL,
  `aircraft_activity_121_type_cb_txt` text,
  `aircraft_activity_main_id` int(10) NOT NULL default '0',
  `aircraft_activity_121_landings` int(11) NOT NULL default '0',
  `aircraft_activity_121_overnight` int(11) NOT NULL default '0',
  `aircraft_activity_121_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`aircraft_activity_121_id`),
  KEY `aircraft_activity_121_type_cb_int` (`aircraft_activity_121_type_cb_int`),
  KEY `aircraft_activity_main_id` (`aircraft_activity_main_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_activity_121_sub_a`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_135_main`
--

CREATE TABLE IF NOT EXISTS `tbl_activity_135_main` (
  `activity_135_id` int(10) NOT NULL auto_increment COMMENT 'ID',
  `activity_135_date` date NOT NULL COMMENT 'Date',
  `activity_135_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT 'Auto Time',
  `activity_135_author_cb_int` int(10) default NULL COMMENT 'Entry By Int',
  `activity_135_author_cb_txt` text COMMENT 'Entry By Txt',
  `activity_135_totallandings` int(10) NOT NULL default '0' COMMENT 'Total Landings',
  `activity_135_totallbsin` int(10) NOT NULL default '0' COMMENT 'Total Lbs In',
  `activity_135_totallbsout` int(10) NOT NULL default '0' COMMENT 'Total Lbs Out',
  `activity_135_operator_cb_int` int(10) default NULL COMMENT 'Operator Int',
  `activity_135_operator_cb_txt` text COMMENT 'Operator Txt',
  `activity_135_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`activity_135_id`),
  KEY `activity_135_author_cb_int` (`activity_135_author_cb_int`),
  KEY `activity_135_operator_cb_int` (`activity_135_operator_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_activity_135_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_135_sub_a`
--

CREATE TABLE IF NOT EXISTS `tbl_activity_135_sub_a` (
  `aircraft_activity_135_id` int(10) NOT NULL auto_increment,
  `aircraft_activity_135_type_cb_int` int(10) default NULL,
  `aircraft_activity_135_type_cb_txt` text,
  `aircraft_activity_main_id` int(10) NOT NULL default '0',
  `aircraft_activity_135_landings` int(11) NOT NULL default '0',
  `aircraft_activity_135_overnight` int(11) NOT NULL default '0',
  `aircraft_activity_135_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`aircraft_activity_135_id`),
  KEY `aircraft_activity_135_type_cb_int` (`aircraft_activity_135_type_cb_int`),
  KEY `aircraft_activity_main_id` (`aircraft_activity_main_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_activity_135_sub_a`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_aircraft_main`
--

CREATE TABLE IF NOT EXISTS `tbl_aircraft_main` (
  `aircraft_id` int(10) NOT NULL auto_increment COMMENT 'ID',
  `aircraft_name` text NOT NULL COMMENT 'Name',
  `aircraft_type_cb_int` int(10) default NULL COMMENT 'Type Int',
  `aircraft_type_cb_txt` text COMMENT 'Type Txt',
  `aircraft_weight` int(11) NOT NULL default '0' COMMENT 'Weight',
  `aircraft_archived_yn` tinyint(1) NOT NULL default '0' COMMENT 'Archived',
  PRIMARY KEY  (`aircraft_id`),
  KEY `aircraft_type_cb_int` (`aircraft_type_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_aircraft_main`
--

INSERT INTO `tbl_aircraft_main` (`aircraft_id`, `aircraft_name`, `aircraft_type_cb_int`, `aircraft_type_cb_txt`, `aircraft_weight`, `aircraft_archived_yn`) VALUES
(1, 'Cessna 404', 1, NULL, 48600, 0),
(2, 'Fairchild Metroliner III', 2, NULL, 336000, 0),
(3, 'Cessna 310', 1, NULL, 5500, 0),
(4, 'Cessna 402', 1, NULL, 6850, 0),
(5, 'Cessna 208', 2, NULL, 8750, 0),
(6, 'Saab 340 (SFA)', 2, NULL, 27200, 0),
(7, 'Saab 340 (SFC)', 2, NULL, 28500, 0),
(8, 'test', 1, NULL, 1234, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_aircraft_sub_t`
--

CREATE TABLE IF NOT EXISTS `tbl_aircraft_sub_t` (
  `aircraft_types_id` int(10) NOT NULL auto_increment,
  `aircraft_types_name` text NOT NULL,
  `aircraft_ypes_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`aircraft_types_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_aircraft_sub_t`
--

INSERT INTO `tbl_aircraft_sub_t` (`aircraft_types_id`, `aircraft_types_name`, `aircraft_ypes_archived_yn`) VALUES
(1, 'Prop', 0),
(2, 'Turbo Prop', 0),
(3, 'Jet', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city_budget_sub_c`
--

CREATE TABLE IF NOT EXISTS `tbl_city_budget_sub_c` (
  `act_category_f_id` int(11) NOT NULL auto_increment,
  `act_category_f_type_id_cb_int` int(11) NOT NULL,
  `act_category_f_type_id_cb_txt` text,
  `act_category_f_number` int(11) NOT NULL,
  `act_category_f_name` text,
  `act_category_f_credit` tinyint(1) NOT NULL default '0',
  `act_category_f_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`act_category_f_id`),
  KEY `act_category_f_type_id_cb_int` (`act_category_f_type_id_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Budget Line Items (avilable to place in a budget)' AUTO_INCREMENT=75 ;

--
-- Dumping data for table `tbl_city_budget_sub_c`
--

INSERT INTO `tbl_city_budget_sub_c` (`act_category_f_id`, `act_category_f_type_id_cb_int`, `act_category_f_type_id_cb_txt`, `act_category_f_number`, `act_category_f_name`, `act_category_f_credit`, `act_category_f_archived_yn`) VALUES
(1, 1, NULL, 31201, 'Airfright Tax', 1, 0),
(2, 2, NULL, 32109, 'Other', 1, 0),
(3, 3, NULL, 33113, 'FAA Grant', 1, 0),
(4, 3, NULL, 33413, 'SD DOT Grant', 1, 0),
(5, 3, NULL, 33414, 'AMTRAK Grant', 1, 0),
(6, 4, NULL, 36100, 'Interest Earned', 1, 0),
(7, 4, NULL, 36906, 'Recovery of Direct Expenses', 1, 0),
(8, 4, NULL, 36909, 'Other Miscellaneous Revenue', 1, 0),
(9, 5, NULL, 38402, 'Penalty', 1, 0),
(10, 5, NULL, 38501, 'Landing Fees', 1, 0),
(11, 5, NULL, 38502, 'Hangar Rental - General Aviation', 1, 0),
(12, 5, NULL, 38503, 'Fixed Based Operator Rental', 1, 0),
(13, 5, NULL, 38504, 'Terminal Rental', 1, 0),
(14, 5, NULL, 38505, 'Other - Rental', 1, 0),
(15, 5, NULL, 38506, 'Fuel Flowage Fees', 1, 0),
(16, 5, NULL, 38507, 'Farming Proceeds', 1, 0),
(17, 5, NULL, 38508, 'Rental Car Income', 1, 0),
(18, 5, NULL, 38509, 'Other - Miscellaneous', 1, 0),
(19, 6, NULL, 39107, 'Capital Contributions', 1, 0),
(20, 6, NULL, 39112, 'Transfers In - General Fund', 1, 0),
(21, 6, NULL, 39113, 'Transfers In - Capital Improvement Fund', 1, 0),
(22, 7, NULL, 41100, 'Supervision Salary', 0, 0),
(23, 7, NULL, 41101, 'Clerical and Operator Salary', 0, 0),
(24, 7, NULL, 41102, 'Temporary Salaries', 0, 0),
(25, 7, NULL, 41109, 'Overtime Pay', 0, 0),
(26, 7, NULL, 41200, 'OASI - Employer Contributions', 0, 0),
(27, 7, NULL, 41300, 'Retirement and Pensions', 0, 0),
(28, 7, NULL, 41400, 'Workers Compensation Insurance', 0, 0),
(29, 7, NULL, 41500, 'Group Health Insurance', 0, 0),
(30, 8, NULL, 42101, 'Liability Insurance', 0, 0),
(31, 8, NULL, 42102, 'Building Construction and Equipment Insurance', 0, 0),
(32, 8, NULL, 42103, 'Automotive Insurance', 0, 0),
(33, 8, NULL, 42104, 'Insurance Premiums', 0, 0),
(34, 8, NULL, 42203, 'Expert and Consultant Services', 0, 0),
(35, 8, NULL, 42300, 'Publication and Recording Fees', 0, 0),
(36, 8, NULL, 42400, 'Rent - Machinery and Equipment', 0, 0),
(37, 8, NULL, 42501, 'Equipment Maintenance', 0, 0),
(38, 8, NULL, 42502, 'Building Maintenance', 0, 0),
(39, 8, NULL, 42504, 'Maintenance to Other', 0, 0),
(40, 8, NULL, 42509, 'Seal Coating and Crack Sealing', 0, 0),
(41, 8, NULL, 42520, 'Deicing Sand', 0, 0),
(42, 8, NULL, 42600, 'Office Supplies', 0, 0),
(43, 8, NULL, 42601, 'Cleaning Supplies', 0, 0),
(44, 8, NULL, 42603, 'Motor Fuel and Lubricants', 0, 0),
(45, 8, NULL, 42604, 'Parts for Equipment', 0, 0),
(46, 8, NULL, 42610, 'Clothing and Materials', 0, 0),
(47, 8, NULL, 42613, 'Small Tools', 0, 0),
(48, 8, NULL, 42617, 'Cleaning Service', 0, 0),
(49, 8, NULL, 42618, 'Postage', 0, 0),
(50, 8, NULL, 42619, 'Chemicals and Laboratory Supplies', 0, 0),
(51, 8, NULL, 42620, 'Other Supplies', 0, 0),
(52, 8, NULL, 42623, 'Computer Supplies and Software', 0, 0),
(53, 8, NULL, 42627, 'Safety Supplies', 0, 0),
(54, 8, NULL, 42701, 'Travel Expenditures - Personal', 0, 0),
(55, 8, NULL, 42702, 'Subcriptions and Memberships', 0, 0),
(56, 8, NULL, 42801, 'Utilities - Natural Gas', 0, 0),
(57, 8, NULL, 42802, 'Utilities - Electricity', 0, 0),
(58, 8, NULL, 42803, 'Utilities - Water', 0, 0),
(59, 8, NULL, 42804, 'Utilities - Sewer', 0, 0),
(60, 8, NULL, 42805, 'Utilities - Phone', 0, 0),
(61, 9, NULL, 43603, 'Snow Removal Equipment', 0, 0),
(62, 9, NULL, 43804, 'Pickup', 0, 0),
(63, 9, NULL, 43900, 'Improvements other than Building', 0, 0),
(64, 9, NULL, 43904, 'Project Archatecture and Engineering', 0, 0),
(65, 9, NULL, 43905, 'Project Construction', 0, 0),
(66, 9, NULL, 43997, 'Paving', 0, 0),
(67, 10, NULL, 49200, 'Loss on Disposal of Fixed Assets', 0, 0),
(68, 10, NULL, 49300, 'Transfers Out', 0, 0),
(69, 10, NULL, 49312, 'Transfers Out - Airport Fund', 0, 0),
(70, 6, NULL, 42607, 'Education and Rec Supplies', 0, 0),
(71, 8, NULL, 42703, 'Workshops - Personal', 0, 0),
(72, 9, NULL, 43602, 'Computer Software', 0, 0),
(73, 9, NULL, 43639, 'Loader and Attachments', 0, 0),
(74, 9, NULL, 43830, 'Broom Attachment', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city_budget_sub_c_c`
--

CREATE TABLE IF NOT EXISTS `tbl_city_budget_sub_c_c` (
  `budget_sub_f_id` int(11) NOT NULL auto_increment,
  `budget_sub_f_fund_id_cb_int` int(11) NOT NULL,
  `budget_sub_f_fund_id_cb_txt` text,
  `budget_sub_f_amount` double NOT NULL,
  `budget_sub_f_year` int(11) NOT NULL,
  `budget_sub_f_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`budget_sub_f_id`),
  KEY `budget_sub_f_fund_id_cb_int` (`budget_sub_f_fund_id_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Used to add Budget line items to a yearly budget' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_city_budget_sub_c_c`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_city_budget_sub_c_f`
--

CREATE TABLE IF NOT EXISTS `tbl_city_budget_sub_c_f` (
  `act_category_t_id` int(11) NOT NULL auto_increment,
  `act_category_t_number` int(11) NOT NULL,
  `act_category_t_name` text,
  `act_category_t_debit` tinyint(1) NOT NULL default '0',
  `act_category_t_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`act_category_t_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Budget Categories (facilities)' AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_city_budget_sub_c_f`
--

INSERT INTO `tbl_city_budget_sub_c_f` (`act_category_t_id`, `act_category_t_number`, `act_category_t_name`, `act_category_t_debit`, `act_category_t_archived_yn`) VALUES
(1, 310, 'Taxes', 1, 0),
(2, 320, 'Other', 1, 0),
(3, 330, 'Intergovernment Revenue', 1, 0),
(4, 360, 'Miscellaneous Revenue', 1, 0),
(5, 380, 'Enterprise Operating Revenue', 1, 0),
(6, 390, 'Other Financing Sources', 1, 0),
(7, 410, 'Personal Services', 0, 0),
(8, 420, 'Other Capital Expenditures', 0, 0),
(9, 430, 'Capital Outlay', 0, 0),
(10, 490, 'Miscellaneous', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city_cip_rs`
--

CREATE TABLE IF NOT EXISTS `tbl_city_cip_rs` (
  `citycip_rs_id` int(11) NOT NULL auto_increment COMMENT 'The ID of this record',
  `citycip_rs_sub_rs_cb_int` int(11) NOT NULL COMMENT 'ID of Row in tbl_city_cip_sub_rs_years: How often to replace this item',
  `citycip_rs_sub_rs_cb_txt` text,
  `citycip_rs_rs_type_cb_int` int(11) NOT NULL COMMENT 'ID of Row in (X): This is the ID of the object',
  `citycip_rs_rs_type_cb_txt` text,
  `citycip_rs_type_id` int(11) NOT NULL COMMENT 'The ID of the row in tbl_general_tblrlshp',
  `citycip_rs_type_id_txt` text,
  `citycip_rs_archived_yn` tinyint(1) NOT NULL default '0' COMMENT 'Hide Row, 1=yes, 0=no',
  PRIMARY KEY  (`citycip_rs_id`),
  KEY `leases_lease_type_cb_int` (`citycip_rs_rs_type_cb_int`),
  KEY `leases_lessee_cb_int` (`citycip_rs_sub_rs_cb_int`),
  KEY `leases_type_id` (`citycip_rs_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_city_cip_rs`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_city_cip_rs_temp`
--

CREATE TABLE IF NOT EXISTS `tbl_city_cip_rs_temp` (
  `citycip_rs_temp_id` int(11) NOT NULL,
  `citycip_rs_newyear` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is a Temporary Table used by the Replacement Schedule';

--
-- Dumping data for table `tbl_city_cip_rs_temp`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_city_cip_sub_rs_years`
--

CREATE TABLE IF NOT EXISTS `tbl_city_cip_sub_rs_years` (
  `citycip_sub_rs_id` int(11) NOT NULL auto_increment,
  `citycip_sub_rs_years` int(11) default NULL COMMENT 'The number of years something is replaced',
  `citycip_sub_rs_hidden` tinyint(1) default NULL,
  PRIMARY KEY  (`citycip_sub_rs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Replacement Year Table' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_city_cip_sub_rs_years`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_duty_log`
--

CREATE TABLE IF NOT EXISTS `tbl_duty_log` (
  `duty_log_id` int(10) NOT NULL auto_increment,
  `duty_log_comments` longtext,
  `duty_log_by_cb_int` int(10) default NULL,
  `duty_log_by_cb_txt` varchar(50) default NULL,
  `duty_log_time` time default NULL,
  `duty_log_date` date default NULL,
  `duty_log_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT 'Used to Track when the record was created',
  `duty_log_archived_yn` tinyint(1) NOT NULL default '0' COMMENT 'Hide Record?',
  PRIMARY KEY  (`duty_log_id`),
  KEY `duty_log_by_cb_int` (`duty_log_by_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_duty_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_fuelflow_sub_t`
--

CREATE TABLE IF NOT EXISTS `tbl_fuelflow_sub_t` (
  `fuelflow_t_id` int(11) NOT NULL auto_increment,
  `fuelflow_t_date` date NOT NULL,
  `fuelflow_t_time` time NOT NULL,
  `fuelflow_t_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `fuelflow_t_by_cb_int` int(11) NOT NULL default '0',
  `fuelflow_t_by_cb_txt` text,
  `fuelflow_t_fuel_cb_int` int(11) NOT NULL default '0',
  `fuelflow_t_fuel_cb_txt` text,
  `fuelflow_t_fuel_gallons` double NOT NULL,
  `fuelflow_t_fuel_costg` double NOT NULL,
  `fuelflow_t_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`fuelflow_t_id`),
  KEY `fuelflow_t_by_cb_int` (`fuelflow_t_by_cb_int`),
  KEY `fuelflow_t_fuel_cb_int` (`fuelflow_t_fuel_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_fuelflow_sub_t`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_fuelflow_sub_v`
--

CREATE TABLE IF NOT EXISTS `tbl_fuelflow_sub_v` (
  `fuelflow_v_id` int(11) NOT NULL auto_increment,
  `fuelflow_v_date` date NOT NULL,
  `fuelflow_v_time` time NOT NULL,
  `fuelflow_v_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `fuelflow_v_by_cb_int` int(11) NOT NULL default '0',
  `fuelflow_v_by_cb_txt` text,
  `fuelflow_v_fuel_cb_int` int(11) NOT NULL default '0',
  `fuelflow_v_fuel_cb_txt` text,
  `fuelflow_vv_cb_int` int(11) NOT NULL default '0',
  `fuelflow_vv_cb_txt` text,
  `fuelflow_v_fuel_miles` double NOT NULL default '0',
  `fuelflow_v_fuel_hours` double NOT NULL default '0',
  `fuelflow_v_fuel_gallons` double NOT NULL,
  `fuelflow_v_fuel_costg` double NOT NULL,
  `fuelflow_v_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`fuelflow_v_id`),
  KEY `fuelflow_v_by_cb_int` (`fuelflow_v_by_cb_int`),
  KEY `fuelflow_v_fuel_cb_int` (`fuelflow_v_fuel_cb_int`),
  KEY `fuelflow_vv_cb_int` (`fuelflow_vv_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_fuelflow_sub_v`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_fuelflowoperations_main`
--

CREATE TABLE IF NOT EXISTS `tbl_fuelflowoperations_main` (
  `fuelflow_id` int(10) NOT NULL auto_increment,
  `fuelflow_author_cb_by_int` int(10) default NULL,
  `fuelfow_author_cb_by_txt` text,
  `fuelflow_fbo_cb_int` int(10) default NULL,
  `fuelflow_fbo_cb_txt` text,
  `fuelflow_date` date default NULL,
  `fuelflow_time` time default NULL,
  `fuelflow_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `fuelflow_tank_cb_int` int(10) default NULL,
  `fuelflow_tank_cb_txt` text,
  `fuelflow_grossgallons` int(10) NOT NULL default '0',
  `fuelflow_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`fuelflow_id`),
  KEY `fuelflow_author_cb_by_int` (`fuelflow_author_cb_by_int`),
  KEY `fuelflow_fbo_cb_int` (`fuelflow_fbo_cb_int`),
  KEY `fuelflow_tank_cb_int` (`fuelflow_tank_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_fuelflowoperations_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_general_conditions`
--

CREATE TABLE IF NOT EXISTS `tbl_general_conditions` (
  `general_condition_id` int(11) NOT NULL auto_increment,
  `general_condition_name` text,
  `general_condition_archived_yn` tinyint(1) NOT NULL default '0',
  `general_condition_priority` int(11) NOT NULL,
  PRIMARY KEY  (`general_condition_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_general_conditions`
--

INSERT INTO `tbl_general_conditions` (`general_condition_id`, `general_condition_name`, `general_condition_archived_yn`, `general_condition_priority`) VALUES
(1, 'Requires Action', 0, 1),
(2, 'Poor', 0, 2),
(3, 'Fair', 0, 3),
(4, 'Good', 0, 4),
(5, 'Excellent', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_general_months`
--

CREATE TABLE IF NOT EXISTS `tbl_general_months` (
  `months_id` int(11) NOT NULL auto_increment,
  `months_name` text,
  `months_number` int(11) NOT NULL,
  `months_daysinmonth` int(11) NOT NULL COMMENT 'May not be used, if using default days per month code',
  `months_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`months_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_general_months`
--

INSERT INTO `tbl_general_months` (`months_id`, `months_name`, `months_number`, `months_daysinmonth`, `months_archived_yn`) VALUES
(1, 'January', 1, 31, 0),
(2, 'February', 2, 28, 0),
(3, 'March', 3, 31, 0),
(4, 'April', 4, 30, 0),
(5, 'May', 5, 31, 0),
(6, 'June', 6, 30, 0),
(7, 'July', 7, 31, 0),
(8, 'August', 8, 31, 0),
(9, 'September', 9, 30, 0),
(10, 'October', 10, 31, 0),
(11, 'November', 11, 30, 0),
(12, 'December', 12, 31, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_general_tblrlshp`
--

CREATE TABLE IF NOT EXISTS `tbl_general_tblrlshp` (
  `tbl_gtr_t_id` int(11) NOT NULL auto_increment,
  `tbl_gtr_t_name` text COMMENT 'Name of Item',
  `tbl_gtr_t_tablename` text COMMENT 'Name of Procedure to use to list items in a combox',
  `tbl_gtr_t_tablename_txt` text COMMENT 'Name of the Table which to search for a matching ID',
  `tbl_gtr_t_tablename_mx_txt` text COMMENT 'The Name of the table for sub parts of this unit',
  `tbl_gtr_t_archived_yn` tinyint(1) NOT NULL default '0' COMMENT 'Hide Row, 1=yes, 0=no',
  PRIMARY KEY  (`tbl_gtr_t_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Use this table to relate table data to programming functions' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_general_tblrlshp`
--

INSERT INTO `tbl_general_tblrlshp` (`tbl_gtr_t_id`, `tbl_gtr_t_name`, `tbl_gtr_t_tablename`, `tbl_gtr_t_tablename_txt`, `tbl_gtr_t_tablename_mx_txt`, `tbl_gtr_t_archived_yn`) VALUES
(1, 'Buildings', 'inventorybvuildingpartscombobox', 'tbl_inventory_sub_b', 'tbl_maintenance_sub_b_p', 0),
(2, 'Property', 'inventorypropertypartscombobox', 'tbl_inventory_sub_p', 'tbl_maintenance_sub_p_p', 0),
(3, 'Equipment', 'inventoryequipmentcombobox', 'tbl_inventory_sub_e', 'tbl_maintenance_sub_e_p', 0),
(4, 'Vehicles', 'inventoryvehiclescombobox', 'tbl_inventory_sub_v', 'tbl_maintenance_sub_v_p', 0),
(5, 'Pavement', 'inventorypavementscombobox', 'tbl_inventory_sub_pv', 'tbl_maintenance_sub_pv_p', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inspections_buildings_main`
--

CREATE TABLE IF NOT EXISTS `tbl_inspections_buildings_main` (
  `inspection_id` int(11) NOT NULL auto_increment,
  `inspection_inspected_by_cb_int` int(11) NOT NULL,
  `inspection_inspected_by_cb_txt` text,
  `inspection_buildingid_cb_int` int(11) NOT NULL,
  `inspection_buildingid_cb_txt` text,
  `inspection_date` date NOT NULL,
  `inspection_time` time NOT NULL,
  `inspection_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `inspection_archived_yn` tinyint(1) NOT NULL default '0',
  `inspection_chki_1` text,
  `inspection_chki_2` text,
  `inspection_chki_3` text,
  `inspection_chki_4` text,
  `inspection_chki_5` text,
  `inspection_chki_6` text,
  `inspection_chki_7` text,
  `inspection_chki_8` text,
  `inspection_chki_9` text,
  `inspection_chki_10` text,
  `inspection_chki_11` text,
  `inspection_chki_12` text,
  `inspection_chki_13` text,
  `inspection_chki_14` text,
  `inspection_chki_15` text,
  `inspection_chki_16` text,
  `inspection_chki_17` text,
  `inspection_chki_18` text,
  `inspection_chki_19` text,
  `inspection_chki_20` text,
  `inspection_chki_21` text,
  `inspection_chki_22` text,
  `inspection_chki_23` text,
  `inspection_chki_24` text,
  `inspection_chki_25` text,
  `inspection_chki_26` text,
  `inspection_chki_27` text,
  `inspection_chki_28` text,
  `inspection_chki_29` text,
  `inspection_chki_30` text,
  `inspection_chki_31` text,
  `inspection_chki_32` text,
  `inspection_chki_33` text,
  `inspection_chki_34` text,
  `inspection_chki_35` text,
  PRIMARY KEY  (`inspection_id`),
  KEY `inspection_inspected_by_cb_int` (`inspection_inspected_by_cb_int`),
  KEY `inspection_buildingid_cb_int` (`inspection_buildingid_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_inspections_buildings_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_inspections_malsr_main`
--

CREATE TABLE IF NOT EXISTS `tbl_inspections_malsr_main` (
  `malsr_id` int(11) NOT NULL auto_increment,
  `malsr_inspected_by_cb_int` int(11) NOT NULL,
  `malsr_inspected_by_cb_txt` text,
  `malsr_date` date NOT NULL,
  `malsr_time` time NOT NULL,
  `malsr_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `malsr_obstrution_yn` tinyint(1) NOT NULL,
  `malsr_obstrution_txt` text,
  `malsr_visibility_yn` tinyint(1) NOT NULL,
  `malsr_visibility_txt` text,
  `malsr_remarks` text,
  `malsr_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`malsr_id`),
  KEY `malsr_inspected_by_cb_int` (`malsr_inspected_by_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_inspections_malsr_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_inspections_papi_main`
--

CREATE TABLE IF NOT EXISTS `tbl_inspections_papi_main` (
  `papi_id` int(11) NOT NULL auto_increment,
  `papi_inspected_by_cb_int` int(11) NOT NULL,
  `papi_inspected_by_cb_txt` text,
  `papi_date` date NOT NULL,
  `papi_time` time NOT NULL,
  `papi_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `papi_remarks` text,
  `papi_archived_yn` tinyint(1) NOT NULL default '0',
  `papi_paint_c_int` int(11) NOT NULL,
  `papi_paint_c_txt` text,
  `papi_ground_c_int` int(11) NOT NULL,
  `papi_ground_c_txt` text,
  `papi_initial_angle` text,
  `papi_proper_angle` text,
  `papi_corrected_angle` text,
  `papi_papi_id_cb_int` int(11) NOT NULL,
  `papi_papi_id_cb_txt` text,
  PRIMARY KEY  (`papi_id`),
  KEY `papi_inspected_by_cb_int` (`papi_inspected_by_cb_int`),
  KEY `papi_papi_id_cb_int` (`papi_papi_id_cb_int`),
  KEY `papi_paint_c_int` (`papi_paint_c_int`),
  KEY `papi_ground_c_int` (`papi_ground_c_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_inspections_papi_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_inspections_vehicles_main`
--

CREATE TABLE IF NOT EXISTS `tbl_inspections_vehicles_main` (
  `inspection_id` int(11) NOT NULL auto_increment,
  `inspection_inspected_by_cb_int` int(11) NOT NULL,
  `inspection_inspected_by_cb_txt` text,
  `inspection_vehicleid_cb_int` int(11) NOT NULL,
  `inspection_vehicleid_cb_txt` text,
  `inspection_date` date NOT NULL,
  `inspection_time` time NOT NULL,
  `inspection_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `inspection_archived_yn` tinyint(1) NOT NULL default '0',
  `inspection_chki_1` text,
  `inspection_chki_2` text,
  `inspection_chki_3` text,
  `inspection_chki_4` text,
  `inspection_chki_5` text,
  `inspection_chki_6` text,
  `inspection_chki_7` text,
  `inspection_chki_8` text,
  `inspection_chki_9` text,
  `inspection_chki_10` text,
  `inspection_chki_11` text,
  `inspection_chki_12` text,
  `inspection_chki_13` text,
  `inspection_chki_14` text,
  `inspection_chki_15` text,
  `inspection_chki_16` text,
  `inspection_chki_17` text,
  `inspection_chki_18` text,
  `inspection_chki_19` text,
  `inspection_chki_20` text,
  `inspection_chki_21` text,
  `inspection_chki_22` text,
  `inspection_chki_23` text,
  `inspection_chki_24` text,
  `inspection_chki_25` text,
  `inspection_chki_26` text,
  `inspection_chki_27` text,
  `inspection_chki_28` text,
  `inspection_chki_29` text,
  `inspection_chki_30` text,
  `inspection_chki_31` text,
  `inspection_chki_32` text,
  `inspection_chki_33` text,
  `inspection_chki_34` text,
  `inspection_chki_35` text,
  PRIMARY KEY  (`inspection_id`),
  KEY `inspection_inspected_by_cb_int` (`inspection_inspected_by_cb_int`),
  KEY `inspection_buildingid_cb_int` (`inspection_vehicleid_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_inspections_vehicles_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_a_k`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_a_k` (
  `inventory_keys_id` int(11) NOT NULL auto_increment,
  `inventory_keys_cb_int` int(11) default NULL,
  `inventory_keys_cb_txt` text,
  `inventory_keys_cb_count` int(11) default NULL,
  `inventory_keys_archived` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`inventory_keys_id`),
  KEY `inventory_keys_types_cb_int` (`inventory_keys_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tbl_inventory_sub_a_k`
--

INSERT INTO `tbl_inventory_sub_a_k` (`inventory_keys_id`, `inventory_keys_cb_int`, `inventory_keys_cb_txt`, `inventory_keys_cb_count`, `inventory_keys_archived`) VALUES
(1, 1, NULL, 0, 0),
(2, 2, '', 0, 0),
(3, 3, '', 0, 0),
(4, 4, '', 0, 0),
(5, 5, '', 0, 0),
(6, 6, '', 0, 0),
(7, 7, '', 0, 0),
(8, 8, '', 0, 0),
(9, 9, '', 0, 0),
(10, 10, '', 0, 0),
(11, 11, '', 0, 0),
(12, 12, '', 0, 0),
(13, 13, '', 0, 0),
(14, 14, '', 0, 0),
(15, 15, '', 0, 0),
(16, 16, '', 0, 0),
(17, 17, NULL, 0, 0),
(18, 18, NULL, 0, 0),
(19, 19, NULL, 0, 0),
(20, 20, NULL, 0, 0),
(21, 21, NULL, 0, 0),
(22, 22, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_a_k_t`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_a_k_t` (
  `inventory_keys_type_id` int(11) NOT NULL auto_increment,
  `inventory_keys_type_name` text,
  `inventory_keys_type_function` longtext,
  `inventory_keys_type_archived` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`inventory_keys_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tbl_inventory_sub_a_k_t`
--

INSERT INTO `tbl_inventory_sub_a_k_t` (`inventory_keys_type_id`, `inventory_keys_type_name`, `inventory_keys_type_function`, `inventory_keys_type_archived`) VALUES
(1, 'Grand Master', 'Opens every door at the airport', 0),
(2, 'Sub Master - DT', 'Open every door in the terminal', 0),
(3, 'Sub Master - HH', 'Opens every door in the hubbard Hangar', 0),
(4, 'Sub Master - SH', 'Opens every door in the stone hangar', 0),
(5, 'Sub Master - H1', 'opens every door in Hangar Unit 1', 0),
(6, 'Sub Master - H3', 'Opens every door in Hangar Unit 3', 0),
(7, 'Sub Master - MS', 'opens every door in the maintenance shop', 0),
(8, 'Sub Master - FH', 'opens every door in the fire hall', 0),
(9, 'Sub Master - FS', 'opens every door in the fire shed', 0),
(10, 'Sub Master - LS', 'opens every door in the lighting shed', 0),
(11, 'Sub Master - S1', 'opens every door in the storage shed 1', 0),
(12, 'Sub Master - S2', 'opens every door in the storage shed 2', 0),
(13, 'Sub Master - FG', 'opens all doors on the perimeter fence', 0),
(14, 'G1', 'Airline Personnel', 0),
(15, 'G2', 'Transportation Security Administration', 0),
(16, 'G3', 'Cleaning Crew', 0),
(17, 'G4', 'Federal Aviation Administration', 0),
(18, 'G5', 'Watertown Fire Department', 0),
(19, 'G6', 'Farming Operations', 0),
(20, 'G7', 'Stone Hangar Renter', 0),
(21, 'G8', 'Fixed Based Operator', 0),
(22, 'G9', 'Angus Palm', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_a_pc`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_a_pc` (
  `inventory_pc_id` int(11) NOT NULL auto_increment,
  `inventory_pc_cb_int` int(11) default NULL,
  `inventory_pc_cb_txt` text,
  `inventory_pc_cb_count` int(11) default NULL,
  `inventory_pc_archived` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`inventory_pc_id`),
  KEY `inventory_pc_cb_int` (`inventory_pc_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_inventory_sub_a_pc`
--

INSERT INTO `tbl_inventory_sub_a_pc` (`inventory_pc_id`, `inventory_pc_cb_int`, `inventory_pc_cb_txt`, `inventory_pc_cb_count`, `inventory_pc_archived`) VALUES
(4, 5, NULL, 155, 0),
(5, 6, NULL, 20, 0),
(6, 3, NULL, 21, 0),
(7, 4, NULL, 0, 0),
(8, 7, NULL, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_a_pc_t`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_a_pc_t` (
  `inventory_pc_type_id` int(11) NOT NULL auto_increment,
  `inventory_pc_type_name` text,
  `inventory_pc_type_function` longtext,
  `inventory_pc_type_archived` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`inventory_pc_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_inventory_sub_a_pc_t`
--

INSERT INTO `tbl_inventory_sub_a_pc_t` (`inventory_pc_type_id`, `inventory_pc_type_name`, `inventory_pc_type_function`, `inventory_pc_type_archived`) VALUES
(3, 'Default Hangar Tenant (PC)', 'This Secura Key Proxy card is used for typical hangar tenant users and allows access only to the two gates near the T-Hangars.', 0),
(4, 'Grand Master (PC)', 'This card is programmed to open all gates around the airport', 0),
(5, 'Not Programmed (PC)', 'This is the total number of proxy cards in inventory that have not been programmed.', 0),
(6, 'Main Gate Only (PC)', 'This card is programmed to open the main gate between the fire hall and the airport terminal.', 0),
(7, 'Maintenance Shop (PC)', 'Used for only the maintenance shop gate', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_b`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_b` (
  `buildings_id` int(10) NOT NULL auto_increment,
  `buildings_name` text,
  `buildings_modelyear` int(10) NOT NULL default '0',
  `buildings_manufac_cb_int` int(10) NOT NULL default '0',
  `buildings_manufac_cb_txt` text,
  `buildings_archived_yn` tinyint(1) NOT NULL default '0',
  `buildings_type_cb_int` int(11) NOT NULL default '0',
  `buildings_type_cb_txt` text,
  `buildings_image_txt` text COMMENT 'Location of the Building Map image on Hard Disk',
  PRIMARY KEY  (`buildings_id`),
  KEY `buildings_manufac_cb_int` (`buildings_manufac_cb_int`),
  KEY `buildings_type_cb_int` (`buildings_type_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_inventory_sub_b`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_b_sub_t`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_b_sub_t` (
  `buildings_sub_type_id` int(11) NOT NULL auto_increment,
  `buildings_sub_type_name` text,
  `buildings_sub_type_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`buildings_sub_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_inventory_sub_b_sub_t`
--

INSERT INTO `tbl_inventory_sub_b_sub_t` (`buildings_sub_type_id`, `buildings_sub_type_name`, `buildings_sub_type_archived_yn`) VALUES
(1, 'Storage', 0),
(2, 'Hangar', 0),
(3, 'Rental Property', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_e`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_e` (
  `equipment_id` int(10) NOT NULL auto_increment,
  `equipment_name` text,
  `equipment_modelyear` int(10) NOT NULL default '0',
  `equipment_modelnumber` text,
  `equipment_lat` longtext,
  `equipment_long` longtext,
  `equipment_manufac_cb_int` int(10) NOT NULL default '0',
  `equipment_manufac_cb_txt` text,
  `equipment_serialnumber_a` text,
  `equipment_serialnumber_b` text,
  `equipment_serialnumber_c` text,
  `equipment_archived_yn` tinyint(1) NOT NULL default '0',
  `equipment_type_cb_int` int(11) NOT NULL default '0',
  `equipment_type_cb_txt` text,
  PRIMARY KEY  (`equipment_id`),
  KEY `vehicles_manufac_cb_int` (`equipment_manufac_cb_int`),
  KEY `equipment_type_cb_int` (`equipment_type_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_inventory_sub_e`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_e_sub_t`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_e_sub_t` (
  `equipment_sub_type_id` int(11) NOT NULL auto_increment,
  `equipment_sub_type_name` text,
  `equipment_sub_type_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`equipment_sub_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_inventory_sub_e_sub_t`
--

INSERT INTO `tbl_inventory_sub_e_sub_t` (`equipment_sub_type_id`, `equipment_sub_type_name`, `equipment_sub_type_archived_yn`) VALUES
(1, 'Precision Approach Path Indicator (PAPI)', 0),
(2, 'Medium Intensity Approach Lights with Runway Alignment Indicator Lights (MALSR)', 0),
(3, 'Runway', 0),
(4, 'Sign', 0),
(5, 'Taxiway Light', 0),
(6, 'Runway Light', 0),
(7, 'Taxiway', 0),
(8, 'Ramp', 0),
(9, 'Unknown - Update', 0),
(10, 'Runway End Ident Light', 0),
(11, 'Ceiling Light', 0),
(12, 'Global Position Marker', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_p`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_p` (
  `property_id` int(10) NOT NULL auto_increment,
  `property_sub_id` int(10) default NULL COMMENT 'Used to define a property as a subset of another property ID',
  `property_name` text,
  `property_dateacquired` int(11) default NULL,
  `property_typeofacquisition` text,
  `property_documentnumber` text,
  `property_archived_yn` tinyint(1) default '0',
  `property_type_cb_int` int(11) default '0' COMMENT 'Is this property rentable?',
  `property_type_cb_txt` text,
  `property_datereleased` date default NULL,
  `property_remarks` text,
  `property_acres` double default NULL,
  `property_image_txt` text COMMENT 'Image location on the Hard Disk',
  PRIMARY KEY  (`property_id`),
  KEY `property_type_cb_int` (`property_type_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_inventory_sub_p`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_p_sub_t`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_p_sub_t` (
  `property_sub_type_id` int(11) NOT NULL auto_increment,
  `property_sub_type_name` text,
  `property_sub_type_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`property_sub_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_inventory_sub_p_sub_t`
--

INSERT INTO `tbl_inventory_sub_p_sub_t` (`property_sub_type_id`, `property_sub_type_name`, `property_sub_type_archived_yn`) VALUES
(4, 'Rental Property', 0),
(5, 'Not Rental Property', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_pv`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_pv` (
  `pavement_id` int(10) NOT NULL auto_increment,
  `pavement_name` text,
  `pavement_archived_yn` tinyint(1) default '0',
  `pavement_remarks` text,
  `pavement_xpoints` text,
  `pavement_dateborn` date default NULL,
  `pavement_datedeath` date default NULL,
  `pavement_ypoints` text,
  PRIMARY KEY  (`pavement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_inventory_sub_pv`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_pv_sub_t`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_pv_sub_t` (
  `pavement_sub_type_id` int(11) NOT NULL auto_increment,
  `pavement_sub_type_name` text,
  `pavement_sub_type_archived_yn` tinyint(1) NOT NULL default '0',
  `pavement_sub_type_image` text NOT NULL,
  PRIMARY KEY  (`pavement_sub_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_inventory_sub_pv_sub_t`
--

INSERT INTO `tbl_inventory_sub_pv_sub_t` (`pavement_sub_type_id`, `pavement_sub_type_name`, `pavement_sub_type_archived_yn`, `pavement_sub_type_image`) VALUES
(1, 'Clay', 0, 'pavementlayer_clay.gif'),
(2, 'Concrete', 0, 'pavementlayer_concrete.gif'),
(3, 'Earth', 0, 'pavementlayer_earth.gif'),
(4, 'Mud and Sand', 0, 'pavementlayer_mudsand.gif'),
(5, 'Rock', 0, 'pavementlayer_rock.gif'),
(6, 'Sand', 0, 'pavementlayer_sand.gif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_tanks`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_tanks` (
  `inventory_tanks_id` int(10) NOT NULL auto_increment,
  `inventory_tanks_type_cb_int` int(10) NOT NULL,
  `inventory_tanks_type_cb_txt` text,
  `inventory_tanks_manufac_cb_int` int(10) NOT NULL,
  `inventory_tanks_manufac_cb_txt` text,
  `inventory_tanks_dateinstalled` date NOT NULL,
  `inventory_tanks_serialnumber` text NOT NULL,
  `inventory_tanks_modelnumber` text NOT NULL,
  `inventory_tanks_totalcapacity` int(10) NOT NULL,
  `inventory_tanks_currentcapacity` double NOT NULL,
  `inventory_tanks_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`inventory_tanks_id`),
  KEY `inventory_tanks_type_cb_int` (`inventory_tanks_type_cb_int`),
  KEY `inventory_tanks_manufac_cb_int` (`inventory_tanks_manufac_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_inventory_sub_tanks`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_tanks_sub_t`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_tanks_sub_t` (
  `tanks_sub_type_id` int(10) NOT NULL auto_increment,
  `tanks_sub_type_name` text NOT NULL,
  `tanks_sub_type_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`tanks_sub_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_inventory_sub_tanks_sub_t`
--

INSERT INTO `tbl_inventory_sub_tanks_sub_t` (`tanks_sub_type_id`, `tanks_sub_type_name`, `tanks_sub_type_archived_yn`) VALUES
(1, '100 LL', 0),
(2, 'Jet A', 0),
(3, 'Diesel', 0),
(4, 'MoGas', 0),
(5, '87 octane', 0),
(6, '91 octane', 0),
(7, '89.5 octane', 0),
(8, 'E 85 (Flex Fuel)', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_v`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_v` (
  `vehicles_id` int(10) NOT NULL auto_increment,
  `vehicles_name` text,
  `vehicles_modelyear` int(10) NOT NULL default '0',
  `vehicles_modelnumber` text,
  `vehicles_manufac_cb_int` int(10) NOT NULL default '0',
  `vehicles_manufac_cb_txt` text,
  `vehicles_serialnumber_a` text,
  `vehicles_serialnumber_b` text,
  `vehicles_serialnumber_c` text,
  `vehicles_archived_yn` tinyint(1) NOT NULL default '0',
  `vehicles_type_cb_int` int(11) NOT NULL default '0',
  `vehicles_type_cb_txt` text,
  `vehicles_plate` text,
  `vehciles_purchase_cost` double default NULL COMMENT 'How much to purchase this item',
  PRIMARY KEY  (`vehicles_id`),
  KEY `vehicles_manufac_cb_int` (`vehicles_manufac_cb_int`),
  KEY `vehicles_type_cb_int` (`vehicles_type_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_inventory_sub_v`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_sub_v_sub_t`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_sub_v_sub_t` (
  `vehicles_sub_type_id` int(11) NOT NULL auto_increment,
  `vehicles_sub_type_name` text,
  `vehicles_sub_type_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`vehicles_sub_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_inventory_sub_v_sub_t`
--

INSERT INTO `tbl_inventory_sub_v_sub_t` (`vehicles_sub_type_id`, `vehicles_sub_type_name`, `vehicles_sub_type_archived_yn`) VALUES
(1, 'Snow Plow', 0),
(2, 'Pickup Truck', 0),
(3, 'Trailer', 0),
(4, 'Hitched Equipment', 0),
(5, 'Broom', 0),
(6, 'A.R.F.F. Truck', 0),
(7, 'Mower', 0),
(8, 'Snow Blower', 0),
(9, 'Tractor', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_utility_meters`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_utility_meters` (
  `inv_um_id` int(11) NOT NULL auto_increment,
  `inv_um_number` text,
  `inv_um_po_id_cb_int` int(11) default NULL,
  `inv_um_po_id_cb_text` text,
  `inv_um_type_cb_int` int(11) default NULL,
  `inv_um_type_cb_text` text,
  `inv_um_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`inv_um_id`),
  KEY `inv_um_po_id_cb_int` (`inv_um_po_id_cb_int`),
  KEY `inv_um_type_cb_int` (`inv_um_type_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_inventory_utility_meters`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_utility_meters_sub_t`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory_utility_meters_sub_t` (
  `inv_um_type_id` int(11) NOT NULL auto_increment,
  `inv_um_type_name` text,
  `inv_um_type_units` text,
  `inv_um_type_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`inv_um_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_inventory_utility_meters_sub_t`
--

INSERT INTO `tbl_inventory_utility_meters_sub_t` (`inv_um_type_id`, `inv_um_type_name`, `inv_um_type_units`, `inv_um_type_archived_yn`) VALUES
(1, 'ELECTRIC', 'KWh', 0),
(2, 'WATER', 'ccf', 0),
(3, 'GAS', 'ccf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leases_main`
--

CREATE TABLE IF NOT EXISTS `tbl_leases_main` (
  `leases_id` int(11) NOT NULL auto_increment COMMENT 'The ID of this record',
  `leases_lessee_cb_int` int(11) NOT NULL,
  `leases_lessee_cb_txt` text,
  `leases_lease_type_cb_int` int(11) NOT NULL,
  `leases_lease_type_cb_txt` text,
  `leases_type_id` int(11) NOT NULL COMMENT 'The ID of the subpart',
  `lease_beganon` date default NULL,
  `lease_expectedend` date NOT NULL,
  `lease_terminatedon` date default NULL,
  `lease_treason` text,
  `lease_doclocation` longtext,
  `lease_terms_cb_int` int(11) NOT NULL,
  `lease_terms_cb_txt` text,
  `lease_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`leases_id`),
  KEY `leases_lease_type_cb_int` (`leases_lease_type_cb_int`),
  KEY `lease_terms_cb_int` (`lease_terms_cb_int`),
  KEY `leases_lessee_cb_int` (`leases_lessee_cb_int`),
  KEY `leases_type_id` (`leases_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_leases_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_leases_terms`
--

CREATE TABLE IF NOT EXISTS `tbl_leases_terms` (
  `leases_terms_id` int(11) NOT NULL auto_increment,
  `leases_terms_name` text NOT NULL,
  `leases_terms_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`leases_terms_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_leases_terms`
--

INSERT INTO `tbl_leases_terms` (`leases_terms_id`, `leases_terms_name`, `leases_terms_archived_yn`) VALUES
(1, 'Monthly (Auto-Renew)', 0),
(2, 'Annually', 0),
(3, 'Multiyear', 0),
(4, 'Monthly', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_b_e`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_b_e` (
  `maintenance_sub_ve_id` int(11) NOT NULL auto_increment,
  `maintenance_sub_vee_cb_int` int(11) NOT NULL default '0' COMMENT 'MX Event ID',
  `maintenance_sub_vee_cb_txt` text,
  `maintenance_sub_vev_cb_int` int(11) NOT NULL default '0' COMMENT 'Building ID',
  `maintenance_sub_vev_cb_txt` text,
  `maintenance_sub_ve_date` date NOT NULL,
  `maintenance_sub_ve_years` int(11) default NULL,
  `maintenance_sub_ve_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`maintenance_sub_ve_id`),
  KEY `maintenance_sub_vee_cb_int` (`maintenance_sub_vee_cb_int`),
  KEY `maintenance_sub_vev_cb_int` (`maintenance_sub_vev_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_b_e`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_b_o`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_b_o` (
  `maintenance_sub_vo_id` int(11) NOT NULL auto_increment,
  `maintenance_sub_voe_cb_int` int(11) NOT NULL default '0' COMMENT 'MX Event ID',
  `maintenance_sub_voe_cb_txt` text,
  `maintenance_sub_vo_by_cb_int` int(11) NOT NULL default '0' COMMENT 'System User ID',
  `maintenance_sub_vo_by_cb_txt` text,
  `maintenance_sub_vov_cb_int` int(11) NOT NULL COMMENT 'Building ID',
  `maintenance_sub_vov_cb_text` text,
  `maintenance_sub_vo_date` date default NULL,
  `maintenance_sub_vo_time` time NOT NULL default '00:00:00',
  `maintenance_sub_vo_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `maintenance_sub_vo_work` text,
  `maintenance_sub_vo_problems` text,
  `maintenance_sub_vo_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`maintenance_sub_vo_id`),
  KEY `maintenance_sub_voe_cb_int` (`maintenance_sub_voe_cb_int`),
  KEY `maintenance_sub_vo_by_cb_int` (`maintenance_sub_vo_by_cb_int`),
  KEY `maintenance_sub_vov_cb_int` (`maintenance_sub_vov_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_b_o`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_b_p`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_b_p` (
  `maintenance_sub_vp_id` int(11) NOT NULL auto_increment,
  `maintenance_sub_vpp_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vpp_cb_txt` text,
  `maintenance_sub_vpv_cb_int` int(11) NOT NULL default '0' COMMENT 'Building ID',
  `maintenance_sub_vpv_cb_txt` text,
  `maintenance_sub_vp_name` text,
  `maintenance_sub_vpo_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vpo_cb_txt` text,
  `maintenance_sub_vp_archived_yn` tinyint(1) NOT NULL default '0',
  `maintenance_sub_vp_modelnumber` text,
  `maintenance_sub_vp_serialnumber` text,
  `maintenance_sub_vp_vinnumber` text,
  `maintenance_sub_vp_image_txt` text COMMENT 'Location of Part Map image on Hard Disk',
  `maintenance_sub_vp_image_x` text COMMENT 'The X-Cord for the Top-Left Corner of this Part where it fits on the Building Map',
  `maintenance_sub_vp_image_y` text COMMENT 'The Y-Cord for the Top-Left Corner of this Part where it fits on the Building Map',
  PRIMARY KEY  (`maintenance_sub_vp_id`),
  KEY `maintenance_sub_vpp_cb_int` (`maintenance_sub_vpp_cb_int`),
  KEY `maintenance_sub_vpv_cb_int` (`maintenance_sub_vpv_cb_int`),
  KEY `maintenance_sub_vpo_cb_int` (`maintenance_sub_vpo_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_b_p`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_e`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_e` (
  `mxevent_id` int(11) NOT NULL auto_increment,
  `mxevent_name` text,
  `mxevent_ascpart_cb_int` int(11) NOT NULL,
  `mxevent_ascpart_cb_txt` text,
  `mxevent_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`mxevent_id`),
  KEY `mxevent_ascpart_cb_int` (`mxevent_ascpart_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_e`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_e_o`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_e_o` (
  `maintenance_sub_vo_id` int(11) NOT NULL auto_increment,
  `maintenance_sub_voe_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_voe_cb_txt` text,
  `maintenance_sub_vo_by_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vo_by_cb_txt` text,
  `maintenance_sub_vov_cb_int` int(11) NOT NULL,
  `maintenance_sub_vov_cb_text` text,
  `maintenance_sub_vo_date` date default NULL,
  `maintenance_sub_vo_time` time NOT NULL default '00:00:00',
  `maintenance_sub_vo_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `maintenance_sub_vo_work` text,
  `maintenance_sub_vo_problems` text,
  `maintenance_sub_vo_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`maintenance_sub_vo_id`),
  KEY `maintenance_sub_voe_cb_int` (`maintenance_sub_voe_cb_int`),
  KEY `maintenance_sub_vo_by_cb_int` (`maintenance_sub_vo_by_cb_int`),
  KEY `maintenance_sub_vov_cb_int` (`maintenance_sub_vov_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_e_o`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_e_p`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_e_p` (
  `maintenance_sub_vp_id` int(11) NOT NULL auto_increment,
  `maintenance_sub_vpp_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vpp_cb_txt` text,
  `maintenance_sub_vpv_cb_int` int(11) NOT NULL default '0' COMMENT 'Equipment ID',
  `maintenance_sub_vpv_cb_txt` text,
  `maintenance_sub_vp_name` text,
  `maintenance_sub_vpo_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vpo_cb_txt` text,
  `maintenance_sub_vp_archived_yn` tinyint(1) NOT NULL default '0',
  `maintenance_sub_vp_modelnumber` text,
  `maintenance_sub_vp_serialnumber` text,
  `maintenance_sub_vp_vinnumber` text,
  PRIMARY KEY  (`maintenance_sub_vp_id`),
  KEY `maintenance_sub_vpp_cb_int` (`maintenance_sub_vpp_cb_int`),
  KEY `maintenance_sub_vpv_cb_int` (`maintenance_sub_vpv_cb_int`),
  KEY `maintenance_sub_vpo_cb_int` (`maintenance_sub_vpo_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_e_p`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_p`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_p` (
  `maintenance_part_id` int(11) NOT NULL auto_increment,
  `maintenance_part_name` text,
  `maintenance_part_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`maintenance_part_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_p`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_p_p`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_p_p` (
  `maintenance_sub_vp_id` int(11) NOT NULL auto_increment,
  `maintenance_sub_vpv_cb_int` int(11) default NULL,
  `maintenance_sub_vpv_cb_txt` text,
  `maintenance_sub_vp_name` text,
  `maintenance_sub_vp_archived_yn` tinyint(1) default '0',
  `maintenance_sub_vp_widthfeet` double default NULL,
  `maintenance_sub_vp_lengthfeet` double default NULL,
  `maintenance_sub_vp_squarefeet` double default NULL,
  `maintenance_sub_vp_image_txt` text COMMENT 'Image location on the Hard Disk',
  `maintenance_sub_vp_image_x` text COMMENT 'X-Cord of the top left corner of the image',
  `maintenance_sub_vp_image_y` text COMMENT 'Y-Cord of the top left corner of the image',
  PRIMARY KEY  (`maintenance_sub_vp_id`),
  KEY `maintenance_sub_vpv_cb_int` (`maintenance_sub_vpv_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_p_p`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_pv_e`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_pv_e` (
  `maintenance_sub_ve_id` int(11) NOT NULL auto_increment,
  `maintenance_sub_vee_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vee_cb_txt` text,
  `maintenance_sub_vev_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vev_cb_txt` text,
  `maintenance_sub_ve_date` date NOT NULL,
  `maintenance_sub_ve_years` int(11) default NULL,
  `maintenance_sub_ve_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`maintenance_sub_ve_id`),
  KEY `maintenance_sub_vee_cb_int` (`maintenance_sub_vee_cb_int`),
  KEY `maintenance_sub_vev_cb_int` (`maintenance_sub_vev_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_pv_e`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_pv_o`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_pv_o` (
  `maintenance_sub_vo_id` int(11) NOT NULL auto_increment,
  `maintenance_sub_voe_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_voe_cb_txt` text,
  `maintenance_sub_vo_by_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vo_by_cb_txt` text,
  `maintenance_sub_vov_cb_int` int(11) NOT NULL,
  `maintenance_sub_vov_cb_text` text,
  `maintenance_sub_vo_date` date default NULL,
  `maintenance_sub_vo_time` time NOT NULL default '00:00:00',
  `maintenance_sub_vo_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `maintenance_sub_vo_work` text,
  `maintenance_sub_vo_problems` text,
  `maintenance_sub_vo_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`maintenance_sub_vo_id`),
  KEY `maintenance_sub_voe_cb_int` (`maintenance_sub_voe_cb_int`),
  KEY `maintenance_sub_vo_by_cb_int` (`maintenance_sub_vo_by_cb_int`),
  KEY `maintenance_sub_vov_cb_int` (`maintenance_sub_vov_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_pv_o`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_pv_p`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_pv_p` (
  `pavement_sub_id` int(11) NOT NULL auto_increment,
  `pavement_sub_name` text,
  `pavement_sub_archived_yn` tinyint(1) NOT NULL default '0',
  `pavement_sub_mtype_cb_int` int(11) NOT NULL,
  `pavement_sub_mtype_cb_txt` text,
  `pavement_sub_stresslevel` text NOT NULL,
  `pavement_sub_dateinstalled` date NOT NULL,
  `pavement_sub_dateremoved` date NOT NULL,
  `pavement_sub_depth` double NOT NULL,
  `pavement_sub_parent_id` int(11) NOT NULL,
  PRIMARY KEY  (`pavement_sub_id`),
  KEY `pavement_sub_parent_id` (`pavement_sub_parent_id`),
  KEY `pavement_sub_mtype_cb_int` (`pavement_sub_mtype_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_pv_p`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_t_e`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_t_e` (
  `maintenance_sub_ve_id` int(11) NOT NULL auto_increment,
  `maintenance_sub_vee_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vee_cb_txt` text,
  `maintenance_sub_vev_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vev_cb_txt` text,
  `maintenance_sub_ve_date` date NOT NULL,
  `maintenance_sub_ve_years` int(11) default NULL,
  `maintenance_sub_ve_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`maintenance_sub_ve_id`),
  KEY `maintenance_sub_vee_cb_int` (`maintenance_sub_vee_cb_int`),
  KEY `maintenance_sub_vev_cb_int` (`maintenance_sub_vev_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_t_e`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_t_o`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_t_o` (
  `maintenance_sub_vo_id` int(11) NOT NULL auto_increment,
  `maintenance_sub_voe_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_voe_cb_txt` text,
  `maintenance_sub_vo_by_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vo_by_cb_txt` text,
  `maintenance_sub_vov_cb_int` int(11) NOT NULL,
  `maintenance_sub_vov_cb_text` text,
  `maintenance_sub_vo_date` date default NULL,
  `maintenance_sub_vo_time` time NOT NULL default '00:00:00',
  `maintenance_sub_vo_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `maintenance_sub_vo_work` text,
  `maintenance_sub_vo_problems` text,
  `maintenance_sub_vo_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`maintenance_sub_vo_id`),
  KEY `maintenance_sub_voe_cb_int` (`maintenance_sub_voe_cb_int`),
  KEY `maintenance_sub_vo_by_cb_int` (`maintenance_sub_vo_by_cb_int`),
  KEY `maintenance_sub_vov_cb_int` (`maintenance_sub_vov_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_t_o`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_t_p`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_t_p` (
  `maintenance_sub_vp_id` int(11) NOT NULL auto_increment,
  `maintenance_sub_vpp_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vpp_cb_txt` text,
  `maintenance_sub_vpv_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vpv_cb_txt` text,
  `maintenance_sub_vp_name` text,
  `maintenance_sub_vpo_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vpo_cb_txt` text,
  `maintenance_sub_vp_archived_yn` tinyint(1) NOT NULL default '0',
  `maintenance_sub_vp_modelnumber` text,
  `maintenance_sub_vp_serialnumber` text,
  `maintenance_sub_vp_vinnumber` text,
  PRIMARY KEY  (`maintenance_sub_vp_id`),
  KEY `maintenance_sub_vpp_cb_int` (`maintenance_sub_vpp_cb_int`),
  KEY `maintenance_sub_vpv_cb_int` (`maintenance_sub_vpv_cb_int`),
  KEY `maintenance_sub_vpo_cb_int` (`maintenance_sub_vpo_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_t_p`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_v_e`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_v_e` (
  `maintenance_sub_ve_id` int(11) NOT NULL auto_increment,
  `maintenance_sub_vee_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vee_cb_txt` text,
  `maintenance_sub_vev_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vev_cb_txt` text,
  `maintenance_sub_ve_miles` text,
  `maintenance_sub_ve_hours` int(11) default '0',
  `maintenance_sub_ve_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`maintenance_sub_ve_id`),
  KEY `maintenance_sub_vee_cb_int` (`maintenance_sub_vee_cb_int`),
  KEY `maintenance_sub_vev_cb_int` (`maintenance_sub_vev_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_v_e`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_v_o`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_v_o` (
  `maintenance_sub_vo_id` int(11) NOT NULL auto_increment,
  `maintenance_sub_voe_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_voe_cb_txt` text,
  `maintenance_sub_vo_by_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vo_by_cb_txt` text,
  `maintenance_sub_vov_cb_int` int(11) NOT NULL,
  `maintenance_sub_vov_cb_text` text,
  `maintenance_sub_vo_date` date default NULL,
  `maintenance_sub_vo_time` time NOT NULL default '00:00:00',
  `maintenance_sub_vo_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `maintenance_sub_vo_work` text,
  `maintenance_sub_vo_problems` text,
  `maintenance_sub_vo_archived_yn` tinyint(1) NOT NULL default '0',
  `maintenance_sub_vo_miles` double NOT NULL default '0',
  `maintenance_sub_vo_hours` double NOT NULL default '0',
  PRIMARY KEY  (`maintenance_sub_vo_id`),
  KEY `maintenance_sub_voe_cb_int` (`maintenance_sub_voe_cb_int`),
  KEY `maintenance_sub_vo_by_cb_int` (`maintenance_sub_vo_by_cb_int`),
  KEY `maintenance_sub_vov_cb_int` (`maintenance_sub_vov_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_v_o`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_sub_v_p`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_sub_v_p` (
  `maintenance_sub_vp_id` int(11) NOT NULL auto_increment,
  `maintenance_sub_vpp_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vpp_cb_txt` text,
  `maintenance_sub_vpv_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vpv_cb_txt` text,
  `maintenance_sub_vp_name` text,
  `maintenance_sub_vpo_cb_int` int(11) NOT NULL default '0',
  `maintenance_sub_vpo_cb_txt` text,
  `maintenance_sub_vp_archived_yn` tinyint(1) NOT NULL default '0',
  `maintenance_sub_vp_modelnumber` text,
  `maintenance_sub_vp_serialnumber` text,
  `maintenance_sub_vp_vinnumber` text,
  PRIMARY KEY  (`maintenance_sub_vp_id`),
  KEY `maintenance_sub_vpp_cb_int` (`maintenance_sub_vpp_cb_int`),
  KEY `maintenance_sub_vpv_cb_int` (`maintenance_sub_vpv_cb_int`),
  KEY `maintenance_sub_vpo_cb_int` (`maintenance_sub_vpo_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Lists the Parts to Vehicles in inventory' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_maintenance_sub_v_p`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_navigational_control`
--

CREATE TABLE IF NOT EXISTS `tbl_navigational_control` (
  `menu_item_id` int(10) NOT NULL auto_increment,
  `menu_item_location` longtext,
  `menu_item_name_long` longtext,
  `menu_item_name_short` longtext,
  `menu_item_purpose` longtext,
  `menu_item_slaved_to_id` int(10) default NULL,
  `menu_item_archived_yn` tinyint(1) NOT NULL,
  KEY `menu_item_id` (`menu_item_id`),
  KEY `menu_item_slaved_to_id` (`menu_item_slaved_to_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=393 ;

--
-- Dumping data for table `tbl_navigational_control`
--

INSERT INTO `tbl_navigational_control` (`menu_item_id`, `menu_item_location`, `menu_item_name_long`, `menu_item_name_short`, `menu_item_purpose`, `menu_item_slaved_to_id`, `menu_item_archived_yn`) VALUES
(1, 'unslaved', 'Field Condition Reporting', 'FiCONs', 'Root Menu for Field Condition Reports', 200, 0),
(2, 'unslaved', 'Plant and Animal Control', 'PAC', 'Main Menu Listing for Plant and Animal Control', 200, 0),
(3, 'unslaved', 'Airport Activity Reporting', 'AAR', 'Root Menu for Airport Activity Reporting', 200, 0),
(4, 'unslaved', 'Payroll and Timesheets', 'Paytime', 'Root Menu for Payroll and Timesheets', 200, 0),
(5, 'unslaved', 'Inspection Checklists', 'Inspections', 'Root Menu for Inspection Checklists', 200, 0),
(6, 'unslaved', 'Security Reporting', 'Security', 'Root Menu for Security Reporting', 200, 0),
(7, 'unslaved', 'Airport Rescue and Fire Fighting', 'ARFF', '', 200, 0),
(8, 'unslaved', 'Fueling and Maintenance', 'Fuel & Mx', NULL, 200, 0),
(9, 'unslaved', 'Inventory Control', 'Inventory', NULL, 200, 0),
(10, 'unslaved', 'Administrative Functions', 'Admin Functions', NULL, 200, 0),
(11, 'unslaved', 'Accounting Records', 'Accounting', NULL, 200, 0),
(12, 'unslaved', 'Lease Agreements', 'Leases', NULL, 200, 0),
(13, 'unslaved', 'Website Control', 'Website', NULL, 200, 0),
(14, 'unslaved', 'Weather Information', 'Weather', NULL, 200, 0),
(15, 'unslaved', 'Access Control', 'Access', 'Functions to control Access Control Media', 6, 0),
(16, 'part139339_main_entry.php', 'New FiCON report', 'New', 'Use this form to add a new FiCON to the system. ', 1, 0),
(17, 'part139339_main_browse.php', 'Browse FiCONs', 'Browse', 'Use this form to browse Field Condition Reports', 1, 0),
(18, 'ficon_data_chart.php', 'FiCON Chart Generator', 'Chart', NULL, 1, 0),
(19, 'payroll_timesheet_entry.php', 'New TimeSheet', 'New', NULL, 2, 0),
(20, 'payroll_timesheet_browse.php', 'Browse Your TimeSheets', 'Browse', NULL, 2, 0),
(21, 'unslaved', 'Payroll and TimeSheet Controls', 'Controls', NULL, 4, 0),
(22, 'unslaved', 'Notam Management', 'NOTAMs', NULL, 1, 0),
(24, 'unslaved', 'Physical key Management', 'Keys', NULL, 15, 0),
(25, 'unslaved', 'Gate Proxy Cards', 'Gate Cards', NULL, 15, 0),
(26, 'unslaved', 'Menu Functions', 'Menus', NULL, 10, 0),
(27, 'unslaved', 'Part 91 Activity', 'Part 91', NULL, 3, 0),
(28, 'unslaved', 'Part 121 Activity', 'Pat 121', NULL, 3, 0),
(29, 'unslaved', 'Part 135 Activity', 'Part 135', NULL, 3, 0),
(30, 'unslaved', 'Duty Log', 'Duty Log', NULL, 3, 0),
(31, 'unslaved', 'Fuel Flow Activity', 'Fuel Flow', NULL, 3, 0),
(32, 'unslaved', 'Duty Roster', 'Duty Roster', NULL, 7, 0),
(33, 'unslaved', 'FiCON Template Management', 'Templates', NULL, 1, 0),
(34, 'ficon_data_preinsp.php', 'Generate Pre Inspection Checklist', 'PreInsp Chklst', NULL, 1, 0),
(35, 'unslaved', 'Accounts Receivable', 'A.R.', NULL, 11, 0),
(36, 'unslaved', 'Business Listings', 'Clintal', NULL, 11, 0),
(37, 'unslaved', 'Budget', 'Budget', NULL, 11, 0),
(38, 'unslaved', 'Accounts Payable', 'A.P.', NULL, 11, 0),
(39, 'unslaved', 'Vehicle Fueling', 'Vx Fuel', NULL, 8, 0),
(41, 'unslaved', 'Building Maintenance', 'Building Mx', '', 8, 0),
(42, 'unslaved', 'Vehicle Maintenance', 'Vehicle Mx', 'Menu structure for Vehicle Maintenance Options', 8, 0),
(43, 'unslaved', 'Presision Approach Path Indicator Inspections', 'P.A.P.I.', NULL, 5, 0),
(44, 'unslaved', 'Medium Approach Lighting System with Alignment Indicator Inspections', 'M.A.L.S.A.R.', NULL, 5, 0),
(45, 'unslaved', 'Vehicle Inspections', 'Vehicles', NULL, 5, 0),
(46, 'unslaved', 'Building Inspections', 'Buildings', NULL, 5, 0),
(47, 'unslaved', 'Aifield Safety Self Inspections', 'Part 139.327', NULL, 5, 0),
(48, 'unslaved', 'Fire Safety Self Inspections', 'Fire Safety', NULL, 5, 0),
(52, 'leases_main_browse.php', 'Browse Lease Agreements', 'Browse', '', 12, 0),
(53, 'leases_main_entry.php', 'New Lease Agreement', 'New', '', 12, 0),
(54, 'unslaved', 'Lease Maps', 'Maps', NULL, 12, 0),
(55, 'unslaved', 'Monthly Security Reports', 'Monthly Reports', NULL, 6, 0),
(56, 'unslaved', 'No Fly and Selectee Lists Reports', 'No Fly & Selectee', NULL, 6, 0),
(57, 'unslaved', 'Security Inspections', 'Inspections', NULL, 6, 0),
(58, 'unslaved', 'Training and Education', 'Schooling', NULL, 200, 0),
(64, 'weather_maps.php', 'Weather Maps', 'Maps', 'Here are some weather maps', 14, 0),
(65, 'weather_charts_graphs.php', 'Charts, Graphs, and Text', 'MetarDownloader', '', 14, 0),
(66, 'unslaved', 'Features', 'Features', NULL, 13, 0),
(67, 'unslaved', 'Requests for Proposals', 'RFPs', NULL, 13, 0),
(68, 'unslaved', 'Flight Information Display System', 'F.I.D.S.', NULL, 13, 0),
(69, 'unslaved', 'Travel Tips', 'Travel Tips', NULL, 13, 0),
(71, 'unslaved', 'News and Events', 'N & E', NULL, 13, 0),
(72, 'unslaved', 'Lost and Found', 'L & F', NULL, 13, 0),
(73, 'unslaved', 'General Content', 'Content', NULL, 13, 0),
(74, 'unslaved', 'Wildlife Management', 'Wildlife', NULL, 2, 0),
(75, 'unslaved', 'Spraying Operations', 'Spraying', NULL, 2, 0),
(76, 'accounting_ap_data_entry.php', 'New Accounts Payable', 'New', NULL, 38, 0),
(77, 'accounting_ap_data_browse.php', 'Browse Accounts Payable', 'Browse', NULL, 38, 0),
(78, 'accounting_ar_data_entry.php', 'New Accounts Receivable', 'New', NULL, 35, 0),
(79, 'accounting_ar_data_browse.php', 'Browse Accounts Receivable', 'Browse', NULL, 35, 0),
(80, 'part139327_main_entry.php', 'New Airfield Safety Self Inspection', 'New', '', 47, 0),
(81, 'part139327_main_browse.php', 'Browse Airfield Safety Self Inspections', 'Browse', '', 47, 0),
(82, 'part139327_sub_d_browse.php', 'Discrepancy Monitor', 'Discrepancies', 'Here you can monitor and track discrepancies', 47, 0),
(83, 'part139327_sub_d_chart.php', 'Discrepancy Chart Generator', 'Discrepancy Chart', 'To make a visual printout of your discrepancies', 47, 0),
(84, 'part139327_main_preinsp.php', 'Airfield Safety Self Inspection Pre Inspection Checklist', 'Preinsp Chklst', '', 47, 0),
(87, 'accounting_budget_cf_entry.php', 'New Category Fund', 'New Category', NULL, 37, 0),
(88, 'accounting_budget_ct_browse.php', 'Browse Category Types', 'Browse Category Types', NULL, 37, 0),
(89, 'accounting_budget_bf_entry.php', 'New Budget Year Funds', 'New Budget Year Funds', NULL, 37, 0),
(90, 'accounting_budget_ct_entry.php', 'New Category Type', 'New Category Type', NULL, 37, 0),
(91, 'accounting_budget_bf_browse.php', 'Browse Budget Year Funds', 'Browse Budget Year Funds', NULL, 37, 0),
(92, 'accounting_budget_cf_browe.php', 'Browse Category Funds', 'Browse Category Funds', NULL, 37, 0),
(93, 'accounting_budget_by_browse.php', 'Browse Budget Years', 'browse Budget Years', NULL, 37, 0),
(94, 'inspections_buildings_entry.php', 'Enter New Building Inspection Report', 'New', 'Please use this form to add new building inspections', 46, 0),
(95, 'maintenance_sub_bo_browse.php', 'Browse Building Maintenance Operations', 'Browse', 'Here is the information you requested', 41, 0),
(96, 'maintenance_sub_bo_entry.php', 'Enter New Building Maintenance Operation', 'New', 'Please use this form to enter a new Building Maintenance Operation', 41, 0),
(97, 'inspections_buildings_browse.php', 'Browse Building Inspection Records', 'Browse', 'use this form to browse building inspection records', 46, 0),
(98, 'accounting_ou_data_chart.php', 'Over Under Data Chart', 'Over / Under', NULL, 99, 0),
(99, 'unslaved', 'Charts and Graphs', 'ChartsGraphs', NULL, 11, 0),
(100, 'accounting_ap_data_chart.php', 'Payables', 'Payables', NULL, 99, 0),
(101, 'accounting_cl_data_chart.php', 'Cascading Linier', 'C / L', NULL, 99, 0),
(102, 'clients_data_browse', 'Browse Business Listings', 'Browse', NULL, 36, 0),
(103, 'clients_data_entry.php', 'New Business Listing', 'New', NULL, 36, 0),
(104, 'duty_data_entry.php', 'New Duty Log Record', 'New', NULL, 30, 0),
(105, 'duty_data_browse.php', 'Browse Duty Logs', 'Browse', 'use this form to browse duty log records', 30, 0),
(106, 'fire_duty_data_entry.php', 'New Duty Roster Record', 'New', NULL, 32, 0),
(107, 'fire_duty_data_browse.php', 'Browse Duty Rosters', 'Browse', NULL, 32, 0),
(108, 'APCIC_fids_display.php', 'Launch FIDS', 'Launch', NULL, 68, 0),
(109, 'APCIC_flt_browse.php', 'Manage Flight Information', 'Browse', NULL, 68, 0),
(110, 'APCIC_features_browse.php', 'Browse Features', 'Browse', 'Here is the information you requested', 66, 0),
(111, 'APCIC_features_entry.php', 'New Feature', 'New', 'Please use this form to add a new feature to the system', 66, 0),
(112, 'fire_data_browse.php', 'Browse Fire Safety Inspections', 'Browse', NULL, 48, 0),
(113, 'fire_data_entry.php', 'New Fire Safety Inspection', 'New', NULL, 48, 0),
(114, 'fuelflowoperations_browse.php', 'Browse Fuel Flow Activity', 'Browse', '', 31, 0),
(115, 'fuelflowoperations_entry.php', 'New Fuel Flow Activity Report', 'New', 'Please complete this form to enter a new Fuel Flow Operation', 31, 0),
(121, 'timesheet_admin_purge.asp', 'Purge Old Time Sheets', 'Purge', NULL, 21, 0),
(122, 'part139339_sub_n_main_entry.php', 'Enter New Notam', 'New', 'Please use this form to add a new NOTAM to the system', 22, 0),
(123, 'part139339_sub_n_main_browse.php', 'Browse NOTAMS', 'Browse', 'Use this form to browse Notice to AirMen (NOTAM)s', 22, 0),
(124, 'state_poison_main_entry.php', 'Enter New Spraying Operation', 'New', 'Use this form to add a new spraying operation report', 75, 0),
(125, 'part139337_main_entry.php', 'Enter New Wildlife Management Report', 'New', 'Please use this form to add a new Wildlife Management Report', 74, 0),
(126, 'part139337_main_browse.php', 'Browse Wildlife Reports', 'Browse', 'Here is the information you requested', 74, 0),
(127, 'http://wildlife.pr.erau.edu/strikeform/birdstrikeform.html', 'Bird strike 5200 Report Form', 'Bird Strike Form', NULL, 74, 0),
(128, 'spray_data_browse.asp', 'Browse Spraying Operations', 'Browse', NULL, 75, 0),
(129, 'part139303_main_entry.php', 'Enter New Part 139.303 Training Record', 'New', 'Please use this form to add a new Part 139.303 Training Session', 58, 0),
(130, 'part139303_main_browse.php', 'Browse Part 139.303 Training Records', 'Browse', 'Here is the information you requested', 58, 0),
(135, 'security_sa_data_entry.asp', 'Enter New Sterile Area Inspection', 'New', NULL, 55, 0),
(136, 'security_sa_data_browse.asp', 'Browse Sterile Area Inspections', 'Browse', NULL, 55, 0),
(137, 'security_us_data_entry.asp', 'Enter New Unsecured Inspection', 'New', NULL, 55, 0),
(138, 'security_us_data_browse.asp', 'Browse Unsecured Inspection', 'Browse', NULL, 55, 0),
(139, 'security_alarm_data_entry.asp', 'Enter New Alarm Test Report', 'New Alarm Test', NULL, 55, 0),
(140, 'security_nf_data_entry.asp', 'Enter New No Fly Report', 'New No Fly', NULL, 55, 0),
(141, 'security_sl_data_entry.asp', 'Enter New Selectee Report', 'New Selectee', NULL, 55, 0),
(142, 'security_nf_data_browse.asp', 'Browse No Fly Reports', 'Browse No Fly', NULL, 56, 0),
(143, 'security_sl_data_browse.asp', 'Browse Selectee Reports', 'Browse Selectee', NULL, 56, 0),
(144, 'security_alarm_data_browse.asp', 'Browse Alarm Tests', 'Browse Alarm', NULL, 57, 0),
(145, 'part121activity_main_browse.php', 'Browse 121 Monthly Activity Reports', 'Browse', 'Here is the information you requested', 28, 0),
(146, 'inspections_papi_entry.php', 'Enter New PAPI Inspection', 'New', 'Please use this form to ad a new PAPI inspection', 43, 0),
(147, 'inspections_papi_browse.php', 'Browse PAPI Inspections', 'Browse', 'Here is the information you requested', 43, 0),
(148, 'inspections_malsr_entry.php', 'Enter New MALSR Inspection', 'New', 'Please use this form to add a new MALSR inspection', 44, 0),
(149, 'inspections_malsr_browse.php', 'Browse MALSR Inspections', 'Browse', 'Here is the information you requested', 44, 0),
(155, 'part135activity_main_browse.php', 'Browse 135 Monthly Activity Reports', 'Browse', 'Here is the information you requested', 29, 0),
(157, 'fuelflow_sub_v_browse.php', 'Browse Vehicle Fuel Flow Operations', 'Browse', 'here is the information you requested', 39, 0),
(163, 'menu_item_data_entry.php', 'Enter New Menu Item', 'New', 'Enter a new menu item here', 207, 0),
(164, 'menu_item_data_browse.php', 'Browse Menu Items', 'Browse', '', 207, 0),
(166, 'APCIC_lf_entry.php', 'Enter New Lost and Found Item', 'New', 'Please use this form to add a new lost and found item to the system.', 72, 0),
(167, 'APCIC_lf_browse.php', 'Browse Lost and Found Items', 'Browse', 'Please use this form to look over the Lost and Found items.', 72, 0),
(168, 'APCIC_nae_entry.php', 'Enter New News and Event', 'New', 'Please use this form to add a new News or Event to the system', 71, 0),
(169, 'APCIC_nae_browse.php', 'Browse News and Events', 'Browse', 'Please use this form to look over news and events', 71, 0),
(170, 'APCIC_tt_entry.php', 'Enter New Travel Tip', 'New', 'Please use this form to add a new travel tip.', 69, 0),
(171, 'APCIC_tt_browse.php', 'Browse Travel Tips', 'Browse', 'Here is the information you requested', 69, 0),
(172, 'APCIC_rfp_entry.php', 'Enter New Request for Proposal', 'New', 'Please use this form to add new RFPs to the system.', 67, 0),
(173, 'APCIC_rfp_browse.php', 'Browse Requests for Proposals', 'Browse', 'Please use this form to browse RFPs', 67, 0),
(174, 'inspections_vehicles_entry.php', 'Enter New Vehicle Inspection Report', 'New', '', 45, 0),
(175, 'inspections_vehicles_browse.php', 'Browse Vehicle Inspection Reports', 'Browse', '', 45, 0),
(176, 'leases_main_map.php?subtype=1&objectid=1', 'Hangar 1', 'Hangar 1', NULL, 54, 0),
(177, 'leases_main_map.php?subtype=1&objectid=2', 'Hangar 3', 'Hangar 3', NULL, 54, 0),
(178, 'lease_sh_data_map_loader.asp', 'Stone Hangar', 'Stone Hangar', NULL, 54, 0),
(179, 'lease_tt_data_map_loader.asp', 'Terminal', 'Terminal', NULL, 54, 0),
(182, 'access_pc_main_entry.php', 'Enter New Gate Proxy Card Issuance', 'New', 'Please use this form to add a issue or retake a Proxy Card', 25, 0),
(183, 'access_pc_main_browse.php', 'Browse Gate Proxy Cards', 'Browse', 'Here is the information you requested', 25, 0),
(184, 'access_keys_main_entry.php', 'Enter New Physical Key Record', 'New', 'Please use this form to add a new key record to the database', 24, 0),
(185, 'access_keys_main_browse.php', 'Browse Physical Keys', 'Browse', 'Here is the information you requested', 24, 0),
(188, 'leases_main_map.php?subtype=2&objectid=26', 'T-H.E.A. - Block A', 'THEA - BA', 'Load a map of the T-Hangar Expansion Area - BLock A', 54, 0),
(189, 'part139337_yearend.php', 'Depredation permit Year End Report', 'Year End Report', 'Here is a summary of the actions taken for specific species over the course of the year.', 74, 0),
(190, 'ficon_template_data_browse.asp', 'Browse FiCON Templates', 'Browse', NULL, 33, 0),
(191, 'ficon_template_data_entry.asp', 'Enter New FiCON Template', 'New', NULL, 33, 0),
(192, 'APCIC_wsc_browse.php', 'Browse General Content', 'Browse', 'Here is the information you requested', 73, 0),
(193, 'APCIC_wsc_entry.php', 'Add New General Content', 'New', NULL, 73, 0),
(194, 'part135activity_main_entry.php', 'Enter New Part 135 Monthly Activity Report', 'New', 'Use this form to enter a new Part 135 Monthly Operational Report', 29, 0),
(195, 'activity_data_entry_091.asp', 'Enter New Part 91 Monthly Activity Report', 'New', NULL, 27, 0),
(196, 'part121activity_main_entry.php', 'Enter New Part 121 Monthly Activity Report', 'New', 'Use this form to enter a new Part 121 Activity Monthly Report', 28, 0),
(197, 'activity_data_entry_121_daily.asp', 'Enter New Part 121 Daily Summary Report', 'New', '', 28, 1),
(198, 'activity_data_browse_121_daily.asp', 'Browse Part 121 Daily Activity Reports', 'New', NULL, 28, 0),
(199, 'phpmyadmin/index.php', 'phpMyAdmin', 'phpMyAdmin', 'To use PhpmyAdmin', 10, 0),
(200, 'unslaved', 'Root', 'Root', 'Root Place Holder', 200, 0),
(201, 'unslaved', 'Access Restrictions', 'Access', 'the purpose of this menu item to control what user/groups have access to what menu items', 26, 0),
(202, 'menu_item_level_data_entry.php', 'New Menu Item Access Level', 'New', 'the purpose of this menu item is to allow the admistrator to add a new menu item to a user or group', 201, 0),
(203, 'menu_item_level_data_browse.php', 'Browse Menu Item Access Levels', 'Browse', 'the purpose of this menu item is to allow the administrator to view menu item access levels and do other related functions.', 201, 0),
(204, 'unslaved', 'System Users', 'Users', 'Menu Structure for System Users', 10, 0),
(205, 'systemusers_data_browse.php', 'Browse System Users', 'Browse', 'here is the listing you requested', 204, 0),
(206, 'systemusers_data_entry.php', 'Enter New Systemuser', 'New', 'Here you can enter a new systemuser', 204, 0),
(207, 'unslaved', 'Menu Items', 'Items', 'Menu Item Place Holder', 26, 0),
(208, 'unslaved', 'Access Levels', 'Access', 'Menu Structure for systemuser access levels', 204, 0),
(209, 'systemusers_level_data_entry.php', 'Enter new System User Access Level', 'New', 'Complete the provided form', 208, 0),
(210, 'systemusers_level_data_browse.php', 'Browse Systemuser Access Levels', 'Browse', 'here is the information you requested', 208, 0),
(214, 'unslaved', 'Types of Part 139.327 Inspections', 'Types', 'Menu Structure', 381, 0),
(215, 'part139327_sub_t_browse.php', 'Browse Type of Part 139.327 Inspections', 'Browse', 'Here is the information you requested', 214, 0),
(216, 'part139327_sub_t_entry.php', 'Enter New Type of Part 139.327 Inspection', 'New', 'Please complete the form', 214, 0),
(217, 'unslaved', 'Types of Part 139.327 Conditions', 'Conditions', 'Menu Structure', 381, 0),
(218, 'part139327_sub_c_browse.php', 'Browse Type of Part 139.327 Conditions', 'Browse', 'Here is the information you requested', 217, 0),
(219, 'part139327_sub_c_entry.php', 'Enter New Part 139.327 Condition', 'New', 'Please complete the form', 217, 0),
(220, 'unslaved', 'Types of Part 139.327 Facilities', 'Facilities', 'Menu Structure', 381, 0),
(221, 'part139327_sub_f_browse.php', 'Browse Types of Part 139.327 Facilities', 'Browse', 'Here is the information you requested', 220, 0),
(222, 'part139327_sub_f_entry.php', 'Enter New Part 139.327 Faciltiy', 'New', 'Please complete the form', 220, 0),
(223, 'organizations_data_browse.php', 'Browse Organizations', 'Browse', 'here is the information you selected', 225, 0),
(224, 'organizations_data_entry.php', 'Enter New Organization', 'New', 'Enter a new Organization', 225, 0),
(225, 'unslaved', 'Organizations', 'Organizations', 'Menu structure for organizations', 10, 0),
(226, 'unslaved', 'Types of Organizations', 'Types', 'Menu Structure for Org Types', 225, 0),
(227, 'organizations_sub_t_data_entry.php', 'Enter New Organization Type', 'New', 'Enter a New organization type', 226, 0),
(228, 'organizations_sub_t_data_browse.php', 'Browse Organization Types', 'Browse', 'Here is the information you selected', 226, 0),
(229, 'unslaved', 'Fuel Tanks', 'Fuel Tanks', 'Menu structure for Fuel Tanks Inventory Item', 9, 0),
(230, 'unslaved', 'Types of Fuel Tanks', 'Types', 'Menu structure for Types of Fuel Tanks', 229, 0),
(231, 'inventory_tanks_sub_t_entry.php', 'Enter New Fuel Tank Type', 'New', 'Use this form to enter a new type of fuel tank', 230, 0),
(232, 'inventory_tanks_sub_t_browse.php', 'Browse Types of Fuel Tanks', 'Browse', 'here is the information you requested', 230, 0),
(233, 'inventory_tanks_browse.php', 'Browse Fuel Tanks', 'Browse', 'Here is the information you requested', 229, 0),
(234, 'inventory_tanks_entry.php', 'Enter New Fuel Tank', 'New', 'Use this form to enter in a new fuel tank', 229, 0),
(235, 'unslaved', 'Aircraft', 'Aircraft', 'Menu Structure for Admin level controling aircraft settings', 10, 0),
(236, 'unslaved', 'Types of Aircraft', 'Types', 'Menu structure for controling different types of aircraft', 235, 0),
(237, 'aircraft_sub_t_entry.php', 'Enter New Type of Aircraft', 'New', 'Use this form to enter a new type of aircraft', 236, 0),
(238, 'aircraft_sub_t_browse.php', 'Browse Types of Aircraft', 'Browse', 'Here is the information you requested', 236, 0),
(239, 'aircraft_data_browse.php', 'Browse Aircraft', 'Browse', 'Here is the information you requested', 235, 0),
(240, 'aircraft_data_entry.php', 'Enter New Aircraft', 'New', 'Use this form to enter a new aircraft', 235, 0),
(241, 'unslaved', 'Vehicles', 'Vehicles', 'Menu structure for Vehicle Inventory Items', 9, 0),
(242, 'unslaved', 'Types of Vehicles', 'Types', 'Menu struture for types of vehicles', 241, 0),
(243, 'inventory_vehicles_sub_t_browse.php', 'Browse Types of Vehicles', 'Browse', 'Here is the information you requested', 242, 0),
(244, 'inventory_vehicles_sub_t_entry.php', 'Enter New Type of Vehicle', 'New', 'Please use this form to enter a new type of vehicle', 242, 0),
(245, 'inventory_vehicles_browse.php', 'Browse Vehicles', 'Browse', 'Here is the information you requested', 241, 0),
(246, 'inventory_vehicles_entry.php', 'Enter New Vehicle', 'New', 'Please use this form to add a new vehicle to the database', 241, 0),
(247, 'unslaved', 'Maintenance', 'Maintenance', 'menu structure for maintenance system', 10, 0),
(248, 'unslaved', 'Maintenance Parts', 'Parts', 'Menu Structure for Maintenance Parts', 247, 0),
(249, 'maintenance_parts_data_browse.php', 'Browse Maintenance Parts', 'Browse', 'Here is the information you requested', 248, 0),
(250, 'maintenance_parts_data_entry.php', 'Enter New Maintenance Part', 'New', 'Please use this form to add a new maintenance part', 248, 0),
(251, 'unslaved', 'Vehicle Parts', 'Parts', 'Menu structure for vehicle parts', 42, 0),
(252, 'maintenance_sub_vp_browse.php', 'Browse Vehicle Parts', 'Browse', 'Here is the information you requested', 251, 0),
(253, 'maintenance_sub_vp_entry.php', 'Enter New Vehicle Part', 'New', 'Use this form to enter a new vehicle part', 251, 0),
(254, 'unslaved', 'Maintenance Events', 'Events', 'menu structure for maintenance events', 247, 0),
(255, 'maintenance_event_data_browse.php', 'Browse Maintenance Events', 'Browse', 'Here is the information you requested', 254, 0),
(256, 'maintenance_event_data_entry.php', 'Enter New Maintenance Event', 'New', 'Please use this form to enter a new maintenance event', 254, 0),
(257, 'unslaved', 'Vehicle Maintenance Events', 'Events', 'Menustructure for Vehicle maintenance Events', 42, 0),
(258, 'maintenance_sub_ve_browse.php', 'Browse Vehicle Maintenance Events', 'Browse', 'Here is the information you requested', 257, 0),
(259, 'maintenance_sub_ve_entry.php', 'Enter New Vehicle Maintenance Event', 'New', 'Please use this form to add a Vehicle Maintenance Event', 257, 0),
(260, 'maintenance_sub_vo_entry.php', 'Enter New Vehicle Maintenance Operation', 'New', 'Please use this form to enter a new Vehicle Maintenance Operations', 42, 0),
(261, 'maintenance_sub_vo_browse.php', 'Browse Vehicle Maintenance Operations', 'Browse', 'Here is the information you requested', 42, 0),
(262, 'fuelflow_sub_v_entry.php', 'Enter New Vehicle Fuel Flow Operations', 'New', 'Please use this form to enter a new Vehcile Fuel Flow Operation', 39, 0),
(263, 'unslaved', 'Fuel Tank Mx', 'Fuel Tank Mx', 'Menustructure for Fuel Tank Maintenance', 8, 0),
(264, 'unslaved', 'Fuel Tank Fueling', 'Fuel Tank Fueling', 'Menustructure for fueltank fueling', 8, 0),
(265, 'unslaved', 'Parts of Fuel Tanks', 'Parts', 'menustructure for part of fuel tanks', 263, 0),
(266, 'unslaved', 'Events for Fuel Tank Maintenance', 'Events', 'Menustructure for Events for Fuel Tank Maintenance', 263, 0),
(267, 'maintenance_sub_tp_browse.php', 'Browse Fuel Tank Maintenance Parts', 'Browse', 'Here is the information you requested', 265, 0),
(268, 'maintenance_sub_tp_entry.php', 'Enter New Fuel Tank Maintenance Part', 'New', 'Please use this form to enter any new maintenance parts for Fuel tanks', 265, 0),
(269, 'maintenance_sub_te_browse.php', 'Browse Fuel Tank Maintenance Events', 'Browse', 'Here is the information you requested', 266, 0),
(270, 'maintenance_sub_te_entry.php', 'Enter New Fuel Tank Maintenance Event', 'New', 'Please use this form to enter new Fuel Tank Maintenance Events', 266, 0),
(271, 'maintenance_sub_to_browse.php', 'Browse Fuel Tank Maintenance Operations', 'Browse', 'Here is the information you requested', 263, 0),
(272, 'maintenance_sub_to_entry.php', 'Enter New Fuel Tank Maintenance Operation', 'New', 'Please use this form to record maintenance work on fuel tanks', 263, 0),
(273, 'fuelflow_sub_t_browse.php', 'Browse Fuel Tank Fueling Operations', 'Browse', 'Here is the information you requested', 264, 0),
(274, 'fuelflow_sub_t_entry.php', 'Enter New Fuel Tank Fueling Operation', 'New', 'Please complete this form to enter in a new fuel tank fueling operation', 264, 0),
(275, 'unslaved', 'Parts for Buildings', 'Parts', 'Menu Structure for Building Parts', 41, 0),
(276, 'unslaved', 'Building Maintenance Events', 'Events', 'Menu Structure for Building Maintenance Events', 41, 0),
(277, 'maintenance_sub_bp_browse.php', 'Browse Bulding Maintenance Parts', 'Browse', 'Here is the information you requested', 275, 0),
(278, 'maintenance_sub_bp_entry.php', 'Enter New Building Maintenance Part', 'New', 'Please use this form to add new Building Maintenance Part', 275, 0),
(279, 'maintenance_sub_be_browse.php', 'Browse Building Maintenance Events', 'Browse', 'Here is the information you requested', 276, 0),
(280, 'maintenance_sub_be_entry.php', 'Enter New Building Maintenance Event', 'New', 'Please use this form to add new Building Maintenance Event', 276, 0),
(281, 'unslaved', 'Buildings', 'Buildings', 'Menu Structure for Building Inventry Items', 9, 0),
(282, 'unslaved', 'Types of Buildings in Inventory', 'Types', 'menu Stucture for Building Inventory Types', 281, 0),
(283, 'inventory_buildings_sub_t_entry.php', 'Enter New Type of Building in Inventory', 'New', 'Please use this form to enter a new type of building in inventory', 282, 0),
(284, 'inventory_buildings_sub_t_browse.php', 'Browse Types of Buildings in Inventory', 'Browse', 'Here is the information you requested', 282, 0),
(285, 'inventory_buildings_entry.php', 'Enter New Building in Inventory', 'New', 'Please use this form to add a new building to inventory', 281, 0),
(286, 'inventory_buildings_browse.php', 'Browse Buldings in Inventory', 'Browse', 'Here is the information you requested', 281, 0),
(287, 'unslaved', 'Property', 'Property', 'Menu structure for Property Inventory Information', 9, 0),
(288, 'unslaved', 'Types of Property', 'Types', 'Menu Structure for Types of Property', 287, 0),
(289, 'inventory_property_sub_t_browse.php', 'Browse Types of Property', 'Browse', 'Here is the information you requested', 288, 0),
(290, 'inventory_property_sub_t_entry.php', 'Enter New Type of Inventory', 'New', 'Please use this form to enter a new type of property', 288, 0),
(291, 'inventory_property_sub_t_entry.php', 'Enter New Type of Property', 'New', 'Please use this form to enter a new type of property', 288, 0),
(292, 'inventory_property_browse.php', 'Browse Property in Inventory', 'Browse', 'Here is the information you requested', 287, 0),
(293, 'inventory_property_entry.php', 'Enter New Property into Inventory', 'New', 'Please use this form to add new property into inventory', 287, 0),
(294, 'unslaved', 'Parts of Property in Inventory', 'Parts', 'Menu Structure for Parts of Property in Inventory', 287, 0),
(295, 'maintenance_sub_pp_browse.php', 'Browse Parts of Property in Inventory', 'Browse', 'Here is the information you requested', 294, 0),
(296, 'maintenance_sub_pp_entry.php', 'Enter New Part of Property in Inventory', 'New', 'Please use this form to add new Parts to Property in inventory', 294, 0),
(297, 'unslaved', 'Quick Info', 'Quick Info', 'Menu structure for quick info information', 10, 0),
(298, 'quickinfo_data_entry.php', 'Enter New Quick Info Option', 'New', 'Please use this form to add a new Quick Info Option', 300, 0),
(299, 'quickinfo_data_browse.php', 'Browse Quick Info Options', 'Browse', 'Here is the information you requested', 300, 0),
(300, 'unslaved', 'Quick Info Items', 'Items', 'Menustructure for Quick Info Items', 297, 0),
(301, 'unslaved', 'Quick Info Access Levels', 'Access', 'Menu structure for quick info access levels', 297, 0),
(302, 'quickinfo_level_data_browse.php', 'Browse Quick Info Access Levels', 'Browse', 'Here is the informtion you requested', 301, 0),
(303, 'quickinfo_level_data_entry.php', 'Enter New Quick Info Access Level', 'New', 'Please use this form to add a new quick info access level', 301, 0),
(304, 'unslaved', 'Wildlife Controls', 'Wildlife', 'Menu structure for Wildlife Controls Menu Options', 10, 0),
(305, 'unslaved', 'Wildlife Species Controls', 'Species', 'Menu Structure for Wildlife Species Controls', 304, 0),
(306, 'unslaved', 'Wildlife Activity Controls', 'Activity', 'Menu Structure for Wildlife Activity Controls', 304, 0),
(307, 'unslaved', 'Wildlife Action Controls', 'Actions', 'Menu Structure for Wildlife Action Controls', 304, 0),
(308, 'part139337_sub_s_browse.php', 'Browse Wildlife Species', 'Browse', 'Here is the information you requested', 305, 0),
(309, 'part139337_sub_s_entry.php', 'Enter New Wildlife Species', 'New', 'Please use this form to add a new species to the Wildlife Management Form', 305, 0),
(310, 'part139337_sub_an_browse.php', 'Browse Wildlife Control Actions', 'Browse', 'Here is the information you requested', 307, 0),
(311, 'part139337_sub_an_entry.php', 'Enter New Wildlife Control Action', 'New', 'Please use this form to add a new Wildlife Control Action', 307, 0),
(312, 'part139337_sub_ay_browse.php', 'Browse Wildlife Control Activity', 'Browse', 'Here is the information you requested', 306, 0),
(313, 'part139337_sub_ay_entry.php', 'Enter New Wildlife Control Activity', 'New', 'Please use this form to add a new wildlife activity control option', 306, 0),
(314, 'part139337_main_chart.php', 'Wildlife Hazard Summary Chart', 'Chart', 'Please use this form to select the types of wildlife to display and the time period from which to select them from', 74, 0),
(315, 'unslaved', 'Equipment / Fixtures', 'Equipment / Fixtures', 'Menu structure for Equipment / Fixtures', 9, 0),
(316, 'unslaved', 'Types of Equipment in Inventory', 'Types', 'Menu structure for Equipment in Inventory', 315, 0),
(317, 'inventory_equipment_browse.php', 'Browse Equipment / Fixtures in Inventory', 'Browse', 'Here is the Equipment / Fixtures that meet the informtion you requested.', 315, 0),
(318, 'inventory_equipment_entry.php', 'Enter New Equipment / Fixture in Inventory', 'New', 'Please use this form to add a new Equipment or Fixture to inventory', 315, 0),
(319, 'inventory_equipment_sub_t_browse.php', 'Browse Types of Equipment / Fixtures', 'Browse', 'here is the information you requested', 316, 0),
(320, 'inventory_equipment_sub_t_entry.php', 'Enter New Type of Equipment / Fixture in Inventory', 'New', 'Please use this form to add a new type of equipment or fixture in inventory', 316, 0),
(321, 'unslaved', 'Equipment / Fixture Maintenance', 'Equipment Mx', 'Menu structure for Equipment / Fixture Maintenance', 8, 0),
(322, 'maintenance_sub_eo_browse.php', 'Browse Equipment / Fixture Maintenance Operations', 'Browse', 'Here is the information you requested', 321, 0),
(323, 'maintenance_sub_eo_entry.php', 'Enter New Equipment / Fixture Maintenance Operation', 'New', 'Please use this form to add a new operational maintenance event affecting Equipment / Fixtures', 321, 0),
(324, 'unslaved', 'Parts for Equipment / Fixtures', 'Parts', 'Menu structure for parts with equipment / fixtures', 321, 0),
(325, 'maintenance_sub_ep_browse.php', 'Browse Equipment / Fixture Parts', 'Browse', 'here is the information you requested', 324, 0),
(326, 'maintenance_sub_ep_entry.php', 'Enter New Equipment / Fxiture Part', 'New', 'Please use this form to add a new equipment / fixture part', 324, 0),
(327, 'unslaved', 'General Settings', 'General Settings', 'Menu Structure for General Settings', 10, 0),
(328, 'unslaved', 'General Settings - Conditions', 'Conditions', 'Menu structure for general settings - conditions', 327, 0),
(329, 'general_settings_conditions_browse.php', 'Browse General Settings - Conditions', 'Browse', 'Here is the information you selected', 328, 0),
(330, 'general_settings_conditions_entry.php', 'Enter New General Settings - Conditions', 'New', 'Please use this form to add a new General Setting - Condition', 328, 0),
(331, 'unslaved', 'Pavement', 'Pavement', 'Menu structure for Inventory - Pavement', 9, 0),
(332, 'unslaved', 'Pavement Layers', 'Layers', 'Menu Structure for Inventory Pavement Layers', 331, 0),
(333, 'maintenance_sub_pvp_browse.php', 'Browse Inventory Pavement Layers', 'Browse', 'Here is the information you requested', 332, 0),
(334, 'maintenance_sub_pvp_entry.php', 'Enter New Inventory Pavement Layer', 'New', 'Please use this form to add new Inventory Pavement Layers', 332, 0),
(335, 'unslaved', 'Types of Pavement', 'Types', 'Menu Structure for Pavement Types', 331, 0),
(336, 'inventory_pavement_sub_t_entry.php', 'Enter New Type of Pavement', 'New', 'Please use this form to enter a new pavement type', 335, 0),
(337, 'inventory_pavement_sub_t_browse.php', 'Browse Types of Pavement in Inventory', 'Browse', 'Here is the information you requested', 335, 0),
(338, 'inventory_pavement_browse.php', 'Browse Pavement', 'Browse', 'Here is the information you requested', 331, 0),
(339, 'inventory_pavement_entry.php', 'Enter New Pavement Section', 'New', 'Please use this form to enter a new Pavement Section', 331, 0),
(340, 'unslaved', 'Pavement Maintenance', 'Pavement', 'Menu structure for pavement maintenance', 8, 0),
(341, 'unslaved', 'Pavement Maintenance Events', 'Events', 'Menu Structure for Pavement Maintenance Events', 340, 0),
(342, 'maintenance_sub_pve_browse.php', 'Browse Pavement Maintenance Events', 'Browse', 'Here is the information you requested', 341, 0),
(343, 'maintenance_sub_pve_entry.php', 'Enter New Pavement Maintenance Event', 'New', 'Please use this form to add a new pavement maintenance event', 341, 0),
(344, 'maintenance_sub_pvo_browse.php', 'Browse Pavement Maintenance Operations', 'Browse', 'Here is the information you requested', 340, 0),
(345, 'maintenance_sub_pvo_entry.php', 'Enter New Pavement Maintenance Operation', 'New', 'Please use this form to add a new Pavement Maintenance Operation', 340, 0),
(349, 'unslaved', 'Leases', 'Leases', 'Menu Structure for administrative lease functions', 10, 0),
(350, 'unslaved', 'Administration - Types of Leases', 'Types', 'Menu Structure for Lease Types', 349, 0),
(351, 'unslaved', 'Terms', 'Terms', 'Menu Structure for Lease Terms', 349, 0),
(352, 'leases_sub_terms_browse.php', 'Browse Lease Terms', 'Browse', 'Here is the information you requested', 351, 0),
(353, 'leases_sub_terms_entry.php', 'Enter New Lease Term', 'New', 'Please use this form to add a new lease term', 351, 0),
(354, 'leases_sub_t_browse.php', 'Browse Types of Leases', 'Browse', 'Here is the information you requested', 350, 0),
(355, 'leases_sub_t_entry.php', 'Enter New Type of Lease', 'New', 'Please use this form to add a new lease type', 350, 0),
(356, 'unslaved', 'Accounting - Admin', 'Accounting', 'Menu Strucure for Accounting Admin', 10, 0),
(357, 'unslaved', 'Accounting Payments', 'Payments', 'Menu Structure for Accounting Payments', 356, 0),
(358, 'accounting_sub_p_entry.php', 'Enter New Accounting - Payments', 'New', 'Please use this form to add a new accounting payments', 357, 0),
(359, 'accounting_sub_p_browse.php', 'Browse Accounting Payments', 'Browse', 'Here is the information you requested', 357, 0),
(360, 'unslaved', 'TimeSheets', 'TimeSheets', 'Menu structure for timesheets', 4, 0),
(361, 'timesheet_main_entry.php', 'Enter New TimeSheet', 'New', 'Please use this form to add a new timesheet event', 360, 0),
(362, 'timesheet_main_browse.php', 'Browse TimeSheet Events', 'Browse', 'Here is the information you requests', 360, 0),
(363, 'timesheet_main_browse.php', 'Browse Timesheets', 'Browse', 'Here is the information you requested', 360, 0),
(364, 'unslaved', 'Timesheet Controls', 'Timesheet', 'Menu structure for timesheet items', 10, 0),
(365, 'unslaved', 'Timesheet - Holidays', 'Holidays', 'Menu structure to control holidays used for timesheet purposes', 364, 0),
(366, 'unslaved', 'Timesheet - Months', 'Months', 'Menu structure for timesheet months', 364, 0),
(367, 'timesheet_sub_h_browse.php', 'Browse Timesheet Holidays', 'Browse', 'Here is the information you requested.', 365, 0),
(368, 'timesheet_sub_h_entry.php', 'Enter New Timesheet Holiday', 'New', 'Please use this form to add a new holiday for timesheets', 365, 0),
(369, 'timesheet_sub_m_browse.php', 'Browse Timesheet Months', 'Browse', 'Here is the information you requested', 366, 0),
(370, 'timesheet_sub_m_entry.php', 'Enter New Timesheet Month', 'New', 'Please use this form to add a new timesheet month', 366, 0),
(371, 'part139303_main_student_printout.php', 'Student Records', 'Students', 'Use this form to view student records', 58, 0),
(372, 'unslaved', 'Access Media', 'Access Media', 'Menu Structure for Access Media', 9, 0),
(373, 'unslaved', 'Key management', 'Keys', 'Menu Structure for Keys', 372, 0),
(374, 'inventory_access_keys_main_browse.php', 'Browse Keys in Inventory', 'Browse', 'Here is the information you requested', 373, 0),
(375, 'unslaved', 'Proxy Cards', 'Proxy', 'Menu Structure for Access Media (proxy Cards)', 372, 0),
(376, 'inventory_access_pc_main_browse.php', 'Browse Proxy Cards in Inventory', 'Browse', 'Here is the information you requested', 375, 0),
(377, 'unslaved', 'Municiple Utility Payment Tracker', 'Utilities', 'Menu structure for payments to be made to Municiple Utilities', 38, 0),
(378, 'accounting_utilities_main_browse.php', 'Browse Utility Payments', 'Browse', 'Here is the information you requested.', 377, 0),
(379, 'accounting_utilities_main_entry.php', 'Enter New Municiple Utility Payment', 'Entry', 'Please use this form to add a new municiple utilities payment.', 377, 0),
(380, 'unslaved', 'Inspection Controls', 'Inspection Controls', 'Menu Structure for Admin controls of Inspections', 47, 0),
(381, 'unslaved', '139.327 Admin Controls', '139.327 Admin', 'menu structure', 10, 0),
(382, 'part139339_main_entry_notmp.php', 'Enter New Field Condition Report', 'New', 'Please use this form to add a new Field Condition Report', 1, 0),
(383, 'leases_main_map.php?subtype=2&objectid=27', 'T Hangar Expansion Area - Block B', 'THEA - BB', 'Lease Map of the THEA - BB', 54, 0),
(384, 'leases_main_map.php?subtype=2&objectid=28', 'Hangar Space Four', 'HS - 4', 'Lease map of Hangar Space Four', 54, 0),
(385, 'unslaved', 'Capital Improvement Plan', 'CIP', 'Menu Structure for Capital Improvement Plan', 11, 0),
(386, 'unslaved', 'Replacement Schedule', 'Replacement', 'Please use this form to add a new entry to the CIP Replacement Schedule.', 385, 0),
(387, 'budget_cip_rs_entry.php', 'Enter New Replacement Schedule Object', 'New', 'Please use this form to add a new CIP Replacement Scedule Object', 386, 0),
(388, 'budget_cip_rs_browse.php', 'Browse CIP Replacement Schedule Objects', 'Browse', 'Here is the information you requested', 386, 0),
(389, 'budget_cip_rs_chart.php', 'Replacement Schedule Table', 'Table', 'This page displays the information in the replacement schedule in an easy to understand order.', 386, 0),
(390, 'unslaved', 'Vehicle Access Premissions', 'Vehicles', 'Menu structure for tracking vehicle access on the airfield.', 15, 0),
(391, 'access_vehicles_entry.php', 'Enter New Vehicle Access Premission', 'New', 'Please use this form to add a new vehicle access premission record', 390, 0),
(392, 'access_vehicles_browse.php', 'Browse Vehicle Access Premissions', 'Browse', 'Here is the information you requested', 390, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_navigational_control_g`
--

CREATE TABLE IF NOT EXISTS `tbl_navigational_control_g` (
  `navigational_groups_id` int(10) NOT NULL auto_increment,
  `navigational_groups_name` varchar(255) default NULL,
  `navigational_groups_archived_yn` tinyint(1) NOT NULL default '0' COMMENT 'is record archived?',
  PRIMARY KEY  (`navigational_groups_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_navigational_control_g`
--

INSERT INTO `tbl_navigational_control_g` (`navigational_groups_id`, `navigational_groups_name`, `navigational_groups_archived_yn`) VALUES
(1, 'Administrator', 0),
(2, 'FAA', 0),
(3, 'TSA', 0),
(4, 'Airport Operations', 0),
(5, 'Airline - Northwest', 0),
(6, 'Airport Employee (-s)', 0),
(7, 'Airport Employe (ASC)', 0),
(9, 'LEO', 0),
(10, 'ARFF', 0),
(11, 'Finance Office', 0),
(12, 'AirCo. Aviation', 0),
(13, 'AirCo. Aviation - Fueling', 0),
(14, 'Airport Employee - General Staff', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_navigational_control_g_a`
--

CREATE TABLE IF NOT EXISTS `tbl_navigational_control_g_a` (
  `navigational_access_id` int(10) NOT NULL auto_increment,
  `navigational_groups_id_cb_int` int(10) default NULL,
  `navigational_groups_id_cb_txt` varchar(50) default NULL,
  `navigational_control_id_cb_int` int(10) default NULL,
  `navigational_control_id_cb_txt` longtext,
  `navigational_archived_yn` tinyint(1) NOT NULL default '0' COMMENT 'is record archived?',
  PRIMARY KEY  (`navigational_access_id`),
  KEY `navigational_groups_id_cb_int_2` (`navigational_groups_id_cb_int`),
  KEY `navigational_control_id_cb_int` (`navigational_control_id_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=444 ;

--
-- Dumping data for table `tbl_navigational_control_g_a`
--

INSERT INTO `tbl_navigational_control_g_a` (`navigational_access_id`, `navigational_groups_id_cb_int`, `navigational_groups_id_cb_txt`, `navigational_control_id_cb_int`, `navigational_control_id_cb_txt`, `navigational_archived_yn`) VALUES
(2, 1, 'Administrator', 1, NULL, 0),
(3, 1, 'Administrator', 2, NULL, 0),
(4, 1, 'Administrator', 3, NULL, 0),
(5, 1, 'Administrator', 4, NULL, 0),
(6, 1, 'Administrator', 5, NULL, 0),
(7, 1, 'Administrator', 6, NULL, 0),
(8, 1, 'Administrator', 7, NULL, 0),
(9, 1, 'Administrator', 8, NULL, 0),
(10, 1, 'Administrator', 9, NULL, 0),
(11, 1, 'Administrator', 10, NULL, 0),
(12, 1, 'Administrator', 11, NULL, 0),
(13, 1, 'Administrator', 12, NULL, 0),
(14, 1, 'Administrator', 13, NULL, 0),
(15, 1, 'Administrator', 14, NULL, 0),
(16, 1, 'Administrator', 15, NULL, 0),
(17, 1, 'Administrator', 16, NULL, 0),
(18, 1, 'Administrator', 17, NULL, 0),
(19, 1, 'Administrator', 18, NULL, 0),
(20, 1, 'Administrator', 19, NULL, 0),
(21, 1, 'Administrator', 20, NULL, 0),
(22, 1, 'Administrator', 21, NULL, 0),
(23, 1, 'Administrator', 22, NULL, 0),
(25, 1, 'Administrator', 24, NULL, 0),
(26, 1, 'Administrator', 25, NULL, 0),
(27, 1, 'Administrator', 26, NULL, 0),
(28, 1, 'Administrator', 27, NULL, 0),
(29, 1, 'Administrator', 28, NULL, 0),
(30, 1, 'Administrator', 29, NULL, 0),
(31, 1, 'Administrator', 30, NULL, 0),
(32, 1, 'Administrator', 31, NULL, 0),
(33, 1, 'Administrator', 32, NULL, 0),
(34, 1, 'Administrator', 33, NULL, 0),
(35, 1, 'Administrator', 34, NULL, 0),
(36, 1, 'Administrator', 35, NULL, 0),
(37, 1, 'Administrator', 36, NULL, 0),
(38, 1, 'Administrator', 37, NULL, 0),
(39, 1, 'Administrator', 38, NULL, 0),
(40, 1, 'Administrator', 39, NULL, 0),
(42, 1, 'Administrator', 41, NULL, 0),
(43, 1, 'Administrator', 42, NULL, 0),
(44, 1, 'Administrator', 43, NULL, 0),
(45, 1, 'Administrator', 44, NULL, 0),
(46, 1, 'Administrator', 45, NULL, 0),
(47, 1, 'Administrator', 46, NULL, 0),
(48, 1, 'Administrator', 47, NULL, 0),
(49, 1, 'Administrator', 48, NULL, 0),
(53, 1, 'Administrator', 52, NULL, 0),
(54, 1, 'Administrator', 53, NULL, 0),
(55, 1, 'Administrator', 54, NULL, 0),
(56, 1, 'Administrator', 55, NULL, 0),
(57, 1, 'Administrator', 56, NULL, 0),
(58, 1, 'Administrator', 57, NULL, 0),
(59, 1, 'Administrator', 58, NULL, 0),
(65, 1, 'Administrator', 64, NULL, 0),
(66, 1, 'Administrator', 65, NULL, 0),
(67, 1, 'Administrator', 66, NULL, 0),
(68, 1, 'Administrator', 67, NULL, 0),
(69, 1, 'Administrator', 68, NULL, 0),
(70, 1, 'Administrator', 69, NULL, 0),
(71, 1, 'Administrator', 71, NULL, 0),
(72, 1, 'Administrator', 72, NULL, 0),
(73, 1, 'Administrator', 73, NULL, 0),
(74, 1, 'Administrator', 74, NULL, 0),
(75, 1, 'Administrator', 73, NULL, 1),
(76, 1, 'Administrator', 74, NULL, 1),
(77, 1, 'Administrator', 75, NULL, 0),
(78, 1, 'Administrator', 76, NULL, 0),
(79, 1, 'Administrator', 77, NULL, 0),
(80, 1, 'Administrator', 78, NULL, 0),
(81, 1, 'Administrator', 79, NULL, 0),
(82, 1, 'Administrator', 80, NULL, 0),
(83, 1, 'Administrator', 81, NULL, 0),
(84, 1, 'Administrator', 82, NULL, 0),
(85, 1, 'Administrator', 83, NULL, 0),
(86, 1, 'Administrator', 84, NULL, 0),
(89, 1, 'Administrator', 87, NULL, 0),
(90, 1, 'Administrator', 88, NULL, 0),
(91, 1, 'Administrator', 89, NULL, 0),
(92, 1, 'Administrator', 90, NULL, 0),
(93, 1, 'Administrator', 91, NULL, 0),
(94, 1, 'Administrator', 92, NULL, 0),
(95, 1, 'Administrator', 93, NULL, 0),
(96, 1, 'Administrator', 94, NULL, 0),
(97, 1, 'Administrator', 95, NULL, 0),
(98, 1, 'Administrator', 96, NULL, 0),
(99, 1, 'Administrator', 97, NULL, 0),
(100, 1, 'Administrator', 98, NULL, 0),
(101, 1, 'Administrator', 99, NULL, 0),
(102, 1, 'Administrator', 100, NULL, 0),
(103, 1, 'Administrator', 101, NULL, 0),
(104, 1, 'Administrator', 102, NULL, 0),
(105, 1, 'Administrator', 103, NULL, 0),
(106, 1, 'Administrator', 104, NULL, 0),
(107, 1, 'Administrator', 105, NULL, 0),
(108, 1, 'Administrator', 106, NULL, 0),
(109, 1, 'Administrator', 107, NULL, 0),
(110, 1, 'Administrator', 108, NULL, 0),
(111, 1, 'Administrator', 109, NULL, 0),
(112, 1, 'Administrator', 110, NULL, 0),
(113, 1, 'Administrator', 111, NULL, 0),
(114, 1, 'Administrator', 112, NULL, 0),
(115, 1, 'Administrator', 113, NULL, 0),
(116, 1, 'Administrator', 114, NULL, 0),
(117, 1, 'Administrator', 115, NULL, 0),
(122, 1, 'Administrator', 121, NULL, 0),
(123, 1, 'Administrator', 122, NULL, 0),
(124, 1, 'Administrator', 123, NULL, 0),
(125, 1, 'Administrator', 124, NULL, 0),
(126, 1, 'Administrator', 125, NULL, 0),
(127, 1, 'Administrator', 126, NULL, 0),
(128, 1, 'Administrator', 127, NULL, 0),
(129, 1, 'Administrator', 128, NULL, 0),
(130, 1, 'Administrator', 129, NULL, 0),
(131, 1, 'Administrator', 130, NULL, 0),
(136, 1, 'Administrator', 135, NULL, 0),
(137, 1, 'Administrator', 136, NULL, 0),
(138, 1, 'Administrator', 137, NULL, 0),
(139, 1, 'Administrator', 138, NULL, 0),
(140, 1, 'Administrator', 139, NULL, 0),
(141, 1, 'Administrator', 140, NULL, 0),
(142, 1, 'Administrator', 141, NULL, 0),
(143, 1, 'Administrator', 142, NULL, 0),
(144, 1, 'Administrator', 143, NULL, 0),
(145, 1, 'Administrator', 144, NULL, 0),
(146, 1, 'Administrator', 145, NULL, 0),
(147, 1, 'Administrator', 146, NULL, 0),
(148, 1, 'Administrator', 148, NULL, 0),
(149, 1, 'Administrator', 149, NULL, 0),
(150, 1, 'Administrator', 155, NULL, 0),
(152, 1, 'Administrator', 157, NULL, 0),
(158, 1, 'Administrator', 163, NULL, 0),
(159, 1, 'Administrator', 164, NULL, 0),
(161, 1, 'Administrator', 166, NULL, 0),
(162, 1, 'Administrator', 167, NULL, 0),
(163, 1, 'Administrator', 168, NULL, 0),
(164, 1, 'Administrator', 169, NULL, 0),
(165, 1, 'Administrator', 170, NULL, 0),
(166, 1, 'Administrator', 171, NULL, 0),
(167, 1, 'Administrator', 172, NULL, 0),
(168, 1, 'Administrator', 173, NULL, 0),
(169, 1, 'Administrator', 174, NULL, 0),
(170, 1, 'Administrator', 175, NULL, 0),
(171, 1, 'Administrator', 176, NULL, 0),
(172, 1, 'Administrator', 177, NULL, 0),
(173, 1, 'Administrator', 178, NULL, 0),
(174, 1, 'Administrator', 179, NULL, 0),
(177, 1, 'Administrator', 182, NULL, 0),
(178, 1, 'Administrator', 183, NULL, 0),
(179, 1, 'Administrator', 184, NULL, 0),
(180, 1, 'Administrator', 185, NULL, 0),
(183, 1, 'Administrator', 188, NULL, 0),
(184, 1, 'Administrator', 189, NULL, 0),
(185, 1, 'Administrator', 190, NULL, 0),
(186, 1, 'Administrator', 191, NULL, 0),
(187, 1, 'Administrator', 192, NULL, 0),
(188, 1, 'Administrator', 193, NULL, 0),
(189, 1, 'Administrator', 194, NULL, 0),
(190, 1, 'Administrator', 195, NULL, 0),
(191, 1, 'Administrator', 196, NULL, 0),
(192, 1, 'Administrator', 197, NULL, 0),
(193, 1, 'Administrator', 198, NULL, 0),
(194, 1, 'Administrator', 199, NULL, 0),
(195, 1, 'Administrator', 200, 'Root', 0),
(196, 1, 'Administrator', 201, 'Access Restrictions', 0),
(197, 1, 'Administrator', 202, NULL, 0),
(198, 1, 'Administrator', 203, NULL, 0),
(199, 1, NULL, 204, NULL, 0),
(201, 1, NULL, 205, NULL, 0),
(202, 1, NULL, 206, NULL, 0),
(203, 1, NULL, 207, NULL, 0),
(204, 1, NULL, 208, NULL, 0),
(205, 1, NULL, 210, NULL, 0),
(206, 1, NULL, 209, NULL, 0),
(207, 1, NULL, 214, NULL, 0),
(208, 1, NULL, 216, NULL, 0),
(209, 1, NULL, 215, NULL, 0),
(210, 1, NULL, 217, NULL, 0),
(211, 1, NULL, 219, NULL, 0),
(212, 1, NULL, 218, NULL, 0),
(213, 1, NULL, 220, NULL, 0),
(214, 1, NULL, 222, NULL, 0),
(215, 1, NULL, 221, NULL, 0),
(216, 1, NULL, 206, NULL, 1),
(217, 1, NULL, 225, NULL, 0),
(218, 1, NULL, 223, NULL, 0),
(219, 1, NULL, 224, NULL, 0),
(220, 1, NULL, 226, NULL, 0),
(221, 1, NULL, 228, NULL, 0),
(222, 1, NULL, 227, NULL, 0),
(223, 1, NULL, 229, NULL, 0),
(224, 1, NULL, 234, NULL, 0),
(225, 1, NULL, 231, NULL, 0),
(226, 1, NULL, 230, NULL, 0),
(227, 1, NULL, 233, NULL, 0),
(228, 1, NULL, 232, NULL, 0),
(229, 1, NULL, 235, NULL, 0),
(230, 1, NULL, 236, NULL, 0),
(231, 1, NULL, 240, NULL, 0),
(232, 1, NULL, 237, NULL, 0),
(233, 1, NULL, 239, NULL, 0),
(234, 1, NULL, 238, NULL, 0),
(235, 1, NULL, 241, NULL, 0),
(236, 1, NULL, 242, NULL, 0),
(237, 1, NULL, 243, NULL, 0),
(238, 1, NULL, 244, NULL, 0),
(239, 1, NULL, 245, NULL, 0),
(240, 1, NULL, 246, NULL, 0),
(241, 1, NULL, 247, NULL, 0),
(242, 1, NULL, 248, NULL, 0),
(243, 1, NULL, 249, NULL, 0),
(244, 1, NULL, 250, NULL, 0),
(245, 1, NULL, 251, NULL, 0),
(246, 1, NULL, 252, NULL, 0),
(247, 1, NULL, 253, NULL, 0),
(248, 1, NULL, 254, NULL, 0),
(249, 1, NULL, 256, NULL, 0),
(250, 1, NULL, 255, NULL, 0),
(251, 1, NULL, 257, NULL, 0),
(252, 1, NULL, 259, NULL, 0),
(253, 1, NULL, 258, NULL, 0),
(254, 1, NULL, 261, NULL, 0),
(255, 1, NULL, 260, NULL, 0),
(257, 1, NULL, 262, NULL, 0),
(258, 1, NULL, 264, NULL, 0),
(259, 1, NULL, 263, NULL, 0),
(260, 1, NULL, 266, NULL, 0),
(261, 1, NULL, 265, NULL, 0),
(262, 1, NULL, 270, NULL, 0),
(263, 1, NULL, 268, NULL, 0),
(264, 1, NULL, 269, NULL, 0),
(265, 1, NULL, 267, NULL, 0),
(266, 1, NULL, 272, NULL, 0),
(267, 1, NULL, 271, NULL, 0),
(269, 1, NULL, 274, NULL, 0),
(270, 1, NULL, 273, NULL, 0),
(271, 1, NULL, 275, NULL, 0),
(272, 1, NULL, 276, NULL, 0),
(273, 1, NULL, 280, NULL, 0),
(274, 1, NULL, 278, NULL, 0),
(275, 1, NULL, 279, NULL, 0),
(276, 1, NULL, 277, NULL, 0),
(277, 1, NULL, 281, NULL, 0),
(278, 1, NULL, 282, NULL, 0),
(279, 1, NULL, 284, NULL, 0),
(280, 1, NULL, 283, NULL, 0),
(281, 1, NULL, 286, NULL, 0),
(282, 1, NULL, 285, NULL, 0),
(283, 1, NULL, 287, NULL, 0),
(284, 1, NULL, 289, NULL, 0),
(285, 1, NULL, 288, NULL, 0),
(286, 1, NULL, 291, NULL, 0),
(287, 1, NULL, 292, NULL, 0),
(288, 1, NULL, 293, NULL, 0),
(289, 1, NULL, 294, NULL, 0),
(290, 1, NULL, 295, NULL, 0),
(291, 1, NULL, 296, NULL, 0),
(292, 1, NULL, 297, NULL, 0),
(293, 1, NULL, 299, NULL, 0),
(294, 1, NULL, 298, NULL, 0),
(295, 1, NULL, 300, NULL, 0),
(296, 1, NULL, 301, NULL, 0),
(297, 1, NULL, 302, NULL, 0),
(298, 1, NULL, 303, NULL, 0),
(299, 1, NULL, 304, NULL, 0),
(300, 1, NULL, 307, NULL, 0),
(301, 1, NULL, 306, NULL, 0),
(302, 1, NULL, 305, NULL, 0),
(303, 1, NULL, 309, NULL, 0),
(304, 1, NULL, 308, NULL, 0),
(305, 1, NULL, 310, NULL, 0),
(306, 1, NULL, 311, NULL, 0),
(307, 1, NULL, 313, NULL, 0),
(308, 1, NULL, 312, NULL, 0),
(309, 1, NULL, 314, NULL, 0),
(310, 1, NULL, 147, NULL, 0),
(311, 1, NULL, 315, NULL, 0),
(312, 1, NULL, 316, NULL, 0),
(313, 1, NULL, 319, NULL, 0),
(314, 1, NULL, 320, NULL, 0),
(315, 1, NULL, 318, NULL, 0),
(316, 1, NULL, 317, NULL, 0),
(317, 1, NULL, 323, NULL, 0),
(318, 1, NULL, 322, NULL, 0),
(319, 1, NULL, 321, NULL, 0),
(320, 1, NULL, 324, NULL, 0),
(321, 1, NULL, 325, NULL, 0),
(322, 1, NULL, 326, NULL, 0),
(323, 1, NULL, 327, NULL, 0),
(324, 1, NULL, 328, NULL, 0),
(325, 1, NULL, 330, NULL, 0),
(326, 1, NULL, 329, NULL, 0),
(327, 1, NULL, 331, NULL, 0),
(328, 1, NULL, 332, NULL, 0),
(329, 1, NULL, 333, NULL, 0),
(330, 1, NULL, 334, NULL, 0),
(331, 1, NULL, 335, NULL, 0),
(332, 1, NULL, 337, NULL, 0),
(333, 1, NULL, 336, NULL, 0),
(334, 1, NULL, 338, NULL, 0),
(335, 1, NULL, 339, NULL, 0),
(336, 1, NULL, 340, NULL, 0),
(337, 1, NULL, 341, NULL, 0),
(338, 1, NULL, 342, NULL, 0),
(339, 1, NULL, 343, NULL, 0),
(340, 1, NULL, 344, NULL, 0),
(341, 1, NULL, 345, NULL, 0),
(345, 1, NULL, 349, NULL, 0),
(346, 1, NULL, 350, NULL, 0),
(347, 1, NULL, 351, NULL, 0),
(348, 1, NULL, 352, NULL, 0),
(349, 1, NULL, 353, NULL, 0),
(350, 1, NULL, 355, NULL, 0),
(351, 1, NULL, 354, NULL, 0),
(352, 1, NULL, 356, NULL, 0),
(353, 1, NULL, 357, NULL, 0),
(354, 1, NULL, 359, NULL, 0),
(355, 1, NULL, 358, NULL, 0),
(356, 1, NULL, 360, NULL, 0),
(357, 1, NULL, 361, NULL, 0),
(358, 1, NULL, 363, NULL, 0),
(359, 1, NULL, 364, NULL, 0),
(360, 1, NULL, 366, NULL, 0),
(361, 1, NULL, 365, NULL, 0),
(362, 1, NULL, 368, NULL, 0),
(363, 1, NULL, 367, NULL, 0),
(364, 1, NULL, 370, NULL, 0),
(365, 1, NULL, 369, NULL, 0),
(366, 1, NULL, 371, NULL, 0),
(367, 1, NULL, 372, NULL, 0),
(368, 1, NULL, 373, NULL, 0),
(369, 1, NULL, 374, NULL, 0),
(370, 1, NULL, 375, NULL, 0),
(371, 1, NULL, 376, NULL, 0),
(372, 1, NULL, 377, NULL, 0),
(373, 1, NULL, 378, NULL, 0),
(374, 1, NULL, 379, NULL, 0),
(386, 12, NULL, 1, NULL, 0),
(387, 12, NULL, 5, NULL, 0),
(389, 12, NULL, 17, NULL, 0),
(390, 12, NULL, 80, NULL, 0),
(391, 12, NULL, 81, NULL, 0),
(392, 12, NULL, 47, NULL, 0),
(393, 5, NULL, 17, NULL, 0),
(394, 5, NULL, 81, NULL, 0),
(395, 5, NULL, 47, NULL, 0),
(396, 5, NULL, 3, NULL, 0),
(397, 5, NULL, 28, NULL, 0),
(398, 5, NULL, 145, NULL, 0),
(399, 5, NULL, 196, NULL, 0),
(400, 5, NULL, 1, NULL, 0),
(401, 5, NULL, 5, NULL, 0),
(402, 13, NULL, 3, NULL, 0),
(403, 13, NULL, 31, NULL, 0),
(404, 13, NULL, 114, NULL, 0),
(405, 13, NULL, 115, NULL, 0),
(406, 13, NULL, 1, NULL, 0),
(407, 13, NULL, 5, NULL, 0),
(409, 13, NULL, 17, NULL, 0),
(410, 13, NULL, 80, NULL, 0),
(411, 13, NULL, 81, NULL, 0),
(412, 13, NULL, 42, NULL, 0),
(416, 1, NULL, 381, NULL, 0),
(417, 13, NULL, 47, NULL, 0),
(418, 14, NULL, 1, NULL, 0),
(419, 14, NULL, 5, NULL, 0),
(420, 14, NULL, 16, NULL, 0),
(421, 14, NULL, 17, NULL, 0),
(422, 14, NULL, 80, NULL, 0),
(423, 14, NULL, 81, NULL, 0),
(424, 14, NULL, 47, NULL, 0),
(425, 14, NULL, 22, NULL, 0),
(426, 14, NULL, 123, NULL, 0),
(427, 14, NULL, 122, NULL, 0),
(428, 14, NULL, 2, NULL, 0),
(429, 14, NULL, 74, NULL, 0),
(430, 14, NULL, 126, NULL, 0),
(431, 14, NULL, 125, NULL, 0),
(432, 12, NULL, 16, NULL, 0),
(433, 13, NULL, 16, NULL, 0),
(434, 1, '', 383, NULL, 0),
(435, 1, NULL, 384, NULL, 0),
(436, 1, NULL, 386, NULL, 0),
(437, 1, NULL, 388, NULL, 0),
(438, 1, NULL, 387, NULL, 0),
(439, 1, NULL, 385, NULL, 0),
(440, 1, NULL, 389, NULL, 0),
(441, 1, NULL, 390, NULL, 0),
(442, 1, NULL, 392, NULL, 0),
(443, 1, NULL, 391, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organization_main`
--

CREATE TABLE IF NOT EXISTS `tbl_organization_main` (
  `Organizations_id` int(10) NOT NULL auto_increment,
  `org_name` varchar(50) default NULL,
  `org_type_cb_int` int(10) default NULL,
  `org_type_cb_text` varchar(50) default NULL,
  `org_address` longtext,
  `org_image` varchar(255) default NULL,
  `org_archieved_yn` tinyint(1) NOT NULL default '0',
  `org_phonenumber` text,
  `org_faxnumber` text,
  `org_email` text,
  PRIMARY KEY  (`Organizations_id`),
  KEY `org_type_cb_int` (`org_type_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `tbl_organization_main`
--

INSERT INTO `tbl_organization_main` (`Organizations_id`, `org_name`, `org_type_cb_int`, `org_type_cb_text`, `org_address`, `org_image`, `org_archieved_yn`, `org_phonenumber`, `org_faxnumber`, `org_email`) VALUES
(1, 'Mesaba Airlines - ATY', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(2, 'Priority Air', 7, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(3, 'Business Aviation Couriers', 2, NULL, '3501 N Aviation Ave * Joe Foss Field * Sioux Falls, South Dakota 57104-0197', 'http://www.busav.com/BAC/images/logo.gif', 0, '', '', ''),
(4, 'City of Watertown - Airport Department', 3, NULL, '2416 Boeing Ave * Watertown * SD * 57201', NULL, 0, NULL, NULL, NULL),
(5, 'Federal Aviation Administration', 6, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(6, 'Guest Account', 5, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(7, 'Jerriy''s Aviation', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(8, 'Transportation Security Administration', 6, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(9, 'City of Watertown - Fire Department', 3, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(10, 'Mesaba Airlines - PIR', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(11, 'O''Day Equipment', 8, NULL, 'unknown', NULL, 0, NULL, NULL, NULL),
(12, 'Home Brew', 9, NULL, '2416 Boeing Ave. * Watertown * SD * 57201', NULL, 0, NULL, NULL, NULL),
(13, 'Sioux Valley Co-Op (Cenex)', 10, NULL, 'unknown', NULL, 0, NULL, NULL, NULL),
(14, 'Woods', 8, NULL, '2606 South Illinois Route 2 * Post Office Box 1000 * Oregon, Illinois 61061', NULL, 0, NULL, NULL, NULL),
(15, 'Sweepster', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(16, 'Western', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(17, 'Oshkosh', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(18, 'New Holland', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(19, 'John Deere', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(20, 'Grass Hopper', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(21, 'FWD', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(22, 'Chevrolet', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(23, 'Ford', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(24, 'Titian', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(25, 'Wausau', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(26, 'Stocky', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(27, 'Broyhill', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(28, 'General Motors Company', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(29, 'Idaho Norland', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(30, 'Jamie''s Welding', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(31, 'Kubota', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(33, 'Falls', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(34, 'Swenson', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(35, 'Heil', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(36, 'Glendhily', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(37, 'Monro', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(38, 'Normen - Harrington', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(39, 'Determan Brownie', 8, NULL, '', NULL, 0, NULL, NULL, NULL),
(46, 'Alan Henricks', 11, NULL, '45673 166th St. Watertown, SD 57201', 'images/org_photos/Alan_Henricks/', 0, '605-882-1618', '', ''),
(47, 'Angus  Palm', 8, NULL, '315 Airport Drive, Watertown, SD, 57201', 'images/org_photos/Angus__Palm/anguspalm.GIF', 0, '605-886-5681', '605-886-6179', 'info@angus-palm.com'),
(48, 'Billy Davis', 11, NULL, '11230 Montaubon Way, San Diego, CA, 92131', 'images/org_photos/Billy_Davis/', 0, '', '', ''),
(49, 'Bob Schmidt', 11, NULL, '19042 427th Ave, Willow Lake, SD, 57278', 'images/org_photos/Bob_Schmidt/', 0, '', '', ''),
(50, 'Bruce Duba', 11, NULL, '17 17th Ave SW, Watertown, SD, 57201', 'images/org_photos/Bruce_Duba/', 0, '605-730-2244', '', 'frankiebr549@msn.com'),
(51, 'Bryan Brost', 11, NULL, '16641 450th Ave, Watertown, SD, 57201', 'images/org_photos/Bryan_Brost/', 0, '605-868-4291', '', ''),
(52, 'Codington County Search and Dive Rescue', 8, NULL, '', 'images/org_photos/Codington_County_Search_and_Dive_Rescue/', 0, '', '', ''),
(53, 'Gayle Small', 11, NULL, '1410 13th NE, Watertown, SD, 57201', 'images/org_photos/Gayle_Small/', 0, '', '', ''),
(54, 'Gerald  Kasuske', 11, NULL, '474 South Lake Dr, Watertown, SD, 57201-5433', 'images/org_photos/Gerald__Kasuske/', 0, '605-886-7577', '', ''),
(55, 'Gordon  Little', 11, NULL, '45676 176 St, Watertown, SD, 57201', 'images/org_photos/Gordon__Little/', 0, '605-882-1262', '', ''),
(56, 'Harvey Spieker', 11, NULL, '529 South Lake Drive, Watertown, SD, 57201', 'images/org_photos/Harvey_Spieker/', 0, '605-886-5048', '', ''),
(57, 'Joseph  Amendt', 11, NULL, 'Watertown, SD, 57201', 'images/org_photos/Joseph__Amendt/', 0, '605-886-3661', '', ''),
(58, 'Lake City Cab Co Inc', 8, NULL, '', 'images/org_photos/Lake_City_Cab_Co_Inc/', 0, '605-886-0080', '', ''),
(59, 'Lake Area echnical Institute', 8, NULL, '230 11th St NE, PO BOX 730, Watertown, SD, 57201', 'images/org_photos/Lake_Area_echnical_Institute/lati.GIF', 0, '800-657-4344', '', 'rehderh@lakeareatech.edu'),
(60, 'Larry Gantvoort', 11, NULL, 'PO BOX 683, Clear Lake, SD, 57226', 'images/org_photos/Larry_Gantvoort/', 0, '417-532-8112', '', 'transamcontracting@earthlink.net'),
(61, 'Lonnie Davis', 11, NULL, 'PO BOX 175, Watertown, SD, 57201', 'images/org_photos/Lonnie_Davis/', 0, '605-882-1060', '', 'ldavis@datatruck.com'),
(62, 'McKeevers Full Service Vending', 8, NULL, '807 Oakwood Rd, Watertown, SD, 57201', '', 0, '605-886-7677', '', ''),
(63, 'Ronald Whitlock', 11, NULL, '1500 3rd Ave SW #24, Watertown, SD, 57201', 'images/org_photos/Ronald_Whitlock/', 0, '', '', ''),
(64, 'Ronald Madsen', 11, NULL, '428 28th Ave NE, Watertown, SD, 57201', 'images/org_photos/Ronald_Madsen/', 0, '605-886-39058', '', 'rcmadsen@dailypost.com'),
(65, 'Sandy Theye', 11, NULL, '', 'images/org_photos/Sandy_Theye/', 0, '', '', ''),
(66, 'Scott Campbell', 11, NULL, 'Wedding Ln, Garden City, SD, 57236', 'images/org_photos/Scott_Campbell/', 0, '605-532-5277', '', 'dakchip@itetel.com'),
(67, 'Scott Simon', 11, NULL, '717 9th St NW, Watertown, SD, 57201', 'images/org_photos/Scott_Simon/', 0, '605-886-1901', '', ''),
(68, 'Super 8 Hotel', 8, NULL, '503 14th Ave SE, Watertown, SD, 57201', 'images/org_photos/Super_8_Hotel/', 0, '605-882-1900', '', ''),
(69, 'Thomas Burns', 11, NULL, 'PO BOX 903, Watertown, SD, 57201', 'images/org_photos/Thomas_Burns/', 0, '', '', ''),
(70, 'Tim Peterson', 11, NULL, '1209 Ave SE, Watertown, SD, 57201', 'images/org_photos/Tim_Peterson/', 0, '605-882-3990', '', 'tim@petersonmotors.net'),
(71, 'Tom Arbach', 11, NULL, '317 Summerwood Dr, Watertown, SD, 57201', 'images/org_photos/Tom_Arbach/', 0, '', '', ''),
(72, 'Gray Construction', 8, NULL, '', NULL, 0, '', '', ''),
(73, 'Wes Wilkens', 11, NULL, '44574 US Highway 212, Watertown, SD 57201', 'images/org_photos/Wes_Wilkens/', 0, '605-881-0661', '', 'wilkens@dailypost.com'),
(74, 'Lynn Hoitsma', 11, NULL, 'Castlewood, SD', 'images/org_photos/Lynn_Hoitsma/', 0, '605-793-2341', '', 'lHoitsma@itctel.com'),
(75, 'B&L Trucking', 11, NULL, '16323 456th Ave. Watertown, SD, 57201', 'images/org_photos/B&L_Trucking/', 0, '605-520-1587', '', 'bob@designconcrete4u.com'),
(76, 'Jim Aesoph', 11, NULL, '45826 169th St., Watertown, SD, 57201', 'images/org_photos/Jim_Aesoph/', 0, '605-882-3351', '', 'JBA@tnics.com'),
(77, 'Billion Automotive', 8, NULL, 'Salem, SD', 'images/org_photos/Billion_Automotive/', 0, '', '', ''),
(78, 'Crouse-Hinds', 8, NULL, 'P.O. Box 4999, Syracuse, NY 13221\r\n', 'http://www.crouse-hinds.com/images/cooperHeaderCHLogo_big.gif', 0, '(315) 477-5531', '(315) 477-5179', 'crouse.customerctr@crouse-hinds.com'),
(79, 'Roy Schuchard', 11, NULL, 'unknown', 'images/org_photos/Roy_Schuchard/', 0, 'unknown', 'unknown', 'unknown'),
(80, 'Julius Larson', 11, NULL, '1205 w 16th, Yankton, SD, 57078', 'images/org_photos/Julius_Larson/', 0, '605-760-3368', '', 'bclars@iw.net'),
(82, 'Donald G Nogelmeier', 11, NULL, '6025 4 Ave. SW', 'images/org_photos/Donald_G_Nogelmeier/', 0, '605-886-3724', '', ''),
(83, 'Tim Winters', 11, NULL, '3233 S. Campbell Ave., Springfield, MO 65807', 'images/org_photos/Tim_Winters/', 0, '', '', ''),
(84, 'Ralph Kliegle', 11, NULL, '818 N. Lake Drive, Watertown, SD, 57201', 'images/org_photos/Ralph_Kliegle/', 0, '', '', ''),
(85, 'American Fence Co.', 8, NULL, '', 'images/org_photos/American_Fence_Co./', 0, '', '', ''),
(86, 'City of Watertown - Police Department', 3, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(87, 'Erick Dahl', 11, NULL, '521 11th St. NW, Watertown, SD 57201', 'images/org_photos/Erick_Dahl/', 0, '605-882-8878', '605-882-5285', 'airport@watertownsd.us'),
(88, 'The System', 5, NULL, 'The System', 'images/org_photos/The_System/', 0, '', '', ''),
(89, 'William Campbell', 11, NULL, '308 1st St NW, Huron, SD, 57350', 'images/org_photos/William_Campbell/', 0, '605-352-54.89', '605-350-3151 (cell)', 'william.a.campbell@hur.midco.net'),
(90, 'Marc Skipper', 11, NULL, 'Huron, SD, 57350', 'images/org_photos/Marc_Skipper/', 0, '605-352-4784', '', 'marc.skipper@faa.gov'),
(91, 'Emilee Sehr', 11, NULL, '738 4th Ave., Sioux Falls, SD, 57104', 'images/org_photos/Emilee_Sehr/', 0, '605-759-3284', '', 'emilee@sio.midco.net'),
(92, 'Jean Kwasniewki', 11, NULL, '14871 SD Hwy 35, Webster, SD, 57274', 'images/org_photos/Jean_Kwasniewki/', 0, '605-345-4540', '605-880-5120 (cell)', ''),
(93, 'Shirley Pauli', 11, NULL, '107 8th Ave. SW #11, Watertown, SD, 57201', 'images/org_photos/Shirley_Pauli/', 0, '605-520-2774', '', 'spauli@yahoo.com'),
(94, 'Dave Vanderweide', 11, NULL, '16583 Sioux Conifer Rd, Watertown, SD 57201', 'images/org_photos/Dave_Vanderweide/', 0, '605-882-2121', '605-520-7917', ''),
(95, 'David Vanderiede', 11, NULL, '16583 Sioux Conifer Rd, Watertown, SD 57201', 'images/org_photos/David_Vanderiede/', 0, '605-882-2121', '605-520-7917', ''),
(96, 'Sharon Determan', 11, NULL, '308 15th St. NW., Huron, SD 57350', 'images/org_photos/Sharon_Determan/', 0, '605-352-4784', '605-354-0745', ''),
(97, 'Brady Klocker', 11, NULL, '1117 2nd St. NW, Watertown, SD, 57201', 'images/org_photos/Brady_Klocker/', 0, '605-886-0568', '605-880-0699', 'brady.klocker@sdstate.edu'),
(98, 'Bob Wangler', 11, NULL, '704 N Park, Watertown, SD, 57201', 'images/org_photos/Bob_Wangler/', 0, '605-882-5757', '', 'bob@aircoaviation.com'),
(99, 'Bradley Kirby', 11, NULL, '14 1/2 6th St. SE, Watertown, SD, 57201', 'images/org_photos/Bradley_Kirby/', 0, '605-882-5757', '', 'brad@aircoaviation.com'),
(100, 'Biran Ambuehl', 11, NULL, '824 County Rd. 14S. Aberdeen, SD, 57401', 'images/org_photos/Biran_Ambuehl/', 0, '605-225-0519', '', 'brian.ambuehl.noaa.gov');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organization_sub_p`
--

CREATE TABLE IF NOT EXISTS `tbl_organization_sub_p` (
  `org_payroll_id` int(10) NOT NULL auto_increment,
  `org_payroll_org_cb_int` int(11) NOT NULL,
  `org_payroll_org_cb_txt` text,
  `org_payroll_costcenter` text,
  `org_payroll_archived_yn` tinyint(1) NOT NULL default '0' COMMENT 'is record archived?',
  PRIMARY KEY  (`org_payroll_id`),
  KEY `org_payroll_org_cb_int` (`org_payroll_org_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_organization_sub_p`
--

INSERT INTO `tbl_organization_sub_p` (`org_payroll_id`, `org_payroll_org_cb_int`, `org_payroll_org_cb_txt`, `org_payroll_costcenter`, `org_payroll_archived_yn`) VALUES
(12, 4, NULL, '435', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organization_sub_t`
--

CREATE TABLE IF NOT EXISTS `tbl_organization_sub_t` (
  `org_types_id` int(10) NOT NULL auto_increment,
  `org_types_name` varchar(50) default NULL,
  `org_types_archived_yn` tinyint(1) NOT NULL default '0' COMMENT 'is record archived?',
  PRIMARY KEY  (`org_types_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_organization_sub_t`
--

INSERT INTO `tbl_organization_sub_t` (`org_types_id`, `org_types_name`, `org_types_archived_yn`) VALUES
(1, 'Part 121', 0),
(2, 'Part 135', 0),
(3, 'Municipality', 0),
(4, 'Cargo Operator', 0),
(5, 'Guest', 0),
(6, 'Federal Government', 0),
(7, 'Fixed Base Operator (F.B.O.)', 0),
(8, 'Retailer', 0),
(9, 'Home Built', 0),
(10, 'Gas Station', 0),
(11, 'Individual', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quickinfo_control`
--

CREATE TABLE IF NOT EXISTS `tbl_quickinfo_control` (
  `menu_item_id` int(10) NOT NULL auto_increment,
  `menu_item_location` varchar(255) default NULL,
  `menu_item_name_long` varchar(255) default NULL,
  `menu_item_name_short` varchar(50) default NULL,
  `menu_item_purpose` longtext,
  `menu_item_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`menu_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_quickinfo_control`
--

INSERT INTO `tbl_quickinfo_control` (`menu_item_id`, `menu_item_location`, `menu_item_name_long`, `menu_item_name_short`, `menu_item_purpose`, `menu_item_archived_yn`) VALUES
(1, 'quickinfoinventoryfueltanks', 'Current Fuel Levels in Inventory', 'Current Fuel Levels', 'This quick info will display current fuel levels', 0),
(2, 'quickinfopart139327inspections', 'Part 139.327 Inspections for Today', 'Self-Inspections', 'This quick info will display all of the airport safety self inspections that were conducted on the current day', 0),
(3, 'quickinfopart139327discrepancies', 'Current Discrepancies', 'Current Discrepancies', 'This quick info item will display all of the currently outstanding discrepancies', 0),
(4, 'quickinfopart139339ficons', 'Todays Field Condition Reports', 'FiCONS', 'Quick Information for displaying Field Conditon Reports', 0),
(5, 'quickinfocurrentnotams', 'Display Current NOTAMs', 'NOTAMs', 'To display all of the current NOTAMs issued by the airport', 0),
(6, 'quickinfowebsite_comments', 'Website Comments', 'Comments', 'Quickinfo for Comments', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quickinfo_control_g_a`
--

CREATE TABLE IF NOT EXISTS `tbl_quickinfo_control_g_a` (
  `navigational_access_id` int(10) NOT NULL auto_increment,
  `navigational_groups_id_cb_int` int(10) default NULL,
  `navigational_groups_id_cb_txt` varchar(50) default NULL,
  `navigational_control_id_cb_int` int(10) default NULL,
  `navigational_control_id_cb_txt` varchar(50) default NULL,
  `navigational_archived_yn` tinyint(1) NOT NULL default '0' COMMENT 'is record archived?',
  PRIMARY KEY  (`navigational_access_id`),
  KEY `navigational_groups_id_cb_int` (`navigational_groups_id_cb_int`),
  KEY `navigational_control_id_cb_int` (`navigational_control_id_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_quickinfo_control_g_a`
--

INSERT INTO `tbl_quickinfo_control_g_a` (`navigational_access_id`, `navigational_groups_id_cb_int`, `navigational_groups_id_cb_txt`, `navigational_control_id_cb_int`, `navigational_control_id_cb_txt`, `navigational_archived_yn`) VALUES
(1, 1, NULL, 1, NULL, 0),
(2, 1, NULL, 2, NULL, 0),
(3, 1, NULL, 3, NULL, 0),
(4, 1, NULL, 5, NULL, 0),
(5, 1, NULL, 4, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state_poison_main`
--

CREATE TABLE IF NOT EXISTS `tbl_state_poison_main` (
  `st_p_id` int(10) NOT NULL auto_increment,
  `st_p_by_int` int(11) default NULL,
  `st_p_by_txt` text,
  `st_p_bname_txt` text,
  `st_p_baddress_txt` longtext,
  `st_p_custname_txt` text,
  `st_p_custaddress_txt` longtext,
  `st_p_date` date default NULL,
  `st_p_time` time default NULL,
  `st_p_plocations_txt` longtext,
  `st_p_spraylocation_x` longtext,
  `st_p_spraylocation_y` longtext,
  `st_p_spurpose_txt` longtext,
  `st_p_chem_1_int` int(11) default NULL,
  `st_p_chem_1_txt` text,
  `st_p_chem_2_int` int(11) default NULL,
  `st_p_chem_2_txt` text,
  `st_p_totalgallons` double default NULL,
  `st_p_acrestreated` double default NULL,
  `st_p_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`st_p_id`),
  KEY `st_p_chem_1_int` (`st_p_chem_1_int`),
  KEY `st_p_chem_2_int` (`st_p_chem_2_int`),
  KEY `st_p_by_int` (`st_p_by_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_state_poison_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_state_poison_sub_t`
--

CREATE TABLE IF NOT EXISTS `tbl_state_poison_sub_t` (
  `st_p_t_id` int(11) NOT NULL auto_increment,
  `st_p_t_name` text,
  `st_p_t_brand` text,
  `st_p_t_company_int` int(11) default NULL,
  `st_p_t_company_txt` text,
  `st_p_t_inactive` longtext,
  `st_p_t_active` longtext,
  `st_p_t_units` double default NULL,
  `st_p_t_rate` double default NULL,
  `st_p_t_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`st_p_t_id`),
  KEY `st_p_t_company_int` (`st_p_t_company_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_state_poison_sub_t`
--

INSERT INTO `tbl_state_poison_sub_t` (`st_p_t_id`, `st_p_t_name`, `st_p_t_brand`, `st_p_t_company_int`, `st_p_t_company_txt`, `st_p_t_inactive`, `st_p_t_active`, `st_p_t_units`, `st_p_t_rate`, `st_p_t_archived_yn`) VALUES
(1, 'No Chemical Used', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0),
(2, 'Buccaneer', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0),
(3, 'Tordon 22k', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0),
(4, '2, 4-D LV6', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0),
(5, 'MCPA Amine', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_systemusers`
--

CREATE TABLE IF NOT EXISTS `tbl_systemusers` (
  `emp_record_id` int(10) NOT NULL auto_increment,
  `emp_firstname` varchar(50) default NULL,
  `emp_lastname` varchar(50) default NULL,
  `emp_initials` varchar(50) default NULL,
  `emp_username` varchar(50) default NULL,
  `emp_password` varchar(50) default NULL,
  `emp_organiation_cb_int` int(10) default NULL,
  `emp_organiation_cb_txt` varchar(50) default NULL,
  `emp_archieved_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`emp_record_id`),
  KEY `emp_organiation_cb_int` (`emp_organiation_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `tbl_systemusers`
--

INSERT INTO `tbl_systemusers` (`emp_record_id`, `emp_firstname`, `emp_lastname`, `emp_initials`, `emp_username`, `emp_password`, `emp_organiation_cb_int`, `emp_organiation_cb_txt`, `emp_archieved_yn`) VALUES
(1, 'Erick', 'Dahl', 'ED', 'edahl', 'test', 4, 'Watertown Airport', 0),
(65, 'The System', 'is Watching You', 'Sysop', 'thesystemiswatchingyou', 'wouldyouliketoknow', 4, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_systemusers_ncga`
--

CREATE TABLE IF NOT EXISTS `tbl_systemusers_ncga` (
  `navigational_access_id` int(10) NOT NULL auto_increment,
  `navigational_user_id_cb_int` int(10) default NULL,
  `navigational_user_id_cb_txt` varchar(50) default NULL,
  `navigational_group_id_cb_int` int(10) default NULL,
  `navigational_group_id_cb_txt` varchar(50) default NULL,
  `navigational_groups_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`navigational_access_id`),
  KEY `navigational_group_id_cb_int` (`navigational_group_id_cb_int`),
  KEY `navigational_user_id_cb_int` (`navigational_user_id_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_systemusers_ncga`
--

INSERT INTO `tbl_systemusers_ncga` (`navigational_access_id`, `navigational_user_id_cb_int`, `navigational_user_id_cb_txt`, `navigational_group_id_cb_int`, `navigational_group_id_cb_txt`, `navigational_groups_archived_yn`) VALUES
(1, 1, 'Erick', 1, 'Administrator', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_systemusers_ncia`
--

CREATE TABLE IF NOT EXISTS `tbl_systemusers_ncia` (
  `navigational_access_id` int(10) NOT NULL auto_increment,
  `navigational_user_id_cb_int` int(10) default NULL,
  `navigational_user_id_cb_txt` varchar(50) default NULL,
  `navigational_control_id_cb_int` int(10) default NULL,
  `navigational_control_id_cb_txt` varchar(50) default NULL,
  `navigational_add_remove` tinyint(1) NOT NULL,
  PRIMARY KEY  (`navigational_access_id`),
  KEY `navigational_user_id` (`navigational_user_id_cb_int`),
  KEY `navigational_control_id_cb_int` (`navigational_control_id_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Not Used ???' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_systemusers_ncia`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_systemusers_qia`
--

CREATE TABLE IF NOT EXISTS `tbl_systemusers_qia` (
  `navigational_access_id` int(10) NOT NULL auto_increment,
  `navigational_user_id_cb_int` int(10) default NULL,
  `navigational_user_id_cb_txt` varchar(50) default NULL,
  `navigational_group_id_cb_int` int(10) default NULL,
  `navigational_group_id_cb_txt` varchar(50) default NULL,
  `navigational_groups_archived_yn` tinyint(1) NOT NULL default '0',
  `navigational_groups_display_yn` tinyint(1) NOT NULL default '1',
  `navigational_groups_priority` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`navigational_access_id`),
  KEY `navigational_user_id` (`navigational_user_id_cb_int`),
  KEY `navigational_group_id_cb_int` (`navigational_group_id_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `tbl_systemusers_qia`
--

INSERT INTO `tbl_systemusers_qia` (`navigational_access_id`, `navigational_user_id_cb_int`, `navigational_user_id_cb_txt`, `navigational_group_id_cb_int`, `navigational_group_id_cb_txt`, `navigational_groups_archived_yn`, `navigational_groups_display_yn`, `navigational_groups_priority`) VALUES
(1, 1, 'Erick', 1, NULL, 0, 1, 6),
(2, 1, 'Erick', 2, NULL, 0, 1, 1),
(3, 1, NULL, 3, NULL, 0, 1, 2),
(4, 1, NULL, 4, NULL, 0, 1, 3),
(45, 1, NULL, 5, NULL, 0, 1, 4),
(68, 1, NULL, 6, NULL, 0, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_systemusers_sub_p`
--

CREATE TABLE IF NOT EXISTS `tbl_systemusers_sub_p` (
  `systemuser_hr_id` int(10) NOT NULL auto_increment,
  `systemuser_hr_su_id_cb_int` int(10) default NULL,
  `systemuser_hr_su_id_cb_txt` varchar(50) default NULL,
  `systemuser_hr_archived_yn` tinyint(1) NOT NULL default '0',
  `systemuser_hr_payroll_id` text,
  PRIMARY KEY  (`systemuser_hr_id`),
  KEY `systemuser_hr_su_id_cb_int` (`systemuser_hr_su_id_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_systemusers_sub_p`
--

INSERT INTO `tbl_systemusers_sub_p` (`systemuser_hr_id`, `systemuser_hr_su_id_cb_int`, `systemuser_hr_su_id_cb_txt`, `systemuser_hr_archived_yn`, `systemuser_hr_payroll_id`) VALUES
(4, 1, NULL, 0, '01-0387'),
(5, 2, NULL, 0, '01-1101'),
(6, 69, NULL, 0, '01-2200'),
(7, 18, NULL, 0, '01-1228'),
(8, 80, NULL, 0, '01-2360'),
(9, 81, NULL, 0, '01-2366'),
(10, 86, NULL, 0, '?');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timesheets_main`
--

CREATE TABLE IF NOT EXISTS `tbl_timesheets_main` (
  `timesheet_id` int(11) NOT NULL auto_increment,
  `timesheet_systemuser_id_cb_int` int(11) NOT NULL,
  `timesheet_systemuser_id_cb_txt` text,
  `timesheet_month_cb_int` int(11) NOT NULL,
  `timesheet_month_cb_txt` text,
  `timesheet_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`timesheet_id`),
  KEY `timesheet_month_cb_int` (`timesheet_month_cb_int`),
  KEY `timesheet_systemuser_id_cb_int` (`timesheet_systemuser_id_cb_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_timesheets_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_timesheets_sub_h`
--

CREATE TABLE IF NOT EXISTS `tbl_timesheets_sub_h` (
  `holiday_id` int(11) NOT NULL auto_increment,
  `holiday_name` text,
  `holiday_name_short` text,
  `holiday_month_cb_int` int(11) NOT NULL,
  `holiday_month_cb_txt` text,
  `holiday_day` int(11) NOT NULL,
  `holiday_archived` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`holiday_id`),
  KEY `holiday_month_cb_int` (`holiday_month_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_timesheets_sub_h`
--

INSERT INTO `tbl_timesheets_sub_h` (`holiday_id`, `holiday_name`, `holiday_name_short`, `holiday_month_cb_int`, `holiday_month_cb_txt`, `holiday_day`, `holiday_archived`) VALUES
(1, 'New Years Day', 'NYD', 1, NULL, 1, 0),
(2, 'Martin Luther King Day', 'MLKD', 1, NULL, 21, 0),
(3, 'Washington''s Birthday', 'WBD', 2, NULL, 18, 0),
(4, 'Memorial Day', 'MD', 5, NULL, 26, 0),
(5, 'Independence Day', 'ID', 7, NULL, 4, 0),
(6, 'Labor Day', 'LD', 9, NULL, 1, 0),
(7, 'Columbus Day', 'CD', 10, NULL, 10, 0),
(8, 'Veterns Day', 'VD', 11, NULL, 11, 0),
(9, 'Thanksgiving', 'TD', 11, NULL, 22, 0),
(10, 'Christmas Day', 'Xmas', 12, '', 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timesheets_sub_m`
--

CREATE TABLE IF NOT EXISTS `tbl_timesheets_sub_m` (
  `timesheetmonth_id` int(11) NOT NULL auto_increment,
  `timesheetmonth_month_cb_int` int(11) NOT NULL,
  `timesheetmonth_month_cb_txt` text,
  `timesheetmonth_year` int(11) NOT NULL,
  `timesheetmonth_paystart` int(11) NOT NULL,
  `timesheetmonth_payend` int(11) NOT NULL,
  `timesheetmonth_has_5_weeks` tinyint(1) NOT NULL default '0',
  `timesheetmonth_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`timesheetmonth_id`),
  KEY `timesheetmonth_month_cb_int` (`timesheetmonth_month_cb_int`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `tbl_timesheets_sub_m`
--

INSERT INTO `tbl_timesheets_sub_m` (`timesheetmonth_id`, `timesheetmonth_month_cb_int`, `timesheetmonth_month_cb_txt`, `timesheetmonth_year`, `timesheetmonth_paystart`, `timesheetmonth_payend`, `timesheetmonth_has_5_weeks`, `timesheetmonth_archived_yn`) VALUES
(11, 1, NULL, 2006, 9, 13, 1, 0),
(12, 2, NULL, 2006, 13, 12, 0, 0),
(13, 3, NULL, 2006, 13, 12, 0, 0),
(14, 4, NULL, 2006, 10, 14, 1, 0),
(15, 5, NULL, 2006, 15, 9, 0, 0),
(16, 6, NULL, 2006, 12, 7, 0, 0),
(17, 7, NULL, 2006, 10, 11, 1, 0),
(18, 8, NULL, 2006, 14, 8, 0, 0),
(19, 9, NULL, 2006, 11, 6, 0, 0),
(20, 10, NULL, 2006, 9, 10, 1, 0),
(21, 11, NULL, 2006, 13, 8, 0, 0),
(22, 12, NULL, 2006, 11, 10, 0, 0),
(23, 1, NULL, 2007, 8, 11, 1, 0),
(24, 2, NULL, 2007, 12, 11, 0, 0),
(25, 3, NULL, 2007, 12, 8, 0, 0),
(26, 4, NULL, 2007, 9, 13, 1, 0),
(27, 5, NULL, 2007, 14, 10, 0, 0),
(28, 6, NULL, 2007, 11, 8, 0, 0),
(29, 7, NULL, 2007, 9, 12, 0, 0),
(30, 8, NULL, 2007, 13, 9, 0, 0),
(31, 9, NULL, 2007, 10, 7, 0, 0),
(32, 10, NULL, 2007, 8, 11, 1, 0),
(33, 11, NULL, 2007, 12, 9, 0, 0),
(34, 12, NULL, 2007, 10, 10, 0, 0),
(35, 1, NULL, 2008, 14, 10, 0, 0),
(36, 2, NULL, 2008, 11, 9, 0, 0),
(37, 3, NULL, 2008, 10, 13, 1, 0),
(38, 4, NULL, 2008, 14, 11, 0, 0),
(39, 5, NULL, 2008, 12, 8, 0, 0),
(40, 6, NULL, 2008, 9, 13, 1, 0),
(41, 7, NULL, 2008, 14, 10, 0, 0),
(42, 8, NULL, 2008, 11, 7, 0, 0),
(43, 9, NULL, 2008, 8, 12, 1, 0),
(44, 10, NULL, 2008, 13, 9, 0, 0),
(45, 11, NULL, 2008, 10, 7, 0, 0),
(46, 12, NULL, 2008, 8, 11, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timesheets_sub_w`
--

CREATE TABLE IF NOT EXISTS `tbl_timesheets_sub_w` (
  `week_id` int(11) NOT NULL auto_increment,
  `time_sheet_parent` int(11) NOT NULL,
  `week1_stringname` text,
  `week1_day` text,
  `week1_date` text,
  `week1_notes` text,
  `week1_reg_hours` double default NULL,
  `week1_hol_hours` double default NULL,
  `week1_hol_pay` double default NULL,
  `week1_ot` double default NULL,
  `week1_dt` double default NULL,
  `week1_vl` double default NULL,
  `week1_sl` double default NULL,
  `week1_ce` double default NULL,
  `week1_ct` double default NULL,
  PRIMARY KEY  (`week_id`),
  KEY `time_sheet_parent` (`time_sheet_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_timesheets_sub_w`
--

