<?php
use yii\helpers\Html;
?>

<?php $form = \yii\widgets\ActiveForm::Begin(); ?>
    <?= $form->field($model, 'name')->label('姓名') ?>
    <?= $form->field($model, 'email') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php \yii\widgets\ActiveForm::end(); ?>
