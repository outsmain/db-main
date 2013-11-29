DELIMITER $$

USE `nerepdb`$$

DROP PROCEDURE IF EXISTS `PROC_AUTHACCT_SUM`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_AUTHACCT_SUM`(IN start_date DATETIME,
IN end_date DATETIME,
IN sum_dur ENUM('HOURLY','DATE_HOURLY','DAILY','WEEKLY','YEARLY'),
IN sum_type ENUM('NODE_NAME','NODE_GROUP','USER_NAME','SITE_NAME','USER_IP','USER_GROUP')
)
BEGIN 
INSERT INTO NE_AUTHSUM (
update_date,
last_login,
sum_dur,
sum_type,
node_ip,
node_name,
site_name,
node_group,
user_name,
user_ip,
user_group,
accept_num,
reject_num,
success_rate,
login_rate,
cmd_num,
cmd_rate
)SELECT 
NOW(),
c.lasttime,
sum_dur AS sum_dur,
sum_type AS sum_type,
IF(sum_type = 'NODE_NAME',c.node_ip, NULL) AS node_ip,
IF(sum_type = 'NODE_NAME',c.node_name, NULL) AS node_name,
IF(sum_type = 'SITE_NAME',c.site_name, NULL) AS site_name,
IF(sum_type = 'NODE_GROUP',c.level, NULL) AS node_group,
IF(sum_type = 'USER_NAME',c.user_name, NULL) AS user_name,
IF(sum_type = 'USER_IP',c.user_ip, NULL) AS user_ip,
IF(sum_type = 'USER_GROUP',c.group_name, NULL) AS group_name,
c.accept_num, 
c.reject_num, 
IF((c.accept_num + c.reject_num) > 0,(c.accept_num / (c.accept_num + c.reject_num))*100, 0) AS success_rate,
((c.accept_num + c.reject_num) / (UNIX_TIMESTAMP(end_date)-UNIX_TIMESTAMP(start_date))*100) AS login_rate ,
c.cmd_num,
((c.cmd_num / (UNIX_TIMESTAMP(end_date)-UNIX_TIMESTAMP(start_date)))*100) AS cmd_rate
FROM(
SELECT 
a.node_ip,
a.node_name,
b.site_name,
b.level,
a.user_name,
a.user_ip,
a.group_name,
MAX(a.login_date) AS lasttime ,
SUM(CASE WHEN a.status = "AUTH-ACCEPT" THEN 1 ELSE 0 END) AS accept_num ,
SUM(CASE WHEN a.status = "AUTH-REJECT" THEN 1 ELSE 0 END) AS reject_num ,
SUM(CASE WHEN a.status IN ('ACCT-START','ACCT-STOP') THEN 1 ELSE 0 END) AS cmd_num 
FROM NE_AUTHACCT a 
JOIN NE_LIST b ON a.login_date >= start_date AND a.login_date <= end_date AND a.node_ip = b.ip_addr
GROUP BY 
CASE sum_dur 
WHEN 'HOURLY' THEN HOUR(a.login_date)
WHEN 'DATE_HOURLY' THEN DATE(a.login_date)
WHEN 'DAILY' THEN DATE(a.login_date)
WHEN 'WEEKLY' THEN WEEKOFYEAR(a.login_date)
WHEN 'YEARLY' THEN YEAR(a.login_date)
END,
CASE sum_dur 
WHEN 'DATE_HOURLY' THEN HOUR(a.login_date)
END,
CASE sum_type
WHEN 'NODE_NAME' THEN a.node_name
WHEN 'NODE_GROUP' THEN b.level
WHEN 'USER_NAME' THEN a.user_name
WHEN 'SITE_NAME' THEN b.site_name
WHEN 'USER_IP' THEN a.user_ip
WHEN 'USER_GROUP' THEN a.group_name
END
) c; 
END$$

DELIMITER ;