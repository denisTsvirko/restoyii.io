<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\ContactForm;

class FBFWidget extends Widget{

    public function run(){
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            
            Yii::$app->session->setFlash('contactFormSubmitted');
        }
        return $this->render('fbfWidget', [
        'model' => $model,
        ]);
    }

}