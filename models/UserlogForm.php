<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\User;
use ImgWorks;

class UserlogForm extends Model
{
    public $name;
    public $email;
    public $path;
    private $_user = false;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['path'], 'image', 'extensions' => 'png, jpg, gif', 'maxSize' => 50 * 1024, 'minWidth' => 50, 'minHeight' => 50],
            ['name', 'string', 'max' => 45],
            ['email', 'email'],
        ];
    }

    public function login()
    {
        if ($this->validate()) {
            if (!$this->getUser()) {

                $user = new Users();
                $dir = 'images/users/' . $this->name . '/';
                if ($_FILES["UserlogForm"]['name']['path'] === '') {
                    if (!is_dir($dir)) {
                        mkdir($dir, 0777, true);
                        $user->img = 'images/avatar.png';
                    }
                } else {
                    try {
                        $arrFileImg = $this->normalize_files_array($_FILES, 'UserlogForm');
                    } catch (Exception $e) {
                        $arr = array('url' => '', 'error' => true, 'type' => $e->getMessage());
                        return $arr;
                    }
                    $imgWork = new ImgWorks($arrFileImg, 'UserlogForm', "avatar", $dir);
                    $maxSize = $imgWork->checkMaxSize(50);
                    if ($maxSize != false) {
                        $arr = array('url' => '', 'error' => true, 'type' => $maxSize);
                        return $arr;
                    } else {
                        $minWH = $imgWork->checMinWH(50, 50);
                        if ($minWH != false) {
                            $arr = array('url' => '', 'error' => true, 'type' => $minWH);
                            return $arr;
                        } else {
                            $url = $imgWork->loadServer(true, 150, 150);
                            $user->img = $url[0];
                        }
                    }

                }

                $user->name = $this->name;
                $user->email = $this->email;
                $user->save();

                $userRole = Yii::$app->authManager->getRole('user');
                Yii::$app->authManager->assign($userRole, $user->getId());
            }

            return Yii::$app->user->login(Users::findByEmail($this->email), 3600 * 24 * 30);
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Users::findByEmail($this->email);
        }

        return $this->_user;
    }

    function normalize_files_array($files = [], $name)
    {
        if ($files["$name"]['size'] <= 0) {
            throw new Exception('Image array is empty!');
            return -1;
        }

        $normalized_array = [];
        $allowedTypes = array('image/gif', 'image/png', 'image/jpg', 'image/jpeg');

        foreach ($files as $index => $file) {

            if (!is_array($file['name'])) {
                if (in_array($file['type'], $allowedTypes)) {
                    $normalized_array[$index][] = $file;
                    continue;
                } else {
                    throw new Exception('Invalid type! ' . $name);
                    return;
                }
            }

            foreach ($file['name'] as $idx => $name) {
                if (in_array($file['type'][$idx], $allowedTypes)) {
                    $normalized_array[$index][$idx] = [
                        'name' => $name,
                        'type' => $file['type'][$idx],
                        'tmp_name' => $file['tmp_name'][$idx],
                        'error' => $file['error'][$idx],
                        'size' => $file['size'][$idx]
                    ];
                } else {
                    throw new Exception('Invalid type! ' . $name);
                    return;
                }
            }
        }

        return $normalized_array;
    }
}
