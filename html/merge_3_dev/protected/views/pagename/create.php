<div class="row clearfix">
<?php
/* @var $this PAGENAMEController */
/* @var $model PAGENAME */

$this->breadcrumbs=array(
	'Pagenames'=>array('index'),
	'Create',
);
/* 
$this->menu=array(
	array('label'=>'List PAGENAME', 'url'=>array('index')),
	array('label'=>'Manage PAGENAME', 'url'=>array('admin')),
); */
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

</div>