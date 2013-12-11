<div class="row clearfix">
<?php
/* @var $this PAGENAMEController */
/* @var $model PAGENAME */

$this->breadcrumbs=array(
	'Pagenames'=>array('index'),
	'Create',
);
/* 
$this->menu=array(
	array('label'=>'List PAGENAME', 'url'=>array('index')),
	array('label'=>'Manage PAGENAME', 'url'=>array('admin')),
); */
?>

<h2>Create New Page</h2>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>

</div>