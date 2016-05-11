<?php

namespace app\scripts\GREENPEACE_REACTIVATION_CYCLE3\v1\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
* This is the model class for table "DATA_Ae19af13398c4a2d98dbe1b0404b309a".
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
    * @property string $_SIGNUP_DATE
    * @property string $_INITIAL_SOURCE
    * @property string $_FIRST_RG_DATE
    * @property string $_FIRST_RG_AMOUNT
    * @property string $_LAST_RG_ANNUAL_VALUE
    * @property string $_AMOUNT_BRACKET
    * @property string $_LIFETIME_RG_DONATIONS
    * @property string $_LIFETIME_RG_DONATIONS_AMOUNT
*/
class DATAAe19af13398c4a2d98dbe1b0404b309a extends custommodel
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'DATA_Ae19af13398c4a2d98dbe1b0404b309a';
}

    /**
    * @return \yii\db\Connection the database connection used by this AR class.
    */
    public static function getDb()
    {
    return Yii::$app->get('dbv2');
    }

/**
* @inheritdoc
*/
public function rules()
{
$p_rules = parent::rules();
$rules = [
            [['Internal__id__'], 'required'],
            [['Internal__id__', 'ADR1', 'RETOUR_JOURPRELEVEMENT', 'A_PERIODICITE', 'CP', 'FILTRE', 'RETOUR_CATHEORIQUE', 'RETOUR_DATESAISIE', 'TEL2', 'PRENOM', 'CODE_MEDIA', 'ADR2', 'ADR3', 'IDENTIFIANT2', 'RETOUR_COUPON', 'TEL3', 'RETOUR_PREMIERPRELEVEMENT', 'RETOUR_PERIODICITE', 'DATE_DE_NAISSANCE', 'RETOUR_MONTANT', 'TEL1', 'COMMENTAIRE_DONATEUR', 'RETOUR_DATESIGNATURE', 'RETOUR_NOMFICHIER', 'NOM', 'CIV', 'EMAIL2', 'COMMENTAIRE_APPEL', 'N_DATEPA', 'PRIORITE', 'EMAIL1', 'RETOUR_DATEIMPORT', 'A_TEL2', 'RETOUR_FLAG', 'A_TEL1', 'PAYS', 'N_PERIODICITE', 'VILLE', 'ADR4', 'RETOUR_PROMESSE', 'RETOUR_DATEDENVOI', 'N_MONTANT', 'IDENTIFIANT1', 'RETOUR_IDSCAN', 'A_DATEPA', 'A_MONTANT', 'RAISON_SOCIALE_ENTREPRISE', 'NUMERO_DE_RUE', 'CODE_BIS', '_SIGNUP_DATE', '_INITIAL_SOURCE', '_FIRST_RG_DATE', '_FIRST_RG_AMOUNT', '_LAST_RG_ANNUAL_VALUE', '_AMOUNT_BRACKET', '_LIFETIME_RG_DONATIONS', '_LIFETIME_RG_DONATIONS_AMOUNT'], 'string'],
            [['MODIF_TEL', 'MODIF_EMAIL', 'MODIF_ADRESSE'], 'integer']
        ];
return ArrayHelper::merge($p_rules, $rules);
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
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
    '_SIGNUP_DATE' => 'Signup  Date',
    '_INITIAL_SOURCE' => 'Initial  Source',
    '_FIRST_RG_DATE' => 'First  Rg  Date',
    '_FIRST_RG_AMOUNT' => 'First  Rg  Amount',
    '_LAST_RG_ANNUAL_VALUE' => 'Last  Rg  Annual  Value',
    '_AMOUNT_BRACKET' => 'Amount  Bracket',
    '_LIFETIME_RG_DONATIONS' => 'Lifetime  Rg  Donations',
    '_LIFETIME_RG_DONATIONS_AMOUNT' => 'Lifetime  Rg  Donations  Amount',
];
}
}
