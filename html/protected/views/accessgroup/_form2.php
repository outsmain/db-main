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
});
function selectAll(){
var lstIn = document.formList.selectto;
for(i=lstIn.length-1;i>=0;i--){
lstIn.options[i].selected=true;
}
}


</script>
<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<div class="widget_inside">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'accessgroup-form',
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
		<!-- <select name="ACCESSNAME_ID" class="input">-->
		 <select name="select-from[]" size="5" multiple id="select-from">
		 <?php 
		 $row3=Yii::app()->db->createCommand("SELECT  DISTINCT a.ID, STARTTIME, ENDTIME, DOW  FROM ACCESSNAME a JOIN  ACCESSGROUP b ON(b.ACCESSNAME_ID =a.ID) WHERE b.ACCESSGROUP_ID ='{$id5}'") ->queryAll();
			foreach($row3 as $item_id3){
				$ee =$item_id3['ID'];
				$sq .= " AND ID != "."'".$ee."'";
			}
			$gdg = "SELECT * FROM ACCESSNAME WHERE ID !=''".$sq;
		$row=Yii::app()->db->createCommand($gdg) ->queryAll();
		//print_r($row['ID']);
			foreach($row as $item_id){
			$id = $item_id['ID'];
			$bst2 = $item_id['ENDTIME'];
			$do2 = substr($bst2,0,5);	
			$bst = $item_id['STARTTIME'];
			//$do = substr($bst,0,5);		
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
			$result_time =  Func::checkGrouptime($result_arr);

		?>
		 <option value="<?php echo $id; ?>" ><?php  echo $result_day.'@'.$result_time; foreach($sdow as $starttime){ } foreach($sdow as $tim2){ } foreach($sdow as $endtime){ }?></option>
			<?php 
			}
			?>
		</select>
		<a href="JavaScript:void(0);" id="btn-add" align ="top">Add &raquo;</a>
		<a href="JavaScript:void(0);" id="btn-remove">&laquo; Remove</a>
		<select name="selectto[]"  multiple size="5" id="select-to" selected>
		 <?php 
		$row2=Yii::app()->db->createCommand("SELECT  DISTINCT a.ID, STARTTIME, ENDTIME, DOW  FROM ACCESSNAME a JOIN  ACCESSGROUP b ON(b.ACCESSNAME_ID =a.ID) WHERE b.ACCESSGROUP_ID ='{$id5}'") ->queryAll();
			foreach($row2 as $item_id2){
			$id2 = $item_id2['ID'];
			$bst22 = $item_id2['ENDTIME'];
			$do22 = substr($bst22,0,5);	
			$bst2 = $item_id2['STARTTIME'];	
			$arrst2 = explode(",",$do2);
			$tim2 = $do2.','.$do22.','.$tim2;	
			$bdow2 = $item_id2['DOW'];	
			$sdow2 = explode(",",$edow2);
			$tim22 = $bdow2.','.$tim22;	
			$starttime2 .= $bst2.',';
			$endtime2 .= $bst22.',';
			$asat2 = explode(",",$tim22);			
			$strtime2= explode(",",$starttime2);
			$edtime2 = explode(",",$endtime2);
			array_pop($strtime2);
			array_pop($edtime2);
			$result_day2 =  Func::checkWeek($asat2);
			$result_arr2 =  Func::creatArray($strtime2,$edtime2);
			$result_time2 = Func::checkGrouptime($result_arr2);

		?>
		 <option value="<?php echo $id2; ?>"  selected><?php  echo $result_day2.'@'.$result_time2; foreach($sdow2 as $starttime2){ } foreach($sdow2 as $tim22){ } foreach($sdow2 as $endtime2){ }?></option>
			<?php 
			}
				?>
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
	</div><!-- form -->