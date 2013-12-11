<?php
/* @var $this EdituserController */
/* @var $model UserLogin */

$this->breadcrumbs=array(
	'User Logins'=>array('index'),
	$model->NAME=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserLogin', 'url'=>array('index')),
	array('label'=>'Create UserLogin', 'url'=>array('create')),
	array('label'=>'View UserLogin', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage UserLogin', 'url'=>array('admin')),
);
?>

<h2>Update User <?php echo $model->NAME; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>