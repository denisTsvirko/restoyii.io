<?php
/**
 * Created by PhpStorm.
 * User: Alpo4
 * Date: 22.08.2017
 * Time: 16:17
 */

namespace app\commands;
use Yii;
use yii\console\Controller;


class RbacController extends Controller{

    public function actionInit()
    {
        $authManager  = Yii::$app->authManager;

        // Create roles
       /* $admin = $authManager->createRole('admin');
        $user = $authManager->createRole('user');

        // Create simple
        $adminPanel = $authManager->createPermission('admin-panel');
        $addComment = $authManager->createPermission('addComment');

        //add permissions
        $authManager->add($adminPanel);
        $authManager->add($addComment);

        // Add roles
        $authManager->add($admin);
        $authManager->add($user);

        // Add permission-per-role
        // User
        $authManager->addChild($user,$addComment);

        //Admin
        $authManager->addChild($admin, $adminPanel);
        $authManager->add($admin, $user);*/



        // добавляем разрешение "createComent"
        $createComent = $authManager->createPermission('createComent');
        $createComent->description = 'Create comments for resto!';
        $authManager->add($createComent);

        // добавляем разрешение "viewAdminPage"
        $viewAdminPage = $authManager->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Admin page!';
        $authManager->add($viewAdminPage);

        // добавляем роль "user" и даём роли разрешение "createPost"
        $user = $authManager->createRole('user');
        $authManager->add($user);
        $authManager->addChild($user, $createComent);

        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "author"
        $admin = $authManager->createRole('admin');
        $authManager->add($admin);
        $authManager->addChild($admin, $viewAdminPage);
        $authManager->addChild($admin, $user);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $authManager->assign($user, 2);
        $authManager->assign($admin, 1);
    }

}