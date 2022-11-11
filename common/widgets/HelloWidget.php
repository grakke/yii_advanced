<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2018/7/29
 * Time: 5:05 PM
 */

namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class HelloWidget extends Widget
{
	public $message;

	public function init()
	{
		parent::init();
		if ($this->message === null) {
			$this->message = 'Hello world!';
		}
	}

	public function run()
	{
		return Html::encode($this->message);
	}
}
