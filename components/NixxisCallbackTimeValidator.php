<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use yii\validators\Validator;

class NixxisCallbackTimeValidator extends Validator {

    public $Min;
    public $Max;

    public function init() {
        parent::init();
        $this->message = "L'heure n'est pas valide";
    }

    private function isValidDateTimeString($str_dt, $str_dateformat, $str_timezone) {
        $date = \DateTime::createFromFormat($str_dateformat, $str_dt, new \DateTimeZone($str_timezone));
        return $date && \DateTime::getLastErrors()["warning_count"] == 0 && \DateTime::getLastErrors()["error_count"] == 0;
    }

    public function validateAttribute($model, $attribute) {
        $value = $model->$attribute;
        if (strtotime($value) < strtotime($this->Min)) {
            $model->addError($attribute, "L'heure est inférieure à la plage autorisée");
            echo 'en dessous';
        }
        if (strtotime($value) > strtotime($this->Max)) {
            $model->addError($attribute, "L'heure est supérieure à la plage autorisée");
            echo 'au dessus';
        }
    }

    public function clientValidateAttribute($model, $attribute, $view) {

        $message1 = json_encode("L'heure est inférieure à la plage autorisée", JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $message2 = json_encode("L'heure est supérieure à la plage autorisée", JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return <<<JS
                function dateCompare(time1,time2) {
  var t1 = new Date();
  var parts = time1.split(":");
  t1.setHours(parts[0],parts[1],0,0);
  var t2 = new Date();
  parts = time2.split(":");
  t2.setHours(parts[0],parts[1],0,0);
  if (t1.getTime()>t2.getTime()) return 1;
  if (t1.getTime()<t2.getTime()) return -1;
  return 0;
}

if (dateCompare(value,'$this->Max') == 1) {
                messages.push($message2);
}
else if (dateCompare(value,'$this->Min') == -1) {
                messages.push($message1);
}   
JS;
    }

}
