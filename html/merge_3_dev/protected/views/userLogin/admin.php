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
<?php
/* @var $this UserLoginController */
/* @var $model UserLogin */

$this->breadcrumbs=array(
	'User Logins'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserLogin', 'url'=>array('index')),
	array('label'=>'Create UserLogin', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-login-grid').yiiGridView('update', {
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
?>
<div class="row clearfix">
<h2> All User </h2>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-login-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'ID',
		'NAME',
		'FULL_NAME',
		'COMMENT',
		//'PASSWORD',
		'EMAIL',
		'GROUPNAME_ID',
		'ACCESSGROUP_ID',
		'LAST_LOGIN_DATE',
		'LAST_LOGIN_IP',
	
	array(
			'class'=>'CButtonColumn',
			'template'=>'{edit}  {deleted}',
			// view,edit ,delete
			'buttons'=>array
		(
        'edit' => array
        (
            'label'=>'EDIT',
            'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',
            'url'=>'Yii::app()->createUrl("groupauthorize/update", array("id"=>$data->ID,"acc_id" =>$data->ACCESSGROUP_ID))',
        ),
		'deleted' => array
        (
            'label'=>'EDIT',
			'click'=>'function(){alert("test");}',
			  'visible'=>'1',
            'imageUrl'=>Yii::app()->request->baseUrl.'/images/del.png',
            //'url'=>'Yii::app()->createUrl("groupname/deleted", array("id"=>$data->ID,"acc_id" =>$data->ACCESSGROUP_ID))',
		   'url'=>'Yii::app()->createUrl("#")',
		   //'click'=>'alert("Are You Sure?")',
		
        ),
		),
		),
		
	)
	
)); 

////////////////////////

?>

</div>