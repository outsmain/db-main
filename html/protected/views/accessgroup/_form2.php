<?php
/* @var $this ACCESSGROUPController */
/* @var $model ACCESSGROUP */
/* @var $form CActiveForm */
?>

<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<div class="widget_inside">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'accessgroup-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'ACCESSGROUP_ID'); ?>
		<div class="input">	
		<?php echo $form->textField($model,'ACCESSGROUP_ID'); ?>
		</div>
		<?php echo $form->error($model,'ACCESSGROUP_ID'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'ACCESSNAME_ID'); ?>
		<div class="input">	
		 <select name="ACCESSNAME_ID" class="input">
		 <?php 
		$row=Yii::app()->db->createCommand("SELECT * FROM ACCESSNAME")->queryAll();
		//print_r($row['ID']);
		foreach($row as $item){
		$id = $item['ID'];
		$dow = $item['DOW'];
		$st = substr($item['STARTTIME'],0,5);		
		$et = substr($item['ENDTIME'],0,5);		
		$sdow = explode(",",$dow);
		?>
		 <option value="<?php echo $id; ?>"><?php echo $st.",".$et; foreach($sdow as $ss){ $q = substr($ss,0,3); echo ",".$q;} ?></option>
		 <?php
		}
		?>
		<?php echo $form->hiddenField($model,'ACCESSNAME_ID',array('type'=>"hidden")); ?>
		</div>
		<?php echo $form->error($model,'ACCESSNAME_ID'); ?>
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