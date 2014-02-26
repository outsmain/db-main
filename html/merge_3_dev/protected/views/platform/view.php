<?php
/* @var $this PlatformController */
/* @var $model PLATFORM */

$this->breadcrumbs=array(
	'Platforms'=>array('index'),
	$model->NAME,
);

$this->menu=array(
	array('label'=>'List PLATFORM', 'url'=>array('index')),
	array('label'=>'Create PLATFORM', 'url'=>array('create')),
	array('label'=>'Update PLATFORM', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete PLATFORM', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PLATFORM', 'url'=>array('admin')),
);
?>
<div class="row clearfix">
<div class="widget clearfix">
<div class="row clearfix">
<div class="col_12">
<h2>View PLATFORM #<?php echo $model->ID; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NAME',
		'COMMENT',
		'LOGO',
		'HOMEPAGE',
	),
)); ?>
</div>
</div>
</div>
</div>