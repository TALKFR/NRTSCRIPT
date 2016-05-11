<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\NixxisParameters;
use app\components\NixxisV2;
use app\components\NrtLogger;
use app\models\ui\Allocations;

class SiteController extends Controller {

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        /* @var $Allocation \app\models\allocations */
        $start = microtime(true);
        if (Yii::$app->session->isActive) {
            Yii::$app->session->destroy();
        }
        $NixxisParameters = new NixxisParameters();
        $NixxisParameters->diallerCampaign = filter_input(INPUT_GET, 'diallerCampaign');
        $NixxisParameters->diallerActivity = filter_input(INPUT_GET, 'diallerActivity');
        $NixxisParameters->contactid = filter_input(INPUT_GET, 'contactid');
        $NixxisParameters->diallerReference = filter_input(INPUT_GET, 'diallerReference');
        $NixxisParameters->autosearch = filter_input(INPUT_GET, 'autosearch');
        $NixxisParameters->sessionid = filter_input(INPUT_GET, 'sessionid');

        if ($NixxisParameters->validate()) {
            // Search in the allocation table, if an allocation exists
            $AllocationCount = Allocations::find()->where(['NixxisActivityId' => $NixxisParameters->diallerActivity])->count();
            // Throw an error if there is no allocation
            if (!$AllocationCount) {
                echo '<p style="color:red;">No script allocation found</p>';
                exit(0);
            }
            // Throw an error if there are more than one allocation
            if ($AllocationCount > 1) {
                echo '<p style="color:red;">More than one allocation found</p>';
                exit(0);
            }
            // Create Allocation model object
            $Allocation = Allocations::find()->where(['NixxisActivityId' => $NixxisParameters->diallerActivity])->one();
            // Tag in the NixxisParameters Object the type of the activity ie INBOUND|OUTBOUND
            $NixxisParameters->GetNixxisActivityType();

            // Put in session NixxisParameters, and all the qualitications available for the activity
            Yii::$app->session->set('Allocation', $Allocation);
            Yii::$app->session->set('NixxisParameters', $NixxisParameters);
            Yii::$app->session->set('NixxisQualifications', $this->GetQualification($NixxisParameters->diallerActivity));

            $Module = $Allocation->Script;

//            echo $Module;
//            exit(0);

            NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Module, (microtime(true) - $start), "SiteController");
            return $this->redirect(array($Module::getRoute()), 302);
        } else {
            foreach ($NixxisParameters->errors as $field => $listerrors) {
                echo '<p>' . $field . '</p>';
                foreach ($listerrors as $error) {
                    echo '--> ' . $error . '<br>';
                }
            }
            echo '<p style="color:red;">NixxisParameters validate error</p>';
            exit(0);
        }
    }

    private function GetQualification($ActivityId) {
        $start = microtime(true);
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        $Allocation = Yii::$app->session->get('Allocation');
        $Module = $Allocation->Script;

        $Nixxis = new NixxisV2();
        $Nixxis->setAppServer(Yii::$app->params['Nixxis_IP']);
        $Nixxis->setDb(Yii::$app->params['Nixxis_Bdd']);
        $Nixxis->setUsername(Yii::$app->params['Nixxis_User']);
        $Nixxis->setPassword(Yii::$app->params['Nixxis_Password']);
        $Nixxis->setContextDataUrl(Yii::$app->params['Nixxis_ContextDataUrl']);

        $Nixxis->ConnectSqlServer();

        $NixxisQualifications = $Nixxis->ContextData_GetNixxisQualifications($ActivityId);


        NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Module, (microtime(true) - $start), "SiteGetQualifications");
        return $NixxisQualifications;
    }

}
