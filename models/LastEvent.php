<?php

namespace app\models;

use yii\db\ActiveRecord;

class LastEvent extends ActiveRecord
{
    public static function tableName()
    {
        return 'Last_Events';
    }

    public function getId()
    {
        return $this->id;
    }
}
