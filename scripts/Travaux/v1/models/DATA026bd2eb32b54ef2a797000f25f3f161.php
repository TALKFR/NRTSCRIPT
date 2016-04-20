<?php

namespace app\scripts\Travaux\v1\models;

use Yii;

/**
 * This is the model class for table "DATA_026bd2eb32b54ef2a797000f25f3f161".
 *
 * @property string $Internal__id__
 * @property string $RS2
 * @property string $ADR1
 * @property string $RS1
 * @property string $IDENTIFIANT2
 * @property string $IDENTIFIANT1
 * @property string $CODE_MEDIA
 * @property string $PRENOM
 * @property string $NOM
 * @property string $CIV
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
 * @property string $FILTRE
 * @property string $PRIORITE
 * @property string $COMMENTAIRE_APPEL
 * @property string $_DATE_AUTO
 * @property integer $_DEJA_EMMENAGE
 * @property string $_DATE_EMMENAGEMENT
 * @property integer $_ALARME_INSTALLE
 * @property string $_ALARME_DATE_INSTALLATION
 * @property integer $_ALARME_A_INSTALLER
 * @property string $_DESCRIPTIF_ALARME_A_INSTALLER
 * @property string $_DATE_RAPPEL
 * @property string $_ADRESSE_TRAVAUX
 * @property string $_CP_TRAVAUX
 * @property string $_VILLE_TRAVAUX
 * @property string $_CONSTRUCTEUR
 * @property string $_SITUATION_ACTUELLE
 * @property string $_ASSURANCE_PRET
 * @property integer $_MRH_OK_DEVIS
 * @property integer $_ARTISAN_OK_DEVIS
 * @property integer $_CHIEN
 * @property integer $_DEVIS_CHIEN
 * @property string $_NOM_CHIEN
 * @property string $_ANNEE_NAISSANCE_CHIEN
 * @property string $_DESCRIPTIF_PRO
 * @property integer $_PROFESSIONNEL_ARTISAN
 * @property integer $_DON_GREENPEACE
 * @property integer $_DON_ENFANTS_AVEUGLES
 */
class DATA026bd2eb32b54ef2a797000f25f3f161 extends custommodel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'DATA_026bd2eb32b54ef2a797000f25f3f161';
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
            [['Internal__id__', 'RS2', 'ADR1', 'RS1', 'IDENTIFIANT2', 'IDENTIFIANT1', 'CODE_MEDIA', 'PRENOM', 'NOM', 'CIV', 'ADR2', 'NUMERO_DE_RUE', 'CODE_BIS', 'ADR3', 'ADR4', 'CP', 'VILLE', 'PAYS', 'TEL1', 'TEL2', 'TEL3', 'EMAIL1', 'EMAIL2', 'FILTRE', 'PRIORITE', 'COMMENTAIRE_APPEL', '_DATE_AUTO', '_DATE_EMMENAGEMENT', '_ALARME_DATE_INSTALLATION', '_DESCRIPTIF_ALARME_A_INSTALLER', '_DATE_RAPPEL', '_ADRESSE_TRAVAUX', '_CP_TRAVAUX', '_VILLE_TRAVAUX', '_CONSTRUCTEUR', '_SITUATION_ACTUELLE', '_ASSURANCE_PRET', '_NOM_CHIEN', '_ANNEE_NAISSANCE_CHIEN', '_DESCRIPTIF_PRO'], 'string'],
            [['MODIF_ADRESSE', 'MODIF_TEL', 'MODIF_EMAIL', '_DEJA_EMMENAGE', '_ALARME_INSTALLE', '_ALARME_A_INSTALLER', '_MRH_OK_DEVIS', '_ARTISAN_OK_DEVIS', '_CHIEN', '_DEVIS_CHIEN', '_PROFESSIONNEL_ARTISAN', '_DON_GREENPEACE', '_DON_ENFANTS_AVEUGLES'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'Internal__id__' => 'Internal  ID',
            'RS2' => 'Rs2',
            'ADR1' => 'Adr1',
            'RS1' => 'Rs1',
            'IDENTIFIANT2' => 'Identifiant2',
            'IDENTIFIANT1' => 'Identifiant1',
            'CODE_MEDIA' => 'Code  Media',
            'PRENOM' => 'Prenom',
            'NOM' => 'Nom',
            'CIV' => 'Civ',
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
            'FILTRE' => 'Filtre',
            'PRIORITE' => 'Priorite',
            'COMMENTAIRE_APPEL' => 'Commentaire  Appel',
            '_DATE_AUTO' => 'Date  Auto',
            '_DEJA_EMMENAGE' => 'Deja  Emmenage',
            '_DATE_EMMENAGEMENT' => 'Date  Emmenagement',
            '_ALARME_INSTALLE' => 'Alarme  Installe',
            '_ALARME_DATE_INSTALLATION' => 'Alarme  Date  Installation',
            '_ALARME_A_INSTALLER' => 'Alarme  A  Installer',
            '_DESCRIPTIF_ALARME_A_INSTALLER' => 'Descriptif  Alarme  A  Installer',
            '_DATE_RAPPEL' => 'Date  Rappel',
            '_ADRESSE_TRAVAUX' => 'Adresse  Travaux',
            '_CP_TRAVAUX' => 'Cp  Travaux',
            '_VILLE_TRAVAUX' => 'Ville  Travaux',
            '_CONSTRUCTEUR' => 'Constructeur',
            '_SITUATION_ACTUELLE' => 'Situation  Actuelle',
            '_ASSURANCE_PRET' => 'Assurance  Pret',
            '_MRH_OK_DEVIS' => 'Mrh  Ok  Devis',
            '_ARTISAN_OK_DEVIS' => 'Artisan  Ok  Devis',
            '_CHIEN' => 'Chien',
            '_DEVIS_CHIEN' => 'Devis  Chien',
            '_NOM_CHIEN' => 'Nom  Chien',
            '_ANNEE_NAISSANCE_CHIEN' => 'Annee  Naissance  Chien',
            '_DESCRIPTIF_PRO' => 'Descriptif  Pro',
            '_PROFESSIONNEL_ARTISAN' => 'Professionnel  Artisan',
            '_DON_GREENPEACE' => 'Don  Greenpeace',
            '_DON_ENFANTS_AVEUGLES' => 'Don  Enfants  Aveugles',
        ];
    }

}
