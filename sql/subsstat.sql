CREATE TABLE `tbl_subsstat` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `node_ip` varchar(64) DEFAULT NULL,
  `node_name` varchar(64) DEFAULT NULL,
  `int_name` varchar(64),
  `service` ENUM('FIXED_LINE','ADSL','DOCSIS','GPON','DSL','ETHERNET','FDDI','ATM','FRAME_RELAY','LEASED_LINE','WIFI','MOBILE'),
  `sub_service` varchar(64),
  `prov_subs` INT,
  `conn_subs` INT,
  `min_line` FLOAT,
  PRIMARY KEY (`id`),
  KEY `event_date` (`start_date`,`end_date`),
  KEY `node_ip` (`node_ip`),
  KEY `node_name` (`node_name`),
  CONSTRAINT tbl_subsstat_fk_node_ip FOREIGN KEY (node_ip) REFERENCES tbl_nas(nasname)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

insert into tbl_subsstat(start_date,end_date,node_ip,node_name,service,sub_service,prov_subs,conn_subs,min_line) VALUES('2013-11-01 00:00:01','2013-11-02 00:00:01','10.1.1.1','name1','DSL',NULL,11,22,1.01);
insert into tbl_subsstat(start_date,end_date,node_ip,node_name,service,sub_service,prov_subs,conn_subs,min_line) VALUES('2013-11-03 00:00:01','2013-11-04 00:00:01','10.1.1.2','name2','DOCSIS',NULL,22,33,1.02);
insert into tbl_subsstat(start_date,end_date,node_ip,node_name,service,sub_service,prov_subs,conn_subs,min_line) VALUES('2013-11-05 00:00:01','2013-11-06 00:00:01','10.1.1.3','name3','GPON',NULL,33,44,1.03);
insert into tbl_subsstat(start_date,end_date,node_ip,node_name,service,sub_service,prov_subs,conn_subs,min_line) VALUES('2013-11-01 00:00:01','2013-11-02 00:00:01','10.1.1.1','name1','DSL',NULL,44,55,1.04);
insert into tbl_subsstat(start_date,end_date,node_ip,node_name,service,sub_service,prov_subs,conn_subs,min_line) VALUES('2013-11-03 00:00:01','2013-11-04 00:00:01','10.1.1.2','name2','DOCSIS',NULL,55,66,1.05);
insert into tbl_subsstat(start_date,end_date,node_ip,node_name,service,sub_service,prov_subs,conn_subs,min_line) VALUES('2013-11-05 00:00:01','2013-11-06 00:00:01','10.1.1.3','name3','WIFI',NULL,66,77,1.06);