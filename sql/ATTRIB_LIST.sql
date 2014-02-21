USE nerepdb;

CREATE TABLE `ATTRIB_LIST` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ATTRIB_TYPE_ID` int(11) DEFAULT NULL,
  `NAME` varchar(128) DEFAULT NULL,
  `DESCRIPTION` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;


insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (1,2,'IP Addr/mask',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (2,3,'MAC Address',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (3,2,'Gi-Addr',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (4,1,'ARP Table (Router: Base)',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (5,1,'Interface Table (Router: Base)',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (6,7,'Interface',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (7,2,'IP Address',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (9,1,'Details',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (10,6,'VLAN/VSI',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (11,7,'Port',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (12,5,'Type',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (13,5,'Lsp',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (14,2,'Internet Address is',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (15,3,'Hardware address is',null);
