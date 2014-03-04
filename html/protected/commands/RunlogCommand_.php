<?php
$yii=dirname(__FILE__).'/../../framework/yii.php';
$config=dirname(__FILE__).'/../../protected/config/console.php';
require_once($yii);
$arr = require_once($config);

class RunlogCommand
{
	public $con = null;
	public function __construct($arr){
		$db = $arr['components']['db'];
		try {
			$this->con = new PDO($db['connectionString'], $db['username'], $db['password']);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
			exit;
		}
	}

	public function LoadSQL($strSQL){
		$sth = $this->con->query($strSQL)or die(print_r($db->errorInfo(), true));
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function QuerySQL($strSQL){
		$sth = $this->con->query($strSQL)or die(print_r($db->errorInfo(), true));
	}

    public function index($start, $end){
		if(empty($start) && empty($end)){
			echo "Please input start date and end date.\n";
			exit;
		}else if(empty($start)){
			echo "Please input start date.\n";
			exit;
		}else if(empty($end)){
			echo "Please input end date.\n";
			exit;
		}else{
			if(!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $start) || !preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $end)) {
				echo "Please input date format YYYY-MM-DD H:i:s\n";
				exit;
			}
		}
		$strSQL = "SELECT * FROM ATTRIB_TYPE";
		$arrType = self::LoadSQL($strSQL);
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

		$strSQLM = "SELECT b.brand,b.model,b.sw_ver,a.* FROM NE_RUN_DATA a JOIN NE_LIST b ON a.UPDATE_DATE BETWEEN '".$start."' AND '".$end."' AND b.ip_addr = a.IP_ADDR JOIN NE_RUN_TYPE c ON a.NE_RUN_TYPE_ID = c.ID";
		$row =  self::LoadSQL($strSQLM);
		foreach($row as $item){
			$arrAttList = array();
			$arrAttListId = array();
			$arrRSType = array();
			$arrNO = array();
			if(isset($arrType[0])){
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
				$rsSearch = self::LoadSQL($sql);
				foreach($rsSearch as $val){
					$arrAttList[] = $val['NAME'].'-'.$val['ATTRIB_TYPE_ID'];
				}
			}
			
			$chkDup = self::LoadSQL("SELECT * FROM NE_RUN_ATTRIB WHERE UPDATE_DATE = '".$item['UPDATE_DATE']."' AND IP_ADDR = '".$item['IP_ADDR']."'");
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
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}

					$Parrent_Group = array();
					$Parrent_Group_Id = array();
					$Parrent_Group[] = $arr['head'][0];
					$Parrent_Group_Id[] = $IdGroup;
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(isset($arrAttList[0])){
									if(!in_array($key2.'-'.$IdGroup,$arrAttList)){
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$key2."')";
										$query = self::QuerySQL($strSQL);
										array_push($arrAttList, $key2.'-'.$IdGroup);
									}				
								}else{
									$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$key2."')";
									$query = self::QuerySQL($strSQL);
									array_push($arrAttList, $key2.'-'.$IdGroup);
								}
								$Parrent_Group[] = $key2;
								$Parrent_Group_Id[] = $IdGroup;
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
												if(!in_array($val4['key'].'-'.$id,$arrAttList)){
													$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$val4['key']."')";
													$query = self::QuerySQL($strSQL);
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
								$ParrentID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$Parrent_Group_Id[$i]."' AND NAME = '".$Parrent_Group[$i]."'");
								$GroupID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$Parrent_Group_Id[$i+1]."' AND NAME = '".$key2."'");
								$i++;
								if(count($val2) > 0){
									foreach($val2 as $key3=>$val3){
										if(count($val3) > 0){
											foreach($val3 as $key4=>$val4){
												$KeyID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE NAME = '".$val4['key']."' LIMIT 1");
												$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParrentID[0]['ID'].'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val4['value'];
												if(!in_array($strChk, $arrchkDup)){
													$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,PARENT_GROUP_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$ParrentID[0]['ID']."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".$val4['value']."')";
													self::QuerySQL($strSQL);
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
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}
					
					$GroupID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".$arr['head'][0]."'");
					
					$ParrentID = '';
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(is_array($val2) > 0){
									foreach($val2 as $key3=>$val3){
										$Entry_id = null;
										switch($key3){
											 case 'IP Address' :
												 $id = $IdIP;
											 break;
											 case 'MAC Address' : 
												 $id = $IdMac;
											 break;
											 default : $id = $IdOther;	 
										}
										if(isset($arrAttList[0])){
											if(!in_array($key3.'-'.$id,$arrAttList)){
												$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key3."')";
												$query = self::QuerySQL($strSQL);
												array_push($arrAttList, $key3.'-'.$id);
											}				
										}else{
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key3."')";
											$query = self::QuerySQL($strSQL);
											array_push($arrAttList, $key3.'-'.$id);
										}
										$KeyID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".$key3."'");
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParrentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val3;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".$val3."')";
											self::QuerySQL($strSQL);
											array_push($arrchkDup, $strChk);
										}
									}
								}else{
									$Entry_id = $key+1;
									switch($key2){
										case 'IP Address' :
											$id = $IdIP;
										break;
										case 'MAC Address' : 
											$id = $IdMac;
										break;
										default : $id = $IdOther;	
									}
									if(isset($arrAttList[0])){
										if(!in_array($key2.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key2."')";
											$query = self::QuerySQL($strSQL);
											array_push($arrAttList, $key2.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key2."')";
										$query = self::QuerySQL($strSQL);
										array_push($arrAttList, $key2.'-'.$id);
									}
									$KeyID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".$key2."'");
									$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParrentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val2;
									if(!in_array($strChk, $arrchkDup)){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".$val2."')";
										self::QuerySQL($strSQL);
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
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}
					
					$GroupID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".$arr['head'][0]."'");
					$ParrentID = '';
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(is_array($val2) > 0){
									foreach($val2 as $key3=>$val3){
										$Entry_id = null;
										switch($key3){
											 case 'MAC' : 
												 $id = $IdMac;
											 break;
											 default : $id = $IdOther;	 
										}
										if(isset($arrAttList[0])){
											if(!in_array($key3.'-'.$id,$arrAttList)){
												$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key3."')";
												$query = self::QuerySQL($strSQL);
												array_push($arrAttList, $key3.'-'.$id);
											}				
										}else{
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key3."')";
											$query = self::QuerySQL($strSQL);
											array_push($arrAttList, $key3.'-'.$id);
										}
										$KeyID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".$key3."'");
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParrentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val3;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".$val3."')";
											self::QuerySQL($strSQL);
											array_push($arrchkDup, $strChk);
										}
									}
								}else{
									$Entry_id = $key+1;
									switch($key2){
										case 'MAC' : 
											$id = $IdMac;
										break;
										default : $id = $IdOther;	
									}
									if(isset($arrAttList[0])){
										if(!in_array($key2.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key2."')";
											$query = self::QuerySQL($strSQL);
											array_push($arrAttList, $key2.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key2."')";
										$query = self::QuerySQL($strSQL);
										array_push($arrAttList, $key2.'-'.$id);
									}
									$KeyID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".$key2."'");
									$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParrentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val2;
									if(!in_array($strChk, $arrchkDup)){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".$val2."')";
										self::QuerySQL($strSQL);
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
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}
					
					$GroupID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".$arr['head'][0]."'");
					
					$ParrentID = '';
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(is_array($val2) > 0){
									foreach($val2 as $key3=>$val3){
										$Entry_id = null;
										switch($key3){
											case 'Far End' : 
												$id = $IdIP;
											break;
											default : $id = $IdOther;	 
										}
										if(isset($arrAttList[0])){
											if(!in_array($key3.'-'.$id,$arrAttList)){
												$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key3."')";
												$query = self::QuerySQL($strSQL);
												array_push($arrAttList, $key3.'-'.$id);
											}				
										}else{
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key3."')";
											$query = self::QuerySQL($strSQL);
											array_push($arrAttList, $key3.'-'.$id);
										}
										$KeyID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".$key3."'");
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParrentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val3;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".$val3."')";
											self::QuerySQL($strSQL);
											array_push($arrchkDup, $strChk);
										}
									}
								}else{
									$Entry_id = $key+1;
									switch($key2){
										case 'Far End' : 
											$id = $IdIP;
										break;
										default : $id = $IdOther;	
									}
									if(isset($arrAttList[0])){
										if(!in_array($key2.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key2."')";
											$query = self::QuerySQL($strSQL);
											array_push($arrAttList, $key2.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key2."')";
										$query = self::QuerySQL($strSQL);
										array_push($arrAttList, $key2.'-'.$id);
									}
									$KeyID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".$key2."'");
									$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParrentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val2;
									if(!in_array($strChk, $arrchkDup)){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".$val2."')";
										self::QuerySQL($strSQL);
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
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}
					
					$GroupID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".$arr['head'][0]."'");
					
					$ParrentID = '';
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(is_array($val2) > 0){
									foreach($val2 as $key3=>$val3){
										$Entry_id = null;
										if(isset($arrAttList[0])){
											if(!in_array($key3.'-'.$id,$arrAttList)){
												$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key3."')";
												$query = self::QuerySQL($strSQL);
												array_push($arrAttList, $key3.'-'.$id);
											}				
										}else{
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key3."')";
											$query = self::QuerySQL($strSQL);
											array_push($arrAttList, $key3.'-'.$id);
										}
										$KeyID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".$key3."'");
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParrentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val3;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".$val3."')";
											self::QuerySQL($strSQL);
											array_push($arrchkDup, $strChk);
										}
									}
								}else{
									$Entry_id = $key+1;
									if(isset($arrAttList[0])){
										if(!in_array($key2.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key2."')";
											$query = self::QuerySQL($strSQL);
											array_push($arrAttList, $key2.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key2."')";
										$query = self::QuerySQL($strSQL);
										array_push($arrAttList, $key2.'-'.$id);
									}
									$KeyID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".$key2."'");
									$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParrentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val2;
									if(!in_array($strChk, $arrchkDup)){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".$val2."')";
										self::QuerySQL($strSQL);
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
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}
					
					$GroupID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".$arr['head'][0]."'");
					$ParrentID = '';
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(is_array($val2) > 0){
									foreach($val2 as $key3=>$val3){
										$Entry_id = null;
										if(isset($arrAttList[0])){
											if(!in_array($key3.'-'.$id,$arrAttList)){
												$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key3."')";
												$query = self::QuerySQL($strSQL);
												array_push($arrAttList, $key3.'-'.$id);
											}				
										}else{
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key3."')";
											$query = self::QuerySQL($strSQL);
											array_push($arrAttList, $key3.'-'.$id);
										}
										$KeyID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".$key3."'");
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParrentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val3;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".$val3."')";
											self::QuerySQL($strSQL);
											array_push($arrchkDup, $strChk);
										}
									}
								}else{
									$Entry_id = $key+1;
									if(isset($arrAttList[0])){
										if(!in_array($key2.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key2."')";
											$query = self::QuerySQL($strSQL);
											array_push($arrAttList, $key2.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key2."')";
										$query = self::QuerySQL($strSQL);
										array_push($arrAttList, $key2.'-'.$id);
									}
									$KeyID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".$key2."'");
									$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParrentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val2;
									if(!in_array($strChk, $arrchkDup)){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".$val2."')";
										self::QuerySQL($strSQL);
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
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}
					
					$GroupID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".$arr['head'][0]."'");
					$ParrentID = '';
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key2=>$val2){
								if(is_array($val2) > 0){
									foreach($val2 as $key3=>$val3){
										$Entry_id = null;
										if(isset($arrAttList[0])){
											if(!in_array($key3.'-'.$id,$arrAttList)){
												$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key3."')";
												$query = self::QuerySQL($strSQL);
												array_push($arrAttList, $key3.'-'.$id);
											}				
										}else{
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key3."')";
											$query = self::QuerySQL($strSQL);
											array_push($arrAttList, $key3.'-'.$id);
										}
										$KeyID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".$key3."'");
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParrentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val3;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".$val3."')";
											self::QuerySQL($strSQL);
											array_push($arrchkDup, $strChk);
										}
									}
								}else{
									$Entry_id = $key+1;
									if(isset($arrAttList[0])){
										if(!in_array($key2.'-'.$id,$arrAttList)){
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key2."')";
											$query = self::QuerySQL($strSQL);
											array_push($arrAttList, $key2.'-'.$id);
										}				
									}else{
										$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key2."')";
										$query = self::QuerySQL($strSQL);
										array_push($arrAttList, $key2.'-'.$id);
									}
									$KeyID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".$key2."'");
									$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParrentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val2;
									if(!in_array($strChk, $arrchkDup)){
										$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".$val2."')";
										self::QuerySQL($strSQL);
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
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}else{
						if(isset($arr['head'][0])){
							$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$IdGroup."','".$arr['head'][0]."')";
							$query = self::QuerySQL($strSQL);
							array_push($arrAttList, $arr['head'][0].'-'.$IdGroup);
						}
					}

					$GroupID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$IdGroup."' AND NAME = '".$arr['head'][0]."'");
					$ParrentID = '';
					foreach($arr['title'] as $key=>$val){
						if(count($val) > 0){
							foreach($val as $key5=>$val5){
								if(count($val5) > 0){
									foreach($val5 as $key2=>$val2){
										$Entry_id = $key+1;
										if(isset($arrAttList[0])){
											if(!in_array($key2.'-'.$id,$arrAttList)){
												$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key2."')";
												$query = self::QuerySQL($strSQL);
												array_push($arrAttList, $key2.'-'.$id);
											}				
										}else{
											$strSQL = "INSERT INTO ATTRIB_LIST (ATTRIB_TYPE_ID, NAME) VALUES('".$id."','".$key2."')";
											$query = self::QuerySQL($strSQL);
											array_push($arrAttList, $key2.'-'.$id);
										}
										$KeyID = self::LoadSQL("SELECT ID FROM ATTRIB_LIST WHERE ATTRIB_TYPE_ID = '".$id."' AND NAME = '".$key2."'");
										$strChk = $item['UPDATE_DATE'].'-'.$item['NE_RUN_TYPE_ID'].'-'.$item['ID'].'-'.$item['IP_ADDR'].'-'.$Entry_id.'-'.$ParrentID.'-'.$GroupID[0]['ID'].'-'.$KeyID[0]['ID'].'-'.$val2;
										if(!in_array($strChk, $arrchkDup)){
											$strSQL = "INSERT INTO NE_RUN_ATTRIB (UPDATE_DATE,NE_RUN_TYPE_ID,NE_RUN_DATA_ID,IP_ADDR,ENTRY_ID,GROUP_ID,ATTRIB_KEY_ID,ATTRIB_VALUE) VALUES ('".$item['UPDATE_DATE']."','".$item['NE_RUN_TYPE_ID']."','".$item['ID']."','".$item['IP_ADDR']."','".$Entry_id."','".$GroupID[0]['ID']."','".$KeyID[0]['ID']."','".$val2."')";
											self::QuerySQL($strSQL);
											array_push($arrchkDup, $strChk);
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
	
	private function splitLagDescription($data){
		$a = preg_split("/[\n,]+/",$data);
		$b = $a;
		foreach($a as $k=>$val){
			if(strpos($a[$k],"===============================================================================") > -1){
				if(strpos($a[$k+4],"===============================================================================") > -1){
					$arr['head'][] = trim($b[$k+1]);
					unset($b[$k]);
					unset($b[$k+1]);
					unset($b[$k+2]);
					unset($b[$k+3]);
					unset($b[$k+4]);
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
				if($chkspace && !preg_match("/[[:print:]]/",$val)) unset($b[$key]);
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
		$i = 0;
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
					if(preg_match("/[[:print:]]/",$val3)){
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
								if(!empty($val5)){
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
			}elseif((!preg_match("/[[:print:]]/",$val) || preg_match("/[[:blank:]]/",$val)) && $tk1){
				$firstRow = true;
				$i++;
			}
		}
		unset($c);
		return $arr;
	}

	private function splitServiceCustomer($data){
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
			if(!preg_match("/[[:print:]]/",$val)) $j++;
		}
		unset($c);
		return $arr;
	}

	private function splitServiceUsing($data){
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
}

$run = new RunlogCommand($arr);
$runlog = $run->index($argv[1],$argv[2]);
?>