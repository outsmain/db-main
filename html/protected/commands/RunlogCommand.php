<?
class RunlogCommand extends CConsoleCommand
{
    public function actionIndex($start, $end) {
		$strSQL = "SELECT * FROM ATTRIB_TYPE";
		$arrType = Yii::app()->db->createCommand($strSQL)->queryAll();
		$tmpArrType = $arrType;
		foreach($arrType as $key=>$type){
			 if($type['BRAND'] == 'ALL' && $type['MODEL'] == 'ALL' && $type['VERSION'] == 'ALL'){
				switch($type['NAME']){
					 case 'GROUP' :
						$IdGroup = $type['ID'];
					 break;
					 case 'IP_ADDRESS' :
						 $IdIP = $type['ID'];
					 break;
					 case 'MAC_ADDRESS' : 
						 $IdMac = $type['ID'];
					 break;
					 case 'NEXT_HOP_IP' : 
						 $IdNEXT_HOP_IP = $type['ID'];
					 break;
					 case 'OTHER' :
						 $IdOther = $type['ID'];
					 break;
				}
				$arrTypeAll[] = $type;
				unset($arrType[$key]);
			 }
		}
		
		$strSQL = "SELECT b.brand, b.model,b.sw_ver,a.* FROM NE_RUN_DATA a, NE_LIST b WHERE a.UPDATE_DATE BETWEEN '".$start."' AND '".$end."' AND b.ip_addr = a.IP_ADDR";
		$row = Yii::app()->db->createCommand($strSQL)->queryAll();
		foreach($row as $item){
			$arrAttList = array();
			$arrRSType = array();
			$arrNO = array();
			foreach($arrType as $type){
				if($type['BRAND'] == $item['brand'] && $type['MODEL'] == $item['model'] && $type['VERSION'] == $item['sw_ver']){
					$arrNO[] = 1;
					$arrRSType[] = $type;
				}else if($type['BRAND'] == $item['brand'] && $type['MODEL'] == $item['model'] && $type['VERSION'] == 'ALL'){
					$arrNO[] = 2;
					$arrRSType[] = $type;
				}else if($type['BRAND'] == $item['brand'] && $type['MODEL'] == 'ALL' && $type['VERSION'] == 'ALL'){
					$arrNO[] = 3;
					$arrRSType[] = $type;
				}else if($type['BRAND'] == 'ALL' && $type['MODEL'] == $item['model'] && $type['VERSION'] == $item['sw_ver']){
					$arrNO[] = 4;
					$arrRSType[] = $type;
				}else if($type['BRAND'] == 'ALL' && $type['MODEL'] == 'ALL' && $type['VERSION'] == $item['sw_ver']){
					$arrNO[] = 5;
					$arrRSType[] = $type;
				}
			}

			if(isset($arrRSType[0])){
				if(isset($arrRSType[1])){
					asort($arrNO);
					$aN = array_keys($arrNO);
					$IdOther = $arrRSType[$aN[0]]['ID'];
				}else{
					$IdOther = $arrRSType[0]['ID'];
				}
			}
			if(!isset($arrAttList[0])){
				$sql = "SELECT * FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID IN ('".$IdGroup."','".$IdIP."','".$IdMac."','".$IdOther."','".$IdNEXT_HOP_IP."')";
				$rsSearch = Yii::app()->db->createCommand($sql)->queryAll();
				foreach($rsSearch as $val){
					$arrAttList[] = $val['NAME'];
				}
			}
			$arr = array();
			$arr = self::splitLogParser($item["DATA"]);
			if(isset($arrAttList[0])){
				if(!in_array($arr['head'][0], $arrAttList)){
					$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
					$query = Yii::app()->db->createCommand($strSQL)->query();
					array_push($arrAttList, $arr['head'][0]);
				}
			}else{
				if(isset($arr['head'][0])){
					$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
					$query = Yii::app()->db->createCommand($strSQL)->query();
					array_push($arrAttList, $arr['head'][0]);
				}
			}

			$Parrent_Group = array();
			$Parrent_Group[] = $arr['head'][0];
			foreach($arr['title'] as $key=>$val){
				if(count($val) > 0){
					foreach($val as $key2=>$val2){
						if(isset($arrAttList[0])){
							if(!in_array($key2,$arrAttList)){
								$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$key2."')";
								$query = Yii::app()->db->createCommand($strSQL)->query();
								array_push($arrAttList, $key2);
							}				
						}else{
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$key2."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $key2);
						}
						$Parrent_Group[] = $key2;
						if(count($val2) > 0){
							foreach($val2 as $key3=>$val3){
								if(count($val3) > 0){
									foreach($val3 as $key4=>$val4){
										switch($val4['key']){
											 case 'IP Addr/mask' :
											 case 'Gi-Addr' :
												 $id = $IdIP;
											 break;
											 case 'MAC Address' : 
												 $id = $IdMac;
											 break;
											 default : $id = $IdOther;	 
										}
										if(!in_array($val4['key'],$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$val4['key']."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $val4['key']);
										}
										
									}
								}
							}
						}
					}
				}
			}
			$i = 0;
			$chkDup = Yii::app()->db->createCommand("SELECT * FROM NE_RUN_ATTRIB WHERE UPDATE_DATE = '".$item['UPDATE_DATE']."' AND IP_ADDR = '".$item['IP_ADDR']."'")->queryAll();
			$arrchkDup = array();
			foreach($chkDup as $val){
				$arrchkDup[] = $val['UPDATE_DATE'].'-'.$val['IP_ADDR'].'-'.$val['ENTRY_ID'].'-'.$val['PARENT_GROUP_ID'].'-'.$val['GROUP_ID'].'-'.$val['ATTRIB_KEY_ID'].'-'.$val['ATTRIB_VALUE'];
			}
			foreach($arr['title'] as $key=>$val){
				$Entry_id = $key+1;
				if(count($val) > 0){
					foreach($val as $key2=>$val2){
						$ParrentID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE NAME = '".$Parrent_Group[$i]."' LIMIT 1")->queryAll();
						$GroupID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE NAME = '".$key2."' LIMIT 1")->queryAll();
						$i++;
						if(count($val2) > 0){
							foreach($val2 as $key3=>$val3){
								if(count($val3) > 0){
									foreach($val3 as $key4=>$val4){
										$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE NAME = '".$val4['key']."' LIMIT 1")->queryAll();
										$strChk = $item['UPDATE_DATE'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParrentID[0]['ID'].'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val4['value'];
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,IP_ADDR,ENTRY_ID,PARENT_GROUP_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['IP_ADDR']."','".$Entry_id."','".$ParrentID[0]['ID']."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".$val4['value']."')";
											Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrchkDup, $strChk);
										}
									}
								}
							}
						}
						
					}
				}
			}
		}
	}

	public function splitLogParser($data)
	{
		$a = preg_split("/[\n,]+/",$data);
		$b = $a;
		foreach($a as $k=>$val){
			if(strpos($a[$k],"===============================================================================") > -1){
				if(strpos($a[$k+2],"===============================================================================") > -1){
					$arr['head'][] = trim($b[$k+1]);
					unset($b[$k]);
					unset($b[$k+1]);
					unset($b[$k+2]);
					break;
				}
			}
		}

		$i = 0;
		$firstChk = null;
		foreach($b as $k=>$val){
			if(!preg_match("/[[:alnum:]]/",$val)){
				if(strpos($val,"-------------------------------------------------------------------------------") > -1){
					if(strpos($b[$k+2],"-------------------------------------------------------------------------------") > -1){
						$b[$k] = "xx@#xx";
						unset($b[$k+2]);
						$i++;
					}	
				}else{
					if(preg_match("/\:[[:space:]]/",$b[$k+1])){
						unset($b[$k]);
					}else{
						$b[$k] = "xx@#xx";
					}
				}
				
				if($i > 1 || ($b[$k] == "xx@#xx" && $b[$k-1] == "xx@#xx")){
					if($firstChk != null && $firstChk == $b[$k+1]){
						unset($b[$k]);
					}else{
						unset($b[$k]);
						unset($b[$k-1]);
					}
				}
			}else if($val[0] === "*"){
				$i = 0;
				unset($b[$k]);
			}else{
				if($firstChk == null){ $firstChk = $val;}
				$i = 0;
			}
		}
		$i = 0;
		foreach($b as $k=>$val){
			$c[$i] = trim($val);
			$i++;
		}

		$i = $k = 0;
		$titleChkFirst = null;
		$chkelse = true;
		if($c[count($c)-1] == "xx@#xx") unset($c[count($c)-1]);
		$lenc = count($c);
		while($k < $lenc){
			if($c[$k] == "xx@#xx"){
				if($titleChkFirst == null){
					$titleChkFirst = $c[$k+1];
				}else{
					if($titleChkFirst == $c[$k+1]) $i++;
				}
				$titleChk = $c[$k+1];
				$arr['title'][$i][$titleChk] = array();
				$k = $k+2;
				continue;
			}
			if($titleChkFirst == null){
				$k++;
				continue;
			}
			$arr['title'][$i][$titleChk][] = self::splitColon($c[$k]);
			$k++;
		}
		return $arr;
	}

	public function splitColon($str)
	{
		$z = 0;
		$cnt = (count(explode(':'.chr(32),$str)) - 1);
		if($cnt > 0){
			$arr = array();
			while($z < $cnt){
				$g = strpos($str,":".chr(32));
				$j = substr($str,$g+1,strlen($str));
				$k = strlen($j);
				$i = $l = 0;
				while($i < $k){
					if(($l > 1) && ($j[$i] != chr(32)) && ($j[$i] != chr(10))){
						$p = $i;
						break;
					}
					if($j[$i] == chr(32)){
						$l++;
					}else if($j[$i] == chr(10)){
						$l = $l+2;
					}else{
						$l = 0;
					}
					$i++;
				}

				$cut = substr($str,0,$p+$g);
				$remaining = substr($str,strlen($cut),strlen($str));
				if(!strpos($remaining,":".chr(32))){
					$cut .= $remaining;
				}

				$str = substr($str,strlen($cut),strlen($str));
				$tcol = explode(':'.chr(32), $cut);
				$arr[$z]['key'] = trim($tcol[0]);
				$arr[$z]['value'] = trim($tcol[1]);
				$z++;
			}
		}else{
			$arr[0]['key'] = "";
			$arr[0]['value'] = $str;
		}
		return $arr;
	}
}
?>