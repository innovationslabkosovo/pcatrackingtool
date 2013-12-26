<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'UNICEF PCA Tracking Tool',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		//'application.extensions.CAdvancedArBehavior',
		'application.extensions.ESaveRelatedBehavior',
		'application.extensions.alpha',
		'application.modules.user.models.*',		
		'application.modules.profile.models.*',
		'application.modules.role.models.*',
		'application.modules.friendship.models.*',
		'application.vendors.phpexcel.PHPExcel'


	),
	'theme'=>'bootstrap',
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'******',
			'generatorPaths'=>array(
	                'bootstrap.gii',
            ),
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),),

			'user' => array(
			'debug' => false,
			),		
			//'registration' => array(),
		      //  'avatar' => array(),
		        'role' => array(),
		     //   'messages' => array(),
		      //  'usergroup' => array(),
		        // 'membership' => array(),
		      //  'message'=>array(),
		      //  'profile' => array(),
		       // 'friendship' => array()
        
		
	),

	// application components
	'components'=>array(
		 'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),


		// include User Management extension components

		// include user components
		'user'=>array(
			// enable cookie-based authentication
			'class' => 'application.modules.user.components.YumWebUser',
			'allowAutoLogin'=>true,
			'loginUrl' => array('//user/login'),
		),
		// 'registration' => array(
  //           'enableRegistration' => true,
  //           'enableCaptcha' => true,
  //           'debug' => true,
  //           'registrationView' => 'application.views.registration.registration',
  //           'controllerMap' => array(
  //               'registration' => array(
  //                   'class' => 'application.controllers.RegistrationController' ),
  //           ),
  //       ),
		
		//include user models. tell your app to have access to User Model even if not in extension enviroment. 
		

		// set cashing component.
  		'cache' => array(
  			'class' => 'system.caching.CDummyCache'
  		),
  		
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'caseSensitive'=>false,     
				//'site/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        array('api/v1', 'pattern'=>'api/v1/<path:[\w|\/]+>', 'verb'=>'GET'),
        'dashboard'=>'dashboard/index'
        
			),
		),
		
		// 'db'=>array(
		// 	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		// ),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=pcatracking',
			'emulatePrepare' => true,
			'username' => 'db_username',
			'password' => 'password',
			'charset' => 'utf8',
			'tablePrefix' => '', 
			'enableProfiling'=>true,	   
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			//'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				  // array(
				  //    'class' => 'CEmailLogRoute',
      //               //'categories'=>'application.*',
      //               'levels' => CLogger::LEVEL_ERROR,
      //               'emails' => array('example@email.com'),
      //               'sentFrom' => 'log@example.com',
      //               'subject' => 'Error at example.com',
      //           ),
                array(
                   'class' => 'CFileLogRoute',
                   'levels' => CLogger::LEVEL_WARNING,
                   'logFile' => 'Warnings',
                ), 
                array(
                   'class' => 'CFileLogRoute',
                   //'categories'=>'application.*',
                   'levels' => CLogger::LEVEL_ERROR,
                   'logFile' => 'Errors',
                ), 
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => CLogger::LEVEL_INFO,
                    'logFile' => 'Information',
                ), 
                // array(
                //     'class' => 'CWebLogRoute',
                //     //'categories' => 'Performance Profile',
                //     'levels' => CLogger::LEVEL_PROFILE,
                //     'showInFireBug' => true,
                //     'ignoreAjaxInFireBug' => true,
                // ), 
    //             array(
    //                     'class' => 'CDbLogRoute',
    //                     'levels' => 'info, warning, error',
    //                     'connectionID' => 'db',
    //                     'autoCreateLogTable' => true,
    //                 ),
                // array(
                //     'class'=>'CProfileLogRoute',
                //     'report'=>'summary',
                //     // lists execution time of every marked code block
                //     // report can also be set to callstack
                // ),
				// // uncomment the following to show log messages on web pages
				
				// array(
				// 	'class'=>'CWebLogRoute',
				// ),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'designcenter@kosovoinnovations.org',
	),
);
