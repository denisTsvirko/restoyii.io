<?php

namespace app\models\admin;

use app\models\Imgs;
use app\models\LastEvent;
use app\models\Dishes;
use Yii;
use yii\base\Model;
use ImgWorks;

class AddDishForm extends Model
{
    public $img;
    public $info;
    public $cost;
    public $name;
    public $type;
    public $position;

    public function rules()
    {
        return [
            [['img', 'name', 'cost', 'info', 'type', 'position'], 'required'],
            [['img'], 'image', 'extensions' => 'png, jpg, gif', 'minWidth' => 100, 'minHeight' => 100],
            ['info', 'string', 'max' => 150],
            ['cost', 'double', 'min' => 0.01, 'max' => 250],
        ];
    }

    public function saveData()
    {
        $dishes = new Dishes();
        $dirTemp = 'images/dishes/' . $this->name . '/';

        if (!is_dir($dirTemp)) {
            mkdir($dirTemp, 0777, true);
        }

        $this->img->saveAs($dirTemp . $this->img->name);
        $dishes->img = $dirTemp . $this->img->name;
        $dishes->name = $this->name;
        $dishes->cost = $this->cost;
        $dishes->info = $this->info;
        $dishes->type = $this->type;
        $dishes->position = $this->position;

        return $dishes->save();
    }
}
