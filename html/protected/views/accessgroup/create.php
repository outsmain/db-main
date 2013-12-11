<?php
/* @var $this ACCESSGROUPController */
/* @var $model ACCESSGROUP */

$this->breadcrumbs=array(
	'Accessgroups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ACCESSGROUP', 'url'=>array('index')),
	array('label'=>'Manage ACCESSGROUP', 'url'=>array('admin')),
);
?>

<h2>Create ACCESSGROUP</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>