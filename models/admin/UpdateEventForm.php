<?php
/**
 * Created by PhpStorm.
 * User: Alpo4
 * Date: 30.08.2017
 * Time: 21:29
 */

namespace app\models\admin;

use app\models\Imgs;
use app\models\LastEvent;
use Yii;
use yii\base\Model;
use ImgWorks;

class UpdateEventForm extends Model{

    public $title;
    public $date;
    public $midimg;
    public $descript;
    public $manyimg;

    public function rules(){
        return [
            [['title','date','descript', ], 'required'],
            [['midimg'], 'image', 'extensions' => 'png, jpg, gif','minWidth' => 100,'minHeight' => 100],
            ['title', 'string', 'max'=>45],
            [['manyimg'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 20],
        ];
    }
    

    public function updateData($id){
        $lastEvent = LastEvent::find()->where(['id' => $id])->one();

        $lastEvent->title = $this->title;
        $lastEvent->descript = $this->descript;

        if($this->midimg!=null){
            $dir = 'images/events/'.$lastEvent->date.'/'.$lastEvent->folder.'/';
            $this->midimg->saveAs($dir . $this->midimg->name );
            $lastEvent->midimg=$dir . $this->midimg->name;
        }
        if($this->manyimg!=null){
            $dirImgs = $dir.'img/';
            foreach ($this->manyimg as $file) {
                $file->saveAs($dirImgs . $file->name );
                $img = new Imgs();
                $img->path = $dirImgs . $file->name;
                $img->id_Event = $lastEvent->Id;
                $img->save();
            }
        }

        return $lastEvent->save();

    }


}