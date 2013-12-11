<?php
/* @var $this PlatformController */
/* @var $model PLATFORM */
/* @var $form CActiveForm */
?>

<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<div class="widget_inside">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'platform-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'NAME'); ?>
		<div class="input">
		<?php echo $form->textField($model,'NAME',array('size'=>45,'maxlength'=>45)); ?>
		</div>
		<?php echo $form->error($model,'NAME'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'COMMENT'); ?>
		<div class="input">
		<?php echo $form->textField($model,'COMMENT',array('size'=>60,'maxlength'=>255)); ?>
		</div>
		<?php echo $form->error($model,'COMMENT'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'LOGO'); ?>
		<div class="input">
		<?php echo $form->textField($model,'LOGO',array('size'=>60,'maxlength'=>255)); ?>
		</div>
		<?php echo $form->error($model,'LOGO'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'HOMEPAGE'); ?>
		<div class="input">
		<?php echo $form->textField($model,'HOMEPAGE',array('size'=>60,'maxlength'=>255)); ?>
		</div>
		<?php echo $form->error($model,'HOMEPAGE'); ?>
	</div>

	<div class="clearfix">
	<div class="input">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
</div>
</div><!-- form -->