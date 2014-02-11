﻿USE nerepdb;

CREATE TABLE `ATTRIB_LIST` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ATTRIB_TYPE_ID` int(11) DEFAULT NULL,
  `NAME` varchar(128) DEFAULT NULL,
  `DESCRIPTION` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (1,2,'IP Addr/mask',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (2,3,'MAC Address',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (3,2,'Gi-Addr',null);
