<?php

namespace app\controllers\CHAINE_Upgrade_v1;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\NixxisParameters;
use app\models\NixxisQualifications;
use app\components\NrtLogger;
use app\components\Email;

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
                ->where("TEL1 = '" . $ValidatedPhoneNumber . "' OR TEL2 = '" . $ValidatedPhoneNumber . "'")
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

        $model->scenario = '';
        Yii::$app->session->set('NixxisParameters', $NixxisParameters);


        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');

        if ($model->GetSystemData()->LastQualification != '' && $NixxisParameters->ActivityType == $NixxisParameters::ACT_INBOUND) {
            if ($model->GetSystemData()->LastQualificationPositive == 1 || $model->GetSystemData()->LastQualificationPositive == -1) {
                $model->scenario = 'RO';
            }
        }

        NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptIndex");
        return $this->render('CHAINE_Upgrade_v' . $Script['Version'] . '/index', [
                    'model' => $model,
                    'NixxisParameters' => $NixxisParameters,
                    'Script' => $Script,
                    'model_qualifications' => $model_qualifications,
                    'NixxisQualifications' => $this->NixxisQualifications,
        ]);
    }

    private function AffectScenario($NixxisQualificationId, &$model, &$model_qualifications) {
        switch ($NixxisQualificationId) {
            case '5d5e537ba40e44eabc9b040aa4ac3939': //COURRIER
                $model->scenario = 'AUGPAM';
                break;
            case 'fe34e2235fd84bd49e4c9cdd7b57a080': //EMAIL
                $model->scenario = 'AUGPAMEMAIL';
                break;
            case '5e3051e9dfc848b08a34728720cb2db0': //CHANGEMENT BANQUE
                $model->scenario = 'AUGPAM';
                break;
            case '25d5e056a0544a77bb6a929e63a01e67':
                $model->scenario = 'DSM';
                break;
            case 'dbe2c53393ff49078af200c1d871d6db':
                $model->scenario = 'DSMENLIGNE';
                break;
            case 'd9fc6bed5be840a7bb284e779523d56d':
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
        //$this->AffectScenario($model_qualifications->qualificationId, $model, $model_qualifications);


        if ($model_qualifications->qualificationId == 'fe34e2235fd84bd49e4c9cdd7b57a080' && (($model->EMAIL1 == '' & $model->EMAIL2 == ''))) {
            $model->addError('EMAIL1', 'Il faut au moins une adresse email');
            $model->scenario = '';
            NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptGoto");
            return $this->render('CHAINE_Upgrade_v' . $Script['Version'] . '/index', [
                        'model' => $model,
                        'model_qualifications' => $model_qualifications,
                        'NixxisParameters' => $NixxisParameters,
                        'Script' => $Script,
                        'NixxisQualifications' => $this->NixxisQualifications,
            ]);
        }




        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->AffectScenario($model_qualifications->qualificationId, $model, $model_qualifications);

            if ($model->GetEmailsCount() == 2 && $model_qualifications->qualificationId == 'fe34e2235fd84bd49e4c9cdd7b57a080') {
                $model_qualifications->availableemails[] = ['id' => $model->EMAIL1, 'name' => $model->EMAIL1];
                $model_qualifications->availableemails[] = ['id' => $model->EMAIL2, 'name' => $model->EMAIL2];
                $model_qualifications->scenario = 'ENVOIMAIL';
            }




            NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptGoto");
            return $this->render('CHAINE_Upgrade_v' . $Script['Version'] . '/qualifications', [
                        'model' => $model,
                        'model_qualifications' => $model_qualifications,
                        'NixxisParameters' => $NixxisParameters,
                        'Script' => $Script,
                        'NixxisQualifications' => $this->NixxisQualifications,
            ]);
        } else {



            $model->scenario = '';
            NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptGoto");
            return $this->render('CHAINE_Upgrade_v' . $Script['Version'] . '/index', [
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



                $Email = new Email();

                $Email->setSubject("La Chaîne de l’Espoir - Confirmation de l’augmentation de votre prélèvement automatique");
                $Email->setFrom_email('servicedonateurs@chainedelespoir.org');
                $Email->setFrom_name("La Chaîne de l'Espoir");



                if ($model->GetEmailsCount() == 2) {
                    $Email->setRecipient($model_qualifications->email);
                } else if ($model->EMAIL1 <> '') {
                    $Email->setRecipient($model->EMAIL1);
                } else if ($model->EMAIL2 <> '') {
                    $Email->setRecipient($model->EMAIL2);
                }



                //$Email->setRecipient('info@byphone.eu');
                $Email->Send('ChaineUpgrade', $model);


                return $this->render('last', [
                            'model' => $model,
                            'Script' => $Script,
                            'NixxisParameters' => $NixxisParameters,
                            'NixxisQualifications' => $model_qualifications,
                ]);
            } else {
                $this->AffectScenario($model_qualifications->qualificationId, $model, $model_qualifications);
                NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptQualify");
                return $this->render('CHAINE_Upgrade_v' . $Script['Version'] . '/qualifications', [
                            'model' => $model,
                            'model_qualifications' => $model_qualifications,
                            'NixxisParameters' => $NixxisParameters,
                            'Script' => $Script,
                            'NixxisQualifications' => $this->NixxisQualifications,
                ]);
            }
        } else {
            NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "Qualify Model validate error");
            return $this->render('CHAINE_Upgrade_v' . $Script['Version'] . '/qualifications', [
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
