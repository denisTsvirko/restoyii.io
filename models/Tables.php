<?php

namespace app\models;

use yii\db\ActiveRecord;

class Tables extends ActiveRecord
{
    public static function tableName()
    {
        return 'Tables';
    }
}
