<?php

namespace app\controllers\GP_Upgrade_v2;

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

    public function actionSearch() {


        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        $Script = Yii::$app->session->get('Script');
        if (!$NixxisParameters instanceof NixxisParameters) {
            die(htmlentities('htmlentities(Session Error'));
        }

        if ($NixxisParameters->autosearch == '' | $NixxisParameters->autosearch === null) {
            die(htmlentities('Aucun numéro fourni pour la recherche'));
        }

        $ValidatedPhoneNumber = $NixxisParameters->validatePhoneNumber('FR');

        if ($ValidatedPhoneNumber === null) {
            die(htmlentities("Le numéro demandé n'est pas valide"));
        }

        if (!isset($Script['AutoSearch'])) {
            die(htmlentities("Pas de champs défini pour la recherche automatique" . $NixxisParameters->diallerActivity));
        }

//        $ValidatedPhoneNumber = '000';

        if (count($Script['AutoSearch'])) {
            $search = null;
            foreach ($Script['AutoSearch'] as $autosearchfield) {
                if ($search !== null) {
                    $search .= ' OR ';
                }
                $search .= $autosearchfield . " = '" . $ValidatedPhoneNumber . "' ";
            }
            $filtersearch = null;
            if (isset($Script['SearchFilter']) && count($Script['SearchFilter'])) {
                foreach ($Script['SearchFilter'] as $key => $value) {
                    if ($filtersearch !== null) {
                        $filtersearch .= ' AND ';
                    }
                    $filtersearch .= $key . " = '" . $value . "' ";
                }
            }
            $search = '(' . $search . ')';
            if ($filtersearch !== null) {
                $search .= ' AND ' . $filtersearch;
            }
        } else {
            die(htmlentities("Pas de champs défini pour la recherche automatique" . $NixxisParameters->diallerActivity));
        }

        $modelclass = 'app\models\Campaigns\DATA' . ucfirst($NixxisParameters->diallerCampaign);
        $count = $modelclass::find()
                ->where($search)
                ->count();

// ON A TROUVE PLUSIEURS ENREGISTREMENTS
// ON PRESENTE TOUS LES ENREGISTREMENTS TROUVES
        if ($count > 1) {
            $dataProvider = new ActiveDataProvider([
                'query' => $modelclass::find()->where($search)
            ]);
//            echo $search;
//            exit(0);
            return $this->render($Script['ControllerDirectory'] . '_v' . $Script['Version'] . '/search', [
                        'searchModel' => null,
                        'dataProvider' => $dataProvider,
                        'NixxisParameters' => $NixxisParameters,
                        'Titre' => "SELECTION D'UNE FICHE",
                        'Message' => "Le numéro a été trouvé plusieurs fois dans la base",
            ]);
        }
// PAS D'ENREGISTREMENT TROUVE
// ON FAIT UNE RECHERCHE MANUELLE
        if (!$count) {
            $searchModel = new $modelclass;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $Script['SearchFilter']);
            $dataProvider->pagination->pagesize = 10;
            return $this->render($Script['ControllerDirectory'] . '_v' . $Script['Version'] . '/search', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'NixxisParameters' => $NixxisParameters,
                        'Titre' => "RECHERCHE MANUELLE D'UNE FICHE",
                        'Message' => "Le numéro n'a pas été trouvé dans la base",
            ]);
        }
        $model = $modelclass::find()
                ->where("tel_trouve = '" . $ValidatedPhoneNumber . "' OR tel3 = '" . $ValidatedPhoneNumber . "'")
                ->one();

        if ($model instanceof $modelclass) {
            $NixxisParameters->diallerReference = $model->Internal__id__;
            Yii::$app->session->set('NixxisParameters', $NixxisParameters);
            return $this->redirect(array($Script['ControllerDirectory'] . '_v' . $Script['Version'] . '/script/' . 'index',), 302);
        } else {
            die(htmlentities("Model non trouvé" . $NixxisParameters->diallerActivity));
        }
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
        return $this->render('GP_Upgrade_v' . $Script['Version'] . '/index', [
                    'model' => $model,
                    'NixxisParameters' => $NixxisParameters,
                    'Script' => $Script,
                    'model_qualifications' => $model_qualifications,
                    'NixxisQualifications' => $this->NixxisQualifications,
        ]);
    }

    private function AffectScenario($NixxisQualificationId, &$model, &$model_qualifications) {
        switch ($NixxisQualificationId) {
            case 'f888544daee64f44af2fde31233740a0':
                $model->N_DATEPA = $model->GetProchainPA();
                $model->scenario = 'AUGPA';
                break;
            case '4d784672223947488055251ae149d5d1':
                $model->scenario = 'DSM';
                break;
            case '469eba39d8984e308e6aec841cb3752a':
                $model->scenario = 'DSM';
                break;
            case '81f38eb61c444a36ae6f90fe478291ca':
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
            return $this->render('GP_Upgrade_v' . $Script['Version'] . '/qualifications', [
                        'model' => $model,
                        'model_qualifications' => $model_qualifications,
                        'NixxisParameters' => $NixxisParameters,
                        'Script' => $Script,
                        'NixxisQualifications' => $this->NixxisQualifications,
            ]);
        } else {
            NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptGoto");
            return $this->render('GP_Upgrade_v' . $Script['Version'] . '/index', [
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
                return $this->render('GP_Upgrade_v' . $Script['Version'] . '/qualifications', [
                            'model' => $model,
                            'model_qualifications' => $model_qualifications,
                            'NixxisParameters' => $NixxisParameters,
                            'Script' => $Script,
                            'NixxisQualifications' => $this->NixxisQualifications,
                ]);
            }
        } else {
            print_r($model->getErrors());
            die("can't save model ");
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
