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
/* @var $this AccessnameController */
/* @var $model ACCESSNAME */

$this->breadcrumbs=array(
	'Accessnames'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ACCESSNAME', 'url'=>array('index')),
	array('label'=>'Create ACCESSNAME', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#accessname-grid').yiiGridView('update', {
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
<h2>Manage Accessnames</h2>
<div class="widget_inside">
<?php // echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'accessname-grid',
	'dataProvider'=>$model->search(),
//	'filter'=>$model,
	'columns'=>array(
		'ID',
		'STARTTIME',
		'ENDTIME',
		'DOW',
		'ALLOWIP',
		
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}  {delete}',
		),
	),
)); 
echo "<center>".CHtml::button('Create Accessname', array('onclick' => 'js:document.location.href="index.php?r=accessname/create"'));?>
</div>
</div>
</div>
</div>
</div>