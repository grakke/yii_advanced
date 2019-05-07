<?php

namespace frontend\controllers;

use yii\web\Controller;

/**
 * Base function
 */
class BaseController extends Controller
{
	
	public $layout = false;

	public function behaviors(){
		return [
			'access' => [
				'class' => 'yii\filters\AccessControl',
				'rules' => [
					[
						// 是否允许登录
						'allow' => true,
						// 允许路由 
						'actions' => ['admin', 'widget'], 
						// 角色限制
						'roles' => ['@'],
					],
				],
			],
		];
	}

	// frontend.yii2.localhost/index.php?r=base/view&code=CN
	public function actionView($code){
		$model = \frontend\models\Country::findOne($code);
		if ($model) {
			return $this->render('view');
		}else{
			throw new \yii\web\NotFoundHttpException;
		}
	}

	public function actionWidget(){
		$model = \frontend\models\Country::findOne(['code' => 'CN']);

		return $this->render('widget', ['model' => $model]);
	}
}