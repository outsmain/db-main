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
		$ex = explode(' ',$_GET['start_date']);
		$exp = explode('-',$ex[0]);
		$start_date = $exp[2].'-'.$exp[1].'-'.$exp[0].' '.$ex[1];
		$ex = explode(' ',$_GET['end_date']);
		$exp = explode('-',$ex[0]);
		$end_date = $exp[2].'-'.$exp[1].'-'.$exp[0].' '.$ex[1];
		
		$strUsername = '';
		$strEvent = '';
		$strNodeName = '';
		$strNodeIp = '';
		$strDate = '';
		if(!empty($_GET['username'])){
			$user = explode(',',$_GET['username']);
			$str = '';
			foreach($user as $item){
				$str .= "'".trim($item)."',";
			}
			$str = '('.substr($str,0,-1).')';
			$strUsername = 'AND a.user_name IN '.$str;
		}
		if(!empty($_GET['event'])){
			$strEvent = "AND a.status LIKE '%".$_GET['event']."'";
		}
		if(!empty($_GET['ne_name'])){
			$ne_name = explode(',',$_GET['ne_name']);
			foreach($ne_name as $item){
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
				$strNodeName = 'AND a.node_name IN '.$strNodeName;
			}
			if(!empty($strNodeIp)){
				$strNodeIp = '('.substr($strNodeIp,0,-1).')';
				$strNodeIp = 'AND a.node_ip IN '.$strNodeIp;
			}
		}
		
		$aaData = array();
		$aColumns = array('a.login_date','a.node_name','a.node_ip','a.user_name','a.user_ip','a.cmd');
		$sWhere = "";
		if(isset($_GET['sSearch']) && $_GET['sSearch'] != ""){
			$sWhere = "AND (";
			for ($i=0;$i<count($aColumns);$i++){
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch'])."%' OR ";
			}
			$sWhere = substr_replace($sWhere, "", -3);
			$sWhere .= ')';
		}
		
		/* Individual column filtering */
		for($i=0;$i<count($aColumns);$i++){
			if(isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != ''){
				if ($sWhere == ""){
					$sWhere = "AND ";
				}else{
					$sWhere .= " AND ";
				}
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}
		
		$sOrder = "";
		if(isset( $_GET['iSortCol_0'])){
			$sOrder = "ORDER BY  ";
			for($i=0;$i<intval($_GET['iSortingCols']);$i++){
				if($_GET['bSortable_'.intval($_GET['iSortCol_'.$i])] == "true"){
					$sOrder .= $aColumns[intval($_GET['iSortCol_'.$i])]." ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
				}
			}
			
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "ORDER BY UNIX_TIMESTAMP(a.login_date) desc";
			}
		}

		if((strtotime(date('d-m-Y')) == strtotime($_GET['start_date'])) && empty($_GET['username']) && empty($_GET['ne_name']) && empty($_GET['event']) && $_GET['click'] === 'false'){
			$sql = "SELECT DATE_FORMAT(a.login_date,'%d %b %Y %H:%i:%s') AS login_date,a.node_name,a.node_ip,a.user_name,a.user_ip,a.cmd FROM NE_AUTHACCT a, (SELECT MAX(login_date) AS MaxDate FROM NE_AUTHACCT) b WHERE UNIX_TIMESTAMP(DATE(a.login_date)) = UNIX_TIMESTAMP(DATE(b.MaxDate)) ";
			$sql .= $sWhere;
			$sql .= $sOrder;
			if(isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1'){
				$sql .= " LIMIT ".(intval($_GET['iDisplayStart']).", ".intval($_GET['iDisplayLength']));
			}
			$query = Yii::app()->db->createCommand($sql)->queryAll();
			foreach ($query as $k=>$row) {
				$i = 0;
				foreach($row as $j=>$v){
					$aaData[$k][$i] = $v;
					$i++;
				}
			}
			$sql = "SELECT COUNT(*) AS cnt FROM NE_AUTHACCT"; 
			$query = Yii::app()->db->createCommand($sql)->queryAll();
			$n = $query[0]['cnt'];
		}else{
			$sql = "SELECT DATE_FORMAT(a.login_date,'%d %b %Y %H:%i:%s') AS login_date,a.node_name,a.node_ip,a.user_name,a.user_ip,a.cmd FROM NE_AUTHACCT a
			WHERE UNIX_TIMESTAMP(a.login_date) >= UNIX_TIMESTAMP('".$start_date."') AND UNIX_TIMESTAMP(a.login_date) <= UNIX_TIMESTAMP('".$end_date."') ".$strEvent." ".$strNodeName." ".$strNodeIp." ".$strUsername;
			$sql .= $sWhere;
			$sql .= $sOrder;
			if(isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1'){
				$sql .= " LIMIT ".(intval($_GET['iDisplayStart']).", ".intval($_GET['iDisplayLength']));
			}
			$query = Yii::app()->db->createCommand($sql)->queryAll();
			foreach ($query as $k=>$row) {
				$i = 0;
				foreach($row as $j=>$v){
					$aaData[$k][$i] = $v;
					$i++;
				}
			}
			$sql = "SELECT COUNT(*) AS cnt FROM NE_AUTHACCT a
			WHERE UNIX_TIMESTAMP(a.login_date) >= UNIX_TIMESTAMP('".$start_date."') AND UNIX_TIMESTAMP(a.login_date) <= UNIX_TIMESTAMP('".$end_date."') ".$strEvent." ".$strNodeName." ".$strNodeIp." ".$strUsername;
			$sql .= $sWhere;
			$query = Yii::app()->db->createCommand($sql)->queryAll();
			$n = $query[0]['cnt'];
		}
		
		$arrData = array('sEcho'=>$_GET['sEcho'], 'iTotalRecords'=>$n, 'iTotalDisplayRecords'=>$n, 'aaData'=>$aaData);
		echo CJSON::encode($arrData);
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