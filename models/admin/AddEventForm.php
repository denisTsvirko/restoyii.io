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

class AddEventForm extends Model{

    public $title;
    public $date;
    public $midimg;
    public $descript;
    public $manyimg;

    public function rules(){
        return [
            [['title','date','midimg','descript','manyimg' ], 'required'],
            [['midimg'], 'image', 'extensions' => 'png, jpg, gif','minWidth' => 100,'minHeight' => 100],
            ['title', 'string', 'max'=>45],
            [['manyimg'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 20],
        ];
    }
    public function saveData(){
        $lastEvent = new LastEvent();

        $dirTemp = 'images/events/'.$this->date.'/';

        if(!is_dir( $dirTemp  )){
            $dir = $dirTemp.'1/';
            mkdir( $dir, 0777, true );
        }else{
            $i=1;
            while(1){
                $i++;
                $dir = $dirTemp.$i.'/';
                if(!is_dir($dir)){
                    $folder = $i;
                    mkdir( $dir, 0777, true );
                    break;
                }
            }
        }
        $dirImgs = $dir.'img/';
        mkdir( $dirImgs, 0777, true );


        $this->midimg->saveAs($dir . $this->midimg->name );
        $lastEvent->title = $this->title;
        $lastEvent->date = $this->date;
        $lastEvent->descript = $this->descript;
        $lastEvent->midimg=$dir . $this->midimg->name;
        /*if($folder==0){
            $folder=1;
        }*/
        $lastEvent->folder = (int)$folder;
        $lastEvent->save();

        foreach ($this->manyimg as $file) {
            $file->saveAs($dirImgs . $file->name );
            $img = new Imgs();
            $img->path = $dirImgs . $file->name;
            $img->id_Event = $lastEvent->Id;
            $img->save();
        }

        return true;
    }

}