<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Users
 * @package app\models
 *
 * @property Reviews $comments
 * @property Reservation $reservations
 */
class Users extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    public $accessToken;

    public static function tableName()
    {
        return 'Users';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
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
        $User = Users::find()
            ->where(["email" => $email])
            ->one();
        if (!count($User)) {

            return null;
        }

        return new static($User);
    }

    public static function findByUserName($name)
    {
        $User = Users::find()
            ->where(["name" => $name])
            ->one();
        if (!count($User)) {

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
}
