<?php
/* @var $this EdituserController */
/* @var $model UserLogin */

$this->breadcrumbs=array(
	'User Logins'=>array('index'),
	$model->NAME,
);

$this->menu=array(
	array('label'=>'List UserLogin', 'url'=>array('index')),
	array('label'=>'Create UserLogin', 'url'=>array('create')),
	array('label'=>'Update UserLogin', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete UserLogin', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserLogin', 'url'=>array('admin')),
);
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 	
?>
<div class="container" id="actualbody">
<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<h2>View User <?php echo $model->NAME; ?></h2>
<div class="widget_inside">


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NAME',
		'FULL_NAME',
		'COMMENT',
	//	'PASSWORD',
		'EMAIL',
		'GROUPNAME_ID',
		'ACCESSGROUP_ID',
		'LAST_LOGIN_DATE',
		'LAST_LOGIN_IP',
	),
)); ?>
</div>
</div>
</div>
</div>
</div>