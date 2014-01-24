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
<style>
span.checkbox-columns {
float:left;
width: 30%;
overflow:auto;
	}
@media (max-width:800px) {
span.checkbox-columns {
clear:both;
display:block;
float:none;
width:80%;
	}
}
</style>
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
	<div class="input" style="padding-left:80px;">	
		<label>Page Allow</label>
	</div>
		<div class="input" style="padding-left:180px;">	
		<?php $listData = CHtml::listData(PAGENAME::model()->findAll(), 'ID', 'NAME'); ?>
		<?php echo CHtml::checkBoxList('PAGENAME_ID',$pag,$listData,array('ID'=>'checklist','separator'=>'',
			 'template'=>'<span class="checkbox-columns">{input} {label}</span>')); ?>	
			 <?php// echo CHtml::checkBoxList('PAGENAME_ID',$pag,$listData,array('ID'=>'checklist')); ?>
		</div>
		<?php echo $form->error($model2,'PAGENAME_ID'); ?>
		<div class="clearfix">
		<div class="input">	
		</div>
		</div>

		<div class="clearfix">
		<?php echo $form->labelEx($model,'ACCESSGROUP_ID'); ?>
		<div class="input">	
		<select name="ACCESSGROUP_ID" class="input"> 
		 <?php 
		
		$row=Yii::app()->db->createCommand(" SELECT * FROM ACCESSGROUP a
											LEFT JOIN ACCESSNAME b ON ( a.ACCESSNAME_ID = b.ID ) GROUP BY ACCESSGROUP_ID ")->queryAll();
		//print_r($row['ID']);
		foreach($row as $item){
		$id = $item['ACCESSGROUP_ID'];
		$row_id =Yii::app()->db->createCommand(" SELECT * FROM ACCESSGROUP a
											LEFT JOIN ACCESSNAME b ON ( a.ACCESSNAME_ID = b.ID ) WHERE ACCESSGROUP_ID = '{$id}'")->queryAll();
		
			foreach($row_id as $item_id){
			
			$bst2 = $item_id['ENDTIME'];
			$do2 = substr($bst2,0,5);	
			$bst = $item_id['STARTTIME'];
			//$do = substr($bst,0,5);		
			$arrst = explode(",",$do);
			
			$tim = $do.','.$do2.','.$tim;	

			$bdow = $item_id['DOW'];	
			$sdow = explode(",",$edow);
			//$ssdow = explode(",",$bdow);

			$tim2 = $bdow.','.$tim2;	
			$starttime .= $bst.',';
			$endtime .= $bst2.',';
			$asat = explode(",",$tim2);			
			$strtime = explode(",",$starttime);
			$edtime = explode(",",$endtime);
		}
			array_pop($strtime);
			array_pop($edtime);
			$result_day =  Func::checkWeek($asat);
			$result_arr =  Func::creatArray($strtime,$edtime);
			$result_time =  Func::checkGrouptime($result_arr);
			
		//	print_r($result_arr);		
		?>
		<option value="<?php echo $id; ?>"><?php  echo $result_day.'@'.$result_time; foreach($sdow as $starttime){ } foreach($sdow as $tim2){ } foreach($sdow as $endtime){ }?></option>
		 
		 <?php
		}
			
		?>
		<?php echo $form->hiddenField($model,'ACCESSGROUP_ID',array('type'=>"hidden")); ?>
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