<?php


use \yii\helpers\Html;

echo Html::tag('p', Html::encode('Henry &nbsp; Lee'), ['class' => 'username']);

# css
echo Html::BeginTag('div', ['style' => ['height' => '50px']]);
$options = ['class' => 'btn btn-default'];
$type = 'success';
if ($type === 'success') {
	Html::removeCssClass($options, 'btn-default');
	Html::addCssClass($options, 'btn-success');
}
echo Html::tag('div', 'Pwede na', $options);
Html::addCssClass($options, ['btn-danger', 'btn-lg']);
echo Html::tag('div', 'Save', $options);
echo Html::endTag('div');

# style
echo Html::BeginTag('div',  ['style' => ['height' => '50px']]);
$options = ['style' => ['width' => '100px', 'height' => '100px', 'background-color' => 'purple']];
// Html::addCssStyle($options, 'height:200px; position:absolute;');
Html::removeCssStyle($options, ['width', 'hright']);
echo Html::tag('div', 'Style', $options);
echo Html::endTag('div');

# encode decode
echo Html::BeginTag('div',['style' => ['height' => '50px']]);
$content = Html::encode('上海女记者合唱团祝记   者朋友们记者节快乐');
echo $content;
$decode = Html::decode($content);
echo $decode;
echo Html::endTag('div');

# form

echo Html::BeginTag('div',['style' => ['height' => '500px']]);
echo Html::beginForm(['order/update', 'id' => 10], 'post', ['enctype' => 'multipart/form-data']);

# input
echo Html::BeginTag('div');
echo Html::input('text', 'username', 'Bluebird89', ['class' => 'username']);
echo Html::activeInput('text', new \frontend\models\User(), 'firstName', ['class' => 'username']);
echo Html::getInputName(new \frontend\models\User(), 'name');

echo Html::getAttributeValue(new \frontend\models\User(), 'name');
echo Html::endTag('div');

# radio
echo Html::BeginTag('div');
echo Html::radio('agree', true,  ['label' => 'I  agree']);
echo Html::activeRadio(new \frontend\models\User(), 'username', ['class' => 'agreement']);
echo Html::endTag('div');

# checkbox
echo Html::BeginTag('div');
echo Html::checkbox('agree', true,  ['label' => 'I  agree']);
echo Html::activeCheckbox(new \frontend\models\User(), 'username', ['class' => 'agreement']);
echo Html::endTag('div');

# dropdwonlist
echo Html::BeginTag('div');
echo Html::dropDownList('list', 2,  ['label' => 'I  agree']);
echo Html::activedropDownList(new \frontend\models\User(), 'id', ['class' => 'agreement']);
echo Html::endTag('div');

# listbox
echo Html::BeginTag('div');
echo Html::listBox('agree', true,  ['label' => 'I  agree']);
echo Html::activeListBox(new \frontend\models\User(), 'username', ['class' => 'agreement']);
echo Html::endTag('div');


echo Html::label('User name', 'username', ['class' => 'label username']);
echo Html::activelabel(new \frontend\models\User(), 'firstName', ['class' => 'label username']);

# button
# active:依据指定模型与属性获取数据
echo Html::BeginTag('div');
echo Html::button('Press me!', ['class' => 'teaser']);
echo Html::button('Submit', ['class' => 'submit']);
echo Html::button('Reset', ['class' => 'reset']);
echo Html::endTag('div');

echo Html::endForm();
echo Html::endTag('div');

# add style
echo Html::style('.danger {color: #f00; background-color: yellow;}');
?>
<p class="danger">Gives you</p>

<!-- add script -->
<?= Html::script('alert("Hello!");', ['defer' => true]) ?>
<!-- <script defer> alert('Hello!')</script> -->

<?= Html::cssFile('@web/css/site.css', ['condition' => 'IE5']) ?>
<?= Html::cssFile('@web/css/site.css') ?>

<!-- [if IE 5] -->
<!-- <link rel="stylesheet" type="text/css" href="css/site.css"> -->
<!-- ![endif] -->
<?= Html::jsFile('@web/js/jquery.cookie.js') ?>

<?= Html::a('Profile-Link', ['user/view', 'id' => 1], ['class' => 'profile-link']); ?>

<?= Html::img('@web/images/logo.jpg', ['alt' => 'My logo', 'style' => ['width'=> '60%', 'height' => '60%']]); ?>

<?= Html::ul($posts, ['item' => function($item, $index) {
	return Html::tag('li', $this->render('_post', ['item' =>$item ]), ['class' => 'post']);
}]) ?>