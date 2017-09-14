<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
$this->title = 'Adminka';
?>

<section id="mainAdmin">
    <div class="row">
        <div class="offset1 span11">
            <div class="table">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Users</a></li>
                    <li ><a href="#tab2" data-toggle="tab">Comments</a></li>
                    <li ><a href="#tab3" data-toggle="tab">Reservations</a></li>
                </ul>
                <div class="tab-content" style="overflow:  hidden;">
                    <div class="tab-pane active" id="tab1">
                        <br>
                        <?php Pjax::begin()?>
                        <?php
                        echo GridView::widget([
                            'dataProvider' => $users,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'id',
                                'login',
                                'password',
                                'name',
                                'email',
                                'phone',
                                'img:image',
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'headerOptions' => ['width' => '25'],
                                    'template' => '{delete}',
                                    'buttons'=>[
                                        'delete'=>function ($url, $users) {
                                            $customurl=Yii::$app->getUrlManager()->createUrl(['/delete-user','id'=>$users['id']]);

                                            return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $customurl,
                                                ['title' => Yii::t('yii', 'Delete'),
                                                    'data-pjax' => '0',
                                                    'data-confirm' => Yii::t('yii', 'Are you sure want to delete USER: '.$users['name'].'?'),
                                                ]);
                                        }

                                    ],
                                ],
                            ],
                        ]);
                        
                        ?>
                        <?php Pjax::end() ?>
                        
                    </div>
                    <div class="tab-pane " id="tab2">
                        <br>
                        <?php Pjax::begin()?>
                        <?php
                        echo GridView::widget([
                            'dataProvider' => $comments,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'id',
                                'review',
                                'date',
                                'time',
                                'id_User',
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'headerOptions' => ['width' => '25'],
                                    'template' => '{delete}',
                                    'buttons'=>[
                                        'delete'=>function ($url, $comments) {
                                            $customurl=Yii::$app->getUrlManager()->createUrl(['/delete-comment','id'=>$comments['id']]);
                                            return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $customurl,
                                                ['title' => Yii::t('yii', 'Delete'),
                                                    'data-pjax' => '0',
                                                    'data-confirm' => Yii::t('yii', 'Are you sure want to delete COMMENT?'),
                                                ]);
                                        }
                                    ],
                                    
                                ],

                            ],
                        ]);

                        ?>
                        <?php Pjax::end() ?>
                    </div>
                    <div class="tab-pane " id="tab3">
                        <br>
                        <?php Pjax::begin()?>
                        <?php
                        echo GridView::widget([
                            'dataProvider' => $reservations,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'id',
                                'date',
                                'time',
                                'numguests',
                                'offers',
                                [
                                    'attribute'=>'User_name',
                                    'content'=>function($reservations){
                                        return $reservations->user->name;
                                    }
                                ],
                                [
                                    'attribute'=>'User_phone',
                                    'content'=>function($reservations){
                                        return $reservations->user->phone;
                                    }
                                ],
                                [
                                    'attribute'=>'Event',
                                    'content'=>function($reservations){
                                        return $reservations->evt->event;
                                    }
                                ],
                                [
                                    'attribute'=>'Table',
                                    'content'=>function($reservations){
                                        return $reservations->table->teble;
                                    }
                                ],
                                [
                                    'attribute'=>'Site',
                                    'content'=>function($reservations){
                                        return $reservations->table->site;
                                    }
                                ],
                                [
                                    'attribute'=>'Hall',
                                    'content'=>function($reservations){
                                        return $reservations->rm->hall;
                                    }
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'headerOptions' => ['width' => '25'],
                                    'template' => '{delete}',
                                    'buttons'=>[
                                        'delete'=>function ($url, $reservations) {
                                            $customurl=Yii::$app->getUrlManager()->createUrl(['/delete-reserv','id'=>$reservations['id']]);
                                            return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $customurl,
                                                ['title' => Yii::t('yii', 'Delete'),
                                                    'data-pjax' => '0',
                                                    'data-confirm' => Yii::t('yii', 'Are you sure want to delete RESERVE?'),
                                                ]);
                                        }
                                    ],

                                ],

                            ],
                        ]);

                        ?>
                        <?php Pjax::end() ?>

                        <h2>Pending payment</h2>

                        <?php Pjax::begin()?>
                        <?php
                        echo GridView::widget([
                            'dataProvider' => $payments,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'id',
                                'id_Reservation',
                                'date_start',
                                'date_end',
                                [
                                    'attribute'=>'Status',
                                    'content'=>function($payments){
                                        $date =  date("Y-m-d");
                                        if($payments['date_end']>=$date){
                                            return 'Pending payment';
                                        }
                                        return 'Payment is past due';

                                    }
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'headerOptions' => ['width' => '25'],
                                    'template' => '{paid}{delete}',
                                    'buttons'=>[
                                        'delete'=>function ($url, $payments) {
                                            $customurl=Yii::$app->getUrlManager()->createUrl(['/delete-paid','id'=>$payments['id']]);
                                            return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $customurl,
                                                ['title' => Yii::t('yii', 'Delete'),
                                                    'data-pjax' => '0',
                                                    'data-confirm' => Yii::t('yii', 'Are you sure want to delete RESERVE?'),
                                                ]);
                                        },
                                        'paid'=>function ($url, $dishes) {
                                            $customurl=Yii::$app->getUrlManager()->createUrl(['/add-paid','id'=>$dishes['id']]);
                                            return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-ok"></span>', $customurl,
                                                ['title' => Yii::t('yii', 'Paid'),
                                                    'data-pjax' => '0',
                                                    'data-confirm' => Yii::t('yii', 'You are sure that the table is paid?'),
                                                ]);
                                        },
                                    ],

                                ],

                            ],
                        ]);

                        ?>
                        <?php Pjax::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>