<?php

namespace app\scripts\Travaux\v1\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\NixxisParameters;
use app\models\NixxisQualifications;
use app\components\NrtLogger;
use app\scripts\Travaux\v1\models\SM_ListActivities;
use app\scripts\Travaux\v1\models\GenForm;
use app\scripts\Travaux\v1\models\Leads;

class DefaultController extends \app\controllers\ScriptController {

    // private $NixxisQualifications = array();

    private function AffectScenario($NixxisQualificationId, &$model, &$model_qualifications) {
        /* @var $model \app\models\Campaigns\DATA76b3ff146f6c4802b727bb3042493043 */

        switch ($NixxisQualificationId) {
            case 'bec202e519964fb7a02c0272fa9f3724': //PA
                $model->scenario = 'FIN';
                break;
        }

        if ($this->NixxisQualifications[$NixxisQualificationId]['Description'] == 'A RAPPELER') {
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



        $dataProvider = Leads::find()->where(['nixxisid' => $NixxisParameters->diallerReference])->all();
        NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptIndex");
        return $this->render('index', [
                    'model' => $model,
                    'NixxisParameters' => $NixxisParameters,
                    'Script' => $Script,
                    'model_qualifications' => $model_qualifications,
                    'NixxisQualifications' => $this->NixxisQualifications,
                    'Module' => $this->module,
                    'Leads' => $dataProvider
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
        $dataProvider = Leads::find()->where(['nixxisid' => $NixxisParameters->diallerReference])->all();

        if ($model_qualifications->qualificationId == '1234') {
            $model->scenario = 'ADDNEED';
            $model->load(Yii::$app->request->post());

            if ($model->_PAS_D_EMAIL == true) {

                $model->EMAIL1 = strtolower($model->NOM);
                if ($model->PRENOM <> '') {
                    $model->EMAIL1 .= '.' . strtolower($model->PRENOM);
                }
                $model->EMAIL1 .= '@gmail.com';
                $model->EMAIL1 = str_replace(' ', '', $model->EMAIL1);
                $model->EMAIL1 = filter_var($model->EMAIL1, FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_LOW);
            }

            if ($model->save()) {
                return $this->redirect(array("/Scripts/Travaux/wish-list", 'Internal__id__' => $Internal__id__));
            } else {

                $model->scenario = 'default';
                return $this->render('index', [
                            'model' => $model,
                            'NixxisParameters' => $NixxisParameters,
                            'Script' => $Script,
                            'model_qualifications' => $model_qualifications,
                            'NixxisQualifications' => $this->NixxisQualifications,
                            'Module' => $this->module,
                            'Leads' => $dataProvider
                ]);
            }
        }


        $this->AffectScenario($model_qualifications->qualificationId, $model, $model_qualifications);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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


                    if ($model->scenario == 'FIN') {
                        if (Leads::find()->where(['nixxisid' => $NixxisParameters->diallerReference])->count() == 0) {
                            $model->scenario = 'default';

                            return $this->render('index', [
                                        'model' => $model,
                                        'model_qualifications' => $model_qualifications,
                                        'NixxisParameters' => $NixxisParameters,
                                        'Script' => $Script,
                                        'NixxisQualifications' => $this->NixxisQualifications,
                                        'Module' => $this->module,
                                        'Leads' => $dataProvider
                            ]);
                        }
                    }


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

//    protected function findModel($Internal__id__) {
//        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
//        // Compute the model class name with the CampaignId
//        if (!$NixxisParameters instanceof NixxisParameters) {
//            die('Session timeout');
//        }
//
//
//        $modelclass = str_replace("/", "\\", dirname(str_replace("\\", "/", __NAMESPACE__))) . '\models\DATA' . ucfirst($NixxisParameters->diallerCampaign);
//        $model = $modelclass::findOne(['Internal__id__' => $Internal__id__]);
//        // Check if $model instance of modelclass
//        // ie check if we can found a contact with the Internal__Id__ provided        
//        if (!$model instanceof $modelclass) {
//            die('Contact not found');
//        }
//        return $model;
//    }
}
