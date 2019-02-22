<?php
/**
 * Created by PhpStorm.
 * User: jinlei
 * Date: 2017/2/16
 * Time: 10:06
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
    'action'=>'?r=rbac/power',
    'method'=>'post',
]) ?>
    <?= $form->field($model, 'power') ?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('添加权限', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
