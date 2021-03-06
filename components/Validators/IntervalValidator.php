<?php

namespace app\components\Validators;

use Yii;
use yii\validators\Validator;

class IntervalValidator extends Validator {

    public $ecart;

    public function init() {
        parent::init();
        $this->message = "La date est incohérente";
    }

    public function validateAttribute($model, $attribute) {
        $value = $model->$attribute;

        $datedujour = new \DateTime(Date('Y-m-d'));
        $datenpa = \DateTime::createFromFormat('d/m/Y', $value);

        $diff = ($datenpa < $datedujour) ? -1 * ($datenpa->diff($datedujour)->format("%a")) : $datenpa->diff($datedujour)->format("%a");


        if ($diff <= 10) {
            $model->addError('N_DATEPA_MONTH', $this->message);
            $model->addError('N_DATEPA_YEAR', $this->message);
        }
    }

}
