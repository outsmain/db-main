<?php
/* @var $this ACCESSGROUPController */
/* @var $model ACCESSGROUP */
/* @var $form CActiveForm */
?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/assets/scripts/jquery-1.6.4.min.js");?>
<script type="text/javascript">
$(document).ready(function() {
 
    $('#btn-add').click(function(){
        $('#select-from option:selected').each( function() {
                $('#select-to').append("<option value='"+$(this).val()+"' selected >"+$(this).text()+"</option>");
            $(this).remove();
        });
    });
    $('#btn-remove').click(function(){
        $('#select-to option:selected').each( function() {
            $('#select-from').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
            $(this).remove();
        });
    });
	selectBox = document.getElementById("select-to");

        for (var i = 0; i < selectBox.options.length; i++) 
        { 
             selectBox.options[i].selected = true; 
        } 
});
</script>
<script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
<style>
.box { width: 200px;}
.btnadd {width:50; height:30;font-size:6;position:absolute}
.btnre {width:50; height:30;font-size:6;}
</style>
<div class="container" id="actualbody">
<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<h2>Create ACCESSGROUP</h2>
<div class="widget_inside">
<div class="form">
<?php
$ac_id = 6;
$row=Yii::app()->db->createCommand("SELECT ACCESSGROUP_ID FROM ACCESSGROUP WHERE ACCESSGROUP_ID = '{$ac_id}' ")->queryAll();
		$row_name=Yii::app()->db->createCommand("SELECT ACCESSGROUP_ID FROM GROUPNAME WHERE ACCESSGROUP_ID = '{$ac_id}' ")->queryAll();
			if((!$row)&&($row_name)){
				//$row2=Yii::app()->db->createCommand("UPDATE GROUPNAME SET ACCESSGROUP_ID = '' WHERE ACCESSGROUP_ID = '{$ac_id}'")->queryAll();
				echo 'xx';
			}
	?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'accessgroup-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="clearfix">
		<?php //echo $form->labelEx($model,'ACCESSGROUP_ID'); ?>
		<label> Access Group </label>
		<div class="input">	
		<?php echo $form->dropDownList($model,'ACCESSGROUP_ID',GROUPNAME::getDroupdownid(),array('empty'=>'None')); ?>
		</div>
		<?php echo $form->error($model,'ACCESSGROUP_ID'); ?>
	</div>

	<div class="clearfix">
		<label> Date/Time </label>
		<div class="input">	
		 <select name="select-from[]" size="5" multiple id="select-from" class ="box">
		 <?php 
		$row=Yii::app()->db->createCommand("SELECT * FROM ACCESSNAME")->queryAll();
		//print_r($row['ID']);
			foreach($row as $item_id){
			$id = $item_id['ID'];
			$bst2 = $item_id['ENDTIME'];
			$do2 = substr($bst2,0,5);	
			$bst = $item_id['STARTTIME'];		
			$arrst = explode(",",$do);
			$tim = $do.','.$do2.','.$tim;	
			$bdow = $item_id['DOW'];	
			$sdow = explode(",",$edow);
			$tim2 = $bdow.','.$tim2;	
			$starttime .= $bst.',';
			$endtime .= $bst2.',';
			$asat = explode(",",$tim2);			
			$strtime = explode(",",$starttime);
			$edtime = explode(",",$endtime);
			array_pop($strtime);
			array_pop($edtime);
			$result_day =  Func::checkWeek($asat);
			$result_arr =  Func::creatArray($strtime,$edtime);
			$result_time = Func::checkGrouptime($result_arr);

		?>
		 <option value="<?php echo $id; ?>"><?php  echo $result_day.'@'.$result_time; foreach($sdow as $starttime){ } foreach($sdow as $tim2){ } foreach($sdow as $endtime){ }?></option>
			<?php 
				}
			?>
		</select>
		<input type="button"  id="btn-add" value="Add" class ="btnadd">
		<input type="button"  id="btn-remove" value="Remove" class ="btnre">
		<select name="selectto[]" id="select-to" multiple size="5" class ="box" selected> 
		</select>
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
	</div>
	</div><!-- form -->

