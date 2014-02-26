<?php
/* @var $this GroupauthorizeController */
/* @var $model GROUPAUTHORIZE */

$this->breadcrumbs=array(
	'Groupauthorizes'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);


?>


<h2>Update GROUPAUTHORIZE <?php echo $model->ID; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model,'model2'=>$model2)); ?>