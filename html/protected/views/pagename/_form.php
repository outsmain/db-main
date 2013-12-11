<?php
/* @var $this PAGENAMEController */
/* @var $model PAGENAME */
/* @var $form CActiveForm */
?>

<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<div class="widget_inside">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pagename-form',
	'enableAjaxValidation'=>false,
)); ?>
<p> </p>
	<?php echo $form->errorSummary($model); ?>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'NAME'); ?>
		<div class="input">
		<?php echo $form->textField($model,'NAME',array('size'=>60,'maxlength'=>64)); ?>
		</div>
		<?php echo $form->error($model,'NAME'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'TITLE'); ?>
		<div class="input">	
		<?php echo $form->textField($model,'TITLE',array('size'=>60,'maxlength'=>64)); ?>
		</div>
		<?php echo $form->error($model,'TITLE'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'COMMENT'); ?>
		<div class="input">	
		<?php echo $form->textField($model,'COMMENT',array('size'=>60,'maxlength'=>256)); ?>
		</div>
		<?php echo $form->error($model,'COMMENT'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'MODELNAME'); ?>
		<div class="input">	
		<?php echo $form->textField($model,'MODELNAME',array('size'=>60,'maxlength'=>64)); ?>
		</div>
		<?php echo $form->error($model,'MODELNAME'); ?>
	</div>

	<div class="clearfix">
		
		<?php echo $form->labelEx($model,'TYPE'); ?>
		<div class="input">	
		<?php echo $form->dropDownList($model,'TYPE',array('1'=>'PAGE','2'=>'MENU','3'=>'PANEL','4'=>'GRAPHIC'), array('options' => array('1'=>array('selected'=>true))));?>
		</div>
		<?php echo $form->error($model,'TYPE'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'NEXTPAGE'); ?>
		<div class="input">	
		<?php echo $form->dropDownList($model,'NEXTPAGE',PAGENAME::getPagename(),array('empty'=>'not nextpage')); ?>
		</div>
		<?php echo $form->error($model,'NEXTPAGE'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'PREVPAGE'); ?>
		<div class="input">	
		<?php echo $form->dropDownList($model,'PREVPAGE',PAGENAME::getPagename(),array('empty'=>'not prevpage')); ?>
		</div>
		<?php echo $form->error($model,'PREVPAGE'); ?>
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