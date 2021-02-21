<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ConsoleTask */

$this->title = 'Create Console Task';
$this->params['breadcrumbs'][] = ['label' => 'Console Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="console-task-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
			'model' => $model,
	]) ?>

</div>
