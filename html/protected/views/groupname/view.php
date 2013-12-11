<?php
/* @var $this GROUPNAMEController */
/* @var $model GROUPNAME */

$this->breadcrumbs=array(
	'Groupnames'=>array('index'),
	$model->NAME,
);

$this->menu=array(
	array('label'=>'List GROUPNAME', 'url'=>array('index')),
	array('label'=>'Create GROUPNAME', 'url'=>array('create')),
	array('label'=>'Update GROUPNAME', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete GROUPNAME', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GROUPNAME', 'url'=>array('admin')),
);
?>
<div class="row clearfix">
<div class="widget clearfix">
<div class="row clearfix">
<div class="col_12">
<h2>View GROUPNAME #<?php echo $model->ID; ?></h2>
<div class="row clearfix">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NAME',
		'COMMENT',
		'ACCESSGROUP_ID',
		'PLATFORM_ID',
	),
)); ?>
</div>
</div>
</div>
</div>
</div>