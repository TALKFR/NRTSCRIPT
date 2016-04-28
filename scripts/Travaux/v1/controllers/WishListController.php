<?php

namespace app\scripts\Travaux\v1\controllers;

use Yii;
use app\scripts\Travaux\v1\models\SM_ListActivities;
use app\scripts\Travaux\v1\models\GenForm;

class WishListController extends \app\controllers\ScriptController {

    public function actionIndex($Internal__id__) {
        $this->NixxisData = $this->findModel($Internal__id__);


        if (isset($_POST['recherche'])) {
            $ListActivities = SM_ListActivities::ListActivities();
            if (isset($_POST['search']) && $_POST['search'] <> '') {
                foreach ($ListActivities as $key => $value) {
                    if (!strstr($value['keywords'], SM_ListActivities::removeAccents(strtolower($_POST['search'])))) {
                        unset($ListActivities[$key]);
                    }
                }
            }

            return $this->render('wishlist', [
                        'model' => $this->NixxisData,
                        'NixxisParameters' => $this->NixxisParameters,
                        'Script' => $this->Script,
                        'Module' => $this->module,
                        'ListActivities' => $ListActivities,
            ]);
        } else if (isset($_POST['goto'])) {
            $route = 'Scripts/Travaux/wish';
            $arrayParams = ['Internal__id__' => $Internal__id__, 'act_id' => $_POST['act_id']];
            $params = array_merge([$route], $arrayParams);
            Yii::$app->urlManager->createUrl($params);


            //$params = array_merge([Yii::$app->controller->route], ['Internal__id__' => '1234', 'p2' => '111']);
            //Yii::$app->urlManager->createUrl(array_merge([Yii::$app->controller->route], ['Internal__id__' => '1234', 'p2' => '111']));

            return $this->redirect(Yii::$app->urlManager->createUrl($params));
        }




        return $this->render('wishlist', [
                    'model' => $this->NixxisData,
                    'NixxisParameters' => $this->NixxisParameters,
                    'Script' => $this->Script,
                    'Module' => $this->module,
                    'ListActivities' => SM_ListActivities::ListActivities(),
        ]);
    }

//    public function actionSearch($Internal__id__) {
//        $this->NixxisData = $this->findModel($Internal__id__);
//
//        $this->NixxisData->scenario = 'RO';
//        $ListActivities = SM_ListActivities::ListActivities();
//        if (isset($_POST['recherche'])) {
//            if (isset($_POST['search']) && $_POST['search'] <> '') {
//                foreach ($ListActivities as $key => $value) {
//                    if (!strstr($value['keywords'], SM_ListActivities::removeAccents(strtolower($_POST['search'])))) {
//                        unset($ListActivities[$key]);
//                    }
//                }
//            }
//
//            return $this->render('wishlist', [
//                        'model' => $this->NixxisData,
//                        'NixxisParameters' => $this->NixxisParameters,
//                        'Script' => $this->Script,
//                        'Module' => $this->module,
//                        'ListActivities' => $ListActivities,
//            ]);
//        }
//
//
//
////
////
////
////        $FormData = array();
////        $FormData['cus_title'] = '';
////        $FormData['cus_last_name'] = $model->NOM;
////        $FormData['cus_first_name'] = $model->PRENOM;
//////
//////        $FormData['cus_last_name'] = 'POUILLY';
//////        $FormData['cus_first_name'] = 'GUILLAUME';
////
////
////        $FormData['cus_srcommons_consumer_type_monovalue'] = 'srcommons_consumer_type_monovalue__private_individual';
////        $FormData['cus_srcommons_occupant_type_monovalue'] = 'srcommons_occupant_type_monovalue__owner_occupier';
////        $FormData['cus_postcode'] = $model->_CP_TRAVAUX;
////        $FormData['cus_town'] = $model->_VILLE_TRAVAUX;
////        $FormData['cus_email'] = $model::getFirstAvailable(array($model->EMAIL1, $model->EMAIL2));
////        $FormData['cus_tel'] = $model::getFirstAvailable(array($model->TEL1, $model->TEL2, $model->TEL3));
////        $FormData['cus_cell'] = '';
////        $FormData['cus_availibility'] = '';
////
////
////        if (isset($_POST['act_id'])) {
//////            echo GenForm::getStructureFormActivity(SM_ListActivities::GetActivityPath($_POST['act_id']), $model);
////
////
////
////            $GenForm = GenForm::getStructureFormActivity(SM_ListActivities::GetActivityPath($_POST['act_id']), $model, $FormData);
////
////            if ($GenForm == -1) {
////                return $this->redirect(array("/Scripts/Travaux/default/step3", 'Internal__id__' => $Internal__id__));
////            }
////
////
////
////
////
////
////
////            return $this->render('wish', [
////                        'model' => $model,
////                        'NixxisParameters' => $NixxisParameters,
////                        'Script' => $Script,
////                        'Module' => $this->module,
////                        'genform' => GenForm::getStructureFormActivity(SM_ListActivities::GetActivityPath($_POST['act_id']), $model, $FormData),
////                        'jsonobject' => SM_ListActivities::GetJSONObject($_POST['act_id'])
////            ]);
////        }
////
////        print_r(SM_ListActivities::ListActivities());
////        exit(0);
//    }
}
