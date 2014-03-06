USE nerepdb;

CREATE TABLE `ATTRIB_LIST` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ATTRIB_TYPE_ID` int(11) DEFAULT NULL,
  `NAME` varchar(128) DEFAULT NULL,
  `DESCRIPTION` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;


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
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (13,20,'Lsp',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (14,9,'Internet Address is',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (15,10,'Hardware address is',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (16,3,'MAC',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (17,6,'VLAN',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (18,6,'CEVLAN',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (19,7,'INTERFACE',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (20,8,'VPN-INSTANCE',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (21,11,'PVC',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (22,12,'SERVICE_ID',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (23,6,'PEVLAN',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (24,9,'PeerAddr',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (25,12,'VsiID',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (26,8,'VSI Name',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (27,13,'InLabel',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (28,13,'OutLabel',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (29,14,'PeerIP',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (30,15,'VcOrSiteId',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (31,16,'Vsi-Name',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (32,17,'ActorPortName',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (33,18,'LAG ID',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (34,19,'System ID',null);
insert into `ATTRIB_LIST`(`ID`,`ATTRIB_TYPE_ID`,`NAME`,`DESCRIPTION`) values (35,21,'System ID',null);
