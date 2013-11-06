CREATE TABLE `tbl_nas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nasname` varchar(128) NOT NULL,
  `shortname` varchar(32) DEFAULT NULL,
  `type` varchar(30) DEFAULT 'other',
  `ports` int(5) DEFAULT NULL,
  `secret` varchar(60) NOT NULL DEFAULT 'secret',
  `server` varchar(64) DEFAULT NULL,
  `community` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT 'RADIUS Client',
  `groupname` varchar(32) DEFAULT NULL,
  `sub_groupname` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq` (`nasname`),
  KEY `sub_groupname` (`sub_groupname`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

insert into tbl_nas(nasname,shortname,type,description,groupname,sub_groupname) VALUES('10.1.1.1','name1','type1','model1','group1','sub_group1');
insert into tbl_nas(nasname,shortname,type,description,groupname,sub_groupname) VALUES('10.1.1.2','name2','type2','model2','group2','sub_group2');
insert into tbl_nas(nasname,shortname,type,description,groupname,sub_groupname) VALUES('10.1.1.3','name3','type3','model3','group3','sub_group3');
insert into tbl_nas(nasname,shortname,type,description,groupname,sub_groupname) VALUES('10.1.1.4','name4','type4','model4','group4','sub_group4');
