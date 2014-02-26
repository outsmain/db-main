<?php
/* @var $this ACCESSGROUPController */
/* @var $data ACCESSGROUP */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACCESSGROUP_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACCESSGROUP_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACCESSNAME_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACCESSNAME_ID); ?>
	<br />


</div>