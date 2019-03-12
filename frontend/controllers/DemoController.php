<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/19
 * Time: 17:28
 */

namespace frontend\controllers;

use frontend\models\Country;
use frontend\models\Homeland;
use yii;
use yii\web\Controller;

class DemoController extends Controller
{
    public $layout = 'new';

    /**
     * @return object
     */
    public function actionReq()
    {
        $request = Yii::$app->request;
        $id = $request->get('id', 1);
        $name = $request->post('name', '');

        $params = $request->bodyParams;
        $headers = $request->headers;
        $userHost = $request->userHost;
        $userIP = $request->userIP;

//        throw new \yii\web\NotFoundHttpException;

        // 增加一个 Pragma 头，已存在的Pragma 头不会被覆盖。
        $headers->add('Pragma', 'no-cache');

        // 设置一个Pragma 头. 任何已存在的Pragma 头都会被丢弃
        $headers->set('Pragma', 'no-cache');

        // 删除Pragma 头并返回删除的Pragma 头的值到数组
        $values = $headers->remove('Pragma');

//        $response = Yii::$app->response;
//        $response->format = \yii\web\Response::FORMAT_JSON;
//        $response->data = ['message' => 'hello world'];
//        return $response;

        return \Yii::createObject([
            'class' => 'yii\web\Response',
            'format' => \yii\web\Response::FORMAT_JSON,
            'data' => [
                'message' => 'hello world',
                'code' => 100,
                'data' => [
                    'name' => 'henry',
                    'age' => 28,
                ]
            ],
        ]);
    }

    public function actionRes()
    {
        return yii::$app->response->redirect('http://example.com/new', 301)->send(['type' => 'redirect']);
    }

    public function actionDnload()
    {
//        return \Yii::$app->response->sendFile('@cssPath/site.css')->send();

        return \Yii::$app->response->sendContentAsFile('hello world!', 'info');
    }

    public function actionSess()
    {
        $language = yii::$app->request->get('lan', 'us');
        $na = yii::$app->request->get('America');
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }


        if (!$session->has('language') || !isset($_SESSION['na'])) {
            $session->set('language', $language);
            $_SESSION['na'] = $na;

            // 单独赋值不生效
            $session['captcha'] = [
                'number' => 5,
                'lifetime' => 3600,
            ];
        }

        echo $session['language'];
        echo $session['na'];

        // flash的使用
        //        $session->setFlash('flashKey', '18817263572');
        if ($session->has('flashKey')) {
            echo $session->getFlash('flashKey');
        }


        return \Yii::$app->response->sendContentAsFile('hello world!', 'info');
    }

    public function actionCokie()
    {
        $cookies = Yii::$app->request->cookies;
        $language = $cookies->getValue('language', 'ge');

        echo $language;

        $cookiesRes = Yii::$app->response->cookies;
        $cookiesRes->add(new \yii\web\Cookie(
            [
                'name' => 'language2',
                'value' => 'zh-CN'
            ]
        ));

        return Yii::$app->response;
    }

    public function actionCom()
    {
        return $this->render('com', [
            'foo' => 1,
            'bar' => 2
        ]);

        //		return $this->renderPartial('partial');

//		echo Yii::$app->view->renderFile('@app/views/site/license.php');
    }

    public function actionAttr()
    {
        $homeland = Homeland::findOne(['code' => 'RU']);
        var_dump($homeland);
    }

    /*
     * 通过session切换语言
     */
    public function actionLan($language)
    {
        $session = Yii::$app->session;
        $session->open();

        if (isset($language)) {
            Yii::$app->session['language'] = $language;
        }

        $this->goBack(Yii::$app->request->headers['Referer']);
    }

    public function actionWidg()
    {
        return $this->render('widgt');
    }

    public function actionMono()
    {
        $monologComponent = Yii::$app->monolog;
        $logger = $monologComponent->getLogger();
        $logger->log('info', 'Hello world');

        $logger = $logger = $monologComponent->getLogger("channel1");
        $logger->log('warning', 'Hello world');
    }
}
