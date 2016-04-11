<?php

namespace app\scripts\Artisans\v1\models;

use Yii;

class custommodel extends \app\models\Nixxis\Data {

    public $N_DATEPA_DAY;
    public $N_DATEPA_MONTH;
    public $N_DATEPA_YEAR;
    public $DATE_RAPPEL;
    public $HEURE_RAPPEL;

    public function beforeValidate() {
        parent::beforeValidate();

        if ($this->DATE_RAPPEL != '' && $this->HEURE_RAPPEL != '') {
            $this->_DATE_RAPPEL = $this->DATE_RAPPEL . ' ' . $this->HEURE_RAPPEL;
        }
        if ($this->N_DATEPA_MONTH != '' && $this->N_DATEPA_YEAR != '') {
            $this->_DATE_CREATION = $this->N_DATEPA_MONTH . '/' . $this->N_DATEPA_YEAR;
        }

        return true;
    }

    public function afterFind() {
        if ($this->_DATE_CREATION != '') {
            $this->N_DATEPA_MONTH = substr($this->_DATE_CREATION, 0, 2);
            $this->N_DATEPA_YEAR = substr($this->_DATE_CREATION, 3, 4);
        }
        if ($this->_DATE_RAPPEL != '') {
            $this->DATE_RAPPEL = substr($this->_DATE_RAPPEL, 0, 10);
            $this->HEURE_RAPPEL = substr($this->_DATE_RAPPEL, 11, 5);
        }
    }

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

    public static function GetFormulaireActivitités() {
        return array(
            ['id' => '6', 'name' => 'Construction - Extension'],
            ['id' => '7', 'name' => 'Rénovation intérieure'],
            ['id' => '8', 'name' => 'Aménagement intérieur'],
            ['id' => '9', 'name' => 'Maçonnerie - Démolition'],
            ['id' => '10', 'name' => 'Architecture - Expertise'],
            ['id' => '11', 'name' => 'Diagnostics - Traitements'],
            ['id' => '12', 'name' => 'Chauffage - Chaudière'],
            ['id' => '13', 'name' => 'Cheminée et accessoires'],
            ['id' => '14', 'name' => 'Climatisation - Ventilation'],
            ['id' => '15', 'name' => 'Electricité - Courant faible'],
            ['id' => '16', 'name' => 'Alarme - Sécurité - Incendie'],
            ['id' => '17', 'name' => 'Façade (ravalement, enduit,...)'],
            ['id' => '18', 'name' => 'Plafond - Cloison - Plâtre'],
            ['id' => '19', 'name' => 'Menuiseries (alu, bois, pvc)'],
            ['id' => '20', 'name' => 'Isolation thermique et acoustique'],
            ['id' => '21', 'name' => 'Piscine - Abri piscine'],
            ['id' => '22', 'name' => 'Plomberie'],
            ['id' => '23', 'name' => 'Cuisine'],
            ['id' => '24', 'name' => 'Salle de bains - WC - SPA'],
            ['id' => '25', 'name' => 'Peinture - Tapisserie'],
            ['id' => '26', 'name' => 'Sols intérieurs'],
            ['id' => '27', 'name' => 'Sols extérieurs'],
            ['id' => '28', 'name' => 'Véranda - Pergola - Verrière'],
            ['id' => '29', 'name' => 'Toiture - Charpente - Couverture'],
            ['id' => '30', 'name' => 'Jardin - Clôture - Portail'],
            ['id' => '31', 'name' => 'Assainissement - Terrassement'],
            ['id' => '33', 'name' => 'Escalier - Garde corps'],
            ['id' => '243', 'name' => 'Ascenseur - Monte-charges'],
            ['id' => '291', 'name' => 'Devis divers'],
            ['id' => '316', 'name' => 'Services aux entreprises'],
            ['id' => '766', 'name' => 'Fenêtres (PVC, bois, alu)']
        );
//        return array(
//            ['id' => '1000058', 'name' => 'Aménagement extérieur - intérieur'],
//            ['id' => '1000059', 'name' => 'Architecture - Maîtrise d\'ouvrage'],
//            ['id' => '1000060', 'name' => 'Ascenseur - Élévateur'],
//            ['id' => '1000063', 'name' => 'Construction'],
//            ['id' => '1000085', 'name' => 'Construction et installation de piscine'],
//            ['id' => '1000064', 'name' => 'Couverture - Toiture - Charpente'],
//            ['id' => '1000066', 'name' => 'Décoration'],
//            ['id' => '1000067', 'name' => 'Diagnostic'],
//            ['id' => '1000068', 'name' => 'Drainage - Canalisation'],
//            ['id' => '1000070', 'name' => 'Électricité - Cablage - Antenne'],
//            ['id' => '1000072', 'name' => 'Énergie renouvelable'],
//            ['id' => '1000073', 'name' => 'Escalier - Garde corps'],
//            ['id' => '1000075', 'name' => 'Étanchéité'],
//            ['id' => '1000076', 'name' => 'Expertise'],
//            ['id' => '1000065', 'name' => 'Installation et aménagement de cuisine'],
//            ['id' => '1000061', 'name' => 'Installation et entretien de chaudière - chauffage'],
//            ['id' => '1000078', 'name' => 'Isolation'],
//            ['id' => '1000074', 'name' => 'Jardin - espace vert'],
//            ['id' => '1000080', 'name' => 'Maçonnerie - Gros œuvre - Démolition'],
//            ['id' => '1000082', 'name' => 'Ménage - Nettoyage'],
//            ['id' => '1000083', 'name' => 'Menuiserie - Ébénisterie'],
//            ['id' => '1000084', 'name' => 'Peinture'],
//            ['id' => '1000086', 'name' => 'Plomberie'],
//            ['id' => '1000087', 'name' => 'Portail - Porte de garage'],
//            ['id' => '1000088', 'name' => 'Pose de sol intérieur - extérieur'],
//            ['id' => '1000062', 'name' => 'Ramonage de cheminée - installation - construction'],
//            ['id' => '1000077', 'name' => 'Ravalement - rénovation de façade'],
//            ['id' => '1000091', 'name' => 'Rénovation Intérieur Extérieur'],
//            ['id' => '1000092', 'name' => 'Sanitaire - Salle de bains'],
//            ['id' => '1000094', 'name' => 'Service aux entreprises'],
//            ['id' => '1000095', 'name' => 'Services funéraires'],
//            ['id' => '1000097', 'name' => 'Store - Volet'],
//            ['id' => '1000093', 'name' => 'Système d\'alarme - sécurité et domotique'],
//            ['id' => '1000098', 'name' => 'Terrasse - Pergola - Clôture'],
//            ['id' => '1000099', 'name' => 'Terrassement - Viabilisation - Surélévation'],
//            ['id' => '1000100', 'name' => 'Traitement'],
//            ['id' => '1000101', 'name' => 'Travaux acrobatiques'],
//            ['id' => '1000102', 'name' => 'Ventilation - Climatisation'],
//            ['id' => '1000103', 'name' => 'Véranda - Verrière'],
//            ['id' => '1000104', 'name' => 'Vitrage - Vitrine - Enseigne'],
//        );
    }

    public static function GetFormulaireNbSalaries() {
        return array(
            ['id' => '0', 'name' => '0'],
            ['id' => '1', 'name' => '1-5'],
            ['id' => '2', 'name' => '6-10'],
            ['id' => '3', 'name' => '11-15'],
            ['id' => '4', 'name' => '16+'],
        );
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

}
