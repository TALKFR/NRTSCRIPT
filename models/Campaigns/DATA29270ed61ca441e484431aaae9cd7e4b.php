<?php

namespace app\models\Campaigns;

use Yii;
use app\components\EitherValidator;

/*
 * CHAINE DE L'ESPOIR UPGRADE
 * 
 */

/**
 * This is the model class for table "DATA_29270ed61ca441e484431aaae9cd7e4b".
 *
 * @property string $Internal__id__
 * @property string $CODE_MEDIA
 * @property string $IDENTIFIANT1
 * @property string $IDENTIFIANT2
 * @property string $CIV
 * @property string $NOM
 * @property string $PRENOM
 * @property string $_RAISON_SOCIALE_ENTREPRISE
 * @property string $ADR1
 * @property string $ADR2
 * @property string $_NUMERO_DE_RUE
 * @property string $_CODE_BIS
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
 * @property string $A_MONTANT
 * @property string $A_PERIODICITE
 * @property string $A_DATEPA
 * @property string $COMMENTAIRE_APPEL
 * @property string $COMMENTAIRE_DONATEUR
 * @property string $DATE_DE_NAISSANCE
 * @property string $FILTRE
 * @property string $PRIORITE
 * @property integer $MODIF_ADRESSE
 * @property integer $MODIF_EMAIL
 * @property integer $MODIF_TEL
 * @property string $N_MONTANT
 * @property string $N_PERIODICITE
 * @property string $N_DATEPA
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
 */
class DATA29270ed61ca441e484431aaae9cd7e4b extends \app\models\Nixxis\Data {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'DATA_29270ed61ca441e484431aaae9cd7e4b';
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
            [['Internal__id__', 'CODE_MEDIA', 'IDENTIFIANT1', 'IDENTIFIANT2', 'CIV', 'NOM', 'PRENOM', '_RAISON_SOCIALE_ENTREPRISE', 'ADR1', 'ADR2', '_NUMERO_DE_RUE', '_CODE_BIS', 'ADR3', 'ADR4', 'CP', 'VILLE', 'PAYS', 'TEL1', 'TEL2', 'TEL3', 'EMAIL1', 'EMAIL2', 'A_MONTANT', 'A_PERIODICITE', 'A_DATEPA', 'COMMENTAIRE_APPEL', 'COMMENTAIRE_DONATEUR', 'DATE_DE_NAISSANCE', 'FILTRE', 'PRIORITE', 'N_MONTANT', 'N_PERIODICITE', 'N_DATEPA', 'RETOUR_FLAG', 'RETOUR_DATEIMPORT', 'RETOUR_NOMFICHIER', 'RETOUR_PROMESSE', 'RETOUR_MONTANT', 'RETOUR_PERIODICITE', 'RETOUR_COUPON', 'RETOUR_DATESIGNATURE', 'RETOUR_DATESAISIE', 'RETOUR_JOURPRELEVEMENT', 'RETOUR_PREMIERPRELEVEMENT', 'RETOUR_CATHEORIQUE', 'RETOUR_IDSCAN', 'RETOUR_DATEDENVOI', '_CODE_OBSERVATION'], 'string'],
            [['MODIF_ADRESSE', 'MODIF_EMAIL', 'MODIF_TEL'], 'integer'],
            [['EMAIL1', 'EMAIL2'], 'email', 'message' => 'La valeur doit être un email valide'],
            [['TEL1', 'TEL2', 'TEL3'], 'app\components\NixxisPhoneNumberValidator', 'format' => 'FR'],
            [['N_MONTANT'], 'double', 'message' => 'La valeur doit être un montant valide'],
            [['N_MONTANT', 'N_PERIODICITE', 'N_DATEPA'], 'required', 'on' => 'AUGPAM', 'message' => 'Ce champs ne peut être vide'],
            [['N_MONTANT', 'N_PERIODICITE', 'N_DATEPA', 'CIV', 'NOM', 'PRENOM'], 'required', 'on' => 'AUGPAMEMAIL', 'message' => 'Ce champs ne peut être vide'],
            [['EMAIL1', 'EMAIL2'], EitherValidator::className(), 'on' => 'AUGPAMEMAIL', 'message' => 'Ce champs ne peut être vide'],
            [['N_MONTANT'], 'required', 'on' => 'DSM', 'message' => 'Ce champs ne peut être vide'],
            [['N_MONTANT'], 'required', 'on' => 'DSMENLIGNE', 'message' => 'Ce champs ne peut être vide'],
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
            'CIV' => 'Civ',
            'NOM' => 'Nom',
            'PRENOM' => 'Prenom',
            '_RAISON_SOCIALE_ENTREPRISE' => 'Raison  Sociale  Entreprise',
            'ADR1' => 'Adr1',
            'ADR2' => 'Adr2',
            '_NUMERO_DE_RUE' => 'Numero  De  Rue',
            '_CODE_BIS' => 'Code  Bis',
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
            'A_MONTANT' => 'A  Montant',
            'A_PERIODICITE' => 'A  Periodicite',
            'A_DATEPA' => 'A  Datepa',
            'COMMENTAIRE_APPEL' => 'Commentaire  Appel',
            'COMMENTAIRE_DONATEUR' => 'Commentaire  Donateur',
            'DATE_DE_NAISSANCE' => 'Date  De  Naissance',
            'FILTRE' => 'Filtre',
            'PRIORITE' => 'Priorite',
            'MODIF_ADRESSE' => 'Modif  Adresse',
            'MODIF_EMAIL' => 'Modif  Email',
            'MODIF_TEL' => 'Modif  Tel',
            'N_MONTANT' => 'N  Montant',
            'N_PERIODICITE' => 'N  Periodicite',
            'N_DATEPA' => 'Date du prochain prélévement',
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
            '_CODE_OBSERVATION' => 'Code observation'
        ];
    }

    public static function GetFormulaireObs() {
        return array(
            ['id' => '0', 'name' => 'Pas d\'observation'],
            ['id' => '1', 'name' => 'Ne souhaite plus être appelé'],
            ['id' => '2', 'name' => 'Désire être rayé du fichier'],
            ['id' => '3', 'name' => 'Désire recevoir 1 à 2 courriers'],
            ['id' => '4', 'name' => 'N\'a pas reçu son reçu fiscal'],
            ['id' => '5', 'name' => 'Déçu par l\'organisme'],
            ['id' => '6', 'name' => 'Souhaite être bénévole'],
            ['id' => '7', 'name' => 'Décédé'],
            ['id' => '8', 'name' => 'Déménagé'],
            ['id' => '9', 'name' => 'Doublons'],
            ['id' => '10', 'name' => 'N\'adhère plus à la cause'],
            ['id' => '11', 'name' => 'A quitté l\'association']
        );
    }

    public static function GetFormulaireCycles() {
        return array(
            ['id' => '1', 'name' => 'Tous les mois'],
            ['id' => '2', 'name' => 'Tous les 2 mois'],
            ['id' => '3', 'name' => 'Tous les 3 mois'],
            ['id' => '6', 'name' => 'Tous les 6 mois'],
            ['id' => '12', 'name' => 'Tous les 12 mois'],
        );
    }

    public static function GetTextCycle($cycle) {
        $tmp = null;
        $cyclesPA = self::GetFormulaireCycles();
        foreach ($cyclesPA as $cyclePA) {
            if ($cyclePA['id'] == $cycle) {
                $tmp = $cyclePA['name'];
            }
        }
        return $tmp;
    }

    public function GetEmailsCount() {
        if ($this->EMAIL1 <> '' && $this->EMAIL2 <> '') {
            return 2;
        } elseif ($this->EMAIL1 <> '') {
            return 1;
        } elseif ($this->EMAIL2 <> '') {
            return 1;
        } else
            return 0;
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if (($this->ADR1 != $this->getOldAttribute('ADR1')) || ($this->ADR2 != $this->getOldAttribute('ADR2')) || ($this->ADR3 != $this->getOldAttribute('ADR3')) || ($this->ADR4 != $this->getOldAttribute('ADR4')) || ($this->CP != $this->getOldAttribute('CP')) || ($this->VILLE != $this->getOldAttribute('VILLE')) || ($this->PAYS != $this->getOldAttribute('PAYS')) || ($this->_NUMERO_DE_RUE != $this->getOldAttribute('_NUMERO_DE_RUE')) || ($this->_CODE_BIS != $this->getOldAttribute('_CODE_BIS'))
        ) {
            $this->MODIF_ADRESSE = 1;
        }

        if (($this->TEL1 != $this->getOldAttribute('TEL1')) ||
                ($this->TEL2 != $this->getOldAttribute('TEL2')) ||
                ($this->TEL3 != $this->getOldAttribute('TEL3'))
        ) {
            $this->MODIF_TEL = 1;
        }

        if (($this->EMAIL1 != $this->getOldAttribute('EMAIL1')) || ($this->EMAIL2 != $this->getOldAttribute('EMAIL2'))) {
            $this->MODIF_EMAIL = 1;
        }
        return true;
    }

}
