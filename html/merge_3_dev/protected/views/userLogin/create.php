<?php
/* @var $this UserLoginController */
/* @var $model UserLogin */
if($user = Yii::app()->session['user']==''){
$this->redirect(Yii::app()->request->baseUrl.'/index.php?r=site/login');
exit;
}
$this->breadcrumbs=array(
	'User Logins'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserLogin', 'url'=>array('index')),
	array('label'=>'Manage UserLogin', 'url'=>array('admin')),
);
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>

<h2>Create UserLogin</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>