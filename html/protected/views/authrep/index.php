<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/DataTable/css/dataTable.css" type="text/css" media="screen" />
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/assets/DataTable/js/jquery.dataTables.min.js");?>
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/search.js");?>
<?php 
$serv = $_GET["serv"];
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'auth-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'afterValidate' => 'js:function(){
			var StartDate = $("#'.get_class($model).'_StartDate");
			var EndDate = $("#'.get_class($model).'_EndDate");
			if($(".errorSummary").css("display") !== "none" || StartDate.val() == "" || EndDate.val() == ""){
				alert("Please input Start Date and End Date");
				return false;
			}
			if(!CheckFormatDate(StartDate.val()) || !CheckFormatDate(EndDate.val())){
				alert("Please input date to format DD/MM/YYYY HH:MM:SS");
				return false;
			}
			$("#dataTable").dataTable().fnDestroy();
			var NodeName = $("#NodeName").val();
			if(NodeName !== null){
				NodeName = (NodeName.length == $("#NodeName option").length) ? "" : NodeName;
			}else{
				NodeName = "";
			}
				$("#dataTable").dataTable({
				"sPaginationType": "full_numbers",
				"bJQueryUI": true,
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "'.$this->createUrl($serv).'",
				"fnServerParams": function ( aoData ) {
					aoData.push( {"name": "username", "value": $("#UserName").val()} );
					aoData.push( {"name": "start_date", "value": StartDate.val()} );
					aoData.push( {"name": "end_date", "value": EndDate.val()} );
					aoData.push( {"name": "ne_name", "value": NodeName} );
					aoData.push( {"name": "event", "value": $("#Event option:selected").val()} );
					aoData.push( {"name": "click", "value": "true"} );
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
				<div class="col_2">
                    <div style="padding-bottom:10px;"><?php echo $form->labelEx($model,'Event');?></div>
                    <div class="input">
						<? //echo CHtml::dropDownList('Event','',CHtml::listData(TblAuthacct::model()->findAll(), 'status', 'status'),array('empty' => 'All'));
						echo CHtml::dropDownList('Event','',array('ACCEPT'=>'Accept','REJECT'=>'Reject'),array('empty' => 'All'));
						?>    
						<?
						Yii::import('application.extensions.multiselect.multiSelect');
						$options = array(
							'multiple' => false,
							'header' => 'Select an option',
							'noneSelectedText' => "All",
						);
						multiSelect::addMultiselect('#Event',$options);
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

						$sql = Yii::app()->db->createCommand("SELECT (CASE WHEN name IN ('', NULL) THEN ip_addr WHEN ip_addr IN ('', NULL) THEN name ELSE CONCAT(name, 'xx#xx', ip_addr) END) AS value,(CASE WHEN name IN ('', NULL) THEN ip_addr WHEN ip_addr IN ('', NULL) THEN name ELSE CONCAT(name, ' / ', ip_addr) END) AS item,site_name FROM NE_LIST GROUP BY ip_addr")->queryAll();
						$data = CHtml::listData($sql, 'value', 'item' ,'site_name');
						echo CHtml::dropDownList('NodeName','',$data,array('multiple' => 'multiple',)); 
						$options = array(
							'multiple' => true,
						);
						multiSelect::addMultiselect('#NodeName',$options);
						//echo CHtml::textField('NodeName','',array('id'=>'NodeName','width'=>100,'maxlength'=>100,"placeholder"=>"CLLI or IP Address","class"=>"medium"));
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
                    <div class="input" style="padding:6 0 0 40px;">
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
						 <table id='dataTable' class="dataTable">
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
							<tbody id="tbody"></tbody>
						</table> 
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
		var StartDate = $('#'+"<?=get_class($model)?>"+'_StartDate');
		var EndDate = $('#'+"<?=get_class($model)?>"+'_EndDate');
		if($('.errorSummary').css('display') !== 'none' || StartDate.val() == '' || EndDate.val() == ''){
			alert('Please input Start Date and End Date');
			return false;
		}
		if(!CheckFormatDate(StartDate.val()) || !CheckFormatDate(EndDate.val())){
			alert('Please input date to format DD/MM/YYYY HH:MM:SS');
			return false;
		}
		$('#dataTable').dataTable({
			"sPaginationType": "full_numbers",
			"bJQueryUI": true,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo $this->createUrl($serv)?>",
			"fnServerParams": function ( aoData ) {
				aoData.push( {"name": "username", "value": $('#UserName').val()} );
				aoData.push( {"name": "start_date", "value": StartDate.val()} );
				aoData.push( {"name": "end_date", "value": EndDate.val()} );
				aoData.push( {"name": "ne_name", "value": $('#NodeName').val()} );
				aoData.push( {"name": "event", "value": $('#Event option:selected').val()} );
				aoData.push( {"name": "click", "value": false} );
			},
			"fnInitComplete": function(oSettings) {
				$('#dataTable tbody tr').live('click', function () {
					var nTds = $('td', this);
					var ip = $(nTds[2]).text();
					$.ajax({
						url: secondurl,
						dataType: 'json',
						cache: false,
						type: 'post',
						data: {'ip':ip},
						success: function(data) {
							ShowDialog(data);
						}
					});
				});
			}
		});
	});
</script>
<div id="dialog" title="Node Detail Dialog"></div>