<?php

namespace app\controllers\UNA_Fid_v1;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\NixxisParameters;
use app\models\NixxisQualifications;
use app\components\NrtLogger;

/* @var $model \app\models\Campaigns\DATA4307f92b371f4d918b0d30be75048ef4 */

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
        switch ($NixxisQualificationId) {
            case '52118127c7b6409da7d3adda64573fb5': //PA
                $model->scenario = 'PA';
                break;
            case '63085e8fb23a4c5aaf2e409c0696c4a3' ://PAM
                $model->scenario = 'PAM/PAM SLIMPAY';
                break;
            case '3d3f3024cde74f9fa1c5ee7fbf7c18f5' ://PAM SLIMPAY
                $model->scenario = 'PAM/PAM SLIMPAY';
                break;

            case '9ba6ba9b2b9a498a97829d051119af44': // DS
                $model->scenario = 'DS';
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


//            case 'f888544daee64f44af2fde31233740a0':
//                $model->N_DATEPA = $model->GetProchainPA();
//                $model->scenario = 'AUGPA';
//                break;
//            case '4d784672223947488055251ae149d5d1':
//                $model->scenario = 'DSM';
//                break;
//            case '469eba39d8984e308e6aec841cb3752a':
//                $model->scenario = 'DSM';
//                break;
//            case '81f38eb61c444a36ae6f90fe478291ca':
//                $model_qualifications->scenario = 'CALLBACK';
//                break;
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
                $this->AffectScenario($model_qualifications->qualificationId, $model, $model_qualifications);
                NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptQualify");
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
            return $this->render('UNA_Fid_v' . $Script['Version'] . '/qualifications', [
                        'model' => $model,
                        'model_qualifications' => $model_qualifications,
                        'NixxisParameters' => $NixxisParameters,
                        'Script' => $Script,
                        'NixxisQualifications' => $this->NixxisQualifications,
            ]);
        }
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
