<?php

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Каталог книг',
	'preload'=>array('log'),
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
	'modules'=>array(),

	'components'=>array(
		'authManager'=>array(
			'class'=>'CDbAuthManager',
			'connectionID'=>'db',
			'itemTable'=>'auth_item',
			'itemChildTable'=>'auth_item_child',
			'assignmentTable'=>'auth_assignment',
		),
		'user'=>array(
			'class'=>'WebUser',
			'allowAutoLogin'=>true,
			'loginUrl'=>array('/site/login'),
		),
		'sms'=>array(
			'class'=>'SmsService',
			'apiKey'=>'XXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZXXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZ',
			'testMode'=>true,
		),
		'db'=>require(dirname(__FILE__).'/database.php'),
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
		'request'=>array(
			'baseUrl'=>'',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, info',
					'categories'=>'sms',
					'logFile'=>'sms.log',
				),
				array('class'=>'CFileLogRoute', 'levels'=>'error, warning'),
				array('class'=>'CWebLogRoute', 'levels'=>'error, warning'),
			),
		),
	),

	'homeUrl'=>array('/book/index'),

	'params'=>array(
		'adminEmail'=>'webmaster@example.com',
		'uploadPath'=>'uploads',
	),
);
