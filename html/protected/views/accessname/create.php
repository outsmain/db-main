<?php
/* @var $this AccessnameController */
/* @var $model ACCESSNAME */

$this->breadcrumbs=array(
	'Accessnames'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ACCESSNAME', 'url'=>array('index')),
	array('label'=>'Manage ACCESSNAME', 'url'=>array('admin')),
);
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>

<h2>Create ACCESSNAME</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>