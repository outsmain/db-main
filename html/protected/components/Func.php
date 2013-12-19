<?php
class Func {
	public function page_header($menu=array(), $parent_id=0){
		if(!empty($menu[$parent_id])){
			if($parent_id==0)
				echo '<ul class="sf-menu mobile-hide row clearfix">';
				else
				echo '<ul>';
			foreach($menu[$parent_id] as $item){
				echo '<li>';
				echo "<a href=\"{$item['NAME']}\">",'<span>',$item['TITLE'],'</span></a>';
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
		
			$row=Yii::app()->db->createCommand("SELECT DISTINCT  c.* FROM username a JOIN ACCESSGROUP b ON (a.`ACCESSGROUP_ID`=b.`ACCESSGROUP_ID`) 
												JOIN ACCESSNAME c ON (b.`ACCESSNAME_ID`=c.`ID`) WHERE a.`NAME` ='{$username}'")->queryAll();
			//print_r($row);
			foreach($row as $item){
				$dow = $item['DOW'];
				$ip = $item['ALLOWIP'];			 	
				$st_time = $item['STARTTIME'];
				$ed_time = $item['ENDTIME'];
				$show=explode(",",$dow);

					if(($time_now >= $st_time)&&($time_now <= $ed_time)&&(in_array($date_ow,$show))){
						$acc_time = "no";
						break;
						}
						else{
						$acc_time = "ok";
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
				if(!(preg_match($pattern,$ip_address))) {
				$re_ip  = "ok";
				}else {
				$re_ip = "no";
				}
				if($re_ip == "no"){
				$re_ip ="no";
				}
			}
			return $re_ip;
		}
}
?>
