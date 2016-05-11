<?php

namespace app\scripts\LCDE_UPGRADE\v1\controllers;

use Yii;
use app\models\NixxisParameters;
use app\models\NixxisQualifications;
use app\components\NrtLogger;
use app\components\Email;

class DefaultController extends \app\controllers\ScriptController {

    private function AffectScenario($NixxisQualificationId, &$model, &$model_qualifications) {
        /* @var $model \app\scripts\LCDE_UPGRADE\v1\models\DATA29270ed61ca441e484431aaae9cd7e4b */
        /* @var $model_qualifications \app\models\NixxisQualifications */

        switch ($NixxisQualificationId) {
            case '5d5e537ba40e44eabc9b040aa4ac3939': //COURRIER
                $model->scenario = 'AUGPAM';
                $model_qualifications->nextstep = 'qualifications';
                break;
            case 'fe34e2235fd84bd49e4c9cdd7b57a080': //EMAIL
                $model->scenario = 'AUGPAMEMAIL';
                $model_qualifications->nextstep = 'qualifications';

                break;
            case '5e3051e9dfc848b08a34728720cb2db0': //CHANGEMENT BANQUE
                $model->scenario = 'AUGPAM';
                $model_qualifications->nextstep = 'qualifications';

                break;
            case '25d5e056a0544a77bb6a929e63a01e67':
                $model->scenario = 'DSM';
                $model_qualifications->nextstep = 'qualifications';

                break;
            case 'dbe2c53393ff49078af200c1d871d6db':
                $model->scenario = 'DSMENLIGNE';
                $model_qualifications->nextstep = 'qualifications';

                break;
        }

        if ($this->NixxisQualifications[$NixxisQualificationId]['Description'] == 'A RAPPELER') {
            $model_qualifications->scenario = 'CALLBACK';
        }
    }

    public function actionIndex() {
        /* @var $model \app\scripts\LCDE_UPGRADE\v1\models\DATA29270ed61ca441e484431aaae9cd7e4b */
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
        /* @var $model \app\scripts\LCDE_UPGRADE\v1\models\DATA29270ed61ca441e484431aaae9cd7e4b */
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
        /* @var $model \app\scripts\LCDE_UPGRADE\v1\models\DATA29270ed61ca441e484431aaae9cd7e4b */
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

                if ($model_qualifications->qualificationId == 'fe34e2235fd84bd49e4c9cdd7b57a080') {
                    $Email = new Email();

                    $Email->setSubject("La Chaîne de l’Espoir - Confirmation de l’augmentation de votre prélèvement automatique");
                    $Email->setFrom_email('servicedonateurs@chainedelespoir.org');
                    $Email->setFrom_name("La Chaîne de l'Espoir");

                    $tmp = array();
                    $tmp[] = $model->EMAIL1;
                    $tmp[] = $model->EMAIL2;
                    $Email->setRecipient(\app\models\Nixxis\Data::getFirstAvailable($tmp));
                    $Email->Send('ChaineUpgrade', $model, $this->module->getBasePath() . '/v' . $this->module->version . '/mail');
                }

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
