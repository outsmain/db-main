<?php
/* @var $this ResetpassController */
/* @var $data UserLogin */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NAME')); ?>:</b>
	<?php echo CHtml::encode($data->NAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FULL_NAME')); ?>:</b>
	<?php echo CHtml::encode($data->FULL_NAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COMMENT')); ?>:</b>
	<?php echo CHtml::encode($data->COMMENT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PASSWORD')); ?>:</b>
	<?php echo CHtml::encode($data->PASSWORD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMAIL')); ?>:</b>
	<?php echo CHtml::encode($data->EMAIL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GROUPNAME_ID')); ?>:</b>
	<?php echo CHtml::encode($data->GROUPNAME_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ACCESSGROUP_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACCESSGROUP_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LAST_LOGIN_DATE')); ?>:</b>
	<?php echo CHtml::encode($data->LAST_LOGIN_DATE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LAST_LOGIN_IP')); ?>:</b>
	<?php echo CHtml::encode($data->LAST_LOGIN_IP); ?>
	<br />

	*/ ?>

</div>