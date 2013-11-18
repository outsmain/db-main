<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/assets/DataTable/js/jquery.dataTables.min.js");?>
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/search.js");?>
<?php 
$page_name="Subscriber Report";
?>
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'subs-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'afterValidate' => 'js:function(){onSearch("Search");}'
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
                    <div style="padding-bottom:10px;"><?php echo $form->labelEx($model,'Service');?></div>
                    <div class="input" id="dropDownLists">
                       <?php
                       echo CHtml::dropDownList('OnlineService', '',array(''=>'- - All - -','ADSL'=>'ADSL','ATM'=>'ATM','DOCSIS'=>'DOCSIS',
                           'DSL'=>'DSL','ETHERNET'=>'ETHERNET','FDDI'=>'FDDI','FIXED_LINE'=>'FIXED LINE','FRAME_RELAY'=>'FRAME RELAY',
                           'GPON'=>'GPON','LEASED_LINE'=>'LEASED LINE','MOBILE'=>'MOBILE','WIFI'=>'WIFI'));
                       //echo CHtml::dropDownList('OnlineService', '', CHtml::listData(list_OnlineService::model()->findAll(), 'service', 'service'), array('empty'=>'- - All - -'));
                       ?>
                    </div>
                </div>
		<div class="col_2">
                    <div style="padding-bottom:10px;"><?php echo $form->labelEx($model,'Node_Name');?></div>
                    <div class="input">
                        <? echo CHtml::textField('NodeName','',array('id'=>'NodeName','width'=>100,'maxlength'=>100,"placeholder"=>"CLLI or IP Address","class"=>"medium"));?>
                    </div>
                </div>
		<div class="col_2 last">
                    <label>&nbsp;</label>
                    <div class="input" style="padding-top:6px;">
                      <?php echo CHtml::submitButton('Submit',array('id'=>'submit','value'=>'Submit','class'=>'button blue',));?>
                    </div>
		</div>
            </div>
        </div>
    </div>
</div>

<?php echo CHtml::endForm(); ?>

<div class="row clearfix">
	<div class="widget clearfix">
            <h2>Report</h2>
            <div class="widget_inside">
				<div class="report">
					<div class="col_12" id="req_result">
						
					</div>
				</div>
			</div>
        </div>
</div>
    </div>
</div>
    


    
        </div><!--container -->
    </div>
</div>

<div id="dialog" title="Node Detail Dialog"></div> 

<?php $this->endWidget(); ?>

<script type="text/javascript">
var urlDrop = "<?php echo $this->createUrl('ServiceDropdownlists')?>";
var urlNas = "<?php echo $this->createUrl('Nas')?>";
function onSearch(type){
    var result = $('#req_result');
	result.html("<img src='<?=Yii::app()->request->baseUrl;?>/images/loading.gif'>");
	$.ajax({
			url: "<?php echo $this->createUrl('"+type+"')?>",
			dataType: 'json',
			cache: false,
			type: 'post',
			data: {'start_date':$('#'+"<?=get_class($model)?>"+'_StartDate').val(),'end_date':$('#'+"<?=get_class($model)?>"+'_EndDate').val(),'OnlineService':$('#OnlineService').val(),'note_name':$('#NodeName').val()},
			success: function(data) {
				var tmp = '';
				if(data.length > 0){
					var nd = "";
					tmp += '<table class="dataTable">';
					tmp += '<thead>';
					tmp += '<tr>';
					tmp += '<th></th>';
					tmp += '<th class="align-left" width="10%">Node Name</th>';
					tmp += '<th class="align-left" width="18%">Start Date</th>';
					tmp += '<th class="align-left" width="18%">End Date</th>';
					tmp += '<th class="align-left" width="15%">Duration</th>';
					tmp += '<th class="align-left">Service</th>';
					tmp += '<th class="align-left">Prov. Subs.</th>';
					tmp += '<th class="align-left">Conn. Subs.</th>';
					tmp += '<th class="align-left">Min./Line</th>';
					tmp += '</tr>';
					tmp += '</thead>';
					tmp += '<tbody id="detail">';
					for(var i=0;i<data.length;++i){

						tmp += '<tr class="gradeX" id="dt-'+((data[i].id == null)?'-':data[i].id)+'" style="cursor:pointer">';
						if(nd!=data[i].node_name){
							tmp += '<td></td>';
							tmp += '<td>'+data[i].node_name+'</td>';
							nd = data[i].node_name;
						}else{						
							tmp += '<td></td>';
							tmp += '<td>&nbsp;</td>';
						}
						
						tmp += '<td>'+formatDate(CheckTextNull(data[i].start_date))+'</td>';
						tmp += '<td>'+formatDate(CheckTextNull(data[i].end_date))+'</td>';
						tmp += '<td>'+TimeDifferenceCounter(CheckTextNull(data[i].start_date), CheckTextNull(data[i].end_date))+'</td>';
						tmp += '<td>'+CheckTextNull(data[i].service)+'</td>';
						tmp += '<td>'+CheckTextNull(data[i].prov_subs)+'</td>';
						tmp += '<td>'+CheckTextNull(data[i].conn_subs)+'</td>';   
						tmp += '<td>'+CheckTextNull(data[i].min_line)+'</td>';
						tmp += '</tr>';
						
					}
					tmp	+= '</tbody>';
					tmp += '</table>';
				 }else{
					tmp = 'No Data Found.';
				 }
				result.html(tmp);
				$('.dataTable').dataTable({
					"sPaginationType": "full_numbers",
					"bJQueryUI": true
				});
				SplitDialog(urlNas);
			}
	});
}
onSearch('ShowAll');
</script>
