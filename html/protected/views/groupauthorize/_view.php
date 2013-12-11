<?php
/* @var $this GroupauthorizeController */
/* @var $data GROUPAUTHORIZE */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GROUPNAME_ID')); ?>:</b>
	<?php echo CHtml::encode($data->GROUPNAME_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PAGENAME_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PAGENAME_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACCESSGROUP_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACCESSGROUP_ID); ?>
	<br />


</div>