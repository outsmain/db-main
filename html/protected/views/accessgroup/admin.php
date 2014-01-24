<?php
/* @var $this ACCESSGROUPController */
/* @var $model ACCESSGROUP */

//print_r($dataProvider); exit;

$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 	
?>

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
<?php echo "<center>".CHtml::button('Create Accessgroup', array('onclick' => 'js:document.location.href="index.php?r=accessgroup/create"')); ?>
</div>
</div>
</div>
</div>