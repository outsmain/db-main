<?php

class GroupauthorizeController extends Controller
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

	public function actionCreate()
	{
		$model=new GROUPAUTHORIZE;
		
		 if(isset($_POST['GROUPAUTHORIZE']))
		
		{
		$model->attributes=$_POST['GROUPAUTHORIZE'];

		} 

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id,$acc_id)
	{
		$model=new GROUPAUTHORIZE;
		$model2=new GROUPNAME;
		$model=$this->loadModel($id);
		$model2=$this->loadModel($acc_id);
		///
		/* $connection = Yii::app()->db;
		$sql = "SELECT * FROM GROUPAUTHORIZE WHERE GROUPNAME_ID ='{$id}' AND ACCESSGROUP_ID = '{$acc_id}' ";
		$command = $connection->createCommand($sql);
		$dataReader = $command->query();
		foreach ($dataReader as $row) { 
		$reurl = $row['PAGENAME_ID'];	
		} */
		//
		
		$id = $model->GROUPNAME_ID;
		print_r($model);
		if(isset($_POST['GROUPAUTHORIZE']))
		{
			$model->attributes=$_POST['GROUPAUTHORIZE'];
	
			
		}

		$this->render('update',array(
		'model'=>$model,
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

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('GROUPAUTHORIZE');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new GROUPAUTHORIZE('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GROUPAUTHORIZE']))
			$model->attributes=$_GET['GROUPAUTHORIZE'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return GROUPAUTHORIZE the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=GROUPAUTHORIZE::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param GROUPAUTHORIZE $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='groupauthorize-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
