<?php

namespace app\models;


use yii\db\ActiveRecord;

class PendingPayment extends ActiveRecord
{
    public static function tableName()
    {
        return 'Pending_Payment';
    }
}
