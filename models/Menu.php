<?php
/**
 * Created by PhpStorm.
 * User: Alpo4
 * Date: 01.09.2017
 * Time: 10:52
 */

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