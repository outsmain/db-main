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
<table width="200" border="1" >
<tr>
	<td><?php echo $form->labelEx($model,'NAME'); ?></td>
    <td><?php echo $form->textField($model,'NAME',array('readonly'=>true)); ?></td>
    <td><?php echo $form->error($model,'NAME'); ?></td>
  </tr>
 
  <tr>
		<td><?php echo $form->labelEx($model,'FULL_NAME'); ?></td>
		<td><?php echo $form->textField($model,'FULL_NAME',array('size'=>40,'maxlength'=>64)); ?></td>
		<td><?php echo $form->error($model,'FULL_NAME'); ?></td>
   
  </tr>
  <tr>
		<td><?php echo $form->labelEx($model,'COMMENT'); ?></td>
		<td><?php echo $form->textField($model,'COMMENT',array('size'=>40,'maxlength'=>256)); ?></td>
		<td><?php echo $form->error($model,'COMMENT'); ?></td>
   
  </tr>
  <tr>
		<td><?php echo $form->labelEx($model,'PASSWORD'); ?></td>
		 <td><?php echo $form->passwordField($model,'PASSWORD',array('size'=>40,'maxlength'=>64)); ?></td>
		 <td><?php echo $form->error($model,'PASSWORD'); ?></td>
 </tr>
   <tr>
		<td><?php echo $form->labelEx($model,'EMAIL'); ?></td>
		<td><?php echo $form->textField($model,'EMAIL',array('size'=>40,'maxlength'=>64)); ?></td>
		<td><?php echo $form->error($model,'EMAIL'); ?></td>
 </tr>
  <tr>
		<td><?php echo $form->labelEx($model,'GROUPNAME_ID'); ?></td>
		<td><?php echo $form->textField($model,'GROUPNAME_ID',array('size'=>40,'maxlength'=>64)); ?></td>
		<td><?php echo $form->error($model,'GROUPNAME_ID'); ?></td>
 </tr>
 <tr>
		<td><?php echo $form->labelEx($model,'ACCESSGROUP_ID'); ?></td>
		<td><?php echo $form->textField($model,'ACCESSGROUP_ID',array('size'=>40,'maxlength'=>64)); ?></td>
		<td><?php echo $form->error($model,'ACCESSGROUP_ID'); ?></td>
 </tr>
    <tr>
		<td><?php ?></td>
		<td><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></td>
		<td></td>
 </tr>
 
 
	<!--<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div> -->
<?php echo $form->errorSummary($model); ?>
<?php $this->endWidget(); ?>

</div><!-- form -->
</div>