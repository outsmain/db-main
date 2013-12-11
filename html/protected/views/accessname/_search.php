<?php
/* @var $this AccessnameController */
/* @var $model ACCESSNAME */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'STARTTIME'); ?>
		<?php echo $form->textField($model,'STARTTIME'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ENDTIME'); ?>
		<?php echo $form->textField($model,'ENDTIME'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DOW'); ?>
		<?php echo $form->textField($model,'DOW',array('size'=>0,'maxlength'=>0)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ALLOWIP'); ?>
		<?php echo $form->textField($model,'ALLOWIP',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->