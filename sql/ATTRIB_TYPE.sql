﻿USE nerepdb;

CREATE TABLE `ATTRIB_TYPE` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `BRAND` varchar(64) DEFAULT NULL,
  `MODEL` varchar(64) DEFAULT NULL,
  `VERSION` varchar(32) DEFAULT NULL,
  `NAME` varchar(64) DEFAULT NULL,
  `DESCRIPTION` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;


insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (1,'ALL','ALL','ALL','GROUP',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (2,'ALL','ALL','ALL','IP_ADDRESS',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (3,'ALL','ALL','ALL','MAC_ADDRESS',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (4,'ALL','ALL','ALL','NEXT_HOP_IP',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (5,'ALL','ALL','ALL','OTHER',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (6,'ALL','ALL','ALL','VLAN',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (7,'ALL','ALL','ALL','INTERFACE_NAME',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (8,'HWI','ALL','ALL','SERVICE_NAME',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (9,'HWI','CX300','ALL','IP_ADDRESS',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (10,'HWI','ALL','ALL','MAC_ADDRESS',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (11,'ALL','ALL','ALL','PVC',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (12,'HWI','ALL','ALL','SERVICE_ID',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (13,'HWI','ALL','ALL','LABEL_ID',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (14,'HWI','CX600','ALL','IP_ADDRESS',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (15,'HWI','CX600','ALL','IP_ADDRESS',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (16,'HWI','CX600','ALL','SERVICE_NAME',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (17,'HWI','CX300','ALL','INTERFACE_NAME',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (18,'ALL','ALL','ALL','LAG_ID',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (19,'HWI','ALL','ALL','MAC_ADDRESS',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (20,'HWI','ALL','ALL','LSP_ID',null);
insert into `ATTRIB_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`NAME`,`DESCRIPTION`) values (21,'ALU','ALL','ALL','IP_ADDRESS',null);
