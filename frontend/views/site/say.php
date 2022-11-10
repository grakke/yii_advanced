<?php
use yii\helpers\Html;
use frontend\components\HelloWidget;
?>

<?= Html::encode($message) ?>
    <br>

<?= HelloWidget::widget(['message' => 'Good morning']) ?>
