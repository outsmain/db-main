DELIMITER $$
USE `nerepdb`$$
DROP PROCEDURE IF EXISTS `FILL_LOSS_SUBS_LOG`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `FILL_LOSS_SUBS_LOG`(
IN start_date DATETIME,
IN end_date DATETIME,
IN ip_addr VARCHAR(32),
IN service_type VARCHAR(32),
IN step INT,
IN tolerance INT
)
BEGIN
DECLARE LoopAmountIp INTEGER; 
DECLARE LoopAmountDate INTEGER; 
SET LoopAmountIp = 0;
SET @StartDate = start_date;
SET @EndDate = end_date;
SET @IpAddr = ip_addr;
SET @ServiceType = service_type;


SELECT COUNT(DISTINCT a.IP_ADDR) INTO @AmountIp
FROM SUBS_LOG_ARCH a
WHERE 
CASE WHEN ip_addr IS NOT NULL THEN a.ip_addr=ip_addr ELSE 1=1 END AND
a.SERVICE_TYPE = service_type AND
(a.UPDATE_DATE  BETWEEN start_date AND end_date); # หาจำนวน IP เพื่อใช้ในการวน loop while
		
WHILE LoopAmountIp < (@AmountIp) DO

	SET @LimitAmountIp = LoopAmountIp;
	PREPARE STMT FROM "
	SELECT a.IP_ADDR INTO @IpAdd
	FROM SUBS_LOG_ARCH a
	WHERE
	CASE WHEN ? IS NOT NULL THEN a.ip_addr=? ELSE 1=1 END AND
	a.SERVICE_TYPE = ? AND
	(a.UPDATE_DATE  BETWEEN ? AND ?) GROUP BY a.ip_addr
	ORDER BY a.ID ASC LIMIT  ?,1";
	EXECUTE STMT USING @IpAddr,@IpAddr,@ServiceType,@StartDate,@EndDate,@LimitAmountIp;
	SET LoopAmountIp = LoopAmountIp + 1;
	

	SELECT TIMESTAMPDIFF(MINUTE,start_date,end_date) INTO @DateDiff; # หาผลต่างของ start_date กับ end_date เป็นนาที
	
	SET @LoopDateStep = step;
	SET @stepAll = 0;
		
	loop_date:  LOOP
		
		SET @stepAll = @stepAll + step;	
		SET @LoopDateStep = @LoopDateStep + step;
			
		IF @LoopDateStep > (@DateDiff) THEN # มากกว่า loop
			LEAVE  loop_date;
		END IF;
	
		SELECT start_date + INTERVAL @stepAll MINUTE INTO @DateTimeStepEnd;
		SELECT @DateTimeStepEnd - INTERVAL step MINUTE INTO @DateTimeStepStart;	
					
		SELECT @DateTimeStepEnd + INTERVAL tolerance MINUTE INTO @DateTimeStepEnds;
		SELECT @DateTimeStepStart - INTERVAL tolerance MINUTE INTO @DateTimeStepStarts;	
	
	
		SELECT COUNT(DISTINCT a.IP_ADDR,a.UPDATE_DATE) INTO @CountAdd
		FROM SUBS_LOG_ARCH a
		WHERE a.IP_ADDR = @IpAdd AND
		a.SERVICE_TYPE = @ServiceType AND
		(a.UPDATE_DATE  BETWEEN @DateTimeStepStarts AND @DateTimeStepEnds);
					
		IF @CountAdd = 0 THEN
							
			SET @DateStartSub = @DateTimeStepStart;
			SET @DateEndSub = @DateTimeStepEnd;
				
			loop_date_sub:  LOOP
			
				SET @stepAll = @stepAll + step;	
				SET @LoopDateStep = @LoopDateStep + step;
				
				IF @LoopDateStep > (@DateDiff) THEN # มากกว่า loop
					LEAVE  loop_date_sub;
				END IF;
			
				SELECT start_date + INTERVAL @stepAll MINUTE INTO @DateTimeStepEnd;
				SELECT @DateTimeStepEnd - INTERVAL step MINUTE INTO @DateTimeStepStart;	
							
				SELECT @DateTimeStepEnd + INTERVAL tolerance MINUTE INTO @DateTimeStepEnds;
				SELECT @DateTimeStepStart - INTERVAL tolerance MINUTE INTO @DateTimeStepStarts;	
					
				SELECT COUNT(DISTINCT a.IP_ADDR,a.UPDATE_DATE) INTO @CountAdd
				FROM SUBS_LOG_ARCH a
				WHERE a.IP_ADDR = @IpAdd AND
				a.SERVICE_TYPE = @ServiceType AND
				(a.UPDATE_DATE  BETWEEN @DateTimeStepStarts AND @DateTimeStepEnds);
				
				IF @CountAdd = 0 THEN
					SET @DateEndSub = @DateTimeStepEnd;
				ELSE	
					LEAVE  loop_date_sub;
				END IF;
			
			END LOOP;	
				
				
			SELECT DAYNAME(SUBSTRING_INDEX(@DateTimeStepStart,' ',1)) INTO @DayName;
			SELECT UPPER(@DayName) INTO @DayName;
						
			SELECT SUBSTRING_INDEX(@DateTimeStepStarts,' ',-1) INTO @TimeStart;
			SELECT SUBSTRING_INDEX(@DateTimeStepEnds,' ',-1) INTO @TimeEnd;
				

			INSERT INTO NE_SUBSSTAT(
				start_date,end_date,node_ip,node_name,prov_subs,conn_subs
			)SELECT @DateStartSub,@DateEndSub,a.NODE_IP,a.NODE_NAME,
			(SELECT MAX(tb1.SUBS_NUM) FROM SUBS_STAT_HIST tb1
			WHERE tb1.NODE_IP=@IpAdd AND tb1.PORT_STATE='UP' AND 
			tb1.SUM_TIME BETWEEN @TimeStart AND @TimeEnd AND tb1.SUM_DOW=@DayName) AS MaxSubs,a.SUBS_NUM
			FROM SUBS_STAT_HIST a WHERE a.NODE_IP=@IpAdd AND a.PORT_STATE='UP'
			AND a.SUM_TIME BETWEEN @TimeStart AND @TimeEnd AND a.SUM_DOW=@DayName;
			
		END IF;
	END LOOP; 
			
END WHILE;


END$$
DELIMITER ;

#'12.95.189.49'
#'11.159.181.91'

CALL FILL_LOSS_SUBS_LOG("2013-11-22 00:00:00","2013-11-22 09:00:00", NULL, "ONLINE", 60, 5);
