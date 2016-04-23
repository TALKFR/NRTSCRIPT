<?php

namespace app\scripts\Travaux\v1\models;

use app\components\EitherValidator;
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
 * @property string $_DATE_RAPPEL
 * @property string $_ADRESSE_TRAVAUX
 * @property string $_CP_TRAVAUX
 * @property string $_VILLE_TRAVAUX
 * @property integer $_CHIEN
 * @property integer $_DEVIS_CHIEN
 * @property string $_NOM_CHIEN
 * @property string $_ANNEE_NAISSANCE_CHIEN
 * @property integer $_DON_GREENPEACE
 * @property integer $_DON_ENFANTS_AVEUGLES
 * @property integer $_PAS_DE_TEL
 * @property integer $_PAS_D_EMAIL
 * @property integer $_CHAT
 * @property integer $_DEVIS_CHAT
 * @property string $_NOM_CHAT
 * @property string $_ANNEE_NAISSANCE_CHAT
 * @property string $_NB_CHAT
 * @property string $_NB_CHIEN
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
            [['Internal__id__', 'RS2', 'ADR1', 'RS1', 'IDENTIFIANT2', 'IDENTIFIANT1', 'CODE_MEDIA', 'PRENOM', 'NOM', 'CIV', 'ADR2', 'NUMERO_DE_RUE', 'CODE_BIS', 'ADR3', 'ADR4', 'CP', 'VILLE', 'PAYS', 'TEL1', 'TEL2', 'TEL3', 'EMAIL1', 'EMAIL2', 'FILTRE', 'PRIORITE', 'COMMENTAIRE_APPEL', '_DATE_AUTO', '_DATE_RAPPEL', '_ADRESSE_TRAVAUX', '_CP_TRAVAUX', '_VILLE_TRAVAUX', '_NOM_CHIEN', '_ANNEE_NAISSANCE_CHIEN'], 'string'],
            [['MODIF_ADRESSE', 'MODIF_TEL', 'MODIF_EMAIL', '_CHIEN', '_DEVIS_CHIEN', '_DON_GREENPEACE', '_DON_ENFANTS_AVEUGLES', '_PAS_DE_TEL', '_PAS_D_EMAIL'], 'integer'],
            [['EMAIL1', 'NOM', 'PRENOM', '_CP_TRAVAUX', '_VILLE_TRAVAUX'], 'required', 'on' => 'ADDNEED', 'message' => 'Ce champs ne peut être vide'],
            [['TEL1', 'TEL2'], EitherValidator::className(), 'on' => 'ADDNEED', 'message' => 'Ce champs ne peut être vide'],
            [['EMAIL1', 'EMAIL2'], 'email', 'message' => 'La valeur doit être un email valide'],
            [['EMAIL1', 'NOM', 'PRENOM', '_CP_TRAVAUX', '_VILLE_TRAVAUX'], 'required', 'on' => 'FIN', 'message' => 'Ce champs ne peut être vide'],
            [['TEL1', 'TEL2'], EitherValidator::className(), 'on' => 'FIN', 'message' => 'Ce champs ne peut être vide'],
            [['MOIS_RAPPEL', 'ANNEE_RAPPEL'], 'safe'],
            [['_CHAT', '_DEVIS_CHAT', '_ANNEE_NAISSANCE_CHAT', '_NOM_CHAT', '_NB_CHAT', '_NB_CHIEN'], 'safe'],
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
            '_DATE_RAPPEL' => 'Date  Rappel',
            '_ADRESSE_TRAVAUX' => 'Adresse  Travaux',
            '_CP_TRAVAUX' => 'Cp  Travaux',
            '_VILLE_TRAVAUX' => 'Ville  Travaux',
            '_CHIEN' => 'Chien',
            '_DEVIS_CHIEN' => 'Devis  Chien',
            '_NOM_CHIEN' => 'Nom  Chien',
            '_ANNEE_NAISSANCE_CHIEN' => 'Annee  Naissance  Chien',
            '_DON_GREENPEACE' => 'Don  Greenpeace',
            '_DON_ENFANTS_AVEUGLES' => 'Don  Enfants  Aveugles',
            '_PAS_DE_TEL' => 'Pas  De  Tel',
            '_PAS_D_EMAIL' => 'Pas  D  Email',
            '_CHAT' => 'Chat',
            '_DEVIS_CHAT' => 'Devis  Chat',
            '_NOM_CHAT' => 'Nom  Chat',
            '_ANNEE_NAISSANCE_CHAT' => 'Annee  Naissance  Chat',
        ];
    }

}
