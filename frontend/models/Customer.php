<?php

namespace frontend\models;

/**
 * 
 */
class Customer extends \yii\db\ActiveRecord
{

	public function init(){
		parent::init();
		$this->status = 2;
	}

	public functiongetOrders(){
		return $this->hasMany('Order', ['customer_id' => 'id'])
	}
}