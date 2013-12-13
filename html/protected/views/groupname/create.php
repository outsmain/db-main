<?php
/* @var $this GROUPNAMEController */
/* @var $model GROUPNAME */

$this->breadcrumbs=array(
	'Groupnames'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GROUPNAME', 'url'=>array('index')),
	array('label'=>'Manage GROUPNAME', 'url'=>array('admin')),
);
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>


<h2>Create GROUPNAME</h2>


<?php $this->renderPartial('_form', array('model'=>$model ,'model2'=>$model2)); ?>
