/*
SQLyog Ultimate v8.82 
MySQL - 5.0.51b-community-nt-log 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `ATTRIB_TYPE` (
	`ID` int (10),
	`BRAND` varchar (192),
	`MODEL` varchar (192),
	`VERSION` varchar (96),
	`NAME` varchar (192),
	`DESCRIPTION` varchar (768)
); 
insert into `ATTRIB_TYPE` (`ID`, `BRAND`, `MODEL`, `VERSION`, `NAME`, `DESCRIPTION`) values('1','ALL','ALL','ALL','GROUP',NULL);
insert into `ATTRIB_TYPE` (`ID`, `BRAND`, `MODEL`, `VERSION`, `NAME`, `DESCRIPTION`) values('2','ALL','ALL','ALL','IP_ADDRESS',NULL);
insert into `ATTRIB_TYPE` (`ID`, `BRAND`, `MODEL`, `VERSION`, `NAME`, `DESCRIPTION`) values('3','ALL','ALL','ALL','MAC_ADDRESS',NULL);
insert into `ATTRIB_TYPE` (`ID`, `BRAND`, `MODEL`, `VERSION`, `NAME`, `DESCRIPTION`) values('4','ALL','ALL','ALL','NEXT_HOP_IP',NULL);
insert into `ATTRIB_TYPE` (`ID`, `BRAND`, `MODEL`, `VERSION`, `NAME`, `DESCRIPTION`) values('5','ALL','ALL','ALL','OTHER',NULL);
