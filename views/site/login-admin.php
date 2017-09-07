<?php

/* @var $this yii\web\View */


use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'LoginUser';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php //$this->registerJsFile('@web/js/scripts.js')
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
            <?php $aut=ActiveForm::begin()?>
                <?= $aut->field($adminForm, 'name')->input('text', ['class' => 'span4', 'placeholder'=>'Name', 'maxlength'=>'45' ])?>
                <?= $aut->field($adminForm, 'password')->input('password',['class' => 'span4', 'placeholder'=>'Password', 'maxlength'=>'11'])?>
                <?= Html::submitButton('Login', ['class' => 'spoiler_links button_map']) ?>
            <?php ActiveForm::end()?>
    </div>

    <?php if(Yii::$app->session->hasFlash('success')):?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo Yii::$app->session->getFlash('success');?>
        </div>
    <?php endif; ?>

    <?php if(Yii::$app->session->hasFlash('error')):?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo Yii::$app->session->getFlash('error');?>
        </div>
    <?php endif; ?>
</div>


