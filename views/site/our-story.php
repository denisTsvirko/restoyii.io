<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Our Story';
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
    <div class="container ">
        <div class="row  ">
            <div class="span12">

                <div class="ourstr_rw">
                    <div class="ourstr_clm">
                        <h1 class="text_lvl_1">Passion and Quality</h1>
                        <h2 class="text_lvl_2">Everything we do is for the love of food.</h2>
                        <p class="text_lvl_3">NEA philosophies of making food differ from other restaurants. First we make food for the passion and quality, not for the money.
                            We practice a strict adherence to the old world methods handed down from our pizza making ancestors of early day Naples, Italy.
                            Our dough is Natural and not bleached like other flour: It is imported from Italy from the finest "origin" producing farms on Earth.
                            Our tomatoes are grown "Organically" in California from a seed in San Marzano, Italy.
                            Our cheese is handmade by master cheese artisans in California and the best money can buy.
                            Each dough ball is formed by hand only after 48 proprietary multi-stage proofing method and contains only purified water and Sea Salt.
                            Our Olive Oil is shipped directly from Napa Valley where it is first cold pressed for us.
                            Our oven is a very unique Stefano Ferrar masterpiece built in Naples, Italy and designed to operate at 900 degrees unlike any other.</p>
                    </div>

                    <img  src="../images/ourstory/bigimg.jpg">
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row row-flex">
            <div class="bootstrapclass span4  vcenter">
                <img  src="../images/ourstory/smollimg1.jpg">
            </div>
            <div class="span4 vcenter">
                <img  src="../images/ourstory/smollimg2.jpg">
            </div>
            <div class="span4 vcenter">
                <img  src="../images/ourstory/smollimg3.jpg">
            </div>
        </div>
    </div>

