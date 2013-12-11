<?php
/* @var $this PlatformController */
/* @var $model PLATFORM */

$this->breadcrumbs=array(
	'Platforms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PLATFORM', 'url'=>array('index')),
	array('label'=>'Manage PLATFORM', 'url'=>array('admin')),
);
?>

<h2>Create PLATFORM</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>