<?php
/* @var $this ACCESSGROUPController */
/* @var $model ACCESSGROUP */

$this->breadcrumbs=array(
	'Accessgroups'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List ACCESSGROUP', 'url'=>array('index')),
	array('label'=>'Create ACCESSGROUP', 'url'=>array('create')),
	array('label'=>'View ACCESSGROUP', 'url'=>array('view','id'=>$model->ID)),
	array('label'=>'Manage ACCESSGROUP', 'url'=>array('admin')),
);
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>
<?php $this->renderPartial('_form2', array('model'=>$model,'id5'=>$model->ACCESSGROUP_ID)); ?>