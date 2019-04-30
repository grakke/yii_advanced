<?php

use \yii\bootstrap\ActiveForm;
use \yii\widgets\Menu;

//echo Menu::widget(['items' => $data]);

$form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => ['inputOptions' => ['class' => 'input-xlarger']],
]);

ActiveForm::end();
