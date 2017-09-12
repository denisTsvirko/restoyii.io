<?php
/**
 * Created by PhpStorm.
 * User: Alpo4
 * Date: 17.08.2017
 * Time: 9:10
 */

namespace app\models;
use yii\db\ActiveRecord;
/**
 * Class Reservation
 *
 * @package app\models
 *
 * @property Users $user
 * @property Events $evt
 * @property Tables $table
 * @property Rooms $rm
 *
 */
class Reservation extends ActiveRecord{

//    public $date;
//    public $time;
    public $room;
    public $numberTable;
   public $event;
   // public $numberGuests;
    public $name;
    public $phone;
    public $email;
   // public $offers;

    public static function tableName(){
        return 'Reservations';
    }

    /**
     * Returns user related record
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(Users::className(), ['id' => 'id_User']);
    }

    /**
     * Returns table related record
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTable(){
        return $this->hasOne(Tables::className(), ['id'=>'id_Table']);
    }
    /**
     * Returns evt related record
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvt(){
        return $this->hasOne(Events::className(), ['id'=>'id_Event']);
    }
    /**
     * Returns room related record
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRm(){
        return $this->hasOne(Rooms::className(), ['id'=>'id_Room'])->viaTable('Tables', ['id' => 'id_Table']);
    }


    public function attributeLabels(){
        return [
            'email'=>'E-mail',
        ];
    }

    public function rules(){
        return [
            [['date','time','room','numberTable','event','numguests','name','phone','offers','email'], 'required'],
            ['email','email'],
            ['time','string', 'min'=>5],
            ['numguests', 'string', 'max'=>45],
            ['date','dateRule'],
        ];
    }

    public function dateRule($attr){
        $serverdate = date("d-m-Y");

        if(strtotime($serverdate)>strtotime($this->$attr)){
            //$this->addError($attr,'server date: '.strtotime($serverdata).' main date:'. strtotime($this->$attr));
            $this->addError('Old date!');
        }
    }


}