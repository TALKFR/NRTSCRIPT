<?php

namespace app\models\Campaigns;

use Yii;

/**
 * This is the model class for table "DATA_76b3ff146f6c4802b727bb3042493043".
 *
 * @property string $Internal__id__
 * @property string $N_MONTANT
 * @property string $CODE_MEDIA
 * @property string $TEL1
 * @property string $RETOUR_PREMIERPRELEVEMENT
 * @property string $ADR1
 * @property string $RETOUR_PROMESSE
 * @property string $N_DATEPA
 * @property string $COMMENTAIRE_APPEL
 * @property string $RETOUR_DATEIMPORT
 * @property string $RETOUR_NOMFICHIER
 * @property integer $MODIF_EMAIL
 * @property string $RETOUR_IDSCAN
 * @property string $A_JOURPA
 * @property string $RETOUR_DATESIGNATURE
 * @property string $PRIORITE
 * @property string $RETOUR_COUPON
 * @property string $PRENOM
 * @property string $ADR2
 * @property string $A_MONTANT
 * @property string $RETOUR_DATESAISIE
 * @property string $IDENTIFIANT2
 * @property string $CP
 * @property string $IDENTIFIANT1
 * @property string $RETOUR_CATHEORIQUE
 * @property string $DATE_DE_NAISSANCE
 * @property string $RETOUR_FLAG
 * @property string $FILTRE
 * @property string $EMAIL2
 * @property string $RETOUR_JOURPRELEVEMENT
 * @property string $A_PERIODICITE
 * @property integer $MODIF_ADRESSE
 * @property integer $MODIF_TEL
 * @property string $EMAIL1
 * @property string $A_MOISPA
 * @property string $VILLE
 * @property string $NOM
 * @property string $N_PERIODICITE
 * @property string $A_DATEPA
 * @property string $RETOUR_DATEDENVOI
 * @property string $RETOUR_PERIODICITE
 * @property string $TEL2
 * @property string $ADR4
 * @property string $ADR3
 * @property string $TEL3
 * @property string $COMMENTAIRE_DONATEUR
 * @property string $RETOUR_MONTANT
 * @property string $CIV
 * @property string $A_DATEDS
 */
class DATA76b3ff146f6c4802b727bb3042493043 extends \app\models\Nixxis\Data {

    public $N_DATEPA_DAY;
    public $N_DATEPA_MONTH;
    public $N_DATEPA_YEAR;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'DATA_76b3ff146f6c4802b727bb3042493043';
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
            [['Internal__id__', 'N_MONTANT', 'CODE_MEDIA', 'TEL1', 'RETOUR_PREMIERPRELEVEMENT', 'ADR1', 'RETOUR_PROMESSE', 'N_DATEPA', 'COMMENTAIRE_APPEL', 'RETOUR_DATEIMPORT', 'RETOUR_NOMFICHIER', 'RETOUR_IDSCAN', 'A_JOURPA', 'RETOUR_DATESIGNATURE', 'PRIORITE', 'RETOUR_COUPON', 'PRENOM', 'ADR2', 'A_MONTANT', 'RETOUR_DATESAISIE', 'IDENTIFIANT2', 'CP', 'IDENTIFIANT1', 'RETOUR_CATHEORIQUE', 'DATE_DE_NAISSANCE', 'RETOUR_FLAG', 'FILTRE', 'EMAIL2', 'RETOUR_JOURPRELEVEMENT', 'A_PERIODICITE', 'EMAIL1', 'A_MOISPA', 'VILLE', 'NOM', 'N_PERIODICITE', 'A_DATEPA', 'RETOUR_DATEDENVOI', 'RETOUR_PERIODICITE', 'TEL2', 'ADR4', 'ADR3', 'TEL3', 'COMMENTAIRE_DONATEUR', 'RETOUR_MONTANT', 'CIV', 'A_DATEDS'], 'string'],
            [['MODIF_EMAIL', 'MODIF_ADRESSE', 'MODIF_TEL'], 'integer'],
            [['N_DATEPA_DAY', 'N_DATEPA_MONTH', 'N_DATEPA_YEAR'], 'safe'],
            [['EMAIL1', 'EMAIL2'], 'email', 'message' => 'La valeur doit être un email valide'],
            [['TEL1', 'TEL2'], 'app\components\NixxisPhoneNumberValidator', 'format' => 'FR'],
            [['N_MONTANT'], 'double', 'message' => 'La valeur doit être un montant valide'],
            [['N_MONTANT', 'N_PERIODICITE', 'N_DATEPA_DAY', 'N_DATEPA_MONTH', 'N_DATEPA_YEAR', 'N_DATEPA'], 'required', 'on' => 'PAM SLIMPAY', 'message' => 'Ce champs ne peut être vide'],
            [['N_MONTANT', 'N_PERIODICITE',], 'required', 'on' => 'PAM', 'message' => 'Ce champs ne peut être vide'],
            [['N_DATEPA'], 'safe', 'on' => 'PA'],
            [['N_MONTANT'], 'required', 'on' => 'DSM/DSM EN LIGNE', 'message' => 'Ce champs ne peut être vide'],
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
            'N_MONTANT' => 'N  Montant',
            'CODE_MEDIA' => 'Code  Media',
            'TEL1' => 'Tel1',
            'RETOUR_PREMIERPRELEVEMENT' => 'Retour  Premierprelevement',
            'ADR1' => 'Adr1',
            'RETOUR_PROMESSE' => 'Retour  Promesse',
            'N_DATEPA' => 'N  Datepa',
            'COMMENTAIRE_APPEL' => 'Commentaire  Appel',
            'RETOUR_DATEIMPORT' => 'Retour  Dateimport',
            'RETOUR_NOMFICHIER' => 'Retour  Nomfichier',
            'MODIF_EMAIL' => 'Modif  Email',
            'RETOUR_IDSCAN' => 'Retour  Idscan',
            'A_JOURPA' => 'A  Jourpa',
            'RETOUR_DATESIGNATURE' => 'Retour  Datesignature',
            'PRIORITE' => 'Priorite',
            'RETOUR_COUPON' => 'Retour  Coupon',
            'PRENOM' => 'Prenom',
            'ADR2' => 'Adr2',
            'A_MONTANT' => 'A  Montant',
            'RETOUR_DATESAISIE' => 'Retour  Datesaisie',
            'IDENTIFIANT2' => 'Identifiant2',
            'CP' => 'Cp',
            'IDENTIFIANT1' => 'Identifiant1',
            'RETOUR_CATHEORIQUE' => 'Retour  Catheorique',
            'DATE_DE_NAISSANCE' => 'Date  De  Naissance',
            'RETOUR_FLAG' => 'Retour  Flag',
            'FILTRE' => 'Filtre',
            'EMAIL2' => 'Email2',
            'RETOUR_JOURPRELEVEMENT' => 'Retour  Jourprelevement',
            'A_PERIODICITE' => 'A  Periodicite',
            'MODIF_ADRESSE' => 'Modif  Adresse',
            'MODIF_TEL' => 'Modif  Tel',
            'EMAIL1' => 'Email1',
            'A_MOISPA' => 'A  Moispa',
            'VILLE' => 'Ville',
            'NOM' => 'Nom',
            'N_PERIODICITE' => 'N  Periodicite',
            'A_DATEPA' => 'A  Datepa',
            'RETOUR_DATEDENVOI' => 'Retour  Datedenvoi',
            'RETOUR_PERIODICITE' => 'Retour  Periodicite',
            'TEL2' => 'Tel2',
            'ADR4' => 'Adr4',
            'ADR3' => 'Adr3',
            'TEL3' => 'Tel3',
            'COMMENTAIRE_DONATEUR' => 'Commentaire  Donateur',
            'RETOUR_MONTANT' => 'Retour  Montant',
            'CIV' => 'Civ',
            'A_DATEDS' => 'A  Dateds',
        ];
    }

    public function beforeValidate() {
        parent::beforeValidate();
        $this->N_DATEPA = $this->N_DATEPA_DAY . '/' . $this->N_DATEPA_MONTH . '/' . $this->N_DATEPA_YEAR;

        return true;
    }

    public static function GetFormulaireCycles() {

        return array(
            ['id' => 'Mensuelle', 'name' => 'Tous les mois'],
            ['id' => 'Trimestrielle', 'name' => 'Tous les 3 mois'],
            ['id' => 'Semestrielle', 'name' => 'Tous les 6 mois'],
            ['id' => 'Annuelle', 'name' => 'Tous les ans'],
        );
    }

    /**
     * 
     * @param type $day
     * @return \DateTime
     */
    public static function GetMonthProchainPA($day) {
        $datedujour = new \DateTime(Date('Y-m-d'));
        //$datedujour = new \DateTime('2016-12-01');
        for ($i = 0; $i < 3; $i++) {
            $tmp = clone $datedujour;
            $d = $tmp->format('d');
            $m = $tmp->format('m');
            $Y = $tmp->format('Y');
            $tmp->setDate($Y, $m, $day);
            $datenpa = $tmp->add(new \DateInterval('P' . $i . 'M'));
            $diff = ($datenpa < $datedujour) ? -1 * ($datenpa->diff($datedujour)->format("%a")) : $datenpa->diff($datedujour)->format("%a");
            if ($diff > 10) {
                break;
            }
        }
        //echo $datenpa->format('Y-m-d');
        return $datenpa->format('m');
    }

    /**
     * 
     * @param type $day
     * @return \DateTime
     */
    public static function GetYearProchainPA($day) {
        $datedujour = new \DateTime(Date('Y-m-d'));
        //$datedujour = new \DateTime('2016-12-01');
        for ($i = 0; $i < 3; $i++) {
            $tmp = clone $datedujour;
            $d = $tmp->format('d');
            $m = $tmp->format('m');
            $Y = $tmp->format('Y');
            $tmp->setDate($Y, $m, $day);
            $datenpa = $tmp->add(new \DateInterval('P' . $i . 'M'));
            $diff = ($datenpa < $datedujour) ? -1 * ($datenpa->diff($datedujour)->format("%a")) : $datenpa->diff($datedujour)->format("%a");
            if ($diff > 10) {
                break;
            }
        }
        //echo $datenpa->format('Y-m-d');
        return $datenpa->format('Y');
    }

}
