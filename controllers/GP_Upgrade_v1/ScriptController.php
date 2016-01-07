<?php

namespace app\controllers\GP_Upgrade_v1;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\NixxisParameters;
use app\models\NixxisQualifications;
use app\models\Campaigns\DATAFf829a7f46804d40b76f82a2c4afd8ad;

class ScriptController extends Controller {

    private $version = 1;
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
            $NixxisParameters->diallerReference = $model->Internal__Id__;
            Yii::$app->session->set('NixxisParameters', $NixxisParameters);
            return $this->redirect(array($Script['ControllerDirectory'] . '_v' . $Script['Version'] . '/script/' . 'index',), 302);
        } else {
            die(htmlentities("Model non trouvé" . $NixxisParameters->diallerActivity));
        }
    }

    public function actionIndex() {
        Yii::$app->session->open();

        $model_qualifications = new NixxisQualifications();
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        $Script = Yii::$app->session->get('Script');

        if (!$NixxisParameters instanceof NixxisParameters) {
            die('Session Error');
        }


        $modelclass = 'app\models\Campaigns\DATA' . ucfirst($NixxisParameters->diallerCampaign);

        $model = $modelclass::findOne(['Internal__Id__' => $NixxisParameters->diallerReference]);


        Yii::$app->session->set('NixxisParameters', $NixxisParameters);


        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');

        // echo $model->GetSystemData()->CurrentActivity;

        if ($model->GetSystemData()->LastQualification != '') {
            $model->scenario = 'RO';
        }
        return $this->render('GP_Upgrade_v' . $this->version . '/index', [
                    'model' => $model,
                    'NixxisParameters' => $NixxisParameters,
                    'Script' => $Script,
                    'model_qualifications' => $model_qualifications,
                    'NixxisQualifications' => $this->NixxisQualifications,
        ]);
    }

    private function AffectScenario($NixxisQualificationId, &$model, &$model_qualifications) {
        switch ($NixxisQualificationId) {
            case 'b68f7791526847949497a6b224c6fcc4':
                $model->date_modification = $model->GetProchainPA();
                $model->scenario = 'AUGPA';
                break;
            case 'fc748e7f46c1427b97b31cec4ec75a88':
                $model->scenario = 'DSM';
                break;
            case '4c2658cbb474414eb7c0d38216a71a65':
                $model->scenario = 'DSM';
                break;
            case 'f60281cdec084c68b930900d8696730d':
                $model_qualifications->scenario = 'CALLBACK';
                break;
        }
    }

    public function actionGoto($Internal__Id__) {
        $model = $this->findModel($Internal__Id__);
        $Script = Yii::$app->session->get('Script');

        $model_qualifications = new NixxisQualifications();
        $model_qualifications->load(Yii::$app->request->post());

        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->AffectScenario($model_qualifications->qualificationId, $model, $model_qualifications);

            return $this->render('GP_Upgrade_v' . $this->version . '/qualifications', [
                        'model' => $model,
                        'model_qualifications' => $model_qualifications,
                        'NixxisParameters' => $NixxisParameters,
                        'Script' => $Script,
                        'NixxisQualifications' => $this->NixxisQualifications,
            ]);
        } else {
            return $this->render('GP_Upgrade_v' . $this->version . '/index', [
                        'model' => $model,
                        'model_qualifications' => $model_qualifications,
                        'NixxisParameters' => $NixxisParameters,
                        'Script' => $Script,
                        'NixxisQualifications' => $this->NixxisQualifications,
            ]);
        }
    }

    public function actionQualify($Internal__Id__) {
        $model = $this->findModel($Internal__Id__);
        $Script = Yii::$app->session->get('Script');
        $model_qualifications = new NixxisQualifications();
        $model_qualifications->load(Yii::$app->request->post());

        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');

        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model_qualifications->load(Yii::$app->request->post()) && $model_qualifications->validate()) {
                return $this->render('last', [
                            'model' => $model,
                            'Script' => $Script,
                            'NixxisParameters' => $NixxisParameters,
                            'NixxisQualifications' => $model_qualifications,
                ]);
            } else {
                $this->AffectScenario($model_qualifications->qualificationId, $model, $model_qualifications);
                return $this->render('GP_Upgrade_v' . $this->version . '/qualifications', [
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
        if (($model = DATAFf829a7f46804d40b76f82a2c4afd8ad::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
