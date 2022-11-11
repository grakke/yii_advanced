<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/19
 * Time: 14:41
 */

namespace frontend\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{
	public $name = 'bluebird89';
	public $firstName = 'Henry';
	public $lastName = 'Lee';

	const SCENARIO_LOGIN = 'login';
	const SCENARIO_REGISTER = 'register';

	public function scenarios()
	{
		$scenarios = parent::scenarios();

		$scenarios[self::SCENARIO_LOGIN] = ['username', 'password'];
		$scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];

		return $scenarios;
	}

	public function rules()
	{
		return [
			// username, email and password are all required in "register" scenario
			[['username', 'email', 'password'], 'required', 'on' => self::SCENARIO_REGISTER],

			// username and password are required in "login" scenario
			[['username', 'password'], 'required', 'on' => self::SCENARIO_LOGIN],
		];
	}

	public function fields()
	{
		return [
			// 字段名和属性名相同
			'id',

			// 字段名为 "email"，对应属性名为 "email_address"
			'email' => 'email_address',

			// 字段名为 "name", 值通过PHP代码返回
			'name' => function () {
				return $this->first_name.' '.$this->last_name;
			},
		];
	}
}
