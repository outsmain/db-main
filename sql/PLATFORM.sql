USE nerepdb;

CREATE TABLE `PLATFORM` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NAME` varchar(45) DEFAULT NULL,
  `COMMENT` varchar(255) DEFAULT NULL,
  `LOGO` varchar(255) DEFAULT NULL,
  `HOMEPAGE` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


insert into `PLATFORM`(`ID`,`NAME`,`COMMENT`,`LOGO`,`HOMEPAGE`) values (1,'nerep','NE Report',null,null);
