<?php

namespace app\controllers;

use app\models\AdminLogForm;
use app\models\CallForm;
use app\models\ContactForm;
use app\models\Dishes;
use app\models\LastEvent;
use app\models\Reservation;
use app\models\Reviews;
use app\models\Rooms;
use app\models\Tables;
use app\models\Users;
use app\models\Events;
use app\models\UserlogForm;
use app\models\Imgs;
use app\models\DishesMenu;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use app\classes\WriteImg;



class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
             'access' => [
                'class' => AccessControl::className(),
                 'rules' => [
                     [
                         'allow' => true,
                         'actions' => ['login-user','login-admin'], // действия в контроллере
                         'roles' => ['?'], // Доступ к действиям только для не авторизованных пользователей
                     ],
                     [
                         'allow' => true,
                         'actions' => ['logout'], // действия в контроллере
                         'roles' => ['@'], // Доступ к действиям только для авторизованных пользователей
                     ],
                 ],
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

   /* public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (!\Yii::$app->user->can($action->id)) {
                throw new ForbiddenHttpException('Access denied');
            }
            return true;
        } else {
            return false;
        }
    }*/

    public function actionIndex(){
        $days = ['sunday','monday','tuesday','wednesday','thursday','friday','saturday'];
        $date = date("w");

        $menu=Dishes::find()
                ->join('LEFT JOIN', 'Dishes_Menu', 'Dishes_Menu.id_Dishes = Dishes.id')
                ->join('LEFT JOIN', 'Menu', 'Menu.id = Dishes_Menu.id_Menu')
                ->where('Menu.day='."'$days[$date]'")->select('Dishes.name, Dishes.cost, Dishes.info, Dishes.type')->limit(8)->all();

        $slider = Dishes::find()->where(['position'=>'slider'])->all();
        if(Yii::$app->request->post()){
            $voteDish = Dishes::find()->where(['id'=>$_POST['vote-id']])->one();
            $vote = $_POST['score'];
            $numvote = $voteDish->numvote;
            $raiting=$voteDish->raiting;
            $voteDish->raiting=(($raiting*$numvote)+$vote)/($numvote+1);
            $voteDish->numvote=$numvote+1;
            $voteDish->save();
            return json_encode([$voteDish->raiting, $voteDish->numvote]);
        }

        return $this->render('index',[
            'slider' => $slider,
            'menu' =>   $menu,
        ]);
    }

    public function actionLoginUser(){
        if(Yii::$app->user->isGuest) {
            $userForm = new UserlogForm();

            if ($userForm->load(Yii::$app->request->post()) && $userForm->login()) {
                return $this->goBack();
            }

            return $this->render('login-user', [
                'userForm' => $userForm,
            ]);
        }else{
            $this->goBack();
        }
    }

    public function actionLogout(){
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLoginAdmin(){

        if(Yii::$app->user->isGuest) {

            $adminForm = new AdminLogForm();

            if($adminForm->load(Yii::$app->request->post()) ){
                if($adminForm->login()){
                    return $this->redirect(['/admin/index']);
                }else{
                    Yii::$app->session->setFlash('error', 'Incorrect password or name!');
                }
            }

            return $this->render('login-admin',[
               'adminForm' => $adminForm,
            ]);
        }else{
            $this->goBack();
        }
    }



    public function actionEvents(){

        if((\Yii::$app->request->isAjax)&&($_POST['date'])){
            $date = date('Y-m-d', strtotime($_POST['date']));
            $events = LastEvent::find()->where('date='."'".$date."'")->asArray()->all();
            return json_encode($events);
        }
        return $this->render('events');
    }

    public function actionGetImg(){
        if((\Yii::$app->request->isAjax)&&($_POST['id'])){
            $imgs = Imgs::find()->where('id_Event='.$_POST['id'])->asArray()->all();
            return json_encode($imgs);
        }
    }

    public function actionIndexAdd(){
        if(\Yii::$app->request->isAjax){
            $days = ['sunday','monday','tuesday','wednesday','thursday','friday','saturday'];
            $date = date("w");

            $menu=Dishes::find() ->asArray()
                ->join('LEFT JOIN', 'Dishes_Menu', 'Dishes_Menu.id_Dishes = Dishes.id')
                ->join('LEFT JOIN', 'Menu', 'Menu.id = Dishes_Menu.id_Menu')
                ->where('Menu.day='."'$days[$date]'")->select('Dishes.name, Dishes.cost, Dishes.info, Dishes.type')->all();

            return json_encode($menu);
        }
    }



    public function actionReviews(){
        
        $review = new Reviews();
        $comments = Reviews::find()->orderBy(['date'=>SORT_DESC]);
        $pages = new Pagination(['totalCount' => $comments->count(), 'pageSize' => 10]);
        $pages->pageSizeParam = false;
        $models = $comments->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        if($review->load(Yii::$app->request->post())){
            $review->id_User = Yii::$app->user->identity->id;
            $review->date = date("y.m.d");
            $review->time = date("H:i:s");
            $review->save();

            return $this->refresh();
        }

        return $this->render('reviews', [
            'review' => $review,
            'pages' => $pages,
            'models' => $models
        ]);
    }

    public function actionMenu(){
        $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
        
        for ($i=0;$i<7;$i++){
            $dishMenu[$days[$i]]=Dishes::find()
                ->join('LEFT JOIN', 'Dishes_Menu', 'Dishes_Menu.id_Dishes = Dishes.id')
                ->join('LEFT JOIN', 'Menu', 'Menu.id = Dishes_Menu.id_Menu')
                ->where('Menu.day='."'$days[$i]'")->select('Dishes.name, Dishes.cost, Dishes.info, Dishes.type')->all();
        }
        
        return $this->render('menu',[
            'days' =>$days,
            'dishMenu'=>$dishMenu,
        ]);
    }

    public function actionContact(){
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionOurStory(){
        return $this->render('our-story');
    }


    public function actionReservations(){
        $massTables = array();
        $room =  Rooms::find()->all();
        $massRooms =  ArrayHelper::map($room, 'id', 'hall');
        $events = Events::find()->all();
        $massEvents = ArrayHelper::map($events, 'id', 'event');
        $reservation = new Reservation();

        if($reservation->load(Yii::$app->request->post())){
            if($reservation->validate()) {
                $user = new Users();

                if (!Users::findByEmail($reservation->email)) {
                    $user->name = $reservation->name;
                    $user->email = $reservation->email;
                    $user->phone = $reservation->phone;
                    $user->role = 'user';
                    $user->img = 'images/avatar.png';
                    $user->save();
                }
                if (!Reservation::find()->where([
                    'date' => $reservation->date,
                    'id_Table' => $reservation->numberTable,
                ])->all()
                ) {
                    $reservation->date = date("Y-m-d", strtotime($reservation->date));
                    $reservation->time = date("H:i", strtotime($reservation->time));
                    $reservation->id_Table = (int)$reservation->numberTable;
                    $reservation->id_Event = (int)$reservation->event;
                    $reservation->id_User = Users::findByEmail($reservation->email)->Id;
                    $reservation->save();

                    Yii::$app->session->setFlash('success', 'Table reserved!');
                    return $this->refresh();
                } else {
                    Yii::$app->session->setFlash('error', 'The table is withdrawn!');
                }
            }else{
                Yii::$app->session->setFlash('error', 'Old date!');
            }

        }

        if(\Yii::$app->request->isAjax){
            $date = date("Y-m-d", strtotime($_POST['date']));
            $idRoom = $_POST['room'];

            $subQuery = Tables::find()->select('Tables.id')
            ->join('LEFT JOIN', 'Reservations', 'Reservations.id_Table = Tables.id')
                ->where(' Reservations.date = :date ', ['date'=>$date])
                ->column();
            $tables = Tables::find()
                ->where(['not', ['Tables.id' => $subQuery]])
            ->andWhere('Tables.id_Room = :idRoom',['idRoom'=>$idRoom])->all();



            $massTables = ArrayHelper::map($tables, 'id', 'teble');

            $writeImg = new WriteImg($massTables);

            if($idRoom==4) {
                $writeImg->crateImg(1);
              //  $writeImg->updateImgMain();
            }else{
                $writeImg->crateImg(2);
              //  $writeImg->updateImgVip();
            }

            return json_encode($massTables);
        }
        return $this->render('reservations',compact('reservation','massRooms','massEvents','massTables'));
    }

    /*SELECT * FROM Tables WHERE (`Tables`.id)
        NOT IN( SELECT `Tables`.id FROM Tables JOIN Reservations ON Reservations.id_Table = Tables.id WHERE Reservations.date = '2017-09-23') AND Tables.id_Room = 4

    SELECT * FROM Tables WHERE (`Tables`.id) NOT IN( SELECT `Tables`.id FROM Tables JOIN Reservations ON Reservations.id_Table = Tables.id WHERE Reservations.date = '2017-09-23') AND Tables.id_Room = 4*/
}
