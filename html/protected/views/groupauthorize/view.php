<?php
/* @var $this GroupauthorizeController */
/* @var $model GROUPAUTHORIZE */

$this->breadcrumbs=array(
	'Groupauthorizes'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List GROUPAUTHORIZE', 'url'=>array('index')),
	array('label'=>'Create GROUPAUTHORIZE', 'url'=>array('create')),
	array('label'=>'Update GROUPAUTHORIZE', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete GROUPAUTHORIZE', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GROUPAUTHORIZE', 'url'=>array('admin')),
);
?>
<div class="row clearfix">
<div class="widget clearfix">
<div class="row clearfix">
<div class="col_12">
<h2>View GROUPAUTHORIZE #<?php echo $model->ID; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'GROUPNAME_ID',
		'PAGENAME_ID',
		'ACCESSGROUP_ID',
	),
)); ?>
</div>
</div>
</div>
</div>