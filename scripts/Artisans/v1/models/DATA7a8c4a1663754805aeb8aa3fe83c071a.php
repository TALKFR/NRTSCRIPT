<?php

namespace app\scripts\Artisans\v1\models;

use app\components\Validators\EitherValidator;
use Yii;

//Id : cielsdirect
//Mdp : 5F63Lz39

/**
 * This is the model class for table "DATA_7a8c4a1663754805aeb8aa3fe83c071a".
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
 * @property string $NUMERO_DE_RUE
 * @property string $CODE_BIS 
 * @property string $ADR1
 * @property string $ADR2
 * @property string $ADR3
 * @property string $ADR4
 * @property string $CP
 * @property string $VILLE
 * @property string $PAYS
 * @property string $TEL1
 * @property string $TEL2
 * @property string $TEL3
 * @property string $EMAIL1
 * @property string $EMAIL2
 * @property string $COMMENTAIRE_APPEL
 * @property string $FILTRE
 * @property string $PRIORITE
 * @property integer $MODIF_ADRESSE
 * @property integer $MODIF_TEL
 * @property integer $MODIF_EMAIL
 * @property string $_CORPS_DE_METIER
 * @property integer $_DEJA_AFFILIE_123DEVIS
 * @property string $_NOM_GERANT
 * @property string $_DATE_CREATION
 * @property string $_NB_SALARIE
 * @property string $_DATE_RAPPEL
 * @property integer $_AFFILIE_INACTIF
 * @property integer $_CONTRAT_DECENNAL_EN_COURS
 * @property integer $_SOUHAITE_DEVIS_DECENNAL
 * @property integer $_FLOTTE_AUTOMOBILE
 * @property integer $_SITE_INTERNET
 * @property integer $_ALARME
 * @property string $_ACTIVITE1
 * @property string $_ACTIVITE2
 * @property string $_ACTIVITE3 
 *  */
class DATA7a8c4a1663754805aeb8aa3fe83c071a extends custommodel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'DATA_7a8c4a1663754805aeb8aa3fe83c071a';
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
            [['EMAIL1', 'EMAIL2'], 'email', 'message' => 'La valeur doit être un email valide'],
            [['TEL1', 'TEL2', 'TEL3'], 'app\components\NixxisPhoneNumberValidator', 'format' => 'FR'],
            [['N_DATEPA_MONTH', 'N_DATEPA_YEAR', 'DATE_RAPPEL', 'HEURE_RAPPEL'], 'safe'],
            [['Internal__id__', 'CODE_MEDIA', 'IDENTIFIANT1', 'IDENTIFIANT2', 'RS1', 'RS2', 'CIV', 'NOM', 'PRENOM', 'NUMERO_DE_RUE', 'CODE_BIS', 'ADR1', 'ADR2', 'ADR3', 'ADR4', 'CP', 'VILLE', 'PAYS', 'TEL1', 'TEL2', 'TEL3', 'EMAIL1', 'EMAIL2', 'COMMENTAIRE_APPEL', 'FILTRE', 'PRIORITE', '_CORPS_DE_METIER', '_NOM_GERANT', '_DATE_CREATION', '_NB_SALARIE', '_DATE_RAPPEL', '_ACTIVITE1', '_ACTIVITE2', '_ACTIVITE3'], 'string'],
            [['MODIF_ADRESSE', 'MODIF_TEL', 'MODIF_EMAIL', '_DEJA_AFFILIE_123DEVIS', '_AFFILIE_INACTIF', '_CONTRAT_DECENNAL_EN_COURS', '_SOUHAITE_DEVIS_DECENNAL', '_FLOTTE_AUTOMOBILE', '_SITE_INTERNET', '_ALARME'], 'integer'],
            [['RS1', 'CIV', 'NOM', 'PRENOM', 'CP'], 'required', 'on' => 'FIN', 'message' => 'Ce champs ne peut être vide'],
            [['_ACTIVITE1',], EitherValidator::className(), 'on' => 'FIN', 'message' => 'Ce champs ne peut être vide'],
            [['TEL1', 'TEL2', 'TEL3'], EitherValidator::className(), 'on' => 'FIN', 'message' => 'Ce champs ne peut être vide'],
            [['EMAIL1', 'EMAIL2'], EitherValidator::className(), 'on' => 'FIN', 'message' => 'Ce champs ne peut être vide'],
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
            'ADR3' => 'Adr3',
            'ADR4' => 'Adr4',
            'CP' => 'Cp',
            'VILLE' => 'Ville',
            'PAYS' => 'Pays',
            'TEL1' => 'Tel1',
            'TEL2' => 'Tel2',
            'TEL3' => 'Tel3',
            'EMAIL1' => 'Email1',
            'EMAIL2' => 'Email2',
            'COMMENTAIRE_APPEL' => 'Commentaire  Appel',
            'FILTRE' => 'Filtre',
            'PRIORITE' => 'Priorite',
            'MODIF_ADRESSE' => 'Modif  Adresse',
            'MODIF_TEL' => 'Modif  Tel',
            'MODIF_EMAIL' => 'Modif  Email',
            '_CORPS_DE_METIER' => 'Corps  De  Metier',
            '_DEJA_AFFILIE_123DEVIS' => 'Deja  Affilie 123 Devis',
            '_NOM_GERANT' => 'Nom  Gerant',
            '_DATE_CREATION' => 'Date  Creation',
            '_NB_SALARIE' => 'Nb  Salarie',
            '_DATE_RAPPEL' => 'Date  Rappel',
            '_AFFILIE_INACTIF' => 'Affilie  Inactif',
            '_CONTRAT_DECENNAL_EN_COURS' => 'Contrat  Decennal  En  Cours',
            '_SOUHAITE_DEVIS_DECENNAL' => 'Souhaite  Devis  Decennal',
            '_FLOTTE_AUTOMOBILE' => 'Flotte  Automobile',
            '_SITE_INTERNET' => 'Site  Internet',
            '_ALARME' => 'Alarme',
        ];
    }

}
