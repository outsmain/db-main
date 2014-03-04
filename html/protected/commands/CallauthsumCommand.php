<?php
$yii=dirname(__FILE__).'/../../framework/yii.php';
$config=dirname(__FILE__).'/../../protected/config/console.php';
require_once($yii);
$arr = require_once($config);

class CallauthsumCommand
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

	public function CallAuthSum($startdate, $enddate, $sum_dur, $sum_type){
		$strchk = '';
		if(empty($startdate)){
			$strchk .= "Please input start date.\n";
		}else{
			if(!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $startdate)){
				$strchk .= "Please input start date format YYYY-MM-DD H:i:s\n";	
			}
		}
		if(empty($enddate)){
			$strchk .= "Please input end date.\n";
		}else{
			 if(!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $enddate)){
				$strchk .= "Please input end date format YYYY-MM-DD H:i:s\n";	
			}
		}
		if(empty($sum_dur)){
			$strchk .= "Please input sum_dur.\n";
		}
		if(empty($sum_type)){
			$strchk .= "Please input sum_type.\n";
		}
		if(!empty($strchk)){
			echo $strchk;
		}else{
			$strSQL = "CALL PROC_AUTHACCT_SUM('".$startdate."','".$enddate."','".$sum_dur."','".$sum_type."')";
			$sth = $this->con->query($strSQL)or die(print_r($db->errorInfo(), true));
		}
	}
}

$run = new CallauthsumCommand($arr);
$runlog = $run->CallAuthSum($argv[1],$argv[2],$argv[3],$argv[4]);
?>