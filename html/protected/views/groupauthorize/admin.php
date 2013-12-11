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

<h1>Manage Groupauthorizes</h1>



<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
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
		'ID',
		'GROUPNAME_ID',
		'PAGENAME_ID',
		'ACCESSGROUP_ID',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
