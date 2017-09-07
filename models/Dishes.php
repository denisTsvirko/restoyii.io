<?php
/**
 * Created by PhpStorm.
 * User: Alpo4
 * Date: 31.08.2017
 * Time: 17:46
 */

namespace app\models;

/**
 * Class Dishes
 *
 * @package app\models
 *
 * @property Menu $menu
 *
 */
use yii\db\ActiveRecord;

class Dishes extends ActiveRecord {
    
    public static function tableName()
    {
        return 'Dishes'; // TODO: Change the autogenerated stub
    }

    /**
     * Returns menu related record
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDishesMenus(){
        return $this->hasMany(Menu::className(), ['id_Dishes'=>'id']);
    }
}