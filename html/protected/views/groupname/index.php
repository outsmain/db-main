<?php
/* @var $this GROUPNAMEController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Groupnames',
);

$this->menu=array(
	array('label'=>'Create GROUPNAME', 'url'=>array('create')),
	array('label'=>'Manage GROUPNAME', 'url'=>array('admin')),
);
?>

<h1>Groupnames</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
