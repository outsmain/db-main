CREATE TABLE `NE_AUTHACCT` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `login_date` datetime DEFAULT NULL,
  `status` enum('AUTH-ACCEPT','AUTH-REJECT','ACCT-START','ACCT-STOP') DEFAULT NULL,
  `node_ip` varchar(64) DEFAULT NULL,
  `node_name` varchar(64) DEFAULT NULL,
  `user_name` varchar(64) DEFAULT NULL,
  `user_ip` varchar(64) DEFAULT NULL,
  `group_name` varchar(64) DEFAULT NULL,
  `priv_name` varchar(64) DEFAULT NULL,
  `cmd` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `login_date` (`login_date`),
  KEY `node_ip` (`node_ip`),
  KEY `user_name` (`user_name`),
  KEY `user_ip` (`user_ip`),
  CONSTRAINT FK_NE_AUTHACCT_NODE_IP FOREIGN KEY (node_ip) REFERENCES NE_LIST (ip_addr)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

INSERT INTO `NE_AUTHACCT` VALUES (17,'2013-11-01 00:00:01','AUTH-ACCEPT','10.1.1.1','name1','user1','11.1.1.1','group1','viewer',NULL),(18,'2013-11-01 00:00:01','ACCT-START','10.1.1.1','name1','user1','11.1.1.1','group1','viewer','show port e1'),(19,'2013-11-01 00:00:01','ACCT-START','10.1.1.1','name1','user1','11.1.1.1','group1','viewer','conf a'),(20,'2013-11-01 00:00:01','AUTH-REJECT','10.1.1.1','name1','user1','11.1.1.1','group1','viewer',NULL),(21,'2013-11-01 00:00:01','AUTH-ACCEPT','10.1.1.2','name2','user1','11.1.1.2','group1','viewer',NULL),(22,'2013-11-01 00:00:01','ACCT-START','10.1.1.2','name2','user1','11.1.1.2','group1','viewer','show port e2'),(23,'2013-11-01 00:00:01','ACCT-START','10.1.1.2','name2','user1','11.1.1.2','group1','viewer','conf b'),(24,'2013-11-01 00:00:01','AUTH-REJECT','10.1.1.2','name2','user1','11.1.1.2','group1','viewer',NULL),(25,'2013-11-01 00:00:01','AUTH-ACCEPT','10.1.1.3','name3','user1','11.1.1.3','oper office','oper',NULL),(26,'2013-11-01 00:00:01','ACCT-START','10.1.1.3','name3','user1','11.1.1.3','oper office','oper','show port e3'),(27,'2013-11-01 00:00:01','ACCT-START','10.1.1.3','name3','user1','11.1.1.3','oper office','oper','conf c'),(28,'2013-11-01 00:00:01','AUTH-REJECT','10.1.1.3','name3','user1','11.1.1.3','oper office','oper',NULL),(29,'2013-11-01 00:00:01','AUTH-ACCEPT','10.1.1.4','name4','user1','11.1.1.4','admin','admin all',NULL),(30,'2013-11-01 00:00:01','ACCT-START','10.1.1.4','name4','user1','11.1.1.4','admin','admin all','show port e3'),(31,'2013-11-01 00:00:01','ACCT-START','10.1.1.4','name4','user1','11.1.1.4','admin','admin all','conf d'),(32,'2013-11-01 00:00:01','AUTH-REJECT','10.1.1.4','name4','user1','11.1.1.4','admin','admin all',NULL);