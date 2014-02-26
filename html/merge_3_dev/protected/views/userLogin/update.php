<?php
$this->breadcrumbs=array(
	'User Logins'=>array('index'),
	$model->NAME=>array('view','name'=>$model->NAME),
	'Update',
);

$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>