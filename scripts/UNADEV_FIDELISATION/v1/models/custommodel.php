<?php

namespace app\scripts\UNADEV_FIDELISATION\v1\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\components\Validators\IntervalValidator;
use app\components\Validators\NixxisDateValidator;

class custommodel extends \app\models\Nixxis\Data {

    public $N_DATEPA_DAY;
    public $N_DATEPA_MONTH;
    public $N_DATEPA_YEAR;

    public function afterFind() {
        
    }

    public function beforeValidate() {
        parent::beforeValidate();
        $this->N_DATEPA = $this->N_DATEPA_DAY . '/' . $this->N_DATEPA_MONTH . '/' . $this->N_DATEPA_YEAR;
        if ($this->N_DATEPA_MONTH == '' && $this->scenario != 'PAM SLIMPAY') {
            $this->N_DATEPA = '';
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        $p_rules = parent::rules();
        $rules = [
            [['N_DATEPA_DAY', 'N_DATEPA_MONTH', 'N_DATEPA_YEAR', 'CHIENCHATS'], 'safe'],
            [['N_MONTANT'], 'double', 'message' => 'La valeur doit être un montant valide'],
            [['N_MONTANT', 'N_PERIODICITE', 'N_DATEPA_DAY', 'N_DATEPA_MONTH', 'N_DATEPA_YEAR', 'N_DATEPA'], 'required', 'on' => 'PAM SLIMPAY', 'message' => 'Ce champs ne peut être vide'],
            [['N_MONTANT', 'N_PERIODICITE',], 'required', 'on' => 'PAM', 'message' => 'Ce champs ne peut être vide'],
            [['N_DATEPA'], 'safe', 'on' => 'PA'],
            [['N_MONTANT'], 'required', 'on' => 'DSM/DSM EN LIGNE', 'message' => 'Ce champs ne peut être vide'],
            [['DATE_DE_NAISSANCE'], NixxisDateValidator::className()],
            [['N_DATEPA'], IntervalValidator::className(), 'on' => 'PAM SLIMPAY'],
            ['N_MONTANT', 'compare', 'compareValue' => 0, 'operator' => '>', 'message' => 'Le montant doit être supérieur à 0'],
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

    public static function GetFormulaireCycles() {

        return array(
            ['id' => 'Mensuelle', 'name' => 'Tous les mois'],
            ['id' => 'Trimestrielle', 'name' => 'Tous les 3 mois'],
            ['id' => 'Semestrielle', 'name' => 'Tous les 6 mois'],
            ['id' => 'Annuelle', 'name' => 'Tous les ans'],
        );
    }

    public static function GetFormulaireChienChats() {
        return array(
            ['id' => 'CHIEN', 'name' => 'Chien'],
            ['id' => 'CHAT', 'name' => 'Chat'],
            ['id' => 'AUCUN', 'name' => 'Aucun'],
        );
    }

    /**
     * 
     * @param type $day
     * @return \DateTime
     */
    public static function GetMonthProchainPA($day) {
        $datedujour = new \DateTime(Date('Y-m-d'));
        //$datedujour = new \DateTime('2016-12-01');
        for ($i = 0; $i < 3; $i++) {
            $tmp = clone $datedujour;
            $d = $tmp->format('d');
            $m = $tmp->format('m');
            $Y = $tmp->format('Y');
            $tmp->setDate($Y, $m, $day);
            $datenpa = $tmp->add(new \DateInterval('P' . $i . 'M'));
            $diff = ($datenpa < $datedujour) ? -1 * ($datenpa->diff($datedujour)->format("%a")) : $datenpa->diff($datedujour)->format("%a");
            if ($diff > 10) {
                break;
            }
        }
        //echo $datenpa->format('Y-m-d');
        return $datenpa->format('m');
    }

    /**
     * 
     * @param type $day
     * @return \DateTime
     */
    public static function GetYearProchainPA($day) {
        $datedujour = new \DateTime(Date('Y-m-d'));
        //$datedujour = new \DateTime('2016-12-01');
        for ($i = 0; $i < 3; $i++) {
            $tmp = clone $datedujour;
            $d = $tmp->format('d');
            $m = $tmp->format('m');
            $Y = $tmp->format('Y');
            $tmp->setDate($Y, $m, $day);
            $datenpa = $tmp->add(new \DateInterval('P' . $i . 'M'));
            $diff = ($datenpa < $datedujour) ? -1 * ($datenpa->diff($datedujour)->format("%a")) : $datenpa->diff($datedujour)->format("%a");
            if ($diff > 10) {
                break;
            }
        }
        //echo $datenpa->format('Y-m-d');
        return $datenpa->format('Y');
    }

}
