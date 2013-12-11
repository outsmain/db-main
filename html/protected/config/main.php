<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
		/* 	$user = Yii::app()->session['user'];
			$connection = Yii::app()->db;
			$sql = "SELECT * FROM USERNAME
			WHERE NAME = '{$user}'";
			$command = $connection->createCommand($sql);
			$dataReader = $command->query();
			
			foreach ($dataReader as $row) { 
			$name = $row['ACCESSGROUP_ID'];
			} */	
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.jformvalidate.EHtml',
		//'application.extensions.yii-mail.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1234',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),
	/* 'behaviors'=>array(
    'appBehav'=>'ApplicationBehavior',    
    ), */
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,	
		),
		
		//force timeout 
		    
			 'session' => array(
			'class' => 'CDbHttpSession',
			'timeout' => 3600 ,  //10 sec 1hr = 60*60
            ), 
			
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=nerepdb',
			'emulatePrepare' => true,
			'username' => 'nerepweb',
			'password' => '13L.ZSX12wIXs',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
			'errorAction'=>'Resetpass/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		   'jformvalidate' => array (
    	'class' => 'application.extensions.jformvalidate.EJFValidate',
     	'enable' => true
    ),
	),
	   

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		
	),
);