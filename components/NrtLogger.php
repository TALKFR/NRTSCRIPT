<?php

namespace app\components;

use Yii;

class NrtLogger {

    public static function log($uniqid, $NixxisParameters, $Module, $QueryTime, $step) {
        Yii::info($uniqid . ' ' . ' ****************** SCRIPT REQUEST ***************** ', 'trace');
        Yii::info($uniqid . ' ' . ' IP Address           : ' . filter_input(INPUT_SERVER, "REMOTE_ADDR"), 'trace');
        Yii::info($uniqid . ' ' . ' DiallerCampaign      : ' . $NixxisParameters->diallerCampaign, 'trace');
        Yii::info($uniqid . ' ' . ' DiallerReference     : ' . $NixxisParameters->diallerReference, 'trace');
        Yii::info($uniqid . ' ' . ' DiallerAutosearch    : ' . $NixxisParameters->autosearch, 'trace');
        Yii::info($uniqid . ' ' . ' Script Name          : ' . $Module::getName(), 'trace');
        Yii::info($uniqid . ' ' . ' Script Version       : ' . Yii::$app->session->get('Allocation')->version, 'trace');
        Yii::info($uniqid . ' ' . ' Script Step          : ' . $step, 'trace');
        Yii::info($uniqid . ' ' . ' Execution Time       : ' . $QueryTime, 'trace');
        Yii::info($uniqid . ' ' . ' ******************  END REQUEST  ****************** ', 'trace');
    }

}
