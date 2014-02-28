<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/DataTable/css/dataTable.css" type="text/css" media="screen" />
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/assets/DataTable/js/jquery.dataTables.js");?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/flot/jquery.flot.js");?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/flot/jquery.flot.time.js");?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/search_auth.js");?>
<div class="container" id="actualbody">
<?php 
$serv = $_GET["serv"];
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'device-form',
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
				"sServerMethod": "POST",
				"sAjaxSource": "'.$this->createUrl($serv).'",
				"fnServerParams": function ( aoData ) {
					aoData.push( {"name": "start_date", "value": $("#'.get_class($model).'_StartDate").val()} );
					aoData.push( {"name": "end_date", "value": $("#'.get_class($model).'_EndDate").val()} );
					aoData.push( {"name": "ne_name", "value": NodeName} );
					aoData.push( {"name": "summary_type", "value": $("#summary_type option:selected").val()} );
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
                        <div style="padding-bottom:10px;"><?php echo $form->labelEx($model,'start_date');?></div>
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
                    <div style="padding-bottom:10px;"><?php echo $form->labelEx($model,'end_date');?></div>
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
                     <div style="padding-bottom:10px;"><?php echo $form->labelEx($model,'summary_type');?></div>
                    <div class="input">
						<?php 
						echo CHtml::dropDownList('summary_type','',array('DAILY'=>'Daily', 'DATE_HOURLY'=>'Date Hourly'));
						Yii::import('application.extensions.multiselect.multiSelect');
						$options = array(
							'multiple' => false,
							'header' => 'Select an option',
							'noneSelectedText' => "All",
						);
						multiSelect::addMultiselect('#summary_type',$options);
						?>
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
					?>
					</div>
				</div>
				<div class="col_2 last">
					<label>&nbsp;</label>
                    <div class="input" style="padding:0 0 0 70px;">
						<input type="submit" class="button blue" value="Submit">
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
                <table id='dataTable' class='dataTable'>
                <thead>
                        <tr>
								<th class="align-left">Update Date</th>
								<th class="align-left">Last Login</th>
								<th class="align-left">Node Name</th>
								<th class="align-left">Node IP</th>
								<th class="align-left">Login Num (Acp / Rej)</th>
								<th class="align-left">Success Rate (%)</th>
								<th class="align-left">Login Req. /s</th>
								<th class="align-left">Cmd Num</th>
								<th class="align-left">Cmd /s</th>                                
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
				</div>
				</div>
            </div>
			<form name="frmExport" id="frmExport" method="post" action="" target="iframe_target" style="display:none;">
				<iframe id="iframe_target" name="iframe_target" style="width:0;height:0;border:0px;"></iframe>
				<input type="textarea" id="tmpSQL" name="tmpSQL" style="display:none;">
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

<script type="text/javascript">
	var secondurl = "<?php echo $this->createUrl('Detail')?>";
	var urlExportData ="<?php echo $this->createUrl('CheckExportData')?>";
	var urlNodeName = "<?php echo $this->createUrl('NodeName')?>";
	var urlSuccessRate = "<?php echo $this->createUrl('SuccessRate')?>";
	var urlLoginRate = "<?php echo $this->createUrl('LoginRate')?>";
	var urlCmdRate = "<?php echo $this->createUrl('CmdRate')?>";
	var cl = '<?php echo get_class($model)?>';
	$(document).ready(function(){
		var StartDate = $('#'+"<?php echo get_class($model)?>"+'_StartDate');
		var EndDate = $('#'+"<?php echo get_class($model)?>"+'_EndDate');
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
				aoData.push( {"name": "start_date", "value": StartDate.val()} );
				aoData.push( {"name": "end_date", "value": EndDate.val()} );
				aoData.push( {"name": "ne_name", "value": $('#NodeName').val()} );
				aoData.push( {"name": "summary_type", "value": $('#summary_type option:selected').val()} );
				aoData.push( {"name": "click", "value": false} );
			},
			"fnInitComplete": function(oSettings) {
				$('#frmExport').show();
				var txt = eval('('+oSettings.jqXHR.responseText+')');
				$('#num_row').val(txt.iTotalRecords);
				$('#tmpSQL').val(txt.tmpSQL);
				/*$('#dataTable tbody tr').live('click', function () {
					var nTds = $('td', this);
					var ip = $(nTds[3]).text();
				});*/
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
				$("#dia-exp").dialog({ position: {my:'right bottom', at:'right bottom', of:window}, width:250, hieght:140, title:'Export excel (.*xlsx)',close: function(event, ui){ CheckStatus("","");}});
				$("#frmExport").attr("action","<?php echo $this->createUrl('DeviceExportExcel')?>").submit();
				CheckStatus('exl',$('#num_row').val());
			});
			$('#txt').one("click", function() {
				menu.hide();
				$("#dia-exp").dialog({ position: {my:'right bottom', at:'right bottom', of:window}, width:250, hieght:140, title:'Export tab delimited (*.txt)',close: function(event, ui){ CheckStatus("","");}});
				$("#frmExport").attr("action","<?php echo $this->createUrl('DeviceExportTxt')?>").submit();
				CheckStatus('txt',$('#num_row').val());
			});
			$('body').one('click',function(){
				menu.hide();
			});
				return false;
			}).parent().buttonset().next().hide().menu();
	});
</script>
<div id="dialog" title="Node Detail Dialog"></div>
<div id="dia-exp" title="">Export data...</div>
