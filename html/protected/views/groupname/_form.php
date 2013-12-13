<?php
/* @var $this GROUPNAMEController */
/* @var $model GROUPNAME */
/* @var $form CActiveForm */
?>
<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<div class="widget_inside">

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groupname-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p></p>
<div class="clearfix">
	<?php echo $form->errorSummary($model); ?>
	
		<?php echo $form->labelEx($model,'NAME'); ?>
	<div class="input">	
		<?php echo $form->textField($model,'NAME',array('size'=>32,'maxlength'=>32)); ?>
	</div>
		<?php echo $form->error($model,'NAME'); ?>
	
</div>
<div class="clearfix">

		<?php echo $form->labelEx($model,'COMMENT'); ?>
		<div class="input">	
		<?php echo $form->textField($model,'COMMENT',array('size'=>60,'maxlength'=>256)); ?>
		</div>
		<?php echo $form->error($model,'COMMENT'); ?>
	</div>
	
	
		<?php //echo $form->labelEx($model2,'PAGENAME_ID'); ?>	
		<div class="input" style="padding-left:90;">	
		<label>Page Allow</label>
		</div>
		<div class="input" style="padding-left:180px;">	
		 <?php $listData = CHtml::listData(PAGENAME::model()->findAll(), 'ID', 'NAME'); ?>
		<?php echo CHtml::checkBoxList('PAGENAME_ID',$pag,$listData,array('ID'=>'checklist')); ?>
		</div>
		<?php echo $form->error($model2,'PAGENAME_ID'); ?>
		
		
	<div class="clearfix">
		<?php echo $form->labelEx($model,'ACCESSGROUP_ID'); ?>
		<div class="input">	
		<?php echo $form->dropDownList($model,'ACCESSGROUP_ID',ACCESSGROUP::getDroupdown()); ?>
		</div>
		<?php echo $form->error($model,'ACCESSGROUP_ID'); ?>
	</div>
<div class="clearfix">
		<?php echo $form->labelEx($model,'PLATFORM_ID'); ?>
		<div class="input">	
		<?php echo $form->dropDownList($model,'PLATFORM_ID',PLATFORM::getflatformid()); ?>
		<?php echo $form->error($model,'PLATFORM_ID'); ?>
	</div>
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
</div>
</div><!-- form -->