<?php

class AccessnameController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ACCESSNAME;
		$user = Yii::app()->session['user'];
		$status ="OK";
		$action ="ADD";
		$name =$_POST['ACCESSNAME']['ID'];
		$start = $_POST['ACCESSNAME']['STARTTIME'];
		$end = $_POST['ACCESSNAME']['ENDTIME'];
		$ip = $_POST['ACCESSNAME']['ALLOWIP']; 	
		if(isset($_POST['ACCESSNAME']))
		{
			foreach($_POST['DOW'] as $item_id){
				$item_id1  = $item_id1.",".$item_id;
				}
				$connection3 = Yii::app()->db;
				$sql3 = "INSERT INTO ACCESSNAME (STARTTIME ,ENDTIME ,DOW ,ALLOWIP)
				VALUES ('{$start}','{$end}','{$item_id1}','{$ip}')";
				$command3 = $connection3->createCommand($sql3);
				$dataReader3 = $command3->query();
				Func::add_loglogmodify($user,$status,$action,$name); 
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		//print_r($_POST);
		$user = Yii::app()->session['user'];
		$status ="OK";
		$action ="MODIFY";
		$row=Yii::app()->db->createCommand("SELECT DOW FROM ACCESSNAME WHERE ID = '{$id}'")->queryAll();
		foreach($row as $item){
		$dow1 = $item['DOW'];
		$dow =explode(",",$dow1);
		}
		
		$model=$this->loadModel($id);
		//print_r($_POST);
		$start = $_POST['ACCESSNAME']['STARTTIME'];
		$end = $_POST['ACCESSNAME']['ENDTIME'];
		$ip = $_POST['ACCESSNAME']['ALLOWIP']; 	
		if(isset($_POST['ACCESSNAME']))
			if ((preg_match('/^s*[0-9%]{0,3}.[0-9%]{0,3}\.[0-9%]{0,3}.[0-9%]{0,3}s*$/', $ip))||($ip == "%")){
		{
				foreach($_POST['DOW'] as $item_id){
				$item_id1  = $item_id1.",".$item_id;
				}

				$connection3 = Yii::app()->db;
				$sql3 = "UPDATE   ACCESSNAME  SET STARTTIME = '{$start}' ,ENDTIME ='{$end}' ,DOW = '{$item_id1}',ALLOWIP ='{$ip}' WHERE ID = '{$id}'";
				$command3 = $connection3->createCommand($sql3);
				$dataReader3 = $command3->query();
				Func::add_loglogmodify($user,$status,$action,$id); 
				$this->redirect(array('admin'));
			}
		}else {
		//echo 'ssswer';
		Yii::app()->clientScript->registerScript('uniqueid', 'alert("Please input IP Address Format");');
		}

		$this->render('update',array(
			'model'=>$model,
			'dow'=>$dow,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		$user = Yii::app()->session['user'];
		$status ="OK";
		$action ="REMOVE";
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			Func::add_loglogmodify($user,$status,$action,$id); 
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ACCESSNAME');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ACCESSNAME('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ACCESSNAME']))
			$model->attributes=$_GET['ACCESSNAME'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ACCESSNAME the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ACCESSNAME::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ACCESSNAME $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='accessname-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
