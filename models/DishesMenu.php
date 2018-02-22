<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class DishesMenu
 *
 * @package app\models
 *
 * @property Dish $dish
 * @property Menu $menu
 *
 */
class DishesMenu extends ActiveRecord
{
    public static function tableName()
    {
        return 'Dishes_Menu';
    }

    /**
     * Returns dish related record
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dishes::className(), ['id' => 'id_Dishes']);
    }

    /**
     * Returns menu related record
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id' => 'id_Menu']);
    }
}
