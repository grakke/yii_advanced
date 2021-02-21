<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 18-12-18
 * Time: 下午5:22
 */

namespace api\controllers;

use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\auth\QueryParamAuth;

class UserController extends ActiveController
{
	public $modelClass = 'api\models\User';

	public function behaviors()
	{
		// $behaviors = parent::behaviors();
		// $behaviors['rateLimiter']['enableRateLimitHeaders'] = true;
		// return $behaviors;

		return ArrayHelper::merge(parent::behaviors(), [
			'authenticator' => [
				'class' => QueryParamAuth::className()
			]
		]);
	}
}
