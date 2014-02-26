<?php

class ConfreposController extends Controller
{
	public function actionIndex()
	{
		$model=new loginlog;
		$model->UPDATE_DATE = date('Y-m-d 00:00');
		$model->UPDATE_DATE2 = date('Y-m-d 23:59');
		$this->render('index',array('model'=>$model,)
									);

	}
	public function actionDropvision()
	{
		echo "virsion: ".$_POST['vision'];
		echo "v";						 
	}
	
}

?>