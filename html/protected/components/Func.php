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
	/* public static function change_profile($name,$full_name,$comment,$password,$email,$id){
	$connection = Yii::app()->db;
			$sql = "UPDATE USERNAME SET NAME = '{$name}',FULL_NAME = '{$full_name}',COMMENT = '{$comment}',PASSWORD = '{$password}',EMAIL = '{$email}'
			WHERE ID = '{$id}'";
			$command = $connection->createCommand($sql);
			$dataReader = $command->query();
			} */
}
?>
