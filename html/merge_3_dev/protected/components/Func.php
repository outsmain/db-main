<?php
class Func {
	public function page_header($menu=array(), $parent_id=0){
		if(!empty($menu[$parent_id])){
			if($parent_id==0)
				echo '<ul class="sf-menu mobile-hide row clearfix">';
				else
				echo '<ul>';
			foreach($menu[$parent_id] as $item){
				$l_url = Yii::app()->request->baseUrl."/".$item['NAME'];
				echo '<li>';
				echo "<a href=\"{$l_url}\">",$item['TITLE'],'</a>';
				self::page_header($menu,$item['ID']); // It's a recursive.
				echo '</li>';
			}
			echo '</ul>';
		}
	}

	public function display_menus($username){
		//global $connection;
		$connection = Yii::app()->db;
		$menu = array();
		$sql = "SELECT c.* FROM username a JOIN groupauthorize b ON (a.`GROUPNAME_ID`=b.`GROUPNAME_ID`)
		JOIN pagename c ON (b.`PAGENAME_ID`=c.`ID`) WHERE a.name='{$username}' ORDER BY PREVPAGE";
		$command = $connection->createCommand($sql);
		$dataReader = $command->query();
		
		foreach ($dataReader as $row) { 
			if(empty($row['PREVPAGE']))
				$menu[0][]=$row;
			else
				$menu[$row['PREVPAGE']][]=$row;
		}
		
		self::page_header($menu);
	}
	public function checkRule($url,$username){
		$connection = Yii::app()->db;
		$sql = "SELECT c.* FROM username a JOIN groupauthorize b ON (a.`GROUPNAME_ID`=b.`GROUPNAME_ID`)
		JOIN pagename c ON (b.`PAGENAME_ID`=c.`ID`) WHERE a.name='{$username}' ORDER BY PREVPAGE";
		$command = $connection->createCommand($sql);
		$dataReader = $command->query();
		
		foreach ($dataReader as $row) { 
			$allow_url = Yii::app()->request->baseUrl."/".$row['NAME'];
				if($allow_url == $url){
					$p_allow = "allow";
				}else{
					$p_allow ="not_allow";
				}
				if($p_allow == "allow"){
					$p_allow = "allow";
					break;
				}
			}
			
		return $p_allow;
		
		}
	public function resetPassword($user,$pass){
	
		$connection = Yii::app()->db;
		
		$sql = "UPDATE  USERNAME SET PASSWORD ='{$pass}' WHERE NAME = '{$user}' ";
		$command = $connection->createCommand($sql);
		$dataReader = $command->query();
		
		}
	
	
	public function add_logtime($username)
	{	
		$connection = Yii::app()->db;	
		$ip_address=$_SERVER['REMOTE_ADDR'];
		$log_date=date('Y-m-d H:i:s'); 
		$sql = "UPDATE USERNAME SET LAST_LOGIN_DATE = '".$log_date."',LAST_LOGIN_IP = '".$ip_address."' WHERE NAME = '".$username."'";
		$command = $connection->createCommand($sql);
		$dataReader = $command->query();
	}
	public function add_loglogin($username,$status,$action)
	{	
		$connection = Yii::app()->db;	
		$ip_address=$_SERVER['REMOTE_ADDR'];
		$log_date=date('Y-m-d H:i:s'); 
		$sql = "INSERT INTO LOGIN_LOG (UPDATE_DATE,USER_NAME,USER_IP,CLIENT_NAME,COMMAND,VALUE,STATUS) VALUES('{$log_date}','{$username}','{$ip_address}',
				'','$action','','{$status}')";
		$command = $connection->createCommand($sql);
		$dataReader = $command->query();
	}
	
	public function add_loglogmodify($username,$status,$action,$value)
	{	
		$connection = Yii::app()->db;	
		$ip_address=$_SERVER['REMOTE_ADDR'];
		$log_date=date('Y-m-d H:i:s'); 
		$sql = "INSERT INTO LOGIN_LOG (UPDATE_DATE,USER_NAME,USER_IP,CLIENT_NAME,COMMAND,VALUE,STATUS) VALUES('{$log_date}','{$username}','{$ip_address}',
				'','$action','{$value}','{$status}')";
		$command = $connection->createCommand($sql);
		$dataReader = $command->query();
	}

	public static  function redirect_page($username){
		$connection = Yii::app()->db;
		$sql = "SELECT c.* FROM username a JOIN groupauthorize b ON (a.`GROUPNAME_ID`=b.`GROUPNAME_ID`) JOIN pagename c ON (b.`PAGENAME_ID`=c.`ID`) WHERE a.name='{$username}' ORDER BY PREVPAGE ASC  LIMIT 0,1";
		$command = $connection->createCommand($sql);
		$dataReader = $command->query();
		foreach ($dataReader as $row) { 
		$reurl = $row['NAME'];					
		}	
		return $reurl;
		}
	
	public static  function to_edit($username){
		$connection = Yii::app()->db;
		$sql = "SELECT * FROM USERNAME WHERE NAME = '{$username}'";
		$command = $connection->createCommand($sql);
		$dataReader = $command->query();
		
		foreach ($dataReader as $row) { 
		
		$user_id = $row['ID'];	
				
	}
		return $user_id;
	}
	
	public function checkAccess($username){
	
			$date_ow1 = date('l');
			$time_now = date('H:i:s');
			$date_ow = strtoupper($date_ow1);
			$ip_address=$_SERVER['REMOTE_ADDR'];
			$row=Yii::app()->db->createCommand("SELECT DISTINCT  c.* FROM username a JOIN ACCESSGROUP b ON (a.`ACCESSGROUP_ID`=b.`ACCESSGROUP_ID`) 
												JOIN ACCESSNAME c ON (b.`ACCESSNAME_ID`=c.`ID`) WHERE a.`NAME` ='{$username}'")->queryAll();
			foreach($row as $item){
				$dow = $item['DOW'];
				$ip = $item['ALLOWIP'];			 	
				$st_time = $item['STARTTIME'];
				$ed_time = $item['ENDTIME'];
				$ip = $item['ALLOWIP'];			 	
				$pattern ="'".str_replace('%','.',$ip)."'";
				$show=explode(",",$dow);
					if((($time_now >= $st_time)&&($time_now <= $ed_time)&&(in_array($date_ow,$show)))&&(preg_match("'".str_replace('%','.',$ip)."'",$ip_address))){
						$acc_time = "no";
						}else if(!(($time_now >= $st_time)&&($time_now <= $ed_time)&&(in_array($date_ow,$show)))){
								$acc_time = "ok";
							}	
						else if(!(preg_match("'".str_replace('%','.',$ip)."'",$ip_address))){
								$acc_time = "ip";
							}
						if($acc_time == "no"){
							$acc_time ="no";
							break;
				}
					
			}	
			return $acc_time;
		}
		
	public function checkAllowip($username){
	
			$ip_address=$_SERVER['REMOTE_ADDR'];
			$row=Yii::app()->db->createCommand("SELECT DISTINCT  c.* FROM username a JOIN ACCESSGROUP b ON (a.`ACCESSGROUP_ID`=b.`ACCESSGROUP_ID`) 
												JOIN ACCESSNAME c ON (b.`ACCESSNAME_ID`=c.`ID`) WHERE a.`NAME` ='{$username}'")->queryAll();
			
				foreach($row as $item){
				$ip = $item['ALLOWIP'];			 	
				$pattern ="'".str_replace('%','.',$ip)."'";
				if(!(preg_match("'".str_replace('%','.',$ip)."'",$ip_address))) {
					$re_ip  = "ok";
				}else {
				$re_ip = "no";
				
				if($re_ip == "no"){
					$re_ip ="no";
				break;
				}
				}
			}
			return $re_ip;
		}
		
	public function checkWeek($asat){
			$week = array(Mon,Tue,Wed,Thu,Fri,Sat,Sun);
			if(in_array(MONDAY,$asat)){
				$s_week[0] =1;
			}else {
				$s_week[0] =0;
			}if(in_array(TUESDAY,$asat)){
				$s_week[1] =1;
			}else {
				$s_week[1] =0;
			}if(in_array(WEDNESDAY,$asat)){
				$s_week[2] =1;
			}else {
				$s_week[2] =0;
			}if(in_array(THURSDAY,$asat)){
				$s_week[3] =1;
			}else {
				$s_week[3] =0;
			}if(in_array(FRIDAY,$asat)){
				$s_week[4] =1;
			}else {
				$s_week[4] =0;
			}if(in_array(SATURDAY,$asat)){
				$s_week[5] =1;
			}else {
				$s_week[5] =0;
			}if(in_array(SUNDAY,$asat)){
				$s_week[6] =1;
			}else {
				$s_week[6] =0;
						}
			$i = 0;
			foreach($s_week as $key=>$value){
				if($value == 1){
					$arr[$i][] = $key;
				}else{
					$i++;
				}
			}
			$str = '';
			foreach($arr as $key=>$value){
				if(count($arr[$key]) > 1){
					$str .= $week[$arr[$key][0]].'-'.$week[$arr[$key][(count($arr[$key])-1)]].',';
				}else{
					$str .= $week[$arr[$key][0]].',';
				}
			}
			$str = substr($str,0,-1);
			return $str;
		}
		
		public function addToarr($do,$i){
	
			$arr[$i] = $do;
			return $re_ip;
		}
		
	public function checkGrouptime($times){
		
		$combined = array();
		$i = 0;
		$combined[0] = array_shift($times);
		foreach($times AS $time){
			$pass = false;
			if($combined[$i]['end']>=$time['start']){
				$combined[$i]['end'] = $time['end'];
				$pass = true;
			}
			if($combined[$i]['start']>=$time['start']){
				$combined[$i]['start'] = $time['start'];
				$pass = true;
			}
			if(!$pass){
				$i++;
				$combined[$i] = $time;
			}
		}

		//print_r($combined);
		$j=0;
	//	echo $dd =  strtotime('23:00:00');
		//echo date('H:i:s', $dd );
	foreach($combined as $pri){
		
	
	 if($j == 0){
			$showtime .= date('H:i',$combined[$j]['start']).'-'.date('H:i',$combined[$j]['end']);
		}else{
		 $showtime .= ','.date('H:i',$combined[$j]['start']).'-'.date('H:i',$combined[$j]['end']);
		 }
		$j++;
	}

	return $showtime;
			}
		
	public function creatArray($strtime,$edtime){
	
		$times = array();
		$i=0;
		foreach($strtime as $rs){
	//	array_push($times,array('start'=>$strtime[$i],'end'=>$edtime[$i]));
		array_push($times,array('start'=>strtotime($strtime[$i]),'end'=>strtotime($edtime[$i])));
			$i++;
		}

	return $times;
			}	
			
			
	public function ssss($id){

		$row_id =Yii::app()->db->createCommand(" SELECT * FROM ACCESSGROUP a
		LEFT JOIN ACCESSNAME b ON ( a.ACCESSNAME_ID = b.ID ) WHERE ACCESSGROUP_ID = '{$id}'")->queryAll();
		
			foreach($row_id as $item_id){
			
			$bst2 = $item_id['ENDTIME'];
			$do2 = substr($bst2,0,5);	
			$bst = $item_id['STARTTIME'];
			//$do = substr($bst,0,5);		
			$arrst = explode(",",$do);
			
			$tim = $do.','.$do2.','.$tim;	

			$bdow = $item_id['DOW'];	
			$sdow = explode(",",$edow);
			//$ssdow = explode(",",$bdow);

			$tim2 = $bdow.','.$tim2;	
			$starttime .= $bst.',';
			$endtime .= $bst2.',';
			$asat = explode(",",$tim2);			
			$strtime = explode(",",$starttime);
			$edtime = explode(",",$endtime);
		}
			array_pop($strtime);
			array_pop($edtime);
			$result_day =  Func::checkWeek($asat);
			$result_arr =  Func::creatArray($strtime,$edtime);
			$result_time =  Func::checkGrouptime($result_arr);
			
			return $result_day.'@'.$result_time;
	
	}
	
	
}
?>
