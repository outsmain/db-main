<?php
/* @var $this EdituserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Logins',
);

$this->menu=array(
	array('label'=>'Create UserLogin', 'url'=>array('create')),
	array('label'=>'Manage UserLogin', 'url'=>array('admin')),
);
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 	
?>

<h1>User Logins</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
