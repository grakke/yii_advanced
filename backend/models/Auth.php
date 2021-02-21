<?php

namespace backend\models;

class Auth extends \yii\base\Model
{

	public static function tableName()
	{
		return 'auth_item';
	}

	public function rules()
	{
		return [

		];
	}


	public function attributeLabels()
	{
		return [
			'name' => '名称',
			'type' => '分类',
		];
	}

	//获取角色
	public function Rule_list()
	{
		$sql = 'select * from  `auth_item` where `type`=1 ';
		return \yii::$app->db->createCommand($sql)->queryAll();//执行
	}

	// 给管理员赋角色
	public function Add_assign($item_name, $user_id)
	{
		$time = time();
		$sql = "insert into auth_assignment (`item_name`,`user_id`,`created_at`) VALUE ('$item_name','$user_id',$time)";
		return \yii::$app->db->createCommand($sql)->query();//执行
	}

	//添加角色
	public function Add_rule($data)
	{
		$this->setAttributes($data);
		return $this->insert();
	}

	//获取权限
	public function Items_list()
	{
		$sql = 'select * from  `auth_item` where `type`=2 ';
		return \yii::$app->db->createCommand($sql)->queryAll();//执行
	}

	// 给角色分配权限
	public function Item_child($rule, $items)
	{
		$sql = "insert into `auth_item_child` (`parent`,`child`) VALUE ('$rule','$items')";
		return \yii::$app->db->createCommand($sql)->query();//执行
	}
}
