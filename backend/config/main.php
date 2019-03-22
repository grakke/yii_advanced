<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log', 'admin'],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '192.168.83.1', '::1']
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'main', // it can be '@path/to/your/layout'.
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'backend\models\User',
                    'idField' => 'user_id'
                ],
                'other' => [
                    'class' => 'path\to\OtherController', // add another controller
                ],
            ],
            // 'menus' => [
            //     'assignment' => [
            //         'label' => 'Grand Access' // change label
            //     ],
            //     'route' => null, // disable menu route 
            // ]
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    // 'transport' => [
                    //     'class' => 'Swift_SmtpTransport',
                    //     'host' => 'localhost',
                    //     'username' => 'username',
                    //     'password' => 'password',
                    //     'port' => '587',
                    //     'encryption' => 'tls',
                    // ],
                    'categories' => ['yii\swiftmailer\Logger::add'],
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        // 异常处理方法配置
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => '{{%auth_item}}',
            'itemChildTable' => '{{%auth_item_child}}',
            'assignmentTable' => '{{%auth_assignment}}',
            'ruleTable' => '{{%auth_rule}}'
        ],
        'urlManager' => [
            'enablePrettyUrl' => false,
            'showScriptName' => false,
            'rules' => [
//                'posts/<year:\d{4}>/<category>' => 'post/index',
//                'posts' => 'post/index',
//                'post/<id:\d+>' => 'post/view',
//                '<controller:(post|comment)>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
//                '<controller:(post|comment)>/<id:\d+>' => '<controller>/view',
//                '<controller:(post|comment)>' => '<controller>/index',

            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'enableSwiftMailerLogging' => true,
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\classes\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
            // 'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],

    'params' => $params,
];
