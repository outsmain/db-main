<?php
/* @var $this EdituserController */
/* @var $model UserLogin */

$this->breadcrumbs=array(
	'User Logins'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserLogin', 'url'=>array('index')),
	array('label'=>'Manage UserLogin', 'url'=>array('admin')),
);
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 	
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>
