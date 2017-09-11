<?php
/**
 * Created by PhpStorm.
 * User: Alpo4
 * Date: 17.08.2017
 * Time: 9:10
 */
namespace app\models;
use yii\db\ActiveRecord;

class LastEvent extends ActiveRecord{
    
    public static function tableName()
    {
        return 'Last_Events'; 
    }

    public function getId()
    {
        return $this->id;
    }
}