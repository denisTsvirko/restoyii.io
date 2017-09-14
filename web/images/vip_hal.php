<?php
/**
 * Created by PhpStorm.
 * User: alpo4ino
 * Date: 13.09.17
 * Time: 9:39
 */

    //Устанавливаем сообщения об ошибках
    ini_set("display_errors", "1");
    error_reporting(E_ALL);

    //Устанавливаем тип содержимого
    header('content-type: image/png');

    //Определяем размер изображения: 300x300 пикселей
    $image = imagecreate(300, 150);
    $mass=[1];

    //Определяем цвет фона – темно-серый
    $background = imagecolorallocate($image, 255, 219, 243);


    $black = imagecolorallocate($image, 0, 0, 0);
    $darkRed = imagecolorallocate($image, 140, 2, 23);
    $green = imagecolorallocate($image, 149, 160, 19);
    $silver = imagecolorallocate($image, 133, 137, 132);
    $orange = imagecolorallocate($image, 221, 135, 37);
    $white = imagecolorallocate($image, 255, 255, 255);

    drawWalls($image,$darkRed);
    if(count($mass)!=0) {
        createTable($image, $green);
        createSeats($image, $orange);
    }else{
        createTable($image, $silver);
        createSeats($image, $silver);
    }

    //Указываем путь к шрифту
    $font_path = '../fonts/aleo/aleo-bold_90e1aa58b8ee6fb4b81a0509d2b0251a.ttf';
    //Пишем текст
    $string = 'VIP';
    //Соединяем текст и картинку
    imagettftext($image, 8, 0, 145, 100, $white, $font_path, $string);

    imagepng($image);

    //Чистим память
    imagedestroy($image);

function drawWalls(&$image, $color){
    imagesetthickness ( $image ,  2 );
    imageline (  $image ,  299,  0 ,  299 ,  150 ,  $color ); //Правая стена
    imageline (  $image ,  0,  1 ,  299 ,  1 ,  $color ); //Верхняя стена

    imageline (  $image ,  1,  1 ,  1 ,  115 ,  $color ); //левая стена
    imageline (  $image ,  1,  135 ,  1 ,  149 ,  $color ); //левая стена

    imageline (  $image ,  1,  149 ,  40 ,  149 ,  $color ); //нижняя стена
    imageline (  $image ,  80,  149 ,  299 ,  149 ,  $color ); //нижняя стена

}

function createTable(&$image, $color){

    imagefilledrectangle($image, 50, 45, 250, 65, $color);
    imagefilledrectangle($image, 235, 65, 250, 85, $color);
    imagefilledrectangle($image, 50, 85, 250, 105, $color);

}

function createSeats(&$image, $color){

    $x1 = 60;
    $x2 = 70;

    $y1 = 30;
    $y2 = 40;

    for ($i=0;$i<15;$i++){
        imagefilledrectangle($image, $x1, $y1, $x2, $y2, $color);

        if($i<5) {
            $x1 += 33;
            $x2 += 33;
        }else {
            if (($i >= 5) && ($i <= 7)) {
                $x1 = 255;
                $x2 = 265;
                $y1 += 20;
                $y2 += 20;
            }else{
                if($i==8){
                    $x1 = 60;
                    $x2 = 70;
                    $y1 = 110;
                    $y2 = 120;
                }else{
                    $x1 += 33;
                    $x2 += 33;
                }
            }
        }



    }

}