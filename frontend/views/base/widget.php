<?php

use yii\widgets\Menu;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

echo Menu::widget(['items' => $models]);

$form = ActiveForm::begin([
	'options' => ['class' => 'form-horizontal'],
	'fieldConfig' => ['inputOptions' => ['class' => 'input-xlarge']],
]);

echo Html::BeginTag('div');
echo Html::input('text', 'username', 'Bluebird89', ['class' => 'username']);
echo Html::activeInput('text', new \frontend\models\User(), 'firstName', ['class' => 'username']);
echo Html::endTag('div');

ActiveForm::end();