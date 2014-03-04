<?php
class CallauthsumCommand extends CConsoleCommand
{
	public function actionIndex($start, $end, $sum_dur, $sum_type){
		$strchk = '';
		if(empty($start)){
			$strchk .= "Please input start date.\n";
		}else{
			if(!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $start)){
				$strchk .= "Please input start date format YYYY-MM-DD H:i:s\n";	
			}
		}
		if(empty($end)){
			$strchk .= "Please input end date.\n";
		}else{
			 if(!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $end)){
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
			$strSQL = "CALL PROC_AUTHACCT_SUM('".$start."','".$end."','".$sum_dur."','".$sum_type."')";
			$query =  Yii::app()->db->createCommand($strSQL)->execute();
		}
	}
}
?>