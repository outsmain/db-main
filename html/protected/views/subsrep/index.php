<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/assets/DataTable/js/jquery.dataTables.min.js");?>
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/search.js");?>
<!--[if lt IE 8]><? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/excanvas.min.js");?><![endif]--> 
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/jquery.flot.js");?>
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/jquery.flot.symbol.js");?>


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

Yii::import('application.extensions.multiselect.multiSelect');
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
                       
                       
                        echo CHtml::dropDownList('OnlineService','',array('ADSL'=>'ADSL','ATM'=>'ATM','DOCSIS'=>'DOCSIS',
                             'DSL'=>'DSL','ETHERNET'=>'ETHERNET','FDDI'=>'FDDI','FIXED_LINE'=>'FIXED LINE','FRAME_RELAY'=>'FRAME RELAY',
                             'GPON'=>'GPON','LEASED_LINE'=>'LEASED LINE','MOBILE'=>'MOBILE','WIFI'=>'WIFI'),array('empty' => 'All'));

                        $options = array(
                                'multiple' => false,
                                'header' => 'Select an option',
                                'noneSelectedText' => "All",
                        );
                        multiSelect::addMultiselect('#OnlineService',$options);
                       
//                       echo CHtml::dropDownList('OnlineService', '',array(''=>'- - All - -','ADSL'=>'ADSL','ATM'=>'ATM','DOCSIS'=>'DOCSIS',
//                           'DSL'=>'DSL','ETHERNET'=>'ETHERNET','FDDI'=>'FDDI','FIXED_LINE'=>'FIXED LINE','FRAME_RELAY'=>'FRAME RELAY',
//                           'GPON'=>'GPON','LEASED_LINE'=>'LEASED LINE','MOBILE'=>'MOBILE','WIFI'=>'WIFI'));
                       //echo CHtml::dropDownList('OnlineService', '', CHtml::listData(list_OnlineService::model()->findAll(), 'service', 'service'), array('empty'=>'- - All - -'));
                       ?>
                    </div>
                </div>
		<div class="col_2">
                    <div style="padding-bottom:10px;"><?php echo $form->labelEx($model,'NodeName');?></div>
                    <div class="input">
                        <? //echo CHtml::textField('NodeName','',array('id'=>'NodeName','width'=>100,'maxlength'=>100,"placeholder"=>"CLLI or IP Address","class"=>"medium"));?>
                    
                    <?php
                        $sql = Yii::app()->db->createCommand("SELECT (CASE WHEN name IN ('', NULL) THEN ip_addr WHEN ip_addr IN ('', NULL) THEN name ELSE CONCAT(name, 'xx#xx', ip_addr) END) AS value,(CASE WHEN name IN ('', NULL) THEN ip_addr WHEN ip_addr IN ('', NULL) THEN name ELSE CONCAT(name, ' / ', ip_addr) END) AS item,site_name FROM NE_LIST")->queryAll();
                        $data = CHtml::listData($sql, 'value', 'item' ,'site_name');
                        echo CHtml::dropDownList('NodeName','',$data,array('multiple' => 'multiple',)); 
                        $options = array(
                                'multiple' => TRUE,
                        );
                       // multiSelect::addMultiselect('#NodeName',$options);

                      // multiSelect::addMultiselect('#NodeName',$options).multiselectfilter();

                    ?>

                <script type="text/javascript">
                $("#NodeName").multiselect().multiselectfilter();
                </script>
                    <?php
                        $sql = "SELECT COUNT(*) as count_list FROM NE_LIST";
                        $command = Yii::app()->db->createCommand($sql);
                        $results = $command->queryAll();
                        $CountList = (int)$results[0]["count_list"];
                        echo CHtml::hiddenField('CountList',$CountList);
                    ?>
                    </div>
                </div>
		<div class="col_2 last">
                    
                    <label>&nbsp;</label>
                    <div class="input" style="padding-top:6px; padding-left:50px;">
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
<div id="dialog" title="Node Detail Dialog"></div> 

<div id="dialogs" title="Service Graph">
    <div id="ShowGraphHead" style="left: 10px; right: 10px; top: 5px;">
        <div id="ShowGraph" style="width: 100%; height: 100%; left: 10px; right: 10px; top: 5px;"></div>
    </div>
</div> 

<?php $this->endWidget(); ?>

<?php  //ส่งค่าจาก URL เพื่อ filter ข้อมูล SUBS_LOG_ARCH.service_type เพื่อแสดงผลแบบกราฟ
$txtGetString = explode("&", $_SERVER['QUERY_STRING']);
$txtservs = "";
for($i=0;$i<=count($txtGetString)-1;$i++){
    if(strstr($txtGetString[$i],"serv=")){
        $ex = explode("serv=",$txtGetString[$i]);
        $txtservs .= strtoupper($ex[1]);
        if($i<count($txtGetString)-1){
            $txtservs .= ",";
        }
    }
}
?>

<script type="text/javascript">
    
var urlDrop = "<?php echo $this->createUrl('ServiceDropdownlists')?>";
var urlNas = "<?php echo $this->createUrl('Nas')?>";
var txtserv = "<?=$txtservs; ?>";

function onSearch(type){
    var result = $('#req_result');
	result.html("<img src='<?=Yii::app()->request->baseUrl;?>/images/loading.gif'>");
	$.ajax({
			url: "<?php echo $this->createUrl('"+type+"')?>",
			dataType: 'json',
			cache: false,
			type: 'post',
			data: {'start_date':$('#'+"<?=get_class($model)?>"+'_StartDate').val(),'end_date':$('#'+"<?=get_class($model)?>"+'_EndDate').val(),'OnlineService':$('#OnlineService').val(),'note_name':$('#NodeName').val(),'CountList':$('#CountList').val()},
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
                                                
						tmp += '<tr class="gradeX" style="cursor:pointer">';
						if(nd!=data[i].node_name){
                                                    tmp += '<td id="dt-'+((data[i].id == null)?'-':data[i].id)+'"></td>';
                                                    //node_name  **************************************แก้
                                                    tmp += "<td OnClick=\"fnGraph('ShowGraph','"+data[i].node_ip+"','"+data[i].start_date_diff+"','"+data[i].end_date_diff+"','','"+txtserv+"')\">"+data[i].node_name+"</td>";
                                                    nd = data[i].node_name;
						}else{						
                                                    tmp += '<td id="dt-'+((data[i].id == null)?'-':data[i].id)+'"></td>';
                                                    tmp += '<td id="dt-'+((data[i].id == null)?'-':data[i].id)+'">&nbsp;</td>';
						}
						
						tmp += '<td id="dt-'+((data[i].id == null)?'-':data[i].id)+'">'+CheckTextNull(data[i].start_date)+'</td>';
						tmp += '<td id="dt-'+((data[i].id == null)?'-':data[i].id)+'">'+CheckTextNull(data[i].end_date)+'</td>';
						tmp += '<td id="dt-'+((data[i].id == null)?'-':data[i].id)+'">'+TimeDifferenceCounter(CheckTextNull(data[i].start_date_diff), CheckTextNull(data[i].end_date_diff))+'</td>';
                                                tmp += "<td OnClick=\"fnGraph('ShowGraph','"+data[i].node_ip+"','"+data[i].start_date_diff+"','"+data[i].end_date_diff+"','"+data[i].service+"','"+txtserv+"')\">"+CheckTextNull(data[i].service)+"</td>";
                                                tmp += '<td id="dt-'+((data[i].id == null)?'-':data[i].id)+'">'+CheckTextNull(data[i].prov_subs)+'</td>';
						tmp += '<td id="dt-'+((data[i].id == null)?'-':data[i].id)+'">'+CheckTextNull(data[i].conn_subs)+'</td>';   
						tmp += '<td id="dt-'+((data[i].id == null)?'-':data[i].id)+'">'+CheckTextNull(data[i].min_line)+'</td>'; 
                                       		tmp += '</tr>';
					}
                                                
					tmp += '</tbody>';
					tmp += '</table>';
				 }else{
					tmp = 'No Data Found.';
				 }
				result.html(tmp);
				$('.dataTable').dataTable({
					"sPaginationType": "full_numbers",
					"bJQueryUI": true
				});
				SplitDialogs(urlNas);
			}
	});
}

function SplitDialogs(url){
	$('#detail > tr > td    ').click(function(){
	var id = this.id.split('-');
        if(this.id!=""){
            $.ajax({
                    url: url,
                    dataType: 'json',
                    cache: false,
                    type: 'post',
                    data: {'id':id[1]},
                    success: function(data){
                            var tmp = '';
                            if(data.length > 0){
                                    $.each(data,function(i, val){
                                            switch(val.is_use){
                                                    case 'null' :
                                                            var use = '-';
                                                            break;
                                                    case '0' :
                                                            var use = 'Not Active';
                                                            break;
                                                    case '1' :
                                                            var use = 'Active';
                                                            break;
                                                    case '2' :
                                                            var use = 'Disable';
                                                            break;
                                            }
                                            tmp += '<p>Add Date : '+((val.add_date == null)?'-':val.add_date)+'</p>';
                                            tmp += '<p>Update Date : '+((val.update_date == null)?'-':val.update_date)+'</p>';
                                            tmp += '<p>IP Address : '+((val.ip_addr == null)?'-':val.ip_addr)+'</p>';
                                            tmp += '<p>Name : '+((val.name == null)?'-':val.name)+'</p>';
                                            tmp += '<p>Comment : '+((val.comment == null)?'-':val.comment)+'</p>';
                                            tmp += '<p>Site Name : '+((val.site_name == null)?'-':val.site_name)+'</p>';
                                            tmp += '<p>Brand : '+((val.brand == null)?'-':val.brand)+'</p>';
                                            tmp += '<p>Model : '+((val.model == null)?'-':val.model)+'</p>';
                                            tmp += '<p>Software : '+((val.sw_ver == null)?'-':val.sw_ver)+'</p>';
                                            tmp += '<p>Type : '+((val.ne_type == null)?'-':val.ne_type)+'</p>';
                                            tmp += '<p>Level : '+((val.level == null)?'-':val.level)+'</p>';
                                            tmp += '<p>Status Mapped Values : '+use+'</p>';
                                            tmp += (i > 0)?'<p></p>':'';
                                    });
                            }else{
                                    tmp = 'No Data Found.';
                            }
                            $('#dialog').html(tmp);
                            $('#dialog').dialog('open');						 
                    }
            });	
        }
});
}

onSearch('ShowAll');
//รับค่าจาก Controller
function fnGraph(type,txtIP,txtDateStart,txtDateEnd,txtService,txtServType){
    	$.ajax({
			url: "<?php echo $this->createUrl('"+type+"')?>",
			dataType: 'json',
			cache: false,
			type: 'post',
			data: {'txtIP':txtIP,'txtDateStart':txtDateStart,'txtDateEnd':txtDateEnd,'txtService':txtService,'txtServType':txtServType},
			success: function(data) {
				if(data.length > 0){
                                        var GraphDate = new Array()
                                        var GraphName = new Array()
                                        var GraphSubsNum = new Array()
                                        var GraphSymbol = new Array()
                                        var txtDate = ""
                                        var a = 0
					for(var i=0;i<data.length;++i){
                                                GraphName[i]=data[i].NAME;
                                                
                                                if(txtDate!=data[i].UPDATE_DATE){
                                                    GraphDate[a] = data[i].UPDATE_DATE;
                                                    txtDate = data[i].UPDATE_DATE;
                                                    a = a+1
						}
                                                
                                                if((data[i].SUBS_NUM=="" || data[i].SUBS_NUM=="0") && (data[i].HIST_SUBS_NUM!="" || data[i].HIST_SUBS_NUM!="0")){
                                                    GraphSubsNum[i] = data[i].HIST_SUBS_NUM;
                                                    GraphSymbol[i] = "cross";
                                                }else{
                                                    GraphSubsNum[i]=data[i].SUBS_NUM;
                                                    GraphSymbol[i] = "circle";
                                                }
                                        }
                                            ServiceGraph(data[0].IP_ADDR,GraphDate,GraphName,GraphSubsNum,GraphSymbol);
				 }else{
                                    var tmp;
                                    tmp = 'No Data Found.';
                                    $('#dialogs').html(tmp);
                                    $('#dialogs').dialog('open');
                                }
			}
	});
}

      
function ServiceGraph(NodeGraphIP,NodeGraphDate,NodeGraphName,NodeGraphSubsNum,NodeGraphSymbol){
    
$('#dialogs').dialog('open');

var txtNumLoop = NodeGraphName.length/NodeGraphDate.length;
var txtNumOne = Array();
var txtSymbolOne = Array();  //
var txtSymbolTwo = Array();  //

for(var i = 0;i<=NodeGraphSubsNum.length-1;i+=txtNumLoop){  //แปลงค่าให้เป็นเส้นใครเส้นมัน
    for(var r = 0;r<txtNumLoop;r++){
        if(i==0){
            txtNumOne[r]="";
            txtSymbolOne[r]="";
            txtSymbolTwo[r]="";
        }
        
        txtNumOne[r]+=NodeGraphSubsNum[i+r];
        
        if(txtSymbolTwo[r]!="circle" || txtSymbolTwo[r]==""){
            txtSymbolOne[r]=NodeGraphSymbol[i+r];
            txtSymbolTwo[r]=NodeGraphSymbol[i+r];
        }
        
        if(i+txtNumLoop<=NodeGraphSubsNum.length-1){
            txtNumOne[r]+=",";
        }
    }
}

var txtNumTwo = Array();
var data1 = Array();
              
for(var i = 0;i<txtNumLoop;i++){
    
var txtNumThree = Array();
txtNumTwo[i] = txtNumOne[i].split(',');
    
    txtNumThree.push([1, null]);
    var txtAmount = 2;
    for(var r = 0;r<=NodeGraphDate.length;r++){
        txtNumThree.push([txtAmount, parseInt(txtNumTwo[i][r])]);
        txtAmount++;
    }
    data1.push({label: NodeGraphName[i], data: txtNumThree,points: { symbol: txtSymbolOne[i] }});
}

var data =  data1;
              var GraphDate = Array();
              var GraphTooltip = Array();
              var a = 2
              for(var i = 0;i<=NodeGraphDate.length-1;i++){
                    var bb = "";
                    bb = NodeGraphDate[i].split(' ');
                    GraphDate.push([a, bb[0]+" "+bb[1]+" "+bb[2]+'<br>'+bb[3]]);
                    GraphTooltip.push(bb[0]+" "+bb[1]+" "+bb[2]+" "+bb[3]);
                    a++;
              }
    var AutoWidth = GraphDate.length * 110;
    $("#ShowGraphHead").css( {
        width: AutoWidth+"px",
        height: "100%"
    });  
                      
var options = {
                lines: {show: true},
                points: {show: true},
                //yaxis: {tickDecimals: 0, min: 0, max: 5000, autoscaleMargin: null},
                xaxis: {
                    ticks: GraphDate
                },
                grid: {
                    backgroundColor: '#ffffff',
                    hoverable: true, 
                    clickable: true
                }
               };
               $.plot($('#ShowGraph'), data, options);
               
               
    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5,
            zIndex: 2000,
            border: '1px solid #fdd',
            padding: '2px',
            'background-color': '#fee',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }


    var previousPoint = null;
    $("#ShowGraph").bind("plothover", function (event, pos, item) {
        $("#x").text(pos.x.toFixed(2));
        $("#y").text(pos.y.toFixed(2));
        
            if (item) { 
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(0);
                                              
                    showTooltip(item.pageX, item.pageY,
                                item.series.label + " of " + GraphTooltip[x-2] + " = " + y);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
        
    });
};

$(function() {
  $('#dialogs').dialog({
      autoOpen: false,
      width: 700,
      height: 550,
      zIndex:1,
      buttons: {
                  "Close": function() {
                  $(this).dialog("close");
              }
      },
      modal: true
  });
});
</script>