<?php
use yii\helpers\Html;
?>
<div id="header">
    <div id="header_logo">
        <img id="header_log" src="images/resto@3x.png" ><img id="header_dot" src="images/dot.png" >
    </div>
    <div id = "header_menu">
        <nav>
            <input type="checkbox" name="menu" id="btn-menu" />
            <label for="btn-menu">Menu</label>
            <ul class="classli">
                <li class="classli"><?= Html::a('Our Story',['our-story'])?></li>
                <li class="classli"><?= Html::a('Menu',['menu'])?></li>
                <li class="classli"><?= Html::a('Reservations',['reservations'])?></li>
                <li class="classli"><?= Html::a('Events',['events'])?></li>
                <li class="classli"><?= Html::a('Reviews',['reviews'])?></li>
                <li class="classli"><?= Html::a('Contact',['contact'])?></li>
            </ul>
        </nav>
    </div>
</div>