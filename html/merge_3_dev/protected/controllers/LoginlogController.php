<?php

class LoginlogController extends Controller
{
	public function actionIndex()
	{	
	$model=new loginlog;
	$model->UPDATE_DATE = date('Y-m-d 00:00');
	$model->UPDATE_DATE2 = date('Y-m-d 23:59');
	$this->render('index',array('model'=>$model,)
								);
	
	}
	public function actionview()
	{
		$start_date = $_GET['FromDt'];
		$end_date = $_GET['ToDt'];
		$username =$_GET['UserName'];
		$user_ip =$_GET['UserIP'];
		$strFromDt = '';
		if(!empty($_GET['FromDt'])){
			$strFromDt = " UPDATE_DATE >= '{$_GET['FromDt']}'";
		}
		$strToDt = '';
		if(!empty($_GET['ToDt'])){
			$strToDt = " AND UPDATE_DATE <= '{$_GET['ToDt']}'";
		}
		$strUser = '';
		if(!empty($_GET['UserName'])){
			$strUser = " AND USER_NAME LIKE '%{$_GET['UserName']}%'";
		}
		$strUserIP = '';
		if(!empty($_GET['UserIP'])){
			$strUserIP = " AND USER_IP LIKE '%{$_GET['UserIP']}%'";
		}
		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$sLimit = " LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
				intval( $_GET['iDisplayLength'] );
		}
		$sOrder = "";
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
						($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
				}
			}	
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}
		$sOrder = " ORDER BY UPDATE_DATE DESC";
		$sWhere = "";
		if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
		{
			$sWhere = " AND (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
			{
				$sWhere .= " AND ";
				$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}
		
		if(strtotime(date('d-m-Y')) == strtotime($_GET['FromDt']) && empty($_GET['UserName']) && empty($_GET['UserIP'])){
			$sqlc = "SELECT UPDATE_DATE,USER_NAME,USER_IP,COMMAND,VALUE,STATUS FROM LOGIN_LOG WHERE UPDATE_DATE >= '".date('Y-m-d 00:00:00')."'";
		}else{
			$sqlc = "SELECT UPDATE_DATE,USER_NAME,USER_IP,COMMAND,VALUE,STATUS FROM LOGIN_LOG WHERE ";
			$sqlc .= $strFromDt;
			$sqlc .= $strToDt;
			$sqlc .= $strUser;
			$sqlc .= $strUserIP;
		}
		$tmpSQL = $sqlc;
		$sqlc .= $sWhere;
		$sqlc .= $sOrder;
		$sqlc .= $sLimit;
		$arr =Yii::app()->db->createCommand($sqlc)->queryAll();
		$rTotal = Yii::app()->db->createCommand($tmpSQL)->queryAll();
		$iTotal = $iTotalDisplay = count($rTotal);
		if(!$arr){
		 $row = array();
		}
		foreach($arr as $k=>$aRow)
		{
			$i = 0;
			foreach($aRow as $key=>$val )
			{
				$row[$k][$i] = ($val == "0") ? '-' : $val;
				$i++;
			}		
		}

		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iTotalDisplay,
			"aaData" => $row
		);	 
		echo json_encode($output);	
	}
}