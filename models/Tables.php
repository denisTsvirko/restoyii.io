<?php
/**
 * Created by PhpStorm.
 * User: Alpo4
 * Date: 17.08.2017
 * Time: 9:10
 */
namespace app\models;
use yii\db\ActiveRecord;

class Tables extends ActiveRecord{

    public static function tableName(){
        return 'Tables';
    }

    /*public function getRoom(){
        return $this->hasMany(Rooms::className(), ['id' => 'id_Room']);
    }*/
    
}