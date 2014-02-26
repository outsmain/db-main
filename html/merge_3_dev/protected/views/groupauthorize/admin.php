<?php
if($user = Yii::app()->session['user']==''){
$this->redirect('index.php?r=site/login');
exit;
}
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
$p_allow = Func::checkRule($url,$user);

	if($p_allow == "not_allow"){
		$status ="INVALID_COMMAND";
		Func::add_loglogmodify($user,$status,$action,$url); 
		$this->redirect('notaccess');
		
	}
?>
<?php
/* @var $this GroupauthorizeController */
/* @var $model GROUPAUTHORIZE */

$this->breadcrumbs=array(
	'Groupauthorizes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List GROUPAUTHORIZE', 'url'=>array('index')),
	array('label'=>'Create GROUPAUTHORIZE', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#groupauthorize-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<h2>Manage Groupauthorizes</h2>
<div class="row clearfix">

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'groupauthorize-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'ID',
		'GROUPNAME_ID',
		'PAGENAME_ID',
		'ACCESSGROUP_ID',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); 
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>
</div>
</div>
</div>
</div>