<?php

/* @var $this yii\web\View */

use app\models\Reviews;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\widgets\ListView;
$this->registerCssFile('@web/css/comments.css');
$this->title = 'Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php //$this->registerJsFile('@web/js/scripts.js')
$css = <<<CSS
    .classli{
      line-height: 5 !important;
    }
CSS;
$this->registerCss($css);
?>
<section id="reviews">
    <div class="row">
        <div class="offset2 span8 ">

            <div class="table">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Customer reviews</a></li>
                    <li ><a href="#tab2" data-toggle="tab">Write review</a></li>
                </ul>
                <div class="tab-content" style="overflow:  hidden;">
                    <div class="tab-pane active" id="tab1">
                        <div class="container">

                            <?php Pjax::begin([
                                'id' => 'list-messages',
//                                'timeout' => 3000,
//                                'enablePushState' => false,
//                                'linkSelector' => false,
                                'formSelector' => '.pjax-form'
                            ]) ?>
                            <?php
                                    // проходим цикл по данным модели, тут упрощённо, у вас может быть сложнее html-оформление
                                    /** @var Reviews $model */
                                    foreach ($models as $model) {
                                    // выводим название организации (прим
                                        echo  '<div class="row">
                                        <div class="span7">
                                            <div class="testimonial testimonial-default">';
                                                echo ' <div class="testimonial-section">';
                                                echo $model->review.'<br>';
                                                echo '</div>';
                                       echo '<div class="testimonial-desc">
                                                    <img src="' . $model->user->img . '" alt="" />
                                                    <div class="testimonial-you">
                                                        <div class="testimonial-you-name">'. $model->user->name .'</div>
                                                        <div class="testimonial-you-designation">'. $model->user->email .'</div>
                                                        <a href="" class="testimonial-you-company">'.date('H:i', strtotime($model->time)).', '.date('d.m.Y', strtotime($model->date)).'</a>
                                                    </div>
                                                </div>';
                                        echo  '</div>
                                            </div>
                                        </div>';
                                    }
                                echo LinkPager::widget([
                                    'pagination' => $pages,
                                    'registerLinkTags' => true,
                                ]);
                            ?>
                            <?php Pjax::end(); ?>

                            <?php $this->registerJs(<<<JS
function updateList() {
  $.pjax.reload({container: '#list-messages'});
}
setInterval(updateList, 1000);
JS
                            ) ?>


                            <div class="clearfix"></div>

                            <hr/>


                        </div><!-- /.container -->
                    </div>
                    <div class="tab-pane " id="tab2">
                        <?php if (Yii::$app->user->isGuest): ?>
                            <div class="revie_cent">
                            <label class="info_auto">In order to leave a review, please login.</label>
                            <a href="/login-user" class="spoiler_links button_map marg_r">Autorization</a>
                            </div>
                        <?php else: ?>

                            <div class="user">
                                <div class="testimonial-desc">
                                    <img src="<?php echo Yii::$app->user->identity->img?>" alt="" />
                                    <div class="testimonial-you">
                                        <div class="testimonial-you-name"><?php echo Yii::$app->user->identity->name?></div>
                                        <div class="testimonial-you-designation"><?php echo Yii::$app->user->identity->email?></div>
                                        <?php echo Html::beginForm(['site/logout'], 'post')
                                            . Html::submitButton(
                                                'Logout',
                                                ['class' => 'spoiler_links button_map marg_r']
                                            )
                                            . Html::endForm() ?>
                                    </div>

                                </div>
                            </div>
                            <?php Pjax::begin([

                                'enablePushState' => false,
                                'formSelector' => false,
                                'linkSelector' => false
                            ]) ?>

                                <?php $form = ActiveForm::begin(['options' => ['class' => 'pjax-form']])?>
                                <?= $form->field($review, 'review')->textarea(['rows' => 4,'class' =>'span8 marg_col', 'maxlength'=>250])->label('Your comment about the restaurant.') ?>
                                <?= Html::submitButton('Add review', ['class' => 'spoiler_links button_map']) ?>
                                <?php ActiveForm::end() ?>

                            <?php Pjax::end() ?>

                        <?php endif; ?>



                    </div>
                </div>
            </div>

        </div>
    </div>
</section>