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
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Exception;

class LogController extends Controller
{
    public $layou = 'new';
    public function actionYiiMono()
    {
        $monologComponent = Yii::$app->monolog;
        $logger = $monologComponent->getLogger();
        $logger->log('info', 'Hello world232');
        $logger->log('error', 'Hello world again');

        $logger = $monologComponent->getLogger("channel1");
        $logger->log('warning', 'Hello world channel1');
        $logger->log('error', 'Hello world channelagin');
    }

    // monolog
    public function actionMono()
    {
        $logger = new Logger('my_logger');
        $logger->pushHandler(new StreamHandler(Yii::$app->basePath . '/runtime/logs/my_app.log', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());
        $logger->info('My logger is now ready');
        echo 'hello';
        die;
    }
    // php-fig/log
    public function log()
    {
    }

    public function actionTry()
    {
        try {
            throw new Exception('wrong code');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
