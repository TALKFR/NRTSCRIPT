<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\NixxisParameters;
use app\models\NixxisAffectations;
use app\components\NixxisV2;
use app\components\NrtLogger;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        $start = microtime(true);


        $NixxisParameters = new NixxisParameters();
        $NixxisParameters->diallerCampaign = filter_input(INPUT_GET, 'diallerCampaign');
        $NixxisParameters->diallerActivity = filter_input(INPUT_GET, 'diallerActivity');
        $NixxisParameters->contactid = filter_input(INPUT_GET, 'contactid');
        $NixxisParameters->diallerReference = filter_input(INPUT_GET, 'diallerReference');
        $NixxisParameters->autosearch = filter_input(INPUT_GET, 'autosearch');
        $NixxisParameters->sessionid = filter_input(INPUT_GET, 'sessionid');

        if (Yii::$app->session->isActive) {
            Yii::$app->session->destroy();
        }

        if ($NixxisParameters->validate()) {
            $script = null;
            foreach (Yii::$app->params['affects']['Scripts'] as $affectsscript) {
                if (isset($affectsscript['Activities']) && is_array($affectsscript['Activities'])) {
                    foreach ($affectsscript['Activities'] as $key => $activityid) {
                        if ($activityid == $NixxisParameters->diallerActivity) {
                            $script = $affectsscript;
                            break;
                        }
                    }
                }
                if ($script !== null)
                    break;
            }

            if ($script === null) {
                die(htmlentities("Pas d'affecation pour l'activité :" . $NixxisParameters->diallerActivity));
            }


            $NixxisAffectations = new NixxisAffectations();

            $NixxisAffectations->load(array('NixxisAffectations' => $script));

            if (!$NixxisAffectations->validate()) {
                echo htmlentities((print_r($NixxisAffectations->errors, true)));
                die(htmlentities("Erreur dans le paramètrage de l'affectation"));
            }
            if ($NixxisAffectations->ControllerStart == 'search') {
                $NixxisAffectations->scenario = 'INCOMING';
            }

            if (!$NixxisAffectations->validate()) {
                echo htmlentities((print_r($NixxisAffectations->errors, true)));
                die(htmlentities("Erreur dans le paramètrage de l'affectation"));
            }

            Yii::$app->session->set('NixxisParameters', $NixxisParameters);
            Yii::$app->session->set('NixxisQualifications', $this->GetQualification($NixxisParameters->diallerActivity));
            Yii::$app->session->set('Script', $script);


            NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $script, (microtime(true) - $start), "SiteController");

            return $this->redirect(array($script['ControllerDirectory'] . '_v' . $script['Version'] . '/script/' . $script['ControllerStart'],), 302);
        } else {
            print_r($NixxisParameters->errors);
            die('NixxisParameters validate error');
        }
    }

    private function GetQualification($ActivityId) {
        $start = microtime(true);
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');

        $Script = Yii::$app->session->get('Script');

        $Nixxis = new NixxisV2();
        $Nixxis->setAppServer(Yii::$app->params['Nixxis_IP']);
        $Nixxis->setDb(Yii::$app->params['Nixxis_Bdd']);
        $Nixxis->setUsername(Yii::$app->params['Nixxis_User']);
        $Nixxis->setPassword(Yii::$app->params['Nixxis_Password']);
        $Nixxis->setContextDataUrl(Yii::$app->params['Nixxis_ContextDataUrl']);

        $Nixxis->ConnectSqlServer();

        $NixxisQualifications = $Nixxis->ContextData_GetNixxisQualifications($ActivityId);


        NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "SiteGetQualifications");
        return $NixxisQualifications;
    }

}
