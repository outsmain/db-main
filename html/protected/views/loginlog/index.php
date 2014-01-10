<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/assets/DataTable/js/jquery.dataTables.min.js");?>
<?php
if($user = Yii::app()->session['user']==''){
$this->redirect('index.php?r=site/login');
exit;
}

$page_name="Login Log Report"; 
$url= $_SERVER['REQUEST_URI'];
		$user = Yii::app()->session['user'];
		$status ="ok";
		$action ="OPEN";
		Func::add_loglogmodify($user,$status,$action,$url); 
?>

<div class="container" id="actualbody">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'accessname-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'afterValidate' => 'js:function(){
				 $("#datatable").dataTable( {
					"sPaginationType": "full_numbers",
					"bJQueryUI": true,
					"bProcessing": true,
					"bServerSide": true,
					"bFilter": false,
					"sAjaxSource": "'.$this->createUrl('loginlog/view').'",
					//"sAjaxSource": "server-side/scripts/server_processing.php"
					"fnServerParams": function ( aoData ) {
						aoData.push( { "name": "FromDt", "value" : $("#'.get_class($model).'_UPDATE_DATE").val() } );
						aoData.push( { "name": "ToDt" , "value" : $("#'.get_class($model).'_UPDATE_DATE2").val() } );
						aoData.push( { "name": "UserName", "value" : $("#'.get_class($model).'_USER_NAME").val() } );
						aoData.push( { "name": "UserIP" , "value" : $("#'.get_class($model).'_USER_IP").val() } );
					},
					"bDestroy": true
				} );
			}'
		),
		'htmlOptions' => array(
		'onsubmit' => "return false;",
		),
	)); ?>
	<div class="row clearfix">
		<div class="col_12">
			<div class="widget clearfix">
				<h2>Filter</h2>
				<div class="widget_inside">                                
					<div class="col_2">
						<div class="clearfix">
						<label>Start Date</label>
							<div class="input">
							<div class="input">
								 <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
								$this->widget('CJuiDateTimePicker',array(
								'model'=>$model, //Model object
								'attribute'=>'UPDATE_DATE', //attribute name
								'mode'=>'datetime', //use "time","date" or "datetime" (default)
								'options'=>array('timeFormat'=>'hh:mm',
												'dateFormat'=>'yy-mm-dd', 
												'altFormat'=>'yy-mm-dd', 
												'showSecond'=>false), // jquery plugin options
								'language' => ''
							));
						?>
					<?php echo $form->error($model,'UPDATE_DATE'); ?>
				  </div>
							 </div>
						</div>
					</div>				
					<div class="col_2">
					<?php echo $form->labelEx($model,'End Date');?>
						<div class="input">
							 <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
								$this->widget('CJuiDateTimePicker',array(
								'model'=>$model, //Model object
								'attribute'=>'UPDATE_DATE2', //attribute name
								'value'=>date('YY-m-d 23:59:59'),
								'mode'=>'datetime', //use "time","date" or "datetime" (default)
								
								'options'=>array('timeFormat'=>'hh:mm',
												'dateFormat'=>'yy-mm-dd', 
												'altFormat'=>'yy-mm-dd',
												'showButtonPanel'=>true,
												  'showAnim'=>'fold',
												'showSecond'=>false), // jquery plugin options
								'language' => ''
							));
						?>
					<?php echo $form->error($model,'UPDATE_DATE2'); ?>
						</div>
					</div>
					<div class="col_2">
						<label>User Name</label>
						<div class="input">	
						<?php echo $form->textField($model,'USER_NAME',array('size'=>20)); ?> 
						</div>
					</div>
					<div class="col_2">
						<label>User IP</label>
						<div class="input">	
						<?php echo $form->textField($model,'USER_IP',array('size'=>20)); ?> 
						</div>
					</div>
				</div>
				<div class="col_2 last">
					<div class="input">
						 <?php echo CHtml::submitButton('Submit',array('id'=>'submit','value'=>'Submit','class'=>'button blue',)); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php $this->endWidget(); ?>

	<div class="row clearfix">
		<div class="col_12">
			<div class="widget clearfix">
				<h2>Report</h2>
				<div class="widget_inside">                                
					<div class="report">
					<div class="col_12">
						<div id="container">  
							<table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
								<thead>
									<tr>
										<th width="20%">Login Date</th>
										<th width="15%">User name</th>
										<th width="15%">UserIP</th>
										<th width="15%">Command</th>
										<th width="25%">Description</th>
										<th width="15%">Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan="6" class="dataTables_empty">Loading data from server</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="spacer"></div>
</div>


<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	var getClass = "<?=get_class($model)?>";
	$("#datatable").dataTable( {
		"sPaginationType": "full_numbers",
		"bJQueryUI": true,
		"bProcessing": true,
		"bServerSide": true,
		"bFilter": false,
		"sAjaxSource": "<?=$this->createUrl('loginlog/view')?>",
		"fnServerParams": function ( aoData ) {
			aoData.push( { "name": "FromDt", "value" : $("#"+getClass+"_UPDATE_DATE").val() } );
			aoData.push( { "name": "ToDt" , "value" : $("#"+getClass+"_UPDATE_DATE2").val() } );
			aoData.push( { "name": "UserName", "value" : $("#"+getClass+"_USER_NAME").val() } );
			aoData.push( { "name": "UserIP" , "value" : $("#"+getClass+"_USER_IP").val() } );
		},
		"bDestroy": true
	} );
});
</script>