<div class="row clearfix">
<?php
/* @var $this PAGENAMEController */
/* @var $model PAGENAME */
if($user = Yii::app()->session['user']==''){
$this->redirect(Yii::app()->request->baseUrl.'/index.php?r=site/login');
exit;
}
$this->breadcrumbs=array(
	'Pagenames'=>array('index'),
	'Create',
);
/* 
$this->menu=array(
	array('label'=>'List PAGENAME', 'url'=>array('index')),
	array('label'=>'Manage PAGENAME', 'url'=>array('admin')),
); */
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

</div>