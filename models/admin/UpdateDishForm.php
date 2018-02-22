<?php

namespace app\models\admin;

use app\models\Dishes;
use app\models\Imgs;
use app\models\LastEvent;
use Yii;
use yii\base\Model;
use ImgWorks;

class UpdateDishForm extends Model
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
            [['name', 'cost', 'info', 'type', 'position'], 'required'],
            [['img'], 'image', 'extensions' => 'png, jpg, gif', 'minWidth' => 100, 'minHeight' => 100],
            ['info', 'string', 'max' => 150],
            ['cost', 'double', 'min' => 0.01, 'max' => 250],
        ];
    }

    public function updateData($id)
    {
        $dishes = Dishes::find()->where(['id' => $id])->one();
        $dishes->cost = $this->cost;
        $dishes->info = $this->info;
        $dishes->type = $this->type;
        $dishes->position = $this->position;

        if ($this->img != null) {
            $dir = 'images/dishes/' . $dishes->name . '/';
            $this->img->saveAs($dir . $this->img->name);

            $dishes->img = $dir . $this->img->name;
        }

        return $dishes->save();
    }
}
