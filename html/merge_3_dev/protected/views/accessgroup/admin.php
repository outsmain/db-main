<?php
if($user = Yii::app()->session['user']==''){
$this->redirect(Yii::app()->request->baseUrl.'/index.php?r=site/login');
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
<div class="container" id="actualbody">
<div class="row clearfix">
<div class="col_12">
<div class="widget clearfix">
<h2>Manage Access Group</h2>
<div class="widget_inside">

<?php // echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

  <?php 
/*   $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'accessgroup-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'ACCESSGROUP_ID',
		'ACCESSNAME_ID',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}  {delete}',
		),
	),
)
 
); */
$this->widget('ext.groupgridview.GroupGridView', array(
	'dataProvider'=>$model->search(),
	'mergeColumns' => array('NAME'),
	'mergeCellCss' => 'text-align: center; vertical-align: top',
	'columns' => array(   
        array(
            'name'=>'NAME',
			'value'=>'$data->group->NAME==null ?"-" :$data->group->NAME',
            'header' => 'GROUPNAME',	
			'htmlOptions' => array(
			'style' => 'width: 100px; text-align: top;',
    ),
        ),
        array(
            'name' => 'STARTTIME',
			'value'=>'$data->acces->STARTTIME',
			//'value'=>'$data->action==null ? '' : $data->action->name',
            'header' => 'STARTTIME',
        ),
		array(
            'name' => 'ENDTIME',
			'value'=>'$data->acces->ENDTIME',
            'header' => 'ENDTIME',
        ),
		 array(
            'name' => 'DOW',
			'value'=>'$data->acces->DOW',
            'header' => 'DOW',
        ),
			array(
			'class'=>'CButtonColumn',
			'template'=>'{update}  {delete}',
			// view,edit ,delete
	
		),
    ),
 
    ));
/* $this->widget('zii.widgets.grid.CGridView', array(
    'id' =>'accessgroup-grid',   
    //'dataProvider' =>$dataProvider,
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	
    'columns' => array(   
        array(
            'name'=>'NAME',
			'value'=>'$data->group->NAME',
            'header' => 'GROUPNAME',			
        ),
        array(
            'name' => 'STARTTIME',
			'value'=>'$data->acces->STARTTIME',
            'header' => 'STARTTIME',
        ),
		array(
            'name' => 'ENDTIME',
			'value'=>'$data->acces->ENDTIME',
            'header' => 'ENDTIME',
        ),
		 array(
            'name' => 'DOW',
			'value'=>'$data->acces->DOW',
            'header' => 'DOW',
        ),
			array(
			'class'=>'CButtonColumn',
			'template'=>'{update}  {delete}',
			// view,edit ,delete
	
		),
    ),
	
) */
//);

 ?>
<?php echo "<center>".CHtml::button('Create Accessgroup', array('onclick' => 'js:document.location.href="index.php?r=accessgroup/create"')); 

?>
</div>
</div>
</div>
</div>
</div>