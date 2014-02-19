/*
SQLyog Ultimate v8.82 
MySQL - 5.0.51b-community-nt-log 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `ATTRIB_LIST` (
	`ID` int (10),
	`ATTRIB_TYPE_ID` int (11),
	`NAME` varchar (384),
	`DESCRIPTION` int (11)
); 
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('1','1','Interface Table (Router: Base)',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('2','1','Interface',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('3','5','If Name',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('4','5','Admin State',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('5','5','Oper (v4/v6)',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('6','5','Protocols',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('7','2','IP Addr/mask',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('8','5','Address Type',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('9','5','IGP Inhibit',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('10','5','Broadcast Address',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('11','1','Details',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('12','5','Description',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('13','5','If Index',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('14','5','Virt. If Index',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('15','5','Last Oper Chg',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('16','5','Global If Index',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('17','5','SAP Id',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('18','5','TOS Marking',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('19','5','If Type',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('20','5','SNTP B.Cast',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('21','5','IES ID',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('22','3','MAC Address',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('23','5','Arp Timeout',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('24','5','IP Oper MTU',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('25','5','ICMP Mask Reply',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('26','5','Arp Populate',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('27','5','Host Conn Verify',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('28','5','Cflowd',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('29','5','LdpSyncTimer',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('30','5','LSR Load Balance',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('31','5','uRPF Chk',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('32','5','uRPF Fail Bytes',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('33','5','uRPF Chk Fail Pkts',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('34','1','Proxy ARP Details',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('35','5','Rem Proxy ARP',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('36','5','Local Proxy ARP',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('37','5','Policies',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('38','1','Proxy Neighbor Discovery Details',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('39','5','Local Pxy ND',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('40','1','DHCP no local server',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('41','5','',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('42','1','DHCP Details',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('43','5','Lease Populate',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('44','2','Gi-Addr',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('45','5','Gi-Addr as Src Ip',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('46','5','Action',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('47','5','Trusted',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('48','1','DHCP Proxy Details',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('49','5','Lease Time',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('50','5','Emul. Server',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('51','1','Subscriber Authentication Details',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('52','5','Auth Policy',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('53','1','DHCP6 Relay Details',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('54','5','Oper State',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('55','5','Nbr Resolution',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('56','5','If-Id Option',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('57','5','Remote Id',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('58','5','Src Addr',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('59','1','DHCP6 Server Details',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('60','5','Max. Lease States',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('61','1','ICMP Details',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('62','5','Redirects',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('63','5','Unreachables',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('64','5','TTL Expired',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('65','1','IPCP Address Extension Details',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('66','1','Network Domains Associated',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('67','5','Peer IP Addr',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('68','5','Peer Pri DNS Addr',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('69','5','Peer Sec DNS Addr',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('70','5','Port Id',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('71','5','Egress Filter',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('72','5','Ingress Filter',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('73','5','Egr IPv6 Flt',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('74','5','Ingr IPv6 Flt',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('75','5','QoS Policy',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('76','5','Queue-group',NULL);
insert into `ATTRIB_LIST` (`ID`, `ATTRIB_TYPE_ID`, `NAME`, `DESCRIPTION`) values('77','5','Strip-Label',NULL);
