<?php
/* @var $this ACCESSGROUPController */
/* @var $model ACCESSGROUP */

$this->breadcrumbs=array(
	'Accessgroups'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ACCESSGROUP', 'url'=>array('index')),
	array('label'=>'Create ACCESSGROUP', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#accessgroup-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<h2>Manage Access Group</h2>
<div class="widget_inside">


<?php // echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'accessgroup-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'ID',
		'ACCESSGROUP_ID',
		'ACCESSNAME_ID',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}  {delete}',
		),
	),
)); ?>
<?php echo "<center>".CHtml::button('Create Accessgroup', array('onclick' => 'js:document.location.href="index.php?r=accessgroup/create"')); ?>
</div>
</div>
</div>
</div>