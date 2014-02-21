USE nerepdb;

CREATE TABLE `NE_LINK_RULE` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NE_RUN_TYPE_ID` int(10) unsigned DEFAULT NULL,
  `GROUP_ID` int(10) unsigned DEFAULT NULL,
  `ATTRIB_KEY_ID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


insert into `NE_LINK_RULE`(`ID`,`NE_RUN_TYPE_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`) values (1,1,6,1);
insert into `NE_LINK_RULE`(`ID`,`NE_RUN_TYPE_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`) values (2,1,9,2);
insert into `NE_LINK_RULE`(`ID`,`NE_RUN_TYPE_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`) values (3,2,4,7);
insert into `NE_LINK_RULE`(`ID`,`NE_RUN_TYPE_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`) values (4,2,4,2);
insert into `NE_LINK_RULE`(`ID`,`NE_RUN_TYPE_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`) values (5,15,null,2);
insert into `NE_LINK_RULE`(`ID`,`NE_RUN_TYPE_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`) values (6,15,null,7);
insert into `NE_LINK_RULE`(`ID`,`NE_RUN_TYPE_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`) values (7,15,null,11);
insert into `NE_LINK_RULE`(`ID`,`NE_RUN_TYPE_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`) values (8,16,null,14);
insert into `NE_LINK_RULE`(`ID`,`NE_RUN_TYPE_ID`,`GROUP_ID`,`ATTRIB_KEY_ID`) values (9,16,null,15);
