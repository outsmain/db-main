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
		/* @var $this EdituserController */
		/* @var $model UserLogin */

		$this->breadcrumbs=array(
			'Editusers'=>array('index'),
			'Manage',
		);
		$this->menu=array(
			array('label'=>'List ACCESSGROUP', 'url'=>array('index')),
			array('label'=>'Create ACCESSGROUP', 'url'=>array('create')),
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
		?>
		<div class="container" id="actualbody">
		<div class="row clearfix">
		<div class="col_12">
		<div class="widget clearfix">
		<h2>Manage User Logins</h2>
		<div class="widget_inside">


		<?php //echo  CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
		<div class="search-form" style="display:none">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
		</div><!-- search-form -->

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'user-login-grid',
			'dataProvider'=>$model->search(),
			//'dataProvider'=>$dataProvider,
			'filter'=>$model,
			'columns'=>array(
				//'ID',
				'NAME',
				'FULL_NAME',
				//'COMMENT',
				//'PASSWORD',
				'EMAIL',
				array(
					'name' => 'GROUPNAME_ID',
					'value'=>'$data->group->NAME',
					'header' => 'GROUPNAME_ID',
				),
		//		'ACCESSGROUP_ID',
				'LAST_LOGIN_DATE',
				'LAST_LOGIN_IP',
				array(
					'class'=>'CButtonColumn',
					'template'=>'{update}  {delete}',
					// view,edit ,delete
					'buttons'=>array
				(
				'edit' => array
				(
					'label'=>'EDIT',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',
					'url'=>'Yii::app()->createUrl("edituser/update", array("id"=>$data->ID))',
				),
				'deleted' => array
				(
					'label'=>'EDIT',
				//	'click'=>'function(){alert("ccxcxn!");}',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/del.png',
					'url'=>'Yii::app()->createUrl("edituser/deleted", array("id"=>$data->ID))',
				   'click'=>'alert("Are You Sure?")',
				),
				),
				),
			),
		));
		?>

		<?php echo "<center>".CHtml::button('Create New User', array('onclick' => 'js:document.location.href="index.php?r=edituser/create"')); ?> 

		</div>
		</div>
		</div>
		</div>
		</div>
