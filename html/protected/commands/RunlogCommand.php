<?php
class RunlogCommand extends CConsoleCommand
{
    public function actionIndex($start, $end){
		$strchk = '';
		if(empty($start)){
			$strchk .= "Please input start date.\n";
		}else{
			if(!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $start)) {
				$strchk .= "Please input start date format YYYY-MM-DD H:i:s\n";
			}
		}
		if(empty($end)){
			$strchk .= "Please input end date.\n";
		}else{
			if(!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $end)) {
				$strchk .= "Please input end date format YYYY-MM-DD H:i:s\n";
			}
		}
		if(!empty($strchk)){
			echo $strchk;
			exit;
		}
		$strSQL = "SELECT * FROM ATTRIB_TYPE WHERE NAME IN('GROUP','OTHER')";
		$arrT = Yii::app()->db->createCommand($strSQL)->queryAll();
		foreach($arrT as $key=>$type){
			 if($type['NAME'] == 'OTHER'){
				if($type['BRAND'] === 'ALL' && $type['MODEL'] === 'ALL' && $type['VERSION'] === 'ALL') $IdOther = $type['ID'];
				$arrType['OTHER'][] = $type;
			 }else if($type['NAME'] == 'GROUP'){
				if($type['BRAND'] === 'ALL' && $type['MODEL'] === 'ALL' && $type['VERSION'] === 'ALL') $IdGroup = $type['ID'];
				$arrType['GROUP'][] = $type;
			 }
		}

		$strSQLM = "SELECT b.brand,b.model,b.sw_ver,a.* FROM NE_RUN_DATA a JOIN NE_LIST b ON a.UPDATE_DATE BETWEEN '".$start."' AND '".$end."' AND b.ip_addr = a.IP_ADDR JOIN NE_RUN_TYPE c ON a.NE_RUN_TYPE_ID = c.ID";
		$row = Yii::app()->db->createCommand($strSQLM)->queryAll();
		foreach($row as $item){
			$arrAttList = array();
			$arrAttListId = array();
			$arrRSType = array();
			$arrNO = array();
			if(count($arrType) > 0){
				foreach($arrType as $key=>$val){
					foreach($val as $key2=>$type){
						if($type['BRAND'] == $item['brand'] && $type['MODEL'] == $item['model'] && $type['VERSION'] == $item['sw_ver']){
							$arrNO[$key][] = 1;
							$arrRSType[$key][] = $type;
						}else if($type['BRAND'] == $item['brand'] && $type['MODEL'] == $item['model'] && $type['VERSION'] == 'ALL'){
							$arrNO[$key][] = 2;
							$arrRSType[$key][] = $type;
						}else if($type['BRAND'] == $item['brand'] && $type['MODEL'] == 'ALL' && $type['VERSION'] == 'ALL'){
							$arrNO[$key][] = 3;
							$arrRSType[$key][] = $type;
						}else if($type['BRAND'] == 'ALL' && $type['MODEL'] == $item['model'] && $type['VERSION'] == $item['sw_ver']){
							$arrNO[$key][] = 4;
							$arrRSType[$key][] = $type;
						}else if($type['BRAND'] == 'ALL' && $type['MODEL'] == 'ALL' && $type['VERSION'] == $item['sw_ver']){
							$arrNO[$key][] = 5;
							$arrRSType[$key][] = $type;
						}					
					}
				}
			}

			if(count($arrRSType) > 0){
				foreach($arrRSType as $key=>$val){
					if($key === 'OTHER'){
						if(isset($val[1])){
							asort($arrNO[$key]);
							$aN = array_keys($arrNO[$key]);
							$IdOther = $arrRSType[$key][$aN[0]]['ID'];
						}else{
							$IdOther = $arrRSType[$key][0]['ID'];
						}
					}else if($key === 'GROUP'){
						if(isset($val[1])){
							asort($arrNO[$key]);
							$aN = array_keys($arrNO[$key]);
							$IdGroup = $arrRSType[$key][$aN[0]]['ID'];
						}else{
							$IdGroup = $arrRSType[$key][0]['ID'];
						}
					}
				}
			}

			$id = $IdOther;
			if(!isset($arrAttList[0])){
				$sql = "SELECT * FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID IN ('".$IdGroup."','".$IdOther."')";
				$rsSearch = Yii::app()->db->createCommand($sql)->queryAll();
				foreach($rsSearch as $val){
					$arrAttList[] = $val['NAME'].'-'.$val['ATTRIB_TYPE_ID'];
				}
			}
			
			$chkDup = Yii::app()->db->createCommand("SELECT * FROM NE_RUN_ATTRIB WHERE UPDATE_DATE = '".$item['UPDATE_DATE']."' AND IP_ADDR = '".$item['IP_ADDR']."'")->queryAll();
			$arrchkDup = array();
			if(isset($chkDup[0])){
				foreach($chkDup as $val){
					$arrchkDup[] = $val['UPDATE_DATE'].'-'.$val['NE_RUN_TYPE_ID'].'-'.$val['NE_RUN_DATA_ID'].'-'.$val['IP_ADDR'].'-'.$val['ENTRY_ID'].'-'.$val['PARENT_GROUP_ID'].'-'.$val['GROUP_ID'].'-'.$val['ATTRIB_KEY_ID'].'-'.$val['ATTRIB_VALUE'];
				}
			}
	
			switch($item['NE_RUN_TYPE_ID']){
				case 1 :
					$arr = array();
					$arr = self::splitLogParser($item["DATA"]);
					if(isset($arrAttList[0])){
						if(!in_array($arr['head'][0].'-'.$IdGroup, $arrAttList)){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}

					$Parent_Group = array();
					$Parent_Group_Id = array();
					$Parent_Group[] = $arr['head'][0];
					$Parent_Group_Id[] = $IdGroup;
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(isset($arrAttList[0])){
									if(!in_array($key2.'-'.$IdGroup,$arrAttList)){
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$IdGroup);
									}				
								}else{
									$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($key2)."')";
									$query = Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrAttList, $key2.'-'.$IdGroup);
								}
								$Parent_Group[] = $key2;
								$Parent_Group_Id[] = $IdGroup;
								if(count($val2) > 0){
									foreach($val2 as $key3=>$val3){
										if(count($val3) > 0){
											foreach($val3 as $key4=>$val4){
												if(!in_array($val4['key'].'-'.$id,$arrAttList)){
													$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($val4['key'])."')";
													$query = Yii::app()->db->createCommand($strSQL)->query();
													array_push($arrAttList, $val4['key'].'-'.$id);
												}
												
											}
										}
									}
								}
							}
						}
					}
					
					$i = 0;
					foreach($arr['title'] as $key=>$val){
						$Entry_id = $key+1;
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								$ParentID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$Parent_Group_Id[$i]."' AND NAME = '".mysql_escape_string($Parent_Group[$i])."'")->queryAll();
								$GroupID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$Parent_Group_Id[$i+1]."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
								$i++;
								if(count($val2) > 0){
									foreach($val2 as $key3=>$val3){
										if(count($val3) > 0){
											foreach($val3 as $key4=>$val4){
												$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE NAME = '".mysql_escape_string($val4['key'])."' LIMIT 1")->queryAll();
												$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID[0]['ID'].'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val4['value'];
												if(!in_array($strChk, $arrchkDup)){
													$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,PARENT_GROUP_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$ParentID[0]['ID']."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val4['value'])."')";
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
				break;
				case 2 :
					$arr = array();
					$arr = self::splitRouterArp($item["DATA"]);
					if(isset($arrAttList[0])){
						if(!in_array($arr['head'][0].'-'.$IdGroup, $arrAttList)){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}
					
					$GroupID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".mysql_escape_string($arr['head'][0])."'")->queryAll();
					
					$ParentID = '';
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(is_array($val2) > 0){
									foreach($val2 as $key3=>$val3){
										$Entry_id = null;
										if(isset($arrAttList[0])){
											if(!in_array($key3.'-'.$id,$arrAttList)){
												$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
												$query = Yii::app()->db->createCommand($strSQL)->query();
												array_push($arrAttList, $key3.'-'.$id);
											}				
										}else{
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key3.'-'.$id);
										}
										$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key3)."'")->queryAll();
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val3;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val3)."')";
											Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrchkDup, $strChk);
										}
									}
								}else{
									$Entry_id = $key+1;
									if(isset($arrAttList[0])){
										if(!in_array($key2.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key2.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$id);
									}
									$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
									$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val2;
									if(!in_array($strChk, $arrchkDup)){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
										Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrchkDup, $strChk);
									}
								}
							}
						}
					}
				break;
				case 3 :
					$arr = array();
					$arr = self::splitFdbMac($item["DATA"]);
					if(isset($arrAttList[0])){
						if(!in_array($arr['head'][0].'-'.$IdGroup, $arrAttList)){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}
					
					$GroupID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".mysql_escape_string($arr['head'][0])."'")->queryAll();
					
					$ParentID = '';
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(is_array($val2) > 0){
									foreach($val2 as $key3=>$val3){
										$Entry_id = null;
										if(isset($arrAttList[0])){
											if(!in_array($key3.'-'.$id,$arrAttList)){
												$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
												$query = Yii::app()->db->createCommand($strSQL)->query();
												array_push($arrAttList, $key3.'-'.$id);
											}				
										}else{
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key3.'-'.$id);
										}
										$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key3)."'")->queryAll();
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val3;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val3)."')";
											Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrchkDup, $strChk);
										}
									}
								}else{
									$Entry_id = $key+1;
									if(isset($arrAttList[0])){
										if(!in_array($key2.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key2.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$id);
									}
									$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
									$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val2;
									if(!in_array($strChk, $arrchkDup)){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
										Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrchkDup, $strChk);
									}
								}
							}
						}
					}
				break;
				case 4 :
					$arr = array();
					$arr = self::splitSdpUsing($item['DATA']);
					if(isset($arrAttList[0])){
						if(!in_array($arr['head'][0].'-'.$IdGroup, $arrAttList)){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}
					
					$GroupID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".mysql_escape_string($arr['head'][0])."'")->queryAll();
					
					$ParentID = '';
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(is_array($val2) > 0){
									foreach($val2 as $key3=>$val3){
										$Entry_id = null;
										if(isset($arrAttList[0])){
											if(!in_array($key3.'-'.$id,$arrAttList)){
												$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
												$query = Yii::app()->db->createCommand($strSQL)->query();
												array_push($arrAttList, $key3.'-'.$id);
											}				
										}else{
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key3.'-'.$id);
										}
										$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key3)."'")->queryAll();
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val3;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val3)."')";
											Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrchkDup, $strChk);
										}
									}
								}else{
									$Entry_id = $key+1;
									if(isset($arrAttList[0])){
										if(!in_array($key2.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key2.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$id);
									}
									$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
									$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val2;
									if(!in_array($strChk, $arrchkDup)){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
										Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrchkDup, $strChk);
									}
								}
							}
						}
					}
				break;
				case 5 :
					$arr = array();
					$arr = self::splitSapUsing($item['DATA']);
					if(isset($arrAttList[0])){
						if(!in_array($arr['head'][0].'-'.$IdGroup, $arrAttList)){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}
					
					$GroupID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".mysql_escape_string($arr['head'][0])."'")->queryAll();
					$ParentID = '';
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(is_array($val2) > 0){
									foreach($val2 as $key3=>$val3){
										$Entry_id = null;
										if(isset($arrAttList[0])){
											if(!in_array($key3.'-'.$id,$arrAttList)){
												$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
												$query = Yii::app()->db->createCommand($strSQL)->query();
												array_push($arrAttList, $key3.'-'.$id);
											}				
										}else{
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key3.'-'.$id);
										}
										$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key3)."'")->queryAll();
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val3;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val3)."')";
											Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrchkDup, $strChk);
										}
									}
								}else{
									$Entry_id = $key+1;
									if(isset($arrAttList[0])){
										if(!in_array($key2.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key2.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$id);
									}
									$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
									$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val2;
									if(!in_array($strChk, $arrchkDup)){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
										Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrchkDup, $strChk);
									}
								}
							}
						}
					}
				break;
				case 6 :
					$arr = array();
					$arr = self::splitServiceUsing($item['DATA']);
					if(isset($arrAttList[0])){
						if(!in_array($arr['head'][0].'-'.$IdGroup, $arrAttList)){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}
					
					$GroupID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".mysql_escape_string($arr['head'][0])."'")->queryAll();
					
					$ParentID = '';
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(is_array($val2) > 0){
									foreach($val2 as $key3=>$val3){
										$Entry_id = null;
										if(isset($arrAttList[0])){
											if(!in_array($key3.'-'.$id,$arrAttList)){
												$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
												$query = Yii::app()->db->createCommand($strSQL)->query();
												array_push($arrAttList, $key3.'-'.$id);
											}				
										}else{
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key3.'-'.$id);
										}
										$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key3)."'")->queryAll();
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val3;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val3)."')";
											Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrchkDup, $strChk);
										}
									}
								}else{
									$Entry_id = $key+1;
									if(isset($arrAttList[0])){
										if(!in_array($key2.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key2.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$id);
									}
									$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
									$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val2;
									if(!in_array($strChk, $arrchkDup)){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
										Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrchkDup, $strChk);
									}
								}
							}
						}
					}
				break;
				case 7 :
					$arr = array();
					$arr = self::splitServiceCustomer($item['DATA']);
					if(isset($arrAttList[0])){
						if(!in_array($arr['head'][0].'-'.$IdGroup, $arrAttList)){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}
					
					$GroupID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".mysql_escape_string($arr['head'][0])."'")->queryAll();
					$ParentID = '';
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(is_array($val2) > 0){
									foreach($val2 as $key3=>$val3){
										$Entry_id = null;
										if(isset($arrAttList[0])){
											if(!in_array($key3.'-'.$id,$arrAttList)){
												$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
												$query = Yii::app()->db->createCommand($strSQL)->query();
												array_push($arrAttList, $key3.'-'.$id);
											}				
										}else{
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key3.'-'.$id);
										}
										$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key3)."'")->queryAll();
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val3;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val3)."')";
											Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrchkDup, $strChk);
										}
									}
								}else{
									$Entry_id = $key+1;
									if(isset($arrAttList[0])){
										if(!in_array($key2.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key2.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$id);
									}
									$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
									$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val2;
									if(!in_array($strChk, $arrchkDup)){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
										Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrchkDup, $strChk);
									}
								}
							}
						}
					}
				break;
				case 8 :
					$arr = array();
					$arr = self::splitLagDescription($item['DATA']);
					if(isset($arrAttList[0])){
						if(!in_array($arr['head'][0].'-'.$IdGroup, $arrAttList)){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}

					$GroupID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".mysql_escape_string($arr['head'][0])."'")->queryAll();
					$ParentID = '';
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key5=>$val5){
								if(count($val5) > 0){
									foreach($val5 as $key2=>$val2){
										$Entry_id = $key+1;
										if(isset($arrAttList[0])){
											if(!in_array($key2.'-'.$id,$arrAttList)){
												$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
												$query = Yii::app()->db->createCommand($strSQL)->query();
												array_push($arrAttList, $key2.'-'.$id);
											}				
										}else{
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key2.'-'.$id);
										}
										$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val2;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
											Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrchkDup, $strChk);
										}
									}
								}
							}
						}
					}
				break;
				case 14 :
					$arr = array();
					$arr = self::splitDisplayMac($item['DATA']);
					$ParentID = '';
					$GroupID = '';	
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(strpos($key2,'Total matching items displayed') > -1){
									$Entry_id = null;
								}else{
									$Entry_id = $key+1;
								}
								if(isset($arrAttList[0])){
									if(!in_array($key2.'-'.$id,$arrAttList)){
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$id);
									}				
								}else{
									$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
									$query = Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrAttList, $key2.'-'.$id);
								}
								$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
								$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID.'-'.$KeyID[0]['ID'].'-'.$val2;

								if(!in_array($strChk, $arrchkDup)){
									if($Entry_id == null){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
									}else{
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
									}
									Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrchkDup, $strChk);
								}
							}
						}
					}
				break;
				case 15 :
					$arr = array();
					$arr = self::splitDisplayArp($item['DATA']);
					$ParentID = '';
					$GroupID = '';	
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(count($arr['title']) == ($key+1)){
									$Entry_id = null;
								}else{
									$Entry_id = $key+1;
								}
								if(isset($arrAttList[0])){
									if(!in_array($key2.'-'.$id,$arrAttList)){
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$id);
									}				
								}else{
									$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
									$query = Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrAttList, $key2.'-'.$id);
								}
								$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
								$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID.'-'.$KeyID[0]['ID'].'-'.$val2;
								if(!in_array($strChk, $arrchkDup)){
									if($Entry_id == null){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
									}else{
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
									}
									Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrchkDup, $strChk);
								}
							}
						}
					}
				break;
				case 16 :
					$arr = array();
					$arr = self::splitDisplayInterface($item['DATA']);
					$Parent_Group_Id = array();
					$i = 0;
					$chkParent = false;
					$ParentID = '';
					foreach($arr['title'] as $key=>$val){
						$Entry_id = $key+1;
						foreach($val as $key2=>$val2){
							$cnt = self::count_dimension($val2, 0);
							if($cnt > 1){
								if(isset($arrAttList[0])){
									if(!in_array($key2.'-'.$IdGroup,$arrAttList)){
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$IdGroup);
									}				
								}else{
									$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($key2)."')";
									$query = Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrAttList, $key2.'-'.$IdGroup);
								}
								$GroupID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
								$Parent_Group_Id[] = $GroupID[0]['ID'];
								
								if($chkParent){
									$ParentID = $Parent_Group_Id[$i];
									$i++;
								}
								$chkParent = true;
								foreach($val2 as $key3=>$val3){
									if(isset($arrAttList[0])){
										if(!in_array($key3.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key3.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key3.'-'.$id);
									}
									$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key3)."'")->queryAll();
									
									foreach($val3 as $key4=>$val4){
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val4;
										if(!in_array($strChk, $arrchkDup)){
											if($ParentID != ''){
												$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,PARENT_GROUP_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$ParentID."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val4)."')";
											}else{
												$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val4)."')";
											}
											Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrchkDup, $strChk);
										}
									}
								}
							}else{
								$ParentID = '';
								$GroupID = '';
								if(isset($arrAttList[0])){
									if(!in_array($key2.'-'.$id,$arrAttList)){
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$id);
									}				
								}else{
									$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
									$query = Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrAttList, $key2.'-'.$id);
								}
								
								$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
								
								foreach($val2 as $key3=>$val3){
									if($val3 != ''){
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID.'-'.$KeyID[0]['ID'].'-'.$val3;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$KeyID[0]['ID']."','".mysql_escape_string($val3)."')";
											Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrchkDup, $strChk);
										}
									}
								}
								
							}
						}
					}
				break;
				case 17 :
					$arr = array();
					$arr = self::splitDisplayEthTrunk($item['DATA']);
					if(isset($arrAttList[0])){
						if(!in_array($arr['head'][0].'-'.$IdGroup, $arrAttList)){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($arr['head'][0])."')";
							$query = Yii::app()->db->createCommand($strSQL)->query();
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}

					$GroupID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".mysql_escape_string($arr['head'][0])."'")->queryAll();

					$Parent_Group_Id = array();
					$Parent_Group_Id[] = $GroupID[0]['ID'];
					$i = 0;
					foreach($arr['title'] as $key=>$val){
						$Entry_id = $key+1;
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(isset($arrAttList[0])){
									if(!in_array($key2.'-'.$IdGroup,$arrAttList)){
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$IdGroup);
									}				
								}else{
									$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($key2)."')";
									$query = Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrAttList, $key2.'-'.$IdGroup);
								}

								$GroupID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
								$Parent_Group_Id[] = $GroupID[0]['ID'];
							
								$ParentID = $Parent_Group_Id[$i];
								$i++;

								if(count($val2) > 0){
									foreach($val2 as $key3=>$val3){
										if(isset($arrAttList[0])){
											if(!in_array($key3.'-'.$id,$arrAttList)){
												$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
												$query = Yii::app()->db->createCommand($strSQL)->query();
												array_push($arrAttList, $key3.'-'.$id);
											}				
										}else{
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key3.'-'.$id);
										}

										$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key3)."'")->queryAll();
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val3;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,PARENT_GROUP_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$ParentID."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val3)."')";
											Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrchkDup, $strChk);
										}
									}
								}
							}
						}
					}
				break;
				case 18 :
					$arr = array();
					$arr = self::splitDisplayMacAddress($item['DATA']);
					$ParentID = '';
					$GroupID = '';
					foreach($arr['title'] as $key=>$val){
						$Entry_id = $key+1;
						if(is_array($val)){
							foreach($val as $key2=>$val2){
								if(isset($arrAttList[0])){
									if(!in_array($key2.'-'.$id,$arrAttList)){
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$id);
									}				
								}else{
									$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
									$query = Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrAttList, $key2.'-'.$id);
								}
								$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
								$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID.'-'.$KeyID[0]['ID'].'-'.$val2;
								if(!in_array($strChk, $arrchkDup)){
									$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
									Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrchkDup, $strChk);
								}
							}
						}else{
							if(isset($arrAttList[0])){
								if(!in_array($key.'-'.$id,$arrAttList)){
									$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key)."')";
									$query = Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrAttList, $key.'-'.$id);
								}				
							}else{
								$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key)."')";
								$query = Yii::app()->db->createCommand($strSQL)->query();
								array_push($arrAttList, $key.'-'.$id);
							}
							$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key)."'")->queryAll();
							$Entry_id = '';
							$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID.'-'.$KeyID[0]['ID'].'-'.$val;
							if(!in_array($strChk, $arrchkDup)){
								$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$KeyID[0]['ID']."','".mysql_escape_string($val)."')";
								Yii::app()->db->createCommand($strSQL)->query();
								array_push($arrchkDup, $strChk);
							}
						}
					}
				break;
				case 19 :
					$arr = array();
					$arr = self::splitDisplayArpAll($item['DATA']);
					$ParentID = '';
					$GroupID = '';	
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(count($arr['title']) == ($key+1)){
									$Entry_id = null;
								}else{
									$Entry_id = $key+1;
								}
								if(isset($arrAttList[0])){
									if(!in_array($key2.'-'.$id,$arrAttList)){
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$id);
									}				
								}else{
									$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
									$query = Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrAttList, $key2.'-'.$id);
								}
								$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
								$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID.'-'.$KeyID[0]['ID'].'-'.$val2;
								if(!in_array($strChk, $arrchkDup)){
									if($Entry_id == null){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
									}else{
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
									}
									Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrchkDup, $strChk);
								}
							}
						}
					}
				break;
				case 20 :
					$arr = array();
					$arr = self::splitDisplayInterface_2($item['DATA']);
					$Parent_Group_Id = array();
					$i = 0;
					$chkParent = false;
					$ParentID = '';
					foreach($arr['title'] as $key=>$val){
						$Entry_id = $key+1;
						foreach($val as $key2=>$val2){
							$cnt = self::count_dimension($val2, 0);
							if($cnt > 1){
								if(isset($arrAttList[0])){
									if(!in_array($key2.'-'.$IdGroup,$arrAttList)){
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$IdGroup);
									}				
								}else{
									$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($key2)."')";
									$query = Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrAttList, $key2.'-'.$IdGroup);
								}
								$GroupID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
								$Parent_Group_Id[] = $GroupID[0]['ID'];
								
								if($chkParent){
									$ParentID = $Parent_Group_Id[$i];
									$i++;
								}
								$chkParent = true;
								foreach($val2 as $key3=>$val3){
									if(isset($arrAttList[0])){
										if(!in_array($key3.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key3.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key3)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key3.'-'.$id);
									}
									$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key3)."'")->queryAll();
									
									foreach($val3 as $key4=>$val4){
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val4;
										if(!in_array($strChk, $arrchkDup)){
											if($ParentID != ''){
												$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,PARENT_GROUP_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$ParentID."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val4)."')";
											}else{
												$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".mysql_escape_string($val4)."')";
											}
											Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrchkDup, $strChk);
										}
									}
								}
							}else{
								$ParentID = '';
								$GroupID = '';
								if(isset($arrAttList[0])){
									if(!in_array($key2.'-'.$id,$arrAttList)){
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$id);
									}				
								}else{
									$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
									$query = Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrAttList, $key2.'-'.$id);
								}
								
								$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
								
								foreach($val2 as $key3=>$val3){
									$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID.'-'.$KeyID[0]['ID'].'-'.$val3;
									if(!in_array($strChk, $arrchkDup)){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$KeyID[0]['ID']."','".mysql_escape_string($val3)."')";
										Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrchkDup, $strChk);
									}	
								}
							}
						}
					}
				break;
				case 21 :
					$arr = array();
					$arr = self::splitDisplayVplsConnection($item['DATA']);
					foreach($arr['title'] as $key=>$val){
						$Entry_id = null;
						$ParentID = '';
						$GroupID = '';
						if(is_string($key)){
							if($key === 'connections'){
								if(isset($arrAttList[0])){
									if(!in_array($key.'-'.$IdGroup,$arrAttList)){
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($key)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key.'-'.$IdGroup);
									}				
								}else{
									$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".mysql_escape_string($key)."')";
									$query = Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrAttList, $key.'-'.$IdGroup);
								}
								foreach($val as $key2=>$val2){
									if(isset($arrAttList[0])){
										if(!in_array($key2.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key2.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$id);
									}
									$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
									foreach($val2 as $key3=>$val3){
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID.'-'.$KeyID[0]['ID'].'-'.$val3;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$KeyID[0]['ID']."','".mysql_escape_string($val3)."')";
											Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrchkDup, $strChk);
										}
									}
								}
							}else{
								if(isset($arrAttList[0])){
									if(!in_array($key.'-'.$id,$arrAttList)){
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key.'-'.$id);
									}				
								}else{
									$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key)."')";
									$query = Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrAttList, $key.'-'.$id);
								}
								$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key)."'")->queryAll();
								foreach($val as $key2=>$val2){
									$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID.'-'.$KeyID[0]['ID'].'-'.$val2;
									if(!in_array($strChk, $arrchkDup)){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
										Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrchkDup, $strChk);
									}
								}
							}
						}else{
							$Entry_id = $key+1;
							if(count($val) > 0){
								foreach($val as $key2=>$val2){
									if(isset($arrAttList[0])){
										if(!in_array($key2.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key2.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$id);
									}
									$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
									if(count($val2) > 0){
										foreach($val2 as $key3=>$val3){
											$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID.'-'.$KeyID[0]['ID'].'-'.$val3;
											if(!in_array($strChk, $arrchkDup)){
												$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$KeyID[0]['ID']."','".mysql_escape_string($val3)."')";
												Yii::app()->db->createCommand($strSQL)->query();
												array_push($arrchkDup, $strChk);
											}
										}
									}
								}
							}
						}
					}
				break;
				case 22 :
					$arr = array();
					$arr = self::splitDisplayVplsForwarding_info($item['DATA']);
					foreach($arr['title'] as $key=>$val){
						$Entry_id = '';
						$ParentID = '';
						$GroupID = '';
						if(is_string($key)){
							if(isset($arrAttList[0])){
								if(!in_array($key.'-'.$id,$arrAttList)){
									$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key)."')";
									$query = Yii::app()->db->createCommand($strSQL)->query();
									array_push($arrAttList, $key.'-'.$id);
								}				
							}else{
								$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key)."')";
								$query = Yii::app()->db->createCommand($strSQL)->query();
								array_push($arrAttList, $key.'-'.$id);
							}
							if(count($val) > 0){
								$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key)."'")->queryAll();
								foreach($val as $key2=>$val2){
									$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID.'-'.$KeyID[0]['ID'].'-'.$val2;
									if(!in_array($strChk, $arrchkDup)){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$KeyID[0]['ID']."','".mysql_escape_string($val2)."')";
										Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrchkDup, $strChk);
									}	
								}
							}
						}else{
							$Entry_id = $key+1;
							if(count($val) > 0){
								foreach($val as $key2=>$val2){
									if(isset($arrAttList[0])){
										if(!in_array($key2.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
											$query = Yii::app()->db->createCommand($strSQL)->query();
											array_push($arrAttList, $key2.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".mysql_escape_string($key2)."')";
										$query = Yii::app()->db->createCommand($strSQL)->query();
										array_push($arrAttList, $key2.'-'.$id);
									}
									$KeyID = Yii::app()->db->createCommand("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".mysql_escape_string($key2)."'")->queryAll();
									if(count($val2) > 0){
										foreach($val2 as $key3=>$val3){
											$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParentID.'-'.$GroupID.'-'.$KeyID[0]['ID'].'-'.$val3;
											if(!in_array($strChk, $arrchkDup)){
												$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$KeyID[0]['ID']."','".mysql_escape_string($val3)."')";
												Yii::app()->db->createCommand($strSQL)->query();
												array_push($arrchkDup, $strChk);
											}	
										}
									}
								}
							}
						}
					}
				break;
			}
		}
	}
	
	private function splitDisplayVplsForwarding_info($data){
		$a = preg_split("/[\n]+/",$data);
		foreach($a as $key=>$val){
			if(substr($val,0,1) == '<'){
				unset($a[$key]);
			}elseif(substr($val,0,strlen('Total Number')) === 'Total Number'){
				$e = explode(',',$val);
				foreach($e as $key2=>$val2){
					$val2 = trim($val2);
					if(strpos($val2,':') > -1){
						$s = explode(':',$val2);
						$arr['title'][trim($s[0])][] = trim($s[1]);
					}else{
						$s = explode(chr(32),$val2);
						$f = array();
						foreach($s as $key3=>$val3){
							if(preg_match("/[[:graph:]]/",$val3)){
								$f[] = trim($val3);
							}
						}
						$arr['title'][trim($f[1])][] = trim($f[0]);
					}
				}
			}elseif(substr($val,0,strlen('Vsi-Name')) === 'Vsi-Name'){
				$e = explode('  ',$val);
				foreach($e as $key2=>$val2){
					if(preg_match("/[[:graph:]]/",$val2)){
						$arrT[] = $val2;
					}
				}
			}elseif(preg_match("/[[:graph:]]/",$val)){
				$b[] = trim($val);
			}
		}
		
		foreach($b as $key=>$val){
			$i = 0;
			$e = explode(chr(32),$val);
			foreach($e as $key2=>$val2){
				if(preg_match("/[[:graph:]]/",$val2)){
					$arr['title'][$key][$arrT[$i]][] = $val2;
					$i++;
				}
			}
		}
		return $arr;
	}

	private function splitDisplayVplsConnection($data){
		$a = preg_split("/[\n]+/",$data);
		foreach($a as $key=>$val){
			$val = trim($val);
			if(substr($val,0,1) == '<'){
				unset($a[$key]);
			}elseif(strpos($val,'total connections') > -1){
				$arr['title']['total connections'][] = trim(substr($val,0,strpos($val,'total connections')));
			}elseif(substr($val,0,strlen('connections')) === 'connections'){
				$str = substr($val,strlen('connections'),strlen($val));
				$e = explode(':',$str);
				foreach($e as $key2=>$val2){
					if(preg_match("/[[:graph:]]/",$val2)){
						$s = explode(',',$val2);
						foreach($s as $key3=>$val3){
							$t = explode(chr(32),trim($val3));
							$arr['title']['connections'][$t[1]][] = $t[0];
						}
					}
				}
			}elseif(preg_match("/[[:graph:]]/",$val)){
				$b[] = $val;
			}
		}
		$i = 0;
		$chkline = false;
		foreach($b as $key=>$val){
			if(substr($val,0,strlen('VSI Name')) === 'VSI Name'){
				$e = explode('  ',$val);
				foreach($e as $key2=>$val2){
					if(preg_match("/[[:graph:]]/",$val2)){
						$s = explode(':',$val2);
						$arr['title'][$i][trim($s[0])][] = trim($s[1]);
					}
				}
				$chkline = true;
				$i++;
			}else{
				if($chkline){
					$arrT = array();
					$e = explode(' ',$val);
					foreach($e as $key2=>$val2){
						if(preg_match("/[[:graph:]]/",$val2)){
							$arrT[] = $val2;
						}
					}
					$chkline = false;
				}else{
					$chk = false;
					$e = explode(chr(32),$val);
					$j = 0;
					foreach($e as $key2=>$val2){
						if(preg_match("/[[:graph:]]/",$val2)){
							$arr['title'][$i-1][$arrT[$j]][] = trim($val2);
							$j++;
						}
					}
				}
			}
		}
		return $arr;
	}

	private function splitDisplayInterface_2($data){
		$a = preg_split("/[\n]+/",$data);
		$chk = false;
		$i = 0;
		foreach($a as $key=>$val){
			if(strpos($val,'<') > -1){
				continue;
			}elseif(strpos($val,'current state') > 1){
				if(!$chk || !preg_match("/[[:graph:]]/",$a[$key-1])){
					$b[$i][] = $val;
					$chk = true;
					$i++;
				}else{
					$b[$i-1][] = $val;
				}
			}else{
				$b[$i-1][] = $val;
			}
		}

		foreach($b as $key=>$val){
			$chkInput = $chkOutput = false;
			foreach($val as $key2=>$val2){
				if(strpos($val2,':') > -1 && strpos($val2,',') < -1){
					if(strpos($val2,'current state') > -1){
						if($key2 == 0){
							$pos = strpos($val2,':');
							$f = substr($val2,0,$pos);
							$s = trim(substr($val2,($pos+1),strlen($val2)));
							$arr['title'][$key]['Port'][] = trim(str_replace('current state','',$f));
							$pos = strpos($s,'(');
							if($pos > -1){
								if(strpos($s,')') > -1){
									$t = substr($s,$pos,strlen($s));
									$u = str_replace($t,'',$s);
									$arr['title'][$key]['current state'][] = trim($u);
									$t = str_replace('(','',$t);
									$t = str_replace(')','',$t);
									$t = explode(':',$t);
									$arr['title'][$key][trim($t[0])][] = trim($t[1]);
								}
							}else{
								$arr['title'][$key]['current state'][] = trim($s);
							}
						}else{
							$e = explode(':',$val2);
							$arr['title'][$key][trim($e[0])][] = trim($e[1]);	
						}
					}else{
						if(substr($val2,0,strlen('Last physical up time')) == 'Last physical up time'){
							$s = str_replace('Last physical up time','',$val2);
							$s = trim(substr($s,(strpos($s,':')+1),strlen($s)));
							$arr['title'][$key]['Last physical up time'][] = $s;
						}elseif(substr($val2,0,strlen('Last physical down time')) == 'Last physical down time'){
							$s = str_replace('Last physical down time','',$val2);
							$s = trim(substr($s,(strpos($s,':')+1),strlen($s)));
							$arr['title'][$key]['Last physical down time'][] = $s;
						}elseif(substr($val2,0,strlen('Current system time')) == 'Current system time'){
							$s = str_replace('Current system time','',$val2);
							$s = trim(substr($s,(strpos($s,':')+1),strlen($s)));
							$arr['title'][$key]['Current system time'][] = $s;
						}elseif(substr(trim($val2),0,strlen('Last line protocol up time')) == 'Last line protocol up time'){
							$s = str_replace('Last line protocol up time','',$val2);
							$pos = strpos($val2,':');
							if($pos > -1){
								$arr['title'][$key]['Last line protocol up time'][] = trim(substr($val2,($pos+1),strlen($val2)));
							}
						}elseif(strpos($val2,'input utility rate') > -1){
							$e = explode(':',$val2);
							$chke = false;
							$tmp = '';
							foreach($e as $key3=>$val3){
								$chke = ($chke) ? false : true;
								if($chke){
									$tmp = trim($val3);
								}else{
									$arr['title'][$key][$tmp][] = trim($val3);
								}
							}
						}elseif(strpos($val2,'output utility rate') > -1){
							$e = explode(':',$val2);
							$chke = false;
							$tmp = '';
							foreach($e as $key3=>$val3){
								$chke = ($chke) ? false : true;
								if($chke){
									$tmp = trim($val3);
								}else{
									$arr['title'][$key][$tmp][] = trim($val3);
								}
							}
						}elseif(substr(trim($val2),0,strlen('Input')) == 'Input'){
							$chkInput = true;
							$chkOutput = false;
						}elseif(substr(trim($val2),0,strlen('Output')) == 'Output'){
							$chkOutput = true;
							$chkInput = false;
						}elseif($chkInput){
							$e = explode(':',$val2);
							$chke = false;
							$tmp = '';
							foreach($e as $key3=>$val3){
								$chke = ($chke) ? false : true;
								if($chke){
									$tmp = trim($val3);
								}else{
									$arr['title'][$key]['Input'][$tmp][] = trim($val3);
								}
							}
						}elseif($chkOutput){
							$e = explode(':',$val2);
							$chke = false;
							$tmp = '';
							foreach($e as $key3=>$val3){
								$chke = ($chke) ? false : true;
								if($chke){
									$tmp = trim($val3);
								}else{
									$arr['title'][$key]['Output'][$tmp][] = trim($val3);
								}
							}
						}else{
							$e = explode(':',$val2);
							$arr['title'][$key][trim($e[0])][] = trim($e[1]);
							$chkInput = $chkOutput = false;
						}
					}
				}elseif(strpos($val2,':') < -1 && strpos($val2,',') > -1){
					if(strpos($val2,'The Maximum Transmit Unit is') > -1){
						$e = explode(',',$val2);
						$arr['title'][$key]['Port Type'][] = trim($e[0]); 
						$arr['title'][$key]['The Maximum Transmit Unit is'][] = trim(str_replace('The Maximum Transmit Unit is','',$e[1]));
					}elseif(strpos($val2,'IP Sending Frames\' Format is') > -1){
						$e = explode(',', $val2);
						if(count($e) == 2){
							$arr['title'][$key]['IP Sending Frames\' Format is'][] = trim(str_replace('IP Sending Frames\' Format is','',$e[0]));
							$arr['title'][$key]['Hardware address is'][] = self::CalMac(trim(str_replace('Hardware address is','',$e[1])));
						}
					}elseif(strpos($val2, 'input rate') > -1){
						$e = explode(',',$val2);
						foreach($e as $key3=>$val3){
							if(strpos($val3, 'input rate') > -1){
								$val3 = substr($val3,strpos($val3,'input rate')+strlen('input rate'),strlen($val3)); 
								$byte = (strpos(strtolower(trim($val3)),'bits') > -1) ? 'Bits' : 'Bytes';
								$arr['title'][$key]['Input '.$byte][] = trim($val3);
							}else{
								$arr['title'][$key]['Input Packet'][] = trim($val3);
							}
						}
					}elseif(strpos($val2, 'output rate') > -1){
						$e = explode(',',$val2);
						foreach($e as $key3=>$val3){
							if(strpos($val3, 'output rate') > -1){
								$val3 = substr($val3,strpos($val3,'input rate')+strlen('input rate'),strlen($val3)); 
								$byte = (strpos(strtolower(trim($val3)),'bits') > -1) ? 'Bits' : 'Bytes';
								$arr['title'][$key]['Output '.$byte][] = trim($val3);
							}else{
								$arr['title'][$key]['Output Packet'][] = trim($val3);
							}
						}
					}elseif($chkInput){
						$e = explode(',',$val2);
						foreach($e as $key3=>$val3){
							$s = explode(chr(32),trim($val3));
							$chkl = false;
							$tmpk = '';
							foreach($s as $key4=>$val4){
								$chkl = (!$chkl) ? true : false;
								if($chkl){
									$tmpk = trim($val4);
								}else{
									$arr['title'][$key]['Input'][trim($val4)][] = $tmpk;
								}
							}
						}
					}elseif($chkOutput){
						$e = explode(',',$val2);
						foreach($e as $key3=>$val3){
							$s = explode(chr(32),trim($val3));
							$chkl = false;
							$tmpk = '';
							foreach($s as $key4=>$val4){
								$chkl = (!$chkl) ? true : false;
								if($chkl){
									$tmpk = trim($val4);
								}else{
									$arr['title'][$key]['Output'][trim($val4)][] = $tmpk;
								}
							}
						}
					}else{
						$e = explode(',',$val2);
						$chkl = false;
						$tmpk = '';
						foreach($e as $key3=>$val3){
							$chkl = (!$chkl) ? true : false;
							if($chkl){
								$tmpk = trim($val3);
							}else{
								$arr['title'][$key][$tmpk][] = trim($val3);
							}
						}
					}
				}elseif(strpos($val2,':') > -1 && strpos($val2,',') > -1){
					if(substr($val2,0,strlen('maximal BW')) == 'maximal BW'){
						$e = explode(',',$val2);
						foreach($e as $key3=>$val3){
							$s = explode(':',$val3);
							if(isset($s[1])){
								$arr['title'][$key][trim($s[0])][] = trim($s[1]);
							}else{
								$s = explode(chr(32),trim($val3));
								$arr['title'][$key][trim($s[0])][] = trim($s[1]);
							}
						}
					}elseif(strpos($val2, 'input rate') > -1){
						$e = explode(',',$val2);
						foreach($e as $key3=>$val3){
							if(strpos($val3, 'input rate') > -1){
								$s = explode(':',$val3);
								$byte = (strpos(strtolower(trim($s[1])),'bits') > -1) ? 'Bits' : 'Bytes';
								$arr['title'][$key]['Input '.$byte][] = trim($s[1]);
							}else{
								$arr['title'][$key]['Input Packet'][] = trim($val3);
							}
						}
					}elseif(strpos($val2, 'output rate') > -1){
						$e = explode(',',$val2);
						foreach($e as $key3=>$val3){
							if(strpos($val3, 'output rate') > -1){
								$s = explode(':',$val3);
								$byte = (strpos(strtolower(trim($s[1])),'bits') > -1) ? 'Bits' : 'Bytes';
								$arr['title'][$key]['Output '.$byte][] = trim($s[1]);
							}else{
								$arr['title'][$key]['Output Packet'][] = trim($val3);
							}
						}
					}elseif(substr(trim($val2),0,strlen('Input peak rate')) == 'Input peak rate'){
						$e = explode(',',$val2);
						foreach($e as $key3=>$val3){
							if(substr(trim($val3),0,strlen('Input peak rate')) == 'Input peak rate'){
								$arr['title'][$key]['Input peak rate'][] = trim(str_replace('Input peak rate','',$val3));
							}else{
								$pos = strpos($val3,':');
								if($pos > -1){
									$s = substr($val3, ($pos+1), strlen($val3));
									$arr['title'][$key]['Record time'][] = trim($s);
								}else{
									$arr['title'][$key]['Record time'][] = trim($val3);
								}
							}
						}
					}elseif(substr(trim($val2),0,strlen('Output peak rate')) == 'Output peak rate'){
						$e = explode(',',$val2);
						foreach($e as $key3=>$val3){
							if(substr(trim($val3),0,strlen('Output peak rate')) == 'Output peak rate'){
								$arr['title'][$key]['Output peak rate'][] = trim(str_replace('Output peak rate','',$val3));
							}else{
								$pos = strpos($val3,':');
								if($pos > -1){
									$s = substr($val3, ($pos+1), strlen($val3));
									$arr['title'][$key]['Record time'][] = trim($s);
								}else{
									$arr['title'][$key]['Record time'][] = trim($val3);
								}
							}
						}
					}elseif(substr(trim($val2),0,strlen('Rx Optical Power')) == 'Rx Optical Power'){
						$pos = strpos($val2,',');
						if($pos > -1){
							$arrF = array();
							$arrF[] = substr($val2,0,$pos);
							$arrF[] = substr($val2,($pos+1),strlen($val2));
							foreach($arrF as $key3=>$val3){
								$e = explode(':',$val3);
								$chkl = false;
								$tmpk = '';
								foreach($e as $key4=>$val4){
									$chkl = (!$chkl) ? true : false;
									if($chkl){
										$tmpk = trim($val4);
									}else{
										$arr['title'][$key][$tmpk][] = trim($val4);
									}
								}
							}
						}
					}elseif(substr(trim($val2),0,strlen('Tx Optical Power')) == 'Tx Optical Power'){
						$pos = strpos($val2,',');
						if($pos > -1){
							$arrF = array();
							$arrF[] = substr($val2,0,$pos);
							$arrF[] = substr($val2,($pos+1),strlen($val2));
							foreach($arrF as $key3=>$val3){
								$e = explode(':',$val3);
								$chkl = false;
								$tmpk = '';
								foreach($e as $key4=>$val4){
									$chkl = (!$chkl) ? true : false;
									if($chkl){
										$tmpk = trim($val4);
									}else{
										$arr['title'][$key][$tmpk][] = trim($val4);
									}
								}
							}
						}
					}elseif(substr(trim($val2),0,strlen('Loopback')) == 'Loopback'){
						$e = explode(',',$val2);
						foreach($e as $key3=>$val3){
							if(strpos($val3,':') < -1 && strpos($val3,'mode') > -1){
								$arr['title'][$key]['mode'][] = trim(str_replace('mode','',$val3));
							}else{
								$s = explode(':',$val3);
								$chkl = false;
								$tmpk = '';
								foreach($s as $key4=>$val4){
									$chkl = (!$chkl) ? true : false;
									if($chkl){
										$tmpk = trim($val4);
									}else{
										$arr['title'][$key][$tmpk][] = trim($val4);
									}
								}
							}
						}
					}elseif(strpos($val2, 'Input:') > -1){
						$j = 0;
						foreach($b[$key] as $key3=>$val3){
							if(substr(trim($val3),0,strlen('Input:')) == 'Input:') $j++;
						}
						if($j > 1){
							$e = explode(',',$val2);
							foreach($e as $key3=>$val3){
								if(strpos($val3, 'Input:') > -1){
									$s = explode(':',$val3);
									$byte = (strpos(strtolower(trim($s[1])),'bits') > -1) ? 'Bits' : 'Bytes';
									$arr['title'][$key]['Input '.$byte][] = trim($s[1]);
								}else{
									$arr['title'][$key]['Input Packet'][] = trim($val3);
								}
							}
						}else{
							$val2 = str_replace('Input:','',$val2);
							if(strpos($val2,',') > -1){
								$e = explode(',',$val2);
								foreach($e as $key3=>$val3){
									$s = explode(chr(32),$val3);
									$chke = false;
									$tmp = '';
									foreach($s as $key4=>$val4){
										if($val4 != ''){
											$chke = ($chke) ? false : true;
											if($chke){
												$tmp = trim($val4);
											}else{
												$arr['title'][$key]['Input'][trim($val4)][] = $tmp;
											}
										}
									}
								}
							}
							$chkInput = true;
							$chkOutput = false;
						}
					}elseif(strpos($val2, 'Output:') > -1){
						$j = 0;
						foreach($b[$key] as $key3=>$val3){
							if(substr(trim($val3),0,strlen('Output:')) == 'Output:') $j++;
						}
						if($j > 1){
							$e = explode(',',$val2);
							foreach($e as $key3=>$val3){
								if(strpos($val3, 'Output:') > -1){
									$s = explode(':',$val3);
									$byte = (strpos(strtolower(trim($s[1])),'bits') > -1) ? 'Bits' : 'Bytes';
									$arr['title'][$key]['Output '.$byte][] = trim($s[1]);
								}else{
									$arr['title'][$key]['Output Packet'][] = trim($val3);
								}
							}
						}else{
							$val2 = str_replace('Output:','',$val2);
							if(strpos($val2,',') > -1){
								$e = explode(',',$val2);
								foreach($e as $key3=>$val3){
									$s = explode(chr(32),$val3);
									$chke = false;
									$tmp = '';
									foreach($s as $key4=>$val4){
										if($val4 != ''){
											$chke = ($chke) ? false : true;
											if($chke){
												$tmp = trim($val4);
											}else{
												$arr['title'][$key]['Output'][trim($val4)][] = $tmp;
											}
										}
									}
								}
							}
							$chkOutput = true;
							$chkInput = false;
						}
					}elseif($chkInput){
						$e = explode(',',$val2);
						foreach($e as $key3=>$val3){
							$s = explode(':',$val3);
							$chke = false;
							$tmp = '';
							foreach($s as $key4=>$val4){
								$chke = ($chke) ? false : true;
								if($chke){
									$tmp = trim($val4);
								}else{
									$arr['title'][$key]['Input'][$tmp][] = trim($val4);
								}
							}
						}
					}elseif($chkOutput){
						$e = explode(',',$val2);
						foreach($e as $key3=>$val3){
							$s = explode(':',$val3);
							$chke = false;
							$tmp = '';
							foreach($s as $key4=>$val4){
								$chke = ($chke) ? false : true;
								if($chke){
									$tmp = trim($val4);
								}else{
									$arr['title'][$key]['Output'][$tmp][] = trim($val4);
								}
							}
						}
					}else{
						$e = explode(',',$val2);
						foreach($e as $key3=>$val3){
							$s = explode(':',$val3);
							$arr['title'][$key][trim($s[0])][] = trim($s[1]);
						}
					}
				}elseif(strpos($val2,':') < -1 && strpos($val2,',') < -1 && strpos($val2,chr(32)) > -1 && preg_match("/[[:alnum:]]/",$val2)){
					if(substr($val2,0,strlen('Internet Address is')) == 'Internet Address is'){
						$arr['title'][$key]['Internet Address is'][] = trim(str_replace('Internet Address is','',$val2));
					}elseif(substr(trim($val2),0,strlen('The Vendor PN is')) == 'The Vendor PN is'){
						$arr['title'][$key]['The Vendor PN is'][] = trim(str_replace('The Vendor PN is','',$val2));
					}elseif(substr(trim($val2),0,strlen('The Vendor Name is')) == 'The Vendor Name is'){
						$arr['title'][$key]['The Vendor Name is'][] = trim(str_replace('The Vendor Name is','',$val2));
					}elseif(substr(trim($val2),0,strlen('Physical is')) == 'Physical is'){
						$arr['title'][$key]['Physical is'][] = trim(str_replace('Physical is','',$val2));
					}
				}
			}
		}
		return $arr;
	}

	private function splitDisplayArpAll($data){
		$a = preg_split("/[\n]+/",$data);
		$arrT = array('IP ADDRESS','MAC ADDRESS','EXPIRE(M)','TYPE','VLAN/CEVLAN','INTERFACE','PVC','VPN-INSTANCE');
		$chk = true;
		$j = 0;
		foreach($a as $key=>$val){
			if(strpos($val,"------------------------------------------------------------------------------") > -1 && $chk){
				$chk = false;
			}else if(!$chk){
				if(strpos($val,"------------------------------------------------------------------------------") > -1){
					$chk = true;
					$d[] = $a[$key+1];
				}else{
					$e = explode(chr(32),trim($val));
					$long = ip2long(trim($e[0]));
					if ($long == -1 || $long === FALSE) {
						$g[$key] = trim($val);
					}else{
						$b[] = trim($val);
						$line[$j] = $key;
						$j++;
					}
					
				}
			}
		}
		$j = 0;
		foreach($b as $key=>$val){
			$s = explode('  ', $val);
			$ic = 0;
			$chkmac = 0;
			foreach($s as $key2=>$val2){
				if(!preg_match("/[[:graph:]]/",$val2)){
					$ic++;
					if($ic > 3){
						$c[$key][] = $val2;
						$ic = 0;
					}
				}else{
					if($chkmac == 1){
						$c[$key][] = self::CalMac(trim($val2));
					}else{
						$c[$key][] = trim($val2);
					}
					$chkmac++;
					$ic = 0;
				}
			}
			
			$ic = $i = 0;
			$cnt = count($arrT);
			$chkVlan = true;			
			if(isset($g[$line[$key]+1])){
				$e = explode(chr(32),$g[$line[$key]+1]);
				$etmp = array();
				foreach($e as $key3=>$val3){
					if(preg_match("/[[:graph:]]/",$val3)){
						$etmp[] = $val3;
					}
				}
				if(!isset($etmp[1])){
					if(strpos($etmp[0],'/') < -1){
						$etmp[1] = $etmp[0];
						unset($etmp[0]);
					}
				}
			}else{
				$etmp = array();
			}
			$o = 0;
			$tmpc = $c[$key];
			$tmp4 = $tmp5 = '';
			while($o < $cnt){
				switch($o){
					case 4 :
						$tmp4 = $tmpc[$o];	
						if(isset($etmp[0])){
							$tmpc[$o] = $etmp[0];
						}else{
							$tmpc[$o] = '';
						}
					break;
					case 5 :
						$tmp5 = $tmpc[$o];
						$tmpc[$o] = $tmp4;
						
					break;
					case 6 :
						if(isset($etmp[1])){
							$tmpc[$o] = $etmp[1];	
						}else{
							$tmpc[$o] = '';
						}
					break;
					case 7 :
						$tmpc[$o] = $tmp5;
					break;
				}
				$o++;
			}
			$c[$key] = $tmpc;
			foreach($c[$key] as $key4=>$val4){
				$arr['title'][$key][$arrT[$key4]] = $val4;
			}
			$j++;
			if((count($b)-1) == $key){
				foreach($d as $key4=>$val4){
					$e = explode(chr(32),$val4);
					foreach($e as $val5){
						if(strpos($val5,":") > -1){
							$f = explode(':',$val5);
							$arr['title'][$j][$f[0]] = $f[1];
						}
					}
				}
			}
		}
		return $arr;
	}

	private function splitDisplayMacAddress($data){
		$a = preg_split("/[\n]+/",$data);
		$chk = $chkline = false;
		$i = 0;
		foreach($a as $key=>$val){
			if($chkline){
				$chkline = false;
				continue;
			}
			if(strpos($val,'<') > -1){
				if(!$chk){
					$arr['head'][] = trim(substr($val,(strpos($val,'>')+1),strlen($val)));
					$chk = true;
				}
				unset($a[$key]);
			}else{
				if(substr($val,0,25) == 'MAC address table of slot'){
					$arr['title']['MAC address table of slot'] = trim(str_replace(':','',substr($val,26,strlen($val))));
					$chkline= true;
				}elseif(substr($val,0,28) == 'Total matching items on slot'){
					$pos = strpos($val,'displayed');
					if($pos > -1){
						$f = substr($val,0,$pos);
						$s = substr($val,$pos,strlen($val));
						$s = explode('=',$s);
						$arr['title']['Total matching items on slot'] = trim(str_replace(':','',substr($f,28,strlen($f))));
						$arr['title']['displayed'] = trim($s[1]);
					}else{
						$arr['title']['Total matching items on slot'] = trim(str_replace(':','',substr($val,28,strlen($val))));
					}
				}else{	
					if(strpos($val,'-------------------------------------------------------------------------------') > -1) $val = 'xx@##@xx';
					$b[$i] = $val;
					$i++;
				}
			}
		}
		$arrK = array('MAC Address','VLAN/VSI/SI','PEVLAN','CEVLAN','Port','Type','LSP/LSR-IDMAC-Tunnel');
		$chk = false;
		$j = 0;
		foreach($b as $key=>$val){
			if($val == 'xx@##@xx'){
				$chk = ($chk) ? false : true;
				continue;
			}
			if($chk){
				$e = explode(chr(32),$val);
				$i = 0;
				foreach($e as $key2=>$val2){
					if(preg_match("/[[:graph:]]/",$val2)){
						if($arrK[$i] == 'MAC Address') $val2 = self::CalMac($val2);
						$arr['title'][$j][$arrK[$i]] = trim($val2);
						$i++;
					}
				}
				$j++;
			}
		}
		return $arr;
	}

	private function splitDisplayEthTrunk($data){
		$a = preg_split("/[\n]+/",$data);
		$chk = $chkt = false;
		$i = 0;
		$k = null;
		$arrT = array('Local','Partner');
		foreach($a as $key=>$val){
			if($chk){
				$arr['head'][] = trim(str_replace(':','',$val));
				$chk = false;
				continue;
			}
			if($val[0] == '<'){
				if(!$chk) $chk = true;
			}else if(!$chk){
				if(strpos($val,"--------------------------------------------------------------------------------") < -1){
					if(!$chkt || ($k == $val && $k != null)){
						$s = explode(':',$val);
						if(!preg_match("/[[:alnum:]]/",$s[1]) && $arrT[0] === $s[0]){
							$z = 0;
							$b[$i][trim($s[0])] = array();
							$k2 = trim($s[0]);
							if($k == null) $k = trim($val);
							$i++;
							$chkt = true;
						}
					}else if($chkt){
						$s = explode(':',$val);
						if(!preg_match("/[[:alnum:]]/",$s[1]) && $arrT[1] === $s[0]){
							$k2 = trim($s[0]);
							$b[$i-1][$k2] = array();
						}else{
							$b[$i-1][$k2][] = trim($val);
						}
					}					
				}
			}
		}
		
		foreach($b as $key=>$val){
			foreach($val as $key2=>$val2){
				$chk = false;
				$arrK = array();
				foreach($val2 as $key3=>$val3){
					if(strpos($val3,':') > -1){
						$s = explode('  ',$val3);
						foreach($s as $key4=>$val4){
							if(preg_match("/[[:alnum:]]/",$val4)){
								$e = explode(':',$val4);
								if(trim($e[0]) === 'System ID'){
									$arr['title'][$key][$key2][trim($e[0])] = self::CalMac(trim($e[1]));
								}else{
									$arr['title'][$key][$key2][trim($e[0])] = trim($e[1]);
								}
							}
						}
					}else{
						$j = 0;
						$s = explode(chr(32),$val3);
						foreach($s as $key4=>$val4){
							if(preg_match("/[[:alnum:]]/",$val4)){
								if(!$chk){
									$arrK[] = trim($val4);
								}else{
									if($arrK[$j] === 'SystemID'){
										$arr['title'][$key][$key2][$arrK[$j]] = self::CalMac(trim($val4));
									}else{
										$arr['title'][$key][$key2][$arrK[$j]] = trim($val4);
									}
									$j++;
								}
							}					
						}
						$chk = true;
					}
				}
			}
		}
		return $arr;
	}

	private function splitDisplayInterface($data){
		$a = preg_split("/[\n]+/",$data);
		foreach($a as $key=>$val){
			if($val[0] == '<'){
				$k = strpos($val,'>');
				$s = substr($val,($k+1));
				if(preg_match("/[[:alnum:]]/",$s)){
					$arr['head'][] = trim($s);
				}
				unset($a[$key]);
			}
		}
		$i = 0;
		foreach($a as $key=>$val){
			$b[$i] = trim($val);
			$i++;
		}

		$i = 0;
		foreach($b as $key=>$val){
			if((strpos($val,'current state') > -1 && !preg_match("/[[:graph:]]/",$b[$key-1]))){
				$c[$i][] = $val;
				$i++;					
				
			}else{
				$c[$i-1][] = $val;
			}
		}

		foreach($c as $key=>$value){
			$inputGroup = $outputGroup = $fiberTran = $fiberType = false;
			foreach($value as $k=>$val){
				if(strpos($val,':') > -1 && strpos($val,',') < -1){
					$e = explode(':',$val);
					if($k == 0){
						$s = str_replace('current state','',$e[0]);
						$arr['title'][$key]['Port'][] = trim($s);
						$arr['title'][$key]['current state'][] = trim($e[1]);
					}elseif(!preg_match("/[[:graph:]]/",$value[$k-1]) && strpos($val,'current state') > -1){
						$s = str_replace('current state','',$e[0]);
						$arr['title'][$key]['Port'][] = trim($s);
						$arr['title'][$key]['current state'][] = trim($e[1]);
					}elseif(preg_match("/[[:alnum:]]/",$val)){
						if($val == 'Fiber transceiver information:'){
							$fiberTran = true;
							$fiberType = false;
						}elseif($val == 'Fiber Type Supported and Max Transmission Distance:'){
							$fiberType = true;
							$fiberTran = false;
						}elseif($fiberTran){
							$pos = strpos(trim($e[1]),'(');
							$s = ($pos > -1) ? substr_replace(trim($e[1]),'',$pos) : trim($e[1]);
							$arr['title'][$key]['Fiber transceiver information'][trim($e[0])][] = trim($s);
						}elseif($fiberType){
							$pos = strpos(trim($e[1]),'(');
							$s = ($pos > -1) ? substr_replace(trim($e[1]),'',$pos) : trim($e[1]);
							$arr['title'][$key]['Fiber Type Supported and Max Transmission Distance'][trim($e[0])][] = trim($s);
						}else{
							$arr['title'][$key][trim($e[0])][] = trim($e[1]);
						}
					}
				}elseif(strpos($val,':') > -1 && strpos($val,',') > -1){
					if(substr($val, 0, 5) == 'error'){
						$s = str_replace('error:','',$val);
						$e = explode(',',trim($s));
						foreach($e as $val2){
							$f = explode(chr(32), trim($val2));
							$arr['title'][$key]['error'][trim($f[0])][] = trim($f[1]);
						}
					}else{
						$e = explode(',', $val);
						$chkInputRate = $chkOutputRate = false;
						foreach($e as $val2){
							if(strpos($val2, 'input rate') > -1){
								$s = explode(': ',$val2);
								$byte = (strpos(strtolower(trim($s[1])),'bits') > -1) ? 'Bits' : 'Bytes';
								$arr['title'][$key]['Input '.$byte][] = trim($s[1]);
								$chkInputRate = true;
							}elseif($chkInputRate){
								$arr['title'][$key]['Input Packet'][] = trim($val2);
								$chkInputRate = false;
							}elseif(strpos($val2, 'output rate') > -1){
								$s = explode(': ',$val2);
								$byte = (strpos(strtolower(trim($s[1])),'bits') > -1) ? 'Bits' : 'Bytes';
								$arr['title'][$key]['Output '.$byte][] = trim($s[1]);
								$chkOutputRate = true;
							}elseif($chkOutputRate){
								$arr['title'][$key]['Output Packet'][] = trim($val2);
								$chkOutputRate = false;
							}elseif(substr($val2, 0, 6) == 'Input:'){
								$s = explode(chr(32), trim(str_replace('Input:','',$val2)));
								$arr['title'][$key]['Input'][$s[1]][] = trim(str_replace('Input:','',$s[0]));
								$inputGroup = true;
								$outputGroup = false;
							}elseif(substr($val2, 0, 7) == 'Output:'){
								$s = explode(chr(32), trim(str_replace('Output:','',$val2)));
								$arr['title'][$key]['Output'][$s[1]][] = trim(str_replace('Output:','',$s[0]));
								$outputGroup = true;
								$inputGroup = false;
							}elseif($inputGroup){
								$s = explode(chr(32), trim($val2));
								$arr['title'][$key]['Input'][$s[1]][] = trim($s[0]);
							}elseif($outputGroup){
								$s = explode(chr(32), trim($val2));
								$arr['title'][$key]['Output'][$s[1]][] = trim($s[0]);
							}else{
								if(preg_match("/[[:graph:]]/",$val2)){
									$s = explode(':', $val2); 
									$arr['title'][$key][trim($s[0])][] = trim(str_replace(';','',$s[1]));
								}
							}
						}
					}
				}elseif(strpos($val,':') < -1 && strpos($val,',') < -1 && strpos($val,'=') > -1){
					$e = explode(chr(32), $val);
					foreach($e as $key2=>$val2){
						if(preg_match("/[[:graph:]]/",$val2)){
							$s = explode('=',$val2);
							$arr['title'][$key][trim($s[0])][] = trim(str_replace(';','',$s[1]));
						}
					}
				}elseif(strpos($val,':') < -1 && strpos($val,',') < -1 && strpos($val,chr(32)) > -1 && preg_match("/[[:alnum:]]/",$val)){
					if(strpos($val, 'The Maximum Transmit Unit is') > -1){
						$arr['title'][$key]['The Maximum Transmit Unit is'][] = trim(str_replace('The Maximum Transmit Unit is','',$val));
					}elseif(strpos($val, 'Internet Address is') > -1){
						$arr['title'][$key]['Internet Address is'][] = trim(str_replace('Internet Address is','',$val));
					}elseif(strpos($val, 'input error') > -1){
						$arr['title'][$key]['input error'][] = trim(str_replace('input error','',$val));
					}elseif(strpos($val, 'input CRC error') > -1){
						$arr['title'][$key]['input CRC error'][] = trim(str_replace('input CRC error','',$val));
					}elseif(strpos($val, 'input ALIGNMENT error') > -1){
						$arr['title'][$key]['input ALIGNMENT error'][] = trim(str_replace('input ALIGNMENT error','',$val));
					}elseif(strpos($val, 'input RESOURCE error') > -1){
						$arr['title'][$key]['input RESOURCE error'][] = trim(str_replace('input RESOURCE error','',$val));
					}elseif(strpos($val, 'input OVERRUN error') > -1){
						$arr['title'][$key]['input OVERRUN error'][] = trim(str_replace('input OVERRUN error','',$val));
					}elseif(strpos($val, 'input COLLISION error') > -1){
						$arr['title'][$key]['input COLLISION error'][] = trim(str_replace('input COLLISION error','',$val));
					}elseif(strpos($val, 'input SHORT FRAME error') > -1){
						$arr['title'][$key]['input SHORT FRAME error'][] = trim(str_replace('input SHORT FRAME error','',$val));
					}elseif(strpos($val, 'output error') > -1){
						$arr['title'][$key]['output error'][] = trim(str_replace('output error','',$val));
					}elseif(strpos($val, 'output MAX COLLISION error') > -1){
						$arr['title'][$key]['output MAX COLLISION error'][] = trim(str_replace('output MAX COLLISION error','',$val));
					}elseif(strpos($val, 'output LATE COLLISION error') > -1){
						$arr['title'][$key]['output LATE COLLISION error'][] = trim(str_replace('output LATE COLLISION error','',$val));
					}elseif(strpos($val, 'output UNDERRUN error') > -1){
						$arr['title'][$key]['output UNDERRUN error'][] = trim(str_replace('output UNDERRUN error','',$val));
					}elseif(strpos($val, 'output LOST CRS error') > -1){
						$arr['title'][$key]['output LOST CRS error'][] = trim(str_replace('output LOST CRS error','',$val));
					}elseif(strpos($val, 'output DEFERRED') > -1){
						$arr['title'][$key]['output DEFERRED'][] = trim(str_replace('output DEFERRED','',$val));
					}elseif(strpos($val, 'output SINGLE COLLISION') > -1){
						$arr['title'][$key]['output SINGLE COLLISION'][] = trim(str_replace('output SINGLE COLLISION','',$val));
					}elseif(strpos($val, 'output MULTIPLE COLLISION') > -1){
						$arr['title'][$key]['output MULTIPLE COLLISION'][] = trim(str_replace('output MULTIPLE COLLISION','',$val));
					}elseif(strpos($val, 'output TOTAL COLLISION') > -1){
						$arr['title'][$key]['output TOTAL COLLISION'][] = trim(str_replace('output TOTAL COLLISION','',$val));
					}elseif($inputGroup){
						$s = explode(chr(32), trim($val));
						$arr['title'][$key]['Input'][$s[1]][] = trim($s[0]);
					}elseif($outputGroup){
						$s = explode(chr(32), trim($val));
						$arr['title'][$key]['Output'][$s[1]][] = trim($s[0]);
					}
				}elseif(strpos($val,',') > -1){
					$e = explode(',', $val);
					$i = 0;
					$val3 = array();
					foreach($e as $key2=>$val2){
						if(preg_match("/[[:alnum:]]/",$val2)){
							$val3[$i] = trim($val2);
							$i++;
						}
					}

					$chkInputRate = $chkOutputRate = $chkInputRate2 = $chkOutputRate2 = false;
					foreach($val3 as $key4=>$val4){
						if(strpos($val4, 'The configured MTU is') > -1){
							$s = str_replace('The configured MTU is','',$val4);
							$arr['title'][$key]['The configured MTU is'][] = trim($s);
						}elseif(strpos($val4, 'and the active MTU is') > -1){
							$s = str_replace('and the active MTU is','',$val4);
							$arr['title'][$key]['and the active MTU is'][] = trim($s);
						}elseif(strpos($val4, 'input rate') > -1){
							$s = substr($val4, (strrpos($val4, 'input rate')+strlen('input rate')));
							$byte = (strpos(strtolower(trim($s)),'bits') > -1) ? 'Bits' : 'Bytes';
							$arr['title'][$key]['Input '.$byte][] = trim($s);
							$chkInputRate = true;
						}elseif(strpos($val4, 'output rate') > -1){
							$s = substr($val4, (strrpos($val4, 'output rate')+strlen('output rate')));
							$byte = (strpos(strtolower(trim($s)),'bits') > -1) ? 'Bits' : 'Bytes';
							$arr['title'][$key]['Output '.$byte][] = trim($s);
							$chkOutputRate = true;
						}elseif($chkInputRate){
							$arr['title'][$key]['Input Packet'][] = trim($val4);
							$chkInputRate= false;
						}elseif($chkOutputRate){
							$arr['title'][$key]['Output Packet'][] = trim($val4);
							$chkOutputRate= false;
						}elseif(strpos($val4, 'input') > -1){
							$s = str_replace('input', '', $val4);
							$arr['title'][$key]['Input Packet'][] = trim($s);
							$chkInputRate2 = true;
						}elseif(strpos($val4, 'output') > -1){
							$s = str_replace('output', '', $val4);
							$arr['title'][$key]['Output Packet'][] = trim($s);
							$chkOutputRate2 = true;
						}elseif($chkInputRate2){
							$byte = (strpos(strtolower(trim($val4)),'bits') > -1) ? 'Bits' : 'Bytes';
							$arr['title'][$key]['Input '.$byte][] = trim($val4);
							$chkInputRate2 = false;
						}elseif($chkOutputRate2){
							$byte = (strpos(strtolower(trim($val4)),'bits') > -1) ? 'Bits' : 'Bytes';
							$arr['title'][$key]['Output '.$byte][] = trim($val4);
							$chkOutputRate2 = false;
						}elseif(strpos($val4, 'IP Sending Frames\' Format is') > -1){
							$arr['title'][$key]['IP Sending Frames\' Format is'][] = trim(str_replace('IP Sending Frames\' Format is','',$val4));
						}elseif(strpos($val4, 'Hardware address is') > -1){
							$arr['title'][$key]['Hardware address is'][] = self::CalMac(trim(str_replace('Hardware address is','',$val4)));
						}elseif(strpos($val4, 'Transmitter\'s pause') > -1){
							$arr['title'][$key]['Transmitter\'s pause'][] = trim(str_replace('Transmitter\'s pause','',$val4));
						}elseif(strpos($val4, 'Receiver\'s pause') > -1){
							$arr['title'][$key]['Receiver\'s pause'][] = trim(str_replace('Receiver\'s pause','',$val4));
						}elseif(strpos($val4, 'NEGOTIATION') > -1){
							$arr['title'][$key]['NEGOTIATION'][] = trim(str_replace('NEGOTIATION', '', str_replace(';','',$val4)));
						}elseif(strpos($val4, 'SPEED') > -1){
							$arr['title'][$key]['SPEED'][] = trim(str_replace('SPEED', '', str_replace(';','',$val4)));
						}elseif(strpos($val4, 'DUPLEX') > -1){
							$arr['title'][$key]['DUPLEX'][] = trim(str_replace('DUPLEX', '', str_replace(';','',$val4)));
						}elseif(strpos($val4, 'LOOPBACK') > -1){
							$arr['title'][$key]['LOOPBACK'][] = trim(str_replace('LOOPBACK', '', str_replace(';','',$val4)));
						}elseif(strpos($val4, 'negotiation') > -1){
							$arr['title'][$key]['negotiation'][] = trim(str_replace('negotiation', '', str_replace(';','',$val4)));
						}elseif(strpos($val4, 'speed') > -1){
							$arr['title'][$key]['speed'][] = trim(str_replace('speed', '', str_replace(';','',$val4)));
						}elseif(strpos($val4, 'duplex') > -1){
							$arr['title'][$key]['duplex'][] = trim(str_replace('duplex', '', str_replace(';','',$val4)));
						}elseif(strpos($val4, 'loopback') > -1){
							$arr['title'][$key]['loopback'][] = trim(str_replace('loopback', '', str_replace(';','',$val4)));
						}elseif($inputGroup){
							$s = explode(chr(32), trim($val4));
							$arr['title'][$key]['Input'][$s[1]][] = trim($s[0]);
						}elseif($outputGroup){
							$s = explode(chr(32), trim($val4));
							$arr['title'][$key]['Output'][$s[1]][] = trim($s[0]);
						}
					}
				}
			}
		}                                               
		return $arr;
	}

	private function splitDisplayArp($data){
		$a = preg_split("/[\n]+/",$data);
		$arrT = array('IP ADDRESS','MAC ADDRESS','EXPIRE(M)','TYPE','VLAN','INTERFACE','VPN-INSTANCE');
		$chk = true;
		foreach($a as $key=>$val){
			if(strpos($val,"------------------------------------------------------------------------------") > -1 && $chk){
				$chk = false;
			}else if(!$chk){
				if(strpos($val,"------------------------------------------------------------------------------") > -1){
					$chk = true;
					$d[] = $a[$key+1];
				}else{
					$b[] = trim($val);
				}
			}
		}
		$j = 0;
		foreach($b as $key=>$val){
			if(!(strpos($val, chr(32)) > -1)) continue;
			$s = explode('  ', $val);
			$ic = 0;
			$chkmac = 0;
			foreach($s as $key2=>$val2){
				if(!preg_match("/[[:graph:]]/",$val2)){
					$ic++;
					if($ic > 2){
						$c[$key][] = $val2;
						$ic = 0;
					}
				}else{
					if($chkmac == 1){
						$c[$key][] = self::CalMac(trim($val2));
					}else{
						$c[$key][] = trim($val2);
					}
					$chkmac++;
					$ic = 0;
				}
			}

			$ic = $i = 0;
			$cnt = count($arrT);
			$chkVlan = true;
			while($i<$cnt){
				if($i == 4){
					if(strpos($b[$key+1], chr(32)) > -1){
						$arr['title'][$j][$arrT[$i]] = '';
					}else{
						$arr['title'][$j][$arrT[$i]] = $b[$key+1];
					}
				}else{
					$arr['title'][$j][$arrT[$i]] = $c[$key][$ic];
					$ic++;
				}	
				$i++;
			}

			if((count($c[$key]) == ($ic+1)) && empty($arr['title'][$j][end($arrT)]) && !empty($c[$key][(count($c[$key])-1)])) $arr['title'][$j][end($arrT)] =  $c[$key][(count($c[$key])-1)];			
			$j++;
			if((count($b)-1) == $key){
				foreach($d as $key4=>$val4){
					$e = explode(chr(32),$val4);
					foreach($e as $val5){
						if(strpos($val5,":") > -1){
							$f = explode(':',$val5);
							//if(preg_match("/[[:graph:]]/",$f[1]))
							$arr['title'][$j][$f[0]] = $f[1];
						}
					}
				}
			}
		}
		return $arr;
	}

	private function splitDisplayMac($data){
		$a = preg_split("/[\n]+/",$data);
		$arrT = array('MAC Address','VLAN/VSI','Port','Type','Lsp');
		$chk = true;
		foreach($a as $k=>$val){
			if(strpos($val,"----------------------------------------------------------------------------") > -1 && $chk){
				$chk = false;
			}else if(strpos($val,'Total matching items displayed') > -1){
				$b[] = $val;
				$chk = true;
			}else if(!$chk){
				$b[] = $val;
			}
		}

		foreach($b as $key=>$val){
			if(strpos($val,'Total matching items displayed') > -1){
				$s = explode('=', $val);
				$arr['title'][$key][$s[0]] = $s[1];
			}else{
				$s = explode(chr(32),$val);
				$c = array();
				$chkmac = false;
				foreach($s as $key2=>$val2){
					if(preg_match("/[[:graph:]]/",$val2)){
						if(!$chkmac){
							$c[] = self::CalMac($val2);
							$chkmac = true;
						}else{
							$c[] = $val2;
						}
						
					}
				}
				foreach($arrT as $key3=>$val3){
					$arr['title'][$key][$val3] = $c[$key3];
				}
			}
		}
		return $arr;
	}

	private function splitLagDescription($data){
		$a = preg_split("/[\n]+/",$data);
		$b = $a;
		foreach($a as $k=>$val){
			if(strpos($a[$k],"===============================================================================") > -1){
				if(strpos($a[$k+3],"===============================================================================") > -1){
					$arr['head'][] = trim($b[$k+1]);
					unset($b[$k]);
					unset($b[$k+1]);
					unset($b[$k+2]);
					unset($b[$k+3]);
					break;
				}
			}
		}

		foreach($b as $key=>$val){
			if($val[0] === "*"){
				unset($b[$key]);
			}else if(strpos($val,"-------------------------------------------------------------------------------") > -1){
				$b[$key] = "xx@#xx";
			}
		}

		$tk1 = $chkspace = false;
		foreach($b as $key=>$val){
			if($val !== 'xx@#xx'){
				if($chkspace && !preg_match("/[[:graph:]]/",$val)) unset($b[$key]);
				if(!$tk1){
					$pos = strpos($val,'"');
					if($pos > -1){
						$len = strlen($val);
						$chk = false;
						for($i = $pos;$i<=$len;$i++){
							if($val[$i] === '"') $chk = true;
						}
						if($chk){
							$tmp = $val;
							$tmpk = $key;
							$tk1 = true;
						}
					}
					$chkspace = false;
				}else{
					$pos = strpos($val,'"');
					if($pos > -1){
						$len = strlen($val);
						$str = '';
						for($i = 0;$i<=$pos;$i++){
							if($val[$i] != chr(32)) $str .= $val[$i];
						}
						$b[$tmpk] = $tmp.$str;
						unset($b[$key]);
						$chkspace = true;
						$tk1 = false;
					}
				}
				
			}else{
				unset($b[$key-1]);
			}
		}

		foreach($b as $key=>$val){
			$c[] = $val;
		}
		unset($b);
		$tk1 = $firstRow = false;
		$i = 0;//print_r($c);
		$arrT1 = array('Lag-id','LACP Status','Adm','Opr','Description');
		$arrT2 = array('Port-id','Adm','Act/Stdby','Opr','Description');
		foreach($c as $key=>$val){ 
			if($val === 'xx@#xx'){
				$tk1 = true;
				$i = 0;
				$firstRow = true;
			}elseif(preg_match("/[[:alnum:]]/",$val)){
				$val2 = explode(' ',$val);
				$g = array();
				foreach($val2 as $val3){
					if(preg_match("/[[:graph:]]/",$val3)){
						$g[] = $val3;
					}
				}
				if($firstRow){
					$h = 0;
					$f = 0;
					foreach($g as $key4=>$val4){
						if(strpos($val4,'(') > -1 && strpos($val4,')') > -1 && $key4 == 0){
							$val4 = str_replace('(','xx@@xx',$val4);
							$val4 = str_replace(')','xx@@xx',$val4);
							$val4 = explode('xx@@xx', $val4);
						}
						if($f == 4) $val4 = str_replace('"','',$val4);
						if(is_array($val4)){
							foreach($val4 as $val5){
								if($val5 != ''){
									$arr['title'][$i][$h][$arrT1[$f]] = $val5;
									$f++;
								}
							}
						}else{
							$arr['title'][$i][$h][$arrT1[$f]] = $val4;
							$f++;
						}
					}
					$firstRow = false;
				}else{
					$h++;
					foreach($g as $key4=>$val4){
						if($key4 == 4) $val4 = str_replace('"','',$val4);
						$arr['title'][$i][$h][$arrT2[$key4]] = $val4;
					}
				}
			}elseif((!preg_match("/[[:graph:]]/",$val) || preg_match("/[[:blank:]]/",$val)) && $tk1){
				$firstRow = true;
				$i++;
			}
		}
		unset($c);
		return $arr;
	}

	private function splitServiceCustomer($data){
		$a = preg_split("/[\n]+/",$data);
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

		foreach($b as $key=>$val){
			if($val[0] === "*"){
				unset($b[$key]);
			}else if(strpos($val,"-------------------------------------------------------------------------------") > -1){
				$b[$key] = "xx@#xx";
			}
		}

		foreach($b as $key=>$val){
			$c[] = $val;
		}
		unset($b);
		$tk1 = false;
		$j = 0;
		foreach($c as $key=>$val){	
			if($val == 'xx@#xx'){
				$tk1 = ($tk1) ? false : true;
			}elseif($tk1){
				$exp = explode(': ',$val);
				if(isset($exp[1])){
					$arr['title'][$j]['footer'][trim($exp[0])] = trim($exp[1]);
				}
			}elseif(preg_match("/[[:alnum:]]/",$val) && $val != 'xx@#xx'){
				$exp = explode(': ',$val);
				if(isset($exp[1])){
					$arr['title'][$j][trim($exp[0])] = trim($exp[1]);
				}
			}	
			if(!preg_match("/[[:graph:]]/",$val)) $j++;
		}
		unset($c);
		return $arr;
	}

	private function splitServiceUsing($data){
		$a = preg_split("/[\n]+/",$data);
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

		foreach($b as $key=>$val){
			if($val[0] === "*"){
				unset($b[$key]);
			}else if(strpos($val,"-------------------------------------------------------------------------------") > -1){
				$b[$key] = "xx@#xx";
			}
		}

		foreach($b as $key=>$val){
			$c[] = $val;
		}
		unset($b);
		$tk1 = $chktfoot = false;
		$h = 0;
		foreach($c as $key=>$val){
			if($tk1 === true){
				if($val != 'xx@#xx'){
					$exb = explode(' ',$val);
					$j = 0;
					foreach($exb as $val3){
						if(preg_match("/[[:alnum:]]/",$val3)){
							$arr['title'][$h][$No[$j]] = trim($val3);
							$j++;
						}
					}
					$h++;
				}
			}
			if($val === 'xx@#xx' && $tk1 === false){
				$tk1 = true;
				$chktfoot = false;
				$exa = array('ServiceId','Type','Adm','Opr','CustomerId','Service Name');
				$No = array();
				foreach($exa as $val2){
					if(preg_match("/[[:alnum:]]/",$val2)){
						$No[] = trim($val2);
					}
				}
			}else if($val === 'xx@#xx' && $tk1 === true){
				$tk1 = false;
				$chktfoot = true;
			}
			if($chktfoot){
				if(strpos($val,': ') > -1){
					$exc = explode(': ',$val);
					$arr['title'][$h++]['footer'][trim($exc[0])] = trim($exc[1]);
				}
			}
		}
		unset($c);
		return $arr;		
	}

	private function splitSapUsing($data){
		$a = preg_split("/[\n]+/",$data);
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

		foreach($b as $key=>$val){
			if($val[0] === "*"){
				unset($b[$key]);
			}else if(strpos($val,"-------------------------------------------------------------------------------") > -1){
				$b[$key] = "xx@#xx";
			}
		}

		foreach($b as $key=>$val){
			$c[] = $val;
		}
		unset($b);
		$tk1 = $chktfoot = false;
		$h = 0;
		foreach($c as $key=>$val){
			if($tk1 === true){
				if($val != 'xx@#xx'){
					$exb = explode(' ',$val);
					$j = 0;
					foreach($exb as $val3){
						if(preg_match("/[[:alnum:]]/",$val3)){
							$arr['title'][$h][$No[$j]] = trim($val3);
							$j++;
						}
					}
					$h++;
				}
			}
			if($val === 'xx@#xx' && $tk1 === false){
				$tk1 = true;
				$chktfoot = false;
				$exa = array('PortId','SvcId','Ing.QoS','Ing.Fltr','Egr.QoS','Egr.Fltr','Adm','Opr');
				$No = array();
				foreach($exa as $val2){
					if(preg_match("/[[:alnum:]]/",$val2)){
						$No[] = trim($val2);
					}
				}
			}else if($val === 'xx@#xx' && $tk1 === true){
				$tk1 = false;
				$chktfoot = true;
			}
			if($chktfoot){
				if(strpos($val,': ') > -1){
					$exc = explode(': ',$val);
					$arr['title'][$h++]['footer'][trim($exc[0])] = trim($exc[1]);
				}
			}
		}
		unset($c);
		return $arr;	
	} 
	
	private function splitSdpUsing($data){
		$a = preg_split("/[\n]+/",$data);
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

		foreach($b as $key=>$val){
			if($val[0] === "*"){
				unset($b[$key]);
			}else if(strpos($val,"-------------------------------------------------------------------------------") > -1){
				$b[$key] = "xx@#xx";
			}
		}

		foreach($b as $key=>$val){
			$c[] = $val;
		}
		unset($b);
		$tk1 = $chktfoot = false;
		$h = 0;
		foreach($c as $key=>$val){
			if($tk1 === true){
				if($val != 'xx@#xx'){
					$exb = explode(' ',$val);
					$j = 0;
					foreach($exb as $val3){
						if(preg_match("/[[:alnum:]]/",$val3)){
							$arr['title'][$h][$No[$j]] = trim($val3);
							$j++;
						}
					}
					$h++;
				}
			}
			if($val === 'xx@#xx' && $tk1 === false){
				$tk1 = true;
				$chktfoot = false;
				$exa = array('SvcId','SdpId','Type','Far End','Opr S*','I.Label','E.Label');
				$No = array();
				foreach($exa as $val2){
					if(preg_match("/[[:alnum:]]/",$val2)){
						$No[] = trim($val2);
					}
				}
			}else if($val === 'xx@#xx' && $tk1 === true){
				$tk1 = false;
				$chktfoot = true;
			}
			if($chktfoot){
				if(strpos($val,': ') > -1){
					$exc = explode(': ',$val);
					$arr['title'][$h++]['footer'][trim($exc[0])] = trim($exc[1]);
				}
			}
		}
		unset($c);
		return $arr;
	}

	private function splitFdbMac($data){
		$a = preg_split("/[\n]+/",$data);
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

		foreach($b as $key=>$val){
			if($val[0] === "*"){
				unset($b[$key]);
			}else if(strpos($val,"-------------------------------------------------------------------------------") > -1){
				$b[$key] = "xx@#xx";
			}
		}

		foreach($b as $key=>$val){
			$c[] = $val;
		}
		unset($b);
		$tk1 = $chktfoot = false;
		$h = 0;
		foreach($c as $key=>$val){
			if($tk1 === true){
				if($val != 'xx@#xx'){
					$exb = explode(' ',$val);
					$j = $p = 0;
					$cnt = count($exb);
					foreach($exb as $val3){
						$p++;
						if(preg_match("/[[:alnum:]]/",$val3)){
							if($p === $cnt){
								$arr['title'][$h][$No[$j-1]] = $arr['title'][$h][$No[$j-1]].' '.trim($val3);
							}else{
								$arr['title'][$h][$No[$j]] = trim($val3);
							}
							$j++;
						}
					}
					$h++;
				}
			}
			if($val === 'xx@#xx' && $tk1 === false){
				$tk1 = true;
				$chktfoot = false;
				$exa = array('ServId','MAC','Source-Identifier','Type Age','Last Change');
				$No = array();
				foreach($exa as $val2){
					if(preg_match("/[[:alnum:]]/",$val2)){
						$No[] = trim($val2);
					}
				}
			}else if($val === 'xx@#xx' && $tk1 === true){
				$tk1 = false;
				$chktfoot = true;
			}
			if($chktfoot){
				if(strpos($val,': ') > -1){
					$exc = explode(': ',$val);
					$arr['title'][$h++]['footer'][trim($exc[0])] = trim($exc[1]);
					break;
				}
			}
		}
		unset($c);
		return $arr;
	}

	private function splitRouterArp($data){
		$a = preg_split("/[\n]+/",$data);
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

		foreach($b as $key=>$val){
			if($val[0] === "*"){
				unset($b[$key]);
			}else if(strpos($val,"-------------------------------------------------------------------------------") > -1){
				$b[$key] = "xx@#xx";
			}
		}

		foreach($b as $key=>$val){
			$c[] = $val;
		}
		unset($b);
		$tk1 = $chktfoot = false;
		$h = 0;
		foreach($c as $key=>$val){
			if($tk1 === true){
				if($val != 'xx@#xx'){
					$exb = explode(' ',$val);
					$j = 0;
					foreach($exb as $val3){
						if(preg_match("/[[:alnum:]]/",$val3)){
							$arr['title'][$h][$No[$j]] = trim($val3);
							$j++;
						}
					}
					$h++;
				}
			}
			if($val === 'xx@#xx' && $tk1 === false){
				$tk1 = true;
				$chktfoot = false;
				$exa = explode('  ', $c[$key-1]);
				$No = array();
				foreach($exa as $val2){
					if(preg_match("/[[:alnum:]]/",$val2)){
						$No[] = trim($val2);
					}
				}
			}else if($val === 'xx@#xx' && $tk1 === true){
				$tk1 = false;
				$chktfoot = true;
			}
			if($chktfoot){
				if(strpos($val,': ') > -1){
					$exc = explode(': ',$val);
					$arr['title'][$h++]['footer'][trim($exc[0])] = trim($exc[1]);
				}
			}
		}
		unset($c);
		return $arr;
	}

	private function splitLogParser($data)
	{
		$a = preg_split("/[\n]+/",$data);
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

	private function splitColon($str){
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
	
	public function count_dimension($Array, $count = 0){
	   if(is_array($Array)) {
		  return self::count_dimension(current($Array), ++$count);
	   } else {
		  return $count;
	   }
	}
	
	public function CalMac($str){
		$str = str_replace('-','',$str);
		$len = strlen($str);
		$tmp = $s = '';
		$j = 0;
		for($i = 0;$i<$len;$i++){
			$j++;
			$tmp .= $str[$i];
			if($j > 1){
				$s .= ':'.$tmp;
				$tmp = '';
				$j = 0;
			}
		}
		$str = substr($s,1,strlen($s));
		return strtolower($str);
	}
}
?>