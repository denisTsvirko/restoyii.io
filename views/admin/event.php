<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Collapse;
use yii\bootstrap\Modal;

$this->title = 'Events';
?>
<h1>Events</h1>
<section id="eventsAdmin">
    <div class="row">
            <div class="table">
                <?php Pjax::begin()?>
                <?php
                echo GridView::widget([
                    'dataProvider' => $lastevents,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
                        'date',
                        'title',
                        'midimg:image',
                        'descript',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['width' => '25'],
                            'template' => '{update}{delete}',
                            'buttons'=>[
                                'delete'=>function ($url, $lastevents) {
                                    $customurl=Yii::$app->getUrlManager()->createUrl(['/delete-event','id'=>$lastevents['id']]);
                                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $customurl,
                                        ['title' => Yii::t('yii', 'Delete'),
                                            'data-pjax' => '0',
                                            'data-confirm' => Yii::t('yii', 'Are you sure want to delete TITLE: '.$lastevents['title'].'?'),
                                        ]);
                                },
                                'update'=>function ($url, $lastevents) {
                                    $customurl=Yii::$app->getUrlManager()->createUrl(['/update-event','id'=>$lastevents['id']]);
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
            'header' => '<h2>Add NEW Event</h2>',
            'toggleButton' => [
                'tag' => 'button',
                'class' => 'btn btn-lg btn-block btn-info',
                'label' => 'Add NEW Event',

            ]
        ]);?>
            <div class="form_center row">
                <?php $add=ActiveForm::begin([
                    'options' => [
                        'enctype' => 'multipart/form-data',
                    ],
                ])?>
                    <?= $add->field($addForm, 'title')->input('text', ['placeholder'=>'Title', 'maxlength'=>'45' ])?>
                    <?= $add->field($addForm, 'date')->input('date',[])?>
                    <?= $add->field($addForm, 'descript')->textarea(['rows' => 5, 'class'=>'resize_col form-control']) ?>
                    <?= $add->field($addForm, 'midimg')->input('file',['class' => 'button_form','accept'=>'.jpg, .png, .gif'])->label('Front image')?>
                    <?= $add->field($addForm, 'manyimg[]')->input('file',['class' => '  button_form','accept'=>'.jpg, .png, .gif', 'multiple'=>true])->label('Event images')?>
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
    </div>
</section>