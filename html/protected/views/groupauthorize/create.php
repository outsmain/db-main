<?php
/* @var $this GroupauthorizeController */
/* @var $model GROUPAUTHORIZE */

$this->breadcrumbs=array(
	'Groupauthorizes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GROUPAUTHORIZE', 'url'=>array('index')),
	array('label'=>'Manage GROUPAUTHORIZE', 'url'=>array('admin')),
);
?>

<h1>Create GROUPAUTHORIZE</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>