<?php

class AuthrepController extends Controller
{
	public function filters(){
		return array('ajaxOnly + field');
	}

	public function actionIndex()
	{
		$model = new NEAUTHACCT;
		$this->render('index',array('model'=>$model));
	}

	public function actionUser()
	{
		$model = new NEAUTHACCT;
		$this->render('index',array('model'=>$model));
	}

	public function actionLoadUser()
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
	}
	
	public function actionDevice()
	{
		$model = new NEAUTHSUM;
		$this->render('device',array('model'=>$model));
	}

	public function actionLoadDevice()
	{
		$ex = explode(' ',$_GET['start_date']);
		$exp = explode('-',$ex[0]);
		$start_date = $exp[2].'-'.$exp[1].'-'.$exp[0].' '.$ex[1];
		$ex = explode(' ',$_GET['end_date']);
		$exp = explode('-',$ex[0]);
		$end_date = $exp[2].'-'.$exp[1].'-'.$exp[0].' '.$ex[1];
		
		$strEvent = '';
		$strNodeName = '';
		$strNodeIp = '';
		$strDate = '';

		if(!empty($_GET['summary_type'])){
			$strEvent = "AND a.sum_dur = '".$_GET['summary_type']."'";
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
		$aColumns = array('a.update_date','a.last_login','a.node_name','a.node_ip','a.accept_num','a.reject_num','a.success_rate','a.login_rate','a.cmd_num','a.cmd_rate');
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
				$sOrder = "ORDER BY UNIX_TIMESTAMP(a.id) desc";
			}
		}

		if((strtotime(date('d-m-Y')) == strtotime($_GET['start_date'])) && ($_GET['summary_type'] == 'DAILY') && empty($_GET['ne_name']) && $_GET['click'] === 'false'){
			$sql = "SELECT DATE_FORMAT(a.update_date,'%d %b %Y %H:%i:%s') AS update_date,DATE_FORMAT(a.last_login,'%d %b %Y %H:%i:%s') AS last_login,IFNULL(a.node_name,'All') AS node_name,IFNULL(a.node_ip,'All') AS node_ip,CONCAT(a.accept_num,' / ',a.reject_num) AS login_num,a.success_rate,a.login_rate,a.cmd_num,a.cmd_rate FROM NE_AUTHSUM a, (SELECT MAX(update_date) AS MaxDate FROM NE_AUTHSUM) b WHERE UNIX_TIMESTAMP(DATE(a.update_date)) = UNIX_TIMESTAMP(DATE(b.MaxDate)) ";
			$sql .= $strEvent;
			$sql .= $sWhere;
			$sql .= $sOrder;
			if(isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1'){
				$sql .= " LIMIT ".(intval($_GET['iDisplayStart']).", ".intval($_GET['iDisplayLength']));
			}
			$query = Yii::app()->db->createCommand($sql)->queryAll();
			foreach ($query as $k=>$row) {
				$i = 0;
				foreach($row as $j=>$v){
					if($j === 'success_rate') $v = number_format($v,2);
					if($j === 'login_rate' || $j === 'cmd_rate') $v = number_format($v,3);
					$aaData[$k][$i] = $v;
					$i++;
				}
			}
			$sql = "SELECT COUNT(*) AS cnt FROM NE_AUTHSUM"; 
			$query = Yii::app()->db->createCommand($sql)->queryAll();
			$n = $query[0]['cnt'];
		}else{
			$sql = "SELECT DATE_FORMAT(a.update_date,'%d %b %Y %H:%i:%s') AS update_date,DATE_FORMAT(a.last_login,'%d %b %Y %H:%i:%s') AS last_login,IFNULL(a.node_name,'All') AS node_name,IFNULL(a.node_ip,'All') AS node_ip,CONCAT(a.accept_num,' / ',a.reject_num) AS login_num,a.success_rate,a.login_rate,a.cmd_num,a.cmd_rate FROM NE_AUTHSUM a WHERE UNIX_TIMESTAMP(a.update_date) >= UNIX_TIMESTAMP('".$start_date."') AND UNIX_TIMESTAMP(a.last_login) <= UNIX_TIMESTAMP('".$end_date."') ".$strEvent." ".$strNodeName." ".$strNodeIp;
			$sql .= $sWhere;
			$sql .= $sOrder;
			if(isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1'){
				$sql .= " LIMIT ".(intval($_GET['iDisplayStart']).", ".intval($_GET['iDisplayLength']));
			}
			$query = Yii::app()->db->createCommand($sql)->queryAll();
			foreach ($query as $k=>$row) {
				$i = 0;
				foreach($row as $j=>$v){
					if($j === 'success_rate') $v = number_format($v,2);
					if($j === 'login_rate' || $j === 'cmd_rate') $v = number_format($v,3);
					$aaData[$k][$i] = $v;
					$i++;
				}
			}
			$sql = "SELECT COUNT(*) AS cnt FROM NE_AUTHSUM a
			WHERE UNIX_TIMESTAMP(a.update_date) >= UNIX_TIMESTAMP('".$start_date."') AND UNIX_TIMESTAMP(a.last_login) <= UNIX_TIMESTAMP('".$end_date."') ".$strEvent." ".$strNodeName." ".$strNodeIp;
			$sql .= $sWhere;
			$query = Yii::app()->db->createCommand($sql)->queryAll();
			$n = $query[0]['cnt'];
		}
		
		$arrData = array('sEcho'=>$_GET['sEcho'], 'iTotalRecords'=>$n, 'iTotalDisplayRecords'=>$n, 'aaData'=>$aaData);
		echo CJSON::encode($arrData);
	}

	public function actionDetail()
	{
		$row = Yii::app()->db->createCommand()
			->select('b.*, DATE_FORMAT(b.add_date,"%d %b %Y %H:%i:%s") AS first_date, DATE_FORMAT(b.update_date,"%d %b %Y %H:%i:%s") AS sec_date')
			->from('NE_LIST b')
			->where("b.ip_addr = '".$_POST['ip']."'")
			->queryAll();
		echo CJSON::encode($row);
	}
}