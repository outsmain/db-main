<?php

class GROUPNAMEController extends Controller
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
	$pag=Yii::app()->db->createCommand("SELECT NAME FROM USERNAME WHERE GROUPNAME_ID='1'")->queryAll();
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

	public function actionView($id)
	{
		$sql = "SELECT *
			FROM GROUPNAME "; 
		$dataProvider = new CSqlDataProvider($sql, array(    // เอา sql แปลงเป็น dataProvider
		 /*  'pagination' => array(
		  'pageSize' => 10,       
		  ), */
		  ));
          $this->render('view', array('dataProvider' => $dataProvider));   
	}

	public function actionCreate()
	{
		//print_r($_POST);
		$model=new GROUPNAME;
		$model2=new GROUPAUTHORIZE;
		$user = Yii::app()->session['user'];
		$status ="OK";
		$action ="ADD";
		if(isset($_POST['GROUPNAME'])|| isset($_POST['GROUPNAME']))
			{
	
		$connection = Yii::app()->db;
		$sql = "SELECT * FROM GROUPNAME ORDER BY ID DESC LIMIT 1";
		$command = $connection->createCommand($sql);
		$dataReader = $command->query();
		foreach ($dataReader as $row) { 
		 $las_id = $row['ID'];	
		}
		$group_id = $las_id +1;
		$model2->attributes=$_POST['GROUPAUTHORIZE'];
		$name =$_POST['GROUPNAME']['NAME'];
		$comment =$_POST['GROUPNAME']['COMMENT'];
		$acc_id =$_POST['ACCESSGROUP_ID'];
		$plat =$_POST['GROUPNAME']['PLATFORM_ID'];
		//insert table groupname
		$connection3 = Yii::app()->db;
		$sql3 = "INSERT INTO GROUPNAME (ID ,NAME ,COMMENT,ACCESSGROUP_ID,PLATFORM_ID)
		VALUES ('{$group_id}' ,'{$name}','{$comment}','{$acc_id}','{$plat}')";
		$command3 = $connection3->createCommand($sql3);
		$dataReader3 = $command3->query();

			foreach($_POST['PAGENAME_ID'] as $item_id){
			//insert table GROUPAUTHORIZE
			$connection2 = Yii::app()->db;
			$sql2 = "INSERT INTO GROUPAUTHORIZE (GROUPNAME_ID ,PAGENAME_ID ,ACCESSGROUP_ID)
			VALUES ('{$group_id}' ,'{$item_id}','{$acc_id}')";
			$command2 = $connection2->createCommand($sql2);
			$dataReader2 = $command2->query();
	
				}

			Func::add_loglogmodify($user,$status,$action,$name); 	
			$this->redirect(array('admin'));
		
			}

		$this->render('create',array(
			'model'=>$model,
			'model2'=>$model2,
		));
	}
	
	public function actionUpdate($id,$acc_id)
	{
		//print_r($_POST);
		$model=new GROUPNAME;
		$model2=new GROUPAUTHORIZE;
		$model=$this->loadModel($id);
		$user = Yii::app()->session['user'];
		$status ="OK";
		$action ="MODIFY";
		$name2 =$_POST['GROUPNAME']['NAME'];
		$comment2 =$_POST['GROUPNAME']['COMMENT'];
		$acc_id2 =$_POST['ACCESSGROUP_ID'];
		$plat2 =$_POST['GROUPNAME']['PLATFORM_ID'];	
		
		if($acc_id == null){
		
			if(isset($_POST['GROUPNAME']))
			{ 
				$commanddel =  Yii::app()->db->createCommand("DELETE FROM GROUPAUTHORIZE WHERE GROUPNAME_ID='{$id}' AND ACCESSGROUP_ID ='{$acc_id2}'");
				$dataReaderdel = $commanddel->query();
				$commandn =Yii::app()->db->createCommand("UPDATE GROUPNAME SET NAME = '{$name2}', COMMENT = '{$comment2}',ACCESSGROUP_ID ='{$acc_id2}',PLATFORM_ID ='{$plat2}'
						WHERE ID = '{$id}'");
				$dataReadern = $commandn->query();
			 foreach($_POST['PAGENAME_ID'] as $item_idn){
	
				$command3n = Yii::app()->db->createCommand("INSERT INTO GROUPAUTHORIZE (GROUPNAME_ID ,PAGENAME_ID ,ACCESSGROUP_ID)
				VALUES ('{$id}' ,'{$item_idn}','{$acc_id2}')");
				$dataReader3n = $command3n->query();
				} 
				$this->redirect(array('admin'));
			}		
				$this->render('update',array(
				'model'=>$model,
				'model2'=>$model2,
				'pag'=>$pag,
				));
			}
		else{
		$row=Yii::app()->db->createCommand("SELECT PAGENAME_ID FROM GROUPAUTHORIZE WHERE GROUPNAME_ID='{$id}' AND ACCESSGROUP_ID ='{$acc_id}'")->queryAll();
		
		foreach($row as $item){
			$pag[] = $item['PAGENAME_ID'];
		}
		$model2=$this->loadModel($acc_id);
		//print_r($pag);
		$name =$_POST['GROUPNAME']['NAME'];
		$comment =$_POST['GROUPNAME']['COMMENT'];
		$acc_id =$_POST['ACCESSGROUP_ID'];
		$plat =$_POST['GROUPNAME']['PLATFORM_ID'];
		//print_r($_POST);
		 if(isset($_POST['GROUPNAME']))
		{
			$connection2 = Yii::app()->db;
			$sql2 = "DELETE FROM GROUPAUTHORIZE WHERE GROUPNAME_ID='{$id}' AND ACCESSGROUP_ID ='{$acc_id}'";
			$command2 = $connection2->createCommand($sql2);
			$dataReader2 = $command2->query();
			//print_r($_POST['GROUPAUTHORIZE']);
			
			 $connection = Yii::app()->db;
			 $sql = "UPDATE GROUPNAME SET NAME = '{$name}', COMMENT = '{$comment}',ACCESSGROUP_ID ='{$acc_id}',PLATFORM_ID ='{$plat}'
				WHERE ID = '{$id}'";
			 $command = $connection->createCommand($sql);
			 $dataReader = $command->query();
		 
			 foreach($_POST['PAGENAME_ID'] as $item_id){
			
				//insert table GROUPAUTHORIZE
				$connection3 = Yii::app()->db;
				$sql3 = "INSERT INTO GROUPAUTHORIZE (GROUPNAME_ID ,PAGENAME_ID ,ACCESSGROUP_ID)
				VALUES ('{$id}' ,'{$item_id}','{$acc_id}')";
				$command3 = $connection3->createCommand($sql3);
				$dataReader3 = $command3->query();
			
				} 
				Func::add_loglogmodify($user,$status,$action,$id); 
				$this->redirect(array('admin'));
					}	 
			$this->render('update',array(
			'model'=>$model,
			'model2'=>$model2,
			'pag'=>$pag,
		));
		
		}
		
	
	}

	public function actionDelete($id,$acc_id)
	{	
			$this->loadModel($id)->delete();
			$user = Yii::app()->session['user'];
			$status ="OK";
			$action ="REMOVE";
			$connection2 = Yii::app()->db;
			$sql2 = "DELETE FROM GROUPAUTHORIZE WHERE GROUPNAME_ID = '{$id}' AND ACCESSGROUP_ID = '{$acc_id}'";
			$command2 = $connection2->createCommand($sql2);
			$dataReader2 = $command2->query();
			Func::add_loglogmodify($user,$status,$action,$id); 
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax'])){

			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		
			
			
	}
	public function actionDeleted($id,$acc_id)
	{
			$connection = Yii::app()->db;
			$sql = "DELETE FROM GROUPNAME WHERE ID = '{$id}'";
			$command = $connection->createCommand($sql);
			$dataReader = $command->query();
			
			$connection2 = Yii::app()->db;
			$sql2 = "DELETE FROM GROUPAUTHORIZE WHERE GROUPNAME_ID = '{$id}' AND ACCESSGROUP_ID = '{$acc_id}'";
			$command2 = $connection2->createCommand($sql2);
			$dataReader2 = $command2->query();
			
			
			$this->redirect(admin);
			
			
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('GROUPNAME');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model=new GROUPNAME('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GROUPNAME']))
			$model->attributes=$_GET['GROUPNAME'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=GROUPNAME::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param GROUPNAME $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='groupname-form')
		{
			 echo CActiveForm::validate(array($model, $model2));
			Yii::app()->end();
		}
	}
}
