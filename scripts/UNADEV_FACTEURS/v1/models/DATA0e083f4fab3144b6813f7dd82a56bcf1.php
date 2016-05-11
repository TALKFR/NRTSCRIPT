<?php

namespace app\scripts\UNADEV_FACTEURS\v1\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "DATA_0e083f4fab3144b6813f7dd82a56bcf1".
 *
 * @property string $Internal__id__
 * @property string $A_MONTANT
 * @property string $RETOUR_JOURPRELEVEMENT
 * @property integer $MODIF_ADRESSE
 * @property string $CIV
 * @property string $ADR1
 * @property string $RETOUR_PERIODICITE
 * @property string $DATE_DE_NAISSANCE
 * @property integer $MODIF_EMAIL
 * @property string $RETOUR_CATHEORIQUE
 * @property string $IDENTIFIANT2
 * @property string $A_MOISPA
 * @property string $CODE_MEDIA
 * @property string $EMAIL1
 * @property string $VILLE
 * @property string $COMMENTAIRE_DONATEUR
 * @property string $RETOUR_PROMESSE
 * @property string $CHIENCHATS
 * @property string $RETOUR_IDSCAN
 * @property string $RETOUR_DATEDENVOI
 * @property string $RETOUR_FLAG
 * @property string $RETOUR_DATESIGNATURE
 * @property integer $MODIF_TEL
 * @property string $TEL2
 * @property string $A_DATEDS
 * @property string $PRENOM
 * @property string $COMMENTAIRE_APPEL
 * @property string $A_DATEPA
 * @property string $RETOUR_NOMFICHIER
 * @property string $RETOUR_MONTANT
 * @property string $ADR4
 * @property string $ADR3
 * @property string $RETOUR_COUPON
 * @property string $NOM
 * @property string $PRIORITE
 * @property string $TEL1
 * @property string $EMAIL2
 * @property string $RETOUR_PREMIERPRELEVEMENT
 * @property string $RETOUR_DATEIMPORT
 * @property string $A_JOURPA
 * @property string $FILTRE
 * @property string $RETOUR_DATESAISIE
 * @property string $A_PERIODICITE
 * @property string $IDENTIFIANT1
 * @property string $CP
 * @property string $TEL3
 * @property string $N_DATEPA
 * @property string $ADR2
 * @property string $_REMARQUE
 * @property string $_DATE_MARCHE
 * @property string $N_MONTANT
 * @property string $N_PERIODICITE
 * @property string $_PROMESSEENVOYEE
 * @property string $ID_RELANCE
 */
class DATA0e083f4fab3144b6813f7dd82a56bcf1 extends custommodel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'DATA_0e083f4fab3144b6813f7dd82a56bcf1';
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
        $p_rules = parent::rules();
        $rules = [
            [['Internal__id__'], 'required'],
            [['Internal__id__', 'A_MONTANT', 'RETOUR_JOURPRELEVEMENT', 'CIV', 'ADR1', 'RETOUR_PERIODICITE', 'DATE_DE_NAISSANCE', 'RETOUR_CATHEORIQUE', 'IDENTIFIANT2', 'A_MOISPA', 'CODE_MEDIA', 'EMAIL1', 'VILLE', 'COMMENTAIRE_DONATEUR', 'RETOUR_PROMESSE', 'CHIENCHATS', 'RETOUR_IDSCAN', 'RETOUR_DATEDENVOI', 'RETOUR_FLAG', 'RETOUR_DATESIGNATURE', 'TEL2', 'A_DATEDS', 'PRENOM', 'COMMENTAIRE_APPEL', 'A_DATEPA', 'RETOUR_NOMFICHIER', 'RETOUR_MONTANT', 'ADR4', 'ADR3', 'RETOUR_COUPON', 'NOM', 'PRIORITE', 'TEL1', 'EMAIL2', 'RETOUR_PREMIERPRELEVEMENT', 'RETOUR_DATEIMPORT', 'A_JOURPA', 'FILTRE', 'RETOUR_DATESAISIE', 'A_PERIODICITE', 'IDENTIFIANT1', 'CP', 'TEL3', 'N_DATEPA', 'ADR2', '_REMARQUE', '_DATE_MARCHE', 'N_MONTANT', 'N_PERIODICITE', '_PROMESSEENVOYEE', 'ID_RELANCE'], 'string'],
            [['MODIF_ADRESSE', 'MODIF_EMAIL', 'MODIF_TEL'], 'integer']
        ];
        return ArrayHelper::merge($p_rules, $rules);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'Internal__id__' => 'Internal  ID',
            'A_MONTANT' => 'A  Montant',
            'RETOUR_JOURPRELEVEMENT' => 'Retour  Jourprelevement',
            'MODIF_ADRESSE' => 'Modif  Adresse',
            'CIV' => 'Civ',
            'ADR1' => 'Adr1',
            'RETOUR_PERIODICITE' => 'Retour  Periodicite',
            'DATE_DE_NAISSANCE' => 'Date  De  Naissance',
            'MODIF_EMAIL' => 'Modif  Email',
            'RETOUR_CATHEORIQUE' => 'Retour  Catheorique',
            'IDENTIFIANT2' => 'Identifiant2',
            'A_MOISPA' => 'A  Moispa',
            'CODE_MEDIA' => 'Code  Media',
            'EMAIL1' => 'Email1',
            'VILLE' => 'Ville',
            'COMMENTAIRE_DONATEUR' => 'Commentaire  Donateur',
            'RETOUR_PROMESSE' => 'Retour  Promesse',
            'CHIENCHATS' => 'Chienchats',
            'RETOUR_IDSCAN' => 'Retour  Idscan',
            'RETOUR_DATEDENVOI' => 'Retour  Datedenvoi',
            'RETOUR_FLAG' => 'Retour  Flag',
            'RETOUR_DATESIGNATURE' => 'Retour  Datesignature',
            'MODIF_TEL' => 'Modif  Tel',
            'TEL2' => 'Tel2',
            'A_DATEDS' => 'A  Dateds',
            'PRENOM' => 'Prenom',
            'COMMENTAIRE_APPEL' => 'Commentaire  Appel',
            'A_DATEPA' => 'A  Datepa',
            'RETOUR_NOMFICHIER' => 'Retour  Nomfichier',
            'RETOUR_MONTANT' => 'Retour  Montant',
            'ADR4' => 'Adr4',
            'ADR3' => 'Adr3',
            'RETOUR_COUPON' => 'Retour  Coupon',
            'NOM' => 'Nom',
            'PRIORITE' => 'Priorite',
            'TEL1' => 'Tel1',
            'EMAIL2' => 'Email2',
            'RETOUR_PREMIERPRELEVEMENT' => 'Retour  Premierprelevement',
            'RETOUR_DATEIMPORT' => 'Retour  Dateimport',
            'A_JOURPA' => 'A  Jourpa',
            'FILTRE' => 'Filtre',
            'RETOUR_DATESAISIE' => 'Retour  Datesaisie',
            'A_PERIODICITE' => 'A  Periodicite',
            'IDENTIFIANT1' => 'Identifiant1',
            'CP' => 'Cp',
            'TEL3' => 'Tel3',
            'N_DATEPA' => 'N  Datepa',
            'ADR2' => 'Adr2',
            '_REMARQUE' => 'Remarque',
            '_DATE_MARCHE' => 'Date  Marche',
            'N_MONTANT' => 'N  Montant',
            'N_PERIODICITE' => 'N  Periodicite',
            '_PROMESSEENVOYEE' => 'Promesseenvoyee',
            'ID_RELANCE' => 'Id  Relance',
        ];
    }

}
