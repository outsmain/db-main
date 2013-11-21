<?php
/* @var $this UserLoginController */
/* @var $model UserLogin */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-login-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NAME'); ?>
		<?php echo $form->textField($model,'NAME',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'NAME'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FULL_NAME'); ?>
		<?php echo $form->textField($model,'FULL_NAME',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'FULL_NAME'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COMMENT'); ?>
		<?php echo $form->textField($model,'COMMENT',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'COMMENT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PASSWORD'); ?>
		<?php echo $form->passwordField($model,'PASSWORD',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'PASSWORD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EMAIL'); ?>
		<?php echo $form->textField($model,'EMAIL',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'EMAIL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'GROUPNAME_ID'); ?>
		<?php echo $form->textField($model,'GROUPNAME_ID',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'GROUPNAME_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ACCESSGROUP_ID'); ?>
		<?php echo $form->textField($model,'ACCESSGROUP_ID',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'ACCESSGROUP_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LAST_LOGIN_DATE'); ?>
		<?php echo $form->textField($model,'LAST_LOGIN_DATE'); ?>
		<?php echo $form->error($model,'LAST_LOGIN_DATE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LAST_LOGIN_IP'); ?>
		<?php echo $form->textField($model,'LAST_LOGIN_IP',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'LAST_LOGIN_IP'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->