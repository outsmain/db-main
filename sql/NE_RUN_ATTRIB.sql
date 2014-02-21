﻿USE nerepdb;

CREATE TABLE `NE_RUN_ATTRIB` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UPDATE_DATE` datetime DEFAULT NULL,
  `NE_RUN_TYPE_ID` int(10) unsigned DEFAULT NULL,
  `NE_RUN_DATA_ID` int(10) unsigned DEFAULT NULL,
  `IP_ADDR` varchar(64) DEFAULT NULL,
  `ENTRY_ID` int(10) unsigned DEFAULT NULL,
  `PARENT_GROUP_ID` int(10) unsigned DEFAULT NULL,
  `GROUP_ID` int(10) unsigned DEFAULT NULL,
  `ATTRIB_KEY_ID` int(10) unsigned DEFAULT NULL,
  `ATTRIB_VALUE` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;


insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`NE_RUN_TYPE_ID`,`NE_RUN_DATA_ID`,`IP_ADDR`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (1,'2013-06-06 01:30:20',1,1,'14.23.9.270',1,5,6,1,'14.23.9.278');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`NE_RUN_TYPE_ID`,`NE_RUN_DATA_ID`,`IP_ADDR`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (2,'2014-02-20 15:00:00',1,1,'14.23.9.270',1,5,9,2,'04:03:08:03:08:01');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`NE_RUN_TYPE_ID`,`NE_RUN_DATA_ID`,`IP_ADDR`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (3,'2014-02-20 15:00:00',2,2,'14.23.9.270',1,null,4,7,'14.23.10.27');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`NE_RUN_TYPE_ID`,`NE_RUN_DATA_ID`,`IP_ADDR`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (4,'2014-02-20 15:00:00',2,2,'14.23.9.270',1,null,4,2,'04:03:08:03:08:03');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`NE_RUN_TYPE_ID`,`NE_RUN_DATA_ID`,`IP_ADDR`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (5,'2014-02-20 15:00:00',2,3,'14.23.9.280',1,null,4,2,'04:03:08:03:08:04');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`NE_RUN_TYPE_ID`,`NE_RUN_DATA_ID`,`IP_ADDR`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (6,'2014-02-20 15:00:00',2,3,'14.23.9.280',1,null,4,7,'14.23.9.280');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`NE_RUN_TYPE_ID`,`NE_RUN_DATA_ID`,`IP_ADDR`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (7,'2014-02-20 15:00:00',1,4,'14.23.9.280',1,5,6,1,'14.23.9.279');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`NE_RUN_TYPE_ID`,`NE_RUN_DATA_ID`,`IP_ADDR`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (8,'2014-02-20 15:00:00',1,4,'14.23.9.280',1,5,9,2,'04:03:08:03:08:02');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`NE_RUN_TYPE_ID`,`NE_RUN_DATA_ID`,`IP_ADDR`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (9,'2014-02-20 15:00:00',16,5,'14.23.9.275',1,null,null,14,'14.23.9.281');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`NE_RUN_TYPE_ID`,`NE_RUN_DATA_ID`,`IP_ADDR`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (10,'2014-02-20 15:00:00',16,5,'14.23.9.275',1,null,null,15,'04:03:08:03:08:05');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`NE_RUN_TYPE_ID`,`NE_RUN_DATA_ID`,`IP_ADDR`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (11,'2014-02-20 15:00:00',15,6,'14.23.9.275',1,null,null,7,'14.23.9.282');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`NE_RUN_TYPE_ID`,`NE_RUN_DATA_ID`,`IP_ADDR`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (12,'2014-02-20 15:00:00',15,6,'14.23.9.275',1,null,null,2,'04:03:08:03:08:06');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`NE_RUN_TYPE_ID`,`NE_RUN_DATA_ID`,`IP_ADDR`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (14,'2014-02-20 15:00:00',15,6,'14.23.9.275',3,null,null,11,'Eth-T1');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`NE_RUN_TYPE_ID`,`NE_RUN_DATA_ID`,`IP_ADDR`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (15,'2014-02-20 15:00:00',1,1,'14.23.9.270',2,5,6,2,'04:03:08:03:08:06');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`NE_RUN_TYPE_ID`,`NE_RUN_DATA_ID`,`IP_ADDR`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (16,'2014-02-20 15:00:00',1,1,'14.23.9.270',2,5,9,1,'14.23.9.282');
