<?php

namespace app\models;

use yii\db\ActiveRecord;

class Events extends ActiveRecord
{
    public static function tableName()
    {
        return 'Events';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getReservation()
    {
        return $this->hasMany(Reservation::tableName(), ['id_Event' => 'id']);
    }
}
