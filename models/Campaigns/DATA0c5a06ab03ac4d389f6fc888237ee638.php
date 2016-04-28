<?php

namespace app\models\Campaigns;

use Yii;

/*
 * GP PROSPECTION
 */

/**
 * This is the model class for table "DATA_0c5a06ab03ac4d389f6fc888237ee638".
 *
 * @property string $Internal__id__
 * @property string $CODE_MEDIA
 * @property string $IDENTIFIANT1
 * @property string $IDENTIFIANT2
 * @property string $CIV
 * @property string $NOM
 * @property string $PRENOM
 * @property string $ADR1
 * @property string $ADR2
 * @property string $NUMERO_DE_RUE
 * @property string $CODE_BIS
 * @property string $ADR3
 * @property string $ADR4
 * @property string $CP
 * @property string $VILLE
 * @property string $PAYS
 * @property integer $MODIF_ADRESSE
 * @property string $TEL1
 * @property string $TEL2
 * @property integer $MODIF_TEL
 * @property string $EMAIL1
 * @property string $EMAIL2
 * @property integer $MODIF_EMAIL
 * @property string $DATE_DE_NAISSANCE
 * @property string $A_MONTANT
 * @property string $A_PERIODICITE
 * @property string $A_DATEPA
 * @property string $COMMENTAIRE_APPEL
 * @property string $COMMENTAIRE_DONATEUR
 * @property string $N_MONTANT
 * @property string $N_PERIODICITE
 * @property string $N_DATEPA
 * @property string $FILTRE
 * @property string $PRIORITE
 * @property string $RETOUR_FLAG
 * @property string $RETOUR_DATEIMPORT
 * @property string $RETOUR_NOMFICHIER
 * @property string $RETOUR_PROMESSE
 * @property string $RETOUR_MONTANT
 * @property string $RETOUR_PERIODICITE
 * @property string $RETOUR_COUPON
 * @property string $RETOUR_DATESIGNATURE
 * @property string $RETOUR_DATESAISIE
 * @property string $RETOUR_JOURPRELEVEMENT
 * @property string $RETOUR_PREMIERPRELEVEMENT
 * @property string $RETOUR_CATHEORIQUE
 * @property string $RETOUR_IDSCAN
 * @property string $RETOUR_DATEDENVOI
 * @property string $_LEADS_SIGN_UP_DATE
 * @property string $A_TEL1
 * @property string $A_TEL2
 * @property string $TEL3
 * @property string $RS1
 * @property string $RS2
 */
class DATA0c5a06ab03ac4d389f6fc888237ee638 extends \app\models\Nixxis\Data {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'DATA_0c5a06ab03ac4d389f6fc888237ee638';
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
            [['Internal__id__', 'CODE_MEDIA', 'IDENTIFIANT1', 'IDENTIFIANT2', 'CIV', 'NOM', 'PRENOM', 'ADR1', 'ADR2', 'NUMERO_DE_RUE', 'CODE_BIS', 'ADR3', 'ADR4', 'CP', 'VILLE', 'PAYS', 'TEL1', 'TEL2', 'EMAIL1', 'EMAIL2', 'DATE_DE_NAISSANCE', 'A_MONTANT', 'A_PERIODICITE', 'A_DATEPA', 'COMMENTAIRE_APPEL', 'COMMENTAIRE_DONATEUR', 'N_MONTANT', 'N_PERIODICITE', 'N_DATEPA', 'FILTRE', 'PRIORITE', 'RETOUR_FLAG', 'RETOUR_DATEIMPORT', 'RETOUR_NOMFICHIER', 'RETOUR_PROMESSE', 'RETOUR_MONTANT', 'RETOUR_PERIODICITE', 'RETOUR_COUPON', 'RETOUR_DATESIGNATURE', 'RETOUR_DATESAISIE', 'RETOUR_JOURPRELEVEMENT', 'RETOUR_PREMIERPRELEVEMENT', 'RETOUR_CATHEORIQUE', 'RETOUR_IDSCAN', 'RETOUR_DATEDENVOI', '_LEADS_SIGN_UP_DATE', 'A_TEL1', 'A_TEL2', 'TEL3', 'RS1', 'RS2'], 'string'],
            [['MODIF_ADRESSE', 'MODIF_TEL', 'MODIF_EMAIL'], 'integer'],
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
            'CODE_MEDIA' => 'Code  Media',
            'IDENTIFIANT1' => 'Identifiant1',
            'IDENTIFIANT2' => 'Identifiant2',
            'CIV' => 'Civ',
            'NOM' => 'Nom',
            'PRENOM' => 'Prenom',
            'ADR1' => 'Adr1',
            'ADR2' => 'Adr2',
            'NUMERO_DE_RUE' => 'Numero  De  Rue',
            'CODE_BIS' => 'Code  Bis',
            'ADR3' => 'Adr3',
            'ADR4' => 'Adr4',
            'CP' => 'Cp',
            'VILLE' => 'Ville',
            'PAYS' => 'Pays',
            'MODIF_ADRESSE' => 'Modif  Adresse',
            'TEL1' => 'Tel1',
            'TEL2' => 'Tel2',
            'MODIF_TEL' => 'Modif  Tel',
            'EMAIL1' => 'Email1',
            'EMAIL2' => 'Email2',
            'MODIF_EMAIL' => 'Modif  Email',
            'DATE_DE_NAISSANCE' => 'Date  De  Naissance',
            'A_MONTANT' => 'A  Montant',
            'A_PERIODICITE' => 'A  Periodicite',
            'A_DATEPA' => 'A  Datepa',
            'COMMENTAIRE_APPEL' => 'Commentaire  Appel',
            'COMMENTAIRE_DONATEUR' => 'Commentaire  Donateur',
            'N_MONTANT' => 'N  Montant',
            'N_PERIODICITE' => 'N  Periodicite',
            'N_DATEPA' => 'N  Datepa',
            'FILTRE' => 'Filtre',
            'PRIORITE' => 'Priorite',
            'RETOUR_FLAG' => 'Retour  Flag',
            'RETOUR_DATEIMPORT' => 'Retour  Dateimport',
            'RETOUR_NOMFICHIER' => 'Retour  Nomfichier',
            'RETOUR_PROMESSE' => 'Retour  Promesse',
            'RETOUR_MONTANT' => 'Retour  Montant',
            'RETOUR_PERIODICITE' => 'Retour  Periodicite',
            'RETOUR_COUPON' => 'Retour  Coupon',
            'RETOUR_DATESIGNATURE' => 'Retour  Datesignature',
            'RETOUR_DATESAISIE' => 'Retour  Datesaisie',
            'RETOUR_JOURPRELEVEMENT' => 'Retour  Jourprelevement',
            'RETOUR_PREMIERPRELEVEMENT' => 'Retour  Premierprelevement',
            'RETOUR_CATHEORIQUE' => 'Retour  Catheorique',
            'RETOUR_IDSCAN' => 'Retour  Idscan',
            'RETOUR_DATEDENVOI' => 'Retour  Datedenvoi',
            '_LEADS_SIGN_UP_DATE' => 'Leads  Sign  Up  Date',
            'A_TEL1' => 'A  Tel1',
            'A_TEL2' => 'A  Tel2',
            'TEL3' => 'Tel3',
            'RS1' => 'Rs1',
            'RS2' => 'Rs2',
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
