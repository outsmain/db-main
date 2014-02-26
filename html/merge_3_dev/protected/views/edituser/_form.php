<?php
/* @var $this EdituserController */
/* @var $model UserLogin */
/* @var $form CActiveForm */
?>
<div class="container" id="actualbody">
<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<h2>Create UserLogin</h2>
<div class="widget_inside">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-login-form',
	 'focus'=>array($model,'NAME'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="clearfix">

		<?php echo $form->labelEx($model,'NAME'); ?>
		<div class="input">	
		<?php echo $form->textField($model,'NAME',array('size'=>60,'maxlength'=>64)); ?> *
		</div>
		<?php echo $form->error($model,'NAME'); ?>
	
	</div>
	<div class="clearfix">
		<?php echo $form->labelEx($model,'PASSWORD'); ?>
		<div class="input">	
		<?php echo $form->passwordField($model,'PASSWORD',array('size'=>60,'maxlength'=>64)); ?> *
		</div>
		<?php echo $form->error($model,'PASSWORD'); ?>
	</div>
	<div class="clearfix">
		<?php echo $form->labelEx($model,'FULL_NAME'); ?>
		<div class="input">	
		<?php echo $form->textField($model,'FULL_NAME',array('size'=>60,'maxlength'=>64)); ?> *
		</div>
		<?php echo $form->error($model,'FULL_NAME'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'COMMENT'); ?>
		<div class="input">	
		<?php echo $form->textField($model,'COMMENT',array('size'=>60,'maxlength'=>256)); ?>
		</div>
		<?php echo $form->error($model,'COMMENT'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'EMAIL'); ?>
		<div class="input">	
		<?php echo $form->textField($model,'EMAIL',array('size'=>60,'maxlength'=>64)); ?>
		</div>
		<?php echo $form->error($model,'EMAIL'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'GROUPNAME_ID'); ?>
		<?php //echo $form->textField($model,'GROUPNAME_ID',array('size'=>11,'maxlength'=>11)); ?>
		<div class="input">	
		<?php echo $form->dropDownList($model,'GROUPNAME_ID',GROUPNAME::getDroupdownid()); ?> *
		</div>
		<?php echo $form->error($model,'GROUPNAME_ID'); ?>
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