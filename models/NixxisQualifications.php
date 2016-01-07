<?php

namespace app\models;

use yii\base\Model;
use app\components\NixxisPhoneNumberValidator;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NixxisQualifications extends Model {

    public $qualificationId;
    public $callbackDateTime;
    public $callbackDate;
    public $callbackTime;
    public $callbackPhone;

    public function rules() {
        return [

            ['qualificationId', 'required'],
            ['callbackDateTime', 'safe'],
            ['callbackDate', 'safe'],
            ['callbackTime', 'safe'],
//            ['callbackPhone', 'safe'],
            [['callbackDate', 'callbackTime'], 'required', 'on' => 'CALLBACK', 'message' => 'Ce champs ne peut être vide'],
            ['callbackPhone', 'app\components\NixxisPhoneNumberValidator', 'format' => 'FR'],
        ];
    }

    public function attributeLabels() {
        return [
            'callbackDate' => 'Date du rappel'
        ];
    }

//yyyyMMddhhmm

    public function getCallbackNixxisformat() {
        if ($this->callbackDate == '' | $this->callbackDate == null | $this->callbackTime == '' | $this->callbackTime == null) {
            return '';
        }

        $date = date_create_from_format('d-m-Y', $this->callbackDate);
        return date_format($date, 'Ymd') . str_replace(':', '', $this->callbackTime);
    }

}
