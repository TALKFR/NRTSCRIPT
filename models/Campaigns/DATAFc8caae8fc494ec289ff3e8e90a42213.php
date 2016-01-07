<?php

namespace app\models\Campaigns;

use Yii;

/**
* This is the model class for table "DATA_fc8caae8fc494ec289ff3e8e90a42213".
*
    * @property string $Internal__Id__
    * @property string $CODE_LOT
    * @property string $CODE_MEDIA
    * @property string $MODULO
    * @property string $PSO_NID
    * @property string $NUMERO_MEMBRE
    * @property string $CIVILITE
    * @property string $NOM
    * @property string $PRENOM
    * @property string $NOM_COMPLET
    * @property string $ADR1_ORIGINE
    * @property string $ADR2_ORIGINE
    * @property string $ADR3_ORIGINE
    * @property string $ADR4_ORIGINE
    * @property string $CP_ORIGINE
    * @property string $VILLE_ORIGINE
    * @property string $ADR1
    * @property string $ADR2
    * @property string $ADR3
    * @property string $ADR4
    * @property string $CP
    * @property string $VILLE
    * @property string $PAYS
    * @property string $TEL_DOM
    * @property string $TEL_MOB
    * @property string $EMAIL
    * @property string $PASSWEB
    * @property string $REL_POST
    * @property string $JOURNAL
    * @property string $TELEMKT
    * @property string $NEWSLETTER
    * @property string $FREQ_SOLLICITATION
    * @property string $PERIODE_SOLLICITATION
    * @property string $PRV_MONTANT_UNITAIRE
    * @property string $PRV_PERIODICITE
    * @property string $PRV_DATE_CREATION
    * @property string $PRV_DATE_PREMIER
    * @property string $PRV_RUM
    * @property string $PRV_DATE_ARRET
    * @property string $PRV_MOTIF_ARRET
    * @property string $COMMENTAIRE_APPEL
    * @property string $N_MONTANT
    * @property string $N_CYCLE
    * @property string $DATE_MODIFICATION
    * @property string $DATE_RETOUR
    * @property string $N_MONTANTDS
    * @property string $DATE_NAISSANCE
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
    * @property string $INFORMATIONS_COMPLEMENTAIRES
*/
class DATAfc8caae8fc494ec289ff3e8e90a42213 extends \app\models\Nixxis\Data
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'DATA_fc8caae8fc494ec289ff3e8e90a42213';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['Internal__Id__'], 'required'],
            [['Internal__Id__', 'CODE_LOT', 'CODE_MEDIA', 'MODULO', 'PSO_NID', 'NUMERO_MEMBRE', 'CIVILITE', 'NOM', 'PRENOM', 'NOM_COMPLET', 'ADR1_ORIGINE', 'ADR2_ORIGINE', 'ADR3_ORIGINE', 'ADR4_ORIGINE', 'CP_ORIGINE', 'VILLE_ORIGINE', 'ADR1', 'ADR2', 'ADR3', 'ADR4', 'CP', 'VILLE', 'PAYS', 'TEL_DOM', 'TEL_MOB', 'EMAIL', 'PASSWEB', 'REL_POST', 'JOURNAL', 'TELEMKT', 'NEWSLETTER', 'FREQ_SOLLICITATION', 'PERIODE_SOLLICITATION', 'PRV_MONTANT_UNITAIRE', 'PRV_PERIODICITE', 'PRV_DATE_CREATION', 'PRV_DATE_PREMIER', 'PRV_RUM', 'PRV_DATE_ARRET', 'PRV_MOTIF_ARRET', 'COMMENTAIRE_APPEL', 'N_MONTANT', 'N_CYCLE', 'DATE_MODIFICATION', 'DATE_RETOUR', 'N_MONTANTDS', 'DATE_NAISSANCE', 'RETOUR_FLAG', 'RETOUR_DATEIMPORT', 'RETOUR_NOMFICHIER', 'RETOUR_PROMESSE', 'RETOUR_MONTANT', 'RETOUR_PERIODICITE', 'RETOUR_COUPON', 'RETOUR_DATESIGNATURE', 'RETOUR_DATESAISIE', 'RETOUR_JOURPRELEVEMENT', 'RETOUR_PREMIERPRELEVEMENT', 'RETOUR_CATHEORIQUE', 'RETOUR_IDSCAN', 'RETOUR_DATEDENVOI', 'INFORMATIONS_COMPLEMENTAIRES'], 'string']
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'Internal__Id__' => 'Internal   ID',
    'CODE_LOT' => 'Code  Lot',
    'CODE_MEDIA' => 'Code  Media',
    'MODULO' => 'Modulo',
    'PSO_NID' => 'Pso  Nid',
    'NUMERO_MEMBRE' => 'Numero  Membre',
    'CIVILITE' => 'Civilite',
    'NOM' => 'Nom',
    'PRENOM' => 'Prenom',
    'NOM_COMPLET' => 'Nom  Complet',
    'ADR1_ORIGINE' => 'Adr1  Origine',
    'ADR2_ORIGINE' => 'Adr2  Origine',
    'ADR3_ORIGINE' => 'Adr3  Origine',
    'ADR4_ORIGINE' => 'Adr4  Origine',
    'CP_ORIGINE' => 'Cp  Origine',
    'VILLE_ORIGINE' => 'Ville  Origine',
    'ADR1' => 'Adr1',
    'ADR2' => 'Adr2',
    'ADR3' => 'Adr3',
    'ADR4' => 'Adr4',
    'CP' => 'Cp',
    'VILLE' => 'Ville',
    'PAYS' => 'Pays',
    'TEL_DOM' => 'Tel  Dom',
    'TEL_MOB' => 'Tel  Mob',
    'EMAIL' => 'Email',
    'PASSWEB' => 'Passweb',
    'REL_POST' => 'Rel  Post',
    'JOURNAL' => 'Journal',
    'TELEMKT' => 'Telemkt',
    'NEWSLETTER' => 'Newsletter',
    'FREQ_SOLLICITATION' => 'Freq  Sollicitation',
    'PERIODE_SOLLICITATION' => 'Periode  Sollicitation',
    'PRV_MONTANT_UNITAIRE' => 'Prv  Montant  Unitaire',
    'PRV_PERIODICITE' => 'Prv  Periodicite',
    'PRV_DATE_CREATION' => 'Prv  Date  Creation',
    'PRV_DATE_PREMIER' => 'Prv  Date  Premier',
    'PRV_RUM' => 'Prv  Rum',
    'PRV_DATE_ARRET' => 'Prv  Date  Arret',
    'PRV_MOTIF_ARRET' => 'Prv  Motif  Arret',
    'COMMENTAIRE_APPEL' => 'Commentaire  Appel',
    'N_MONTANT' => 'N  Montant',
    'N_CYCLE' => 'N  Cycle',
    'DATE_MODIFICATION' => 'Date  Modification',
    'DATE_RETOUR' => 'Date  Retour',
    'N_MONTANTDS' => 'N  Montantds',
    'DATE_NAISSANCE' => 'Date  Naissance',
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
    'INFORMATIONS_COMPLEMENTAIRES' => 'Informations  Complementaires',
];
}
}
