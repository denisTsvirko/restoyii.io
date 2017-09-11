<?php
/**
 * Created by PhpStorm.
 * User: Alpo4
 * Date: 17.08.2017
 * Time: 9:10
 */
namespace app\models;
use yii\db\ActiveRecord;

class Rooms extends ActiveRecord{

    public static function tableName(){
        return 'Rooms';
    }

    public function getComments()
    {
        return $this->hasMany(Tables::tableName(), ['id_Room' => 'id']);
    }
    
}