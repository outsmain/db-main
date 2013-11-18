<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/assets/DataTable/js/jquery.dataTables.min.js");?>
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/search.js");?>
<?php 
$serv = (empty($_GET["serv"])) ? 'Online' : $_GET["serv"];
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'auth-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'afterValidate' => 'js:function(){
			if($(".errorSummary").css("display") !== "none") return;
			var result = $("#req_result");
			result.html("<img src='.Yii::app()->request->baseUrl.'/images/loading.gif>");
			$.ajax({
				url: "'.$this->createUrl($serv).'",
				dataType: "json",
				cache: false,
				type: "post",
				data:{"username":$("#UserName").val(),"start_date":$("#'.get_class($model).'_StartDate").val(),"end_date":$("#'.get_class($model).'_EndDate").val(),"ne_name":$("#NodeName").val(),"event":$("#Event option:selected").val(),"click":"true"},
				success: function(data) {
					SplitTable(data);
				}
			});
		}'
	),
	'htmlOptions' => array(
        'onsubmit' => "return false;",
    ),
));
?>
<div class="container" id="actualbody">
<?php echo $form->errorSummary($model); ?>
<div class="row clearfix">
	<div class="col_12">
		<div class="widget clearfix">
        <h2>Filter</h2>
			<div class="widget_inside">				
				<div class="col_2">
                    <div class="clearfix">
                        <div style="padding-bottom:10px;"><?php echo $form->labelEx($model,'StartDate');?></div>
                        <div class="input">
						<?php
						$this->widget('application.extensions.timepicker.timepicker', array(
							'model'=>$model,
							'name'=>'StartDate',
							'id' => 'StartDate',
							'datetime'=>date('d-m-Y 00:00:00'),
						)); ?>
						 <?php echo $form->error($model,'StartDate'); ?>
                        </div>
                    </div>
				</div>
				<div class="col_2">
                    <div style="padding-bottom:10px;"><?php echo $form->labelEx($model,'EndDate');?></div>
                    <div class="input">
					   <?php
						$this->widget('application.extensions.timepicker.timepicker', array(
							'model'=>$model,
							'name'=>'EndDate',
							'id' => 'EndDate',
							'datetime'=>date('d-m-Y 23:59:59'),
						));?>
						<?php echo $form->error($model,'EndDate'); ?>
                    </div>
                </div>
				<div class="col_1">
                    <div style="padding-bottom:10px;"><?php echo $form->labelEx($model,'Event');?></div>
                    <div class="input">
						<? //echo CHtml::dropDownList('Event','',CHtml::listData(TblAuthacct::model()->findAll(), 'status', 'status'),array('empty' => 'All'));
						echo CHtml::dropDownList('Event','',array('ACCEPT'=>'Accept','REJECT'=>'Reject'),array('empty' => 'All'));
						?>    
                    </div>
                </div>

				<div class="col_2">
                    <div style="padding-bottom:10px;"><?php echo $form->labelEx($model,'UserName');?></div>
                    <div class="input">
					   <?php
					   echo CHtml::textField('UserName','',array('id'=>'UserName','width'=>100,'maxlength'=>100,'placeholder'=>'User Name','class'=>'medium'));
					   //echo $form->textField($model,'UserName','',array('id'=>'UserName','width'=>100,'maxlength'=>100,'placeholder'=>'User Name','class'=>'medium')); 
					   //echo CHtml::activeTextField($model,'UserName',array('id'=>get_class($model).'_'.'UserName','width'=>100,'maxlength'=>100,'placeholder'=>'User Name','class'=>'medium')); 
					   ?>
					   <?php //echo $form->error($model,'UserName'); ?>
                    </div>
                </div>
				<div class="col_2">
                    <div style="padding-bottom:10px;"><?php echo $form->labelEx($model,'NodeName');?></div>
                    <div class="input"> 
						<?php
						  echo CHtml::textField('NodeName','',array('id'=>'NodeName','width'=>100,'maxlength'=>100,"placeholder"=>"CLLI or IP Address","class"=>"medium"));
						 //echo $form->textField($model,'NodeName','',array('id'=>'NodeName','width'=>100,'maxlength'=>100,"placeholder"=>"CLLI or IP Address","class"=>"medium"));
						//echo CHtml::activeTextField($model,'NodeName',array('id'=>get_class($model).'_'.'NodeName','width'=>100,'maxlength'=>100,'placeholder'=>'CLLI or IP Address','class'=>'medium')); 
						 ?>
						<?php //echo $form->error($model,'NodeName'); ?>
					</div>
				</div>
				<div class="col_2 last">
					<label>&nbsp;</label>
					<? 
					/*Yii::app()->clientScript->registerScript('alert("ok");');
					echo CHtml::textField('username','',array('id'=>'username','width'=>100,'maxlength'=>100,"placeholder"=>"CLLI or IP Address","class"=>"medium")); 
					echo CHtml::activeTextField($model,'',array('id'=>'idTextField','width'=>100,'maxlength'=>100)); 
					Yii::app()->clientScript->registerScript('yourScript', '$("#' . CHtml::activeId($model, 'start_date') . '");');
					*/?>
                    <div class="input" style="padding-top:6px;">
						<?php echo CHtml::submitButton('Submit',array('id'=>'submit','value'=>'Submit','class'=>'button blue',));
//							echo CHtml::button('submit',array('id'=>'submit','value'=>'Submit','class'=>'button blue',));
							/*echo CHtml::ajaxSubmitButton(
								'Submit',
								array('Authrep/Search'),
								array(
									'update'=>'#req_result',
									'beforeSend' => 'function(call,settings){
													$("#req_result").html("Loading, Please wait..");
												}',
								)
							);*/
						?>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
<div class="row clearfix">
	<div class="col_12">
		<div class="widget clearfix">
        <h2>Report</h2>
			<div class="widget_inside">				
				<div class="report">
					<div class="col_12"  id="req_result">
						<!-- <table class='dataTable'>
						<thead>
								<tr>
										<th class="align-left">Login Date</th>
										<th class="align-left">Node Name</th>
										<th class="align-left">Node IP</th>
										<th class="align-left">User Name</th>
										<th class="align-left">User IP</th>
										<th class="align-left">Command</th>
								</tr>
							</thead>
							<tbody>
								<tr class="gradeX">
										<td>1 Oct 2013 01:20:00</td>
										<td>DSLAM 1</td>
										<td>12.1.2.2</td>
										<td>user1@domain</td>
										<td>102.2.3.1</td>
										<td>show</td>
								</tr>
								<tr class="gradeX">
										<td>1 Oct 2013 01:20:02</td>
										<td>DSLAM 1</td>
										<td>12.1.2.2</td>
										<td>user1@domain</td>
										<td>102.2.3.1</td>
										<td>show conf</td>
								</tr>
								<tr class="gradeX">
										<td>1 Oct 2013 01:21:02</td>
										<td>DSLAM 2</td>
										<td>12.1.2.3</td>
										<td>user2@domain</td>
										<td>102.2.3.1</td>
										<td>quit</td>
								</tr>
							</tbody>
						</table> -->
					</div>
				</div>
            </div>
        </div>
    </div>
</div>  
        </div><!--container -->
    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
	var secondurl = "<?php echo $this->createUrl('Detail')?>";
	var cl = '<?=get_class($model)?>';
	$(document).ready(function(){
		if($('.errorSummary').css('display') !== 'none') return;
			var result = $('#req_result');
			result.html("<img src='<?=Yii::app()->request->baseUrl;?>/images/loading.gif'>");
			$.ajax({
				url: "<?php echo $this->createUrl($serv)?>",
				dataType: 'json',
				cache: false,
				type: 'post',
				data: {'username':$('#UserName').val(),'start_date':$('#'+"<?=get_class($model)?>"+'_StartDate').val(),'end_date':$('#'+"<?=get_class($model)?>"+'_EndDate').val(),'ne_name':$('#NodeName').val(),'event':$('#Event option:selected').val(),'click':'false'},
				success: function(data) {
					SplitTable(data);
			}
		});
	});
</script>
<div id="dialog" title="Node Detail Dialog"></div>