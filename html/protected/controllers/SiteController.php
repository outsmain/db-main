<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		if(!isset(Yii::app()->session['user'])){
			//$this->redirect('/');
		}
		//self::CheckLogin();
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$model= new LoginForm;
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$this->render('index');
		
		self::CheckLogin();
		$this->render('index',array('model'=>$model));
		
	}
	public function CheckLogin(){
		if(!isset(Yii::app()->session['user'])){	
			$model= new LoginForm;
			$this->render('login',array('model'=>$model));
			exit;
		}
	}
	/**
	 * This is the action to handle external exceptions.
	 */
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

	public function actionRepass(){
		
			$model= new LoginForm;
			$this->render('repass',array('model'=>$model));
			exit;
		
	}
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
	
			$model->attributes=$_POST['LoginForm'];
			//print_r($_POST);
			// validate user input and redirect to the previous page if valid
		
			if($model->validate() && $model->login()){
				$user =$_POST['LoginForm']['username'];	
				Yii::import('application.components.UserIdentity');
				Func::add_logtime($user);    //write ip and time to db
				
				// redirect from user rule 
				
			
			$first_url = Func::redirect_page($user);  		
			$this->redirect($first_url);	
				
			}
	
		}
				// display the login form
			$this->render('login',array('model'=>$model));
	}
	
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
		public function actionLogout()
		{
			//Yii::app()->user->logout();
			//$this->redirect(Yii::app()->homeUrl);
			if(!Yii::app()->user->isGuest)
				Yii::app()->user->logout(true);
					
			$this->redirect('index');
		}
		public function actionKeepAlive()
		{
			echo 'OK';
			Yii::app()->end();
		}
		public function actionSendMail()
		{
		$model=new UserLogin;
		print($_POST);
		//$name =$_POST['GROUPNAME']['NAME'];
		$from_name ="nueng.me@gmail.com";
		$from_email ="nueng.me@gmail.com";
		$to_email ="nuengnaja_00@hotmail.com";
		$subject ="testtttt";
		$message = "dkglk;lkg;lkv;gksmbl";
		echo "fff;";
		//Email::sendGmail($from_name,$from_email, $to_name,$to_email, $subject, $message); 
		//Email::sendEmail($from_name, $to_email, $subject, $message);
	
   }

	
	
}