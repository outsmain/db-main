<?php
if($user = Yii::app()->session['user']==''){
$this->redirect('index.php?r=site/login');
exit;
if($user != 'admin'){
echo 'not permission';
$this->redirect('index.php?r=site/login');
exit;
}
}
?>
<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<div class="widget_inside">

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-login-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	//'enableAjaxValidation'=>false,
)); ?>

<!--	<p class="note">Fields with <span class="required">*</span> are required.</p> -->

<div>
<div class="clearfix">
	<td><?php echo $form->labelEx($model,'NAME'); ?>
	<div class="input">	
    <td><?php echo $form->textField($model,'NAME',array('readonly'=>true)); ?>
	</div>
    <td><?php echo $form->error($model,'NAME'); ?>
</div>
<div class="clearfix">
		<td><?php echo $form->labelEx($model,'FULL_NAME'); ?>
		<div class="input">	
		<td><?php echo $form->textField($model,'FULL_NAME',array('size'=>40,'maxlength'=>64)); ?>
		</div>
		<td><?php echo $form->error($model,'FULL_NAME'); ?>
  </div>
<div class="clearfix">
		<td><?php echo $form->labelEx($model,'COMMENT'); ?>
		<div class="input">	
		<td><?php echo $form->textField($model,'COMMENT',array('size'=>40,'maxlength'=>256)); ?>
		</div>
		<td><?php echo $form->error($model,'COMMENT'); ?>
</div>
<div class="clearfix">
		<td><?php echo $form->labelEx($model,'PASSWORD'); ?>
		<div class="input">	
		 <td><?php echo $form->passwordField($model,'PASSWORD',array('size'=>40,'maxlength'=>64)); ?>
		 </div>
		 <td><?php echo $form->error($model,'PASSWORD'); ?>
</div>
<div class="clearfix">
		<td><?php echo $form->labelEx($model,'EMAIL'); ?>
		<div class="input">	
		<td><?php echo $form->textField($model,'EMAIL',array('size'=>40,'maxlength'=>64)); ?>
		</div>
		<td><?php echo $form->error($model,'EMAIL'); ?>
</div>
<div class="clearfix">
		<td><?php ?>
		<div class="input">	
		<td><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
		
</div>
 
 
	<!--<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div> -->
<?php echo $form->errorSummary($model); ?>
<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
</div>
</div>
</div>
</div>