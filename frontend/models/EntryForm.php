<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2018/7/9
 * Time: 11:50 AM
 */

namespace frontend\models;


use yii\base\Model;

class EntryForm extends Model
{
	public $name;
	public $email;

	public function rules()
	{
		return [
			[['name', 'email'], 'required'],
			['email', 'email']
		];
	}

	public function attributeLabels()
    {
        return [
            'email' => '邮箱',
        ];
    }
}