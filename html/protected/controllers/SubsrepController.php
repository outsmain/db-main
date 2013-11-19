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
			->where("b.id='$_POST[id]' and a.name=b.node_name")
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
                    
		if(!empty($_POST['note_name'])){
			foreach($_POST['note_name'] as $item){
				$node = explode('xx#xx',$item);
				foreach($node as $val){
					$long = ip2long(trim($val));
					if ($long == -1 || $long === FALSE) {
						$strNodeName .= "'".trim($val)."',";
					}else{
						$strNodeIp .= "'".trim($val)."',";
					}
				}
			}
			if(!empty($strNodeName)){
                            $strNodeName = '('.substr($strNodeName,0,-1).')';
                            $strNodeName = 'a.node_name IN '.$strNodeName;
			}
			if(!empty($strNodeIp)){
                            $strNodeIp = '('.substr($strNodeIp,0,-1).')';
                            $strNodeIp = 'a.node_ip IN '.$strNodeIp;
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
                echo CJSON::encode($row);
	}
         
	public function actionShowAll()
	{

                        $row = Yii::app()->db->createCommand()
                                    ->select('tb2.id,tb2.node_name,TIMESTAMPDIFF(second,tb2.start_date,tb2.end_date) as diffs,tb2.start_date,tb2.end_date,REPLACE(tb2.service,"_", " ") as service,tb2.prov_subs,tb2.conn_subs, ROUND(tb2.min_line,3) as min_line')
                                ->from('(SELECT max(end_date) as maxdate FROM NE_SUBSSTAT) AS tb1 INNER JOIN NE_SUBSSTAT AS tb2 ON tb1.maxdate= tb2.end_date')
                               // ->where("$txtDateStart $txtDateEnd $txtService $txtNode ")
                                ->order('tb2.node_name asc')
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


//	public function actionSearchAll()
//	{
//
//                        //$d_start=date("Y-m-d",strtotime("-1 days",strtotime(date('Y-m-d'))))." 23:59:00";
//                        $d_end=date("Y-m-d H:i:00");
//                        $d_start="2013-11-02 00:00:01";
//			$model = Yii::app()->db->createCommand()
//				->select('a.id,a.node_name,TIMESTAMPDIFF(second,a.start_date,a.end_date) as diffs,a.start_date,a.end_date,REPLACE(a.service,"_", " ") as service,a.prov_subs,a.conn_subs, ROUND(a.min_line,3) as min_line')
//				->from('tbl_subsstat a')
//				->where("a.start_date >= '$d_start' and a.end_date <= '$d_end'")
//				->order('a.node_name asc')
//				->queryAll(); 
//                        
//                        echo CJSON::encode($model);
// 
//            
//	}
        
}