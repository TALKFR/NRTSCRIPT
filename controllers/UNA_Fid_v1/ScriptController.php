<?php

namespace app\controllers\UNA_Fid_v1;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\data\ActiveDataProvider;
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

//return $this->redirect(array($Script['ControllerDirectory'] . '_v' . $Script['Version'] . '/script/' . 'index', 'nocache' => uniqid(), 'sessionid' => Yii::$app->session->id), 302);
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
        return $this->render('UNA_Fid_v' . $Script['Version'] . '/index', [
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
            case '52118127c7b6409da7d3adda64573fb5': //PA
                $model->N_DATEPA_DAY = '01';
                $model->N_DATEPA_YEAR = Date('Y');
                $model->scenario = 'PA';
                break;
            case '63085e8fb23a4c5aaf2e409c0696c4a3' ://PAM
                $model->N_DATEPA_DAY = '01';
                $model->N_DATEPA_YEAR = Date('Y');
                $model->scenario = 'PAM';
                break;
            case '3d3f3024cde74f9fa1c5ee7fbf7c18f5' ://PAM SLIMPAY
                $model->scenario = 'PAM SLIMPAY';
                break;

            case '9ba6ba9b2b9a498a97829d051119af44': // DS
//                $model->scenario = 'DS';
                break;
            case 'ff36d463b2d34ecb947c058cdc46be02': // DSM
                $model->scenario = 'DSM/DSM EN LIGNE';
                break;
            case 'b71c97f6792d4da1bb5e98f6fae3f37d': // DSM EN LIGNE
                $model->scenario = 'DSM/DSM EN LIGNE';
                break;
            case '11e09f316e4c49a3ae406a65a0b80cdf': // A RAPPLER
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
            return $this->render('UNA_Fid_v' . $Script['Version'] . '/qualifications', [
                        'model' => $model,
                        'model_qualifications' => $model_qualifications,
                        'NixxisParameters' => $NixxisParameters,
                        'Script' => $Script,
                        'NixxisQualifications' => $this->NixxisQualifications,
            ]);
        } else {
            NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptGoto");
            return $this->render('UNA_Fid_v' . $Script['Version'] . '/index', [
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
                //$this->AffectScenario($model_qualifications->qualificationId, $model, $model_qualifications);
                NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptQualify");
                return $this->render('last', [
                            'model' => $model,
                            'Script' => $Script,
                            'NixxisParameters' => $NixxisParameters,
                            'NixxisQualifications' => $model_qualifications,
                ]);
            } else {
                //$this->AffectScenario($model_qualifications->qualificationId, $model, $model_qualifications);
                NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "Model Qualification validate error");
                return $this->render('UNA_Fid_v' . $Script['Version'] . '/qualifications', [
                            'model' => $model,
                            'model_qualifications' => $model_qualifications,
                            'NixxisParameters' => $NixxisParameters,
                            'Script' => $Script,
                            'NixxisQualifications' => $this->NixxisQualifications,
                ]);
            }
        } else {
//            print_r($model->getErrors());
//            die("can't save model ");
            //$this->AffectScenario($model_qualifications->qualificationId, $model, $model_qualifications);
            NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "Model validate error");
            return $this->render('UNA_Fid_v' . $Script['Version'] . '/qualifications', [
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
