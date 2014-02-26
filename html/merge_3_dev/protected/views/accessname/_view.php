<?php
/* @var $this AccessnameController */
/* @var $data ACCESSNAME */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('STARTTIME')); ?>:</b>
	<?php echo CHtml::encode($data->STARTTIME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ENDTIME')); ?>:</b>
	<?php echo CHtml::encode($data->ENDTIME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DOW')); ?>:</b>
	<?php echo CHtml::encode($data->DOW); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ALLOWIP')); ?>:</b>
	<?php echo CHtml::encode($data->ALLOWIP); ?>
	<br />
	


</div>