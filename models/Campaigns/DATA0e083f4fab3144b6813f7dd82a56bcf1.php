<?php

namespace app\models\Campaigns;

use Yii;

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
 * @property string $N_PERIODICITE
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
 * @property string $N_MONTANT
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
 * @property string $_PROMESSEENVOYEE
 */
class DATA0e083f4fab3144b6813f7dd82a56bcf1 extends \app\models\Nixxis\Data {

    public $N_DATEPA_DAY;
    public $N_DATEPA_MONTH;
    public $N_DATEPA_YEAR;

    public function beforeValidate() {
        parent::beforeValidate();
        $this->N_DATEPA = $this->N_DATEPA_DAY . '/' . $this->N_DATEPA_MONTH . '/' . $this->N_DATEPA_YEAR;
        if ($this->N_DATEPA_MONTH == '' && $this->scenario != 'PAM SLIMPAY') {
            $this->N_DATEPA = '';
        }

        return true;
    }

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
        return [
            [['Internal__id__'], 'required'],
            [['Internal__id__', 'A_MONTANT', 'RETOUR_JOURPRELEVEMENT', 'CIV', 'ADR1', 'RETOUR_PERIODICITE', 'DATE_DE_NAISSANCE', 'RETOUR_CATHEORIQUE', 'IDENTIFIANT2', 'A_MOISPA', 'CODE_MEDIA', 'EMAIL1', 'VILLE', 'COMMENTAIRE_DONATEUR', 'RETOUR_PROMESSE', 'CHIENCHATS', 'RETOUR_IDSCAN', 'RETOUR_DATEDENVOI', 'RETOUR_FLAG', 'RETOUR_DATESIGNATURE', 'TEL2', 'A_DATEDS', 'PRENOM', 'N_PERIODICITE', 'COMMENTAIRE_APPEL', 'A_DATEPA', 'RETOUR_NOMFICHIER', 'RETOUR_MONTANT', 'ADR4', 'ADR3', 'RETOUR_COUPON', 'NOM', 'PRIORITE', 'TEL1', 'EMAIL2', 'RETOUR_PREMIERPRELEVEMENT', 'N_MONTANT', 'RETOUR_DATEIMPORT', 'A_JOURPA', 'FILTRE', 'RETOUR_DATESAISIE', 'A_PERIODICITE', 'IDENTIFIANT1', 'CP', 'TEL3', 'N_DATEPA', 'ADR2', '_REMARQUE', '_PROMESSEENVOYEE'], 'string'],
            [['MODIF_ADRESSE', 'MODIF_EMAIL', 'MODIF_TEL'], 'integer'],
            [['N_DATEPA_DAY', 'N_DATEPA_MONTH', 'N_DATEPA_YEAR', 'CHIENCHATS'], 'safe'],
            [['EMAIL1', 'EMAIL2'], 'email', 'message' => 'La valeur doit être un email valide'],
            [['TEL1', 'TEL2'], 'app\components\NixxisPhoneNumberValidator', 'format' => 'FR'],
            [['N_MONTANT'], 'double', 'message' => 'La valeur doit être un montant valide'],
            [['N_MONTANT', 'N_PERIODICITE', 'N_DATEPA_DAY', 'N_DATEPA_MONTH', 'N_DATEPA_YEAR', 'N_DATEPA'], 'required', 'on' => 'PAM SLIMPAY', 'message' => 'Ce champs ne peut être vide'],
            [['N_MONTANT', 'N_PERIODICITE',], 'required', 'on' => 'PAM', 'message' => 'Ce champs ne peut être vide'],
            [['_PROMESSEENVOYEE'], 'required', 'on' => 'ENVOYE', 'message' => 'Ce champs ne peut être vide'],
            [['N_MONTANT'], 'required', 'on' => 'DSM/DSM EN LIGNE', 'message' => 'Ce champs ne peut être vide'],
            [['DATE_DE_NAISSANCE'], 'app\components\NixxisDateValidator'],
            [['N_DATEPA'], 'app\components\IntervalValidator', 'on' => 'PAM SLIMPAY'],
            ['N_MONTANT', 'compare', 'compareValue' => 0, 'operator' => '>', 'message' => 'Le montant doit être supérieur à 0'],
        ];
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
            'N_PERIODICITE' => 'N  Periodicite',
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
            'N_MONTANT' => 'N  Montant',
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
            '_PROMESSEENVOYEE' => 'Promesseenvoyee',
        ];
    }

    public static function GetFormulaireCycles() {

        return array(
            ['id' => 'Mensuelle', 'name' => 'Tous les mois'],
            ['id' => 'Trimestrielle', 'name' => 'Tous les 3 mois'],
            ['id' => 'Semestrielle', 'name' => 'Tous les 6 mois'],
            ['id' => 'Annuelle', 'name' => 'Tous les ans'],
        );
    }

    public static function GetFormulaireRemarque() {

        return array(
            ['id' => 'COURRIER DONNE AU VOISIN', 'name' => 'COURRIER DONNE AU VOISIN'],
            ['id' => 'REFUS DU COURRIER', 'name' => 'REFUS DU COURRIER'],
            ['id' => 'COURRIER BOITE AUX LETTRES', 'name' => 'COURRIER BOITE AUX LETTRES'],
        );
    }

    public static function GetFormulairePromesseEnvoyee() {

        return array(
            ['id' => 'PAM', 'name' => 'PAM'],
            ['id' => 'DSM', 'name' => 'DSM'],
            ['id' => 'PA', 'name' => 'PA'],
            ['id' => 'DS', 'name' => 'DS'],
        );
    }

}
