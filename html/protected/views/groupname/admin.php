	<?php
	/* @var $this GROUPNAMEController */
	/* @var $model GROUPNAME */

	$this->breadcrumbs=array(
		'Groupnames'=>array('index'),
		'Manage',
	);

	$this->menu=array(
		array('label'=>'List GROUPNAME', 'url'=>array('index')),
		array('label'=>'Create GROUPNAME', 'url'=>array('create')),
	);

	Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$('#groupname-grid').yiiGridView('update', {
			data: $(this).serialize()
		});
		return false;
	});
	");
	$url= $_SERVER['REQUEST_URI'];
	$user = Yii::app()->session['user'];
	$status ="ok";
	$action ="OPEN";
	Func::add_loglogmodify($user,$status,$action,$url); 
	//print_r($dataProvider);
	?>
	<div class="row clearfix">
	<div class="col_12">
	<div class="widget clearfix">
	<h2>View Groupename</h2>
	<div class="row clearfix">
	<?php echo  "<BR>"; ?>
	<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
	<div class="search-form" style="display:none">
	<?php
		$this->renderPartial('_search',array(
		'model'=>$model,
	)); 
	?>
	</div><!-- search-form -->

	<?
/* 		$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'groupname-grid',   // ชื่อตาราง
		'dataProvider' =>$model->search(),   // ตัวแปร data ที่มีข้อมูล
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
	)); */
	?>
	<?php 

	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'groupname-grid',
		'dataProvider'=>$model->search(), 
		'filter'=>$model,
		'columns'=>array(
			 array(
				'name'=>'NAME',
				'header' => 'NAME',			
			),
			array(
				'name' => 'COMMENT',
				'header' => 'COMMENT',
			),
			 array(
				'name' => 'DOW',
				'value'=>'$data->group->STARTTIME.",".$data->group->ENDTIME.",".$data->group->DOW',
				'header' => 'ACCESSGROUP',
			), 
			array(
				'name' => 'NAME',
				'value'=>'$data->platform->NAME',
				'header' => 'PLATFORM',
			),
			array(
				'class'=>'CButtonColumn',
				'template'=>'{update}  {delete}',
			//	view,edit ,delete
				'buttons'=>array
			(
			'update' => array
			(
				'label'=>'EDIT',
				//'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',
				'url'=>'Yii::app()->createUrl("groupname/update", array("id"=>$data->ID,"acc_id" =>$data->ACCESSGROUP_ID))',
			),
			'delete' => array
			(
				'label'=>'del',
				 'visible'=>'1',
				//'imageUrl'=>Yii::app()->request->baseUrl.'/images/del.png',
				'url'=>'Yii::app()->createUrl("groupname/delete", array("id"=>$data->ID,"acc_id" =>$data->ACCESSGROUP_ID))',
			  //'url'=>'Yii::app()->createUrl("#")',
			//  'click'=>'alert("Are You Sure?")',
			
			),
			),
			),
		),
	)
	); 
	echo "<center>".CHtml::button('Create Group', array('onclick' => 'js:document.location.href="index.php?r=groupname/create"'));

	?>

	</div>
	</div>
	</div>
	</div>
	</div>
