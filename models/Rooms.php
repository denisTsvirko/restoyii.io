<?php

namespace app\models;

use yii\db\ActiveRecord;

class Rooms extends ActiveRecord
{
    public static function tableName()
    {
        return 'Rooms';
    }

    public function getComments()
    {
        return $this->hasMany(Tables::tableName(), ['id_Room' => 'id']);
    }
}
