<?php
$params = array_merge(
	require __DIR__.'/../../common/config/params.php',
	require __DIR__.'/../../common/config/params-local.php',
	require __DIR__.'/params.php',
	require __DIR__.'/params-local.php'
);

return [
	'id' => 'app-frontend',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'name' => '前台',
	'timeZone' => 'Asia/Shanghai',
	'sourceLanguage' => 'en-US',
	'controllerNamespace' => 'frontend\controllers',
	'params' => $params,
	'version' => 1.2,
	'layout' => 'main', # false关闭 默认main

	'components' => [
		'request' => [
			'baseUrl' => '',
			'csrfParam' => '_csrf-frontend',
		],
		'user' => [
			'identityClass' => 'common\models\User',
			'enableAutoLogin' => true,
			'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
		],
		'monolog' => [
			'class' => '\Mero\Monolog\MonologComponent',
			'channels' => [
				'main' => [
					'handler' => [
						[
							'type' => 'stream',
							'path' => '@app/runtime/logs/main_'.date('Y-m-d').'.log',
							'level' => 'debug'
						]
					],
					'processor' => [],
				],
				'channel1' => [
					'handler' => [
						[
							'type' => 'stream',
							'path' => '@app/runtime/logs/channel1_'.date('Y-m-d').'.log',
							'level' => 'debug'
						]
					],
					'processor' => [],
				],
				'channel2' => [
					'handler' => [
						[
							'type' => 'stream',
							'path' => '@app/runtime/logs/channel1_'.date('Y-m-d').'.log',
							'level' => 'debug'
						]
					],
					'processor' => [],
				],
			],
		],
		'cache' => [
//            'class' => 'yii\redis\Cache',
//            'redis' => [
//                'hostname' => 'localhost',
//                'port' => 6379,
//                'database' => 0,
//            ],
		],
		'session' => [
			// this is the name of the session cookie used for login on the frontend
			'name' => 'advanced-frontend',
//            'class' => 'yii\redis\Session',
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],

		'urlManager' => [
			// true 不带r
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
				'pattern' => 'post/<page:\d+>/tag',
				'route' => 'post/index',
				// 'defaults' => ['page' => 1],
			],
		],
	],

	# 维护功能
	'catchAll' => [
		// 'site/notice',
		// 'param1' => 'value1',
		// 'param2' => 'value2',
	],

	'controllerMap' => [
		'account' => 'app\controllers\UserController',
		'article' => [
			'class' => 'app\controllers\PostController',
			'enableCsrfValidation' => false,
		],
	],

	'modules' => [
		// a "booking" module specified with the module class
		'booking' => 'app\modules\booking\BookingModule',

		// a "comment" module specified with a configuration array
		'comment' => [
			'class' => 'app\modules\comment\CommentModule',
			'db' => 'db',
		],
	],
];
