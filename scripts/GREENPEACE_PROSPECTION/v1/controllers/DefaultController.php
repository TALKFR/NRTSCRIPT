<?php

namespace app\scripts\GREENPEACE_PROSPECTION\v1\controllers;

use Yii;
use app\models\NixxisParameters;
use app\models\NixxisQualifications;
use app\components\NrtLogger;

class DefaultController extends \app\controllers\ScriptController {

    private function AffectScenario($NixxisQualificationId, &$model, &$model_qualifications) {
        /* @var $model \app\scripts\GREENPEACE_PROSPECTION\v1\models\DATA0c5a06ab03ac4d389f6fc888237ee638 */
        /* @var $model_qualifications \app\models\NixxisQualifications */

        switch ($NixxisQualificationId) {
            case '2a2a61b15e15497e9c1de46a53efaa38': //PA 
                $model->scenario = 'PA';
                $model_qualifications->nextstep = 'qualifications';
                break;

            case '800c1d1e29844ba684f66fdcd9798b34' ://PA EN LIGNE
                $model->scenario = 'PA';
                $model_qualifications->nextstep = 'qualifications';

                break;
            case '92953ccf506b4dd9bbff0e24dccc5d2e' ://PA SLIMPAY
                $model->scenario = 'PA';
                $model_qualifications->nextstep = 'qualifications';

                break;

            case '0809752ec13d42af8b19f7005a5129df' ://PA SANS MONTANT
                break;

            case 'de32af4490d7464e969e6a26b2524ef9': // DU SANS MONTANT
                break;
            case '97b1bdbc0c4c47cd89d1f903f2d592c4': // DU
                $model_qualifications->nextstep = 'qualifications';

                $model->scenario = 'DU';
                break;
            case '6d3c9af6f9634c29937300e66c6b8bad': // DU EN LIGNE
                $model_qualifications->nextstep = 'qualifications';

                $model->scenario = 'DU';
                break;
        }

        if ($this->NixxisQualifications[$NixxisQualificationId]['Description'] == 'A rappeler') {
            $model_qualifications->scenario = 'CALLBACK';
        }
    }

    public function actionIndex() {
        /* @var $model \app\scripts\GREENPEACE_PROSPECTION\v1\models\DATA0c5a06ab03ac4d389f6fc888237ee638 */
        /* @var $model_qualifications \app\models\NixxisQualifications */

        $start = microtime(true);
        $model_qualifications = new NixxisQualifications();
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        if (!$NixxisParameters instanceof NixxisParameters) {
            die('Session Error');
        }
        $model = $this->findModel($NixxisParameters->diallerReference);
        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');

        NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $this->module, (microtime(true) - $start), "ScriptIndex");
        return $this->render('index', [
                    'model' => $model,
                    'NixxisParameters' => $NixxisParameters,
                    'model_qualifications' => $model_qualifications,
                    'NixxisQualifications' => $this->NixxisQualifications,
                    'Module' => $this->module,
        ]);
    }

    public function actionStep2($Internal__id__) {
        /* @var $model \app\scripts\GREENPEACE_PROSPECTION\v1\models\DATA0c5a06ab03ac4d389f6fc888237ee638 */
        /* @var $model_qualifications \app\models\NixxisQualifications */

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
                            'NixxisQualifications' => $this->NixxisQualifications,
                            'Module' => $this->module,
                ]);
            }

            if ($model_qualifications->nextstep == '') {
                if ($model_qualifications->load(Yii::$app->request->post()) && $model_qualifications->validate()) {
                    NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $this->module, (microtime(true) - $start), "ScriptQualify");

                    $NixxisDirectLink = new \app\components\NixxisDirectLink(Yii::$app->params['Nixxis_Url'], $NixxisParameters->sessionid);
                    $NixxisDirectLink->setContactid($NixxisParameters->contactid);
                    $NixxisDirectLink->setContactlistid($NixxisParameters->diallerReference);
                    $NixxisDirectLink->setInternalId();
                    $NixxisDirectLink->setQualification($model_qualifications->qualificationId, $model_qualifications->getCallbackNixxisformat(), $model_qualifications->callbackPhone);

                    return $this->render('last', [
                                'model' => $model,
                                'Module' => $this->module,
                                'NixxisParameters' => $NixxisParameters,
                                'NixxisQualifications' => $model_qualifications,
                                'Module' => $this->module,
                    ]);
                }
            } else {
                return $this->render($model_qualifications->nextstep, [
                            'model' => $model,
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
                    'NixxisQualifications' => $this->NixxisQualifications,
                    'Module' => $this->module,
        ]);
    }

    public function actionQualify($Internal__id__) {
        /* @var $model \app\scripts\GREENPEACE_PROSPECTION\v1\models\DATA0c5a06ab03ac4d389f6fc888237ee638 */
        /* @var $model_qualifications \app\models\NixxisQualifications */

        $start = microtime(true);
        $model = $this->findModel($Internal__id__);
        $model_qualifications = new NixxisQualifications();
        $model_qualifications->load(Yii::$app->request->post());

        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');

        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        $this->AffectScenario($model_qualifications->qualificationId, $model, $model_qualifications);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model_qualifications->load(Yii::$app->request->post()) && $model_qualifications->validate()) {
                NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $this->module, (microtime(true) - $start), "ScriptQualify");

                $NixxisDirectLink = new \app\components\NixxisDirectLink(Yii::$app->params['Nixxis_Url'], $NixxisParameters->sessionid);
                $NixxisDirectLink->setContactid($NixxisParameters->contactid);
                $NixxisDirectLink->setContactlistid($NixxisParameters->diallerReference);
                $NixxisDirectLink->setInternalId();
                $NixxisDirectLink->setQualification($model_qualifications->qualificationId, $model_qualifications->getCallbackNixxisformat(), $model_qualifications->callbackPhone);


                return $this->render('last', [
                            'model' => $model,
                            'Module' => $this->module,
                            'NixxisParameters' => $NixxisParameters,
                            'NixxisQualifications' => $model_qualifications,
                ]);
            }
        } else {

            return $this->render(($model_qualifications->nextstep != '' ? $model_qualifications->nextstep : 'index'), [
                        'model' => $model,
                        'model_qualifications' => $model_qualifications,
                        'NixxisParameters' => $NixxisParameters,
                        'NixxisQualifications' => $this->NixxisQualifications,
                        'Module' => $this->module,
            ]);
        }
    }

}
