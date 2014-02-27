/*
SQLyog Ultimate v8.82 
MySQL - 5.0.51b-community-nt-log 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `NE_RUN_TYPE` (
	`ID` int (10),
	`BRAND` varchar (96),
	`MODEL` varchar (96),
	`VERSION` varchar (96),
	`COMMAND` varchar (768),
	`DESCRIPTION` varchar (768)
); 
insert into `NE_RUN_TYPE` (`ID`, `BRAND`, `MODEL`, `VERSION`, `COMMAND`, `DESCRIPTION`) values('1','ALU','ALL','ALL','show router interface detail',NULL);
insert into `NE_RUN_TYPE` (`ID`, `BRAND`, `MODEL`, `VERSION`, `COMMAND`, `DESCRIPTION`) values('2','ALU','ALL','ALL','show router arp',NULL);
insert into `NE_RUN_TYPE` (`ID`, `BRAND`, `MODEL`, `VERSION`, `COMMAND`, `DESCRIPTION`) values('3','ALU','ALL','ALL','show service fdb-mac',NULL);
insert into `NE_RUN_TYPE` (`ID`, `BRAND`, `MODEL`, `VERSION`, `COMMAND`, `DESCRIPTION`) values('4','ALU','ALL','ALL','show service sdp-using',NULL);
insert into `NE_RUN_TYPE` (`ID`, `BRAND`, `MODEL`, `VERSION`, `COMMAND`, `DESCRIPTION`) values('5','ALU','ALL','ALL','show service sap-using',NULL);
insert into `NE_RUN_TYPE` (`ID`, `BRAND`, `MODEL`, `VERSION`, `COMMAND`, `DESCRIPTION`) values('6','ALU','ALL','ALL','show service service-using',NULL);
insert into `NE_RUN_TYPE` (`ID`, `BRAND`, `MODEL`, `VERSION`, `COMMAND`, `DESCRIPTION`) values('7','ALU','ALL','ALL','show service customer',NULL);
insert into `NE_RUN_TYPE` (`ID`, `BRAND`, `MODEL`, `VERSION`, `COMMAND`, `DESCRIPTION`) values('8','ALU','ALL','ALL','show lag description',NULL);
