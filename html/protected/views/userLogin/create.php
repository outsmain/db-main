<?php
/* @var $this UserLoginController */
/* @var $model UserLogin */

$this->breadcrumbs=array(
	'User Logins'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserLogin', 'url'=>array('index')),
	array('label'=>'Manage UserLogin', 'url'=>array('admin')),
);
?>

<h1>Create UserLogin</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>