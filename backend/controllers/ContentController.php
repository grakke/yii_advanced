<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/13
 * Time: 11:22
 */

namespace backend\controllers;


use yii\web\Controller;

class ContentController extends Controller
{
    public $layout = 'adminlte';
    public $enableCsrfValidation =false;

    public function actionUpdate()
    {
        if (\Yii::$app->request->isPost){
            echo '<pre>';
            var_dump($_POST);
            die;
        }

        return $this->render('update');
    }
}