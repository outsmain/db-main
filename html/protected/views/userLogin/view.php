<?php
/* @var $this UserLoginController */
/* @var $model UserLogin */

$this->breadcrumbs=array(
	'User Logins'=>array('index'),
	$model->NAME,
);
/* 
$this->menu=array(
	array('label'=>'List UserLogin', 'url'=>array('index')),
	array('label'=>'Create UserLogin', 'url'=>array('create')),
	array('label'=>'Update UserLogin', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete UserLogin', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserLogin', 'url'=>array('admin')),
); */
?>

<h2>หน้าที่มีสิทธิ์เข้าใช้งาน
<?php echo $model->NAME; ?></h1>
<div class="row clearfix">
<?php 
/* $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NAME',
		'FULL_NAME',
		'COMMENT',
		'EMAIL',		
	),
)); */

 ?>
 <?php
 $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid_1',   
    'dataProvider' => $dataProvider,   
   // 'enablePagination' => true,   
	
    'columns' => array(   
       /*  array(
         //   'name' => 'ID',
        //    'header' => 'ID',
		//	'value' => 'CHtml::link($dataProvider->NAME,$dataProvider->ID, array("target"=>"_blank"))',
			//'value'=>'CHtml::link($data->ID::app()->createUrl("userLogin/view", array("id"=>$data->ID))',	
		//	'type'  => 'raw',
        ), */
        array(
            'name' => 'NAME',
            'header' => 'URL',			
        ),
        array(
            'name' => 'TITLE',
            'header' => 'เมนู',
        ),
		
		/* array(
			'class'=>'CButtonColumn',  // view,edit ,delete
		), */
    ),
	
)
);
 echo "<center>".CHtml::submitButton('Edit Rule', array('id' => 'deleteSelected'));
?>
</div>