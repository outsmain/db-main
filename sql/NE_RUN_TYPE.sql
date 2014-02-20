USE nerepdb;

CREATE TABLE `NE_RUN_TYPE` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `BRAND` varchar(32) DEFAULT NULL,
  `MODEL` varchar(32) DEFAULT NULL,
  `VERSION` varchar(32) DEFAULT NULL,
  `COMMAND` varchar(256) DEFAULT NULL,
  `DESCRIPTION` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;


insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (1,'ALU','ALL','ALL','show router interface detail',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (2,'ALU','ALL','ALL','show router arp',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (3,'ALU','ALL','ALL','show service fdb-mac',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (4,'ALU','ALL','ALL','show service sdp-using',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (5,'ALU','ALL','ALL','show service sap-using',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (6,'ALU','ALL','ALL','show service service-using',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (7,'ALU','ALL','ALL','show service customer',null);
insert into `NE_RUN_TYPE`(`ID`,`BRAND`,`MODEL`,`VERSION`,`COMMAND`,`DESCRIPTION`) values (8,'ALU','ALL','ALL','show lag description',null);
