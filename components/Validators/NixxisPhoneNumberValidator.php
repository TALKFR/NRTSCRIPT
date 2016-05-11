<?php

namespace app\components\Validators;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use yii\validators\Validator;

class NixxisPhoneNumberValidator extends Validator {

    public $format;

    public function init() {
        parent::init();
        $this->message = ("Le numéro n'est pas valide");
    }

    private function isValidDateTimeString($str_dt, $str_dateformat, $str_timezone) {
        $date = \DateTime::createFromFormat($str_dateformat, $str_dt, new \DateTimeZone($str_timezone));
        return $date && \DateTime::getLastErrors()["warning_count"] == 0 && \DateTime::getLastErrors()["error_count"] == 0;
    }

    public function validateAttribute($model, $attribute) {
        $value = $model->$attribute;


        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $NumberProto = $phoneUtil->parse($value, $this->format);
            $IsAllowed = ($phoneUtil->isPossibleNumber($NumberProto) && $phoneUtil->isValidNumber($NumberProto) && $phoneUtil->isValidNumberForRegion($NumberProto, 'FR'));
            if (!$IsAllowed) {
                $model->addError($attribute, $this->message);
            }
        } catch (NumberParseException $ex) {
            $model->addError($attribute, $this->message);
        }
    }

}

//    public function clientValidateAttribute($model, $attribute, $view) {
//
//        $message = json_encode($this->message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
//        return <<<JS
//        function ValidateDate(dtValue)
//{
//var dtRegex = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
//return dtRegex.test(dtValue);
//}
//        
//if (!ValidateDate(value)) {
//    messages.push($message);
//}
//JS;
//    }
//
//}

    