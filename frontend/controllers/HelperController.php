<?php 

namespace frontend\controllers;

use yii\web\Controller;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use frontend\models\User;

class HelperController extends Controller {

	public function actionHtml(){
		echo Html::encode('Test > test');
	}

	public function actionArray(){
		// todo: add self-defined helper
		// echo ArrayHelper::merge(['name' => 'Henry'], ['last' => ' World']);

		$array = ['foo' => ['bar' => new User()]];

		echo ArrayHelper::getValue($array, 'foo.bar.name');

		$user = new User();
		echo ArrayHelper::getValue($user, function($user, $defaultValue){
			return $user->firstName . ' ' . $user->lastName;
		});
	}

}