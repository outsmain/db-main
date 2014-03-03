<?php
/* @var $this PlatformController */
/* @var $model PLATFORM */
if($user = Yii::app()->session['user']==''){
$this->redirect(Yii::app()->request->baseUrl.'/index.php?r=site/login');
exit;
}
$this->breadcrumbs=array(
	'Platforms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PLATFORM', 'url'=>array('index')),
	array('label'=>'Manage PLATFORM', 'url'=>array('admin')),
);
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>