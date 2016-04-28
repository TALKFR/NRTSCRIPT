<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\Allocations;

class AllocationsController extends Controller {

    public function beforeAction($action) {
        $this->layout = 'mainui';
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $Scripts = \app\scripts\Scripts::GetScriptsList();

        $dataProvider = new ActiveDataProvider([
            'query' => Allocations::find(),
        ]);





        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

}
