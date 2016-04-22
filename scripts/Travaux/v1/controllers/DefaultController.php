<?php

namespace app\scripts\Travaux\v1\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\NixxisParameters;
use app\models\NixxisQualifications;
use app\components\NrtLogger;
use app\scripts\Travaux\v1\models\SM_ListActivities;
use app\scripts\Travaux\v1\models\GenForm;
use app\models\Leads;

//108

class DefaultController extends Controller {

    private $NixxisQualifications = array();

    private function AffectScenario($NixxisQualificationId, &$model, &$model_qualifications) {
        /* @var $model \app\models\Campaigns\DATA76b3ff146f6c4802b727bb3042493043 */

        switch ($NixxisQualificationId) {
            case 'bec202e519964fb7a02c0272fa9f3724': //PA
                $model->scenario = 'FIN';
                break;
        }

        if ($this->NixxisQualifications[$NixxisQualificationId]['Description'] == 'A RAPPELER') {
            $model_qualifications->scenario = 'CALLBACK';
        }
    }

    public function actionIndex() {

        $start = microtime(true);
        $model_qualifications = new NixxisQualifications();
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        if (!$NixxisParameters instanceof NixxisParameters) {
            die('Session Error');
        }
        $Script = Yii::$app->session->get('Script');


        $model = $this->findModel($NixxisParameters->diallerReference);


        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');

        if ($model->GetSystemData()->LastQualification != '' && $NixxisParameters->ActivityType == $NixxisParameters::ACT_INBOUND) {
            $model->scenario = 'RO';
        } else {
            $model->scenario = 'default';
        }


//        $Leads = Leads::find()->where(['nixxisid' => $NixxisParameters->diallerReference])->all();
        $dataProvider = new ActiveDataProvider([
            'query' => Leads::find()->where(['nixxisid' => $NixxisParameters->diallerReference]),
        ]);


        NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptIndex");
        return $this->render('index', [
                    'model' => $model,
                    'NixxisParameters' => $NixxisParameters,
                    'Script' => $Script,
                    'model_qualifications' => $model_qualifications,
                    'NixxisQualifications' => $this->NixxisQualifications,
                    'Module' => $this->module,
                    'Leads' => $dataProvider
        ]);
    }

    public function actionStep3($Internal__id__) {
        $model = $this->findModel($Internal__id__);
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');
        $Script = Yii::$app->session->get('Script');

//
//        print_r(SM_ListActivities::ListActivities());
//        exit(0);
        return $this->render('wishlist', [
                    'model' => $model,
                    'NixxisParameters' => $NixxisParameters,
                    'Script' => $Script,
                    'Module' => $this->module,
                    'ListActivities' => SM_ListActivities::ListActivities(),
        ]);
//        $model->scenario = 'ADDNEED';
//        if ($model->load(Yii::$app->request->post())) {
//            $model->scenario = 'RO';
//            return $this->render('wishlist', [
//                        'model' => $model,
//                        'NixxisParameters' => $NixxisParameters,
//                        'Script' => $Script,
//                        'Module' => $this->module,
//                        'ListActivities' => SM_ListActivities::ListActivities(),
//            ]);
//        } else {
//            $model_qualifications = new NixxisQualifications();
//            $model_qualifications->load(Yii::$app->request->post());
//            $dataProvider = new ActiveDataProvider([
//                'query' => Leads::find()->where(['nixxisid' => $NixxisParameters->diallerReference]),
//            ]);
//            print_r($model->errors);
////            return $this->render('index', [
////                        'model' => $model,
////                        'NixxisParameters' => $NixxisParameters,
////                        'Script' => $Script,
////                        'model_qualifications' => $model_qualifications,
////                        'NixxisQualifications' => $this->NixxisQualifications,
////                        'Module' => $this->module,
////                        'Leads' => $dataProvider
////            ]);
//        }
    }

    public function actionStep4($Internal__id__) {
        $model = $this->findModel($Internal__id__);
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');
        $Script = Yii::$app->session->get('Script');
        $model->scenario = 'RO';
        $ListActivities = SM_ListActivities::ListActivities();
        if (isset($_POST['recherche'])) {
            if (isset($_POST['search']) && $_POST['search'] <> '') {
                foreach ($ListActivities as $key => $value) {
                    if (!strstr($value['keywords'], SM_ListActivities::removeAccents($_POST['search']))) {
                        unset($ListActivities[$key]);
                    }
                }
            }

            return $this->render('wishlist', [
                        'model' => $model,
                        'NixxisParameters' => $NixxisParameters,
                        'Script' => $Script,
                        'Module' => $this->module,
                        'ListActivities' => $ListActivities,
            ]);
        }






        $FormData = array();
        $FormData['cus_title'] = '';
//        $FormData['cus_last_name'] = $model->NOM;
//        $FormData['cus_first_name'] = $model->PRENOM;

        $FormData['cus_last_name'] = 'POUILLY';
        $FormData['cus_first_name'] = 'GUILLAUME';


        $FormData['cus_srcommons_consumer_type_monovalue'] = 'srcommons_consumer_type_monovalue__private_individual';
        $FormData['cus_srcommons_occupant_type_monovalue'] = 'srcommons_occupant_type_monovalue__owner_occupier';
        $FormData['cus_postcode'] = $model->CP;
        $FormData['cus_town'] = $model->VILLE;
        $FormData['cus_email'] = $model::getFirstAvailable(array($model->EMAIL1, $model->EMAIL2));
        $FormData['cus_tel'] = $model::getFirstAvailable(array($model->TEL1, $model->TEL2, $model->TEL3));
        $FormData['cus_cell'] = '';
        $FormData['cus_availibility'] = '';


        if (isset($_POST['act_id'])) {
//            echo GenForm::getStructureFormActivity(SM_ListActivities::GetActivityPath($_POST['act_id']), $model);



            $GenForm = GenForm::getStructureFormActivity(SM_ListActivities::GetActivityPath($_POST['act_id']), $model, $FormData);

            if ($GenForm == -1) {
                return $this->redirect(array("/Scripts/Travaux/default/step3", 'Internal__id__' => $Internal__id__));
            }







            return $this->render('wish', [
                        'model' => $model,
                        'NixxisParameters' => $NixxisParameters,
                        'Script' => $Script,
                        'Module' => $this->module,
                        'genform' => GenForm::getStructureFormActivity(SM_ListActivities::GetActivityPath($_POST['act_id']), $model, $FormData),
                        'jsonobject' => SM_ListActivities::GetJSONObject($_POST['act_id'])
            ]);
        }

//
//        print_r(SM_ListActivities::ListActivities());
//        exit(0);
    }

    public function actionStep5($Internal__id__, $act_id) {
        $array = array();
        $Mandatories = SM_ListActivities::GetActivityMandatories($act_id);


        foreach ($Mandatories as $Mandatory) {
            if (!(isset($_POST[$Mandatory[0]]) && $_POST[$Mandatory[0]] <> '' && $_POST[$Mandatory[0]] <> null)) {
                $array[] = $Mandatory[1];
            }
        }

        $FormData = array();
        $FormData['cus_title'] = isset($_POST['cus_title']) ? $_POST['cus_title'] : '';
        $FormData['cus_last_name'] = isset($_POST['cus_last_name']) ? $_POST['cus_last_name'] : '';
        $FormData['cus_first_name'] = isset($_POST['cus_first_name']) ? $_POST['cus_first_name'] : '';
        $FormData['cus_srcommons_consumer_type_monovalue'] = isset($_POST['cus_srcommons_consumer_type_monovalue']) ? $_POST['cus_srcommons_consumer_type_monovalue'] : '';
        $FormData['cus_srcommons_occupant_type_monovalue'] = isset($_POST['cus_srcommons_occupant_type_monovalue']) ? $_POST['cus_srcommons_occupant_type_monovalue'] : '';
        $FormData['cus_postcode'] = isset($_POST['cus_postcode']) ? $_POST['cus_postcode'] : '';
        $FormData['cus_town'] = isset($_POST['cus_town']) ? $_POST['cus_town'] : '';
        $FormData['cus_email'] = isset($_POST['cus_email']) ? $_POST['cus_email'] : '';
        $FormData['cus_tel'] = isset($_POST['cus_tel']) ? $_POST['cus_tel'] : '';
        $FormData['cus_cell'] = isset($_POST['cus_cell']) ? $_POST['cus_cell'] : '';

        $FormData['cus_availibility'] = isset($_POST['cus_availibility']) ? $_POST['cus_availibility'] : '';

        foreach ($_POST as $key => $value) {
            if (strpos($key, "scq_") === 0) {
                $FormData[$key] = $value;
            }
        }


        $model = $this->findModel($Internal__id__);
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');
        $Script = Yii::$app->session->get('Script');
        if (count($array)) {
            $model->scenario = 'RO';
            return $this->render('wish', [
                        'model' => $model,
                        'NixxisParameters' => $NixxisParameters,
                        'Script' => $Script,
                        'Module' => $this->module,
                        'genform' => GenForm::getStructureFormActivity(SM_ListActivities::GetActivityPath($act_id), $model, $FormData),
                        'jsonobject' => SM_ListActivities::GetJSONObject($act_id),
                        'Errors' => $array,
                        'FormData' => $FormData,
            ]);
        }
        $Lead = new Leads();
        $Lead->act_id = $act_id;
        $Lead->nixxisId = $Internal__id__;

        $Lead->cus_title = $FormData['cus_title'];
        $Lead->cus_first_name = $FormData['cus_first_name'];
        $Lead->cus_last_name = $FormData['cus_last_name'];
        $Lead->cus_postcode = $FormData['cus_postcode'];
        $Lead->cus_town = $FormData['cus_town'];
        $Lead->cus_email = $FormData['cus_email'];
        $Lead->cus_tel = $FormData['cus_tel'];
        $Lead->object = serialize($FormData);

        if ($Lead->save()) {
            return $this->redirect(\Yii::$app->urlManager->createUrl("Scripts/Travaux"));
        } else {
            $model->scenario = 'RO';
            $array[] = 'Le lead existe deja';
            return $this->render('wish', [
                        'model' => $model,
                        'NixxisParameters' => $NixxisParameters,
                        'Script' => $Script,
                        'Module' => $this->module,
                        'genform' => GenForm::getStructureFormActivity(SM_ListActivities::GetActivityPath($act_id), $model, $FormData),
                        'jsonobject' => SM_ListActivities::GetJSONObject($act_id),
                        'Errors' => $array,
                        'FormData' => $FormData,
            ]);
        }
    }

    public function actionStep2($Internal__id__) {
        $start = microtime(true);
        $model = $this->findModel($Internal__id__);
        $Script = Yii::$app->session->get('Script');

        $model_qualifications = new NixxisQualifications();
        $model_qualifications->load(Yii::$app->request->post());

        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');
        $dataProvider = new ActiveDataProvider([
            'query' => Leads::find()->where(['nixxisid' => $NixxisParameters->diallerReference]),
        ]);

        if ($model_qualifications->qualificationId == '1234') {
            $model->scenario = 'ADDNEED';
            $model->load(Yii::$app->request->post());

            if ($model->_PAS_D_EMAIL == true) {

                $model->EMAIL1 = strtolower($model->NOM);
                if ($model->PRENOM <> '') {
                    $model->EMAIL1 .= '.' . strtolower($model->PRENOM);
                }
                $model->EMAIL1 .= '@gmail.com';
                $model->EMAIL1 = str_replace(' ', '', $model->EMAIL1);
                $model->EMAIL1 = filter_var($model->EMAIL1, FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_LOW);
            }

            if ($model->save()) {
                return $this->redirect(array("/Scripts/Travaux/default/step3", 'Internal__id__' => $Internal__id__));
            } else {

                $model->scenario = 'default';
                return $this->render('index', [
                            'model' => $model,
                            'NixxisParameters' => $NixxisParameters,
                            'Script' => $Script,
                            'model_qualifications' => $model_qualifications,
                            'NixxisQualifications' => $this->NixxisQualifications,
                            'Module' => $this->module,
                            'Leads' => $dataProvider
                ]);
            }
        }


        $this->AffectScenario($model_qualifications->qualificationId, $model, $model_qualifications);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model_qualifications->scenario == 'CALLBACK') {
                $model->scenario = 'RO';
                return $this->render('callback', [
                            'model' => $model,
                            'model_qualifications' => $model_qualifications,
                            'NixxisParameters' => $NixxisParameters,
                            'Script' => $Script,
                            'NixxisQualifications' => $this->NixxisQualifications,
                            'Module' => $this->module,
                ]);
            }

            if ($model_qualifications->nextstep == '') {
                if ($model_qualifications->load(Yii::$app->request->post()) && $model_qualifications->validate()) {
                    NrtLogger::log($NixxisParameters->sessionid, $NixxisParameters, $Script, (microtime(true) - $start), "ScriptQualify");


                    if ($model->scenario == 'FIN') {
                        if (Leads::find()->where(['nixxisid' => $NixxisParameters->diallerReference])->count() == 0) {
                            $model->scenario = 'default';

                            return $this->render('index', [
                                        'model' => $model,
                                        'model_qualifications' => $model_qualifications,
                                        'NixxisParameters' => $NixxisParameters,
                                        'Script' => $Script,
                                        'NixxisQualifications' => $this->NixxisQualifications,
                                        'Module' => $this->module,
                                        'Leads' => $dataProvider
                            ]);
                        }
                    }


                    $url = Yii::$app->params['Nixxis_Url'];

                    $NixxisDirectLink = new \app\scripts\Artisans\v1\models\NixxisDirectLink($url, $NixxisParameters->sessionid);
                    $NixxisDirectLink->setContactid($NixxisParameters->contactid);
                    $NixxisDirectLink->setContactlistid($NixxisParameters->diallerReference);

                    $NixxisDirectLink->setInternalId();
                    $NixxisDirectLink->setQualification($model_qualifications->qualificationId, $model_qualifications->getCallbackNixxisformat(), $model_qualifications->callbackPhone);

                    return $this->render('last', [
                                'model' => $model,
                                'Script' => $Script,
                                'NixxisParameters' => $NixxisParameters,
                                'NixxisQualifications' => $model_qualifications,
                                'Module' => $this->module,
                    ]);
                }
            }
        }
        $model->scenario = 'default';
        return $this->render('index', [
                    'model' => $model,
                    'model_qualifications' => $model_qualifications,
                    'NixxisParameters' => $NixxisParameters,
                    'Script' => $Script,
                    'NixxisQualifications' => $this->NixxisQualifications,
                    'Module' => $this->module,
        ]);
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

                $NixxisDirectLink = new \app\scripts\Artisans\v1\models\NixxisDirectLink($url, $NixxisParameters->sessionid);
                $NixxisDirectLink->setContactid($NixxisParameters->contactid);
                $NixxisDirectLink->setContactlistid($NixxisParameters->diallerReference);

                echo $NixxisDirectLink->setInternalId();
                echo $NixxisDirectLink->setQualification($model_qualifications->qualificationId, $model_qualifications->getCallbackNixxisformat(), $model_qualifications->callbackPhone);


                return $this->render('last', [
                            'model' => $model,
                            'Script' => $Script,
                            'NixxisParameters' => $NixxisParameters,
                            'NixxisQualifications' => $model_qualifications,
                ]);
            }
        }
    }

    protected function findModel($Internal__id__) {
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        // Compute the model class name with the CampaignId
        if (!$NixxisParameters instanceof NixxisParameters) {
            die('Session timeout');
        }


        $modelclass = str_replace("/", "\\", dirname(str_replace("\\", "/", __NAMESPACE__))) . '\models\DATA' . ucfirst($NixxisParameters->diallerCampaign);
        $model = $modelclass::findOne(['Internal__id__' => $Internal__id__]);
        // Check if $model instance of modelclass
        // ie check if we can found a contact with the Internal__Id__ provided        
        if (!$model instanceof $modelclass) {
            die('Contact not found');
        }
        return $model;
    }

}
