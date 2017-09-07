<?php
/**
 * Created by PhpStorm.
 * User: Alpo4
 * Date: 17.08.2017
 * Time: 9:10
 */

namespace app\models;
use yii\db\ActiveRecord;

/**
 * Class Reviews
 * 
 * @package app\models
 * 
 * @property Users $user
 */
class Reviews extends ActiveRecord{

    public static function tableName(){
        return 'Comments';
    }

    public function rules(){
        return [
            ['review', 'required'],
            ['review', 'string', 'max'=>250],
        ];
    }

    /**
     * Returns user related record
     * 
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_User']);
    }
}