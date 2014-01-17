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
                                //->text;
                                ->queryAll();
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
        
        
        public function actionShowGraph()
	{
                        if($_POST[txtService]!=""){
                            $sqlService = "b.NAME='$_POST[txtService]' AND";
                            $sqlService2 = "service='$_POST[txtService]' AND";
                        }else{
                            $sqlService = "";
                            $sqlService2 = "";
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
                        
                        
                        $row = Yii::app()->db->createCommand()
                                
                                
                                ->select("a.IP_ADDR AS txtIp,DATE_FORMAT(a.UPDATE_DATE,'%d %b %Y %H:%i:%s') AS txtDate,b.NAME AS txtService,a.SUBS_NUM AS txtNums,'circle' AS txtSymbol")
                                ->FROM("SUBS_LOG_ARCH a, PORT_TYPE_MAP b")
                                ->WHERE("$sqlService $sqlServiceType a.PORT_TYPE=b.ID AND a.PORT_STATE='UP' AND a.IP_ADDR='$_POST[txtIP]' AND (a.UPDATE_DATE BETWEEN '$_POST[txtDateStart]' - INTERVAL 6 HOUR AND '$_POST[txtDateEnd]' + INTERVAL 6 HOUR)")
                                ->union("SELECT node_ip AS txtIp,DATE_FORMAT(start_date,'%d %b %Y %H:%i:%s') AS txtDate,service AS txtService,conn_subs AS txtNums,'cross' AS txtSymbol FROM NE_SUBSSTAT WHERE $sqlService2 node_ip='$_POST[txtIP]' AND start_date>='$_POST[txtDateStart]' - INTERVAL 6 HOUR AND end_date<='$_POST[txtDateEnd]' + INTERVAL 6 HOUR")
                                ->union("SELECT node_ip AS txtIp,DATE_FORMAT(end_date,'%d %b %Y %H:%i:%s') AS txtDate,service AS txtService,conn_subs AS txtNums,'cross' AS txtSymbol FROM NE_SUBSSTAT WHERE $sqlService2 node_ip='$_POST[txtIP]' AND start_date>='$_POST[txtDateStart]' - INTERVAL 6 HOUR AND end_date<='$_POST[txtDateEnd]' + INTERVAL 6 HOUR")
                                
                                ->ORDER("txtDate ASC,txtService ASC")
                                //->text;
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