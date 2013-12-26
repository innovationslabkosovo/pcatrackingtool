-- phpMyAdmin SQL Dump
-- version 4.0.9deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 20, 2013 at 04:53 PM
-- Server version: 5.1.72-2
-- PHP Version: 5.3.3-7+squeeze17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pcatracking`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePcaTargetProgress`()
BEGIN 

DECLARE target_id_pca INT;
DECLARE unit_id_pca INT;
DECLARE current_pca INT;
DECLARE total_pca INT;
DECLARE shortfall_pca INT;
DECLARE received_date_pca INT;
DECLARE start_date_pca INT;

DECLARE target_id_t INT;
DECLARE unit_id_t INT;
DECLARE current_t INT;
DECLARE total_t INT;
DECLARE shortfall_t INT;

DECLARE current_new INT;
DECLARE total_new INT;
DECLARE shortfall_new INT;

DECLARE count_total INT;
DECLARE i INT;

SET @skip=0;
SET @rows=1;
SET @test=6;

SELECT COUNT( * ) INTO count_total FROM tbl_pca_target_progress  ; 

SET i=0;

WHILE i < count_total DO

SET @skip = i;

#SELECT @target_id_pca:= `target_id` , @unit_id_pca:=`unit_id` , @total_pca:=`total`, @received_date_pca:=`received_date` FROM tbl_pca_target_progress  LIMIT 1;

PREPARE STMT FROM 'SELECT @target_id_pca:= `target_id` , @unit_id_pca:=`unit_id` , @total_pca:=`total`, @received_date_pca:=`received_date`, @start_date_pca:=`start_date`   FROM tbl_pca_target_progress  LIMIT ?,?;';
EXECUTE STMT USING @skip, @rows;

SELECT @current_t:= `current` , @shortfall_t:=`shortfall` , @total_t:=`total` from tbl_target_progress where target_id = @target_id_pca and unit_id = @unit_id_pca;

IF 
@current_t IS NULL 
THEN 
SET @current_t = 0; 
END IF; 

set @current_new := @current_t + @total_pca;
set @shortfall_new :=  @total_t - @current_new; 

update tbl_target_progress set active = 0 where target_id =  @target_id_pca and unit_id = @unit_id_pca;

insert into  tbl_target_progress (`target_id`, `unit_id`, `total`, `current`, `shortfall`,  `start_date`,  `received_date`, `active`) VALUES (@target_id_pca, @unit_id_pca , @total_t, @current_new, @shortfall_new, @start_date_pca, @received_date_pca, 1);


set i = i+1;

end while;


END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `comment` text,
  `subject` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

-- --------------------------------------------------------

--
-- Table structure for table `copy_locations`
--

CREATE TABLE IF NOT EXISTS `copy_locations` (
  `Latitude` decimal(8,6) DEFAULT NULL,
  `Longitude` decimal(8,6) DEFAULT NULL,
  `Governorate_UN` varchar(13) DEFAULT NULL,
  `Caza` varchar(16) DEFAULT NULL,
  `Cadastral_Local_NAME` varchar(42) DEFAULT NULL,
  `Village_Name` varchar(35) DEFAULT NULL,
  `P_code` varchar(9) DEFAULT NULL,
  `CAS_CODE` int(5) DEFAULT NULL,
  `CAS_CODE_UN` varchar(8) DEFAULT NULL,
  `CAD_CODE` varchar(9) DEFAULT NULL,
  `CAS_Village_NAME` varchar(42) DEFAULT NULL,
  `MOHAFAZA` varchar(13) DEFAULT NULL,
  `Elevation` int(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE IF NOT EXISTS `friendship` (
  `inviter_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `acknowledgetime` int(11) DEFAULT NULL,
  `requesttime` int(11) DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`inviter_id`,`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `locdata`
--

CREATE TABLE IF NOT EXISTS `locdata` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `locality_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `latitude` decimal(10,5) DEFAULT NULL,
  `longitude` decimal(10,5) DEFAULT NULL,
  `p_code` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`location_id`),
  KEY `locality_id` (`locality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6829 ;

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE IF NOT EXISTS `membership` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `membership_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `order_date` int(11) NOT NULL,
  `end_date` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `payment_date` int(11) DEFAULT NULL,
  `subscribed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` int(10) unsigned NOT NULL,
  `from_user_id` int(10) unsigned NOT NULL,
  `to_user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `message_read` tinyint(1) NOT NULL,
  `answered` tinyint(1) DEFAULT NULL,
  `draft` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `principal_id` int(11) NOT NULL,
  `subordinate_id` int(11) NOT NULL DEFAULT '0',
  `type` enum('user','role') NOT NULL,
  `action` int(11) NOT NULL,
  `template` tinyint(1) NOT NULL,
  `comment` text,
  PRIMARY KEY (`principal_id`,`subordinate_id`,`type`,`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `privacysetting`
--

CREATE TABLE IF NOT EXISTS `privacysetting` (
  `user_id` int(10) unsigned NOT NULL,
  `message_new_friendship` tinyint(1) NOT NULL DEFAULT '1',
  `message_new_message` tinyint(1) NOT NULL DEFAULT '1',
  `message_new_profilecomment` tinyint(1) NOT NULL DEFAULT '1',
  `appear_in_search` tinyint(1) NOT NULL DEFAULT '1',
  `show_online_status` tinyint(1) NOT NULL DEFAULT '1',
  `log_profile_visits` tinyint(1) NOT NULL DEFAULT '1',
  `ignore_users` varchar(255) DEFAULT NULL,
  `public_profile_fields` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `about` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `profile_comment`
--

CREATE TABLE IF NOT EXISTS `profile_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `profile_visit`
--

CREATE TABLE IF NOT EXISTS `profile_visit` (
  `visitor_id` int(11) NOT NULL,
  `visited_id` int(11) NOT NULL,
  `timestamp_first_visit` int(11) NOT NULL,
  `timestamp_last_visit` int(11) NOT NULL,
  `num_of_visits` int(11) NOT NULL,
  PRIMARY KEY (`visitor_id`,`visited_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `membership_priority` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL COMMENT 'Price (when using membership module)',
  `duration` int(11) DEFAULT NULL COMMENT 'How long a membership is valid',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity`
--

CREATE TABLE IF NOT EXISTS `tbl_activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_id` int(11) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`activity_id`),
  KEY `sector_id` (`sector_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_donor`
--

CREATE TABLE IF NOT EXISTS `tbl_donor` (
  `donor_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`donor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gateway`
--

CREATE TABLE IF NOT EXISTS `tbl_gateway` (
  `gateway_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`gateway_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_goal`
--

CREATE TABLE IF NOT EXISTS `tbl_goal` (
  `goal_id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`goal_id`),
  KEY `fk_Goal_Sector1` (`sector_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_governorate`
--

CREATE TABLE IF NOT EXISTS `tbl_governorate` (
  `governorate_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`governorate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grant`
--

CREATE TABLE IF NOT EXISTS `tbl_grant` (
  `grant_id` int(11) NOT NULL AUTO_INCREMENT,
  `donor_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`grant_id`),
  KEY `donor_id` (`donor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gw_pca_loc`
--

CREATE TABLE IF NOT EXISTS `tbl_gw_pca_loc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_id` int(11) DEFAULT NULL,
  `pca_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gateway_id` (`gateway_id`),
  KEY `pca_id` (`pca_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4069 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_intermediate_result`
--

CREATE TABLE IF NOT EXISTS `tbl_intermediate_result` (
  `ir_id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_id` int(11) NOT NULL,
  `ir_wbs_reference` varchar(50) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`ir_id`),
  KEY `sector_id` (`sector_id`),
  KEY `sector_id_2` (`sector_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locality`
--

CREATE TABLE IF NOT EXISTS `tbl_locality` (
  `locality_id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) NOT NULL,
  `cad_code` varchar(11) CHARACTER SET utf8 NOT NULL,
  `cas_code` varchar(11) CHARACTER SET utf8 NOT NULL,
  `cas_code_un` varchar(11) CHARACTER SET utf8 NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `cas_village_name` varchar(128) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`locality_id`),
  KEY `region_id` (`region_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1533 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE IF NOT EXISTS `tbl_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `locality_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `latitude` decimal(10,5) DEFAULT NULL,
  `longitude` decimal(10,5) DEFAULT NULL,
  `p_code` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`location_id`),
  KEY `locality_id` (`locality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6832 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location_gateway`
--

CREATE TABLE IF NOT EXISTS `tbl_location_gateway` (
  `location_id` int(11) NOT NULL,
  `gateway_id` int(11) NOT NULL,
  PRIMARY KEY (`location_id`,`gateway_id`),
  KEY `gateway_id` (`gateway_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_partner_location`
--

CREATE TABLE IF NOT EXISTS `tbl_partner_location` (
  `partner_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  KEY `fk_Partner_Organization_has_Location_Location1` (`location_id`),
  KEY `fk_Partner_Organization_has_Location_Partner_Organization1` (`partner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_partner_organization`
--

CREATE TABLE IF NOT EXISTS `tbl_partner_organization` (
  `partner_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `contact_person` varchar(64) DEFAULT NULL,
  `phone_number` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`partner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_partner_organization_activity`
--

CREATE TABLE IF NOT EXISTS `tbl_partner_organization_activity` (
  `partner_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  KEY `fk_Partner_Organization_has_Activity_Activity1` (`activity_id`),
  KEY `fk_Partner_Organization_has_Activity_Partner_Organization1` (`partner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pca`
--

CREATE TABLE IF NOT EXISTS `tbl_pca` (
  `pca_id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(45) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `status` varchar(32) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `initiation_date` date DEFAULT NULL,
  `signed_by_unicef_date` date DEFAULT NULL,
  `signed_by_partner_date` date DEFAULT NULL,
  `unicef_mng_first_name` varchar(64) DEFAULT NULL,
  `unicef_mng_last_name` varchar(64) DEFAULT NULL,
  `unicef_mng_email` varchar(128) DEFAULT NULL,
  `partner_mng_first_name` varchar(64) DEFAULT NULL,
  `partner_mng_last_name` varchar(64) DEFAULT NULL,
  `partner_mng_email` varchar(128) DEFAULT NULL,
  `partner_contribution_budget` int(11) DEFAULT NULL,
  `unicef_cash_budget` int(11) DEFAULT NULL,
  `in_kind_amount_budget` int(11) DEFAULT NULL,
  `cash_for_supply_budget` int(11) DEFAULT NULL,
  `total_cash` int(11) DEFAULT NULL,
  `received_date` datetime DEFAULT NULL,
  `is_approved` int(11) DEFAULT '0',
  PRIMARY KEY (`pca_id`),
  KEY `fk_Pca_Partner_Organization1` (`partner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pca_activity`
--

CREATE TABLE IF NOT EXISTS `tbl_pca_activity` (
  `pca_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  PRIMARY KEY (`pca_id`,`activity_id`),
  KEY `fk_Activity_has_Pca_Pca1` (`pca_id`),
  KEY `fk_Activity_has_Pca_Activity1` (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pca_file`
--

CREATE TABLE IF NOT EXISTS `tbl_pca_file` (
  `pca_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `pca_id` int(11) NOT NULL,
  `file_name` varchar(256) NOT NULL,
  `file_category` varchar(32) NOT NULL,
  PRIMARY KEY (`pca_file_id`),
  KEY `pca_id` (`pca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pca_grant`
--

CREATE TABLE IF NOT EXISTS `tbl_pca_grant` (
  `pca_id` int(11) NOT NULL,
  `grant_id` int(11) NOT NULL,
  `funds` int(11) NOT NULL,
  PRIMARY KEY (`pca_id`,`grant_id`),
  KEY `grant_id` (`grant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pca_report`
--

CREATE TABLE IF NOT EXISTS `tbl_pca_report` (
  `pca_report_id` int(11) NOT NULL AUTO_INCREMENT,
  `pca_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `start_period` date DEFAULT NULL,
  `end_period` date DEFAULT NULL,
  `received_date` datetime DEFAULT NULL,
  PRIMARY KEY (`pca_report_id`),
  KEY `fk_Pca_Report_Pca1` (`pca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pca_rrp5output`
--

CREATE TABLE IF NOT EXISTS `tbl_pca_rrp5output` (
  `pca_id` int(11) NOT NULL,
  `rrp5_output_id` int(11) NOT NULL,
  PRIMARY KEY (`pca_id`,`rrp5_output_id`),
  KEY `rrp5_output_id` (`rrp5_output_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pca_sector`
--

CREATE TABLE IF NOT EXISTS `tbl_pca_sector` (
  `pca_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  PRIMARY KEY (`pca_id`,`sector_id`),
  KEY `sector_id` (`sector_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pca_target`
--

CREATE TABLE IF NOT EXISTS `tbl_pca_target` (
  `pca_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  PRIMARY KEY (`pca_id`,`target_id`),
  KEY `target_id` (`target_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pca_target_progress`
--

CREATE TABLE IF NOT EXISTS `tbl_pca_target_progress` (
  `target_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `pca_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `current` int(11) NOT NULL COMMENT '					',
  `shortfall` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `received_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`target_id`,`unit_id`,`pca_id`,`current`,`received_date`),
  KEY `pca_id` (`pca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pca_target_progress_copy`
--

CREATE TABLE IF NOT EXISTS `tbl_pca_target_progress_copy` (
  `target_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `pca_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `current` int(11) NOT NULL COMMENT '					',
  `shortfall` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `received_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`target_id`,`unit_id`,`pca_id`,`current`,`received_date`),
  KEY `pca_id` (`pca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pca_ufile`
--

CREATE TABLE IF NOT EXISTS `tbl_pca_ufile` (
  `pca_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`pca_id`,`file_id`),
  KEY `pca_id` (`pca_id`,`file_id`),
  KEY `file_id` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pca_user_action`
--

CREATE TABLE IF NOT EXISTS `tbl_pca_user_action` (
  `user_action_id` int(11) NOT NULL AUTO_INCREMENT,
  `pca_id` int(11) NOT NULL,
  `pca_number` varchar(512) NOT NULL,
  `pca_title` varchar(512) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(32) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`user_action_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=283 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pca_wbs`
--

CREATE TABLE IF NOT EXISTS `tbl_pca_wbs` (
  `pca_id` int(11) NOT NULL,
  `wbs_id` int(11) NOT NULL,
  PRIMARY KEY (`pca_id`,`wbs_id`),
  KEY `wbs_id` (`wbs_id`),
  KEY `pca_id` (`pca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_region`
--

CREATE TABLE IF NOT EXISTS `tbl_region` (
  `region_id` int(11) NOT NULL AUTO_INCREMENT,
  `governorate_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`region_id`),
  KEY `governorate_id` (`governorate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rrp5_output`
--

CREATE TABLE IF NOT EXISTS `tbl_rrp5_output` (
  `rrp5_output_id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_id` int(11) NOT NULL,
  `code` varchar(16) NOT NULL,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`rrp5_output_id`),
  KEY `sector_id` (`sector_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sector`
--

CREATE TABLE IF NOT EXISTS `tbl_sector` (
  `sector_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`sector_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sector_role`
--

CREATE TABLE IF NOT EXISTS `tbl_sector_role` (
  `role_id` int(10) unsigned NOT NULL,
  `sector_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`sector_id`),
  KEY `role_id` (`sector_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sector_user`
--

CREATE TABLE IF NOT EXISTS `tbl_sector_user` (
  `user_id` int(10) unsigned NOT NULL,
  `sector_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`sector_id`),
  KEY `sector_id` (`sector_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_target`
--

CREATE TABLE IF NOT EXISTS `tbl_target` (
  `target_id` int(11) NOT NULL AUTO_INCREMENT,
  `goal_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`target_id`),
  KEY `fk_Target_Goal1` (`goal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_target_activity`
--

CREATE TABLE IF NOT EXISTS `tbl_target_activity` (
  `activity_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  PRIMARY KEY (`activity_id`,`target_id`),
  KEY `fk_Activity_has_Target_Target1` (`target_id`),
  KEY `fk_Activity_has_Target_Activity1` (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_target_progress`
--

CREATE TABLE IF NOT EXISTS `tbl_target_progress` (
  `target_id` int(11) NOT NULL DEFAULT '0',
  `unit_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `current` int(11) NOT NULL,
  `shortfall` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `received_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`target_id`,`unit_id`,`current`,`active`,`received_date`),
  KEY `fk_Target_has_Unit_Unit1` (`unit_id`),
  KEY `target_id` (`target_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_target_progress_pca_report`
--

CREATE TABLE IF NOT EXISTS `tbl_target_progress_pca_report` (
  `target_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `pca_report_id` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`target_id`,`unit_id`,`pca_report_id`),
  KEY `pca_report_id` (`pca_report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE IF NOT EXISTS `tbl_unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_uploaded_file`
--

CREATE TABLE IF NOT EXISTS `tbl_uploaded_file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(256) DEFAULT NULL,
  `file_type` varchar(32) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `file_content` mediumblob,
  `file_category` varchar(64) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wbs`
--

CREATE TABLE IF NOT EXISTS `tbl_wbs` (
  `wbs_id` int(11) NOT NULL AUTO_INCREMENT,
  `ir_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`wbs_id`),
  KEY `ir_id` (`ir_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

-- --------------------------------------------------------

--
-- Table structure for table `translation`
--

CREATE TABLE IF NOT EXISTS `translation` (
  `message` varbinary(255) NOT NULL,
  `translation` varchar(255) NOT NULL,
  `language` varchar(5) NOT NULL,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`message`,`language`,`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` varchar(128) NOT NULL,
  `activationKey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(11) NOT NULL DEFAULT '0',
  `lastvisit` int(11) NOT NULL DEFAULT '0',
  `lastaction` int(11) NOT NULL DEFAULT '0',
  `lastpasswordchange` int(11) NOT NULL DEFAULT '0',
  `failedloginattempts` int(11) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `notifyType` enum('None','Digest','Instant','Threshold') DEFAULT 'Instant',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `usergroup`
--

CREATE TABLE IF NOT EXISTS `usergroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `participants` text,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_group_message`
--

CREATE TABLE IF NOT EXISTS `user_group_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  `createtime` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `YiiLog`
--

CREATE TABLE IF NOT EXISTS `YiiLog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(128) DEFAULT NULL,
  `category` varchar(128) DEFAULT NULL,
  `logtime` int(11) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3797 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  ADD CONSTRAINT `tbl_activity_ibfk_1` FOREIGN KEY (`sector_id`) REFERENCES `tbl_sector` (`sector_id`);

--
-- Constraints for table `tbl_goal`
--
ALTER TABLE `tbl_goal`
  ADD CONSTRAINT `tbl_goal_ibfk_1` FOREIGN KEY (`sector_id`) REFERENCES `tbl_sector` (`sector_id`);

--
-- Constraints for table `tbl_grant`
--
ALTER TABLE `tbl_grant`
  ADD CONSTRAINT `tbl_grant_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `tbl_donor` (`donor_id`);

--
-- Constraints for table `tbl_gw_pca_loc`
--
ALTER TABLE `tbl_gw_pca_loc`
  ADD CONSTRAINT `tbl_gw_pca_loc_ibfk_1` FOREIGN KEY (`gateway_id`) REFERENCES `tbl_gateway` (`gateway_id`),
  ADD CONSTRAINT `tbl_gw_pca_loc_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `tbl_location` (`location_id`),
  ADD CONSTRAINT `tbl_gw_pca_loc_ibfk_4` FOREIGN KEY (`pca_id`) REFERENCES `tbl_pca` (`pca_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_intermediate_result`
--
ALTER TABLE `tbl_intermediate_result`
  ADD CONSTRAINT `tbl_intermediate_result_ibfk_1` FOREIGN KEY (`sector_id`) REFERENCES `tbl_sector` (`sector_id`);

--
-- Constraints for table `tbl_locality`
--
ALTER TABLE `tbl_locality`
  ADD CONSTRAINT `tbl_locality_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `tbl_region` (`region_id`);

--
-- Constraints for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD CONSTRAINT `tbl_location_ibfk_1` FOREIGN KEY (`locality_id`) REFERENCES `tbl_locality` (`locality_id`);

--
-- Constraints for table `tbl_location_gateway`
--
ALTER TABLE `tbl_location_gateway`
  ADD CONSTRAINT `tbl_location_gateway_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `tbl_location` (`location_id`),
  ADD CONSTRAINT `tbl_location_gateway_ibfk_2` FOREIGN KEY (`gateway_id`) REFERENCES `tbl_gateway` (`gateway_id`);

--
-- Constraints for table `tbl_partner_location`
--
ALTER TABLE `tbl_partner_location`
  ADD CONSTRAINT `tbl_partner_location_ibfk_1` FOREIGN KEY (`partner_id`) REFERENCES `tbl_partner_organization` (`partner_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_partner_location_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `tbl_location` (`location_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_partner_organization_activity`
--
ALTER TABLE `tbl_partner_organization_activity`
  ADD CONSTRAINT `tbl_partner_organization_activity_ibfk_1` FOREIGN KEY (`partner_id`) REFERENCES `tbl_partner_organization` (`partner_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_partner_organization_activity_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `tbl_activity` (`activity_id`);

--
-- Constraints for table `tbl_pca`
--
ALTER TABLE `tbl_pca`
  ADD CONSTRAINT `tbl_pca_ibfk_1` FOREIGN KEY (`partner_id`) REFERENCES `tbl_partner_organization` (`partner_id`);

--
-- Constraints for table `tbl_pca_activity`
--
ALTER TABLE `tbl_pca_activity`
  ADD CONSTRAINT `tbl_pca_activity_ibfk_1` FOREIGN KEY (`pca_id`) REFERENCES `tbl_pca` (`pca_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pca_activity_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `tbl_activity` (`activity_id`);

--
-- Constraints for table `tbl_pca_file`
--
ALTER TABLE `tbl_pca_file`
  ADD CONSTRAINT `tbl_pca_file_ibfk_1` FOREIGN KEY (`pca_id`) REFERENCES `tbl_pca` (`pca_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_pca_grant`
--
ALTER TABLE `tbl_pca_grant`
  ADD CONSTRAINT `tbl_pca_grant_ibfk_2` FOREIGN KEY (`grant_id`) REFERENCES `tbl_grant` (`grant_id`),
  ADD CONSTRAINT `tbl_pca_grant_ibfk_3` FOREIGN KEY (`pca_id`) REFERENCES `tbl_pca` (`pca_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pca_report`
--
ALTER TABLE `tbl_pca_report`
  ADD CONSTRAINT `tbl_pca_report_ibfk_1` FOREIGN KEY (`pca_id`) REFERENCES `tbl_pca` (`pca_id`);

--
-- Constraints for table `tbl_pca_rrp5output`
--
ALTER TABLE `tbl_pca_rrp5output`
  ADD CONSTRAINT `tbl_pca_rrp5output_ibfk_3` FOREIGN KEY (`pca_id`) REFERENCES `tbl_pca` (`pca_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pca_rrp5output_ibfk_4` FOREIGN KEY (`rrp5_output_id`) REFERENCES `tbl_rrp5_output` (`rrp5_output_id`);

--
-- Constraints for table `tbl_pca_sector`
--
ALTER TABLE `tbl_pca_sector`
  ADD CONSTRAINT `tbl_pca_sector_ibfk_3` FOREIGN KEY (`pca_id`) REFERENCES `tbl_pca` (`pca_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pca_sector_ibfk_4` FOREIGN KEY (`sector_id`) REFERENCES `tbl_sector` (`sector_id`);

--
-- Constraints for table `tbl_pca_target`
--
ALTER TABLE `tbl_pca_target`
  ADD CONSTRAINT `tbl_pca_target_ibfk_1` FOREIGN KEY (`pca_id`) REFERENCES `tbl_pca` (`pca_id`),
  ADD CONSTRAINT `tbl_pca_target_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `tbl_target` (`target_id`);

--
-- Constraints for table `tbl_pca_target_progress`
--
ALTER TABLE `tbl_pca_target_progress`
  ADD CONSTRAINT `tbl_pca_target_progress_ibfk_1` FOREIGN KEY (`pca_id`) REFERENCES `tbl_pca` (`pca_id`);

--
-- Constraints for table `tbl_pca_ufile`
--
ALTER TABLE `tbl_pca_ufile`
  ADD CONSTRAINT `tbl_pca_ufile_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `tbl_uploaded_file` (`file_id`),
  ADD CONSTRAINT `tbl_pca_ufile_ibfk_3` FOREIGN KEY (`pca_id`) REFERENCES `tbl_pca` (`pca_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_pca_wbs`
--
ALTER TABLE `tbl_pca_wbs`
  ADD CONSTRAINT `tbl_pca_wbs_ibfk_2` FOREIGN KEY (`wbs_id`) REFERENCES `tbl_wbs` (`wbs_id`),
  ADD CONSTRAINT `tbl_pca_wbs_ibfk_3` FOREIGN KEY (`pca_id`) REFERENCES `tbl_pca` (`pca_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_region`
--
ALTER TABLE `tbl_region`
  ADD CONSTRAINT `tbl_region_ibfk_1` FOREIGN KEY (`governorate_id`) REFERENCES `tbl_governorate` (`governorate_id`);

--
-- Constraints for table `tbl_rrp5_output`
--
ALTER TABLE `tbl_rrp5_output`
  ADD CONSTRAINT `tbl_rrp5_output_ibfk_1` FOREIGN KEY (`sector_id`) REFERENCES `tbl_sector` (`sector_id`);

--
-- Constraints for table `tbl_sector_role`
--
ALTER TABLE `tbl_sector_role`
  ADD CONSTRAINT `tbl_sector_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_sector_role_ibfk_3` FOREIGN KEY (`sector_id`) REFERENCES `tbl_sector` (`sector_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_sector_user`
--
ALTER TABLE `tbl_sector_user`
  ADD CONSTRAINT `tbl_sector_user_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_sector_user_ibfk_4` FOREIGN KEY (`sector_id`) REFERENCES `tbl_sector` (`sector_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_target`
--
ALTER TABLE `tbl_target`
  ADD CONSTRAINT `tbl_target_ibfk_1` FOREIGN KEY (`goal_id`) REFERENCES `tbl_goal` (`goal_id`);

--
-- Constraints for table `tbl_target_activity`
--
ALTER TABLE `tbl_target_activity`
  ADD CONSTRAINT `tbl_target_activity_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `tbl_activity` (`activity_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_target_activity_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `tbl_target` (`target_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_target_progress`
--
ALTER TABLE `tbl_target_progress`
  ADD CONSTRAINT `tbl_target_progress_ibfk_4` FOREIGN KEY (`unit_id`) REFERENCES `tbl_unit` (`unit_id`),
  ADD CONSTRAINT `tbl_target_progress_ibfk_5` FOREIGN KEY (`target_id`) REFERENCES `tbl_target` (`target_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_target_progress_pca_report`
--
ALTER TABLE `tbl_target_progress_pca_report`
  ADD CONSTRAINT `fk_Target_Progress_has_Pca_Report_Target_Progress1` FOREIGN KEY (`target_id`, `unit_id`) REFERENCES `tbl_target_progress` (`target_id`, `unit_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_target_progress_pca_report_ibfk_1` FOREIGN KEY (`pca_report_id`) REFERENCES `tbl_pca_report` (`pca_report_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_wbs`
--
ALTER TABLE `tbl_wbs`
  ADD CONSTRAINT `tbl_wbs_ibfk_1` FOREIGN KEY (`ir_id`) REFERENCES `tbl_intermediate_result` (`ir_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
