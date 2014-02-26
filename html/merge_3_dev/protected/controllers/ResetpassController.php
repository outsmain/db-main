<?php

class ResetpassController extends Controller
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
				'actions'=>array('index','view','repass','ResetPass','Sended','reseted'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','repass'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
	public function actionRepass()
	{
	$model=new UserLogin;
	if(isset($_POST['UserLogin'])){
		$mail_in =  $_POST[UserLogin][EMAIL];
		$connection = Yii::app()->db;
		$menu = array();
		$sql = "SELECT * FROM USERNAME WHERE EMAIL ='{$mail_in}'";
		$command = $connection->createCommand($sql);
		$dataReader = $command->query();

		
				if($dataReader->rowCount !== 0){
				foreach ($dataReader as $row) { 
				//Yii::app()->clientScript->registerScript('uniqueid', 'alert("mail send to your email);');
				$to_email =$row['EMAIL'];
				$to_name =$row['NAME'];
				$postto_mail = base64_encode($to_email);
				$postto_name = base64_encode($to_name);
				
				
		$from_name ="ITMTN";
		$from_email ="nueng.me@gmail.com";
		$to_name ="nueng.me@gmail.com";
		$subject ="link for reset password";
		
		$message = "click this link to change your password "."\n"." http://localhost/test3/index.php?r=resetpass/resetpass&post='{$postto_name}'";
		 
		Email::sendGmail($from_name,$from_email, $to_name,$to_email, $subject, $message); 
		//echo  "mail send to ".$mai = $row['EMAIL'];
		$this->redirect(array('sended'));
		 
		//Email::sendEmail($from_name, $to_email, $subject, $message);
					}
				}
				else {
				Yii::app()->clientScript->registerScript('uniqueid', 'alert("Not found Email");');
			
				
		}
		}
				//$this->addError('password','Incorrect username or password.');
		$this->render('repass',array(
		'model'=>$model,
		));
	
	}
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	public function actionResetPass($post)
	{
		$model=new UserLogin;
		$de_user =base64_decode($post);
		$pass2 =$_POST['UserLogin']['PASSWORD2'];
		$pass1 =$_POST['UserLogin']['PASSWORD'];
		if(isset($_POST['UserLogin']))
		{
		if($pass1 == $pass2){
		$pass=	md5($_POST['UserLogin']['PASSWORD']);
		 Func::resetPassword($de_user,$pass);
		$this->redirect(array('reseted'));	
		}
		else {
		Yii::app()->clientScript->registerScript('uniqueid', 'alert("Password not match ");');
		}
			 
		 }
		
		$this->render('resetpass',array(
		'model'=>$model,
		));
	}
	public function actionCreate()
	{
		$model=new UserLogin;
		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionSended()
	{
		$model=new UserLogin;
		$this->render('sended');
	}
	public function actionReseted()
	{
		$model=new UserLogin;
		$this->render('reseted');
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserLogin']))
		{
			$model->attributes=$_POST['UserLogin'];
			if($model->save())
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

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
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
	public function actionRemoteValidate(){
		if(Yii::app()->request->isAjaxRequest) {
			if(isset($_GET['TestForm'])) {
				$testForm=new TestForm;
				$testForm->setAttributes($_GET['TestForm'],false);
				echo CJavaScript::jsonEncode($testForm->isUniqueMail());
			}
		}
	}
}
