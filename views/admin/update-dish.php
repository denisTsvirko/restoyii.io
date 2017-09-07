<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Collapse;
use yii\bootstrap\Modal;

$this->title = 'Update-dish';
?>



    <div class="form_center row">
        <h1>Redaction - Dish</h1>
        <?php $upd=ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
            ],
        ])?>
        <?= $upd->field($update, 'name')->input('text', ['disabled'=>true ])?>
        <?= $upd->field($update, 'cost')->input('number',['min'=>0.01,'step'=>0.01,'max'=>250])?>
        <?= $upd->field($update, 'info')->textarea(['rows' => 5, 'class'=>'resize_col form-control','placeholder'=>'Composition','maxlength'=>150]) ?>


        <div class=" width_inp">
            <?= $upd->field($update, 'type')->dropDownList($type,['class'=>'form-control', 'style'=>'width: 120px;'])?>
            <?= $upd->field($update, 'position')->dropDownList($position,['class'=>'form-control', 'style'=>'width: 120px;'])?>
        </div>
        <?= $upd->field($update, 'img')->input('file',['class' => 'button_form','accept'=>'.jpg, .png, .gif'])->label('Front image(new)')?>
        <?= Html::submitButton('Add', ['class' => ' button_form']) ?><?= Html::a('Back',['/dishes'],['class'=>'button_form'])?>
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