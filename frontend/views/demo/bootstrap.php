<?php

use yii\bootstrap4\Progress;
use yii\bootstrap4\Button;
use yii\bootstrap4\ButtonGroup;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Html;

?>

<?= Progress::widget(['percent' => 60, 'label' => 'test']) ?>

    <hr>


<?= Button::widget([
    'label' => 'Action',
    'options' => ['class' => 'btn-primary'], // produces class "btn btn-primary"
]);

?>

    <hr>

<?= ButtonGroup::widget([
    'options' => [
        'class' => ['widget' => 'btn-group-vertical'] // replaces 'btn-group' with 'btn-group-vertical'
    ],
    'buttons' => [
        ['label' => 'A'],
        ['label' => 'B'],
    ]
]);
?>

<hr>

<?php

Navbar::begin([
    'options' => [
        'class' => ['navbar-dark', 'bg-dark', 'navbar-expand-md']
    ]
]);
Navbar::end();
?>


<hr>

<?php

Navbar::begin([
	'brandOptions' => [
		'class' => ['order-1', 'bg-yellow']
	],
	'togglerOptions' => [
		'class' => ['order-0',  'bg-red']
	]
]);
Navbar::end();
?>

<hr>

<?=
Button::widget([
    'label' => Html::icon('approve') . Html::encode('Save & apply'),
    'encodeLabel' => false,
    'options' => ['class' => 'btn-primary'],
]); ?>