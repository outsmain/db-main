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
?>

<h1>Update ACCESSNAME <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>