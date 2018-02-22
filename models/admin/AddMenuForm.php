<?php

namespace app\models\admin;


use app\models\DishesMenu;
use yii\base\Model;

class AddMenuForm extends Model
{
    public $day;

    public function rules()
    {
        return [
            ['day', 'required'],
        ];
    }

    public function addMenu($id)
    {
        $dishMenu = new DishesMenu();
        $dishMenu->id_Dishes = $id;
        $dishMenu->id_Menu = $this->day;

        return $dishMenu->save();
    }
}