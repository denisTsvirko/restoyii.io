<?php

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

class Dishes extends ActiveRecord
{
    public static function tableName()
    {
        return 'Dishes';
    }

    /**
     * Returns menu related record
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDishesMenus()
    {
        return $this->hasMany(Menu::className(), ['id_Dishes' => 'id']);
    }
}
