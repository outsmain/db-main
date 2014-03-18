USE nerepdb;

CREATE TABLE `NE_RUN_TYPE` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `BRAND` varchar(32) DEFAULT NULL,
  `MODEL` varchar(32) DEFAULT NULL,
  `VERSION` varchar(32) DEFAULT NULL,
  `COMMAND` varchar(256) DEFAULT NULL,
  `DESCRIPTION` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;


insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (1,'ALU','ALL','ALL','show router interface detail',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (2,'ALU','ALL','ALL','show router arp',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (3,'ALU','ALL','ALL','show service fdb-mac',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (4,'ALU','ALL','ALL','show service sdp-using',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (5,'ALU','ALL','ALL','show service sap-using',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (6,'ALU','ALL','ALL','show service service-using',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (7,'ALU','ALL','ALL','show service customer',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (8,'ALU','ALL','ALL','show lag description',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (9,'ALU','ALL','ALL','show router isis adjacency',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (10,'ALU','ALL','ALL','show router isis interface',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (11,'ALU','ALL','ALL','show router isis routes',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (12,'ALU','ALL','ALL','show router ospf interface',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (13,'ALU','ALL','ALL','show router ospf neighbor',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (14,'HWI','CX300','ALL','display mac-address',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (15,'HWI','CX300','ALL','display arp',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (16,'HWI','CX300','ALL','display interface',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (17,'HWI','CX300','ALL','display eth-trunk',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (18,'HWI','CX600','ALL','display mac-address',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (19,'HWI','CX600','ALL','display arp all',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (20,'HWI','CX600','ALL','display interface',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (21,'HWI','CX600','ALL','display vpls connection',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (22,'HWI','CX600','ALL','display vpls forwarding-info',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (23,'HWI','CX600','ALL','display isis route',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (24,'HWI','CX600','ALL','display isis peer',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (25,'HWI','CX600','ALL','display mpls l2vc',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (26,'HWI','CX600','ALL','display isis lsdb',null);
