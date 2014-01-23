<?php

class ACCESSGROUPController extends Controller
{

	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin','@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$row=Yii::app()->db->createCommand("SELECT MAX(ACCESSGROUP_ID) FROM ACCESSGROUP ")->queryAll();
			foreach($row as $item){
				$acc_i = $item['MAX(ACCESSGROUP_ID)'];
				$acc_id = ($acc_i+1);
			}
			
		//print_r($_POST);
		$model=new ACCESSGROUP;
		//$model->ACCESSGROUP_ID = $acc_id;
		$name =$_POST['ACCESSGROUP']['ACCESSGROUP_ID'];
			if($name == ''){
				$name = $acc_id;
			}
		$user = Yii::app()->session['user'];
		$status ="OK";
		$action ="ADD";
		$acc_n = $_POST['ACCESSNAME_ID'];
		$selectid = $_POST['selectto'];
		
		if(isset($_POST['selectto']))
			
			{   
				foreach($selectid as $sid){
				$sql3 = "INSERT INTO ACCESSGROUP (ACCESSGROUP_ID,ACCESSNAME_ID) VALUES ('{$name}','{$sid}')";
				$command3 = Yii::app()->db->createCommand($sql3);
				$dataReader = $command3->query();
				Func::add_loglogmodify($user,$status,$action,$id); 
				}
				$this->redirect(array('admin'));
			}

		$this->render('create',array(
			'model'=>$model,
			'acc_id'=>$acc_id,
		));
	}

	public function actionUpdate($id)
	{
		$row=Yii::app()->db->createCommand("SELECT MAX(ACCESSGROUP_ID) FROM ACCESSGROUP ")->queryAll();
		foreach($row as $item){
			$acc_i = $item['MAX(ACCESSGROUP_ID)'];
			$acc_id = ($acc_i+1);
		}
		$acc_g = $_POST['ACCESSGROUP']['ACCESSGROUP_ID'];
			if($acc_g == ''){
				$acc_g = $acc_id;
			}
		$model=$this->loadModel($id);
		$selectid = $_POST['selectto'];
		$user = Yii::app()->session['user'];
		$status ="OK";
		$action ="MODIFY";
		$acc_n = $_POST['ACCESSNAME_ID'];
		
		if(isset($_POST['selectto']))
		{		
				$sql3 = "DELETE FROM ACCESSGROUP WHERE ACCESSGROUP_ID = '{$model->ACCESSGROUP_ID}'";
				$command3 = Yii::app()->db->createCommand($sql3);
				$dataReader3 = $command3->query();
				foreach(($_POST['selectto']) as $seid){
				$sql = "INSERT INTO ACCESSGROUP (ACCESSGROUP_ID,ACCESSNAME_ID) VALUES ('{$acc_g}','{$seid}')";
				$command = Yii::app()->db->createCommand($sql);
				$dataReader = $command->query();
				}
				Func::add_loglogmodify($user,$status,$action,$id); 
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
			'id5'=>$id,
			
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		$user = Yii::app()->session['user'];
		$status ="OK";
		$action ="REMOVE";
		Func::add_loglogmodify($user,$status,$action,$id); 
		if(!isset($_GET['ajax']))
			{
			
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ACCESSGROUP');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		//$model=new ACCESSGROUP('search');
		$model=new ACCESSGROUP;
		$model->group;
		$model2=new ACCESSNAME;
		$model->unsetAttributes();  // clear any default values
		$sql = "SELECT * FROM GROUPNAME a JOIN ACCESSGROUP b ON ( a.`ACCESSGROUP_ID` = b.`ACCESSGROUP_ID` ) 
				JOIN ACCESSNAME c ON ( b.`ACCESSNAME_ID` = c.`ID`)"; 
		$dataProvider = new CSqlDataProvider($sql, array(   
		 /*  'pagination' => array(
		  'pageSize' => 10,       
		  ), */
		  ));
		if(isset($_GET['ACCESSGROUP']))
			$model->attributes=$_GET['ACCESSGROUP'];
		$sql = "SELECT a.NAME,c.STARTTIME,c.ENDTIME,c.DOW,b.ID FROM GROUPNAME a JOIN ACCESSGROUP b ON ( a.`ACCESSGROUP_ID` = b.`ACCESSGROUP_ID` ) 
				JOIN ACCESSNAME c ON ( b.`ACCESSNAME_ID` = c.`ID`)"; 
		$dataProvider = new CSqlDataProvider($sql, array(    
		 /*  'pagination' => array(
		  'pageSize' => 10,       
		  ), */
		  ));
		$this->render('admin',array(
			'model'=>$model,
			'model2'=>$model2,
			'dataProvider' =>$dataProvider,
		));
		
	}

	public function loadModel($id)
	{
		$model=ACCESSGROUP::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='accessgroup-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
