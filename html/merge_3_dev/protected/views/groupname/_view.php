<?php
/* @var $this GROUPNAMEController */
/* @var $data GROUPNAME */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NAME')); ?>:</b>
	<?php echo CHtml::encode($data->NAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COMMENT')); ?>:</b>
	<?php echo CHtml::encode($data->COMMENT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACCESSGROUP_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACCESSGROUP_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PLATFORM_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PLATFORM_ID); ?>
	<br />


</div>