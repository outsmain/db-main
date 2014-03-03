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
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/assets/DataTable/js/jquery.dataTables.min.js");?>
<?php Yii::app()->syntaxhighlighter->addHighlighter(); ?>
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
<script>
  $(function() {
    $( "#tabs" ).tabs();
  });
</script>
<style>
.select
{
 width: 120px;
}
.tables
{
border-collapse:collapse;
}
.tables
{
border:1px solid #B5B5B5;

table-layout:fixed;
word-wrap:break-word; 
}
.tableright
{
text-align:right;
}
.lightred
{
color: red;
}
.lightgreen
{
color: green;
}
.syntaxhighlighter { 
     overflow-y: hidden !important; 
     overflow-x: hidden !important; 
  }
</style>
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
						<label>Event</label>
						<div class="input">		
						<?php echo CHtml::dropDownList('listname',$select, 
												  array('all' => 'All','1' => '1', '2' => '2'),
												  array('class'=>'select'));
						?>		
						</div>
					</div>
					<div class="col_2">
						<label>User Name</label>
						<div class="input">	
						<?php echo $form->textField($model,'USER_NAME',array('size'=>20)); ?> 
						</div>
					</div>
					<div class="col_2">
						<label>NE Name</label>
						<div class="input">	
						<?php echo $form->textField($model,'USER_NAME',array('size'=>20)); ?> 
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
				<h2>Event</h2>
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

	
<!--
	<div class="col_12">
		<div class="widget_inside">  
			<h2>History</h2>
			<div id ="tabs">
				<ul>
					<li><a href="#tabs-1">Split</a></li>
					<li><a href="#tabs-2">Inline</a></li>
				</ul>
					<div id="tabs-1">
						<table border="1" >
							<tr>
								<td colspan="3" align = "left">
									<?php/*  echo CHtml::dropDownList('listname', $select, 
										  array('1' => 'Revision1', '2' => 'Revision2'),
										  array('empty' => 'Select')); */
									?>
								</td>
								<td colspan="3" align = "right">
									<a href ="#"> Download </a>
								</td>
								<td colspan="3" align = "left">
									<?php /* echo CHtml::dropDownList('listname', $select, 
										  array('1' => 'Revision1', '2' => 'Revision2'),
										  array('empty' => 'Select')); */
									?>
								</td>
								<td colspan="3" align = "right">
									<a href ="#"> Download </a>
								</td>
							</tr>
							<tr>
								<td colspan="6" align = "left" border ="1">
								<div class ="input">
								<table border ="1"><tr><td rowspan ="20"></td></table></textarea></td>
								</div>
								<td colspan="6" align = "left"><textarea rows="10" cols="80"></textarea></td>
							</tr>
						</table>
					</div>
					<div id="tabs-2">
						 <table border="0" width = "80%">
							<tr>
								<td colspan="6" align = "left">
									<?php /* echo CHtml::dropDownList('listname', $select, 
										  array('1' => 'Revision1', '2' => 'Revision2'),
										  array('empty' => 'Select')); */
									?>
								</td>
								<td colspan="6" align = "right">
									<a href ="#"> Download </a>
								</td>
							</tr>
							<tr colspan="12">
								<td  colspan="12"></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
-->


<div class="row clearfix">
	
	<h2>Report</h2>
	<div class="col_12">
		
		<div id ="tabs">
			<ul>
				<li><a href="#tabs-1">Split</a></li>
				<li><a href="#tabs-2">Inline</a></li>
			</ul>
				<div class="widget clearfix">
				<div class="widget_inside">		
					<div id="tabs-1">		
						<div class="report">
							<div class="col_12">
								<table>

									<tbody>
									<div class ="input">
									<tr >
									<td>
									<?php echo CHtml::dropDownList('country_id','', array('1' => 'Revision1', '2' => 'Revision2'),
											array(
											'ajax' => array(
											'type'=>'POST', //request type
											'url'=>CController::createUrl('confrepos/dropvision'), //url to call.
											//Style: CController::createUrl('currentController/methodToCall')
											'update'=>'#list_vis', //selector to update
											'data'=> array('vision'=>'js:this.value'),
											//leave out the data key to pass all form values through
											))); 
									?>
									</td>
									<td class ="tableright"><a href ="#">download</a></td>
									<td><?php echo CHtml::dropDownList('listname', $select, 
													  array('1' => 'Revision1', '2' => 'Revision2'),
													  array('empty' => 'Select'));
										?>
									</td>
									<td class ="tableright"><a href ="#">download</a></td>
									</tr>
									</div>
										<td colspan ="2">
											<table class ="tables">
											<tbody>
											<tr>
												<td id ="list_vis">
												<pre class="brush : plain; toolbar: false;">
												<code> $this->breadcrumbs=array('Accessgroups'=>array('index'),
										$model->ID=>array('view','id'=>$model->ID),
										'Update',
									);
									$this->menu=array(
										array('label'=>'List ACCESSGROUP', 'url'=>array('index')),
										array('label'=>'Create ACCESSGROUP', 'url'=>array('create')),
										array('label'=>'View ACCESSGROUP', 'url'=>array('view','id'=>$model->ID)),
										array('label'=>'Manage ACCESSGROUP', 'url'=>array('admin')),
									);
									$url= $_SERVER['REQUEST_URI'];
									$user = Yii::app()->session['user'];
									$status ="ok";
									$action ="OPEN";
									Func::add_loglogmodify($user,$status,$action,$url); 
									 </code>
									 </pre>
										</td>
										</tbody>
									</table>
								</td>
								<td colspan ="2">
								<table class ="tables" >
								<tbody>
									<tr>
										<td> <pre class="brush : plain">
											<code> $this->breadcrumbs=array('Accessgroups'=>array('index'),
										$model->ID=>array('view','id'=>$model->ID),
										'Update',
									);
									$this->menu=array(
										array('label'=>'List ACCESSGROUP', 'url'=>array('index')),
										array('label'=>'Create ACCESSGROUP', 'url'=>array('create')),
										array('label'=>'View ACCESSGROUP', 'url'=>array('view','id'=>$model->ID)),
										array('label'=>'Manage ACCESSGROUP', 'url'=>array('admin')),
									);
									$url= $_SERVER['REQUEST_URI'];
									$user = Yii::app()->session['user'];
									$status ="ok";
									$action ="OPEN";
									Func::add_loglogmodify($user,$status,$action,$url); 
									 </code>
								</pre>
										</td>
									
									</tr>
									
								</tbody>
								</table>
								</td>
                                
									</tr>
					    
								</tbody>
								</table>
								</tr>
							</div>
						</div>
					
					</div>
						<div id="tabs-2">	
							<div class="report">
								<div class="col_12">
						<table>

						<tbody>
						<tr >
						<td><?php echo CHtml::dropDownList('listname', $select, 
										  array('1' => 'Revision1', '2' => 'Revision2'),
										  array('empty' => 'Select'));
							?>
						<a href ="#">download</a>
						</td>
						<td class ="tableright"><?php echo CHtml::dropDownList('listname', $select, 
										  array('1' => 'Revision1', '2' => 'Revision2'),
										  array('empty' => 'Select'));
							?>
							<a href ="#">download</a>
						</td>
						</tr>
						<td colspan ="2">
						<table class ="tables" >
						<tbody>
							<tr><td>
								<pre class="brush : plain">
									<code> $this->breadcrumbs=array('Accessgroups'=>array('index'),
										$model->ID=>array('view','id'=>$model->ID),
										'Update',
									);
									$this->menu=array(
										array('label'=>'List ACCESSGROUP', 'url'=>array('index')),
										array('label'=>'Create ACCESSGROUP', 'url'=>array('create')),
										array('label'=>'View ACCESSGROUP', 'url'=>array('view','id'=>$model->ID)),
										array('label'=>'Manage ACCESSGROUP', 'url'=>array('admin')),
									);
									$url= $_SERVER['REQUEST_URI'];
									$user = Yii::app()->session['user'];
									$status ="ok";
									$action ="OPEN";
									Func::add_loglogmodify($user,$status,$action,$url); 
									 </code>
								</pre>
							</td></tr>
						</tbody>
						</table></td>
                                
                        </tr>
					    
					</tbody>
				</table>
				</tr> 
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
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
</div>