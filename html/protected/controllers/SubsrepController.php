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
			->select('a.add_date,a.update_date,a.ip_addr,a.name,a.comment,a.site_name,a.brand,a.model,a.sw_ver,a.ne_type,a.level,a.is_use')
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
                                ->select('a.id,a.node_name,TIMESTAMPDIFF(second,a.start_date,a.end_date) as diffs,a.start_date,a.end_date,REPLACE(a.service,"_", " ") as service,a.prov_subs,a.conn_subs, ROUND(a.min_line,3) as min_line')
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
            
//                        $row = Yii::app()->db->createCommand()
//                                ->select('ID,IP_ADDR,NE_TYPE,UPDATE_DATE,PORT_TYPE,SUBS_NUM')
//                                ->from('SUBS_LOG_ARCH')
//                                ->where("PORT_STATE='UP'")
//                                ->order('ID asc')
//                                //->text;
//                                ->queryAll();
//                        echo CJSON::encode($row);
            
//                        $row = Yii::app()->db->createCommand()
//                                ->select('ID,IP_ADDR,NE_TYPE,UPDATE_DATE,PORT_TYPE,SUBS_NUM')
//                                ->from('SUBS_LOG_ARCH')
//                                ->where("UPDATE_DATE=(SELECT MAX(UPDATE_DATE) AS maxdate FROM SUBS_LOG_ARCH) AND PORT_STATE='UP'")
//                                ->order('ID asc')
//                                //->text;
//                                ->queryAll();
//                        echo CJSON::encode($row);
            
            
            
            //    มีจำนวน
//                        $row = Yii::app()->db->createCommand()
//                                ->select('tb2.id,tb3.numService,tb2.node_name,TIMESTAMPDIFF(SECOND,tb2.start_date,tb2.end_date) AS diffs,tb2.start_date,tb2.end_date,REPLACE(tb2.service,"_", " ") AS service,tb2.prov_subs,tb2.conn_subs, ROUND(tb2.min_line,3) AS min_line')
//                                ->from('(SELECT MAX(end_date) AS maxdate FROM NE_SUBSSTAT) AS tb1 INNER JOIN NE_SUBSSTAT AS tb2 ON tb1.maxdate= tb2.end_date INNER JOIN (SELECT b.node_name,b.service,COUNT(b.service) AS numService FROM (SELECT MAX(end_date) AS maxdate FROM NE_SUBSSTAT) AS a INNER JOIN NE_SUBSSTAT AS b ON a.maxdate= b.end_date GROUP BY b.service ASC) AS tb3 ON tb2.node_name=tb3.node_name AND tb2.service=tb3.service')
//                               // ->where("$txtDateStart $txtDateEnd $txtService $txtNode ")
//                                ->order('tb2.node_name asc')
//                                //->text;
//                                ->queryAll();
//                        echo CJSON::encode($row);
            
            
            
            
                        $row = Yii::app()->db->createCommand()
                                ->select('tb2.id,tb2.node_name,tb2.node_ip,TIMESTAMPDIFF(second,tb2.start_date,tb2.end_date) as diffs,tb2.start_date,tb2.end_date,REPLACE(tb2.service,"_", " ") as service,tb2.prov_subs,tb2.conn_subs, ROUND(tb2.min_line,3) as min_line')
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
                        }else{
                            $sqlService = "";
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
                                ->select('a.IP_ADDR,a.NE_TYPE,a.UPDATE_DATE,b.NAME,a.SUBS_NUM,HIST_SUBS_NUM')
                                ->from('SUBS_LOG_ARCH a,PORT_TYPE_MAP b')
                                //->where("PORT_STATE='UP' and IP_ADDR='$_POST[txtIP]' and UPDATE_DATE='$_POST[txtDate]'")11.159.181.91
                                ->where("$sqlService $sqlServiceType a.PORT_TYPE=b.ID AND a.PORT_STATE='UP' and a.IP_ADDR='$_POST[txtIP]' and (a.UPDATE_DATE between '$_POST[txtDateStart]' - INTERVAL 6 HOUR and '$_POST[txtDateEnd]' + INTERVAL 6 HOUR)")
                                ->order('a.UPDATE_DATE asc')
                                //->text;
                                ->queryAll();
                        echo CJSON::encode($row);
        }
        
        public function actionShowGraphType()
	{
            
                        $row = Yii::app()->db->createCommand()
                                ->select('a.IP_ADDR,a.NE_TYPE,a.UPDATE_DATE,b.NAME,a.SUBS_NUM,HIST_SUBS_NUM')
                                ->from('SUBS_LOG_ARCH a,PORT_TYPE_MAP b')
                                //->where("PORT_STATE='UP' and IP_ADDR='$_POST[txtIP]' and UPDATE_DATE='$_POST[txtDate]'")11.159.181.91
                                ->where("a.PORT_TYPE=b.ID AND a.ID='$_POST[txtID]' AND a.PORT_STATE='UP' AND (a.UPDATE_DATE between '$_POST[txtDateStart]' - INTERVAL 6 HOUR AND '$_POST[txtDateEnd]' + INTERVAL 6 HOUR)")
                                ->order('a.UPDATE_DATE asc')
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