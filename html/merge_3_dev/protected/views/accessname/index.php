<?php
/* @var $this AccessnameController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Accessnames',
);

$this->menu=array(
	array('label'=>'Create ACCESSNAME', 'url'=>array('create')),
	array('label'=>'Manage ACCESSNAME', 'url'=>array('admin')),
);
?>

<h1>Accessnames</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
