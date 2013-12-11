<?php

class EdituserController extends Controller
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
				'actions'=>array('admin','delete','deleted'),
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
	$model=new UserLogin;
	$name =$_POST['UserLogin']['NAME'];
	$full_name =$_POST['UserLogin']['FULL_NAME'];
	$comment =$_POST['UserLogin']['COMMENT'];
	$group =$_POST['UserLogin']['GROUPNAME_ID'];
	$accessgroup =$_POST['UserLogin']['ACCESSGROUP_ID'];
	$passwordold =$_POST['UserLogin']['PASSWORD'];	
	$password =md5($passwordold);
		if(isset($_POST['UserLogin']))
		{
			$model->attributes=$_POST['UserLogin'];
		
			$connection = Yii::app()->db;
			$sql = "INSERT INTO USERNAME (NAME ,FULL_NAME ,COMMENT ,PASSWORD ,EMAIL ,GROUPNAME_ID ,ACCESSGROUP_ID)
			VALUES ('{$name}' ,'{$full_name}','{$comment}','{$password}' ,'{$email}','{$group}' ,'{$accessgroup}')";
			$command = $connection->createCommand($sql);
			$dataReader = $command->query();
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
	$model=$this->loadModel($id);
	$model->attributes=$_POST['UserLogin']; // call value form
	$id = $model->ID;
	$name =$_POST['UserLogin']['NAME'];
	$full_name =$_POST['UserLogin']['FULL_NAME'];
	$comment =$_POST['UserLogin']['COMMENT'];
	$passwordold =$_POST['UserLogin']['PASSWORD'];	
	$password =md5($passwordold);
	$email =$_POST['UserLogin']['EMAIL'];	

		if(isset($_POST['UserLogin']))
		{
			$model->attributes=$_POST['UserLogin'];
			if($model->save())
			$connection = Yii::app()->db;
			$sql = "UPDATE USERNAME SET NAME = '{$name}',FULL_NAME = '{$full_name}',COMMENT = '{$comment}',PASSWORD = '{$password}',EMAIL = '{$email}'
			WHERE ID = '{$id}'";
			$command = $connection->createCommand($sql);
			$dataReader = $command->query();
			$this->redirect(array('view','id'=>$model->ID));
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
	/* public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	} */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	} 

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('UserLogin');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserLogin('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserLogin']))
			$model->attributes=$_GET['UserLogin'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return UserLogin the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=UserLogin::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param UserLogin $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
