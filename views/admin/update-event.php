<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Collapse;
use yii\bootstrap\Modal;

$this->title = 'Update-event';
?>


<div class="form_center row">
    <h1>Redaction - Event</h1>
                <?php $add=ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
])?>
<?= $add->field($update, 'title')->input('text', ['placeholder'=>'Title', 'maxlength'=>'45' ])?>
<?= $add->field($update, 'date')->input('date',['disabled'=>true])?>
<?= $add->field($update, 'descript')->textarea(['rows' => 5, 'class'=>'resize_col form-control']) ?>
<?= $add->field($update, 'midimg')->input('file',['class' => 'button_form','accept'=>'.jpg, .png, .gif'])->label('Front image(new img)')?>
<?= $add->field($update, 'manyimg[]')->input('file',['class' => '  button_form','accept'=>'.jpg, .png, .gif', 'multiple'=>true])->label('Event images(add img)')?>
<?= Html::submitButton('Update', ['class' => ' button_form']) ?> <?= Html::a('Back',['/event'],['class'=>'button_form'])?>
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


