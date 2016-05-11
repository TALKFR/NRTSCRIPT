<?php

namespace app\controllers\ui;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use app\models\ui\Script;

class ScriptController extends Controller {

    public function beforeAction($action) {
        $this->layout = 'mainui';
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $scripts = \app\scripts\Scripts::GetScriptsList();

        $dataProvider = new ArrayDataProvider([
            'allModels' => $scripts,
        ]);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate() {
        $model = new Script();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->CreateView();
            $model->CreateFolders();
            $model->CreateModuleFile();
            $model->CreateControllerFile();
            $model->CreateCustomModelFile();
            if (!$model->CreateModelFile()) {
                echo 'Model creation failed';
            }
            $model->CreateViewFiles();
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

}
