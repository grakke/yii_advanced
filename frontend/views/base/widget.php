<?php

use yii\widgets\Menu;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

// echo Menu::widget(['item' => $model]);

$form = ActiveForm::begin([
	'options' => ['class' => 'form-horizontal'],
	'fieldConfig' => ['inputOptions' => ['class' => 'input-xlarge']],
]);

echo $form->field($model, 'code');
echo $form->field($model, 'name');
echo $form->field($model, 'population');
?>
<div class="form-group">
	<?= Html::submitButton('Save') ?>
</div>


<?php ActiveForm::end(); ?>