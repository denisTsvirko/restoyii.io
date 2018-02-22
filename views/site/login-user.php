<?php

/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'LoginUser';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$css = <<<CSS
    li{
      line-height: 5 !important;
    }
CSS;
$this->registerCss($css);
?>

<div class="revie_cent">
    <div class="revie_left">
        <h1>Autorization</h1>
        <?php $aut = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
        ]) ?>
        <?= $aut->field($userForm, 'name')->input('text', ['class' => 'span4', 'placeholder' => 'Name', 'maxlength' => '45']) ?>
        <?= $aut->field($userForm, 'email')->input('text', ['class' => 'span4', 'placeholder' => 'E-mail', 'maxlength' => '45']) ?>
        <?= $aut->field($userForm, 'path')->input('file', ['class' => 'span3  button_map', 'accept' => '.jpg, .png, .gif'])->label('Your avatar') ?>
        <?= Html::submitButton('Login', ['class' => 'spoiler_links button_map']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <?php echo Yii::$app->session->getFlash('success'); ?>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('error')): ?>
    <?php echo Yii::$app->session->getFlash('error'); ?>
<?php endif; ?>


