<?php
/* @var $this GroupauthorizeController */
/* @var $model GROUPAUTHORIZE */

$this->breadcrumbs=array(
	'Groupauthorizes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GROUPAUTHORIZE', 'url'=>array('index')),
	array('label'=>'Manage GROUPAUTHORIZE', 'url'=>array('admin')),
);
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>

<h2>Create GROUPAUTHORIZE</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>