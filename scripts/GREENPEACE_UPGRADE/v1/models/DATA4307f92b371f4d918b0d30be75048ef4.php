<?php

namespace app\scripts\GREENPEACE_UPGRADE\v1\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
* This is the model class for table "DATA_4307f92b371f4d918b0d30be75048ef4".
*
    * @property string $Internal__id__
    * @property string $PRENOM
    * @property string $A_MONTANT
    * @property string $N_PERIODICITE
    * @property string $VILLE
    * @property string $RETOUR_CATHEORIQUE
    * @property string $RETOUR_PROMESSE
    * @property string $RETOUR_MONTANT
    * @property string $RETOUR_DATESAISIE
    * @property string $RETOUR_COUPON
    * @property string $RETOUR_PREMIERPRELEVEMENT
    * @property string $IDENTIFIANT1
    * @property string $EMAIL1
    * @property string $TEL2
    * @property string $TEL1
    * @property string $COMMENTAIRE_DONATEUR
    * @property string $RETOUR_PERIODICITE
    * @property string $DATE_DE_NAISSANCE
    * @property string $ADR2
    * @property string $RETOUR_DATEDENVOI
    * @property string $COMMENTAIRE_APPEL
    * @property string $IDENTIFIANT2
    * @property string $A_DATEPA
    * @property string $PRIORITE
    * @property string $CODE_MEDIA
    * @property integer $MODIF_TEL
    * @property string $ADR4
    * @property string $FILTRE
    * @property string $ADR3
    * @property integer $MODIF_ADRESSE
    * @property string $EMAIL2
    * @property string $A_PERIODICITE
    * @property string $CP
    * @property string $NOM
    * @property string $RETOUR_IDSCAN
    * @property integer $MODIF_EMAIL
    * @property string $CIV
    * @property string $RETOUR_FLAG
    * @property string $RETOUR_DATESIGNATURE
    * @property string $N_DATEPA
    * @property string $ADR1
    * @property string $RETOUR_NOMFICHIER
    * @property string $N_MONTANT
    * @property string $RETOUR_JOURPRELEVEMENT
    * @property string $RETOUR_DATEIMPORT
    * @property string $TEL3
    * @property string $A_JOURPA
    * @property string $A_MOISPA
*/
class DATA4307f92b371f4d918b0d30be75048ef4 extends custommodel
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'DATA_4307f92b371f4d918b0d30be75048ef4';
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
            [['Internal__id__', 'PRENOM', 'A_MONTANT', 'N_PERIODICITE', 'VILLE', 'RETOUR_CATHEORIQUE', 'RETOUR_PROMESSE', 'RETOUR_MONTANT', 'RETOUR_DATESAISIE', 'RETOUR_COUPON', 'RETOUR_PREMIERPRELEVEMENT', 'IDENTIFIANT1', 'EMAIL1', 'TEL2', 'TEL1', 'COMMENTAIRE_DONATEUR', 'RETOUR_PERIODICITE', 'DATE_DE_NAISSANCE', 'ADR2', 'RETOUR_DATEDENVOI', 'COMMENTAIRE_APPEL', 'IDENTIFIANT2', 'A_DATEPA', 'PRIORITE', 'CODE_MEDIA', 'ADR4', 'FILTRE', 'ADR3', 'EMAIL2', 'A_PERIODICITE', 'CP', 'NOM', 'RETOUR_IDSCAN', 'CIV', 'RETOUR_FLAG', 'RETOUR_DATESIGNATURE', 'N_DATEPA', 'ADR1', 'RETOUR_NOMFICHIER', 'N_MONTANT', 'RETOUR_JOURPRELEVEMENT', 'RETOUR_DATEIMPORT', 'TEL3', 'A_JOURPA', 'A_MOISPA'], 'string'],
            [['MODIF_TEL', 'MODIF_ADRESSE', 'MODIF_EMAIL'], 'integer']
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
    'PRENOM' => 'Prenom',
    'A_MONTANT' => 'A  Montant',
    'N_PERIODICITE' => 'N  Periodicite',
    'VILLE' => 'Ville',
    'RETOUR_CATHEORIQUE' => 'Retour  Catheorique',
    'RETOUR_PROMESSE' => 'Retour  Promesse',
    'RETOUR_MONTANT' => 'Retour  Montant',
    'RETOUR_DATESAISIE' => 'Retour  Datesaisie',
    'RETOUR_COUPON' => 'Retour  Coupon',
    'RETOUR_PREMIERPRELEVEMENT' => 'Retour  Premierprelevement',
    'IDENTIFIANT1' => 'Identifiant1',
    'EMAIL1' => 'Email1',
    'TEL2' => 'Tel2',
    'TEL1' => 'Tel1',
    'COMMENTAIRE_DONATEUR' => 'Commentaire  Donateur',
    'RETOUR_PERIODICITE' => 'Retour  Periodicite',
    'DATE_DE_NAISSANCE' => 'Date  De  Naissance',
    'ADR2' => 'Adr2',
    'RETOUR_DATEDENVOI' => 'Retour  Datedenvoi',
    'COMMENTAIRE_APPEL' => 'Commentaire  Appel',
    'IDENTIFIANT2' => 'Identifiant2',
    'A_DATEPA' => 'A  Datepa',
    'PRIORITE' => 'Priorite',
    'CODE_MEDIA' => 'Code  Media',
    'MODIF_TEL' => 'Modif  Tel',
    'ADR4' => 'Adr4',
    'FILTRE' => 'Filtre',
    'ADR3' => 'Adr3',
    'MODIF_ADRESSE' => 'Modif  Adresse',
    'EMAIL2' => 'Email2',
    'A_PERIODICITE' => 'A  Periodicite',
    'CP' => 'Cp',
    'NOM' => 'Nom',
    'RETOUR_IDSCAN' => 'Retour  Idscan',
    'MODIF_EMAIL' => 'Modif  Email',
    'CIV' => 'Civ',
    'RETOUR_FLAG' => 'Retour  Flag',
    'RETOUR_DATESIGNATURE' => 'Retour  Datesignature',
    'N_DATEPA' => 'N  Datepa',
    'ADR1' => 'Adr1',
    'RETOUR_NOMFICHIER' => 'Retour  Nomfichier',
    'N_MONTANT' => 'N  Montant',
    'RETOUR_JOURPRELEVEMENT' => 'Retour  Jourprelevement',
    'RETOUR_DATEIMPORT' => 'Retour  Dateimport',
    'TEL3' => 'Tel3',
    'A_JOURPA' => 'A  Jourpa',
    'A_MOISPA' => 'A  Moispa',
];
}
}
