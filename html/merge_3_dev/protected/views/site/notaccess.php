<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/assets/DataTable/js/jquery.dataTables.min.js");?>

<?php

if($user = Yii::app()->session['user']==''){
$this->redirect('index.php?r=site/login');
exit;
}

$page_name="Login Log Report"; 
$url= $_SERVER['REQUEST_URI'];
		$user = Yii::app()->session['user'];
		$status ="ok";
		$action ="OPEN";
		Func::add_loglogmodify($user,$status,$action,$url); 
?>

<div class="container" id="actualbody">
	
	<div class="row clearfix">
		<div class="col_12">
			<div class="widget clearfix">
				<h2>Warning</h2>
				<div class="widget_inside">   
						You don't have permission to open this page!!
				</div>
			</div>
		</div>
	</div>
</div>

