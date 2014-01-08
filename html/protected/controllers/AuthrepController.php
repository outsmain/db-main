<?php

class AuthrepController extends Controller
{
	public function filters()
	{
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
		self::ClearTempFile();
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
			$strSQL = "SELECT DATE_FORMAT(a.login_date,'%d %b %Y %H:%i:%s') AS login_date,a.node_name,a.node_ip,a.user_name,a.user_ip,a.cmd FROM NE_AUTHACCT a, (SELECT MAX(login_date) AS MaxDate FROM NE_AUTHACCT) b WHERE UNIX_TIMESTAMP(DATE(a.login_date)) = UNIX_TIMESTAMP(DATE(b.MaxDate)) ";
			$strSQL .= $sWhere;
			$strSQL .= $sOrder;
			$tmpSQL = $strSQL;

			if(isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1'){
				$strSQL .= " LIMIT ".(intval($_GET['iDisplayStart']).", ".intval($_GET['iDisplayLength']));
			}
			$query = Yii::app()->db->createCommand($strSQL)->queryAll();
			foreach ($query as $k=>$row) {
				$i = 0;
				foreach($row as $j=>$v){
					$v = (empty($v)) ? '-' : $v;
					$aaData[$k][$i] = $v;
					$i++;
				}
			}
			$query = Yii::app()->db->createCommand($tmpSQL)->queryAll();
			$n = count($query);
		}else{
			$strSQL = "SELECT DATE_FORMAT(a.login_date,'%d %b %Y %H:%i:%s') AS login_date,a.node_name,a.node_ip,a.user_name,a.user_ip,a.cmd FROM NE_AUTHACCT a
			WHERE UNIX_TIMESTAMP(a.login_date) >= UNIX_TIMESTAMP('".$start_date."') AND UNIX_TIMESTAMP(a.login_date) <= UNIX_TIMESTAMP('".$end_date."') ".$strEvent." ".$strNodeName." ".$strNodeIp." ".$strUsername;
			$strSQL .= $sWhere;
			$strSQL .= $sOrder;
			$tmpSQL = $strSQL;

			if(isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1'){
				$strSQL .= " LIMIT ".(intval($_GET['iDisplayStart']).", ".intval($_GET['iDisplayLength']));
			}
			$query = Yii::app()->db->createCommand($strSQL)->queryAll();
			foreach ($query as $k=>$row) {
				$i = 0;
				foreach($row as $j=>$v){
					$v = (empty($v)) ? '-' : $v;
					$aaData[$k][$i] = $v;
					$i++;
				}
			}

			$query = Yii::app()->db->createCommand($tmpSQL)->queryAll();
			$n = count($query);
		}
		
		$arrData = array('sEcho'=>$_GET['sEcho'], 'iTotalRecords'=>$n, 'iTotalDisplayRecords'=>$n, 'aaData'=>$aaData, 'tmpSQL'=>$tmpSQL);
		echo CJSON::encode($arrData);
	}
	
	public function actionDevice()
	{
		$model = new NEAUTHSUM;
		self::ClearTempFile();
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
			$strSQL = "SELECT DATE_FORMAT(a.update_date,'%d %b %Y %H:%i:%s') AS update_date,DATE_FORMAT(a.last_login,'%d %b %Y %H:%i:%s') AS last_login,IFNULL(a.node_name,'All') AS node_name,IFNULL(a.node_ip,'All') AS node_ip,CONCAT(a.accept_num,' / ',a.reject_num) AS login_num,a.success_rate,a.login_rate,a.cmd_num,a.cmd_rate,id AS DT_RowId FROM NE_AUTHSUM a, (SELECT MAX(last_login) AS MaxDate FROM NE_AUTHSUM) b WHERE UNIX_TIMESTAMP(DATE(a.last_login)) = UNIX_TIMESTAMP(DATE(b.MaxDate)) ";
			$strSQL .= $strEvent;
			$strSQL .= $sWhere;
			$strSQL .= $sOrder;
			$tmpSQL = $strSQL;
 
			if(isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1'){
				$strSQL .= " LIMIT ".(intval($_GET['iDisplayStart']).", ".intval($_GET['iDisplayLength']));
			}
			$query = Yii::app()->db->createCommand($strSQL)->queryAll();
			foreach ($query as $k=>$row) {
				$i = 0;
				foreach($row as $j=>$v){
					if($j === 'update_date') $v = "<a href=javascript:OpenDialogBox('".$row['node_ip']."');>".$v."</a>";
					if($j === 'last_login') $v = "<a href=javascript:OpenDialogBox('".$row['node_ip']."');>".$v."</a>";
					if($j === 'node_name') $v = "<a href=javascript:OpenGraph('nodename','".$row['DT_RowId']."');>".$v."</a>";
					if($j === 'node_ip') $v = "<a href=javascript:OpenGraph('nodeip','".$row['DT_RowId']."');>".$v."</a>";
					if($j === 'login_num') $v = "<a href=javascript:OpenGraph('login_num','".$row['DT_RowId']."');>".$v."</a>";
					if($j === 'success_rate') $v = "<a href=javascript:OpenGraph('success_rate','".$row['DT_RowId']."');>".number_format($v,2)."</a>";
					if($j === 'login_rate')  $v = "<a href=javascript:OpenGraph('login_rate','".$row['DT_RowId']."');>".number_format($v,3)."</a>";
					if($j === 'cmd_num')  $v = "<a href=javascript:OpenGraph('cmd_num','".$row['DT_RowId']."');>".$v."</a>";
					if($j === 'cmd_rate')  $v = "<a href=javascript:OpenGraph('cmd_rate','".$row['DT_RowId']."');>".number_format($v,3)."</a>";
					if($i > 8){
						$aaData[$k][$j] = $v;
					}else{
						$aaData[$k][$i] = $v;
					}
					$i++;
				}
			}
			$query = Yii::app()->db->createCommand($tmpSQL)->queryAll();
			$n = count($query);
		}else{
			$strSQL = "SELECT DATE_FORMAT(a.update_date,'%d %b %Y %H:%i:%s') AS update_date,DATE_FORMAT(a.last_login,'%d %b %Y %H:%i:%s') AS last_login,IFNULL(a.node_name,'All') AS node_name,IFNULL(a.node_ip,'All') AS node_ip,CONCAT(a.accept_num,' / ',a.reject_num) AS login_num,a.success_rate,a.login_rate,a.cmd_num,a.cmd_rate,id AS DT_RowId FROM NE_AUTHSUM a WHERE UNIX_TIMESTAMP(a.last_login) >= UNIX_TIMESTAMP('".$start_date."') AND UNIX_TIMESTAMP(a.last_login) <= UNIX_TIMESTAMP('".$end_date."') ".$strEvent." ".$strNodeName." ".$strNodeIp;
			$strSQL .= $sWhere;
			$strSQL .= $sOrder;
			$tmpSQL = $strSQL;
		
			if(isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1'){
				$strSQL .= " LIMIT ".(intval($_GET['iDisplayStart']).", ".intval($_GET['iDisplayLength']));
			}
			$query = Yii::app()->db->createCommand($strSQL)->queryAll();
			foreach ($query as $k=>$row) {
				$i = 0;
				foreach($row as $j=>$v){
					if($j === 'update_date') $v = "<a href=javascript:OpenDialogBox('".$row['node_ip']."');>".$v."</a>";
					if($j === 'last_login') $v = "<a href=javascript:OpenDialogBox('".$row['node_ip']."');>".$v."</a>";
					if($j === 'node_name') $v = "<a href=javascript:OpenGraph('nodename','".$row['DT_RowId']."');>".$v."</a>";
					if($j === 'node_ip') $v = "<a href=javascript:OpenGraph('nodeip','".$row['DT_RowId']."');>".$v."</a>";
					if($j === 'login_num') $v = "<a href=javascript:OpenGraph('login_num','".$row['DT_RowId']."');>".$v."</a>";
					if($j === 'success_rate') $v = "<a href=javascript:OpenGraph('success_rate','".$row['DT_RowId']."');>".number_format($v,2)."</a>";
					if($j === 'login_rate')  $v = "<a href=javascript:OpenGraph('login_rate','".$row['DT_RowId']."');>".number_format($v,3)."</a>";
					if($j === 'cmd_num')  $v = "<a href=javascript:OpenGraph('cmd_num','".$row['DT_RowId']."');>".$v."</a>";
					if($j === 'cmd_rate')  $v = "<a href=javascript:OpenGraph('cmd_rate','".$row['DT_RowId']."');>".number_format($v,3)."</a>";
					if($i > 8){
						$aaData[$k][$j] = $v;
					}else{
						$aaData[$k][$i] = $v;
					}
					$i++;
				}
			}
			$query = Yii::app()->db->createCommand($tmpSQL)->queryAll();
			$n = count($query);
		}
		
		$arrData = array('sEcho'=>$_GET['sEcho'], 'iTotalRecords'=>$n, 'iTotalDisplayRecords'=>$n, 'aaData'=>$aaData, 'tmpSQL'=>$tmpSQL);
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

	public function actionUserExportExcel()
	{
		ini_set("memory_limit","512M");
		set_time_limit(0);
		$query = Yii::app()->db->createCommand($_POST['tmpSQL'])->queryAll();
		spl_autoload_unregister(array('YiiBase','autoload')); 
		$phpExcelPath = Yii::import('ext.phpexcel');
		include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
		$objPHPExcel = new PHPExcel();
		
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("")
		 ->setLastModifiedBy("")
		 ->setTitle("Report Authen Log By User")
		 ->setSubject("Report Authen Log By User")
		 ->setDescription("Report Authen Log By User")
		 ->setKeywords("Report Authen Log By User")
		 ->setCategory("Report Authen Log By User");
	
		// Add some data
		$objPHPExcel->getActiveSheet()->setTitle('User-1');
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$data = $objPHPExcel->setActiveSheetIndex(0);
		$data->setCellValue('A1', 'Login Date');
		$data->setCellValue('B1', 'Node Name');
		$data->setCellValue('C1', 'Node IP');
		$data->setCellValue('D1', 'User Name');
		$data->setCellValue('E1', 'User IP');
		$data->setCellValue('F1', 'Command');
		$k = $j = $i = 1;
		$n = 0;
		$chk = count($query);
		foreach($query as $row){
			++$k;
			if(is_integer($n/10000) && $n != 0){
				$objPHPExcel->createSheet();
				
				$data = $objPHPExcel->setActiveSheetIndex($j);
				$objPHPExcel->getActiveSheet()->setTitle('User-'.($j+1));
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
				$data->setCellValue('A1', 'Login Date');
				$data->setCellValue('B1', 'Node Name');
				$data->setCellValue('C1', 'Node IP');
				$data->setCellValue('D1', 'User Name');
				$data->setCellValue('E1', 'User IP');
				$data->setCellValue('F1', 'Command');
				$j++;
				$k = 2;
				$n - 1;
			}

			$data->setCellValue('A'.$k, (empty($row['login_date']))?'-':$row['login_date']);
			$data->setCellValue('B'.$k, (empty($row['node_name']))?'-':$row['node_name']);
			$data->setCellValue('C'.$k, (empty($row['node_ip']))?'-':$row['node_ip']);
			$data->setCellValue('D'.$k, (empty($row['user_name']))?'-':$row['user_name']);
			$data->setCellValue('E'.$k, (empty($row['user_ip']))?'-':$row['user_ip']);
			$data->setCellValue('F'.$k, (empty($row['cmd']))?'-':$row['cmd']);
			$n++;
			$i++;
		}

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Redirect output to a client’s web browser (Excel2007)
		$filename = "Report_user_".date("Y-m-d_H-i",time()).".xlsx"; 
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename);
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		
		self::CreateFileCheck('excel');
		
		spl_autoload_register(array('YiiBase','autoload'));
        Yii::app()->end();
	}

	public function actionDeviceExportExcel()
	{
		ini_set("memory_limit","512M");
		set_time_limit(0);
		$query = Yii::app()->db->createCommand($_POST['tmpSQL'])->queryAll();
		spl_autoload_unregister(array('YiiBase','autoload')); 
		$phpExcelPath = Yii::import('ext.phpexcel');
		include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
		$objPHPExcel = new PHPExcel();
		
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("")
		 ->setLastModifiedBy("")
		 ->setTitle("Report Authen Log By Device")
		 ->setSubject("Report Authen Log By Device")
		 ->setDescription("Report Authen Log By Device")
		 ->setKeywords("Report Authen Log By Device")
		 ->setCategory("Report Authen Log By Device");
	
		// Add some data
		$objPHPExcel->getActiveSheet()->setTitle('Device-1');
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		$data = $objPHPExcel->setActiveSheetIndex(0);
		$data->setCellValue('A1', 'Update Date');
		$data->setCellValue('B1', 'Last Login');
		$data->setCellValue('C1', 'Node Name');
		$data->setCellValue('D1', 'Node IP');
		$data->setCellValue('E1', 'Login Num (Acp/Rej)');
		$data->setCellValue('F1', 'Success Rate (%)');
		$data->setCellValue('G1', 'Login Req. /s');
		$data->setCellValue('H1', 'Cmd Num');
		$data->setCellValue('I1', 'Cmd /s');
		$k = $j = $i = 1;
		$n = 0;
		$chk = count($query);
		foreach($query as $row){
			++$k;
			if(is_integer($n/10000) && $n != 0){
				$objPHPExcel->createSheet();
				
				$data = $objPHPExcel->setActiveSheetIndex($j);
				$objPHPExcel->getActiveSheet()->setTitle('Device-'.($j+1));
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
				$data->setCellValue('A1', 'Update Date');
				$data->setCellValue('B1', 'Last Login');
				$data->setCellValue('C1', 'Node Name');
				$data->setCellValue('D1', 'Node IP');
				$data->setCellValue('E1', 'Login Num (Acp/Rej)');
				$data->setCellValue('F1', 'Success Rate (%)');
				$data->setCellValue('G1', 'Login Req. /s');
				$data->setCellValue('H1', 'Cmd Num');
				$data->setCellValue('I1', 'Cmd /s');
				$j++;
				$k = 2;
				$n - 1;
			}

			$data->setCellValue('A'.$k, (empty($row['update_date']))?'-':$row['update_date']);
			$data->setCellValue('B'.$k, (empty($row['last_login']))?'-':$row['last_login']);
			$data->setCellValue('C'.$k, (empty($row['node_name']))?'-':$row['node_name']);
			$data->setCellValue('D'.$k, (empty($row['node_ip']))?'-':$row['node_ip']);
			$data->setCellValue('E'.$k, (empty($row['login_num']))?'-':$row['login_num']);
			$data->setCellValue('F'.$k, (empty($row['success_rate']))?'-':number_format($row['success_rate'],2));
			$data->setCellValue('G'.$k, (empty($row['login_rate']))?'-':number_format($row['login_rate'],3));
			$data->setCellValue('H'.$k, (empty($row['cmd_num']))?'-':$row['cmd_num']);
			$data->setCellValue('I'.$k, (empty($row['cmd_rate']))?'-':number_format($row['cmd_rate'],3));
			$n++;
			$i++;
		}

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Redirect output to a client’s web browser (Excel2007)
		$filename = "Report_device_".date("Y-m-d_H-i",time()).".xlsx"; 
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename);
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		
		self::CreateFileCheck('excel');
		
		spl_autoload_register(array('YiiBase','autoload'));
        Yii::app()->end();
	}

	public function actionUserExportTxt()
	{
		ini_set("memory_limit","256M");
		set_time_limit(0);
		$row = Yii::app()->db->createCommand($_POST['tmpSQL'])->queryAll();
		$strFileName = "assets\Report_user_".date("Y-m-d_H-i",time()).".txt";
		$fileName = "Report_user_".date("Y-m-d_H-i",time()).".txt";
		$objFopen = fopen($strFileName, 'w');
		$tab = (chr(011)); 
		$space = (chr(040)); 
		$arr = array("login_date"=>"Login Date", "node_name"=>"Node Name", "node_ip"=>"Node IP", "user_name"=>"User Name", "user_ip"=>"User IP", "cmd"=>"Command");
		$str = '';
		foreach($arr as $k=>$item){
			$str .= $item.$tab;
		}
		$str .= "\r\n";

		foreach($row as $item){
			foreach($item as $v){
				$v = (empty($v)) ? '-' : $v;
				$str .= $v.$tab;
			}
			$str .= "\r\n"; 
		}

		header ("Content-Type: application/download");
		header ("Content-Disposition: attachment; filename=$fileName");
		
		fwrite($objFopen, $str);
		fclose($objFopen);
		$fp = fopen($strFileName, "r");
		fpassthru($fp);
		fclose($fp);
		
		unlink($strFileName);
		self::CreateFileCheck('txt');
	}

	public function actionDeviceExportTxt()
	{
		ini_set("memory_limit","256M");
		set_time_limit(0);
		$row = Yii::app()->db->createCommand($_POST['tmpSQL'])->queryAll();
		$strFileName = "assets\Report_device_".date("Y-m-d_H-i",time()).".txt";
		$fileName = "Report_device_".date("Y-m-d_H-i",time()).".txt";
		$objFopen = fopen($strFileName, 'w');
		$tab = (chr(011)); 
		$space = (chr(040)); 
		$arr = array("update_date"=>"Update Date", "last_login"=>"Last Login", "node_name"=>"Node Name","node_ip"=>"Node IP", "login_num"=>"login Num (Acp/Rej)", "success_rate"=>"Success Rate (%)", "login_rate"=>"Login Req. /s", "cmd_num"=>"Cmd Num", "cmd_rate"=>"Cmd /s");
		$str = '';
		foreach($arr as $k=>$item){
			$str .= $item.$tab;
		}
		$str .= "\r\n";

		foreach($row as $item){
			foreach($item as $k=>$v){
				if($k === 'success_rate') $v = number_format($v,2);
				if($k === 'login_rate') $v = number_format($v,3);
				if($k === 'cmd_rate') $v = number_format($v,3);
				$v = (empty($v)) ? '-' : $v;
				$str .= $v.$tab;
			}
			$str .= "\r\n"; 
		}

		header ("Content-Type: application/download");
		header ("Content-Disposition: attachment; filename=$fileName");
		
		fwrite($objFopen, $str);
		fclose($objFopen);
		$fp = fopen($strFileName, "r");
		fpassthru($fp);
		fclose($fp);
		
		unlink($strFileName);
		self::CreateFileCheck('txt');
	}

	public function actionCheckExportData()
	{
		ob_start();
		if($_POST['str'] == 'exl'){
			if(is_file("assets/chkexcel_".Yii::app()->session->sessionID.".tmp")){
				unlink("assets/chkexcel_".Yii::app()->session->sessionID.".tmp");
				echo "true";
			}else{
				echo "false";
			}
		}else{
			if(is_file("assets/chktxt_".Yii::app()->session->sessionID.".tmp")){
				unlink("assets/chktxt_".Yii::app()->session->sessionID.".tmp");
				echo "true";
				exit;
			}else{
				echo "false";
			}
		}
		ob_end_flush();
	}

	public function CreateFileCheck($str)
	{
		$strFileName = "assets/chk".$str."_".Yii::app()->session->sessionID.".tmp";
		$objFopen = fopen($strFileName, 'w');
		fwrite($objFopen, "");
		fclose($objFopen);
	}

	public function ClearTempFile()
	{
		if(is_file("assets/chktxt_".Yii::app()->session->sessionID.".tmp")){
			unlink("assets/chktxt_".Yii::app()->session->sessionID.".tmp");
		}
		if(is_file("assets/chkexcel_".Yii::app()->session->sessionID.".tmp")){
			unlink("assets/chkexcel_".Yii::app()->session->sessionID.".tmp");
		}
		$dir = scandir("assets");
		foreach($dir as $item){
			
			if(pathinfo($item, PATHINFO_EXTENSION) === 'tmp'){
				$strDateTime1 = date("Y-m-d H:i:s", fileatime('assets/'.$item));
				$strDateTime2 = date("Y-m-d H:i:s");
				$datediff = (strtotime($strDateTime2) - strtotime($strDateTime1))/  ( 60 * 60 ); 
				if($datediff > 23){
					unlink('assets/'.$item);
				}
			}
		}
	}

	public function actionNodeName()
	{
		$strSQL = "SELECT a.node_name,a.node_ip,a.last_login,a.success_rate, a.accept_num, a.reject_num, a.cmd_num FROM NE_AUTHSUM a,(SELECT last_login,node_name FROM NE_AUTHSUM WHERE id = '".$_POST['id']."') b  WHERE a.sum_dur = '".$_POST['sum_type']."' AND a.node_name = b.node_name AND a.last_login BETWEEN b.last_login - INTERVAL 12 HOUR AND b.last_login + INTERVAL 12 HOUR ORDER BY a.last_login ASC";
		$row = Yii::app()->db->createCommand($strSQL)->queryAll();
		foreach($row as $item){
			$time = strtotime($item['last_login'].' UTC')*1000;
			$success_rate['success_rate'][] = array($time,$item['success_rate']);
			$accept_num['accept_num'][] = array($time,$item['accept_num']);
			$reject_num['reject_num'][] = array($time,$item['reject_num']);
			$cmd_num['cmd_num'][] = array($time,$item['cmd_num']);
		}
		$result = array(array('% Success','Transaction #'),array($success_rate,$accept_num,$reject_num,$cmd_num),array($row[0]['node_name'],$row[0]['node_ip']));
		echo CJSON::encode($result);
	}

	public function actionSuccessRate()
	{
		$strSQL = "SELECT a.node_name,a.node_ip,a.last_login,a.success_rate, a.accept_num, a.reject_num, a.cmd_num FROM NE_AUTHSUM a,(SELECT last_login,node_name FROM NE_AUTHSUM WHERE id = '".$_POST['id']."') b  WHERE a.sum_dur = '".$_POST['sum_type']."' AND a.node_name = b.node_name AND a.last_login BETWEEN b.last_login - INTERVAL 12 HOUR AND b.last_login + INTERVAL 12 HOUR ORDER BY a.last_login ASC";
		$row = Yii::app()->db->createCommand($strSQL)->queryAll();
		foreach($row as $item){
			$time = strtotime($item['last_login'].' UTC')*1000;
			$success_rate['success_rate'][] = array($time,$item['success_rate']);
			$accept_num['accept_num'][] = array($time,$item['accept_num']);
			$reject_num['reject_num'][] = array($time,$item['reject_num']);
		}
		$result = array(array('% Success','Login #'),array($success_rate,$accept_num,$reject_num),array($row[0]['node_name'],$row[0]['node_ip']));
		echo CJSON::encode($result);
	}

	public function actionLoginRate()
	{
		$strSQL = "SELECT a.node_name,a.node_ip,a.last_login,a.login_rate, (a.accept_num+a.reject_num) AS login_num FROM NE_AUTHSUM a,(SELECT last_login,node_name FROM NE_AUTHSUM WHERE id = '".$_POST['id']."') b  WHERE a.sum_dur = '".$_POST['sum_type']."' AND a.node_name = b.node_name AND a.last_login BETWEEN b.last_login - INTERVAL 12 HOUR AND b.last_login + INTERVAL 12 HOUR ORDER BY a.last_login ASC";
		$row = Yii::app()->db->createCommand($strSQL)->queryAll();
		foreach($row as $item){
			$time = strtotime($item['last_login'].' UTC')*1000;
			$login_rate['login_rate'][] = array($time,number_format($item['login_rate'],3));
			$login_num['login_num'][] = array($time,$item['login_num']);
		}
		$result = array(array('Login Req. /s'),array($login_rate,$login_num),array($row[0]['node_name'],$row[0]['node_ip']));
		echo CJSON::encode($result);
	}

	public function actionCmdRate()
	{
		$strSQL = "SELECT a.node_name,a.node_ip,a.last_login, cmd_rate, cmd_num FROM NE_AUTHSUM a,(SELECT last_login,node_name FROM NE_AUTHSUM WHERE id = '".$_POST['id']."') b  WHERE a.sum_dur = '".$_POST['sum_type']."' AND a.node_name = b.node_name AND a.last_login BETWEEN b.last_login - INTERVAL 12 HOUR AND b.last_login + INTERVAL 12 HOUR ORDER BY a.last_login ASC";
		$row = Yii::app()->db->createCommand($strSQL)->queryAll();
		foreach($row as $item){
			$time = strtotime($item['last_login'].' UTC')*1000;
			$cmd_rate['cmd_rate'][] = array($time,$item['cmd_rate']);
			$cmd_num['cmd_num'][] = array($time,$item['cmd_num']);
		}
		$result = array(array('Cmd /s','Cmd #'),array($cmd_rate,$cmd_num),array($row[0]['node_name'],$row[0]['node_ip']));
		echo CJSON::encode($result);
	}
}