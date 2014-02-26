<?php
/* @var $this GROUPNAMEController */
/* @var $model GROUPNAME */

$this->breadcrumbs=array(
	'Groupnames'=>array('index'),
	$model->NAME,
);

$this->menu=array(
	array('label'=>'List GROUPNAME', 'url'=>array('index')),
	array('label'=>'Create GROUPNAME', 'url'=>array('create')),
	array('label'=>'Update GROUPNAME', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete GROUPNAME', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GROUPNAME', 'url'=>array('admin')),
);
$url= $_SERVER['REQUEST_URI'];
$user = Yii::app()->session['user'];
$status ="ok";
$action ="OPEN";
Func::add_loglogmodify($user,$status,$action,$url); 
?>
<div class="row clearfix">
<div class="widget clearfix">
<div class="row clearfix">
<div class="col_12">
<h2>View GROUPNAME #<?php echo $model->ID; ?></h2>
<div class="row clearfix">
<?
		$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'groupname-grid',   // ชื่อตาราง
		'dataProvider' =>$dataProvider,   // ตัวแปร data ที่มีข้อมูล
	   // 'enablePagination' => true,   // กำหนดให้แสดงปุ่มเปลี่ยนหน้า
		'columns' => array(   // กำหนด column ที่จะแสดง
			array(
				'name' => 'NAME',
				'header' => 'NAME',
			),		
			array(
				'name' => 'COMMENT',
				'header' => 'COMMENT',
			),
		),
	));
	?>
</div>
</div>
</div>
</div>
</div>