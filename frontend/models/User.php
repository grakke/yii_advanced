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
            // 在"register" 场景下 username, email 和 password 必须有值
            [['username', 'email', 'password'], 'required', 'on' => 'register'],

            // 在 "login" 场景下 username 和 password 必须有值
            [['username', 'password'], 'required', 'on' => 'login'],
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
                return $this->first_name . ' ' . $this->last_name;
            },
        ];
    }
}