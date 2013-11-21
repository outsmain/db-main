<?php
/* @var $this UserLoginController */
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
?>

<h1>View UserLogin #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NAME',
		'FULL_NAME',
		'COMMENT',
		'PASSWORD',
		'EMAIL',
		'GROUPNAME_ID',
		'ACCESSGROUP_ID',
		'LAST_LOGIN_DATE',
		'LAST_LOGIN_IP',
	),
)); ?>
