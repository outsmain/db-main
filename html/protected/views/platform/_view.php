<?php
/* @var $this PlatformController */
/* @var $data PLATFORM */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('LOGO')); ?>:</b>
	<?php echo CHtml::encode($data->LOGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HOMEPAGE')); ?>:</b>
	<?php echo CHtml::encode($data->HOMEPAGE); ?>
	<br />


</div>