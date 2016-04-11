<?php

namespace app\models;

use yii\base\Model;

class NixxisAffectations extends Model {

    public $Commentaire;
    public $Version;
    public $ControllerDirectory;
    public $ControllerStart;
    public $Activities;
    public $AutoSearch;
    public $SearchFilter;
    public $IncomingQualificationError;
    public $Module;

    public function rules() {
        return [

            [['Version', 'ControllerDirectory', 'ControllerStart', 'Activities'], 'required'],
            [['Module'], 'safe'],
            [['ControllerDirectory', 'ControllerStart', 'IncomingQualificationError', 'Commentaire'], 'string'],
            [['Activities', 'SearchFilter', 'AutoSearch'], 'checkIsArray'],
            ['Version', 'integer'],
            [['AutoSearch', 'IncomingQualificationError'], 'required', 'on' => 'INCOMING', 'message' => 'Ce champs ne peut être vide'],
        ];
    }

    public function checkIsArray($attribute, $params) {
//        print_r($params);
//        exit(0);
        if (!is_array($this->$attribute)) {
            $this->addError($attribute, $attribute . ' is not array!');
        }
    }

}
