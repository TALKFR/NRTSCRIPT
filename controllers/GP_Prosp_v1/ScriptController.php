<?php

namespace app\controllers\GP_Prosp_v1;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use \yii\web\Response;
use app\models\NixxisParameters;
use app\models\NixxisQualifications;
use app\components\NrtLogger;

/* @var $model \app\models\Campaigns\DATA76b3ff146f6c4802b727bb3042493043 */

class ScriptController extends Controller {

    private $NixxisQualifications = array();

    public function getViewPath() {
        return Yii::getAlias('@app/views/script');
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionSelect($id) {
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        $Script = Yii::$app->session->get('Script');

        if (!$NixxisParameters instanceof NixxisParameters) {
            die('Session Error');
        }

        $NixxisParameters->diallerReference = $id;
        Yii::$app->session->set('NixxisParameters', $NixxisParameters);

        return $this->redirect(array($Script['ControllerDirectory'] . '_v' . $Script['Version'] . '/script/' . 'index'), 302);
    }

    public function actionIndex() {
        $start = microtime(true);
        $model_qualifications = new NixxisQualifications();
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');

        $Script = Yii::$app->session->get('Script');

        if (!$NixxisParameters instanceof NixxisParameters) {
            die('Session Error');
        }


        $modelclass = 'app\models\Campaigns\DATA' . ucfirst($NixxisParameters->diallerCampaign);

        $model = $modelclass::findOne(['Internal__id__' => $NixxisParameters->diallerReference]);


        Yii::$app->session->set('NixxisParameters', $NixxisParameters);


        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');

        if ($model->GetSystemData()->LastQualification != '' && $NixxisParameters->ActivityType == $NixxisParameters::ACT_INBOUND) {
            $model->scenario = 'RO';
        }

        NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptIndex");
        return $this->render('GP_Prosp_v' . $Script['Version'] . '/index', [
                    'model' => $model,
                    'NixxisParameters' => $NixxisParameters,
                    'Script' => $Script,
                    'model_qualifications' => $model_qualifications,
                    'NixxisQualifications' => $this->NixxisQualifications,
        ]);
    }

    private function AffectScenario($NixxisQualificationId, &$model, &$model_qualifications) {
        /* @var $model \app\models\Campaigns\DATA76b3ff146f6c4802b727bb3042493043 */

        switch ($NixxisQualificationId) {
            case '2a2a61b15e15497e9c1de46a53efaa38': //PA 
                $model->scenario = 'PA';
                break;

            case '800c1d1e29844ba684f66fdcd9798b34' ://PA EN LIGNE
                $model->scenario = 'PA';
                break;
            case '92953ccf506b4dd9bbff0e24dccc5d2e' ://PA SLIMPAY
                $model->scenario = 'PA';
                break;

            case '0809752ec13d42af8b19f7005a5129df' ://PA SANS MONTANT
                break;

            case 'de32af4490d7464e969e6a26b2524ef9': // DU SANS MONTANT
                break;
            case '97b1bdbc0c4c47cd89d1f903f2d592c4': // DU
                $model->scenario = 'DU';
                break;
            case '6d3c9af6f9634c29937300e66c6b8bad': // DU EN LIGNE
                $model->scenario = 'DU';
                break;
            case '61a58b00384d4b20822c9b644d8d1f5c': // A RAPPLER
                $model_qualifications->scenario = 'CALLBACK';
                break;
        }
    }

    public function actionGoto($Internal__id__) {
        $start = microtime(true);
        $model = $this->findModel($Internal__id__);
        $Script = Yii::$app->session->get('Script');

        $model_qualifications = new NixxisQualifications();
        $model_qualifications->load(Yii::$app->request->post());

        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->AffectScenario($model_qualifications->qualificationId, $model, $model_qualifications);
            NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptGoto");
            return $this->render('GP_Prosp_v' . $Script['Version'] . '/qualifications', [
                        'model' => $model,
                        'model_qualifications' => $model_qualifications,
                        'NixxisParameters' => $NixxisParameters,
                        'Script' => $Script,
                        'NixxisQualifications' => $this->NixxisQualifications,
            ]);
        } else {
            NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "Goto Model validate error");
            return $this->render('GP_Prosp_v' . $Script['Version'] . '/index', [
                        'model' => $model,
                        'model_qualifications' => $model_qualifications,
                        'NixxisParameters' => $NixxisParameters,
                        'Script' => $Script,
                        'NixxisQualifications' => $this->NixxisQualifications,
            ]);
        }
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

                $NixxisDirectLink = new \app\models\NixxisDirectLink($url, $NixxisParameters->sessionid);
                $NixxisDirectLink->setContactid($NixxisParameters->contactid);
                $NixxisDirectLink->setContactlistid($NixxisParameters->diallerReference);

                $NixxisDirectLink->setInternalId();
                $NixxisDirectLink->setQualification($model_qualifications->qualificationId, $model_qualifications->getCallbackNixxisformat(), $model_qualifications->callbackPhone);

//                print_r($NixxisDirectLink);
//
//                exit(0);
                return $this->render('GP_Prosp_v' . $Script['Version'] . '/last', [
                            'model' => $model,
                            'Script' => $Script,
                            'NixxisParameters' => $NixxisParameters,
                            'NixxisQualifications' => $model_qualifications,
                ]);
            } else {
                NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "Qualify Model Qualification validate error");
                return $this->render('GP_Prosp_v' . $Script['Version'] . '/qualifications', [
                            'model' => $model,
                            'model_qualifications' => $model_qualifications,
                            'NixxisParameters' => $NixxisParameters,
                            'Script' => $Script,
                            'NixxisQualifications' => $this->NixxisQualifications,
                ]);
            }
        } else {
            NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "Qualify Model validate error");
            return $this->render('GP_Prosp_v' . $Script['Version'] . '/qualifications', [
                        'model' => $model,
                        'model_qualifications' => $model_qualifications,
                        'NixxisParameters' => $NixxisParameters,
                        'Script' => $Script,
                        'NixxisQualifications' => $this->NixxisQualifications,
            ]);
        }
    }

    public function actionGetProchainpa($day) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data_month = \app\models\Campaigns\DATA76b3ff146f6c4802b727bb3042493043::GetMonthProchainPA($day);
        $daya_year = \app\models\Campaigns\DATA76b3ff146f6c4802b727bb3042493043::GetYearProchainPA($day);

        return array('month' => $data_month, 'year' => $daya_year);
    }

    protected function findModel($id) {
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        $modelclass = 'app\models\Campaigns\DATA' . ucfirst($NixxisParameters->diallerCampaign);
        if (($model = $modelclass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
