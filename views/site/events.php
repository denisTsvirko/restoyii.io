<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Pjax;

$this->registerJsFile('@web/js/calendar/pickmeup.js', ['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile('@web/js/calendar/demo.js', ['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile('@web/js/events.js', ['depends' => 'yii\web\YiiAsset']);
$this->registerCssFile('@web/css/pickmeup.css');

$this->title = 'Events';
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
<section id="content_events">
    <div class="row">
        <div class="offset1 span11">
            <div class="container_event">
                <div class="item_event margin-left: 20px;">
                    <div class="single" id="my_date"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="concreat_event">
    <div class="row">
        <div class="offset1 span11 ">
            <div class="text_event">
            </div>
            <div class="container_event con_event">
            </div>
            <div class="show_map">
                <a href="#" id="back" class="spoiler_links button_map">Back</a>
            </div>
        </div>
    </div>
</section>