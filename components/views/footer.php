<?php
use yii\helpers\Html;
?>
<div id="footer">
    <div id="footer_container">
        <div class="footer_block">
            <p class="first_line_text">New York Restaurant</p>
            <p class="two_line_text">3926 Anmoore Road</p>
            <p class="two_line_text">New York, NY 10014</p>
            <p class="find_line_text">718-749-1714</p>
        </div>
        <div class="footer_block">
            <p class="first_line_text">France Restaurant</p>
            <p class="two_line_text">68, rue  de la Couronne</p>
            <p class="two_line_text">75002 PARIS</p>
            <p class="find_line_text">02.94.23.69.56</p>
        </div>
        <div class="footer_block_a ">
            <p class="first_line_text"><?= Html::a('Reviews',['reviews'])?></p>
            <p class="first_line_text"><?= Html::a('Contact',['contact'])?></p>
        </div>
        <div class="footer_block" style="padding-top: 15px;">
            <img id="footer_log" src="images/resto-logo.png" ><img id="footer_dot" src="images/dot.png" >
            <p class="two_line_text two_line_txt_l">©All Right Reserved 2017.</p>
        </div>
    </div>
</div>