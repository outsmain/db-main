USE nerepdb;

CREATE TABLE `PAGENAME` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(64) DEFAULT NULL,
  `TITLE` varchar(64) DEFAULT NULL,
  `COMMENT` varchar(256) DEFAULT NULL,
  `MODELNAME` varchar(64) DEFAULT NULL,
  `TYPE` enum('PAGE','MENU','PANEL','GRAPHIC') DEFAULT NULL,
  `NEXTPAGE` int(11) DEFAULT NULL,
  `PREVPAGE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;


insert into `PAGENAME`(`ID`,`NAME`,`TITLE`,`COMMENT`,`MODELNAME`,`TYPE`,`NEXTPAGE`,`PREVPAGE`) values (1,'LoginPage','Login Page','','','MENU',null,null);
insert into `PAGENAME`(`ID`,`NAME`,`TITLE`,`COMMENT`,`MODELNAME`,`TYPE`,`NEXTPAGE`,`PREVPAGE`) values (2,'subsrep/','Subscriber','Subscriber',null,'MENU',null,null);
insert into `PAGENAME`(`ID`,`NAME`,`TITLE`,`COMMENT`,`MODELNAME`,`TYPE`,`NEXTPAGE`,`PREVPAGE`) values (3,'subsrep/outage','Impact','Subscriber > Impact',null,'MENU',null,2);
insert into `PAGENAME`(`ID`,`NAME`,`TITLE`,`COMMENT`,`MODELNAME`,`TYPE`,`NEXTPAGE`,`PREVPAGE`) values (4,'subsrep/query','Query','Subscriber > Query',null,'MENU',null,2);
insert into `PAGENAME`(`ID`,`NAME`,`TITLE`,`COMMENT`,`MODELNAME`,`TYPE`,`NEXTPAGE`,`PREVPAGE`) values (5,'subsrep/outage?serv=online','Login Page','Subscriber > Impact > Online',null,'MENU',null,3);
insert into `PAGENAME`(`ID`,`NAME`,`TITLE`,`COMMENT`,`MODELNAME`,`TYPE`,`NEXTPAGE`,`PREVPAGE`) values (6,'subsrep/outage?serv=wifi','WiFi','Subscriber > Impact > WiFi',null,'MENU',null,3);
insert into `PAGENAME`(`ID`,`NAME`,`TITLE`,`COMMENT`,`MODELNAME`,`TYPE`,`NEXTPAGE`,`PREVPAGE`) values (7,'subsrep/query?serv=online','Online','Subscriber > Query > Online',null,'MENU',null,4);
insert into `PAGENAME`(`ID`,`NAME`,`TITLE`,`COMMENT`,`MODELNAME`,`TYPE`,`NEXTPAGE`,`PREVPAGE`) values (8,'subsrep/query?serv=wifi','WiFi','Subscriber > Query > WiFi',null,'MENU',null,4);
insert into `PAGENAME`(`ID`,`NAME`,`TITLE`,`COMMENT`,`MODELNAME`,`TYPE`,`NEXTPAGE`,`PREVPAGE`) values (9,'authrep/','Authen Log','Authen Log',null,'MENU',null,null);
insert into `PAGENAME`(`ID`,`NAME`,`TITLE`,`COMMENT`,`MODELNAME`,`TYPE`,`NEXTPAGE`,`PREVPAGE`) values (10,'authrep/user','User','Authen Log > User',null,'MENU',null,9);
insert into `PAGENAME`(`ID`,`NAME`,`TITLE`,`COMMENT`,`MODELNAME`,`TYPE`,`NEXTPAGE`,`PREVPAGE`) values (11,'configrepos/','Config Repos.','Config Repos.',null,'MENU',null,null);
insert into `PAGENAME`(`ID`,`NAME`,`TITLE`,`COMMENT`,`MODELNAME`,`TYPE`,`NEXTPAGE`,`PREVPAGE`) values (12,'utilrep/','Util Report','Util Report',null,'MENU',null,null);
insert into `PAGENAME`(`ID`,`NAME`,`TITLE`,`COMMENT`,`MODELNAME`,`TYPE`,`NEXTPAGE`,`PREVPAGE`) values (13,'/','Dashboard','Main Dashboard',null,'PAGE',null,null);
