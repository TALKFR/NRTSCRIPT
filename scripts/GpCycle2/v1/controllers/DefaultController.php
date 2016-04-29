<?php

namespace app\scripts\GpCycle2\v1\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\NixxisParameters;
use app\models\NixxisQualifications;
use app\components\NrtLogger;
use app\scripts\Travaux\v1\models\SM_ListActivities;
use app\scripts\Travaux\v1\models\GenForm;
use app\models\Leads;

//108

class DefaultController extends Controller {

    private $NixxisQualifications = array();

    private function AffectScenario($NixxisQualificationId, &$model, &$model_qualifications) {
        /* @var $model \app\models\Campaigns\DATA76b3ff146f6c4802b727bb3042493043 */

        switch ($NixxisQualificationId) {
            case 'e5376e5fad6044be90db67d8328016f3': //PA
                $model->scenario = 'PA';
                $model_qualifications->nextstep = 'qualifications';
                break;
            case '9c37305e2f294c6d97bf576baa1e08f0': //PA EN LIGNE
                $model->scenario = 'PA';
                $model_qualifications->nextstep = 'qualifications';
                break;
            case '4105f9cc01124ecf9c3bea0094d10ac3': //PA SLIMPAY
                $model->scenario = 'PA';
                $model_qualifications->nextstep = 'qualifications';
                break;
//            case '2150bd497e204d8f8d7803dda6088816': //PA SANS MONTANT
//                $model->scenario = '';
//                break;
            case 'f70d3636038b421280a32349b16e475d': //DU
                $model->scenario = 'DU';
                $model_qualifications->nextstep = 'qualifications';
                break;
            case 'f2eeb84096d94321836c2d7a3812ae19': //DU EN LIGNE
                $model->scenario = 'DU';
                $model_qualifications->nextstep = 'qualifications';
                break;
//            case 'd50b40403e7b4b8e973f41d623540649': //DU SANS MONTANT
//                $model->scenario = 'PA';
//                break;
        }

        if ($this->NixxisQualifications[$NixxisQualificationId]['Description'] == 'A rappeler') {
            $model_qualifications->scenario = 'CALLBACK';
        }
    }

    public function actionIndex() {

        $start = microtime(true);
        $model_qualifications = new NixxisQualifications();
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        if (!$NixxisParameters instanceof NixxisParameters) {
            die('Session Error');
        }
        $Script = Yii::$app->session->get('Script');


        $model = $this->findModel($NixxisParameters->diallerReference);


        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');

        if ($model->GetSystemData()->LastQualification != '' && $NixxisParameters->ActivityType == $NixxisParameters::ACT_INBOUND) {
            $model->scenario = 'RO';
        } else {
            $model->scenario = 'default';
        }


//        $Leads = Leads::find()->where(['nixxisid' => $NixxisParameters->diallerReference])->all();
//        $dataProvider = new ActiveDataProvider([
//            'query' => Leads::find()->where(['nixxisid' => $NixxisParameters->diallerReference]),
//        ]);


        NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptIndex");
        return $this->render('index', [
                    'model' => $model,
                    'NixxisParameters' => $NixxisParameters,
                    'Script' => $Script,
                    'model_qualifications' => $model_qualifications,
                    'NixxisQualifications' => $this->NixxisQualifications,
                    'Module' => $this->module,
//                    'Leads' => $dataProvider
        ]);
    }

    public function actionStep2($Internal__id__) {
        $start = microtime(true);
        $model = $this->findModel($Internal__id__);
        $Script = Yii::$app->session->get('Script');

        $model_qualifications = new NixxisQualifications();
        $model_qualifications->load(Yii::$app->request->post());

        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');



        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->AffectScenario($model_qualifications->qualificationId, $model, $model_qualifications);
            if ($model_qualifications->scenario == 'CALLBACK') {
                $model->scenario = 'RO';
                return $this->render('callback', [
                            'model' => $model,
                            'model_qualifications' => $model_qualifications,
                            'NixxisParameters' => $NixxisParameters,
                            'Script' => $Script,
                            'NixxisQualifications' => $this->NixxisQualifications,
                            'Module' => $this->module,
                ]);
            }

            if ($model_qualifications->nextstep == '') {
                if ($model_qualifications->load(Yii::$app->request->post()) && $model_qualifications->validate()) {
                    NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptQualify");

                    $url = Yii::$app->params['Nixxis_Url'];

                    $NixxisDirectLink = new \app\scripts\Artisans\v1\models\NixxisDirectLink($url, $NixxisParameters->sessionid);
                    $NixxisDirectLink->setContactid($NixxisParameters->contactid);
                    $NixxisDirectLink->setContactlistid($NixxisParameters->diallerReference);

                    $NixxisDirectLink->setInternalId();
                    $NixxisDirectLink->setQualification($model_qualifications->qualificationId, $model_qualifications->getCallbackNixxisformat(), $model_qualifications->callbackPhone);

                    return $this->render('last', [
                                'model' => $model,
                                'Script' => $Script,
                                'NixxisParameters' => $NixxisParameters,
                                'NixxisQualifications' => $model_qualifications,
                                'Module' => $this->module,
                    ]);
                }
            } else {
                //$model->scenario = 'RO';
                return $this->render('qualifications', [
                            'model' => $model,
                            'Script' => $Script,
                            'NixxisParameters' => $NixxisParameters,
                            'model_qualifications' => $model_qualifications,
                            'NixxisQualifications' => $this->NixxisQualifications,
                            'Module' => $this->module,
                ]);
            }
        }
        $model->scenario = 'default';


        return $this->render('index', [
                    'model' => $model,
                    'model_qualifications' => $model_qualifications,
                    'NixxisParameters' => $NixxisParameters,
                    'Script' => $Script,
                    'NixxisQualifications' => $this->NixxisQualifications,
                    'Module' => $this->module,
        ]);
    }

    public function actionQualify($Internal__id__) {
        $start = microtime(true);
        $model = $this->findModel($Internal__id__);
        $Script = Yii::$app->session->get('Script');
        $model_qualifications = new NixxisQualifications();
        $model_qualifications->load(Yii::$app->request->post());

        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');

        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        $this->AffectScenario($model_qualifications->qualificationId, $model, $model_qualifications);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model_qualifications->load(Yii::$app->request->post()) && $model_qualifications->validate()) {
                NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptQualify");

                $url = Yii::$app->params['Nixxis_Url'];

                $NixxisDirectLink = new \app\scripts\Artisans\v1\models\NixxisDirectLink($url, $NixxisParameters->sessionid);
                $NixxisDirectLink->setContactid($NixxisParameters->contactid);
                $NixxisDirectLink->setContactlistid($NixxisParameters->diallerReference);

                echo $NixxisDirectLink->setInternalId();
                echo $NixxisDirectLink->setQualification($model_qualifications->qualificationId, $model_qualifications->getCallbackNixxisformat(), $model_qualifications->callbackPhone);


                return $this->render('last', [
                            'model' => $model,
                            'Script' => $Script,
                            'NixxisParameters' => $NixxisParameters,
                            'NixxisQualifications' => $model_qualifications,
                ]);
            }
        }
    }

    protected function findModel($Internal__id__) {
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        // Compute the model class name with the CampaignId
        if (!$NixxisParameters instanceof NixxisParameters) {
            die('Session timeout');
        }


        $modelclass = str_replace("/", "\\", dirname(str_replace("\\", "/", __NAMESPACE__))) . '\models\DATA' . ucfirst($NixxisParameters->diallerCampaign);
        $model = $modelclass::findOne(['Internal__id__' => $Internal__id__]);
        // Check if $model instance of modelclass
        // ie check if we can found a contact with the Internal__Id__ provided        
        if (!$model instanceof $modelclass) {
            die('Contact not found');
        }
        return $model;
    }

}
