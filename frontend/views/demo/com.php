<?php
use yii\jui\DatePicker;
use common\widgets\Alert;

echo DatePicker::widget([
    'language' => 'zh-CN',
    'name'  => 'country',
    'clientOptions' => [
        'dateFormat' => 'yy-mm-dd',
    ],
]);
//echo Alert::widget();
echo $foo;
echo $bar;


?>

<?= $this->render('_overview') ?>

The controller ID is: <?= $this->context->id ?>

<?= $this->params['breadcrumbs'][] = 'China'; ?>
<?= $this->params['breadcrumbs'][] = 'Shanghai'; ?>
