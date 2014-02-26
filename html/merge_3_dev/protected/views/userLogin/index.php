<?php
/* @var $this UserLoginController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Logins',
);

$this->menu=array(
	array('label'=>'Create UserLogin', 'url'=>array('create')),
	array('label'=>'Manage UserLogin', 'url'=>array('admin')),
);
?>

<h1>User Logins</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
