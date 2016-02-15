<?php

namespace app\controllers\GP_Leads_v1;

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
        return $this->render('GP_Leads_v' . $Script['Version'] . '/index', [
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
            case '2fff61b8e2c44da89d53389c43dd18c4': //PA 
                $model->scenario = 'PA';
                break;

            case '081a8b79c68e46e58a9e7abafb827c2d' ://PA EN LIGNE
                $model->scenario = 'PA';
                break;
            case 'c3340d674d774d87abd8c08ec602a446' ://PA SLIMPAY
                $model->scenario = 'PA';
                break;

            case 'f1d1b79fdd904805b0338abfdf411e1a' ://PA SANS MONTANT

                break;

            case 'd373710ed657468683991c04dc34acbe': // DU SANS MONTANT
                break;
            case '6d2213614d4348738fef8368cd6f076e': // DU
                $model->scenario = 'DU';
                break;
            case '7ab44e4b353643a9b199e32012caa9ea': // DU EN LIGNE
                $model->scenario = 'DU';
                break;
            case 'ee016d743a0e4b58b1cc6ab2d37a0da9': // A RAPPLER
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
            return $this->render('GP_Leads_v' . $Script['Version'] . '/qualifications', [
                        'model' => $model,
                        'model_qualifications' => $model_qualifications,
                        'NixxisParameters' => $NixxisParameters,
                        'Script' => $Script,
                        'NixxisQualifications' => $this->NixxisQualifications,
            ]);
        } else {
            NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "Goto Model validate error");
            return $this->render('GP_Leads_v' . $Script['Version'] . '/index', [
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
                return $this->render('last', [
                            'model' => $model,
                            'Script' => $Script,
                            'NixxisParameters' => $NixxisParameters,
                            'NixxisQualifications' => $model_qualifications,
                ]);
            } else {
                NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "Qualify Model Qualification validate error");
                return $this->render('GP_Leads_v' . $Script['Version'] . '/qualifications', [
                            'model' => $model,
                            'model_qualifications' => $model_qualifications,
                            'NixxisParameters' => $NixxisParameters,
                            'Script' => $Script,
                            'NixxisQualifications' => $this->NixxisQualifications,
                ]);
            }
        } else {
            NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "Qualify Model validate error");
            return $this->render('GP_Leads_v' . $Script['Version'] . '/qualifications', [
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
