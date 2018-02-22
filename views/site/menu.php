<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Menu';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 
$css = <<<CSS
    li{
      line-height: 5 !important;
    }
CSS;
$this->registerCss($css);
?>
<section id="menu">
    <div class="row">
        <div class="offset1 span11">

            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Monday</a></li>
                    <li><a href="#tab2" data-toggle="tab">Tuesday</a></li>
                    <li><a href="#tab3" data-toggle="tab">Wednesday</a></li>
                    <li><a href="#tab4" data-toggle="tab">Thursday</a></li>
                    <li><a href="#tab5" data-toggle="tab">Friday</a></li>
                    <li><a href="#tab6" data-toggle="tab">Saturday</a></li>
                    <li><a href="#tab7" data-toggle="tab">Sunday</a></li>
                </ul>
                <div class="tab-content" style="overflow:  hidden;">
                    <?php
                    for ($i = 0; $i < 7; $i++) {
                        if ($i == 0) {
                            echo '<div class="tab-pane active" id="tab1">';
                        } else {
                            echo '<div class="tab-pane " id="tab' . ($i + 1) . '">';
                        }

                        $dayMenu = [];

                        foreach ($dishMenu[$days[$i]] as $dish) {
                            $dayMenu[$dish["type"]][] = $dish;
                        }

                        echo '<div class="row">
                            <div class="span5 ">';
                        echo '<div class="page-header">
                                    <h1 class="midle_text_menu">STARTERS</h1>';
                        echo '</div>';
                        $k = 0;
                        
                        while (isset($dayMenu["STARTERS"][$k])) {
                            echo '<div class = "container_prise">
                                                    <div class="container_prise_el">';
                            echo '<div class="name_eat">' . $dayMenu["STARTERS"][$k]->name . '</div>';
                            echo '<div class="dots"></div>';
                            echo '<div class="cost_eat">$' . $dayMenu["STARTERS"][$k]->cost . '</div>';
                            echo '</div>';
                            echo '<div class="info_eat">' . $dayMenu["STARTERS"][$k]->info . '</div>';
                            echo '</div>';
                            $k++;
                        }

                        echo '</div>';

                        echo '<div class="span5 offset1">';
                        echo '<div class="page-header">
                                    <h1 class="midle_text_menu">MAINS</h1>
                                </div>';
                        $k = 0;
                        while (isset($dayMenu["MAINS"][$k])) {
                            echo '<div class = "container_prise">
                                            <div class="container_prise_el">';
                            echo '<div class="name_eat">' . $dayMenu["MAINS"][$k]->name . '</div>';
                            echo '<div class="dots"></div>';
                            echo '<div class="cost_eat">$' . $dayMenu["MAINS"][$k]->cost . '</div>';
                            echo '</div>';
                            echo '<div class="info_eat">' . $dayMenu["MAINS"][$k]->info . '</div>';
                            echo '</div>';
                            $k++;
                        }
                        echo '<div class="page-header">
                                    <h1 class="midle_text_menu">DESSERT</h1>
                                </div>';

                        $k = 0;
                        while (isset($dayMenu["DESSERT"][$k])) {
                            echo '<div class = "container_prise">
                                            <div class="container_prise_el">';
                            echo '<div class="name_eat">' . $dayMenu["DESSERT"][$k]->name . '</div>';
                            echo '<div class="dots"></div>';
                            echo '<div class="cost_eat">$' . $dayMenu["DESSERT"][$k]->cost . '</div>';
                            echo '</div>';
                            echo '<div class="info_eat">' . $dayMenu["DESSERT"][$k]->info . '</div>';
                            echo '</div>';
                            $k++;
                        }
                        echo '</div>';

                        echo '</div>'; 
                        echo '<div class="row">      <!--LUNCh-->
                            <div class="page-header">
                                <h1 class="big_text_menu">LUNCH</h1>
                            </div>';
                        echo '<div class="span5 "><!--left_col_start-->';
                        $k = 0;
                        if (isset($dayMenu["LUNCH"])) {
                            for ($k; $k < count($dayMenu["LUNCH"]) / 2; $k++) {
                                echo '<div class = "container_prise">
                                        <div class="container_prise_el">';
                                echo '<div class="name_eat">' . $dayMenu["LUNCH"][$k]->name . '</div>';
                                echo '<div class="dots"></div>';
                                echo '<div class="cost_eat">$' . $dayMenu["LUNCH"][$k]->cost . '</div>';
                                echo '</div>';
                                echo '<div class="info_eat">' . $dayMenu["LUNCH"][$k]->info . '</div>';
                                echo '</div>';
                            }
                        }
                        echo '</div><!--left_col_end-->';

                        echo '<div class="span5 offset1"><!--right_col_start-->';
                        if (isset($dayMenu["LUNCH"])) {
                            for ($k; $k < count($dayMenu["LUNCH"]); $k++) {
                                echo '<div class = "container_prise">
                                        <div class="container_prise_el">';
                                echo '<div class="name_eat">' . $dayMenu["LUNCH"][$k]->name . '</div>';
                                echo '<div class="dots"></div>';
                                echo '<div class="cost_eat">$' . $dayMenu["LUNCH"][$k]->cost . '</div>';
                                echo '</div>';
                                echo '<div class="info_eat">' . $dayMenu["LUNCH"][$k]->info . '</div>';
                                echo '</div>';
                            }
                        }
                        echo '</div><!--right_col_end-->';

                        echo '</div><!--end LUNCH-->';
                        echo '<div class="row">      <!--DINNER-->
                            <div class="page-header">
                                <h1 class="big_text_menu">DINNER</h1>
                            </div>';
                        echo '<div class="span5 "><!--left_col_start-->';
                        $k = 0;
                        if (isset($dayMenu["DINNER"])) {
                            for ($k; $k < count($dayMenu["DINNER"]) / 2; $k++) {
                                echo '<div class = "container_prise">
                                        <div class="container_prise_el">';
                                echo '<div class="name_eat">' . $dayMenu["DINNER"][$k]->name . '</div>';
                                echo '<div class="dots"></div>';
                                echo '<div class="cost_eat">$' . $dayMenu["DINNER"][$k]->cost . '</div>';
                                echo '</div>';
                                echo '<div class="info_eat">' . $dayMenu["DINNER"][$k]->info . '</div>';
                                echo '</div>';
                            }
                        }
                        echo '</div><!--left_col_end-->';
                        echo '<div class="span5 offset1"><!--right_col_start-->';
                        if (isset($dayMenu["DINNER"])) {
                            for ($k; $k < count($dayMenu["DINNER"]); $k++) {
                                echo '<div class = "container_prise">
                                        <div class="container_prise_el">';
                                echo '<div class="name_eat">' . $dayMenu["DINNER"][$k]->name . '</div>';
                                echo '<div class="dots"></div>';
                                echo '<div class="cost_eat">$' . $dayMenu["DINNER"][$k]->cost . '</div>';
                                echo '</div>';
                                echo '<div class="info_eat">' . $dayMenu["DINNER"][$k]->info . '</div>';
                                echo '</div>';
                            }
                        }
                        echo '</div><!--right_col_end-->';
                        echo '</div><!--end DINNER-->';
                        echo '<div class="row">      <!--DRINKS-->
                            <div class="page-header">
                                <h1 class="big_text_menu">DRINKS</h1>
                            </div>';
                        echo '<div class="span5 "><!--left_col_start-->';
                        echo '<div class = "container_prise">
                                    <div class="container_prise_el">
                                        <div class="dots"></div>
                                        <div class="cost_eat">Bottle</div>
                                    </div>
                                </div>';
                        $k = 0;
                        if (isset($dayMenu["DRINKS"])) {
                            for ($k; $k < count($dayMenu["DRINKS"]) / 2; $k++) {
                                echo '<div class = "container_prise">
                                        <div class="container_prise_el">';
                                echo '<div class="name_eat">' . $dayMenu["DRINKS"][$k]->name . '</div>';
                                echo '<div class="dots"></div>';
                                echo '<div class="cost_eat">$' . $dayMenu["DRINKS"][$k]->cost . '</div>';
                                echo '</div>';
                                echo '<div class="info_eat">' . $dayMenu["DRINKS"][$k]->info . '</div>';
                                echo '</div>';
                            }
                        }
                        echo '</div><!--left_col_end-->';
                        echo '<div class="span5 offset1"><!--right_col_start-->';
                        echo '<div class = "container_prise">
                                            <div class="container_prise_el">
                                                <div class="dots"></div>
                                                <div class="cost_eat">Bottle</div>
                                            </div>
                                        </div>';
                        if (isset($dayMenu["DRINKS"])) {
                            for ($k; $k < count($dayMenu["DRINKS"]); $k++) {
                                echo '<div class = "container_prise">
                                        <div class="container_prise_el">';
                                echo '<div class="name_eat">' . $dayMenu["DRINKS"][$k]->name . '</div>';
                                echo '<div class="dots"></div>';
                                echo '<div class="cost_eat">$' . $dayMenu["DRINKS"][$k]->cost . '</div>';
                                echo '</div>';
                                echo '<div class="info_eat">' . $dayMenu["DRINKS"][$k]->info . '</div>';
                                echo '</div>';
                            }
                        }
                        echo '</div><!--right_col_end-->';
                        echo '</div><!--end DRINKS-->';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>