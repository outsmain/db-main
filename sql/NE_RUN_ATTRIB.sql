﻿USE nerepdb;

CREATE TABLE `NE_RUN_ATTRIB` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UPDATE_DATE` datetime DEFAULT NULL,
  `IP_ADDR` varchar(64) DEFAULT NULL,
  `NE_RUN_DATA_ID` int(10) unsigned DEFAULT NULL,
  `ENTRY_ID` int(10) unsigned DEFAULT NULL,
  `PARENT_GROUP_ID` int(10) unsigned DEFAULT NULL,
  `GROUP_ID` int(10) unsigned DEFAULT NULL,
  `ATTRIB_KEY_ID` int(10) unsigned DEFAULT NULL,
  `ATTRIB_VALUE` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;


insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_DATA_ID`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (1,null,'14.23.9.270',1,1,5,6,1,'14.23.9.278');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_DATA_ID`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (2,null,'14.23.9.270',1,1,5,9,2,'04:03:08:03:08:01');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_DATA_ID`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (3,null,'14.23.9.270',2,1,null,4,7,'14.23.10.27');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_DATA_ID`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (4,null,'14.23.9.270',2,1,null,4,2,'04:03:08:03:08:03');
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_DATA_ID`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (5,null,'14.23.9.280',2,1,null,null,null,null);
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_DATA_ID`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (6,null,'14.23.9.280',2,1,null,null,null,null);
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_DATA_ID`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (7,null,'14.23.9.280',1,1,null,null,null,null);
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_DATA_ID`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (8,null,'14.23.9.280',1,1,null,null,null,null);
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_DATA_ID`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (9,null,'14.23.9.275',1,1,null,null,null,null);
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_DATA_ID`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (10,null,'14.23.9.275',1,1,null,null,null,null);
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_DATA_ID`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (11,null,'14.23.9.275',2,1,null,null,null,null);
insert into `NE_RUN_ATTRIB`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`NE_RUN_DATA_ID`,`ENTRY_ID`,`PARENT_GROUP_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`,`ATTRIB_VALUE`) values (12,null,'14.23.9.275',2,1,null,null,null,null);
