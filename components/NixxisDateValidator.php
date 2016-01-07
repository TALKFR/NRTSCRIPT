<?php

namespace app\components;

use yii\validators\Validator;

class NixxisDateValidator extends Validator {

    public function init() {
        parent::init();
        $this->message = "La date n'est pas valide";
    }

    private function isValidDateTimeString($str_dt, $str_dateformat, $str_timezone) {
        $date = \DateTime::createFromFormat($str_dateformat, $str_dt, new \DateTimeZone($str_timezone));
        return $date && \DateTime::getLastErrors()["warning_count"] == 0 && \DateTime::getLastErrors()["error_count"] == 0;
    }

    public function validateAttribute($model, $attribute) {
        $value = $model->$attribute;

        if (!$this->isValidDateTimeString($value, 'd-m-Y', 'Europe/Paris')) {
            $model->addError($attribute, $this->message);
        }
        //echo $value;
//        if (!Status::find()->where(['id' => $value])->exists()) {
//            $model->addError($attribute, $this->message);
//        }
    }

    public function clientValidateAttribute($model, $attribute, $view) {

        $message = json_encode($this->message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return <<<JS
        function ValidateDate(dtValue)
{
var dtRegex = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
return dtRegex.test(dtValue);
}
        
if (!ValidateDate(value)) {
    messages.push($message);
}
JS;
    }

}
