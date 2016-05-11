<?php

namespace app\scripts\Animaux\v1\models;

use Yii;

/*
 * MUTUELLE ANIMAUX
 */

/**
 * This is the model class for table "DATA_2b9635b1b4364f64937310a34c74a61a".
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
 * @property string $FILTRE
 * @property string $PRIORITE
 * @property string $COMMENTAIRE_APPEL
 * @property string $_TYPE_ANIMAL_1
 * @property string $_PRENOM_ANIMAL_1
 * @property string $_DATE_NAISSANCE_ANIMAL_1
 * @property string $_RACE_ANIMAL_1
 * @property string $_VACCIN_ANIMAL_1
 * @property string $_TATOUE_PUCE_ANIMAL_1
 * @property string $_ASSURANCE_ANIMAL_1
 * @property string $_TYPE_ANIMAL_2
 * @property string $_PRENOM_ANIMAL_2
 * @property string $_DATE_NAISSANCE_ANIMAL_2
 * @property string $_RACE_ANIMAL_2
 * @property string $_VACCIN_ANIMAL_2
 * @property string $_TATOUE_PUCE_ANIMAL_2
 * @property string $_ASSURANCE_ANIMAL_2
 * @property string $_TYPE_ANIMAL_3
 * @property string $_PRENOM_ANIMAL_3
 * @property string $_DATE_NAISSANCE_ANIMAL_3
 * @property string $_RACE_ANIMAL_3
 * @property string $_VACCIN_ANIMAL_3
 * @property string $_TATOUE_PUCE_ANIMAL_3
 * @property string $_ASSURANCE_ANIMAL_3
 * @property string $_TYPE_ANIMAL_4
 * @property string $_PRENOM_ANIMAL_4
 * @property string $_DATE_NAISSANCE_ANIMAL_4
 * @property string $_RACE_ANIMAL_4
 * @property string $_VACCIN_ANIMAL_4
 * @property string $_TATOUE_PUCE_ANIMAL_4
 * @property string $_ASSURANCE_ANIMAL_4
 * @property string $_TYPE_ANIMAL_5
 * @property string $_PRENOM_ANIMAL_5
 * @property string $_DATE_NAISSANCE_ANIMAL_5
 * @property string $_RACE_ANIMAL_5
 * @property string $_VACCIN_ANIMAL_5
 * @property string $_TATOUE_PUCE_ANIMAL_5
 * @property string $_ASSURANCE_ANIMAL_5
 */
class DATA2b9635b1b4364f64937310a34c74a61a extends \app\models\Nixxis\Data {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'DATA_2b9635b1b4364f64937310a34c74a61a';
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
            [['Internal__id__', 'CODE_MEDIA', 'IDENTIFIANT1', 'IDENTIFIANT2', 'RS1', 'RS2', 'CIV', 'NOM', 'PRENOM', 'ADR1', 'ADR2', 'NUMERO_DE_RUE', 'CODE_BIS', 'ADR3', 'ADR4', 'CP', 'VILLE', 'PAYS', 'TEL1', 'TEL2', 'TEL3', 'EMAIL1', 'EMAIL2', 'FILTRE', 'PRIORITE', 'COMMENTAIRE_APPEL', '_TYPE_ANIMAL_1', '_PRENOM_ANIMAL_1', '_DATE_NAISSANCE_ANIMAL_1', '_RACE_ANIMAL_1', '_VACCIN_ANIMAL_1', '_TATOUE_PUCE_ANIMAL_1', '_ASSURANCE_ANIMAL_1', '_TYPE_ANIMAL_2', '_PRENOM_ANIMAL_2', '_DATE_NAISSANCE_ANIMAL_2', '_RACE_ANIMAL_2', '_VACCIN_ANIMAL_2', '_TATOUE_PUCE_ANIMAL_2', '_ASSURANCE_ANIMAL_2', '_TYPE_ANIMAL_3', '_PRENOM_ANIMAL_3', '_DATE_NAISSANCE_ANIMAL_3', '_RACE_ANIMAL_3', '_VACCIN_ANIMAL_3', '_TATOUE_PUCE_ANIMAL_3', '_ASSURANCE_ANIMAL_3', '_TYPE_ANIMAL_4', '_PRENOM_ANIMAL_4', '_DATE_NAISSANCE_ANIMAL_4', '_RACE_ANIMAL_4', '_VACCIN_ANIMAL_4', '_TATOUE_PUCE_ANIMAL_4', '_ASSURANCE_ANIMAL_4', '_TYPE_ANIMAL_5', '_PRENOM_ANIMAL_5', '_DATE_NAISSANCE_ANIMAL_5', '_RACE_ANIMAL_5', '_VACCIN_ANIMAL_5', '_TATOUE_PUCE_ANIMAL_5', '_ASSURANCE_ANIMAL_5'], 'string'],
            [['MODIF_ADRESSE', 'MODIF_TEL', 'MODIF_EMAIL'], 'integer'],
            [['EMAIL1', 'EMAIL2'], 'email', 'message' => 'La valeur doit être un email valide'],
            [['TEL1', 'TEL2'], 'app\components\NixxisPhoneNumberValidator', 'format' => 'FR'],
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
            'FILTRE' => 'Filtre',
            'PRIORITE' => 'Priorite',
            'COMMENTAIRE_APPEL' => 'Commentaire  Appel',
            '_TYPE_ANIMAL_1' => 'Type  Animal 1',
            '_PRENOM_ANIMAL_1' => 'Prenom  Animal 1',
            '_DATE_NAISSANCE_ANIMAL_1' => 'Date  Naissance  Animal 1',
            '_RACE_ANIMAL_1' => 'Race  Animal 1',
            '_VACCIN_ANIMAL_1' => 'Vaccin  Animal 1',
            '_TATOUE_PUCE_ANIMAL_1' => 'Tatoue  Puce  Animal 1',
            '_ASSURANCE_ANIMAL_1' => 'Assurance  Animal 1',
            '_TYPE_ANIMAL_2' => 'Type  Animal 2',
            '_PRENOM_ANIMAL_2' => 'Prenom  Animal 2',
            '_DATE_NAISSANCE_ANIMAL_2' => 'Date  Naissance  Animal 2',
            '_RACE_ANIMAL_2' => 'Race  Animal 2',
            '_VACCIN_ANIMAL_2' => 'Vaccin  Animal 2',
            '_TATOUE_PUCE_ANIMAL_2' => 'Tatoue  Puce  Animal 2',
            '_ASSURANCE_ANIMAL_2' => 'Assurance  Animal 2',
            '_TYPE_ANIMAL_3' => 'Type  Animal 3',
            '_PRENOM_ANIMAL_3' => 'Prenom  Animal 3',
            '_DATE_NAISSANCE_ANIMAL_3' => 'Date  Naissance  Animal 3',
            '_RACE_ANIMAL_3' => 'Race  Animal 3',
            '_VACCIN_ANIMAL_3' => 'Vaccin  Animal 3',
            '_TATOUE_PUCE_ANIMAL_3' => 'Tatoue  Puce  Animal 3',
            '_ASSURANCE_ANIMAL_3' => 'Assurance  Animal 3',
            '_TYPE_ANIMAL_4' => 'Type  Animal 4',
            '_PRENOM_ANIMAL_4' => 'Prenom  Animal 4',
            '_DATE_NAISSANCE_ANIMAL_4' => 'Date  Naissance  Animal 4',
            '_RACE_ANIMAL_4' => 'Race  Animal 4',
            '_VACCIN_ANIMAL_4' => 'Vaccin  Animal 4',
            '_TATOUE_PUCE_ANIMAL_4' => 'Tatoue  Puce  Animal 4',
            '_ASSURANCE_ANIMAL_4' => 'Assurance  Animal 4',
            '_TYPE_ANIMAL_5' => 'Type  Animal 5',
            '_PRENOM_ANIMAL_5' => 'Prenom  Animal 5',
            '_DATE_NAISSANCE_ANIMAL_5' => 'Date  Naissance  Animal 5',
            '_RACE_ANIMAL_5' => 'Race  Animal 5',
            '_VACCIN_ANIMAL_5' => 'Vaccin  Animal 5',
            '_TATOUE_PUCE_ANIMAL_5' => 'Tatoue  Puce  Animal 5',
            '_ASSURANCE_ANIMAL_5' => 'Assurance  Animal 5',
        ];
    }

}
