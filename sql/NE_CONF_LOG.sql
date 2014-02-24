USE nerepdb;

CREATE TABLE `NE_CONF_LOG` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `UPDATE_DATE` datetime NOT NULL,
  `IP_ADDR` varchar(32) NOT NULL,
  `DATA` text NOT NULL,
  `INDEX_HASH` varchar(32) DEFAULT NULL,
  `REVISION` varchar(16) DEFAULT NULL,
  `COMMENT` text,
  PRIMARY KEY (`ID`),
  KEY `DATE_IP` (`IP_ADDR`,`UPDATE_DATE`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


insert into `NE_CONF_LOG`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`DATA`,`INDEX_HASH`,`REVISION`,`COMMENT`) values (1,'2014-02-13 03:00:00','12.98.168.147','!
version 11.2
no service pad
no service udp-small-servers
no service tcp-small-servers
!
hostname Switch-1
!
enable password mysecret
!
!
no spanning-tree vlan 1
no ip domain-lookup
!
cluster commander-address 00d0.5868.f180
!
interface VLAN1
no ip address
no ip route-cache
!
interface FastEthernet0/1
!
interface FastEthernet0/2
!
interface FastEthernet0/3
!
interface FastEthernet0/4
!
interface FastEthernet0/5
!
interface FastEthernet0/6
!
interface FastEthernet0/7
!
interface FastEthernet0/8
!
interface FastEthernet0/9
!
interface FastEthernet0/10
!
interface FastEthernet0/11
!
interface FastEthernet0/12
!
interface FastEthernet0/13
!
interface FastEthernet0/14
!
interface FastEthernet0/15
!
interface FastEthernet0/16
!
!
line con 0
stopbits 1
line vty 0 4
login
line vty 5 15
login
!
end',null,null,null);
insert into `NE_CONF_LOG`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`DATA`,`INDEX_HASH`,`REVISION`,`COMMENT`) values (2,'2014-02-14 00:00:00','12.98.167.123','!
version 12.0
no service pad
service timestamps debug uptime
service timestamps log uptime
no service password-encryption
!
hostname Switch-2
!
enable password mysecret
!
!
!
!
!
!
ip subnet-zero
!
cluster commander-address 00d0.5868.f180 member 2 name engineering
!
!
interface FastEthernet0/1
!
interface FastEthernet0/2
!
interface FastEthernet0/3
!
interface FastEthernet0/4
!
interface FastEthernet0/5
!
interface FastEthernet0/6
!
interface FastEthernet0/7
!
interface FastEthernet0/8
!
interface FastEthernet0/9
!
interface FastEthernet0/10
!
interface FastEthernet0/11
!
interface FastEthernet0/12
!
interface GigabitEthernet0/1
!
interface GigabitEthernet0/2
!
interface VLAN1
no ip address
no ip directed-broadcast
no ip route-cache
!
!
line con 0
transport input none
stopbits 1
line vty 0 4
login
line vty 5 15
login
!
end',null,null,null);
insert into `NE_CONF_LOG`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`DATA`,`INDEX_HASH`,`REVISION`,`COMMENT`) values (3,'2014-02-15 08:00:00','12.98.168.147','!
version 11.2
no service pad
no service udp-small-servers
no service tcp-small-servers
!
hostname Switch-1
!
enable password mysecret
!
!
no spanning-tree vlan 1
no ip domain-lookup
!
cluster commander-address 00d0.5868.f180
!
interface VLAN1
no ip address
no ip route-cache
!
interface FastEthernet0/1
desc sw2-f0/1
!
interface FastEthernet0/2
!
interface FastEthernet0/3
!
interface FastEthernet0/4
!
interface FastEthernet0/5
!
interface FastEthernet0/6
!
interface FastEthernet0/7
!
interface FastEthernet0/8
!
interface FastEthernet0/9
!
interface FastEthernet0/10
!
interface FastEthernet0/11
!
interface FastEthernet0/12
!
interface FastEthernet0/13
!
interface FastEthernet0/14
!
interface FastEthernet0/15
!
interface FastEthernet0/16
!
!
line con 0
stopbits 1
line vty 0 4
login
line vty 5 15
login
!
end',null,null,null);
insert into `NE_CONF_LOG`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`DATA`,`INDEX_HASH`,`REVISION`,`COMMENT`) values (4,'2014-02-16 06:03:00','12.98.167.123','!
version 12.0
no service pad
service timestamps debug uptime
service timestamps log uptime
no service password-encryption
!
hostname Switch-2
!
enable password mysecret
!
!
!
!
!
!
ip subnet-zero
!
cluster commander-address 00d0.5868.f180 member 2 name engineering
!
!
interface FastEthernet0/1
desc sw1-f0/1
!
interface FastEthernet0/2
!
interface FastEthernet0/3
!
interface FastEthernet0/4
!
interface FastEthernet0/5
!
interface FastEthernet0/6
!
interface FastEthernet0/7
!
interface FastEthernet0/8
!
interface FastEthernet0/9
!
interface FastEthernet0/10
!
interface FastEthernet0/11
!
interface FastEthernet0/12
!
interface GigabitEthernet0/1
!
interface GigabitEthernet0/2
!
interface VLAN1
no ip address
no ip directed-broadcast
no ip route-cache
!
!
line con 0
transport input none
stopbits 1
line vty 0 4
login
line vty 5 15
login
!
end',null,null,null);
insert into `NE_CONF_LOG`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`DATA`,`INDEX_HASH`,`REVISION`,`COMMENT`) values (5,'2014-02-17 06:43:00','12.98.167.123','!
version 12.0
no service pad
service timestamps debug uptime
service timestamps log uptime
no service password-encryption
!
hostname Switch-2
!
enable password mysecret
!
!
!
!
!
!
ip subnet-zero
!
cluster commander-address 00d0.5868.f180 member 2 name engineering
!
!
interface FastEthernet0/1
desc sw1-f0/1
!
interface FastEthernet0/2
!
interface FastEthernet0/3
!
interface FastEthernet0/4
!
interface FastEthernet0/5
!
interface FastEthernet0/6
!
interface FastEthernet0/7
!
interface FastEthernet0/8
!
interface FastEthernet0/9
!
interface FastEthernet0/10
!
interface FastEthernet0/11
!
interface FastEthernet0/12
!
interface GigabitEthernet0/1
desc sw1-g0/1
!
interface GigabitEthernet0/2
!
interface VLAN1
no ip address
no ip directed-broadcast
no ip route-cache
!
!
line con 0
transport input none
stopbits 1
line vty 0 4
login
line vty 5 15
login
!
end',null,null,null);
insert into `NE_CONF_LOG`(`ID`,`UPDATE_DATE`,`IP_ADDR`,`DATA`,`INDEX_HASH`,`REVISION`,`COMMENT`) values (6,'2014-02-18 06:23:00','12.98.168.147','!
version 11.2
no service pad
no service udp-small-servers
no service tcp-small-servers
!
hostname Switch-1
!
enable password mysecret
!
!
no spanning-tree vlan 1
no ip domain-lookup
!
cluster commander-address 00d0.5868.f180
!
interface VLAN1
no ip address
no ip route-cache
!
interface FastEthernet0/1
desc sw2-f0/1
!
interface FastEthernet0/2
!
interface FastEthernet0/3
!
interface FastEthernet0/4
!
interface FastEthernet0/5
!
interface FastEthernet0/6
!
interface FastEthernet0/7
!
interface FastEthernet0/8
!
interface FastEthernet0/9
!
interface FastEthernet0/10
!
interface FastEthernet0/11
!
interface FastEthernet0/12
!
interface FastEthernet0/13
!
interface FastEthernet0/14
!
interface FastEthernet0/15
!
interface FastEthernet0/16
desc sw2-g0/2
!
!
line con 0
stopbits 1
line vty 0 4
login
line vty 5 15
login
!
end',null,null,null);
