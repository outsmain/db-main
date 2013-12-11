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
	array('label'=>'View ACCESSGROUP', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage ACCESSGROUP', 'url'=>array('admin')),
);
?>

<h1>Update ACCESSGROUP <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>