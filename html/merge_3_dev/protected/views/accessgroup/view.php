<?php
/* @var $this ACCESSGROUPController */
/* @var $model ACCESSGROUP */

$this->breadcrumbs=array(
	'Accessgroups'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List ACCESSGROUP', 'url'=>array('index')),
	array('label'=>'Create ACCESSGROUP', 'url'=>array('create')),
	array('label'=>'Update ACCESSGROUP', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete ACCESSGROUP', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ACCESSGROUP', 'url'=>array('admin')),
);
?>
<div class="row clearfix">
<div class="widget clearfix">
<div class="row clearfix">
<div class="col_12">
<h2>View ACCESSGROUP #<?php echo $model->ID; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'ACCESSGROUP_ID',
		'ACCESSNAME_ID',
	),
)); ?>
</div>
</div>
</div>
</div>