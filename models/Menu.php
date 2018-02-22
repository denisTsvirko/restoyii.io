<?php

namespace app\models;


use yii\db\ActiveRecord;

class Menu extends ActiveRecord
{
    public static function tableName()
    {
        return 'Menu';
    }

    public function getDishesMenus()
    {
        return $this->hasMany(DishesMenu::className(), ['id_Menu' => 'id']);
    }
}
