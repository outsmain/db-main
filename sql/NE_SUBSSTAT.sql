CREATE TABLE `NE_SUBSSTAT` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `node_ip` varchar(64) DEFAULT NULL,
  `node_name` varchar(64) DEFAULT NULL,
  `int_name` varchar(64) DEFAULT NULL,
  `service` enum('FIXED_LINE','ADSL','DOCSIS','GPON','DSL','ETHERNET','FDDI','ATM','FRAME_RELAY','LEASED_LINE','WIFI','MOBILE') DEFAULT NULL,
  `sub_service` varchar(64) DEFAULT NULL,
  `prov_subs` int(11) DEFAULT NULL,
  `conn_subs` int(11) DEFAULT NULL,
  `min_line` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_date` (`start_date`,`end_date`),
  KEY `node_ip` (`node_ip`),
  KEY `node_name` (`node_name`),
  CONSTRAINT `FK_NE_AUTHACCT_NODE_IP` FOREIGN KEY (`node_ip`) REFERENCES `NE_LIST` (`ip_addr`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `NE_SUBSSTAT` VALUES (1,'2013-11-01 00:00:01','2013-11-02 00:00:01','10.1.1.1','name1',NULL,'DSL',NULL,11,22,1.01),(2,'2013-11-03 00:00:01','2013-11-04 00:00:01','10.1.1.2','name2',NULL,'DOCSIS',NULL,22,33,1.02),(3,'2013-11-05 00:00:01','2013-11-06 00:00:01','10.1.1.3','name3',NULL,'GPON',NULL,33,44,1.03),(4,'2013-11-01 00:00:01','2013-11-02 00:00:01','10.1.1.1','name1',NULL,'DSL',NULL,44,55,1.04),(5,'2013-11-03 00:00:01','2013-11-04 00:00:01','10.1.1.2','name2',NULL,'DOCSIS',NULL,55,66,1.05),(6,'2013-11-05 00:00:01','2013-11-06 00:00:01','10.1.1.3','name3',NULL,'GPON',NULL,66,77,1.06);