<?php

/* @var $this yii\web\View */


$this->registerCssFile('@web/css/slider/demo.css');
$this->registerCssFile('@web/css/slider/flexslider.css');
$this->registerCssFile('@web/css/rating/jquery.rating.css');

$this->registerJsFile('@web/js/jquery.flexslider.js',['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile('@web/js/reting/jquery.rating-2.0.min.js',['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile('@web/js/main.js',['depends' => 'yii\web\YiiAsset']);

$this->registerJsFile('@web/js/slider/shCore.js',['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile('@web/js/slider/shBrushXml.js',['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile('@web/js/slider/shBrushJScript.js',['depends' => 'yii\web\YiiAsset']);

$this->registerJsFile('@web/js/slider/jquery.easing.js',['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile('@web/js/slider/jquery.mousewheel.js',['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile('@web/js/slider/demo.js',['depends' => 'yii\web\YiiAsset']);

$this->title = 'Resto';
?>
<?php //$this->registerJsFile('@web/js/scripts.js')
$css = <<<CSS
  .classli{
    line-height: 5;
  }
  li {
    line-height: 1;
  }
CSS;
$this->registerCss($css);
?>
<section id="themenu">
    <div id="flag_menu"><a id="flag_text" href="/menu">The Menu</a></div> <!--сделать ссылкой на страницу меню-->
    <div class="row">

        <div class="offset2 span4  left">
            <?php
            $k=0;
            for($k;$k<count($menu)/2;$k++){
            echo '<div class = "container_prise">
                <div class="container_prise_el">';
                    echo '<div class="name_eat">'.$menu[$k]->name.'</div>';
                    echo '<div class="dots"></div>';
                    echo '<div class="cost_eat">$'.$menu[$k]->cost.'</div>';
                    echo '</div>';
                echo '<div class="info_eat">'.$menu[$k]->info.'</div>';
                echo '</div>';
            }
            ?>

        </div>
        <div class="span4 offset2 right">
            <?php
                for($k;$k<count($menu);$k++){
                echo '<div class = "container_prise">
                    <div class="container_prise_el">';
                        echo '<div class="name_eat">'.$menu[$k]->name.'</div>';
                        echo '<div class="dots"></div>';
                        echo '<div class="cost_eat">$'.$menu[$k]->cost.'</div>';
                        echo '</div>';
                    echo '<div class="info_eat">'.$menu[$k]->info.'</div>';
                    echo '</div>';
                }
            ?>

        </div>

    </div>


</section>
<?php
    if(count($menu)>=8) {
        echo '<div class="conteiner_but">
            <button  id="button_style" style="margin-top: 50px;">
                <div class="mybutton">
                    load more
                    <div class="vert_line"></div>
                    <div class="gul"></div>
                </div>
            </button>
        </div>';
    }
?>




<div class="container_head_t">
    <h1>FEATURED DISHES</h1> <div class="big_line"></div>
</div>

<section class="slider">
    <div class="row">
        <div class="offset2 span10">
            <div class="flexslider carousel">
                <ul class="slides">
                    <?php
                        $i=0;

                        for ($i;$i<count($slider);$i++){
                            echo '<li>
                                      <div class="block_slider">';
                                            echo '<div class="img_slider">
                                                    <img src="'.$slider[$i]->img.'" />
                                                  </div>';
                                            echo '<div class="info_eat_slider">
                                                     <div class="name_el_slider">'.ucfirst(strtolower($slider[$i]->name)).'</div>
                                                     <div class="cost_slider">$'.$slider[$i]->cost.'</div>
                                                  </div>';
                                            echo '<div class="votest_slider">
                                                        <div class="border-wrap">
                                                            <div class="rating_2">
                                                                <input type="hidden" name="val" value="'.$slider[$i]->raiting.'"/>
                                                                <input type="hidden" name="votes" value="'.$slider[$i]->numvote.'"/>
                                                                <input type="hidden" name="vote-id" value="'.$slider[$i]->id.'"/>
                                                                <input type="hidden" name="cat_id" value="2"/>
                                                            </div>
                                                        </div>
                                                    </div>';
                            echo '    </div>
                                  </li>';
                        }
                    ?>

                </ul>
            </div>
        </div>
    </div>


</section>



<div class="container_head_t">
    <h1>THE GALLERY</h1> <div class="big_line"></div>
</div>

<section id="gallery" >
    <div class="row">
        <div class="offset2 span10">

            <div id="container_gallery">
                <div id="left_column">
                    <img  src="images/gallery/gallery1.png" >
                </div>
                <div id="right_column">
                    <div style="text-align: center;">
                        <img  src="images/gallery/gallery2.png" >
                        <img  src="images/gallery/gallery3.png" >
                    </div>
                    <div style="text-align: center;">
                        <img   src="images/gallery/gallery4.png" >
                        <img  src="images/gallery/gallery5.png" >
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php //$this->registerJsFile('@web/js/scripts.js')
$js = <<<JS
    $(function(){
           SyntaxHighlighter.all();
         });
         $(window).load(function(){
           $('.flexslider').flexslider({
             animation: "slide",
             animationLoop: false,
             itemWidth: 230,
             itemMargin: 70,
             pausePlay: true,
             start: function(slider){
               //$('body').removeClass('loading');
             }
           });
         });
JS;
$this->registerJs($js);
?>