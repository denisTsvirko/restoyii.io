<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Collapse;
use yii\bootstrap\Modal;

$this->title = 'add-dish-menu';
?>



    <div class="form_center row">
        <h1>Add - Dish - Menu</h1>
        <?php $upd=ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
            ],
        ])?>
            <?= $upd->field($update, 'day')->dropDownList($massDay,['class'=>'form-control'])?>
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