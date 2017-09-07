<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Collapse;
use yii\bootstrap\Modal;

$this->title = 'Dishes';
?>
<h1>Dishes</h1>
<section id="eventsAdmin">
    <div class="row">
        <div class="table">
            <?php Pjax::begin()?>
            <?php
            echo GridView::widget([
                'dataProvider' => $dishes,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'img:image',
                    'name',
                    'cost',
                    'info',
                    'type',
                    'numvote',
                    'raiting',
                    'position',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['width' => '25'],
                        'template' => '{menu}{update}{delete}',
                        'buttons'=>[
                            'menu'=>function ($url, $dishes) {
                                $customurl=Yii::$app->getUrlManager()->createUrl(['/add-menu','id'=>$dishes['id']]);
                                return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-menu-hamburger"></span>', $customurl,
                                    ['title' => Yii::t('yii', 'Menu'), 'data-pjax' => '0']);
                            },
                            'delete'=>function ($url, $dishes) {
                                $customurl=Yii::$app->getUrlManager()->createUrl(['/delete-dish','id'=>$dishes['id']]);
                                return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $customurl,
                                    ['title' => Yii::t('yii', 'Delete'), 'data-pjax' => '0']);
                            },
                            'update'=>function ($url, $dishes) {
                                $customurl=Yii::$app->getUrlManager()->createUrl(['/update-dish','id'=>$dishes['id']]);
                                return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', $customurl,
                                    ['title' => Yii::t('yii', 'Update'), 'data-pjax' => '0']);
                            }
                        ],
                    ],

                ],
            ]);

            ?>
            <?php Pjax::end() ?>


        </div>

        <?php
        Modal::begin([
            'header' => '<h2>Add NEW Dish</h2>',
            'toggleButton' => [
                'tag' => 'button',
                'class' => 'btn btn-lg btn-block btn-info',
                'label' => 'Add NEW Dish',

            ]
        ]);?>
        <div class="form_center row">
            <?php $add=ActiveForm::begin([
                'options' => [
                    'enctype' => 'multipart/form-data',
                ],
            ])?>
            <?= $add->field($addForm, 'name')->input('text', ['placeholder'=>'Title', 'maxlength'=>'45' ])?>
            <?= $add->field($addForm, 'cost')->input('number',['min'=>0.01,'step'=>0.01,'max'=>250])?>
            <?= $add->field($addForm, 'info')->textarea(['rows' => 5, 'class'=>'resize_col form-control','placeholder'=>'Composition','maxlength'=>150]) ?>


            <div class=" width_inp">
            <?= $add->field($addForm, 'type')->dropDownList($type,['class'=>'form-control', 'style'=>'width: 120px;'])?>
            <?= $add->field($addForm, 'position')->dropDownList($position,['class'=>'form-control', 'style'=>'width: 120px;'])?>
            </div>
            <?= $add->field($addForm, 'img')->input('file',['class' => 'button_form','accept'=>'.jpg, .png, .gif'])->label('Front image')?>
            <?= Html::submitButton('Add', ['class' => ' button_form']) ?>
            <?php ActiveForm::end()?>
        </div>

        <?php Modal::end();?>




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
</section>