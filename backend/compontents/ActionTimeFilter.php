<?php

namespace backend\components;

use ArrayHelper;
use Yii;
use yii\base\ActionFilter;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\ContentNegotiator;
use yii\web\Response;

class ActionTimeFilter extends ActionFilter
{
	public $enableCsrfValidation = false;

	// 开启csrf
	/**
	 * @var float|mixed|string
	 */
	private $_startTime;

	public function beforeAction($action)
	{
		$currentAction = $action->id;
		$accessActions = ['vote', 'like', 'delete', 'download'];
		if (in_array($currentAction, $accessActions)) {
			$action->controller->enableCsrfValidation = true;
		}
		parent::beforeAction($action);

		$this->_startTime = microtime(true);
		return parent::beforeAction($action);
	}

	// 应用 模块 控制器三级
	public function behaviors()
	{
		return [
			[
				'class' => 'yiifiltersHttpCache',
				'only' => ['index', 'view'],
				'except' => ['update', 'delete'],
				'rules' => [
					// 允许认证用户
					[
						'allow' => true,
						'roles' => ['@'],
					],
					// 默认禁止其他用户
				],
				// 利用Last-Modified 和 Etag HTTP头实现客户端缓存
				'lastModified' => function ($action, $params) {
					$q = new yiidbQuery();
					return $q->from('user')->max('updated_at');
				},
				// 认证用户
				'basicAuth' => [
					'class' => HttpBasicAuth::className(),
				],
			],

			// 支持响应内容格式处理和语言处理。 通过检查 GET 参数和 Accept HTTP头部来决定响应内容格式和语言
			[
				'class' => ContentNegotiator::className(),
				'formats' => [
					'application/json' => Response::FORMAT_JSON,
					'application/xml' => Response::FORMAT_XML,
				],
				'languages' => [
					'en-US',
					'de',
				],
			],
		];

//		return ArrayHelper::merge([
//			[
//				'class' => Cors::className(),
//				'cors' => [
//					'Origin' => ['http://www.myserver.net'],
//					'Access-Control-Request-Method' => ['GET', 'HEAD', 'OPTIONS'],
//				],
//			],
//		], parent::behaviors());
	}


	public function afterAction($action, $result)
	{
		$time = microtime(true) - $this->_startTime;
		Yii::trace("Action '{$action->uniqueId}' spent $time second.");
		return parent::afterAction($action, $result);
	}
}
