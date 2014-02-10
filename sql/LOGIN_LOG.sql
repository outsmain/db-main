﻿USE nerepdb;

CREATE TABLE `LOGIN_LOG` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UPDATE_DATE` datetime DEFAULT NULL,
  `USER_NAME` varchar(32) DEFAULT NULL,
  `USER_IP` varchar(32) DEFAULT NULL,
  `CLIENT_NAME` varchar(128) DEFAULT NULL,
  `COMMAND` enum('LOGIN','LOGOUT','OPEN','ADD','MODIFY','REMOVE') DEFAULT NULL,
  `VALUE` varchar(256) DEFAULT NULL,
  `STATUS` enum('LOGIN_FAILED','OK','INVALID_TIME','INVALID_COMMAND','INVALID_CLIENT') DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

