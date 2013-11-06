CREATE TABLE `tbl_authacct` (
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
  CONSTRAINT tbl_authacct_fk_node_ip FOREIGN KEY (node_ip) REFERENCES tbl_nas(nasname)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','AUTH-ACCEPT','10.1.1.1','name1','user1','11.1.1.1','group1','viewer',NULL);
INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','ACCT-START','10.1.1.1','name1','user1','11.1.1.1','group1','viewer','show port e1');
INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','ACCT-START','10.1.1.1','name1','user1','11.1.1.1','group1','viewer','conf a');
INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','AUTH-REJECT','10.1.1.1','name1','user1','11.1.1.1','group1','viewer',NULL);

INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','AUTH-ACCEPT','10.1.1.2','name2','user1','11.1.1.2','group1','viewer',NULL);
INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','ACCT-START','10.1.1.2','name2','user1','11.1.1.2','group1','viewer','show port e2');
INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','ACCT-START','10.1.1.2','name2','user1','11.1.1.2','group1','viewer','conf b');
INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','AUTH-REJECT','10.1.1.2','name2','user1','11.1.1.2','group1','viewer',NULL);

INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','AUTH-ACCEPT','10.1.1.3','name3','user1','11.1.1.3','oper office','oper',NULL);
INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','ACCT-START','10.1.1.3','name3','user1','11.1.1.3','oper office','oper','show port e3');
INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','ACCT-START','10.1.1.3','name3','user1','11.1.1.3','oper office','oper','conf c');
INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','AUTH-REJECT','10.1.1.3','name3','user1','11.1.1.3','oper office','oper',NULL);

INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','AUTH-ACCEPT','10.1.1.4','name4','user1','11.1.1.4','admin','admin all',NULL);
INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','ACCT-START','10.1.1.4','name4','user1','11.1.1.4','admin','admin all','show port e3');
INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','ACCT-START','10.1.1.4','name4','user1','11.1.1.4','admin','admin all','conf d');
INSERT INTO tbl_authacct(login_date,status,node_ip,node_name,user_name,user_ip,group_name,priv_name,cmd)
values('2013-11-01 00:00:01','AUTH-REJECT','10.1.1.4','name4','user1','11.1.1.4','admin','admin all',NULL);