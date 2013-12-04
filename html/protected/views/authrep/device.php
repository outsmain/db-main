<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/DataTable/css/dataTable.css" type="text/css" media="screen" />
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/assets/DataTable/js/jquery.dataTables.min.js");?>
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/search.js");?>
<?php 
$serv = $_GET["serv"];
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'device-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'afterValidate' => 'js:function(){
			if($(".errorSummary").css("display") !== "none") return;
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
					aoData.push( {"name": "start_date", "value": $("#'.get_class($model).'_StartDate").val()} );
					aoData.push( {"name": "end_date", "value": $("#'.get_class($model).'_EndDate").val()} );
					aoData.push( {"name": "ne_name", "value": NodeName} );
					aoData.push( {"name": "summary_type", "value": $("#summary_type option:selected").val()} );
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
						<? 
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
                    <div class="input" style="padding:6 0 0 40px;">
						<input type="submit" class="button blue" value="Submit"></input>
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
            <div class="col_12">
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
		$('#dataTable').dataTable({
			"sPaginationType": "full_numbers",
			"bJQueryUI": true,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo $this->createUrl($serv)?>",
			"fnServerParams": function ( aoData ) {
				aoData.push( {"name": "start_date", "value": $('#'+"<?=get_class($model)?>"+'_StartDate').val()} );
				aoData.push( {"name": "end_date", "value": $('#'+"<?=get_class($model)?>"+'_EndDate').val()} );
				aoData.push( {"name": "ne_name", "value": $('#NodeName').val()} );
				aoData.push( {"name": "summary_type", "value": $('#summary_type option:selected').val()} );
				aoData.push( {"name": "click", "value": false} );
			},
			"fnInitComplete": function(oSettings) {
				$('#dataTable tbody tr').live('click', function () {
					var nTds = $('td', this);
					var ip = $(nTds[3]).text();
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