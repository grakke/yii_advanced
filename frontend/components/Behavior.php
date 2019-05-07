<?php

/**
 * Behavior
 */
class MyBehavior extends \yii\base\Behavior
{
	
	public function events(){
		return [
					ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
		];
	}

	public function beforeValidate($event){

	}
}