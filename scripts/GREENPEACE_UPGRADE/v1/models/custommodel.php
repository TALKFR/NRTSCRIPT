<?php

namespace app\scripts\GREENPEACE_UPGRADE\v1\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\components\Validators\NixxisDateValidator;

class custommodel extends \app\models\Nixxis\Data {

    public function afterFind() {
        
    }

    public function beforeValidate() {
        parent::beforeValidate();






        if (($this->scenario == 'AUGPA' && (($this->N_MONTANT / $this->N_PERIODICITE) - ($this->A_MONTANT / $this->A_PERIODICITE)) <= 0)) {


            $this->addError('N_MONTANT', 'Augmentation négative ou nulle');
            return false;
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        $p_rules = parent::rules();
        $rules = [
            [['N_MONTANT'], 'double', 'message' => 'La valeur doit être un montant valide'],
            [['N_MONTANT', 'N_PERIODICITE'], 'required', 'on' => 'AUGPA', 'message' => 'Ce champs ne peut être vide'],
            [['N_MONTANT'], 'required', 'on' => 'DSM', 'message' => 'Ce champs ne peut être vide'],
            [['N_DATEPA'], NixxisDateValidator::className()],
        ];
        return ArrayHelper::merge($p_rules, $rules);
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if (($this->ADR1 != $this->getOldAttribute('ADR1')) || ($this->ADR2 != $this->getOldAttribute('ADR2')) || ($this->ADR3 != $this->getOldAttribute('ADR3')) || ($this->ADR4 != $this->getOldAttribute('ADR4')) || ($this->CP != $this->getOldAttribute('CP')) || ($this->VILLE != $this->getOldAttribute('VILLE'))
        ) {
            $this->MODIF_ADRESSE = 1;
        }

        if (($this->TEL1 != $this->getOldAttribute('TEL1')) ||
                ($this->TEL2 != $this->getOldAttribute('TEL2')) ||
                ($this->TEL3 != $this->getOldAttribute('TEL3'))
        ) {
            $this->MODIF_TEL = 1;
        }

        if (($this->EMAIL1 != $this->getOldAttribute('EMAIL1')) || ($this->EMAIL2 != $this->getOldAttribute('EMAIL2'))) {
            $this->MODIF_EMAIL = 1;
        }
        return true;
    }

    public static function GetTextCycle($cycle) {
        $tmp = null;
        $cyclesPA = self::GetFormulaireCycles();
        foreach ($cyclesPA as $cyclePA) {
            if ($cyclePA['id'] == $cycle) {
                $tmp = $cyclePA['name'];
            }
        }
        return $tmp;
    }

    public static function GetFormulaireCycles() {

        return array(
            ['id' => '1', 'name' => 'Tous les mois'],
            ['id' => '2', 'name' => 'Tous les 2 mois'],
            ['id' => '3', 'name' => 'Tous les 3 mois'],
            ['id' => '6', 'name' => 'Tous les 6 mois'],
            ['id' => '12', 'name' => 'Tous les 12 mois'],
        );
    }

    public function GetProchainPA() {
        if (Date('d') < 10) {
            $date = Date('Y-m-') . $this->A_JOURPA;
            $date = date("d/m/Y", strtotime("+1 month", strtotime($date . "-01")));
            return $date;
        } else {
            $date = Date('Y-m-') . $this->A_JOURPA;
            $date = date("d/m/Y", strtotime("+2 month", strtotime($date . "-01")));
            return $date;
        }
    }

}
