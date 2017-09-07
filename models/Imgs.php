<?php
/**
 * Created by PhpStorm.
 * User: Alpo4
 * Date: 28.08.2017
 * Time: 9:06
 */

namespace app\models;


use yii\db\ActiveRecord;

class Imgs extends ActiveRecord{
    
    public static function tableName(){
        return 'Imgs';
    }
    
}