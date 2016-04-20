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

//http://10.100.30.110/nrtscriptdev/web/index.php?diallerCampaign={9}&diallerActivity={2}&contactid={1}&diallerReference={6}&autosearch={3}&sessionid={8}
// http://10.100.30.110/nrtscriptdev/web/index.php?diallerCampaign=4307f92b371f4d918b0d30be75048ef4&diallerActivity=f03aca45b54241259a62041b676fdb8a&contactid=1234&diallerReference=1d1525c4c96e4763a2fe2e5c0d7ccfc7&autosearch=&sessionid=0000c3ea93f144dabd2c421acdd00532
// http://10.100.30.110/nrtscriptdev/web/index.php?diallerCampaign=76b3ff146f6c4802b727bb3042493043&diallerActivity=e64d913cf18742a383a943b9e609810f&contactid=1234&diallerReference=0000861aaf2245c6a672f98a1191fa65&autosearch=&sessionid=0000c3ea93f144dabd2c421acdd00532
//http://10.100.30.110/nrtscriptdev/web/index.php?diallerCampaign=76b3ff146f6c4802b727bb3042493043&diallerActivity=4b7c2c39a1be4f5ba2c6d32ca068e3a9&contactid=2e20a07add8848ec8987e35d7a6273b1&diallerReference=03bb770806714670aaad2325972e779b&autosearch=&sessionid=9bc0673373c24415ad9940b338e759e3
//http://10.100.30.110/nrtscriptdev/web/index.php?diallerCampaign=b4cc418c204949078266f7bdc68e83a3&diallerActivity=ee4e2ad6a35f421fbfa196ad7dd9c91a&contactid=2e20a07add8848ec8987e35d7a6273b1&diallerReference=0bdd2406909047b88b4b935f8458ec51&autosearch=&sessionid=9bc0673373c24415ad9940b338e759e3
//CHAINE DE L'ESPOIR UPGRADE
//http://10.100.30.110/nrtscriptdev/web/index.php?diallerCampaign=29270ed61ca441e484431aaae9cd7e4b&diallerActivity=dc58c49f46fc4fa4a36f0eb1b8f4fe09&contactid=b57376609d944cf5b053126380f8759e&diallerReference=491ee84d279142a3a20406c6bdc9781f&autosearch=&sessionid=b6282c687f00417a9369efa1f4cb3aad
// LEADS BTOB
//http://10.100.30.110/nrtscriptdev/web/index.php?diallerCampaign=7a8c4a1663754805aeb8aa3fe83c071a&diallerActivity=84c8c73584364bdba8dbd733c72ec6cc&contactid=b57376609d944cf5b053126380f8759e&diallerReference=0112a24a465746ba9eb3438859179156&autosearch=&sessionid=b6282c687f00417a9369efa1f4cb3aad
// LEADS TRAVAUX
// http://10.100.30.110/nrtscriptdev/web/index.php?diallerCampaign=026bd2eb32b54ef2a797000f25f3f161&diallerActivity=0e1f92aa557e4082b874ee51131f6340&contactid=b57376609d944cf5b053126380f8759e&diallerReference=06dc53b061ac45bca40ba5f0dfc67773&autosearch=&sessionid=b6282c687f00417a9369efa1f4cb3aad

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
            $NixxisParameters->GetNixxisActivityType();


            Yii::$app->session->set('NixxisParameters', $NixxisParameters);
            Yii::$app->session->set('NixxisQualifications', $this->GetQualification($NixxisParameters->diallerActivity));
            Yii::$app->session->set('Script', $script);


            NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $script, (microtime(true) - $start), "SiteController");

//            print_r($script);
//
//            exit(0);

            if (isset($script['Module']) && $script['Module'] == 1) {
                return $this->redirect(array('Scripts/' . $script['ControllerDirectory'],), 302);
            }
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
