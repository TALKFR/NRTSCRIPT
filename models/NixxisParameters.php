<?php

namespace app\models;

use yii\base\Model;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NixxisParameters extends Model {

    public $diallerCampaign;
    public $diallerActivity;
    public $contactid;
    public $diallerReference;
    public $autosearch;
    public $sessionid;
    public $validatedPhoneNumber;

    public function rules() {
        return [

            ['diallerCampaign', 'required'],
            ['diallerCampaign', 'string', 'max' => 32],
            ['diallerActivity', 'required'],
            ['diallerActivity', 'string', 'max' => 32],
            ['contactid', 'required'],
            ['contactid', 'string', 'max' => 32],
//            ['diallerReference', 'required'],
            ['diallerReference', 'string', 'max' => 32],
            ['sessionid', 'required'],
            ['sessionid', 'string', 'max' => 32],
        ];
    }

    public function attributeLabels() {
        return [
        ];
    }

    public function validatePhoneNumber($format) {
        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            $NumberProto = $phoneUtil->parse($this->autosearch, $format);
            $IsAllowed = ($phoneUtil->isPossibleNumber($NumberProto) && $phoneUtil->isValidNumber($NumberProto) && $phoneUtil->isValidNumberForRegion($NumberProto, 'FR'));
            if (!$IsAllowed) {
                return null;
            }
            $this->validatedPhoneNumber = str_replace(" ", "", $phoneUtil->format($NumberProto, PhoneNumberFormat::NATIONAL));
            return $this->validatedPhoneNumber;
        } catch (NumberParseException $ex) {
            return null;
        }
    }

}
