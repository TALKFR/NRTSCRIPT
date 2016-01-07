<?php

namespace app\components;

use Yii;

class NrtLogger {

    public static function log($uniqid, $NixxisParameters, $script, $QueryTime, $step) {
        Yii::info($uniqid . ' ' . ' ****************** SCRIPT REQUEST ***************** ', 'trace');
        Yii::info($uniqid . ' ' . ' IP Address           : ' . filter_input(INPUT_SERVER, "REMOTE_ADDR"), 'trace');
        Yii::info($uniqid . ' ' . ' DiallerCampaign      : ' . $NixxisParameters->diallerCampaign, 'trace');
        Yii::info($uniqid . ' ' . ' DiallerReference     : ' . $NixxisParameters->diallerReference, 'trace');
        Yii::info($uniqid . ' ' . ' DiallerAutosearch    : ' . $NixxisParameters->autosearch, 'trace');
        Yii::info($uniqid . ' ' . ' Script Name          : ' . $script['Name'], 'trace');
        Yii::info($uniqid . ' ' . ' Script Version       : ' . $script['Version'], 'trace');
        Yii::info($uniqid . ' ' . ' Script Step          : ' . $step, 'trace');
        Yii::info($uniqid . ' ' . ' Execution Time       : ' . $QueryTime, 'trace');
        Yii::info($uniqid . ' ' . ' ******************  END REQUEST  ****************** ', 'trace');
    }

}
