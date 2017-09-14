<?php
/**
 * Created by PhpStorm.
 * User: alpo4ino
 * Date: 13.09.17
 * Time: 20:59
 */
namespace app\classes;

class WriteImg {

    protected $massTable;

    public function __construct($massTable) {

        $this->massTable = $massTable;

    }

    public function crateImg($opt){
        $mas = [];

        foreach ($this->massTable as $table){
            $mas[]=$table;
        }

        if($opt==1){
            $_SESSION['tableMain'] = $mas;
        }else{
            if(count($mas)<1) {
                $mas = [1, 2];
            }

            $_SESSION['tableVip']=$mas;
        }




    }



}