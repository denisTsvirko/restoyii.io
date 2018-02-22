<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

use app\components\FBFWidget;

$this->title = 'Contact';
$this->registerJsFile('@web/js/phone.js', ['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile('@web/js/contacts.js', ['depends' => 'yii\web\YiiAsset']);
$this->registerCssFile('@web/css/phone.css');
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
<a href="#" id="popup_toggle" data-toggle='modal' data-target='#myModal'>
    <div class="circlephone" style="transform-origin: center;"></div>
    <div class="circle-fill" style="transform-origin: center;"></div>
    <div class="img-circle" style="transform-origin: center;">
        <div class="img-circleblock" style="transform-origin: center;"></div>
    </div>
</a>

<?= FBFWidget::widget([]) ?>

<div class="container bloc_rest_info">
    <div class="row text_center">
        <div class="span6 container_rest">
            <h1>New York Restaurant</h1>
            <img src="../images/usa.jpg">
            <div class="add_res">
                Address: 3926 Anmoore Road. New York, NY 10014
            </div>
            <div class="tel_res">
                Phone: +1 212-620-0393
            </div>
        </div>
        <div class="span6 container_rest">
            <h1>France Restaurant</h1>
            <img src="../images/france.jpg">
            <div class="add_res">
                Address: 68, rue de la Couronne. 75002 PARIS
            </div>
            <div class="tel_res">
                Phone: +33 3 89 08 80 66
            </div>
        </div>

    </div>
</div>

<div class="show_map">
    <a href="" class="spoiler_links button_map">show map</a>
    <div class="spoiler_body">

        <div class="container">
            <div class="row ">
                <div class="span12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12093.341655816459!2d-74.01127367200655!3d40.73264448134541!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x12c76f5dfe3346f!2sThe+Spotted+Pig!5e0!3m2!1sru!2sru!4v1501657965281"
                            width="100%" height="650" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>