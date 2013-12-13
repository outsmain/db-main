<?php
/* @var $this PAGENAMEController */
/* @var $model PAGENAME */

$this->breadcrumbs=array(
	'Pagenames'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PAGENAME', 'url'=>array('index')),
	array('label'=>'Create PAGENAME', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pagename-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
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
<h2>Manage Page</h2>
<div class="widget_inside">
<?php// echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pagename-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'NAME',
		'TITLE',
		//'COMMENT',
		//'MODELNAME',
		//'TYPE',
		/*
		'NEXTPAGE',
		'PREVPAGE',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); 
echo "<center>".CHtml::button('Create Page', array('onclick' => 'js:document.location.href="index.php?r=pagename/create"'));?>
</div>
</div>
</div>
</div>
</div>