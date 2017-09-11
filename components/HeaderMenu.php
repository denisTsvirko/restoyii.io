<?php

/**
 * Created by PhpStorm.
 * User: Alpo4
 * Date: 16.08.2017
 * Time: 11:14
 */
namespace app\components;
use yii\base\Widget;

class HeaderMenu extends Widget{

    public function run(){
        return $this->render('header');
    }
}