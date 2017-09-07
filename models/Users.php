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
 * Class Users
 * @package app\models
 * 
 * @property Reviews $comments
 * @property Reservation $reservations
 */
class Users extends ActiveRecord implements \yii\web\IdentityInterface{

    //public $path;
   // public $id;
   // public $name;
    public $authKey;
    public $accessToken;

    public static function tableName(){
        return 'Users';
    }



    /*public static function findByEmail ($email) {
        return self::findOne(['email' => $email]);
    }*/  //скорее всего сломается reservations

   /* public function rules(){
        return [
            [['name','email'], 'required'],
            //['path', 'required', 'message'=>'Avatar cannot be blank.'],
            ['email','email'],
            ['name', 'string', 'max'=>45],
            [['path'], 'file', 'extensions' => 'png, jpg, gif'],
        ];
    }*/

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        /*foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;*/
        $User = Users::find()
            ->where(["accessToken" => $token])
            ->one();
        if (!count($User)) {
            return null;
        }
        return new static($User);
    }

    /**
     * Finds user by username
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        /*foreach (self::$users as $user) {
            if (strcasecmp($user['name'], $name) === 0) {
                return new static($user);
            }
        }

        return null;*/
        $User = Users::find()
            ->where(["email" => $email])
            ->one();
        if (!count($User)) {
            //file_put_contents('log.txt', 'no user'.PHP_EOL,FILE_APPEND);
            return null;
        }
        return new static($User);
    }

    public static function findByUserName($name)
    {
        /*foreach (self::$users as $user) {
            if (strcasecmp($user['name'], $name) === 0) {
                return new static($user);
            }
        }

        return null;*/
        $User = Users::find()
            ->where(["name" => $name])
            ->one();
        if (!count($User)) {
            //file_put_contents('log.txt', 'no user'.PHP_EOL,FILE_APPEND);
            return null;
        }
        return new static($User);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Reviews::tableName(), ['id_User' => 'id']);
    }
    /*public function getReservation()
    {
        return $this->hasMany(Reservation::tableName(), ['id_User' => 'id']);
    }*/

}