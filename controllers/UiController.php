<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class UiController extends Controller {

    public function beforeAction($action) {
        $this->layout = 'mainui'; //your layout name
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        return $this->render('index', [
        ]);
    }

}
