<?php
/* @var $this GroupauthorizeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Groupauthorizes',
);

$this->menu=array(
	array('label'=>'Create GROUPAUTHORIZE', 'url'=>array('create')),
	array('label'=>'Manage GROUPAUTHORIZE', 'url'=>array('admin')),
);
?>

<h1>Groupauthorizes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
