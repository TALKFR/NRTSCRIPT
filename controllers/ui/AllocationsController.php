<?php

namespace app\controllers\ui;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\ui\Allocations;

class AllocationsController extends Controller {

    public function beforeAction($action) {
        $this->layout = 'mainui';
        return parent::beforeAction($action);
    }

    public function actionIndex() {
//        $Scripts = \app\scripts\Scripts::GetScriptsList();
//
//
//
//        print_r($Scripts);
//
//
//        $ScriptClassName = $Scripts[1]['Id'];
////        print_r($ScriptClassName);
////$ScriptClass = new $ScriptClassName();
//        $Versions = $ScriptClassName::GetVersionsList();
//
//
//
////        print_r($Versions);
////
//        exit(0);
        $dataProvider = new ActiveDataProvider([
            'query' => Allocations::find(),
        ]);





        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate() {
        $model = new Allocations();





        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => Allocations::findOne($id),
        ]);
    }

    public function actionUpdate($id) {
        $model = Allocations::findOne($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionDelete($id) {

        $model = Allocations::findOne($id);
        $model->delete();
        return $this->redirect(['index']);
    }

    public function actionListActivities($id) {
        $countActivities = \app\models\Nixxis\Activities::find()->where(['CampaignId' => $id])->count();



        if ($countActivities > 0) {
            $Activities = \app\models\Nixxis\Activities::find()->where(['CampaignId' => $id])->all();

            foreach ($Activities as $Activity) {
                echo "<option value='" . $Activity->Id . "'>" . $Activity->Description . "</option>";
            }
        } else {
            echo "<option> - </option>";
        }
    }

    public function actionListVersions($id) {
        $countVersions = count($id::GetVersionsList());
        $Versions = $id::GetVersionsList();

        if ($countVersions > 0) {
            foreach ($Versions as $Version) {
                echo "<option value='" . $Version['Id'] . "'>" . $Version['Name'] . "</option>";
            }
        } else {
            echo "<option> - </option>";
        }
    }

    public function actionRun($id) {
        $model = Allocations::findOne($id);
        $relectionclass = new \ReflectionClass($model->Script);
        $classname = $relectionclass->getNamespaceName() . "\\v" . $model->version . "\\models\\DATA" . ucfirst($model->NixxisCampaignId);
        $count = $classname::find()->count();


        if ($count) {
            $sql = "SELECT TOP 1 * FROM Data_" . $model->NixxisCampaignId . "..Data D inner join Data_" . $model->NixxisCampaignId . "..SystemData  SD ON (D.Internal__Id__ = SD.Internal__Id__) WHERE CurrentActivity = '" . $model->NixxisActivityId . "' ORDER BY newid()";
            $record = $classname::findBySql($sql)->asArray()->one();
            $diallerReference = $record['Internal__id__'];
        } else {
            $diallerReference = "1234";
        }


        $parameters = [
            'diallerCampaign' => $model->NixxisCampaignId,
            'diallerActivity' => $model->NixxisActivityId,
            'contactid' => $this->guidv4(),
            'diallerReference' => $diallerReference,
            'autosearch' => '',
            'sessionid' => $this->guidv4(),
        ];

        $this->redirect('http://10.100.30.110/nrtscriptdev/web/index.php?' . http_build_query($parameters));
    }

    function guidv4() {
        if (function_exists('com_create_guid') === true)
            return trim(com_create_guid(), '{}');

        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
        return vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 4));
    }

}
