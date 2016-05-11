<?php

namespace app\scripts\GREENPEACE_REACTIVATION_CYCLE3\v1\controllers;

use Yii;
use app\models\NixxisParameters;
use app\models\NixxisQualifications;
use app\components\NrtLogger;

class DefaultController extends \app\controllers\ScriptController {

    private function AffectScenario($NixxisQualificationId, &$model, &$model_qualifications) {
        /* @var $model \app\scripts\GREENPEACE_REACTIVATION_CYCLE3\v1\models\DATAae19af13398c4a2d98dbe1b0404b309a */
        /* @var $model_qualifications \app\models\NixxisQualifications */

        switch ($NixxisQualificationId) {
            case '7e2e2085371d4864986261b5cd15d129': //PA 
                $model->scenario = 'PA';
                $model_qualifications->nextstep = 'qualifications';
                break;

            case 'e619d0b5ccc9409487dda77ba3e4263d' ://PA EN LIGNE
                $model->scenario = 'PA';
                $model_qualifications->nextstep = 'qualifications';

                break;
            case 'd1d0aaf2930b4f428f59ceb23cf65010' ://PA SLIMPAY
                $model->scenario = 'PA';
                $model_qualifications->nextstep = 'qualifications';

                break;

            case '781c3cd2142449a3864a92453b0bcfd7' ://PA SANS MONTANT
                break;

            case '474646634bc04ac1bf47ef80398a830b': // DU SANS MONTANT
                break;
            case 'c5f9bd5bfa68436b9e36994d66a50166': // DU
                $model->scenario = 'DU';
                $model_qualifications->nextstep = 'qualifications';

                break;
            case '1643eb48011d4f1b88ed8eb8cb216982': // DU EN LIGNE
                $model->scenario = 'DU';
                $model_qualifications->nextstep = 'qualifications';

                break;
        }

        if ($this->NixxisQualifications[$NixxisQualificationId]['Description'] == 'A rappeler') {
            $model_qualifications->scenario = 'CALLBACK';
        }
    }

    public function actionIndex() {
        /* @var $model \app\scripts\GREENPEACE_REACTIVATION_CYCLE3\v1\models\DATAae19af13398c4a2d98dbe1b0404b309a */
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
        /* @var $model \app\scripts\GREENPEACE_REACTIVATION_CYCLE3\v1\models\DATAae19af13398c4a2d98dbe1b0404b309a */
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
        /* @var $model \app\scripts\GREENPEACE_REACTIVATION_CYCLE3\v1\models\DATAae19af13398c4a2d98dbe1b0404b309a */
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
