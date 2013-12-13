<?php
/* @var $this PlatformController */
/* @var $model PLATFORM */

$this->breadcrumbs=array(
	'Platforms'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PLATFORM', 'url'=>array('index')),
	array('label'=>'Create PLATFORM', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#platform-grid').yiiGridView('update', {
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

<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<h2>Manage platform</h2>
<div class="widget_inside">


<p>

</p>

<?php // echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'platform-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'ID',
		'NAME',
		'COMMENT',
		'LOGO',
		'HOMEPAGE',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}  {delete}',
		),
	),
)); 
?>
<?php echo "<center>".CHtml::button('Create New User', array('onclick' => 'js:document.location.href="index.php?r=platform/create"')); ?>

</div>
</div>
</div>
</div>