<?php

namespace app\scripts\Artisans\v2\controllers;

use Yii;
use yii\web\Controller;

class DefaultController extends Controller {

    public function actionIndex($idversion) {
        return $this->render('view', []);
    }

}
