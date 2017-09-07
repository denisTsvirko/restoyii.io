<?php

/* @var $this \yii\web\View */
/* @var $content string */
use app\components\HeaderMenu;
use app\components\Footer;
use app\components\BigImg;


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<a href="#" class="scrollup">Наверх</a>

<div class="wrap">
    <?php echo HeaderMenu::widget(); ?>
    
</div>

<?php echo BigImg::widget(); ?>
<?= $content ?>

<footer class="footer">
    <?php echo Footer::widget(); ?>

</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>