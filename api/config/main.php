<?php
$params = array_merge(
	require __DIR__.'/../../common/config/params.php',
	require __DIR__.'/../../common/config/params-local.php',
	require __DIR__.'/params.php'
);

return [
	'id' => 'app-api',
	'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'api\controllers',
	'bootstrap' => ['log'],
	'modules' => [
		'gii' => [
			'class' => 'yii\gii\Module',
//            'allowedIPs' => ['127.0.0.1', '192.168.83.1', '::1']
		]
	],
	'components' => [
		'request' => [
			'csrfParam' => '_csrf-api',
			'enableCookieValidation' => true,
			'enableCsrfValidation' => true,
			'cookieValidationKey' => 'hello&^&^&%*(world',
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
			]
		],
		'user' => [
			'identityClass' => 'common\models\User',
			'enableAutoLogin' => true,
			'enableSession' => false,
			'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
		],
		'session' => [
			// this is the name of the session cookie used for login on the backend
			'name' => 'advanced-api',
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
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'enableStrictParsing' => true,
			'rules' => [
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => ['v1/goods', 'user'],
					'pluralize' => false
				]
			]
		]

	],

	'modules' => [
		'v1' => [
			'class' => 'api\modules\v1\Module',
		],
	],
	'params' => $params,
];
