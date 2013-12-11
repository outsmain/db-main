<?php
/* @var $this AccessnameController */
/* @var $model ACCESSNAME */

$this->breadcrumbs=array(
	'Accessnames'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ACCESSNAME', 'url'=>array('index')),
	array('label'=>'Manage ACCESSNAME', 'url'=>array('admin')),
);
?>

<h2>Create ACCESSNAME</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>