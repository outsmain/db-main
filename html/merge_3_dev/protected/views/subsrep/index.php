	<?php
if($user = Yii::app()->session['user']==''){
$this->redirect('index.php?r=site/login');
exit;
}
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
$p_allow = Func::checkRule($url,$user);

	if($p_allow == "not_allow"){
		$status ="INVALID_COMMAND";
		Func::add_loglogmodify($user,$status,$action,$url); 
		$this->redirect('notaccess');
		
	}
?>
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/assets/DataTable/js/jquery.dataTables.js");?>
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/search_subsrep.js");?>
<!--[if lt IE 8]><? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/excanvas.min.js");?><![endif]--> 
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/jquery.flot.js");?>
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/jquery.flot.symbol.js");?>
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/jquery.flot.axislabels.js");?>



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


if($txtservs!=""){
   $FileExportNames = "subsrep-".strtolower($txtservs);
}else{
   $FileExportNames = "subsrep";
}



$form=$this->beginWidget('CActiveForm', array(
	'id'=>'subs-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'afterValidate' => 'js:function(){onShowSearch();}'
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
                    
                        <table class="dataTable" id="DataTableLazy">
                        <thead>
                        <tr>
                        <th></th>
                        <th class="align-left" width="10%">Node Name</th>
                        <th class="align-left" width="18%">Start Date</th>
                        <th class="align-left" width="18%">End Date</th>
                        <th class="align-left" width="15%">Duration</th>
                        <th class="align-left">Service</th>
                        <th class="align-left">Prov. Subs.</th>
                        <th class="align-left">Conn. Subs.</th>
                        <th class="align-left">Min./Line</th>
                        </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        </table>
                    
                </div>
                <div class="col_12" id="fileExport" style="display: none;">
                    
                </div>
            </div>
        </div>
        
	<style>
        .ui-menu { position: absolute; width: 120px; }
        /* button sets */
        .ui-buttonset {
                margin-right: 7px;
                margin-left: 20px;
                font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
                font-size: 8pt;
        }
        .ui-buttonset .ui-button {
                margin-left: 0;
                margin-right: -.3em;
        }
        </style>
	<script>

 
	$(function() {
		$( "#rerun" )
			.button()
			.next()
				.button({
					text: false,
					icons: {
						primary: "ui-icon-triangle-1-s"
					}
				})
				.click(function() {
					var menu = $( this ).parent().next().show().position({
						my: "left top",
						at: "left bottom",
						of: this
					});
					$( document ).one( "click", function() {
						menu.hide();
					});
					return false;
				})
				.parent()
					.buttonset()
					.next()
						.hide()
						.menu();
	});

        
	</script>   
                         
        <div>
            <div >
                <a id="rerun">Export data</a>
                <button id="select">Select an action</button>
            </div>
            <ul style="z-index:500;" id="ExportFileData">
                <li><a href="#" onclick="ExportFile('Excel');" id="aExportExcel">Excel (*.xlsx)</a></li>
<!--                <li><a download="<?=$FileExportNames; ?>" href="#"  onclick="return ExcellentExport.excel(this, 'fileExport', 'Sheet Name Here');">Tab delimited (.txt)</a></li>-->
                <li><a href="#" onclick="ExportFile('text');" id="aExportText" >Tab delimited (.txt)</a></li>
            </ul>
        </div>
    </div>
    <br><br>
</div>

<div id="hide-exp" style="display:none;"><a href="" id="TmpaExportTable" onclick="dialogsExportFileclose();">Tab delimited (.txt)</a></div>
<div id="dialog" title="Node Detail Dialog"></div>
<div id="dialogsExportFile">Export data...</div>
<div id="dialogGraphNoData" title="Service Graph"></div> 
<div id="dialogs" title="Service Graph">
        <div id="legendContainer"></div>    
        <div id="ShowGraph" style="width: 100%; height: 90%; left: 10px; right: 10px; top: 5px;"></div>  

<!--    <div id="ShowGraphHead" style="width: 500px; left: 10px; right: 10px; top: 5px;">
        <div id="ShowGraph" style="width: 100%; height: 100%; left: 10px; right: 10px; top: 5px;"></div>
    </div>-->
</div> 
    
<style type="text/css">
#legendContainer {
    background-color: #fff;
    border: 1px solid #E6E6E6;
    display: inline-block;
}
 
</style>
 
 

<?php $this->endWidget(); ?>


<script type="text/javascript">
    
var urlDrop = "<?php echo $this->createUrl('ServiceDropdownlists')?>";
var txtserv = "<?=$txtservs; ?>";
var urlExFile = ""

function onShowAll(){
urlExFile = "ShowAll";
      $('#DataTableLazy').dataTable( {
        "sPaginationType": "full_numbers",
        "bJQueryUI": true,
        "bProcessing": true,
        "bServerSide": true,
        "bDestroy": true,
        "sAjaxSource": "<?php echo $this->createUrl('DataTableLazy')?>",
        "fnServerData": function ( sSource, aoData, fnCallback ) {
            
            $.ajax( {
                    "dataType": 'json', 
                    "type": "POST", 
                    "url": sSource, 
                    "data": aoData, 
                    "success": fnCallback
            } );
        }
    } );
}

onShowAll();

function onShowSearch(){
urlExFile = "Search";
    $('#DataTableLazy').dataTable( {
        "sPaginationType": "full_numbers",
        "bJQueryUI": true,
        "bProcessing": true,
        "bServerSide": true,
        "bDestroy": true,
        "sAjaxSource": "<?php echo $this->createUrl('DataTableLazy')?>",
        "fnServerData": function ( sSource, aoData, fnCallback ) {
            aoData.push( { "name": "start_date", "value": $('#'+"<?=get_class($model)?>"+'_StartDate').val()},
               {"name": "end_date", "value": $('#'+"<?=get_class($model)?>"+'_EndDate').val()},
               {"name": "OnlineService", "value": $('#OnlineService').val()},
               {"name": "note_name", "value": $('#NodeName').val()},
               {"name": "CountList", "value": $('#CountList').val()}
             );
            $.ajax( {
                    "dataType": 'json', 
                    "type": "POST", 
                    "url": sSource, 
                    "data": aoData, 
                    "success": fnCallback
            } );
        }
    });
}


function ExportFile(file){

    $('#dialogsExportFile').dialog('open');
            
            
    var result2 = $('#fileExport');
    var tmp2 = '';
    $.ajax({
        url: "<?php echo $this->createUrl('"+urlExFile+"')?>",
        dataType: 'json',
        cache: false,
        type: 'post',
        data: {'start_date':$('#'+"<?=get_class($model)?>"+'_StartDate').val(),'end_date':$('#'+"<?=get_class($model)?>"+'_EndDate').val(),'OnlineService':$('#OnlineService').val(),'note_name':$('#NodeName').val(),'CountList':$('#CountList').val()},
        success: function(data) {
            if(data.length > 0){
                var nd2 = "";
                tmp2 += 'Node Name'+"&#09;";
                tmp2 += 'Start Date'+"&#09;";
                tmp2 += 'End Date'+"&#09;";
                tmp2 += 'Duration'+"&#09;";
                tmp2 += 'Service'+"&#09;";
                tmp2 += 'Prov. Subs.'+"&#09;";
                tmp2 += 'Conn. Subs.'+"&#09;";
                tmp2 += 'Min./Line';
                tmp2 += "&#x0D;&#x0A;";
                for(var i=0;i<data.length;++i){

                    if(nd2!=data[i].node_name){
                        tmp2 += ((data[i].start_date == null)?'-':data[i].node_name)+"&#09;";
                        nd2 = data[i].node_name;
                    }else{
                        tmp2 += ' '+"&#09;";
                    }
                    tmp2 += ((data[i].start_date == null)?'-':data[i].start_date)+"&#09;";
                    tmp2 += ((data[i].end_date == null)?'-':data[i].end_date)+"&#09;";
                    tmp2 += TimeDifferenceCounter(data[i].start_date_diff, data[i].end_date_diff)+"&#09;";
                    tmp2 += ((data[i].service == null)?'-':data[i].service)+"&#09;";
                    tmp2 += ((data[i].prov_subs == null)?'-':data[i].prov_subs)+"&#09;";
                    tmp2 += ((data[i].conn_subs == null)?'-':data[i].conn_subs)+"&#09;";   
                    tmp2 += ((data[i].min_line == null)?'-':data[i].min_line); 
                    tmp2 += "&#x0D;&#x0A;";
                }

             }else{
                  tmp2 = 'No Data Found.';
             }
             result2.html(tmp2);



            if(file=="Excel"){
                tableToExcel('fileExport', 'Export to Excel', '<?=$FileExportNames; ?>');
            }
            if(file=="text"){
                tableToText('fileExport', 'Export to Excel', '<?=$FileExportNames; ?>');
            }
            
                
            
        }
    });

}

function dialogsExportFileclose(){

    $('#dialogsExportFile').dialog("close");
}

function SplitDialogs(id){
  
    if(this.id!=""){

        $.ajax({
            url: "<?php echo $this->createUrl('Nas')?>",
            dataType: 'json',
            cache: false,
            type: 'post',
            data: {'id':id},
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
}

//รับค่าจาก Controller
function fnGraph(type,txtIP,txtDateStart,txtDateEnd,txtService){

    	$.ajax({
			url: "<?php echo $this->createUrl('"+type+"')?>",
			dataType: 'json',
			cache: false,
			type: 'post',
			data: {'txtIP':txtIP,'txtDateStart':txtDateStart,'txtDateEnd':txtDateEnd,'txtService':txtService,'txtServType':txtserv},
			success: function(data) {
				if(data.length > 0){
                                        var GraphDate = new Array()
                                        var GraphName = new Array()
                                        var GraphSubsNum = new Array()
                                        var GraphSymbol = new Array()
                                        var GraphPointStatus = new Array()
                                        var txtDatePoint = ""
                                        var a = 0
                                        
                                        //     
                                        
					for(var i=0;i<data.length;++i){
                                                GraphName[i]=data[i].txtService;
                                                
                                                if(txtDatePoint!=data[i].txtDatePoint){
                                                    GraphDate[a] = data[i].txtDatePoint;
                                                    txtDatePoint = data[i].txtDatePoint;
                                                    GraphPointStatus[a] = data[i].txtPointStatus;
                                                    a = a+1
						}
                                                
                                                GraphSubsNum[i]=data[i].txtNums;
                                                GraphSymbol[i] = data[i].txtSymbol;
                                                
                                        }
                                            ServiceGraph(data[0].txtIp,GraphDate,GraphName,GraphSubsNum,GraphSymbol,GraphPointStatus);
				 }else{
                                    var tmp;
                                    tmp = 'No Data Found.';
                                    $('#dialogGraphNoData').html(tmp);
                                    $('#dialogGraphNoData').dialog('open');
                                }
			}
	});
}



function ServiceGraph(NodeGraphIP,NodeGraphDate,NodeGraphName,NodeGraphSubsNum,NodeGraphSymbol,NodeGraphPointStatus){

    $('#dialogs').dialog('open');

    var txtNumLoop = NodeGraphName.length/NodeGraphDate.length;
    var txtNumOne = Array();
    var txtSymbolOne = Array();



for(var i = 0;i<=NodeGraphSubsNum.length-1;i+=txtNumLoop){  //แปลงค่าให้เป็นเส้นใครเส้นมัน
    for(var r = 0;r<txtNumLoop;r++){
        if(i==0){
            txtNumOne[r]="";
            txtSymbolOne[r]="";
        }
        
        txtNumOne[r]+=NodeGraphSubsNum[i+r];
        txtSymbolOne[r]+=NodeGraphSymbol[i+r];
        
        if(i+txtNumLoop<=NodeGraphSubsNum.length-1){
            txtNumOne[r]+=",";
        }
        
        if(i+txtNumLoop<=NodeGraphSymbol.length-1){
            txtSymbolOne[r]+=",";
        }
    }
}

var data1 = Array();

for(var i = 0;i<txtNumLoop;i++){
var GenColor = 'rgb(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ')';
var txtSymbolTwo = Array();
   txtSymbolTwo=txtSymbolOne[i].split(',');
var txtNumTwo = Array();
txtNumTwo[i] = txtNumOne[i].split(',');
var txtNumThree = Array();
var txtSymbolVaule = "";
var txtCircle = 0;
var txtCross = 0;
var txtRadius = 0;
var labelTooltip = "";
   
var txtLoopNum = "";
var txtAmounts = 2;
var txtCircles = 0;
var txtCrosss = 0;

var txtNumThreess1 = Array();
var txtNumThreess2 = Array();
var txtNumThreess3 = Array();
var txtNumThreess4 = Array();
var txtNumThreess5 = Array();

//////////////////เส้นที่หายไป//////////////////
        for(var rr = 0;rr<=txtSymbolTwo.length;rr++){
             if(txtLoopNum==""){
                 txtLoopNum = txtSymbolTwo[rr];
             }
             if(txtLoopNum!=txtSymbolTwo[rr]){

                 if(txtNumTwo[i][rr-1]!=0){
                    txtNumThreess1.push(txtNumTwo[i][rr-1]);
                    txtNumThreess3.push(txtAmounts-1) 
                 }
                 if(txtNumTwo[i][rr]!=0){
                    txtNumThreess2.push(txtNumTwo[i][rr]);
                    txtNumThreess4.push(txtAmounts) 
                 }
                 if(txtLoopNum=="circle"){
                     txtCircles=txtCircles+1;
                 }
                 if(txtLoopNum=="cross"){
                     txtCrosss=txtCrosss+1;
                 }

                 txtLoopNum = txtSymbolTwo[rr];
             }
             txtAmounts++;
        }
        for(var ii = 0;ii<txtNumThreess4.length-1;ii++){
            txtNumThreess5.push([txtNumThreess3[ii], parseInt(txtNumThreess1[ii])]);
            txtNumThreess5.push([txtNumThreess4[ii], parseInt(txtNumThreess2[ii])]);

            data1.push({data: txtNumThreess5,color: GenColor,points: { radius: 0, fillColor: GenColor }});
            txtNumThreess5=[];
        }
//////////////////เส้นที่หายไป//////////////////

txtNumThree.push([1, null]);

    var txtAmount = 2;
    
    for(var r = 0;r<=txtSymbolTwo.length;r++){
         if(txtSymbolVaule==""){
             txtSymbolVaule = txtSymbolTwo[r]
         }
                  
            
         if(txtSymbolVaule==txtSymbolTwo[r]){
             txtNumThree.push([txtAmount, parseInt(txtNumTwo[i][r])]);

             
         }else if(txtSymbolVaule!=txtSymbolTwo[r]){
             
             if(txtCircle==0 || txtCross==0){
                 if(txtCircle==0 && txtSymbolVaule=="circle"){
                     labelTooltip = NodeGraphName[i]+" Active";
                     data1.push({labelTooltip: labelTooltip, label: NodeGraphName[i]+" Active", data: txtNumThree,color: GenColor,points: { symbol: txtSymbolVaule, radius: 3, fillColor: GenColor }});
                 }else if(txtCross==0 && txtSymbolVaule=="cross"){
                     labelTooltip = NodeGraphName[i]+" History";
                     data1.push({labelTooltip: labelTooltip, label: NodeGraphName[i]+" History", data: txtNumThree,color: GenColor,points: { symbol: txtSymbolVaule, radius: 5, fillColor: GenColor }});
                 }
                 labelTooltip = "";
             }else{
                 if(txtSymbolVaule=="circle"){
                     labelTooltip = NodeGraphName[i]+" Active";
                     txtRadius = 3;
                 }else{
                     labelTooltip = NodeGraphName[i]+" History";
                     txtRadius = 5;
                 }
                 data1.push({labelTooltip: labelTooltip, data: txtNumThree,color: GenColor,points: { symbol: txtSymbolVaule, radius: txtRadius, fillColor: GenColor }});
             }
             
             if(txtSymbolVaule=="circle"){
                 txtCircle=txtCircle+1;
                 
             }
             if(txtSymbolVaule=="cross"){
                 txtCross=txtCross+1;
             }
             
             txtSymbolVaule = txtSymbolTwo[r];
             txtNumThree = [];
             txtNumThree.push([txtAmount, parseInt(txtNumTwo[i][r])]);
         }
         txtAmount++;
    }
    
    txtNumThree.push([txtAmount-1, null]);
    data1.push({data: txtNumThree,color: GenColor,points: { symbol: txtSymbolVaule, fillColor: GenColor }});
            
}


    
    
    var data =  data1;

    var GraphDate = Array();
    var GraphTooltip = Array();
    var a = 2
    for(var i = 0;i<NodeGraphDate.length;i++){
          var bb = "";
          bb = NodeGraphDate[i].split(' ');
              //alert(NodeGraphPointStatus[i]);
          if(NodeGraphPointStatus[i]=='1'){
              GraphDate.push([a, " "]);
          }else{
              GraphDate.push([a, bb[0]+" "+bb[1]+" "+bb[2]+'<br>'+bb[3]]);
          }
          
          
          GraphTooltip.push(bb[0]+" "+bb[1]+" "+bb[2]+" "+bb[3]);
          a++;
    }
               
//    var AutoWidth = GraphDate.length * 150;
//    $("#ShowGraphHead").css( {
//        width: AutoWidth+"px",
//        height: "100%"
//    });  
                      
    var options = {
        lines: {show: true},
        points: {show: true},
        //yaxis: {tickDecimals: 0, min: 0, max: 5000, autoscaleMargin: null},
        legend:{         
            container:$("#legendContainer"),            
            noColumns: 0
        },
        xaxis: {
            ticks: GraphDate,
            axisLabelColor: "red",
            axisLabel: "Date",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            axisLabelPadding: 5
        },
        yaxis: {
            axisLabel: "Subscribers",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            axisLabelPadding: 5
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

    function labels(x,y) {
        var Relabel = "";
        var RelabelSymbol = "";
        var RelabelVal = Array();
        var RelabelSymbolVal = Array();
        for(var r = 0;r <= txtNumOne.length-1;r++){
            
            RelabelVal[r] = txtNumOne[r].split(',');
            RelabelSymbolVal[r] = txtSymbolOne[r].split(',');
               
            if(RelabelVal[r][x]==y){

                if(RelabelSymbolVal[r][x]=="circle"){
                    RelabelSymbol = "Active";
                }else{
                    RelabelSymbol = "History";
                }
                Relabel += NodeGraphName[r] + " " + RelabelSymbol + " = " + y;
                if(r != txtNumOne.length-1){
                    Relabel += "<br>";
                }
            }
        }
         return Relabel;
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
                                GraphTooltip[x-2] + "<br>" + labels(x-2,y));
                                //GraphTooltip[x-2] + "<br>" + item.series.labelTooltip + " = " + y);
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
      width: 800,
      height: 600,
      zIndex:1,
      buttons: {
        "Close": function() {
            $(this).dialog("close");
        }
      },
      modal: true
  });
});

$(function() {
  $('#dialogsExportFile').dialog({
      autoOpen: false,
      width: 250,
      height: 140,
      position: "right bottom",
      modal: true
  });
});

$(function() {
  $('#dialogGraphNoData').dialog({
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
