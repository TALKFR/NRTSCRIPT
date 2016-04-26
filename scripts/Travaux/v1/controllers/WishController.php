<?php

namespace app\scripts\Travaux\v1\controllers;

use Yii;
use app\scripts\Travaux\v1\models\SM_ListActivities;
use app\scripts\Travaux\v1\models\GenForm;
use app\scripts\Travaux\v1\models\Leads;

class WishController extends \app\controllers\ScriptController {

    public function actionIndex($Internal__id__, $act_id) {
        $this->NixxisData = $this->findModel($Internal__id__);

        $model = $this->NixxisData;
        $FormData = array();
        $FormData['cus_title'] = '';
        $FormData['cus_last_name'] = $model->NOM;
        $FormData['cus_first_name'] = $model->PRENOM;
        $FormData['cus_srcommons_consumer_type_monovalue'] = 'srcommons_consumer_type_monovalue__private_individual';
        $FormData['cus_srcommons_occupant_type_monovalue'] = 'srcommons_occupant_type_monovalue__owner_occupier';
        $FormData['cus_postcode'] = $model->_CP_TRAVAUX;
        $FormData['cus_town'] = $model->_VILLE_TRAVAUX;
        $FormData['cus_email'] = $model::getFirstAvailable(array($model->EMAIL1, $model->EMAIL2));
        $FormData['cus_tel'] = $model::getFirstAvailable(array($model->TEL1, $model->TEL2, $model->TEL3));
        $FormData['cus_cell'] = '';
        $FormData['cus_availibility'] = '';



        $GenForm = GenForm::getStructureFormActivity(SM_ListActivities::GetActivityPath($act_id), $model, $FormData);
        if ($GenForm == -1) {
            $route = 'Scripts/Travaux/wish-list';
            $arrayParams = ['Internal__id__' => $Internal__id__];
            $params = array_merge([$route], $arrayParams);
            Yii::$app->urlManager->createUrl($params);


            return $this->redirect(Yii::$app->urlManager->createUrl($params));
        }

        return $this->render('wish', [
                    'model' => $this->NixxisData,
                    'NixxisParameters' => $this->NixxisParameters,
                    'Script' => $this->Script,
                    'Module' => $this->module,
                    'genform' => GenForm::getStructureFormActivity(SM_ListActivities::GetActivityPath($act_id), $this->NixxisData, $FormData),
                    'jsonobject' => SM_ListActivities::GetJSONObject($act_id)
        ]);
    }

    public function actionAdd($Internal__id__, $act_id) {
        $this->NixxisData = $this->findModel($Internal__id__);
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


        if (count($array)) {
            $this->NixxisData->scenario = 'RO';
            return $this->render('wish', [
                        'model' => $this->NixxisData,
                        'NixxisParameters' => $this->NixxisParameters,
                        'Script' => $this->Script,
                        'Module' => $this->module,
                        'genform' => GenForm::getStructureFormActivity(SM_ListActivities::GetActivityPath($act_id), $this->NixxisData, $FormData),
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
        $Lead->LocalDateTime = date("Y-m-d H:i:s");


        if ($Lead->save()) {
            return $this->redirect(\Yii::$app->urlManager->createUrl("Scripts/Travaux"));
        } else {
            $this->NixxisData->scenario = 'RO';
            $array[] = 'Le lead existe deja';
            return $this->render('wish', [
                        'model' => $this->NixxisData,
                        'NixxisParameters' => $this->NixxisParameters,
                        'Script' => $this->Script,
                        'Module' => $this->module,
                        'genform' => GenForm::getStructureFormActivity(SM_ListActivities::GetActivityPath($act_id), $this->NixxisData, $FormData),
                        'jsonobject' => SM_ListActivities::GetJSONObject($act_id),
                        'Errors' => $array,
                        'FormData' => $FormData,
            ]);
        }
    }

}
