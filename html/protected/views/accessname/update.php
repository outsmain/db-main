<?php
/* @var $this AccessnameController */
/* @var $model ACCESSNAME */

$this->breadcrumbs=array(
	'Accessnames'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List ACCESSNAME', 'url'=>array('index')),
	array('label'=>'Create ACCESSNAME', 'url'=>array('create')),
	array('label'=>'View ACCESSNAME', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage ACCESSNAME', 'url'=>array('admin')),
);
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>
<div class="row clearfix">
<div class="col_12">

<h2>Update Accessname <?php echo $model->ID; ?></h2>



<?php $this->renderPartial('_form', array('model'=>$model,'dow'=>$dow)); ?>

</div>
</div>