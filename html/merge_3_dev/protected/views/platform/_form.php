<?php
/* @var $this PlatformController */
/* @var $model PLATFORM */
/* @var $form CActiveForm */
?>
<div class="container" id="actualbody">
<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<h2>Create platform</h2>
<div class="widget_inside">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'platform-form',
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
</div>
</div><!-- form -->