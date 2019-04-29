<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/29
 * Time: 15:21
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class CacheController extends Controller
{

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\HttpCache',
                'only' => ['index'],
                'params' =>  Yii::$app->request->get(),
                'lastModified' => function ($action, $params) {
                    $q = new \yii\db\Query();
                    return 1;
                }
            ],
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'duration' => 86400,
                'variations' => [
                    Yii::$app->language,
                    Yii::$app->name
                ],
                'dependency' => [
                    'class' => 'yii\caching\FileDependency',
                    'fileName' => ''
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        echo 'Index';
        die;
    }

    public function actionList()
    {
        echo 'List';
        die;
    }
}