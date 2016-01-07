<?php

/* @var $this yii\web\View */
/* @var $model \app\models\DATA0331e68e23ca4e308b49869bffbe5c79 */
$url = Yii::$app->params['Nixxis_Url'];


if (isset($Script['IncomingQualificationError'])) {
    if ($NixxisQualifications->qualificationId == $Script['IncomingQualificationError']) {
        $NixxisParameters->diallerReference = null;
    }
}

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
    
    NixxisDirectLink.setInternalId('$NixxisParameters->diallerReference','');
    NixxisDirectLink.setQualification('$NixxisQualifications->qualificationId','$NixxisQualifications->CallbackNixxisformat','$NixxisQualifications->callbackPhone');

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