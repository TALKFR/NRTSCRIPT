<?php

namespace app\scripts\LCDE_REACTIVIATION\v1\models;

use Yii;
use yii\helpers\ArrayHelper;

class custommodel extends \app\models\Nixxis\Data {

    public function afterFind() {
        
    }

    public function beforeValidate() {
        parent::beforeValidate();


        return true;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        $p_rules = parent::rules();
        $rules = [
            [['N_MONTANT'], 'double', 'message' => 'La valeur doit être un montant valide'],
            [['N_MONTANT'], 'required', 'on' => 'DSM', 'message' => 'Ce champs ne peut être vide'],
            [['N_MONTANT'], 'required', 'on' => 'DSMENLIGNE', 'message' => 'Ce champs ne peut être vide'],
            [['N_MONTANT', 'N_PERIODICITE', 'N_DATEPA'], 'required', 'on' => 'PAM', 'message' => 'Ce champs ne peut être vide'],
            [['N_MONTANT', 'N_PERIODICITE', 'N_DATEPA'], 'required', 'on' => 'PAMSLIMPAY', 'message' => 'Ce champs ne peut être vide'],
            [['N_MONTANT', 'N_PERIODICITE', 'N_DATEPA'], 'required', 'on' => 'PAMENLIGNE', 'message' => 'Ce champs ne peut être vide'],
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
            ['id' => '1', 'name' => 'Tous les mois'],
            ['id' => '3', 'name' => 'Tous les 3 mois'],
            ['id' => '6', 'name' => 'Tous les 6 mois'],
            ['id' => '12', 'name' => 'Tous les 12 mois'],
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

    public static function GetFormulaireObs() {
        return array(
            ['id' => '0', 'name' => 'Pas d\'observation'],
            ['id' => '1', 'name' => 'Ne souhaite plus être appelé'],
            ['id' => '2', 'name' => 'Désire être rayé du fichier'],
            ['id' => '3', 'name' => 'Désire recevoir 1 à 2 courriers'],
            ['id' => '4', 'name' => 'N\'a pas reçu son reçu fiscal'],
            ['id' => '5', 'name' => 'Déçu par l\'organisme'],
            ['id' => '6', 'name' => 'Souhaite être bénévole'],
            ['id' => '7', 'name' => 'Décédé'],
            ['id' => '8', 'name' => 'Déménagé'],
            ['id' => '9', 'name' => 'Doublons'],
            ['id' => '10', 'name' => 'N\'adhère plus à la cause'],
            ['id' => '11', 'name' => 'A quitté l\'association'],
            ['id' => '11', 'name' => 'Refus catégorique du PA']
        );
    }

}
