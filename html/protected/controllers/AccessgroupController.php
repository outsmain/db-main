<?php

class ACCESSGROUPController extends Controller
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
		$model=new ACCESSGROUP;
		$user = Yii::app()->session['user'];
		$status ="OK";
		$action ="ADD";
		$acc_n = $_POST['ACCESSNAME_ID'];
		$name =$_POST['ACCESSGROUP']['ACCESSGROUP_ID'];
		if(isset($_POST['ACCESSGROUP']))
		{
			$connection3 = Yii::app()->db;
				$sql3 = "INSERT INTO ACCESSGROUP (ACCESSGROUP_ID,ACCESSNAME_ID) VALUES ('{$name}','{$acc_n}')";
				$command3 = $connection3->createCommand($sql3);
				$dataReader3 = $command3->query();
				Func::add_loglogmodify($user,$status,$action,$id); 
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
		$model=$this->loadModel($id);
		$user = Yii::app()->session['user'];
		$status ="OK";
		$action ="MODIFY";
		$acc_n = $_POST['ACCESSNAME_ID'];
		$acc_g = $_POST['ACCESSGROUP']['ACCESSGROUP_ID'];
		//$_POST['ACCESSGROUP']['ACCESSNAME_ID'] = $_POST['ACCESSNAME_ID'];
		if(isset($_POST['ACCESSGROUP']))
		{
			//$model->attributes=$_POST['ACCESSGROUP'];
				$connection3 = Yii::app()->db;
				$sql3 = "UPDATE ACCESSGROUP SET ACCESSNAME_ID = '{$acc_n}', ACCESSGROUP_ID = '{$acc_g}'
							WHERE ID = '{$id}'";
				$command3 = $connection3->createCommand($sql3);
				$dataReader3 = $command3->query();
				Func::add_loglogmodify($user,$status,$action,$id); 
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
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		$user = Yii::app()->session['user'];
		$status ="OK";
		$action ="REMOVE";
		Func::add_loglogmodify($user,$status,$action,$id); 
		if(!isset($_GET['ajax'])){
			
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ACCESSGROUP');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		//$model=new ACCESSGROUP('search');
		$model=new ACCESSGROUP;
		$model->group;
		$model2=new ACCESSNAME;
		$model->unsetAttributes();  // clear any default values
		$sql = "SELECT * FROM GROUPNAME a JOIN ACCESSGROUP b ON ( a.`ACCESSGROUP_ID` = b.`ACCESSGROUP_ID` ) 
				JOIN ACCESSNAME c ON ( b.`ACCESSNAME_ID` = c.`ID`)"; 
		$dataProvider = new CSqlDataProvider($sql, array(    // เอา sql แปลงเป็น dataProvider
		 /*  'pagination' => array(
		  'pageSize' => 10,       
		  ), */
		  ));
		if(isset($_GET['ACCESSGROUP']))
			$model->attributes=$_GET['ACCESSGROUP'];
		$sql = "SELECT a.NAME,c.STARTTIME,c.ENDTIME,c.DOW,b.ID FROM GROUPNAME a JOIN ACCESSGROUP b ON ( a.`ACCESSGROUP_ID` = b.`ACCESSGROUP_ID` ) 
				JOIN ACCESSNAME c ON ( b.`ACCESSNAME_ID` = c.`ID`)"; 
		$dataProvider = new CSqlDataProvider($sql, array(    // เอา sql แปลงเป็น dataProvider
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

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ACCESSGROUP the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ACCESSGROUP::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ACCESSGROUP $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='accessgroup-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
