<?php
class LogdataCommand extends CConsoleCommand
{
    public function actionIndex($startdate,$enddate,$ipadd="") {
	
		require_once('libgit/Git.php');
		$repo = Git::open('gitdata'); //path of repositories
		$repo->run(' config  user.email "nueng.me@gmail.com"');
		$repo->run(' config  user.name "nuengcpe"');	
		$sql ="SELECT IP_ADDR,DATA FROM NE_CONF_LOG WHERE UPDATE_DATE >= '$startdate' AND UPDATE_DATE <= '$enddate' ";
		if($ipadd != ""){
		$sql .= " AND IP_ADDR = '$ipadd'";
		}
		$i=0;
		$dataReader = Yii::app()->db->createCommand($sql)->query();
		foreach ($dataReader as $row) {
		
			$ip_a =  $row['IP_ADDR'];
			$data_line =  $row['DATA'];
			$strFileName = "gitdata/config-".$ip_a;
			$objFopen = fopen($strFileName, 'w');
			
			fwrite($objFopen, $data_line);
			fclose($objFopen);
			$i++;
			$filename ="config-".$ip_a;
			$repo->add($filename);  //git add 
			
		}
		$sql2 ="SELECT DISTINCT IP_ADDR FROM NE_CONF_LOG WHERE UPDATE_DATE >= '$startdate' AND UPDATE_DATE <= '$enddate' ";
		if($ipadd != ""){
		$sql2 .= " AND IP_ADDR = '$ipadd'";
		}
		$dataReader2 = Yii::app()->db->createCommand($sql2)->query();
		$k=0;
		foreach($dataReader2 as $item){
			$k++;
		}
	$u_date = date('Y-m-d H:i:s');
 	$subcommit = " commit -am \"Updated ".$k." NEs config between ". $startdate ." - ".$enddate ."\""; //commit to github
	$repo->run($subcommit);// commit to github
	
	$sql3 ="SELECT DISTINCT IP_ADDR FROM NE_CONF_LOG WHERE UPDATE_DATE >= '$startdate' AND UPDATE_DATE <= '$enddate' ";
		if($ipadd != ""){
		$sql3 .= " AND IP_ADDR = '$ipadd'";
		}
		$dataReader3 = Yii::app()->db->createCommand($sql3)->query();
		foreach($dataReader3 as $item3){
		$ip_add =  $item3['IP_ADDR'];
		$fname ="config-".$ip_add;
		$cmdlog =" log -p ".$fname;
		$log = $repo->run($cmdlog);
		$sub_index = strchr($log, "index");
		$sub_hash = substr($sub_index,15,7); 
		$sqlUP = "UPDATE  NE_CONF_LOG SET INDEX_HASH ='{$sub_hash}' WHERE IP_ADDR = '{$ip_a}' AND  UPDATE_DATE >= '$startdate' AND UPDATE_DATE <= '$enddate' ";
		$dataUPDATE = Yii::app()->db->createCommand($sqlUP)->query();	
			}

	}

	public function actionChangelog($startdate,$enddate,$ipadd="") {
	
		$sql ="SELECT * FROM NE_CONF_LOG WHERE UPDATE_DATE >= '$startdate' AND UPDATE_DATE <= '$enddate' AND INDEX_HASH != '' ";
		if($ipadd != ""){
		$sql .= " AND IP_ADDR = '$ipadd'";
		}
	//	echo $sql;
		$dataReader = Yii::app()->db->createCommand($sql)->query();
		foreach($dataReader as $row){
			$up_date = $row['UPDATE_DATE'];
			$ip_addr =$row['IP_ADDR'];
			$in_hash = $row['INDEX_HASH'];
			$id = $row['ID'];
			$sql2 ="SELECT * FROM NE_CONF_LOG a JOIN NE_LIST b ON (a.`IP_ADDR`=b.`ip_addr`) WHERE a.IP_ADDR ='$ipadd'";
			$dataReader2 = Yii::app()->db->createCommand($sql2)->query();
			
				if((preg_match('/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/',$ip_addr))||($dataReader2)) { 
					
					$sql3 ="SELECT * FROM NE_CONF_LOG WHERE  IP_ADDR= '$ip_addr' and ID < '$id' order by ID DESC LIMIT 1";	
					$dataReader3 = Yii::app()->db->createCommand($sql3)->query();
					
						foreach($dataReader3 as $item){
						$old_id = $item['ID'];
						$old_hash =$item['INDEX_HASH'];
						$old_date =$item['UPDATE_DATE'];
						
						if($in_hash!=$old_hash){
						
						$strinsert ="INSERT INTO NE_CHNG_LOG (PREV_DATE,CURR_DATE,IP_ADDR,CURR_INDEX_HASH,PREV_INDEX_HASH,EVENT_TYPE,EVENT_NAME,COMMENT) 
						VALUES('$old_date','$up_date','$ip_addr','$in_hash','$old_hash','','','')";
						$dataReader5 = Yii::app()->db->createCommand($strinsert)->query();
						}
				}	
			}
		
		}

	}
}

?>