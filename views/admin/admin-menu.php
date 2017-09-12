<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Collapse;
use yii\bootstrap\Modal;

$this->title = 'Menu';
?>

<h1>Menu</h1>
<div class="table">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">Monday</a></li>
        <li ><a href="#tab2" data-toggle="tab">Tuesday</a></li>
        <li ><a href="#tab3" data-toggle="tab">Wednesday</a></li>
        <li ><a href="#tab4" data-toggle="tab">Thursday</a></li>
        <li ><a href="#tab5" data-toggle="tab">Friday</a></li>
        <li ><a href="#tab6" data-toggle="tab">Saturday</a></li>
        <li ><a href="#tab7" data-toggle="tab">Sunday</a></li>
    </ul>
    <div class="tab-content" style="overflow:  hidden;">
        <?php
        //$days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
        for ($i=0;$i<7;$i++){
            if($i==0) {
                echo '<div class="tab-pane active" id="tab1">';
            }else{
                echo '<div class="tab-pane " id="tab' . ($i + 1) . '">';
            }
            Pjax::begin();

            echo GridView::widget([
                'dataProvider' => $dishMenu[$days[$i]],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',

                    [
                        'attribute'=>'Dish_name',
                        'content'=>function($dishMenu){
                            return $dishMenu->dish->name;
                        }
                    ],
                    [
                        'attribute'=>'Dish_cost',
                        'content'=>function($dishMenu){
                            return $dishMenu->dish->cost;
                        }
                    ],
                    [
                        'attribute'=>'Dish_cost',
                        'content'=>function($dishMenu){
                            return $dishMenu->dish->type;
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['width' => '25'],
                        'template' => '{delete}',
                        'buttons'=>[
                            'delete'=>function ($url, $users) {
                                $customurl=Yii::$app->getUrlManager()->createUrl(['/delete-menu','id'=>$users['id']]);
                                return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $customurl,
                                    ['title' => Yii::t('yii', 'Delete'),
                                        'data-pjax' => '0',
                                        'data-confirm' => Yii::t('yii', 'Are you sure want to delete DISH from the menu?'),
                                    ]);
                            }
                        ],
                    ],
                ],
            ]);

            Pjax::end();
            echo '</div>';
        }



        ?>

        <!--div class="tab-pane " id="tab1">

        </div-->
    </div>
</div>
