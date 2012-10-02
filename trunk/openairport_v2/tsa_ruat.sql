-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 11, 2008 at 10:19 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `tsa_ruat`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cleared_list`
--

CREATE TABLE IF NOT EXISTS `tbl_cleared_list` (
  `ruat_tsa_sid` int(11) NOT NULL,
  `ruat_tsa_cleared` text,
  `ruat_tsa_last_name` text,
  `ruat_tsa_first_name` text,
  `ruat_tsa_middle_name` text,
  `ruat_tsa_type` text,
  `ruat_tsa_DOB` text,
  `ruat_tsa_last_POB` text,
  `ruat_tsa_citizanship` text,
  `ruat_tsa_passport` text,
  `ruat_tsa_misc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cleared_list`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_import_history`
--

CREATE TABLE IF NOT EXISTS `tbl_import_history` (
  `import_id` int(11) NOT NULL auto_increment,
  `import_type` text NOT NULL,
  `import_date` date NOT NULL,
  `import_time` text NOT NULL,
  `import_arcived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`import_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_import_history`
--

INSERT INTO `tbl_import_history` (`import_id`, `import_type`, `import_date`, `import_time`, `import_arcived_yn`) VALUES
(1, 'tbl_nofly_list', '0000-00-00', '0.635097980499', 0),
(2, 'tbl_cleared_list', '0000-00-00', '1.3210439682', 0),
(3, 'tbl_selectee_list', '0000-00-00', '2.28657412529', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nofly_list`
--

CREATE TABLE IF NOT EXISTS `tbl_nofly_list` (
  `ruat_tsa_sid` int(11) NOT NULL,
  `ruat_tsa_cleared` text,
  `ruat_tsa_last_name` text,
  `ruat_tsa_first_name` text,
  `ruat_tsa_middle_name` text,
  `ruat_tsa_type` text,
  `ruat_tsa_DOB` text,
  `ruat_tsa_last_POB` text,
  `ruat_tsa_citizanship` text,
  `ruat_tsa_passport` text,
  `ruat_tsa_misc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nofly_list`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_selectee_list`
--

CREATE TABLE IF NOT EXISTS `tbl_selectee_list` (
  `ruat_tsa_sid` int(11) NOT NULL,
  `ruat_tsa_cleared` text,
  `ruat_tsa_last_name` text,
  `ruat_tsa_first_name` text,
  `ruat_tsa_middle_name` text,
  `ruat_tsa_type` text,
  `ruat_tsa_DOB` text,
  `ruat_tsa_last_POB` text,
  `ruat_tsa_citizanship` text,
  `ruat_tsa_passport` text,
  `ruat_tsa_misc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_selectee_list`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL auto_increment,
  `user_name` text NOT NULL,
  `user_pass` text NOT NULL,
  `user_email` text NOT NULL,
  `user_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Keeps track of system users' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_archived_yn`) VALUES
(1, 'edahl', 'airport', 'erick_dahl@hotmail.com', 0),
(2, 'mshort', 'rap', 'test_23@test.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users_files`
--

CREATE TABLE IF NOT EXISTS `tbl_users_files` (
  `user_f_id` int(11) NOT NULL auto_increment,
  `user_f_name` text NOT NULL,
  `user_f_parent_id` int(11) NOT NULL,
  `user_f_archived_yn` tinyint(1) NOT NULL,
  PRIMARY KEY  (`user_f_id`),
  KEY `user_f_parent_id` (`user_f_parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_users_files`
--

INSERT INTO `tbl_users_files` (`user_f_id`, `user_f_name`, `user_f_parent_id`, `user_f_archived_yn`) VALUES
(7, 'files/1/tocompare.csv', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users_searchs`
--

CREATE TABLE IF NOT EXISTS `tbl_users_searchs` (
  `user_s_id` int(11) NOT NULL auto_increment,
  `user_s_name` text NOT NULL,
  `user_s_who` text COMMENT 'Who this search looks for',
  `user_s_sql` longtext NOT NULL,
  `user_s_send_email` tinyint(4) default NULL COMMENT 'Should system send an email alert to you when a new list has been imported?',
  `user_s_parent_id` int(11) NOT NULL,
  `user_s_archived_yn` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`user_s_id`),
  KEY `user_s_parent_id` (`user_s_parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_users_searchs`
--

INSERT INTO `tbl_users_searchs` (`user_s_id`, `user_s_name`, `user_s_who`, `user_s_sql`, `user_s_send_email`, `user_s_parent_id`, `user_s_archived_yn`) VALUES
(1, 'Test', 'ABAD, JUAN', 'SELECT+%2A+FROM+tbl_nofly_list+WHERE+%60ruat_tsa_last_name%60+LIKE+CONVERT%28_utf8+%27%25ABAD%25%27+USING+latin1%29+COLLATE+latin1_swedish_ci+OR+%60ruat_tsa_first_name%60+LIKE+CONVERT%28_utf8+%27%25JUAN%25%27+USING+latin1%29+COLLATE+latin1_swedish_ci+ORDER+BY+ruat_tsa_sid+', 1, 1, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_users_files`
--
ALTER TABLE `tbl_users_files`
  ADD CONSTRAINT `tbl_users_files_ibfk_1` FOREIGN KEY (`user_f_parent_id`) REFERENCES `tbl_users` (`user_id`);

--
-- Constraints for table `tbl_users_searchs`
--
ALTER TABLE `tbl_users_searchs`
  ADD CONSTRAINT `tbl_users_searchs_ibfk_1` FOREIGN KEY (`user_s_parent_id`) REFERENCES `tbl_users` (`user_id`);
