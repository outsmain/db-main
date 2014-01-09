<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/DataTable/css/dataTable.css" type="text/css" media="screen" />
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/assets/DataTable/js/jquery.dataTables.js");?>
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/search.js");?>
<div class="container" id="actualbody">
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
			if($(".errorSummary").css("display") !== "none") return false;
			if(StartDate.val() == ""){
				$("#'.get_class($model).'_StartDate").parent().removeClass("input").addClass("input error");
				$("#'.get_class($model).'_StartDate_em_").css({"display":"block"}).html("Start Date cannot be blank.");
				$("#req_result").hide();
				$("#error-search").show();
				$("#frmExport").hide();
				return false;
			}
			if(EndDate.val() == ""){
				$("#'.get_class($model).'_EndDate").parent().removeClass("input").addClass("input error");
				$("#'.get_class($model).'_EndDate_em_").css({"display":"block"}).html("Start Date cannot be blank.");
				$("#req_result").hide();
				$("#error-search").show();
				return false;
			}
			if(!CheckFormatDate(StartDate.val())){
				$("#'.get_class($model).'_StartDate").parent().removeClass("input").addClass("input error");
				$("#'.get_class($model).'_StartDate_em_").css({"display":"block"}).html("Please fill in the correct.");
				$("#req_result").hide();
				$("#error-search").show();
				$("#frmExport").hide();
				return false;
			}
							
			if(!CheckFormatDate(EndDate.val())){
				$("#'.get_class($model).'_EndDate").parent().removeClass("input").addClass("input error");
				$("#'.get_class($model).'_EndDate_em_").css({"display":"block"}).html("Please fill in the correct.");
				$("#req_result").hide();
				$("#error-search").show();
				$("#frmExport").hide();
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
				},
				"fnInitComplete": function(oSettings) {
					if($("#req_result").css("display") === "none") $("#req_result").css("display","");
					if($("#frmExport").css("display") === "none") $("#frmExport").css("display","");
					$("#error-search").hide();
					var txt = eval("("+oSettings.jqXHR.responseText+")");
					$("#tmpSQL").val(txt.tmpSQL);
					$("#num_row").val(txt.iTotalRecords);
				}
			});
		}'
	),
	'htmlOptions' => array(
        'onsubmit' => "return false;",
    ),
));
?>
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
                    <div class="input" style="padding:0 0 0 50px;">
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
<?php $this->endWidget(); ?>
<div class="row clearfix">
	<div class="col_12">
		<div class="widget clearfix">
        <h2>Report</h2>
			<div class="widget_inside">				
				<div class="report">
					<div class="col_12" id="req_result">
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
			<form name="frmExport" id="frmExport" method="post" action="" target="iframe_target" style="display:none;">
				<iframe id="iframe_target" name="iframe_target" style="width:0;height:0;border:0px;"></iframe>
				<input type="textarea" id="tmpSQL" name="tmpSQL" style="display:none;"></textarea>
				<div style="padding-left:20px;">
					<button id="rerun">Export data</button>
					<button id="select">Select an action</button>
				</div>
				<ul>
					<li><a id="excel">Excel (*.xlsx)</a></li>
					<li><a id="txt">Tab Delimited (*.txt)</a></li>
					
				</ul>
			</form>
			<div id="error-search" align="center" style="font-size:14px;font-weight:bold;display:none;">Please fill out completely and accurately.</div>
			<input type="hidden" id="num_row">
        </div>
    </div>
</div>  
        </div><!--container -->
    </div>
</div>

<div id="hide-sql" style="display:none;"></div>
<script type="text/javascript">
	var secondurl = "<?php echo $this->createUrl('Detail')?>";
	var urlExportData ="<?php echo $this->createUrl('CheckExportData')?>";
	var cl = '<?=get_class($model)?>';
	$(document).ready(function(){
		var StartDate = $('#'+"<?=get_class($model)?>"+'_StartDate');
		var EndDate = $('#'+"<?=get_class($model)?>"+'_EndDate');
		if($('.errorSummary').css('display') !== 'none') return false;
		if(StartDate.val() == ''){
			$('#'+cl+'_StartDate').parent().removeClass('input').addClass('input error');
			$('#'+cl+'_StartDate_em_').css({'display':'block'}).html('Start Date cannot be blank.');
			$('#req_result').hide();
			$('#error-search').show();
			return false;
		}
		if(EndDate.val() == ''){
			$('#'+cl+'_EndDate').parent().removeClass('input').addClass('input error');
			$('#'+cl+'_EndDate_em_').css({'display':'block'}).html('Start Date cannot be blank.');
			$('#req_result').hide();
			$('#error-search').show();
			return false;
		}
		if(!CheckFormatDate(StartDate.val())){
			$('#'+cl+'_StartDate').parent().removeClass('input').addClass('input error');
			$('#'+cl+'_StartDate_em_').css({'display':'block'}).html('Please fill in the correct.');
			$('#req_result').hide();
			$('#error-search').show();
			return false;
		}
		if(!CheckFormatDate(EndDate.val())){
			$('#'+cl+'_EndDate').parent().removeClass('input').addClass('input error');
			$('#'+cl+'_EndDate_em_').css({'display':'block'}).html('Please fill in the correct.');
			$('#req_result').hide();
			$('#error-search').show();
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
				$('#frmExport').show();
				var txt = eval('('+oSettings.jqXHR.responseText+')');
				$('#num_row').val(txt.iTotalRecords);
				$('#tmpSQL').val(txt.tmpSQL);
				$('#dataTable').hover().css('cursor','pointer');
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
		$( "#rerun" ).button().next().button({
				text: false,
				icons: {
					primary: "ui-icon-triangle-1-s"
				}
			}).click(function() {
				var menu = $( this ).parent().next().show().position({
				my: "left top",
				at: "left bottom",
				of: this
			});
			$('#excel').one("click", function(){
				menu.hide();
				$("#dia-exp").dialog({ position: {my:'right bottom', at:'right bottom', of:window}, width:250, hieght:140, title:'Export excel (.*xlsx)'});
				$("#frmExport").attr("action","<?php echo $this->createUrl('UserExportExcel')?>").submit();
				CheckStatus('exl',$('#num_row').val());
			});
			$('#txt').one("click", function() {
				menu.hide();
				$("#dia-exp").dialog({ position: {my:'right bottom', at:'right bottom', of:window}, width:250, hieght:140, title:'Export tab delimited (*.txt)'});
				$("#frmExport").attr("action","<?php echo $this->createUrl('UserExportTxt')?>").submit();
				CheckStatus('txt',$('#num_row').val());
			});
				return false;
			}).parent().buttonset().next().hide().menu();
	});
</script>
<div id="dialog" title="Node Detail Dialog"></div>
<div id="dia-exp" title="">Export data...</div>
