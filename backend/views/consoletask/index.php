<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConsoleTaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Console Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="console-task-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Console Task', ['create'], ['class' => 'btn btn-success']) ?>
	</p>
	<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					'id',
					'name',
					'program',
					'created_at',
					'created_by',
				// 'updated_at',
				// 'updated_by',
				// 'type',
				// 'start_time:datetime',
				// 'info',
				// 'status',
				// 'last_start_time:datetime',
				// 'last_finish_time:datetime',

					['class' => 'yii\grid\ActionColumn'],
			],
	]); ?>
</div>
