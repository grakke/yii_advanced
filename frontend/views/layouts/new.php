<?php

use yii\helpers\Html;

/* @var $this yiiwebView */
/* @var $content string 字符串 */
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8"/>
		<?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
    </head>
    <body>
	<?php $this->beginBody() ?>
    <header>My Company</header>
	<?= $content ?>
    <footer>&copy; 2014 by My Company</footer>
	<?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>