﻿USE nerepdb;

CREATE TABLE `ATTRIB_TYPE` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `BRAND` varchar(64) DEFAULT NULL,
  `MODEL` varchar(64) DEFAULT NULL,
  `VERSION` varchar(32) DEFAULT NULL,
  `NAME` varchar(64) DEFAULT NULL,
  `DESCRIPTION` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (1,'ALL','ALL','ALL','GROUP',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (2,'ALL','ALL','ALL','IP_ADDRESS',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (3,'ALL','ALL','ALL','MAC_ADDRESS',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (4,'ALL','ALL','ALL','NEXT_HOP_IP',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (5,'ALL','ALL','ALL','OTHER',null);