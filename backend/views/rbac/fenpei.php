<?php
/**
 * Created by PhpStorm.
 * User: jinlei
 * Date: 2017/2/16
 * Time: 14:05
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
		'id' => 'login-form',
		'options' => ['class' => 'form-horizontal'],
		'action' => '?r=rbac/ur',
		'method' => 'post',
]) ?>
<?= $form->field($model, 'user')->checkboxList($user) ?>
<?= $form->field($model, 'role')->checkboxList($role) ?>

<div class="form-group">
	<div class="col-lg-offset-1 col-lg-11">
		<?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
	</div>
</div>
<?php ActiveForm::end() ?>
