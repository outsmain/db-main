<?php
/* @var $this AccessnameController */
/* @var $model ACCESSNAME */
/* @var $form CActiveForm */

?>
</script>
<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<div class="widget_inside">
<div class="form">
<link rel="stylesheet" type="text/css" href="jquery.datetimepicker.css"/ >
<script src="jquery.js"></script>
<script src="jquery.datetimepicker.js"></script>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'accessname-form',
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="clearfix">
	<?php echo $form->labelEx($model,'STARTTIME'); ?>
		<div class="input">
                     <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
					$this->widget('CJuiDateTimePicker',array(
					'model'=>$model, //Model object
					'attribute'=>'STARTTIME', //attribute name
					'mode'=>'time', //use "time","date" or "datetime" (default)
					'options'=>array('timeFormat'=>'hh:mm:ss',
									'showSecond'=>true), // jquery plugin options
					'language' => ''
				));
			?>
        <?php echo $form->error($model,'STARTTIME'); ?>
      </div>
		
		<?php echo $form->error($model,'STARTTIME'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'ENDTIME'); ?>
		<div class="input">
                     <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
					$this->widget('CJuiDateTimePicker',array(
					'model'=>$model, //Model object
					'attribute'=>'ENDTIME', //attribute name
					'mode'=>'time', //use "time","date" or "datetime" (default)
					'options'=>array('timeFormat'=>'hh:mm:ss',
									'showSecond'=>true), // jquery plugin options
					'language' => ''
				));
			?>
			</div>
		<?php echo $form->error($model,'ENDTIME'); ?>
	</div>

	<div class="clearfix">
	<div style="padding-bottom:10px;"><?php echo $form->labelEx($model,'DOW');?></div>
		 <div class="input" id="checkBoxists">
		 <?php
		   echo CHtml::checkBoxList('DOW',$dow,array('SUNDAY'=>'SUNDAY','MONDAY'=>'MONDAY','TUESDAY'=>'TUESDAY','WEDNESDAY'=>'WEDNESDAY',
														'THURSDAY'=>'THURSDAY','FRIDAY'=>'FRIDAY','SATURDAY'=>'SATURDAY')
													);
		?>										
		 
		</div>
		<?php echo $form->error($model,'DOW'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'ALLOWIP'); ?>
		<div class="input">	
		<?php echo $form->textField($model,'ALLOWIP',array('size'=>15,'maxlength'=>15)); ?>
		</div>
		<?php echo $form->error($model,'ALLOWIP'); ?>
		
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