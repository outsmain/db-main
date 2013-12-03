USE nerepdb;

CREATE TABLE `PORT_TYPE_MAP` (
  `ID` smallint(5) unsigned NOT NULL DEFAULT '0',
  `NAME` varchar(32) DEFAULT NULL,
  `TYPE_VER` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (1,'OTHER',null);
insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (6,'ETHERNET',null);
insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (23,'PPP',null);
insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (24,'LOOPBACK',null);
insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (94,'ADSL',1);
insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (96,'SDSL',1);
insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (97,'VDSL',1);
insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (117,'ETHERNET',2);
insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (135,'LAYER2_VLAN',null);
insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (136,'IP_VLAN',null);
insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (142,'IP_FORWARD',null);
insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (169,'SHDSL',null);
insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (250,'GPON',null);
insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (251,'VDSL',2);
insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (255,'OTHER',null);
insert into `PORT_TYPE_MAP`(`ID`,`NAME`,`TYPE_VER`) values (301,'OTHER',null);
