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
              
              $mass=[1,2,3,4,6,9,10,11];
           
              //Устанавливаем тип содержимого
              header('content-type: image/png');
            
              //Определяем размер изображения: 300x300 пикселей
              $image = imagecreate(300, 150);
            
              //Определяем цвет фона – темно-серый
              $background = imagecolorallocate($image, 255, 219, 243);
            
            
              $black = imagecolorallocate($image, 0, 0, 0);
              $darkRed = imagecolorallocate($image, 140, 2, 23);
              $green = imagecolorallocate($image, 149, 160, 19);
              $silver = imagecolorallocate($image, 133, 137, 132);
              $orange = imagecolorallocate($image, 221, 135, 37);
            
              otherFurniture($image, $orange);
              drawWalls($image, $darkRed);
            
                $num=0;
              // первый ряд столов
                $tmpX1=22;
                $tmpX2=38;
                for($i=0;$i<5;$i++){
                    $num++;

                      if(checkMass($mass,$num)) {
                          createTable($image, $silver, $silver, $tmpX1, 5, $tmpX2, 30, 4);
                      }else{
                          createTable($image, $green, $orange, $tmpX1, 5, $tmpX2, 30, 4);
                      }
                    $tmpX1+= 40;
                    $tmpX2+=40;
                }
            
                //2 ряд
            
                $tmpX1=103;
                $tmpX2=118;
                for($i=0;$i<2;$i++){
                    $num++;
                      if(checkMass($mass,$num)) {
                          createTable($image, $silver, $silver, $tmpX1, 45, $tmpX2, 60, 2);
                      }else{
                          createTable($image, $green, $orange, $tmpX1, 45, $tmpX2, 60, 2);
                      }
                    $tmpX1+= 80;
                    $tmpX2+=80;
                }
            
                //3 ряд
                $tmpX1=180;
                $tmpX2=195;
                for($i=0;$i<2;$i++){
                    $num++;
                      if(checkMass($mass,$num)) {
                          createTable($image, $silver, $silver, $tmpX1, 102, $tmpX2, 117, 2);
                      }else{
                          createTable($image, $green, $orange, $tmpX1, 102, $tmpX2, 117, 2);
                      }
                    $tmpX1+= 40;
                    $tmpX2+=40;
                }
            
                //4 ряд
                $tmpX1=180;
                $tmpX2=195;
                for($i=0;$i<2;$i++){
                     $num++;
                      if(checkMass($mass,$num)) {
                          createTable($image, $silver, $silver, $tmpX1, 130, $tmpX2, 145, 2);
                      }else{
                          createTable($image, $green, $orange, $tmpX1, 130, $tmpX2, 145, 2);
                      }
                    $tmpX1+= 40;
                    $tmpX2+=40;
                }
            
            
                writeText($image, $black);
            
              imagepng($image);
            
              //Чистим память
              imagedestroy($image);
              
              function checkMass($mass,$num){
                  for ($j = 0; $j < count($mass); $j++) {
                      if($num==$mass[$j]){
                          return false;

                      }
                  }
                  return true;
              }
            
              function drawWalls(&$image, $color){
                  imagesetthickness ( $image ,  2 );
                  imageline (  $image ,  299,  0 ,  299 ,  150 ,  $color ); //Правая стена
                  imageline (  $image ,  0,  149 ,  299 ,  149 ,  $color ); //нижняя стена
            
                  $y1 =0;
                  $y2 = 149;
                  imageline (  $image ,  1,  $y1 ,  1 ,  ($y2/2)-10 ,  $color ); //левая стена
                  imageline (  $image ,  1,  ($y2/2)+10 ,  1 ,  $y2 ,  $color ); //левая стена
            
            
                  imageline (  $image ,  1,  ($y2/2)-10 ,  299/5 ,  ($y2/2)-10 ,  $color ); //верхняя стена лестницы
                  imageline (  $image ,  299/5,  ($y2/2)-10 ,  299/5 ,  ($y2/2)+10 ,  $color ); // правая стена лестницы
                  imageline (  $image ,  1,  ($y2/2)+10 ,  299/5 ,  ($y2/2)+10 ,  $color ); //нижняя стена лестницы
            
            
                  $tmpX=5;
                  imagesetthickness ( $image ,  1 );
                  for($i=0;$i<=10;$i++){      //ступеньки
                      imageline (  $image , $tmpX  ,  ($y2/2)-10 ,  $tmpX ,  ($y2/2)+10 ,  $color ); // ступенька
                      $tmpX+=5;
                  }
            
            
                  imagesetthickness ( $image ,  2 );    //верхняя стена
                  imageline ( $image,1,1,20,1, $color );
            
                  $tmpX = 40;
                  for ($i=0;$i<4;$i++){
                      imageline ( $image, $tmpX,1,$tmpX+20,1, $color );
                      $tmpX+=40;
                  }
                  imageline ( $image, $tmpX,1,$tmpX+60,1, $color );
                  imageline ( $image,289,1,299,1, $color );//-------------
            
            
                  //внутренние линии
            
                  imageline (  $image ,  85,  ($y2/2)-10 ,  140 ,  ($y2/2)-10 ,  $color );
                  imageline (  $image ,  170,  ($y2/2)-10 ,  250 ,  ($y2/2)-10 ,  $color );
            
                  imageline (  $image ,  220,  2 ,  220 ,  ($y2/2)-10 ,  $color );
                  imageline (  $image ,  250,  2 ,  250 ,  ($y2/2)-10 ,  $color );
            
                  //туалет
                  imageline (  $image ,  285,  ($y2/2)+25 ,  299 ,  ($y2/2)+25 ,  $color );
                  imageline (  $image ,  180,  ($y2/2)+25 ,  269 ,  ($y2/2)+25 ,  $color );
            
                  imagesetthickness ( $image ,  4 );
                  imageline (  $image ,  250,  100 ,  250 ,  149 ,  $color );
            
              }
            
              function otherFurniture(&$image,$color){
            
                  imagefilledrectangle($image, 221, 2, 248, 62, $color);        //гардероб
                  imagefilledellipse (  $image ,  85 ,  149 ,  120 ,  85 ,  $color );  //бар
                  imagefilledrectangle($image, 251, 100, 298, 148, $color);        //WC
            
              }
            
              function createTable($image, $table_color, $site_color, $x1,  $y1,  $x2, $y2, $numSite){
            
                  imagefilledrectangle($image, $x1, $y1, $x2, $y2, $table_color);        //WC
            
                  if($numSite==4){
                      imagefilledrectangle($image, $x1-10, $y1+3, $x1-3, $y2/2, $site_color);
                      imagefilledrectangle($image, $x1-10, ($y2/2)+5, $x1-3, $y2-3, $site_color);
            
                      imagefilledrectangle($image, $x2+3, $y1+3, $x2+10, $y2/2, $site_color);
                      imagefilledrectangle($image, $x2+3, ($y2/2)+5, $x2+10, $y2-3, $site_color);
            
                  }else{
                      imagefilledrectangle($image, $x1-10, $y1+4, $x1-3, $y2-4, $site_color);
            
                      imagefilledrectangle($image, $x2+3, $y1+4, $x2+10, $y2-4, $site_color);
                  }
            
            
              }
            
              function writeText(&$image,$color){
            
                  //Указываем путь к шрифту
                  $font_path = '../fonts/aleo/aleo-bold_90e1aa58b8ee6fb4b81a0509d2b0251a.ttf';
                  //Пишем текст
                  $string = 'WC';
                  //Соединяем текст и картинку
                  imagettftext($image, 8, 0, 265, 130, $color, $font_path, $string);
                  $string = 'Exit';
                  imagettftext($image, 8, 0, 265, 12, $color, $font_path, $string);
                  $string = 'Bar';
                  imagettftext($image, 8, 0, 77, 135, $color, $font_path, $string);
                  $string = 'Wardrobe';
                  imagettftext($image, 8, 90, 239, 60, $color, $font_path, $string);
            
                  $table = 1;
                  $white = imagecolorallocate($image, 255, 255, 255);
            
                  //1 ряд столов
                  $tmpX1=28;
                  for($i=0;$i<5;$i++){
                      imagettftext($image, 8, 0, $tmpX1, 23, $white, $font_path, $table);
                      $tmpX1+= 40;
                      $table++;
                  }
            
                  //2 ряд столов
                  $tmpX1=107;
                  for($i=0;$i<2;$i++){
                      imagettftext($image, 8, 0, $tmpX1, 58, $white, $font_path, $table);
                      $tmpX1+= 80;
                      $table++;
                  }
            
                  //3 ряд столов
                  $tmpX1=185;
                  for($i=0;$i<2;$i++){
                      imagettftext($image, 8, 0, $tmpX1, 114, $white, $font_path, $table);
                      $tmpX1+= 40;
                      $table++;
                  }
            
                  //4 ряд столов
                  $tmpX1=182;
                  for($i=0;$i<2;$i++){
                      imagettftext($image, 8, 0, $tmpX1, 142, $white, $font_path, $table);
                      $tmpX1+= 40;
                      $table++;
                  }
            
            
            
              }
            
        
        