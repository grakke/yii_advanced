<?php

namespace backend\controllers;

use backend\models\Rbac;
use yii\web\Controller;
use yii;
use backend\models\AuthItem;

class RbacController extends Controller
{

	public function init()
	{
		$this->enableCsrfValidation = false;
		$session = \yii::$app->session;
		$session->open();
	}

	//在控制器中写一个actionpower 跳到我们添加权限的表单页面
	public function actionIndex()
	{
		$model = new Rbac();
		return $this->render('index', ['model' => $model]);
	}

	//然后在控制器里把权限入库
	public function actionPower()
	{
		$item = \Yii::$app->request->post('Rbac')['power'];
		$auth = Yii::$app->authManager;
		$createPost = $auth->createPermission($item);
		$createPost->description = '创建了 '.$item.' 权限';
		$auth->add($createPost);
		return $this->redirect('?r=rbac/role');
	}

	//创建一个就角色的表单
	public function actionRole()
	{
		$model = new Rbac();
		return $this->render('role', ['model' => $model]);
	}

	//添加角色入库
	public function actionAddrole()
	{
		$item = \Yii::$app->request->post('Rbac')['role'];
		$auth = Yii::$app->authManager;
		$role = $auth->createRole($item);
		$role->description = '创建了 '.$item.' 角色';
		$auth->add($role);

		return $this->redirect('?r=rbac/rp');
	}

	//然后给角色分配权限
	public function actionRp()
	{
		$model = new Rbac();
		$role = AuthItem::find()->where('type=1')->asArray()->all();
		foreach ($role as $value) {
			$roles[$value['name']] = $value['name'];
		}
		$power = AuthItem::find()->where('type=2')->asArray()->all();
		foreach ($power as $value) {
			$powers[$value['name']] = $value['name'];
		}

		return $this->render('rp', ['model' => $model, 'role' => $roles, 'power' => $powers]);
	}

	//然后入库
	public function actionEmpowerment()
	{
		$auth = Yii::$app->authManager;
		$data = \Yii::$app->request->post('Rbac');
		$role = $data['role'];
		$power = $data['power'];

		foreach ($role as $value) {
			foreach ($power as $v) {
				$parent = $auth->createRole($value);

				$child = $auth->createPermission($v);
				//var_dump($child);
				$auth->addChild($parent, $child);
			}
		}
		return $this->redirect('?r=rbac/fenpei');
	}

	//然后给用户分配角色
	public function actionFenpei()
	{
		$models = new Rbac();
		$sql = 'select name from auth_item where type=1';
		$role = \Yii::$app->db->createCommand($sql)->queryAll();
		foreach ($role as $v) {
			$roles[$v['name']] = $v['name'];
		}
		$sql1 = 'select id,username from user';
		//  print_r($sql1);die;

		$power = \Yii::$app->db->createCommand($sql1)->queryAll();

		foreach ($power as $vv) {
			$user[$vv['id']] = $vv['username'];
		}
		return $this->render('fenpei', ['role' => $roles, 'user' => $user, 'model' => $models]);
	}

	//将给用户分配的角色入库
	public function actionEmpower()
	{
		$items = Yii::$app->request->post();

		$role = $items['Rbac']['role'];
		foreach ($items['Rbac']['role'] as $value) {
			$auth = Yii::$app->authManager;

			$parent = $auth->createRole($role);
			$child = $auth->createPermission($value);
			$auth->addChild($parent, $child);
		}
		return $this->redirect('fenpei');
	}

	public function actionUr()
	{
		$auth = Yii::$app->authManager;
		$data = \Yii::$app->request->post('Rbac');
		//print_r($data);die;
		$role = $data['role'];
		$power = $data['user'];

		foreach ($role as $key => $val) {
			foreach ($power as $v) {
				$reader = $auth->createRole($val);
				$auth->assign($reader, $v);
			}
		}
	}

	//写到你其他的控制器就可以了
	//你给登陆是把用户id存进session就行了
	//  $session = yii::$app->session;
	//    $session->set('id',$db[0]['id']);
	//   $session->set('username',$db[0]['username']);
	/* public function beforeAction($action)
	 {
		 $sql="select user_id,child from auth_assignment join auth_item_child on auth_assignment.item_name=auth_item_child.parent where user_id='".$_SESSION['id']."'";
		 $role =\Yii::$app->db->createCommand($sql)->queryAll();
		 $arr=array_column($role,'child');
		 $action=$_REQUEST['r'];
		 if(in_array($action, $arr)){
			 return true;
		 }else{
			 throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获此操作的权限');
		 }
	 }*/
}
