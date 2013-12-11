<?php
/* @var $this PAGENAMEController */
/* @var $model PAGENAME */

$this->breadcrumbs=array(
	'Pagenames'=>array('index'),
	$model->NAME=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List PAGENAME', 'url'=>array('index')),
	array('label'=>'Create PAGENAME', 'url'=>array('create')),
	array('label'=>'View PAGENAME', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage PAGENAME', 'url'=>array('admin')),
);
?>

<h1>Update PAGENAME <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>