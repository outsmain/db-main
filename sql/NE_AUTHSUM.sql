USE nerepdb;

CREATE TABLE `NE_AUTHSUM` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `update_date` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `sum_dur` enum('HOURLY','DATE_HOURLY','DAILY','WEEKLY','YEARLY') DEFAULT NULL,
  `sum_type` enum('NODE_NAME','NODE_GROUP','USER_NAME','SITE_NAME','USER_IP','USER_GROUP') DEFAULT NULL,
  `node_ip` varchar(64) DEFAULT NULL,
  `node_name` varchar(64) DEFAULT NULL,
  `site_name` varchar(64) DEFAULT NULL,
  `node_group` varchar(64) DEFAULT NULL,
  `user_name` varchar(64) DEFAULT NULL,
  `user_ip` varchar(64) DEFAULT NULL,
  `user_group` varchar(64) DEFAULT NULL,
  `accept_num` int(11) DEFAULT NULL,
  `reject_num` int(11) DEFAULT NULL,
  `success_rate` float DEFAULT NULL,
  `login_rate` float DEFAULT NULL,
  `cmd_num` int(11) DEFAULT NULL,
  `cmd_rate` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


