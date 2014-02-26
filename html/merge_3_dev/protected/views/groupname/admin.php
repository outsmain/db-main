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
	<?php
	/* @var $this GROUPNAMEController */
	/* @var $model GROUPNAME */
	$spage_name="User Management";
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

	?>
	<div class="container" id="actualbody">
	<div class="row clearfix">
	<div class="col_12">
	<div class="widget clearfix">
	<h2>View Groupename</h2>
	<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
	<div class="search-form" style="display:none">
	<?php
		$this->renderPartial('_search',array(
		'model'=>$model,
	)); 
	?>
	</div><!-- search-form -->
	<?php 		
	$data->ACCESSGROUP_ID;
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'groupname-grid',
		'dataProvider'=>$model->search(),
		//'dataProvider'=>$dataProvider,		
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
				//'value'=>'Func::ssss($data->ACCESSGROUP_ID)',
				'value'=>'$data->ACCESSGROUP_ID==0 ?"-" :Func::ssss($data->ACCESSGROUP_ID)',
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
				'url'=>'Yii::app()->createUrl("groupname/update", array("id"=>$data->ID,"acc_id" =>$data->ACCESSGROUP_ID))',
			),
			'delete' => array
			(
				'label'=>'del',
				'visible'=>'1',
				'url'=>'Yii::app()->createUrl("groupname/delete", array("id"=>$data->ID,"acc_id" =>$data->ACCESSGROUP_ID))',
	
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
