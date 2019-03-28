<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2018/7/25
 * Time: 10:58 PM
 */

namespace console\controllers;

use yii\console\Controller;
use yii\console\ExitCode;
use yii\console\widgets\Table;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TestController extends Controller
{
    public $message;

    public function options($actionID)
    {
        return ['message'];
    }

    public function optionAliases()
    {
        return ['m' => 'message'];
    }

    public function actionInputAlias()
    {
        echo $this->message . "\n";
        return ExitCode::OK;
    }

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     *
     * @return int
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
        return ExitCode::OK;
    }

    public function actionInputArgs($arg1, $arg2, $arg3)
    {
        echo $arg1 . "\n";
        echo $arg2 . "\n";
        echo $arg3 . "\n";
        return ExitCode::OK;
    }

    public function actionInputArray(array $name)
    {
        $this->stdout("Hello?\n");
        echo $name[0] . "\n";
        echo $name[1] . "\n";
        return ExitCode::OK;
    }

    public function actionOutputTable()
    {
        echo Table::widget([
            'headers' => ['Project', 'Status', 'Participant'],
            'rows' => [
                ['Yii', 'OK', '@samdark'],
                ['Yii', 'OK', '@cebe'],
            ],
        ]);
        return ExitCode::OK;
    }


}
