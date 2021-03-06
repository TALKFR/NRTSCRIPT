<?php

use Yii;
use app\components\NrtLogger;

/* @var $this yii\web\View */
/* @var $model \app\scripts\UNADEV_FACTEURS\v1\models\DATA0e083f4fab3144b6813f7dd82a56bcf1 */

$url = Yii::$app->params['Nixxis_Url'];

Yii::info($NixxisParameters->sessionid . ' ' . ' ****************** FINAL QUALIFICATION REQUEST ***************** ', 'trace');
Yii::info($NixxisParameters->sessionid . ' ' . ' IP Address           : ' . filter_input(INPUT_SERVER, "REMOTE_ADDR"), 'trace');
Yii::info($NixxisParameters->sessionid . ' ' . ' Session ID           : ' . $NixxisParameters->sessionid, 'trace');
Yii::info($NixxisParameters->sessionid . ' ' . ' Contact ID           : ' . $NixxisParameters->contactid, 'trace');
Yii::info($NixxisParameters->sessionid . ' ' . ' Service URL          : ' . $url, 'trace');
Yii::info($NixxisParameters->sessionid . ' ' . ' Dialer Reference     : ' . $NixxisParameters->diallerReference, 'trace');
Yii::info($NixxisParameters->sessionid . ' ' . ' Qualification ID     : ' . $NixxisQualifications->qualificationId, 'trace');
Yii::info($NixxisParameters->sessionid . ' ' . ' CallBack DateTime    : ' . $NixxisQualifications->CallbackNixxisformat, 'trace');
Yii::info($NixxisParameters->sessionid . ' ' . ' CallBack PhoneNumber : ' . $NixxisQualifications->callbackPhone, 'trace');
Yii::info($NixxisParameters->sessionid . ' ' . ' ******************  END REQUEST  ****************** ', 'trace');

$this->registerJs("
    
    function InitPage()
    {
        var _Location = window.document.URL;
        var _Parameters = _Location.substring(_Location.indexOf('?') + 1, _Location.length);
        var _Values = _Parameters.split('&');
        for (var i = 0; i < _Values.length; i++)
        {
            var _Pair = _Values[i].split('=');
            if (_Pair[0].toLowerCase() == 'seid') {
                NixxisDirectLink.sessionId = _Pair[1];
            }
            else if (_Pair[0].toLowerCase() == 'ctid') {
                NixxisDirectLink.contactId = _Pair[1];
            }

        }
        NixxisDirectLink.sessionId = '$NixxisParameters->sessionid';
        NixxisDirectLink.contactId = '$NixxisParameters->contactid';
        NixxisDirectLink.serviceUrl = '$url';
    }

    InitPage();
    
   
    NixxisDirectLink.nextContact(); 

", $this::POS_READY);
?>
<?php

//echo 'Qualification Id : ' . $NixxisQualifications->qualificationId . '<br>';
//echo 'ContactId        : ' . $NixxisParameters->contactid . '<br>';
//echo 'SessionId        : ' . $NixxisParameters->sessionid . '<br>';
//echo 'DialerCampaign   : ' . $NixxisParameters->diallerCampaign . '<br>';
//echo 'Contactid        : ' . $NixxisParameters->contactid . '<br>';
//echo 'DiallerReference : ' . $NixxisParameters->diallerReference . '<br>';
//echo 'autosearch       : ' . $NixxisParameters->autosearch . '<br>';
//echo 'sessionid        : ' . $NixxisParameters->sessionid . '<br>';
?>