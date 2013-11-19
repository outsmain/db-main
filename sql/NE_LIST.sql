CREATE TABLE `NE_LIST` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `add_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `ip_addr` varchar(32) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `comment` varchar(32) DEFAULT NULL,
  `site_name` varchar(32) DEFAULT NULL,
  `brand` varchar(64) DEFAULT NULL,
  `model` varchar(64) DEFAULT NULL,
  `sw_ver` varchar(32) DEFAULT NULL,
  `ne_type` enum('SWITCH','ROUTER','BRAS','DSLAM','MODEM','CONTROLLER','AP','OTHER') DEFAULT NULL,
  `rw_community` varchar(64) DEFAULT NULL,
  `ro_community` varchar(64) DEFAULT NULL,
  `level` enum('CSN','PTN','RCU','OUTDOOR','CPE') DEFAULT NULL,
  `is_use` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `model` (`model`),
  KEY `brand` (`brand`),
  KEY `ip_addr` (`ip_addr`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
INSERT INTO `NE_LIST` VALUES (1,'2013-11-13 15:12:06','2013-11-13 15:12:06','10.1.1.1','name1','comment1','site1','brand1','model1','ver1','SWITCH','abc1','def1','CSN',1),(2,'2013-11-13 15:12:06','2013-11-13 15:12:06','10.1.1.2','name2','comment2','site2','brand2','model2','ver2','ROUTER','abc2','def2','PTN',1),(3,'2013-11-13 15:12:06','2013-11-13 15:12:06','10.1.1.3','name3','comment3','site3','brand3','model3','ver3','BRAS','abc3','def3','RCU',1),(4,'2013-11-13 15:12:06','2013-11-13 15:12:06','10.1.1.4','name4','comment4','site4','brand4','model4','ver4','DSLAM','abc4','def4','OUTDOOR',1);