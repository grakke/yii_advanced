<?php
use yii\helpers\Html;
?>

<p>You have entered the following information</p>

<ul>
	<li><lable>Name</lable>: <?= Html::encode($model->name) ?></li>
	<li><lable>E-mail</lable>: <?= Html::encode($model->email) ?></li>
</ul>
