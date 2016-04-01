<?php

namespace app\models\Campaigns;

use Yii;

/*
 * 
 * GP REACT CYCLE3
 */

/**
 * This is the model class for table "DATA_ae19af13398c4a2d98dbe1b0404b309a".
 *
 * @property string $Internal__id__
 * @property string $ADR1
 * @property string $RETOUR_JOURPRELEVEMENT
 * @property string $A_PERIODICITE
 * @property string $CP
 * @property string $FILTRE
 * @property string $RETOUR_CATHEORIQUE
 * @property string $RETOUR_DATESAISIE
 * @property string $TEL2
 * @property string $PRENOM
 * @property string $CODE_MEDIA
 * @property string $ADR2
 * @property string $ADR3
 * @property string $IDENTIFIANT2
 * @property string $RETOUR_COUPON
 * @property string $TEL3
 * @property string $RETOUR_PREMIERPRELEVEMENT
 * @property string $RETOUR_PERIODICITE
 * @property string $DATE_DE_NAISSANCE
 * @property string $RETOUR_MONTANT
 * @property string $TEL1
 * @property string $COMMENTAIRE_DONATEUR
 * @property string $RETOUR_DATESIGNATURE
 * @property string $RETOUR_NOMFICHIER
 * @property string $NOM
 * @property string $CIV
 * @property string $EMAIL2
 * @property string $COMMENTAIRE_APPEL
 * @property string $N_DATEPA
 * @property string $PRIORITE
 * @property integer $MODIF_TEL
 * @property string $EMAIL1
 * @property string $RETOUR_DATEIMPORT
 * @property string $A_TEL2
 * @property string $RETOUR_FLAG
 * @property string $A_TEL1
 * @property string $PAYS
 * @property string $N_PERIODICITE
 * @property string $VILLE
 * @property string $ADR4
 * @property string $RETOUR_PROMESSE
 * @property integer $MODIF_EMAIL
 * @property string $RETOUR_DATEDENVOI
 * @property string $N_MONTANT
 * @property integer $MODIF_ADRESSE
 * @property string $IDENTIFIANT1
 * @property string $RETOUR_IDSCAN
 * @property string $A_DATEPA
 * @property string $A_MONTANT
 * @property string $RAISON_SOCIALE_ENTREPRISE
 * @property string $NUMERO_DE_RUE
 * @property string $CODE_BIS
 */
class DATAae19af13398c4a2d98dbe1b0404b309a extends \app\models\Nixxis\Data {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'DATA_ae19af13398c4a2d98dbe1b0404b309a';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('dbv2');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Internal__id__'], 'required'],
            [['Internal__id__', 'ADR1', 'RETOUR_JOURPRELEVEMENT', 'A_PERIODICITE', 'CP', 'FILTRE', 'RETOUR_CATHEORIQUE', 'RETOUR_DATESAISIE', 'TEL2', 'PRENOM', 'CODE_MEDIA', 'ADR2', 'ADR3', 'IDENTIFIANT2', 'RETOUR_COUPON', 'TEL3', 'RETOUR_PREMIERPRELEVEMENT', 'RETOUR_PERIODICITE', 'DATE_DE_NAISSANCE', 'RETOUR_MONTANT', 'TEL1', 'COMMENTAIRE_DONATEUR', 'RETOUR_DATESIGNATURE', 'RETOUR_NOMFICHIER', 'NOM', 'CIV', 'EMAIL2', 'COMMENTAIRE_APPEL', 'N_DATEPA', 'PRIORITE', 'EMAIL1', 'RETOUR_DATEIMPORT', 'A_TEL2', 'RETOUR_FLAG', 'A_TEL1', 'PAYS', 'N_PERIODICITE', 'VILLE', 'ADR4', 'RETOUR_PROMESSE', 'RETOUR_DATEDENVOI', 'N_MONTANT', 'IDENTIFIANT1', 'RETOUR_IDSCAN', 'A_DATEPA', 'A_MONTANT', 'RAISON_SOCIALE_ENTREPRISE', 'NUMERO_DE_RUE', 'CODE_BIS'], 'string'],
            [['MODIF_TEL', 'MODIF_ADRESSE', 'MODIF_EMAIL'], 'integer'],
            [['EMAIL1', 'EMAIL2'], 'email', 'message' => 'La valeur doit être un email valide'],
            [['TEL1', 'TEL2'], 'app\components\NixxisPhoneNumberValidator', 'format' => 'FR'],
            [['N_MONTANT'], 'double', 'message' => 'La valeur doit être un montant valide'],
            [['N_MONTANT', 'N_PERIODICITE'], 'required', 'on' => 'PA', 'message' => 'Ce champs ne peut être vide'],
            [['N_MONTANT'], 'required', 'on' => 'DU', 'message' => 'Ce champs ne peut être vide'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'Internal__id__' => 'Internal  ID',
            'ADR1' => 'Adr1',
            'RETOUR_JOURPRELEVEMENT' => 'Retour  Jourprelevement',
            'A_PERIODICITE' => 'A  Periodicite',
            'CP' => 'Cp',
            'FILTRE' => 'Filtre',
            'RETOUR_CATHEORIQUE' => 'Retour  Catheorique',
            'RETOUR_DATESAISIE' => 'Retour  Datesaisie',
            'TEL2' => 'Tel2',
            'PRENOM' => 'Prenom',
            'CODE_MEDIA' => 'Code  Media',
            'ADR2' => 'Adr2',
            'ADR3' => 'Adr3',
            'IDENTIFIANT2' => 'Identifiant2',
            'RETOUR_COUPON' => 'Retour  Coupon',
            'TEL3' => 'Tel3',
            'RETOUR_PREMIERPRELEVEMENT' => 'Retour  Premierprelevement',
            'RETOUR_PERIODICITE' => 'Retour  Periodicite',
            'DATE_DE_NAISSANCE' => 'Date  De  Naissance',
            'RETOUR_MONTANT' => 'Retour  Montant',
            'TEL1' => 'Tel1',
            'COMMENTAIRE_DONATEUR' => 'Commentaire  Donateur',
            'RETOUR_DATESIGNATURE' => 'Retour  Datesignature',
            'RETOUR_NOMFICHIER' => 'Retour  Nomfichier',
            'NOM' => 'Nom',
            'CIV' => 'Civ',
            'EMAIL2' => 'Email2',
            'COMMENTAIRE_APPEL' => 'Commentaire  Appel',
            'N_DATEPA' => 'N  Datepa',
            'PRIORITE' => 'Priorite',
            'MODIF_TEL' => 'Modif  Tel',
            'EMAIL1' => 'Email1',
            'RETOUR_DATEIMPORT' => 'Retour  Dateimport',
            'A_TEL2' => 'A  Tel2',
            'RETOUR_FLAG' => 'Retour  Flag',
            'A_TEL1' => 'A  Tel1',
            'PAYS' => 'Pays',
            'N_PERIODICITE' => 'N  Periodicite',
            'VILLE' => 'Ville',
            'ADR4' => 'Adr4',
            'RETOUR_PROMESSE' => 'Retour  Promesse',
            'MODIF_EMAIL' => 'Modif  Email',
            'RETOUR_DATEDENVOI' => 'Retour  Datedenvoi',
            'N_MONTANT' => 'N  Montant',
            'MODIF_ADRESSE' => 'Modif  Adresse',
            'IDENTIFIANT1' => 'Identifiant1',
            'RETOUR_IDSCAN' => 'Retour  Idscan',
            'A_DATEPA' => 'A  Datepa',
            'A_MONTANT' => 'A  Montant',
            'RAISON_SOCIALE_ENTREPRISE' => 'Raison  Sociale  Entreprise',
            'NUMERO_DE_RUE' => 'Numero  De  Rue',
            'CODE_BIS' => 'Code  Bis',
        ];
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

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if (($this->ADR1 != $this->getOldAttribute('ADR1')) || ($this->ADR2 != $this->getOldAttribute('ADR2')) || ($this->ADR3 != $this->getOldAttribute('ADR3')) || ($this->ADR4 != $this->getOldAttribute('ADR4')) || ($this->CP != $this->getOldAttribute('CP')) || ($this->VILLE != $this->getOldAttribute('VILLE')) || ($this->PAYS != $this->getOldAttribute('PAYS'))) {
            $this->MODIF_ADRESSE = 1;
        }

        if (($this->TEL1 != $this->getOldAttribute('TEL1')) || ($this->TEL2 != $this->getOldAttribute('TEL2')) || ($this->TEL3 != $this->getOldAttribute('TEL3'))) {
            $this->MODIF_TEL = 1;
        }

        if (($this->EMAIL1 != $this->getOldAttribute('EMAIL1')) || ($this->EMAIL2 != $this->getOldAttribute('EMAIL2'))) {
            $this->MODIF_EMAIL = 1;
        }
        return true;
    }

}
