<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\NixxisParameters;

class ScriptController extends Controller {

    protected $NixxisQualifications = array();
    protected $NixxisParameters;
    protected $NixxisData;
    protected $Script;

    public function init() {

        parent::init();

        $this->NixxisParameters = Yii::$app->session->get('NixxisParameters');
        $this->NixxisQualifications = Yii::$app->session->get('NixxisQualifications');
        $this->Script = Yii::$app->session->get('Script');
    }

    public function getViewPath() {
        $Reflection = new \ReflectionClass($this->module);
        return dirname($Reflection->getFileName()) . '/v' . $this->module->version . '/views/default';
    }

    protected function findModel($Internal__id__) {
        $NixxisParameters = Yii::$app->session->get('NixxisParameters');
        // Compute the model class name with the CampaignId
        if (!$NixxisParameters instanceof NixxisParameters) {
            die('Session timeout');
        }

        $Reflection = new \ReflectionClass($this->module);

        $modelclass = $Reflection->getNamespaceName() . '\v' . $this->module->version . '\models\DATA' . ucfirst($NixxisParameters->diallerCampaign);
        $model = $modelclass::findOne(['Internal__id__' => $Internal__id__]);
        // Check if $model instance of modelclass
        // ie check if we can found a contact with the Internal__Id__ provided        
        if (!$model instanceof $modelclass) {
            die('Contact not found');
        }
        return $model;
    }

}
