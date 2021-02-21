<?php

namespace backend\models;

class Rbac extends \yii\base\Model
{
	public $power;
	public $role;
	public $user;

	public function rules()
	{
		return [
			// 在这里定义验证规则
		];
	}

	public function attributeLabels()
	{
		return [
			'user' => '用户',
			'power' => '权限',
			'role' => '角色',
		];
	}
}
