<?php

namespace app\models;

use Yii;
use yii\base\Model;

class AdminLogForm extends Model
{
    public $name;
    public $password;
    private $_user = false;

    public function rules()
    {
        return [
            [['name', 'password'], 'required'],
            ['name', 'string', 'max' => 11, 'min' => 5],
        ];
    }

    public function login()
    {
        if ($this->validate()) {
            if ($this->getUser()) {
                return Yii::$app->user->login(Users::findByUserName($this->name), 3600 * 24 * 30);
            }
        }
        
        return false;
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Users::findByUserName($this->name);
        }

        return $this->_user;
    }
}
