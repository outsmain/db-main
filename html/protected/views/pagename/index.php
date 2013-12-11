<?php
/* @var $this PAGENAMEController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pagenames',
);

$this->menu=array(
	array('label'=>'Create PAGENAME', 'url'=>array('create')),
	array('label'=>'Manage PAGENAME', 'url'=>array('admin')),
);
?>

<h1>Pagenames</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
