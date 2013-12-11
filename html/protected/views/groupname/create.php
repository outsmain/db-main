<?php
/* @var $this GROUPNAMEController */
/* @var $model GROUPNAME */

$this->breadcrumbs=array(
	'Groupnames'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GROUPNAME', 'url'=>array('index')),
	array('label'=>'Manage GROUPNAME', 'url'=>array('admin')),
);
?>


<h2>Create GROUPNAME</h2>


<?php $this->renderPartial('_form', array('model'=>$model ,'model2'=>$model2)); ?>
