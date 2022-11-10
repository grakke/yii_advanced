<?php

namespace app\models;

use backend\components\MyBehavior;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int     $id
 * @property string  $username
 * @property string  $auth_key
 * @property string  $password_hash
 * @property string  $password_reset_token
 * @property string  $email
 * @property integer $role
 * @property int     $status
 * @property int     $created_at
 * @property int     $updated_at
 * @property string  $access_token
 * @property int     $allowance
 * @property int     $allowance_updated_at
 */
class User extends \yii\db\ActiveRecord
{
	public function behaviors()
	{
		return [
			// 匿名的行为，仅直接给出行为的类名称
			MyBehavior::className(),

			// 名为myBehavior2的行为，也是仅给出行为的类名称
			'myBehavior2' => MyBehavior::className(),

			// 匿名行为，给出了MyBehavior类的配置数组
			[
				'class' => MyBehavior::className(),
				'prop1' => 'value1',
				'prop3' => 'value3',
			],

			// 名为myBehavior4的行为，也是给出了MyBehavior类的配置数组
			'myBehavior4' => [
				'class' => MyBehavior::className(),
				'prop1' => 'value1',
				'prop3' => 'value3',
			]
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'user';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
			[['role', 'status', 'created_at', 'updated_at'], 'integer'],
			[['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
			[['auth_key'], 'string', 'max' => 32],
			[['username'], 'unique'],
			[['email'], 'unique'],
			[['password_reset_token'], 'unique'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'username' => 'Username',
			'auth_key' => 'Auth Key',
			'password_hash' => 'Password Hash',
			'password_reset_token' => 'Password Reset Token',
			'email' => 'Email',
			'status' => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'access_token' => 'Access Token',
			'allowance' => 'Allowance',
			'allowance_updated_at' => 'Allowance Updated At',
		];
	}
}
