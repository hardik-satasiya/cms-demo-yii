<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
//echo "<pre>";print_r($this);exit;
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
        'ycm'=>array(
			'username'=>'hardik',
			'password'=>'hardik',
			'registerModels'=>array(
				//'application.models.Blog', // one model
				'application.models.*', // all models in folder
			),
			'uploadCreate'=>true, // create upload folder automatically
			'redactorUpload'=>true, // enable Redactor image upload
		),
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'hardik',
                        'generatorPaths' => array('bootstrap.gii'),
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

	),
        'preload' => array(
                'log',
                'bootstrap',

        ),
	// application components
	'components'=>array(
                'bootstrap' => array(
                    'class' => 'ext.bootstrap.components.Bootstrap',
                    'responsiveCss' => true,
                ),
                'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        'loginUrl'=>array('/site/mylogin'),
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
	        //'caseSensitive'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=cms_demo',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'drc123',
			'charset' => 'utf8',
                        'enableProfiling' => true,
			'enableParamLogging' => true
		),
		'dynamicRes'=>array(
            'class' => 'application.extensions.DynamicRes.DynamicRes',
            'urlConfig' => array( // Its fix Css, and convert Url to RealName
                'baseUrl'  => 'http:/localhost/yii_framework/cms/demo/', // Url of your Site (ending with /), modify it if you use subdomain
                'basePath' => '/var/www/yii_framework/cms_demo/', // path of your site (ending with /) (No Change This)
            )
        ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
                                array(
					'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
					// Access is restricted by default to the localhost
					//'ipFilters'=>array('127.0.0.1','192.168.1.*', 88.23.23.0/24),
			   	),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'hardik.satasiya@drcsystems.com',
	),
);
