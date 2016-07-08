<?php

return [
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'Yii Book Test',
	'defaultController' => 'site',
	// preloading 'log' component
	'preload' => ['log'],
	// autoloading model and component classes
	'import' => [
		'application.models.*',
		'application.components.*',
	],
	// application components
	'components' => [

		'user' => [
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'migrationPath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '../migrations/',
		],
		'db' => [
			'connectionString' => 'mysql:host=localhost;dbname=testyii',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		],
		'urlManager' => [
			'urlFormat' => 'path',
			'rules' => [
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			],
		],
		'log' => [
			'class' => 'CLogRouter',
			'routes' => [
				[
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				],
			],
		],
	],
	'params' => [
		'zend' => [
			'db' => [
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
				'driver' => 'Pdo_Mysql',
				'hostname' => '127.0.0.1',
				'database' => 'testyii',
			],
		],
	],
];
