<?php
/* @var $this PAGENAMEController */
/* @var $model PAGENAME */

$this->breadcrumbs=array(
	'Pagenames'=>array('index'),
	$model->NAME,
);

$this->menu=array(
	array('label'=>'List PAGENAME', 'url'=>array('index')),
	array('label'=>'Create PAGENAME', 'url'=>array('create')),
	array('label'=>'Update PAGENAME', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete PAGENAME', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PAGENAME', 'url'=>array('admin')),
);
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>

<div class="container" id="actualbody">
<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<h2>View PAGENAME #<?php echo $model->ID; ?></h2>
<div class="widget_inside">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NAME',
		'TITLE',
		'COMMENT',
		'MODELNAME',
		'TYPE',
		'NEXTPAGE',
		'PREVPAGE',
	),
)); ?>
</div>
</div>
</div>
</div>
</div>