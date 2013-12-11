<?php
/* @var $this PAGENAMEController */
/* @var $data PAGENAME */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NAME')); ?>:</b>
	<?php echo CHtml::encode($data->NAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TITLE')); ?>:</b>
	<?php echo CHtml::encode($data->TITLE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COMMENT')); ?>:</b>
	<?php echo CHtml::encode($data->COMMENT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MODELNAME')); ?>:</b>
	<?php echo CHtml::encode($data->MODELNAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TYPE')); ?>:</b>
	<?php echo CHtml::encode($data->TYPE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NEXTPAGE')); ?>:</b>
	<?php echo CHtml::encode($data->NEXTPAGE); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('PREVPAGE')); ?>:</b>
	<?php echo CHtml::encode($data->PREVPAGE); ?>
	<br />

	*/ ?>

</div>