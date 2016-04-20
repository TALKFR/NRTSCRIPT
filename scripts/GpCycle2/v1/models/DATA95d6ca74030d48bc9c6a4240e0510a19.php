<?php

namespace app\scripts\GpCycle2\v1\models;

use Yii;

/**
 * This is the model class for table "DATA_95d6ca74030d48bc9c6a4240e0510a19".
 *
 * @property string $Internal__id__
 * @property string $CODE_MEDIA
 * @property string $IDENTIFIANT1
 * @property string $IDENTIFIANT2
 * @property string $RS1
 * @property string $RS2
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
 * @property string $TEL3
 * @property integer $MODIF_TEL
 * @property string $EMAIL1
 * @property string $EMAIL2
 * @property integer $MODIF_EMAIL
 * @property string $A_MONTANT
 * @property string $A_PERIODICITE
 * @property string $A_DATEPA
 * @property string $A_JOURPA
 * @property string $A_MOISPA
 * @property string $N_MONTANT
 * @property string $N_PERIODICITE
 * @property string $N_DATEPA
 * @property string $COMMENTAIRE_APPEL
 * @property string $COMMENTAIRE_DONATEUR
 * @property string $DATE_DE_NAISSANCE
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
 * @property string $A_TEL1
 * @property string $A_TEL2
 * @property string $_SIGNUP_DATE
 * @property string $_INITIAL_SOURCE
 * @property string $_FIRST_RG_DATE
 * @property string $_FIRST_RG_AMOUNT
 * @property string $_LAST_RG_ANNUAL_VALUE
 * @property string $_AMOUNT_BRACKET
 * @property string $_LIFETIME_RG_DONATIONS_AMOUNT
 * @property string $_PAYMENT_METHOD
 * @property string $_REASON
 */
class DATA95d6ca74030d48bc9c6a4240e0510a19 extends custommodel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'DATA_95d6ca74030d48bc9c6a4240e0510a19';
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
            [['Internal__id__', 'ADR1', 'RETOUR_JOURPRELEVEMENT', 'A_PERIODICITE', 'CP', 'FILTRE', 'RETOUR_CATHEORIQUE', 'RETOUR_DATESAISIE', 'TEL2', 'PRENOM', 'CODE_MEDIA', 'ADR2', 'ADR3', 'IDENTIFIANT2', 'RETOUR_COUPON', 'TEL3', 'RETOUR_PREMIERPRELEVEMENT', 'RETOUR_PERIODICITE', 'DATE_DE_NAISSANCE', 'RETOUR_MONTANT', 'TEL1', 'COMMENTAIRE_DONATEUR', 'RETOUR_DATESIGNATURE', 'RETOUR_NOMFICHIER', 'NOM', 'CIV', 'EMAIL2', 'COMMENTAIRE_APPEL', 'N_DATEPA', 'PRIORITE', 'EMAIL1', 'RETOUR_DATEIMPORT', 'A_TEL2', 'RETOUR_FLAG', 'A_TEL1', 'PAYS', 'N_PERIODICITE', 'VILLE', 'ADR4', 'RETOUR_PROMESSE', 'RETOUR_DATEDENVOI', 'N_MONTANT', 'IDENTIFIANT1', 'RETOUR_IDSCAN', 'A_DATEPA', 'A_MONTANT', 'NUMERO_DE_RUE', 'CODE_BIS'], 'string'],
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
            'CODE_MEDIA' => 'Code  Media',
            'IDENTIFIANT1' => 'Identifiant1',
            'IDENTIFIANT2' => 'Identifiant2',
            'RS1' => 'Rs1',
            'RS2' => 'Rs2',
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
            'TEL3' => 'Tel3',
            'MODIF_TEL' => 'Modif  Tel',
            'EMAIL1' => 'Email1',
            'EMAIL2' => 'Email2',
            'MODIF_EMAIL' => 'Modif  Email',
            'A_MONTANT' => 'A  Montant',
            'A_PERIODICITE' => 'A  Periodicite',
            'A_DATEPA' => 'A  Datepa',
            'A_JOURPA' => 'A  Jourpa',
            'A_MOISPA' => 'A  Moispa',
            'N_MONTANT' => 'N  Montant',
            'N_PERIODICITE' => 'N  Periodicite',
            'N_DATEPA' => 'N  Datepa',
            'COMMENTAIRE_APPEL' => 'Commentaire  Appel',
            'COMMENTAIRE_DONATEUR' => 'Commentaire  Donateur',
            'DATE_DE_NAISSANCE' => 'Date  De  Naissance',
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
            'A_TEL1' => 'A  Tel1',
            'A_TEL2' => 'A  Tel2',
            '_SIGNUP_DATE' => 'Signup  Date',
            '_INITIAL_SOURCE' => 'Initial  Source',
            '_FIRST_RG_DATE' => 'First  Rg  Date',
            '_FIRST_RG_AMOUNT' => 'First  Rg  Amount',
            '_LAST_RG_ANNUAL_VALUE' => 'Last  Rg  Annual  Value',
            '_AMOUNT_BRACKET' => 'Amount  Bracket',
            '_LIFETIME_RG_DONATIONS_AMOUNT' => 'Lifetime  Rg  Donations  Amount',
            '_PAYMENT_METHOD' => 'Payment  Method',
            '_REASON' => 'Reason',
        ];
    }

}
