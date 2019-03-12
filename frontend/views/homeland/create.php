<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Homeland */

$this->title = 'Create Homeland';
$this->params['breadcrumbs'][] = ['label' => 'Homelands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homeland-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
