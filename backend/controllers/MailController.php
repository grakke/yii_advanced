<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Sms;

/**
 * Site controller
 */
class MailController extends Controller
{
	
	public function actionSend(){

		Yii::$app->mailer->compose([
			    'html' => 'contact-html',
			    'text' => 'contact-text',
			],  [
			    'user' => Yii::$app->user->identity,
			    'advertisement' => $adContent,
			])
		    ->setFrom('liboming88@yeah.net')
		    ->setTo('liboming@smg.cn')
		    ->setSubject('Message subject')
		    ->setTextBody('Plain text content')
		    ->setHtmlBody('<b>HTML content</b>')
		    ->send();
	}

}