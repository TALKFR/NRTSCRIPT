<?php

namespace app\models\Campaigns;

use Yii;

/**
* This is the model class for table "DATA_f9a8604b5c264cabab9dfd570ada1045".
*
    * @property string $Internal__Id__
    * @property string $Fichier
    * @property string $Numero_tiers
    * @property string $Numero_membre
    * @property string $Civilite
    * @property string $Nom
    * @property string $Prenom
    * @property string $Adresse1
    * @property string $Adresse2
    * @property string $Adresse3
    * @property string $Adresse4
    * @property string $Codepostal
    * @property string $Localite
    * @property string $Telephone
    * @property string $Segmentation
    * @property string $Date_dernier_don
    * @property string $Montant_dernier_don
    * @property string $Nbre_total_dons
    * @property string $Total_dons
    * @property string $email
    * @property string $portable
    * @property string $annee_naissance
    * @property string $commentaire_appel
    * @property string $date_debut_pa
    * @property string $date_retour
    * @property string $periodicite
    * @property string $montant
    * @property string $SOURCE_ID
    * @property string $SOURCE_ACCOUNT
    * @property string $SOURCE_DATETIME
    * @property string $SOURCE_QUALIFICATION
    * @property string $RETOUR_FLAG
    * @property string $RETOUR_DATEIMPORT
    * @property string $RETOUR_NOMFICHIER
    * @property string $RETOUR_PROMESSE
    * @property string $RETOUR_MONTANT
    * @property string $RETOUR_PERIODICITE
    * @property string $RETOUR_COUPON
    * @property string $RETOUR_DATESIGNATURE
    * @property string $RETOUR_DATESAISIE
    * @property string $RETOUR_JOURDEPRELEVEMENT
    * @property string $RETOUR_PREMIERPRELEVEMENT
    * @property string $RETOUR_CATHEORIQUE
    * @property string $COUNT
    * @property string $DATE_DERNIERE_RELANCE
    * @property string $COMMENTAIRE_DERNIERE_RELANCE
    * @property integer $NB_JOUR_APPEL
    * @property integer $NB_JOUR_RELANCE
    * @property string $TOCALL
    * @property string $NV_PERIODICITE
    * @property string $NV_MONTANT
    * @property string $NV_PROMESSE
    * @property string $NV_DEBUTPA
    * @property string $RAISON_REFUS
    * @property string $DEJA_RELANCE
*/
class DATAf9a8604b5c264cabab9dfd570ada1045 extends \app\models\Nixxis\Data
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'DATA_f9a8604b5c264cabab9dfd570ada1045';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['Internal__Id__'], 'required'],
            [['Internal__Id__', 'Fichier', 'Numero_tiers', 'Numero_membre', 'Civilite', 'Nom', 'Prenom', 'Adresse1', 'Adresse2', 'Adresse3', 'Adresse4', 'Codepostal', 'Localite', 'Telephone', 'Segmentation', 'Date_dernier_don', 'Montant_dernier_don', 'Nbre_total_dons', 'Total_dons', 'email', 'portable', 'annee_naissance', 'commentaire_appel', 'date_debut_pa', 'date_retour', 'periodicite', 'montant', 'SOURCE_ID', 'SOURCE_ACCOUNT', 'SOURCE_DATETIME', 'SOURCE_QUALIFICATION', 'RETOUR_FLAG', 'RETOUR_DATEIMPORT', 'RETOUR_NOMFICHIER', 'RETOUR_PROMESSE', 'RETOUR_MONTANT', 'RETOUR_PERIODICITE', 'RETOUR_COUPON', 'RETOUR_DATESIGNATURE', 'RETOUR_DATESAISIE', 'RETOUR_JOURDEPRELEVEMENT', 'RETOUR_PREMIERPRELEVEMENT', 'RETOUR_CATHEORIQUE', 'COUNT', 'DATE_DERNIERE_RELANCE', 'COMMENTAIRE_DERNIERE_RELANCE', 'TOCALL', 'NV_PERIODICITE', 'NV_MONTANT', 'NV_PROMESSE', 'NV_DEBUTPA', 'RAISON_REFUS', 'DEJA_RELANCE'], 'string'],
            [['NB_JOUR_APPEL', 'NB_JOUR_RELANCE'], 'integer']
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'Internal__Id__' => 'Internal   ID',
    'Fichier' => 'Fichier',
    'Numero_tiers' => 'Numero Tiers',
    'Numero_membre' => 'Numero Membre',
    'Civilite' => 'Civilite',
    'Nom' => 'Nom',
    'Prenom' => 'Prenom',
    'Adresse1' => 'Adresse1',
    'Adresse2' => 'Adresse2',
    'Adresse3' => 'Adresse3',
    'Adresse4' => 'Adresse4',
    'Codepostal' => 'Codepostal',
    'Localite' => 'Localite',
    'Telephone' => 'Telephone',
    'Segmentation' => 'Segmentation',
    'Date_dernier_don' => 'Date Dernier Don',
    'Montant_dernier_don' => 'Montant Dernier Don',
    'Nbre_total_dons' => 'Nbre Total Dons',
    'Total_dons' => 'Total Dons',
    'email' => 'Email',
    'portable' => 'Portable',
    'annee_naissance' => 'Annee Naissance',
    'commentaire_appel' => 'Commentaire Appel',
    'date_debut_pa' => 'Date Debut Pa',
    'date_retour' => 'Date Retour',
    'periodicite' => 'Periodicite',
    'montant' => 'Montant',
    'SOURCE_ID' => 'Source  ID',
    'SOURCE_ACCOUNT' => 'Source  Account',
    'SOURCE_DATETIME' => 'Source  Datetime',
    'SOURCE_QUALIFICATION' => 'Source  Qualification',
    'RETOUR_FLAG' => 'Retour  Flag',
    'RETOUR_DATEIMPORT' => 'Retour  Dateimport',
    'RETOUR_NOMFICHIER' => 'Retour  Nomfichier',
    'RETOUR_PROMESSE' => 'Retour  Promesse',
    'RETOUR_MONTANT' => 'Retour  Montant',
    'RETOUR_PERIODICITE' => 'Retour  Periodicite',
    'RETOUR_COUPON' => 'Retour  Coupon',
    'RETOUR_DATESIGNATURE' => 'Retour  Datesignature',
    'RETOUR_DATESAISIE' => 'Retour  Datesaisie',
    'RETOUR_JOURDEPRELEVEMENT' => 'Retour  Jourdeprelevement',
    'RETOUR_PREMIERPRELEVEMENT' => 'Retour  Premierprelevement',
    'RETOUR_CATHEORIQUE' => 'Retour  Catheorique',
    'COUNT' => 'Count',
    'DATE_DERNIERE_RELANCE' => 'Date  Derniere  Relance',
    'COMMENTAIRE_DERNIERE_RELANCE' => 'Commentaire  Derniere  Relance',
    'NB_JOUR_APPEL' => 'Nb  Jour  Appel',
    'NB_JOUR_RELANCE' => 'Nb  Jour  Relance',
    'TOCALL' => 'Tocall',
    'NV_PERIODICITE' => 'Nv  Periodicite',
    'NV_MONTANT' => 'Nv  Montant',
    'NV_PROMESSE' => 'Nv  Promesse',
    'NV_DEBUTPA' => 'Nv  Debutpa',
    'RAISON_REFUS' => 'Raison  Refus',
    'DEJA_RELANCE' => 'Deja  Relance',
];
}
}
