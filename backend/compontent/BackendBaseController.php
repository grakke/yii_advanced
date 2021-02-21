<?php

namespace backend\component;

use Yii;
use common\component\BaseController;

class backendBaseController extends baseController
{
	public $layout = "/content";
	public $enableCsrfValidation = false;

	public static $profiling = 0;

	public function init()
	{
		parent::init();

		self::$profiling = 1;// !(mt_rand() % 9);
		if (self::$profiling) {
			xhprof_enable(XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY);
		}
	}

	public function __destruct()
	{
		if (self::$profiling) {
			$data = xhprof_disable();
			//$_SERVER['XHPROF_ROOT_PATH'] 该环境变量由第3步得来
			include_once $_SERVER['XHPROF_ROOT_PATH']."/xhprof_lib/utils/xhprof_lib.php";
			include_once $_SERVER['XHPROF_ROOT_PATH']."/xhprof_lib/utils/xhprof_runs.php";
			$x = new XHProfRuns_Default();

			//当前路由
			$routeName = Yii::$app->requestedRoute;
			//路由为空，则说明是首页
			if (empty($routeName)) {
				$routeName = Yii::$app->defaultRoute;
			}

			//拼接xhprof分析结果保存文件名
			$xhprofFilename = str_replace('/', '_', $routeName).'_'.date('Ymd_His');
			$x->save_run($data, $xhprofFilename);
		}
	}
}
