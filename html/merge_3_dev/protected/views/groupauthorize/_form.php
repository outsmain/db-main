<?php
/* @var $this GroupauthorizeController */
/* @var $model GROUPAUTHORIZE */
/* @var $form CActiveForm */
?>
<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<div class="widget_inside">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groupauthorize-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); 

?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'GROUPNAME_ID'); ?>
		<?php echo $form->dropDownList($model,'GROUPNAME_ID',GROUPNAME::getDroupdownid()); ?> *
		<?php echo $form->error($model,'GROUPNAME_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PAGENAME_ID'); ?>
		<?php echo $form->checkBoxList($model,'PAGENAME_ID',PAGENAME::getPagename()); ?> *
		<?php echo $form->error($model,'PAGENAME_ID'); ?>
	</div>

	<!-- <div class="row">
		<?php// echo $form->labelEx($model,'ACCESSGROUP_ID'); ?>
		<?php //echo $form->dropDownList($model,'ACCESSGROUP_ID',ACCESSGROUP::getDroupdown()); ?> 
		<?php// echo $form->error($model,'ACCESSGROUP_ID'); ?>
	</div> -->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
</div>
</div><!-- form -->