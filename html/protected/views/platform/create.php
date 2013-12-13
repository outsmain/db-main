<?php
/* @var $this PlatformController */
/* @var $model PLATFORM */

$this->breadcrumbs=array(
	'Platforms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PLATFORM', 'url'=>array('index')),
	array('label'=>'Manage PLATFORM', 'url'=>array('admin')),
);
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>

<h2>Create PLATFORM</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>