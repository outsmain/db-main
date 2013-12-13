<?php
/* @var $this PlatformController */
/* @var $model PLATFORM */

$this->breadcrumbs=array(
	'Platforms'=>array('index'),
	$model->NAME=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List PLATFORM', 'url'=>array('index')),
	array('label'=>'Create PLATFORM', 'url'=>array('create')),
	array('label'=>'View PLATFORM', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage PLATFORM', 'url'=>array('admin')),
);
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>

<h2>Update PLATFORM <?php echo $model->ID; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>