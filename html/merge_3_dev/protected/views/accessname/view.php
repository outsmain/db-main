<?php
/* @var $this AccessnameController */
/* @var $model ACCESSNAME */

$this->breadcrumbs=array(
	'Accessnames'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List ACCESSNAME', 'url'=>array('index')),
	array('label'=>'Create ACCESSNAME', 'url'=>array('create')),
	array('label'=>'Update ACCESSNAME', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete ACCESSNAME', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ACCESSNAME', 'url'=>array('admin')),
);
?>
<div class="row clearfix">
<div class="widget clearfix">
<div class="row clearfix">
<div class="col_12">
<h2>View ACCESSNAME #<?php echo $model->ID; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'STARTTIME',
		'ENDTIME',
		'DOW',
		'ALLOWIP',
	),
)); ?>
</div>
</div>
</div>
</div>