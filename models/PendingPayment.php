<?php
/**
 * Created by PhpStorm.
 * User: alpo4ino
 * Date: 14.09.17
 * Time: 15:14
 */

namespace app\models;


use yii\db\ActiveRecord;

class PendingPayment extends ActiveRecord
{
    public static function tableName()
    {
        return 'Pending_Payment';
    }

}