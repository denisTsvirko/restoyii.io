<?php
/**
 * Created by PhpStorm.
 * User: Alpo4
 * Date: 28.08.2017
 * Time: 14:38
 */

namespace app\controllers;



use app\models\admin\AddDishForm;
use app\models\admin\AddMenuForm;
use app\models\admin\UpdateDishForm;
use app\models\Imgs;
use app\models\LastEvent;
use app\models\Menu;
use yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\data\Pagination;
use yii\data\ArrayDataProvider;
use app\models\Users;
use app\models\Reviews;
use app\models\Reservation;
use app\models\admin\AddEventForm;
use app\models\admin\UpdateEventForm;
use app\models\Dishes;
use yii\web\UploadedFile;
use app\models\DishesMenu;
use yii\helpers\ArrayHelper;


class AdminController extends Controller{

    public $layout = 'main-admin';


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['*'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['*'],
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }
    public function beforeAction($action){
        if(!yii::$app->user->can('viewAdminPage')){
            $this->layout = 'main';
            return $this->redirect(['/login-admin']);
        }
        return $this->actionIndex();
    }

    public function actionIndex(){
        $usersSql = Users::find()->asArray()->all();
        $users = new ArrayDataProvider([
            'allModels' => $usersSql,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['id', 'name'],
            ],
        ]);

        $commentsSql = Reviews::find()->asArray()->all();
        $comments = new ArrayDataProvider([
            'allModels' => $commentsSql,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => [
                'attributes' => ['id', 'date'],
            ],
        ]);

        $reservationsSql = Reservation::find()->with('evt','table','rm');
        $reservations = new yii\data\ActiveDataProvider([
            'query' => $reservationsSql,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => [
                'attributes' => ['id', 'date'],
            ],
        ]);


        return $this->render('index',[
            'users'=>$users,
            'comments'=>$comments,
            'reservations'=>$reservations,
        ]);
    }

    public function actionDeleteComment(){
        $model = Reviews::find()->where(['id' => $_GET['id']])->one();
        $model->delete();
        return $this->redirect(['/admin/index']);
    }

    public function actionDeleteReserv(){
        $model = Reservation::find()->where(['id' => $_GET['id']])->one();
        $model->delete();
        return $this->redirect(['/admin/index']);
    }

    public function actionDeleteUser(){
        $id = $_GET['id'];
        $model = Users::find()->where(['id' => $id])->one();

        $model->beforeDelete(Reviews::deleteAll(['id_User' => $id]));
        $model->beforeDelete(Reservation::deleteAll(['id_User' => $id]));
        $model->delete();

        return $this->redirect(['/admin/index']);
    }

    public function actionDeleteEvent(){  //удалить событие из таблицы
        $id = $_GET['id'];
        $model = LastEvent::find()->where(['id' => $id])->one();

        $model->afterDelete(Imgs::deleteAll(['id_Event' => $id]));
        $model->delete();
        Yii::$app->session->setFlash('success', 'Successful delete event!');
        return $this->redirect(['/admin/event']);
    }

    public function actionUpdateEvent(){  //удалить событие из таблицы
        $id = $_GET['id'];
        $update = new UpdateEventForm();
        $model = LastEvent::find()->where(['id' => $id])->one();
        $update->title = $model->title;
        $update->date = $model->date;
        $update->descript = $model->descript;
        $update->midimg = UploadedFile::getInstance($update, 'midimg');
        $update->manyimg = UploadedFile::getInstances($update, 'manyimg');
        if($update->load(Yii::$app->request->post())){
            if ($update->validate()) {
                if($update->updateData($id)) {
                    Yii::$app->session->setFlash('success', 'Update event!');
                    return $this->redirect(['/admin/event']);
                }else{
                    Yii::$app->session->setFlash('error', 'Error update data!');
                }
            }else{
                Yii::$app->session->setFlash('error', 'Incorrect data!');
            }
            
        }

        return $this->render('update-event',[
            'update'=>$update,
        ]);
    }

    public function actionUpdateDish(){  //удалить событие из таблицы
        $id = $_GET['id'];
        $type = ['STARTERS'=>'STARTERS','MAINS'=>'MAINS','DESSERT'=>'DESSERT','LUNCH'=>'LUNCH','DINNER'=>'DINNER','DRINKS'=>'DRINKS'];
        $position = ['themenu'=>'themenu','slider'=>'slider'];
        
        $update = new UpdateDishForm();
        $model = Dishes::find()->where(['id' => $id])->one();
        $update->name = $model->name;
        $update->cost = $model->cost;
        $update->info = $model->info;
        $update->type = $model->type;
        $update->position = $model->position;
        $update->img = UploadedFile::getInstance($update, 'img');

        if($update->load(Yii::$app->request->post())){
            if ($update->validate()) {
                if($update->updateData($id)) {
                    Yii::$app->session->setFlash('success', 'Update dish: '.$model->name.' !');
                    return $this->redirect(['/admin/dishes']);
                }else{
                    Yii::$app->session->setFlash('error', 'Error update data!');
                }
            }else{
                Yii::$app->session->setFlash('error', 'Incorrect data!');
            }

        }

        return $this->render('update-dish',[
            'update'=>$update,
            'type'=>$type,
            'position'=>$position,
        ]);
    }

    public function actionAddMenu(){  //удалить событие из таблицы
        $id = $_GET['id'];
        $update = new AddMenuForm();
        $day = Menu::find()->all();
        $massDay = ArrayHelper::map($day, 'id', 'day');

        if($update->load(Yii::$app->request->post())){
            if ($update->validate()) {
                if($update->addMenu($id)) {
                    Yii::$app->session->setFlash('success', 'Dish add menu!');
                    return $this->redirect(['/admin/dishes']);
                }else{
                    Yii::$app->session->setFlash('error', 'Error update data!');
                }
            }else{
                Yii::$app->session->setFlash('error', 'Incorrect data!');
            }

        }

        return $this->render('add-menu',[
            'update'=>$update,
            'massDay'=>$massDay,
        ]);
    }



    public function actionDeleteDish(){  //удалить продукт из таблицы
        $id = $_GET['id'];
        $model = Dishes::find()->where(['id' => $id])->one();

        $model->afterDelete(DishesMenu::deleteAll(['id_Dishes' => $id]));
        $model->delete();
        Yii::$app->session->setFlash('success', 'Successful delete Dish !');
        return $this->redirect(['/admin/dishes']);
    }

    public function actionDeleteMenu(){  //удалить продукт из таблицы
        $id = $_GET['id'];
        $model = DishesMenu::find()->where(['id' => $id])->one();
        $model->delete();
        Yii::$app->session->setFlash('success', 'Successful delete elem-menu !');
        return $this->redirect(['/admin/admin-menu']);
    }


    public function actionEvent(){

        $addForm = new AddEventForm();
        $update=new AddEventForm();
        if($addForm->load(Yii::$app->request->post())) {
            $addForm->midimg = UploadedFile::getInstance($addForm, 'midimg');
            $addForm->manyimg = UploadedFile::getInstances($addForm, 'manyimg');
            if ($addForm->validate()) {
                if($addForm->saveData()) {
                    $this->refresh();
                    Yii::$app->session->setFlash('success', 'Add event!');

                }else{
                    Yii::$app->session->setFlash('error', 'Error saving data!');
                }
            }else{
                Yii::$app->session->setFlash('error', 'Incorrect data!');
            }
        }
        if(Yii::$app->request->get()){
            $id = $_GET['id'];
        }

        $LastEventSql = LastEvent::find();
        $lastevents = new yii\data\ActiveDataProvider([
            'query' => $LastEventSql,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'attributes' => ['id', 'date'],
            ],
        ]);


        return $this->render('event',[
            'lastevents' => $lastevents,
            'addForm' => $addForm,
            'update'=>$update,
        ]);
    }

    public function actionDishes(){
        $dishesSql = Dishes::find();
        $dishes = new yii\data\ActiveDataProvider([
            'query' => $dishesSql,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'attributes' => ['id', 'name', 'cost', 'raiting'],
            ],
        ]);

        $addForm = new AddDishForm();
        $type = ['STARTERS'=>'STARTERS','MAINS'=>'MAINS','DESSERT'=>'DESSERT','LUNCH'=>'LUNCH','DINNER'=>'DINNER','DRINKS'=>'DRINKS'];
        $position = ['themenu'=>'themenu','slider'=>'slider'];

        if($addForm->load(Yii::$app->request->post())) {
            $addForm->img = UploadedFile::getInstance($addForm, 'img');
            if ($addForm->validate()) {
                if($addForm->saveData()) {
                    $this->refresh();
                    Yii::$app->session->setFlash('success', 'Add dish!');
                }else{
                    Yii::$app->session->setFlash('error', 'Error saving data!');
                }
            }else{
                Yii::$app->session->setFlash('error', 'Incorrect data!');
            }
        }


        return $this->render('dishes',[
            'dishes' => $dishes,
            'addForm'=>$addForm,
            'type'=>$type,
            'position'=>$position,
        ]);
    }
    
    public function actionAdminMenu(){

        $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
        for ($i=0;$i<7;$i++){
            $dishMenu[$days[$i]] = new yii\data\ActiveDataProvider([
                'query' => DishesMenu::find()->where('id_Menu='.($i+1)),
                'pagination' => [
                    'pageSize' => 15,
                ],
                'sort' => [
                    'attributes' => ['id'],
                ],
            ]);
        }


        return $this->render('admin-menu',[
            'dishMenu'=>$dishMenu,
            'days'=>$days,
        ]);
    }
    
    public function actionLogout(){
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
