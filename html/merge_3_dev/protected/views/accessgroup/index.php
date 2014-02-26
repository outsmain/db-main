<?php
/* @var $this ACCESSGROUPController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Accessgroups',
);

$this->menu=array(
	array('label'=>'Create ACCESSGROUP', 'url'=>array('create')),
	array('label'=>'Manage ACCESSGROUP', 'url'=>array('admin')),
);
?>

<h1>Accessgroups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
