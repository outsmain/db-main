<?php
/* Yii::import('application.components.UserIdentity');
$user = Yii::app()->session['user'];
$user_id =Func::to_edit($user);
if($user_id != $user)
exit; */

$this->breadcrumbs=array(
	'User Logins'=>array('index'),
	$model->NAME=>array('view','name'=>$model->NAME),
	'Update',
);

/* $this->menu=array(
	array('label'=>'List UserLogin', 'url'=>array('index')),
	array('label'=>'Create UserLogin', 'url'=>array('create')),
	array('label'=>'View UserLogin', 'url'=>array('view', 'name'=>$model->ID)), // ID>>NAME
	array('label'=>'Manage UserLogin', 'url'=>array('admin')),
); */
?>

<!-- <h1>Update UserLogin <?php// echo $model->NAME; ?> </h1> -->
Update User Profile

<?php $this->renderPartial('_form', array('model'=>$model)); ?>