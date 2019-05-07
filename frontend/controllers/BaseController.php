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
						'actions' => ['view','admin', 'widget', 'query'], 
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

	public function actionQuery(){
		$query = new \yii\db\Query();
		$query->select('code, name')->from('country')->limit(10);
		$command = $query->createCommand();
		$sql = $command->sql;
		$rows = $command->queryAll();

		var_dump($command, $sql, $rows);die;
	}

	public function actionActive(){
		$orders = $customer->getOrders()->andWhere('status=1')->asArray()->all();
	}
}