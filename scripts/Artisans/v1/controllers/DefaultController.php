<?php

namespace app\scripts\Artisans\v1\controllers;

use Yii;
use yii\web\Controller;
use app\models\NixxisParameters;
use app\models\NixxisQualifications;
use app\components\NrtLogger;

class DefaultController extends Controller {

    private $NixxisQualifications = array();

    private function AffectScenario($NixxisQualificationId, &$model, &$model_qualifications) {
        /* @var $model \app\models\Campaigns\DATA76b3ff146f6c4802b727bb3042493043 */

        switch ($NixxisQualificationId) {
            case 'c9a8a6d71bc94dd5a899a80766e161c8': //PA
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

        NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptIndex");
        return $this->render('index', [
                    'model' => $model,
                    'NixxisParameters' => $NixxisParameters,
                    'Script' => $Script,
                    'model_qualifications' => $model_qualifications,
                    'NixxisQualifications' => $this->NixxisQualifications,
                    'Module' => $this->module,
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
                        $WS = new \app\scripts\Artisans\v1\models\SM_CreateSP('fr', 'dev');
                        //$WS = new \app\scripts\Artisans\v1\models\SM_CreateSP('fr');
                        //print_r($model::getFirstAvailable(array($model->TEL1, $model->TEL2, $model->TEL3)));

                        if ($model->IDENTIFIANT2 == '') {


                            if ($model->CODE_MEDIA == 'CIELS_DIRECT') {
                                $auth = array(
                                    'sm_kwids' =>
                                    array(
                                        0 => 1011661607,
                                    ),
                                    'sm_token' => '+/QOxWAIXKFeoZWdDciFtpavO49Mod57D+uIeX1qBZw=',
                                    'sm_aff_id' => '1372',
                                    'sm_spa_accept' => 0,
                                );
                            } else {
                                $auth = array(
                                    'sm_kwids' =>
                                    array(
                                        0 => 1008299387,
                                    ),
                                    'sm_token' => 'aDOFCgx2Ii6xMNis+sICuIjysalY2oKCMAcdNZhC4Mc=',
                                    'sm_aff_id' => '985',
                                    'sm_spa_accept' => 1,
                                );
                            }



                            $data = array(0 => array(
                                    'sp_id_worktype' => $model->_ACTIVITE1,
                                    'sp_pc' => $model->CP,
                                    'sp_company_name' => $model->RS1,
                                    'sp_title' => $model->CIV,
                                    'sp_first_name' => $model->PRENOM,
                                    'sp_last_name' => $model->NOM,
                                    'sp_phone' => $model::getFirstAvailable(array($model->TEL1, $model->TEL2, $model->TEL3)),
                                    'sp_email' => $model::getFirstAvailable(array($model->EMAIL1, $model->EMAIL2)),
                                    'sp_aff_track' => $model->Internal__id__
                            ));

                            foreach ($data as $sp) {
                                $res = $WS->newSP($auth['sm_aff_id'], $auth['sm_token'], $auth['sm_kwids'][0], $sp); //On transmet chaque prospect
                                print_r($res);
                                if (isset($res['body'])) {
                                    $tmp = json_decode($res['body']);
                                    if (isset($tmp->track_id)) {
                                        $model->IDENTIFIANT2 = (string) $tmp->track_id;
                                        $model->save();
                                    }
                                }
                            }
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

    protected function findModel($Internal__id__) {
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        // Compute the model class name with the CampaignId



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
