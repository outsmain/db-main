-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Dec 13, 2013 at 09:47 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `nerepdb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `NE_SUBSSTAT`
-- 

CREATE TABLE `NE_SUBSSTAT` (
  `id` bigint(20) NOT NULL auto_increment,
  `start_date` datetime default NULL,
  `end_date` datetime default NULL,
  `node_ip` varchar(64) default NULL,
  `node_name` varchar(64) default NULL,
  `int_name` varchar(64) default NULL,
  `service` enum('FIXED_LINE','ADSL','DOCSIS','GPON','DSL','ETHERNET','FDDI','ATM','FRAME_RELAY','LEASED_LINE','WIFI','MOBILE') default NULL,
  `sub_service` varchar(64) default NULL,
  `prov_subs` int(11) default NULL,
  `conn_subs` int(11) default NULL,
  `min_line` float default NULL,
  PRIMARY KEY  (`id`),
  KEY `event_date` (`start_date`,`end_date`),
  KEY `node_ip` (`node_ip`),
  KEY `node_name` (`node_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `NE_SUBSSTAT`
-- 

INSERT INTO `NE_SUBSSTAT` VALUES (1, '2013-11-20 00:06:10', '2013-11-20 00:07:10', '12.95.189.49', 'name1', NULL, 'ETHERNET', NULL, 11, 22, 1.01);
INSERT INTO `NE_SUBSSTAT` VALUES (2, '2013-11-20 00:00:01', '2013-11-20 00:05:01', '12.95.232.89', 'name2', NULL, 'ETHERNET', NULL, 22, 33, 1.02);
INSERT INTO `NE_SUBSSTAT` VALUES (3, '2013-11-20 00:00:01', '2013-11-20 00:05:01', '12.95.116.249', 'name3', NULL, 'ETHERNET', NULL, 33, 44, 1.03);
INSERT INTO `NE_SUBSSTAT` VALUES (4, '2013-11-20 00:06:10', '2013-11-20 00:07:10', '12.95.189.49', 'name1', NULL, 'ADSL', NULL, 44, 55, 1.04);
INSERT INTO `NE_SUBSSTAT` VALUES (5, '2013-11-20 00:00:01', '2013-11-20 00:05:01', '12.95.232.89', 'name2', NULL, 'ADSL', NULL, 55, 66, 1.05);
INSERT INTO `NE_SUBSSTAT` VALUES (6, '2013-11-20 00:00:01', '2013-11-20 00:05:01', '12.95.116.249', 'name3', NULL, 'ADSL', NULL, 66, 77, 1.06);

-- 
-- Constraints for dumped tables
-- 

-- 
-- Constraints for table `NE_SUBSSTAT`
-- 
ALTER TABLE `NE_SUBSSTAT`
  ADD CONSTRAINT `FK_NE_AUTHACCT_NODE_IP` FOREIGN KEY (`node_ip`) REFERENCES `ne_list` (`ip_addr`);
