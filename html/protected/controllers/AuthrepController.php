<?php

class AuthrepController extends Controller
{
	public function filters(){
		return array('ajaxOnly + field');
	}

	public function actionIndex($serv=null)
	{
		$model = new AuthForm;
		$this->render('index',array('model'=>$model));
	}

	public function actionOnline()
	{
		$ex = explode(' ',$_POST['start_date']);
		$exp = explode('-',$ex[0]);
		$start_date = $exp[2].'-'.$exp[1].'-'.$exp[0].' '.$ex[1];
		$ex = explode(' ',$_POST['end_date']);
		$exp = explode('-',$ex[0]);
		$end_date = $exp[2].'-'.$exp[1].'-'.$exp[0].' '.$ex[1];
		
		$strUsername = '';
		$strEvent = '';
		$strNodeName = '';
		$strNodeIp = '';
		$strDate = '';
		if(!empty($_POST['username'])){
			$user = explode(',',$_POST['username']);
			$str = '';
			foreach($user as $item){
				$str .= "'".trim($item)."',";
			}
			$str = '('.substr($str,0,-1).')';
			$strUsername = 'a.user_name IN '.$str;
		}
		if(!empty($_POST['event'])){
			$strEvent = "a.status LIKE '%".$_POST['event']."'";
		}
		if(!empty($_POST['ne_name'])){
			$node = explode(',',$_POST['ne_name']);
			foreach($node as $item){
				$long = ip2long(trim($item));
				if ($long == -1 || $long === FALSE) {
					$strNodeName .= "'".trim($item)."',";
				}else{
					$strNodeIp .= "'".trim($item)."',";
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
		if(empty($_POST['username']) && empty($_POST['ne_name']) && empty($_POST['event']) && $_POST['click'] === 'false'){
			$row = Yii::app()->db->createCommand()
			->select("a.id,DATE_FORMAT(a.login_date,'%d %b %Y %H:%i:%s') AS login_date,a.node_name,a.node_ip,a.user_name,a.user_ip,a.cmd")
			->from('NE_AUTHACCT a, (SELECT MAX(login_date) AS MaxDate FROM NE_AUTHACCT) b')
			->where(array('and', "UNIX_TIMESTAMP(a.login_date) >= UNIX_TIMESTAMP(b.MaxDate)", "UNIX_TIMESTAMP(a.login_date) <= UNIX_TIMESTAMP(b.MaxDate)"))
			->order('UNIX_TIMESTAMP(a.login_date) desc')
			->queryAll();
		}else{
			$row = Yii::app()->db->createCommand()
			->select("a.id,DATE_FORMAT(a.login_date,'%d %b %Y %H:%i:%s') AS login_date,a.node_name,a.node_ip,a.user_name,a.user_ip,a.cmd")
			->from('NE_AUTHACCT a')
			->where(array('and', $strUsername, "UNIX_TIMESTAMP(a.login_date) >= UNIX_TIMESTAMP('".$start_date."')", "UNIX_TIMESTAMP(a.login_date) <= UNIX_TIMESTAMP('".$end_date."')", $strEvent, $strNodeName, $strNodeIp))
			->order('UNIX_TIMESTAMP(a.login_date) desc')
			->queryAll();
		}	
		echo CJSON::encode($row);
			 /* $sql = "SELECT
					  a.login_date,a.node_name,a.node_ip,a.user_name,a.user_ip,a.cmd 
					FROM
					  tbl_authacct a
					WHERE a.user_name = '".$_POST['username']."' 
					  AND UNIX_TIMESTAMP(a.login_date) <= UNIX_TIMESTAMP('".$_POST['end_date']."') 
					  AND UNIX_TIMESTAMP(a.login_date) >= UNIX_TIMESTAMP('".$_POST['start_date']."')
					  AND a.user_ip = '".$_POST['ne_name']."'";
			$count = Yii::app()->db->createCommand("SELECT
					  COUNT(*)
					FROM
					  tbl_authacct a
					WHERE a.user_name = '".$_POST['username']."' 
					  AND UNIX_TIMESTAMP(a.login_date) <= UNIX_TIMESTAMP('".$_POST['end_date']."') 
					  AND UNIX_TIMESTAMP(a.login_date) >= UNIX_TIMESTAMP('".$_POST['start_date']."')
					  AND a.user_ip = '".$_POST['ne_name']."'")->queryScalar();

			  $dataProvider = new CSqlDataProvider($sql, array(
			  'totalItemCount'=>$count,
			  'pagination' => array(
			  'pageSize' => 4,
			  ),
			  ));
			$this->widget('zii.widgets.grid.CGridView', array(
				'id' => 'dataTable',  
				'dataProvider' => $dataProvider,  
				'enablePagination' => true,  
			'columns' => array(   
				array(
					'name' => 'login_date',
					'header' => 'Login Date',
				),
				array(
					'name' => 'node_name',
					'header' => 'Node Name',
				),
				array(
					'name' => 'node_ip',
					'header' => 'Node IP',
				),
				array(
					'name' => 'user_name',
					'header' => 'User Name',
				),
				array(
					'name' => 'user_ip',
					'header' => 'User IP',
				),
				array(
					'name' => 'cmd',
					'header' => 'Command',
				),
			),
		));
		Yii::app()->end();
		$this->render('index',array('model'=>$model));*/
	}

	public function actionDetail()
	{
		$row = Yii::app()->db->createCommand()
			->select('b.*, DATE_FORMAT(b.add_date,"%d %b %Y %H:%i:%s") AS first_date, DATE_FORMAT(b.update_date,"%d %b %Y %H:%i:%s") AS sec_date')
			->from('NE_AUTHACCT a, NE_LIST b')
			->where(array("and", "a.id = '".$_POST['id']."'", "a.node_ip = b.ip_addr"))
			->queryAll();
		echo CJSON::encode($row);
	}
}