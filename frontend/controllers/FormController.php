<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/25
 * Time: 10:48
 */

namespace frontend\controllers;


use common\models\LoginForm;
use yii\web\Controller;

class FormController extends Controller
{


    public function actionLogin()
    {
        $model = new LoginForm();

        return $this->render('login', [
            'model' => $model
        ]);
    }
}