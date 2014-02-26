<?php
/* @var $this GroupauthorizeController */
/* @var $model GROUPAUTHORIZE */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GROUPNAME_ID'); ?>
		<?php echo $form->textField($model,'GROUPNAME_ID',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PAGENAME_ID'); ?>
		<?php echo $form->textField($model,'PAGENAME_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ACCESSGROUP_ID'); ?>
		<?php echo $form->textField($model,'ACCESSGROUP_ID',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->