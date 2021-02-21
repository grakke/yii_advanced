<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2018/7/28
 * Time: 9:26 AM
 */

namespace common\widgets;

use yii\base\Widget;

class Lst extends Widget
{
	public $items = [];

	public function run()
	{
		// 渲染一个名为 "list" 的视图
		return $this->render('list', [
			'items' => $this->items,
		]);
	}
}
