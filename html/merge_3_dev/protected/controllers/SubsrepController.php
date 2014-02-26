<?php

class SubsrepController extends Controller
{

	public function actionIndex() {
		$model = new SubsForm;
		$this->render('index',array('model'=>$model));
	}

	public function actionNas()
	{
		$model = Yii::app()->db->createCommand()
			->select("DATE_FORMAT(a.add_date,'%d %b %Y %H:%i:%s') AS add_date,DATE_FORMAT(a.update_date,'%d %b %Y %H:%i:%s') AS update_date,a.ip_addr,a.name,a.comment,a.site_name,a.brand,a.model,a.sw_ver,a.ne_type,a.level,a.is_use")
			->from('NE_LIST a, NE_SUBSSTAT b')
			->where("b.id='$_POST[id]' and a.ip_addr=b.node_ip")
			->queryAll();
		echo CJSON::encode($model);
 	}

           
	public function actionSearch()
	{
            
		if($_POST[OnlineService]!=""){
                    $txtServiceReplace=str_replace(" ", "_", $_POST[OnlineService]);
                    $txtService="a.service='$txtServiceReplace'";
		}else{
                    $txtService = "";
		}
                $strNodeName = "";
                $strNodeIp = "";
                    
                
                if($_POST[CountList]!=count($_POST[note_name])){
                    
                    if(!empty($_POST[note_name])){
                            foreach($_POST[note_name] as $item){
                                    $node = explode('xx#xx',$item);
                                    
                                    foreach($node as $val){
                                        if(!empty($val)){
                                            $long = ip2long(trim($val));
                                            if ($long == -1 || $long === FALSE) {
                                                    $strNodeName .= "'".trim($val)."',";
                                            }else{
                                                    $strNodeIp .= "'".trim($val)."',";
                                            }
                                        }
                                    }
                            }
                            if(!empty($strNodeName)){
                                $strNodeName = '('.substr($strNodeName,0,-1).')';
                                $strNodeName = 'a.node_name = '.$strNodeName;
                            }
                            if(!empty($strNodeIp)){
                                $strNodeIp = '('.substr($strNodeIp,0,-1).')';
                                $strNodeIp = 'a.node_ip = '.$strNodeIp;
                            }
                    }
                }
                
                $txtAll1 = explode(" ", $_POST[start_date]);
                $txtDate1 =explode("-", $txtAll1[0]);
                $txtDate1[0] = $txtDate1[0];
                $txtDate1 = "$txtDate1[2]-$txtDate1[1]-$txtDate1[0]";
                $txtDateStart = "a.start_date>='$txtDate1 $txtAll1[1]'";

                $txtAll2 = explode(" ", $_POST[end_date]);
                $txtDate2 =explode("-", $txtAll2[0]);
                $txtDate2[0] = $txtDate2[0];
                $txtDate2 = "$txtDate2[2]-$txtDate2[1]-$txtDate2[0]";
                $txtDateEnd = "a.end_date<='$txtDate2 $txtAll2[1]'";

                $row = Yii::app()->db->createCommand()
                                ->select("a.id,a.node_name,a.node_ip,TIMESTAMPDIFF(second,a.start_date,a.end_date) as diffs,DATE_FORMAT(a.start_date,'%d %b %Y %H:%i:%s') AS start_date,DATE_FORMAT(a.end_date,'%d %b %Y %H:%i:%s') AS end_date,a.start_date as start_date_diff,a.end_date as end_date_diff,REPLACE(a.service,'_', ' ') as service,a.prov_subs,a.conn_subs, ROUND(a.min_line,3) as min_line")
                                ->from('NE_SUBSSTAT a')
                                //->where("$txtDateStart $txtDateEnd $txtService $txtNode ")
                                ->where(array('and', $txtDateStart, $txtDateEnd, $txtService, $strNodeName, $strNodeIp))
                                ->order('a.node_name asc')
                                ->queryAll();
                                //->text;
                                //print_r($row);
                echo CJSON::encode($row);
                
	}
        
                
	public function actionShowAll()
	{
                        $row = Yii::app()->db->createCommand()
                                ->select("tb2.id,tb2.node_name,tb2.node_ip,TIMESTAMPDIFF(second,tb2.start_date,tb2.end_date) as diffs,DATE_FORMAT(tb2.start_date,'%d %b %Y %H:%i:%s') AS start_date,DATE_FORMAT(tb2.end_date,'%d %b %Y %H:%i:%s') AS end_date,tb2.start_date as start_date_diff,tb2.end_date as end_date_diff,REPLACE(tb2.service,'_', ' ') as service,tb2.prov_subs,tb2.conn_subs, ROUND(tb2.min_line,3) as min_line")
                                //->from('(SELECT max(end_date) as maxdate FROM NE_SUBSSTAT) AS tb1 INNER JOIN NE_SUBSSTAT AS tb2 ON tb1.maxdate= tb2.end_date')
                                ->from('NE_SUBSSTAT AS tb2')
                                ->order('tb2.node_name asc')
                                //->text;
                                ->queryAll();
                        echo CJSON::encode($row);
        }
                 
	public function actionDataTableLazy()
	{
            
            

            $sLimit = "";
            $sLimits = "";
            
                if ( isset( $_POST['iDisplayStart'] ) && $_POST['iDisplayLength'] != '-1' )
                {
                        $sLimit = mysql_real_escape_string( $_POST['iDisplayLength'] );
                        $sLimits = mysql_real_escape_string( $_POST['iDisplayStart'] );
                }
                
                
                $aColumns1 = array( '', 'tb2.node_name', 'tbSub.start_dates', 'tbSub.end_dates', 'tbSub.Durations', 'service', 'tb2.prov_subs', 'tb2.conn_subs', 'min_line' );
                /*
                 * Ordering
                 */
                $sOrder = "";
                if ( isset( $_POST['iSortCol_0'] ) )
                {
                        for ( $i=0 ; $i<intval( $_POST['iSortingCols'] ) ; $i++ )
                        {
                                if ( $_POST[ 'bSortable_'.intval($_POST['iSortCol_'.$i]) ] == "true" )
                                {
                                        $sOrder .= $aColumns1[ intval( $_POST['iSortCol_'.$i] ) ]."
                                                ".mysql_real_escape_string( $_POST['sSortDir_'.$i] ) .", ";
                                }
                        }
                        $sOrder = substr_replace( $sOrder, "", -2 );
                        if ( $sOrder == "" )
                        {
                                $sOrder = "tb2.node_name ASC";
                        }
                }
                
                
                $aColumns = array( 'tb2.node_name', 'start_dates', 'end_dates', 'tbSub.Durations', 'service', 'tb2.prov_subs', 'tb2.conn_subs', 'min_line' );
                $sWhere = "";
                if ( $_POST['sSearch'] != "" )
                {
                        $sWhere = " (";
                        for ( $i=0 ; $i<count($aColumns) ; $i++ )
                        {
                                $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_POST['sSearch'] )."%' OR ";
                        }
                        $sWhere = substr_replace( $sWhere, "", -3 );
                        $sWhere .= ')';
                }

                /* Individual column filtering */
                for ( $i=0 ; $i<count($aColumns) ; $i++ )
                {
                        if ( $_POST['bSearchable_'.$i] == "true" && $_POST['sSearch_'.$i] != '' )
                        {
                                if ( $sWhere == "" )
                                {
                                        $sWhere = " ";
                                }
                                else
                                {
                                        $sWhere .= " AND ";
                                }
                                $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
                        }
                }
                
                if($sOrder=="\n                                                asc" or $sOrder=="\n                                                desc" or $sOrder==""){
                    $sOrder = "tb2.node_name ASC, tb2.id ASC";
                }
                
                
                if($_POST["start_date"]!="" or $sWhere!=""){
                    $and1 = "and";
                }
                
                if($_POST["start_date"]!="" and $sWhere!=""){
                    $and = "and";
                }
                
                
                //Search
                if($_POST["start_date"]!=""){
                    
                    if($_POST[OnlineService]!=""){
                        $txtServiceReplace=str_replace(" ", "_", $_POST[OnlineService]);
                        $txtService="and tb2.service='$txtServiceReplace'";
                    }else{
                        $txtService = "";
                    }
                    $strNodeName = "";
                    $strNodeIp = "";
                            
                    if(!empty($_POST[note_name])){
                            $nodeip = explode(',',$_POST[note_name]);
                            foreach($nodeip as $item){
                                $node = explode('xx#xx',$item);
                                foreach($node as $val){
                                    if(!empty($val)){
                                        $long = ip2long(trim($val));
                                        if ($long == -1 || $long === FALSE) {
                                                $strNodeName .= "(tb2.node_name = '".trim($val)."') or ";
                                        }else{
                                                $strNodeIp .= "(tb2.node_ip = '".trim($val)."') or ";
                                        }
                                    }
                                }
                            }
                            if(!empty($strNodeName)){
                                $strNodeName = '('.substr($strNodeName,0,-4).')';
                                $strNodeName = 'and '.$strNodeName;
                            }
                            if(!empty($strNodeIp)){
                                $strNodeIp = '('.substr($strNodeIp,0,-4).')';
                                $strNodeIp = 'and '.$strNodeIp;
                            }
                    }

                    $txtAll1 = explode(" ", $_POST[start_date]);
                    $txtDate1 =explode("-", $txtAll1[0]);
                    $txtDate1[0] = $txtDate1[0];
                    $txtDate1 = "$txtDate1[2]-$txtDate1[1]-$txtDate1[0]";
                    $txtDateStart = "tb2.start_date>='$txtDate1 $txtAll1[1]'";

                    $txtAll2 = explode(" ", $_POST[end_date]);
                    $txtDate2 =explode("-", $txtAll2[0]);
                    $txtDate2[0] = $txtDate2[0];
                    $txtDate2 = "$txtDate2[2]-$txtDate2[1]-$txtDate2[0]";
                    $txtDateEnd = "and tb2.end_date<='$txtDate2 $txtAll2[1]'";
                    $filter = "$txtDateStart $txtDateEnd $txtService $strNodeName $strNodeIp";
                    
                }
                
                $sql1 = "SELECT 
                            tb2.id,tb2.node_name,tb2.node_ip,tb2.start_date,tb2.end_date,tbSub.Durations,tbSub.start_dates,tbSub.end_dates,
                        REPLACE(tb2.service,'_', ' ') AS service,tb2.prov_subs,tb2.conn_subs,
                        CASE WHEN tb2.min_line <> NULL THEN ROUND(tb2.min_line,3) ELSE '-' END AS min_line
                        FROM NE_SUBSSTAT AS tb2,(SELECT id,CONCAT(
                            CASE WHEN MOD(TIMESTAMPDIFF(DAY,start_date,end_date), 30) <> 0 THEN CONCAT(MOD(TIMESTAMPDIFF(DAY,start_date,end_date), 30),'d ') ELSE '' END,
                            CASE WHEN MOD(TIMESTAMPDIFF(MONTH,start_date,end_date), 12) <> 0 THEN CONCAT(MOD(TIMESTAMPDIFF(MONTH,start_date,end_date), 12),'m ') ELSE '' END,
                            CASE WHEN TIMESTAMPDIFF(YEAR,start_date,end_date) <> 0 THEN CONCAT(TIMESTAMPDIFF(YEAR,start_date,end_date),'y ') ELSE '' END,
                            CASE WHEN MOD(TIMESTAMPDIFF(HOUR,start_date,end_date), 24) <> 0 THEN CONCAT(MOD(TIMESTAMPDIFF(HOUR,start_date,end_date), 24),'hrs ') ELSE '' END,
                            CASE WHEN MOD(TIMESTAMPDIFF(MINUTE,start_date,end_date), 60) <> 0 THEN CONCAT(MOD(TIMESTAMPDIFF(MINUTE,start_date,end_date), 60),'min ') ELSE '' END,
                            CASE WHEN MOD(TIMESTAMPDIFF(SECOND,start_date,end_date), 60) <> 0 THEN CONCAT(MOD(TIMESTAMPDIFF(SECOND,start_date,end_date), 60),'sec ') ELSE '' END
                        ) AS Durations,
                        DATE_FORMAT(start_date,'%d %b %Y %H:%i:%s') AS start_dates,
                        DATE_FORMAT(end_date,'%d %b %Y %H:%i:%s') AS end_dates
                        FROM NE_SUBSSTAT)  AS tbSub
                        WHERE tb2.id=tbSub.id $and1 $filter $and $sWhere
                        ORDER BY $sOrder LIMIT $sLimits,$sLimit";
                
                
                
                $query1 = Yii::app()->db->createCommand($sql1)->queryAll();
//                                ->text;
//                                print_r($row1);
                
                $row2 = Yii::app()->db->createCommand()
                    ->select("COUNT(tb2.id) AS Sumid")
                    ->from('NE_SUBSSTAT AS tb2')
                    ->queryAll();
                $iTotal = (int)$row2[0]["Sumid"];
                
                
                $sql3 = "SELECT COUNT(tb2.id) AS FilteredTotal
                        FROM NE_SUBSSTAT AS tb2,(SELECT id,CONCAT(
                            CASE WHEN MOD(TIMESTAMPDIFF(DAY,start_date,end_date), 30) <> 0 THEN CONCAT(MOD(TIMESTAMPDIFF(DAY,start_date,end_date), 30),'d ') ELSE '' END,
                            CASE WHEN MOD(TIMESTAMPDIFF(MONTH,start_date,end_date), 12) <> 0 THEN CONCAT(MOD(TIMESTAMPDIFF(MONTH,start_date,end_date), 12),'m ') ELSE '' END,
                            CASE WHEN TIMESTAMPDIFF(YEAR,start_date,end_date) <> 0 THEN CONCAT(TIMESTAMPDIFF(YEAR,start_date,end_date),'y ') ELSE '' END,
                            CASE WHEN MOD(TIMESTAMPDIFF(HOUR,start_date,end_date), 24) <> 0 THEN CONCAT(MOD(TIMESTAMPDIFF(HOUR,start_date,end_date), 24),'hrs ') ELSE '' END,
                            CASE WHEN MOD(TIMESTAMPDIFF(MINUTE,start_date,end_date), 60) <> 0 THEN CONCAT(MOD(TIMESTAMPDIFF(MINUTE,start_date,end_date), 60),'min ') ELSE '' END,
                            CASE WHEN MOD(TIMESTAMPDIFF(SECOND,start_date,end_date), 60) <> 0 THEN CONCAT(MOD(TIMESTAMPDIFF(SECOND,start_date,end_date), 60),'sec ') ELSE '' END
                        ) AS Durations,
                        DATE_FORMAT(start_date,'%d %b %Y %H:%i:%s') AS start_dates,
                        DATE_FORMAT(end_date,'%d %b %Y %H:%i:%s') AS end_dates
                        FROM NE_SUBSSTAT)  AS tbSub
                        WHERE tb2.id=tbSub.id $and1 $filter $and $sWhere";
                $query3 = Yii::app()->db->createCommand($sql3)->queryAll();
                
                $iFilteredTotal = (int)$query3[0]["FilteredTotal"];
                
                $output = array(
                        "sEcho" => intval($_POST['sEcho']),
                        "iTotalRecords" => $iTotal,
                        "iTotalDisplayRecords" => $iFilteredTotal,
                        "aaData" => array()
                );

                
               $row22 = array();
               $nd = "";
               for ( $i=0 ; $i<count($query1) ; $i++ ) {

                   
                   
                   
                if($nd != $query1[$i]["node_name"]){
                   $row22[0] = "<div onclick=\"SplitDialogs('".$query1[$i]["id"]."')\"><td>&nbsp;</td></div>";
                   $row22[1] = "<div onclick=\"fnGraph('ShowGraph','".$query1[$i]["node_ip"]."','".$query1[$i]["start_date"]."','".$query1[$i]["end_date"]."','')\">".$query1[$i]["node_name"]."</div>";
                    $nd = $query1[$i]["node_name"];
                }else{						
                   $row22[0] = "<div onclick=\"SplitDialogs('".$query1[$i]["id"]."')\"><td>&nbsp;</td></div>";
                   $row22[1] = "<div onclick=\"SplitDialogs('".$query1[$i]["id"]."')\"><td>&nbsp;</td></div>";
                }
                   $row22[2] = "<div onclick=\"SplitDialogs('".$query1[$i]["id"]."')\"><td>".$query1[$i]["start_dates"]."</td></div>";
                   $row22[3] = "<div onclick=\"SplitDialogs('".$query1[$i]["id"]."')\"><td>".$query1[$i]["end_dates"]."</td></div>";
                   $row22[4] = "<div onclick=\"SplitDialogs('".$query1[$i]["id"]."')\"><td>".$query1[$i]["Durations"]."</td></div>";
                   $row22[5] = "<div onclick=\"fnGraph('ShowGraph','".$query1[$i]["node_ip"]."','".$query1[$i]["start_date"]."','".$query1[$i]["end_date"]."','".$query1[$i]["service"]."')\">".$query1[$i]["service"]."</div>";
                   $row22[6] = "<div onclick=\"SplitDialogs('".$query1[$i]["id"]."')\"><td>".$query1[$i]["prov_subs"]."</td></div>";
                   $row22[7] = "<div onclick=\"SplitDialogs('".$query1[$i]["id"]."')\"><td>".$query1[$i]["conn_subs"]."</td></div>";
                   $row22[8] = "<div onclick=\"SplitDialogs('".$query1[$i]["id"]."')\"><td onclick=''>".$query1[$i]["min_line"]."</td></div>";
                   
                   $output['aaData'][]=$row22;
                   
               }
                echo CJSON::encode($output);
        }
        
        public function actionShowGraph()
	{
                        if($_POST[txtService]!=""){
                            $sqlService = "b.NAME='$_POST[txtService]' AND";
                            $sqlService2 = "service='$_POST[txtService]' AND";
                            $sqlService3 = "tb1.txtService='$_POST[txtService]' AND";
                        }else{
                            $sqlService = "";
                            $sqlService2 = "";
                            $sqlService3 = "";
                        }
                        
                        if($_POST[txtServType]!=""){
                            $txtServType = explode(",", $_POST[txtServType]);
                            $sqlServiceType .= "(";
                            for($i=0;$i<=count($txtServType)-1;$i++){
                                $sqlServiceType .= "a.SERVICE_TYPE='$txtServType[$i]'";
                                if($i < count($txtServType)-1){
                                    $sqlServiceType .= " OR ";
                                }
                            }   
                            $sqlServiceType .= ") AND ";
                        }
                        
                            
//                        $row = Yii::app()->db->createCommand()
//                                ->select("a.IP_ADDR AS txtIp,DATE_FORMAT(a.UPDATE_DATE,'%d %b %Y %H:%i:%s') AS txtDate,b.NAME AS txtService,a.SUBS_NUM AS txtNums,'circle' AS txtSymbol")
//                                ->FROM("SUBS_LOG_ARCH a, PORT_TYPE_MAP b")
//                                ->WHERE("$sqlService $sqlServiceType a.PORT_TYPE=b.ID AND a.PORT_STATE='UP' AND a.IP_ADDR='$_POST[txtIP]' AND (a.UPDATE_DATE BETWEEN '$_POST[txtDateStart]' - INTERVAL 6 HOUR AND '$_POST[txtDateEnd]' + INTERVAL 6 HOUR)")
//                                ->union("SELECT node_ip AS txtIp,DATE_FORMAT(start_date,'%d %b %Y %H:%i:%s') AS txtDate,service AS txtService,conn_subs AS txtNums,'cross' AS txtSymbol FROM NE_SUBSSTAT WHERE $sqlService2 node_ip='$_POST[txtIP]' AND start_date>='$_POST[txtDateStart]' - INTERVAL 6 HOUR AND end_date<='$_POST[txtDateEnd]' + INTERVAL 6 HOUR")
//                                ->union("SELECT node_ip AS txtIp,DATE_FORMAT(end_date,'%d %b %Y %H:%i:%s') AS txtDate,service AS txtService,conn_subs AS txtNums,'cross' AS txtSymbol FROM NE_SUBSSTAT WHERE $sqlService2 node_ip='$_POST[txtIP]' AND start_date>='$_POST[txtDateStart]' - INTERVAL 6 HOUR AND end_date<='$_POST[txtDateEnd]' + INTERVAL 6 HOUR")
//                                ->ORDER("txtDate ASC,txtService ASC")
//                                ->queryAll();
                        
                        
                        $row = Yii::app()->db->createCommand()
                                ->select("a.IP_ADDR AS txtIp, DATE_FORMAT(a.UPDATE_DATE, '%d %b %Y %H:%i:%s') AS txtDatePoint, b.NAME AS txtService, a.SUBS_NUM AS txtNums, 'circle' AS txtSymbol, a.UPDATE_DATE AS txtDate, '' AS txtPointStatus")
                                ->FROM("SUBS_LOG_ARCH a, PORT_TYPE_MAP b")
                                ->WHERE("$sqlService $sqlServiceType a.PORT_TYPE = b.ID AND a.PORT_STATE = 'UP' AND a.IP_ADDR = '$_POST[txtIP]' AND (a.UPDATE_DATE BETWEEN '$_POST[txtDateStart]' - INTERVAL 6 HOUR AND '$_POST[txtDateEnd]' + INTERVAL 6 HOUR)")
                                ->union("SELECT node_ip AS txtIp, DATE_FORMAT(start_date, '%d %b %Y %H:%i:%s') AS txtDatePoint, service AS txtService, conn_subs AS txtNums, 'cross' AS txtSymbol, start_date AS txtDate, '' AS txtPointStatus FROM NE_SUBSSTAT WHERE $sqlService2 node_ip = '$_POST[txtIP]' AND start_date >= '$_POST[txtDateStart]' - INTERVAL 6 HOUR AND end_date <= '$_POST[txtDateEnd]' + INTERVAL 6 HOUR")
                                ->union("SELECT node_ip AS txtIp, DATE_FORMAT(end_date, '%d %b %Y %H:%i:%s') AS txtDatePoint, service AS txtService, conn_subs AS txtNums, 'cross' AS txtSymbol, end_date AS txtDate, '' AS txtPointStatus FROM NE_SUBSSTAT WHERE $sqlService2 node_ip='$_POST[txtIP]' AND start_date >= '$_POST[txtDateStart]' - INTERVAL 6 HOUR AND end_date <= '$_POST[txtDateEnd]' + INTERVAL 6 HOUR")
                                ->union("SELECT tb3.txtIp, DATE_FORMAT(tb3.txtDatePoint, '%d %b %Y %H:%i:%s') AS txtDatePoint, tb3.txtService,
                                    tb3.txtNums, 'cross' AS txtSymbol, tb3.txtDatePoint AS txtDate, '1' AS txtPointStatus
                                  FROM (SELECT tb1.txtIp, CONCAT(IF(tb2.SUM_WEEK+1 = 52,STR_TO_DATE(CONCAT(YEAR(tb1.txtEDate),' ',tb2.SUM_WEEK+1,' ',tb2.SUM_DOW), '%X%V %W'),STR_TO_DATE(CONCAT(YEAR(tb1.txtSDate),' ',tb2.SUM_WEEK+1,' ',tb2.SUM_DOW), '%X%V %W')),' ',tb2.SUM_TIME) AS txtDatePoint,
                                    tb1.txtService AS txtService, tb2.SUBS_NUM AS txtNums
                                  FROM (SELECT ID, node_ip AS txtIp, start_date AS txtSDate, end_date AS txtEDate, DATE_FORMAT(start_date, '%H:%i:%s') AS txtSTime,
                                      DATE_FORMAT(end_date, '%H:%i:%s') AS txtETime, service AS txtService 
                                    FROM NE_SUBSSTAT 
                                    WHERE node_ip = '$_POST[txtIP]' 
                                      AND start_date >= '$_POST[txtDateStart]' - INTERVAL 6 HOUR 
                                      AND end_date <= '$_POST[txtDateEnd]' + INTERVAL 6 HOUR 
                                    ORDER BY `txtSDate` ASC,
                                      `txtService` ASC) AS tb1,
                                    SUBS_STAT_HIST AS tb2 
                                  WHERE tb1.txtIp = tb2.NODE_IP 
                                    AND tb1.txtService = tb2.PORT_TYPE 
                                    AND tb2.PORT_STATE = 'UP' 
                                    AND (
                                      tb2.SUM_DOW BETWEEN DAYNAME(tb1.txtSDate) 
                                      AND DAYNAME(tb1.txtEDate)
                                    ) 
                                    AND (
                                      $sqlService3 tb2.SUM_TIME > tb1.txtSTime 
                                      AND tb2.SUM_TIME < tb1.txtETime
                                    ) AND tb2.SUM_WEEK >= (WEEK('$_POST[txtDateStart]' - INTERVAL 6 HOUR)-1) AND tb2.SUM_WEEK <= (WEEK('$_POST[txtDateEnd]' + INTERVAL 6 HOUR)-1)
                                  ORDER BY tb1.txtSDate ASC,
                                    tb2.SUM_TIME ASC,
                                    tb1.txtService ASC
                                   ) AS tb3")
                                
                                ->ORDER("txtDate ASC,txtService ASC")
                                ->queryAll();
                       echo CJSON::encode($row);
                        
        }
        
        public function actionServiceDropdownlists()
	{
            $row_dropDownLists = Yii::app()->db->createCommand()
                    ->select('DISTINCT REPLACE(a.service,"_", " ") as service')
                    ->from('NE_SUBSSTAT a')
                    ->order('a.service asc')
                    ->queryAll();
            echo CJSON::encode($row_dropDownLists);
 	}
        
}