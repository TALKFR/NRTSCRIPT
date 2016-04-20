<?php

namespace app\scripts\GpCycle2\v1\models;

use Yii;

class custommodel extends \app\models\Nixxis\Data {

    public $N_DATEPA_DAY;
    public $N_DATEPA_MONTH;
    public $N_DATEPA_YEAR;
    public $DATE_RAPPEL;
    public $HEURE_RAPPEL;

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if (($this->ADR1 != $this->getOldAttribute('ADR1')) || ($this->ADR2 != $this->getOldAttribute('ADR2')) || ($this->ADR3 != $this->getOldAttribute('ADR3')) || ($this->ADR4 != $this->getOldAttribute('ADR4')) || ($this->CP != $this->getOldAttribute('CP')) || ($this->VILLE != $this->getOldAttribute('VILLE')) || ($this->PAYS != $this->getOldAttribute('PAYS')) || ($this->NUMERO_DE_RUE != $this->getOldAttribute('NUMERO_DE_RUE')) || ($this->CODE_BIS != $this->getOldAttribute('CODE_BIS'))
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

    public static function getYears() {
        $years = array();
        $curYear = date("Y");
        $limit = 0;
        $offsetstart = 50;
        for ($x = $curYear - $offsetstart; $x < $curYear + $limit; $x++) {
            $years[$x] = $x;
        }
        return $years;
    }

    public static function GetFormulaireCycles() {
        return array(
            ['id' => '12', 'name' => 'Tous les mois'],
            ['id' => '6', 'name' => 'Tous les 2 mois'],
            ['id' => '4', 'name' => 'Tous les 3 mois'],
            ['id' => '2', 'name' => 'Tous les 6 mois'],
            ['id' => '1', 'name' => 'Tous les 12 mois'],
        );
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

}
