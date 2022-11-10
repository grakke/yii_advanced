<?php
return [
	'aliases' => [
		'@bower' => '@vendor/bower-asset',
		'@npm' => '@vendor/npm-asset',
	],
	'vendorPath' => dirname(dirname(__DIR__)).'/vendor',
	'components' => [
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'i18n' => [
			'translations' => [
				'*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@common/messages',
					'fileMap' => [
						'common' => 'common.php',
					],
				],
			],
		],
	],

	'language' => isset($_COOKIE['language']) ? $_COOKIE['language'] : 'zh',
];
