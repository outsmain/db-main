<?php
/* @var $this GROUPNAMEController */
/* @var $model GROUPNAME */

$this->breadcrumbs=array(
	'Groupnames'=>array('index'),
	$model->NAME=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List GROUPNAME', 'url'=>array('index')),
	array('label'=>'Create GROUPNAME', 'url'=>array('create')),
	array('label'=>'View GROUPNAME', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage GROUPNAME', 'url'=>array('admin')),
);
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>

<h2>Update GROUPNAME <?php echo $model->ID; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model,'model2'=>$model2,'pag'=>$pag)); ?>