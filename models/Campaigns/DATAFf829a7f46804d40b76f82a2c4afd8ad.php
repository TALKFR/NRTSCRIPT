<?php

namespace app\models\Campaigns;

use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "DATA_ff829a7f46804d40b76f82a2c4afd8ad".
 *
 * @property string $Internal__Id__
 * @property string $code_media
 * @property string $numero_membre
 * @property string $civilite
 * @property string $nom
 * @property string $prenom
 * @property string $adr1
 * @property string $adr2
 * @property string $adr3
 * @property string $adr4
 * @property string $cp
 * @property string $ville
 * @property string $tel1
 * @property string $tel2
 * @property string $tel3
 * @property string $date_creation
 * @property string $mnt_1er_pa
 * @property string $mnt_der_pa
 * @property string $cycle_pa
 * @property string $date_der_pa
 * @property string $annee_der_pa
 * @property string $mois_der_pa
 * @property string $jour_der_pa
 * @property string $date_1er_pa
 * @property string $date_der_don
 * @property string $date_1er_don
 * @property string $mnt_der_don
 * @property string $nbr_occurences
 * @property string $profil_vague_fichiers
 * @property string $montant_pa_annuel
 * @property string $origine
 * @property string $trc_operation
 * @property string $tel_trouve
 * @property string $n_montant
 * @property string $n_cycle
 * @property string $date_modification
 * @property string $date_retour
 * @property string $commentaire_appel
 * @property string $commentaire_donateur
 * @property string $priorite
 * @property string $segmentation_fichier
 * @property string $code_fichier
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
 * @property string $raison_desaccord_gp
 * @property string $filtre
 */
//class DATAFf829a7f46804d40b76f82a2c4afd8ad extends \yii\db\ActiveRecord {
class DATAFf829a7f46804d40b76f82a2c4afd8ad extends \app\models\Nixxis\Data {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'DATA_ff829a7f46804d40b76f82a2c4afd8ad';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Internal__Id__'], 'required'],
            [['n_montant'], 'double', 'message' => 'La valeur doit être un montant valide'],
            [['Internal__Id__', 'code_media', 'numero_membre', 'civilite', 'nom', 'prenom', 'adr1', 'adr2', 'adr3', 'adr4', 'cp', 'ville', 'tel1', 'tel2', 'tel3', 'date_creation', 'mnt_1er_pa', 'mnt_der_pa', 'cycle_pa', 'date_der_pa', 'annee_der_pa', 'mois_der_pa', 'jour_der_pa', 'date_1er_pa', 'date_der_don', 'date_1er_don', 'mnt_der_don', 'nbr_occurences', 'profil_vague_fichiers', 'montant_pa_annuel', 'origine', 'trc_operation', 'tel_trouve', 'n_montant', 'n_cycle', 'date_modification', 'date_retour', 'commentaire_appel', 'commentaire_donateur', 'priorite', 'segmentation_fichier', 'code_fichier', 'RETOUR_FLAG', 'RETOUR_DATEIMPORT', 'RETOUR_NOMFICHIER', 'RETOUR_PROMESSE', 'RETOUR_MONTANT', 'RETOUR_PERIODICITE', 'RETOUR_COUPON', 'RETOUR_DATESIGNATURE', 'RETOUR_DATESAISIE', 'RETOUR_JOURPRELEVEMENT', 'RETOUR_PREMIERPRELEVEMENT', 'RETOUR_CATHEORIQUE', 'RETOUR_IDSCAN', 'RETOUR_DATEDENVOI', 'raison_desaccord_gp', 'filtre'], 'string'],
            [['n_montant', 'n_cycle'], 'required', 'on' => 'AUGPA', 'message' => 'Ce champs ne peut être vide'],
            [['n_montant'], 'required', 'on' => 'DSM', 'message' => 'Ce champs ne peut être vide'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'Internal__Id__' => 'Internal   ID',
            'code_media' => 'Code Media',
            'numero_membre' => 'Numero Membre',
            'civilite' => 'Civilite',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'adr1' => 'Adresse 1',
            'adr2' => 'Adresse 2',
            'adr3' => 'Adresse 3',
            'adr4' => 'Adresse 4',
            'cp' => 'Code Postal',
            'ville' => 'Ville',
            'tel1' => 'Tel1',
            'tel2' => 'Tel2',
            'tel3' => 'Téléphone secondaire',
            'date_creation' => 'Date Creation',
            'mnt_1er_pa' => 'Mnt 1er Pa',
            'mnt_der_pa' => 'Mnt Der Pa',
            'cycle_pa' => 'Cycle Pa',
            'date_der_pa' => 'Date Der Pa',
            'annee_der_pa' => 'Annee Der Pa',
            'mois_der_pa' => 'Mois Der Pa',
            'jour_der_pa' => 'Jour Der Pa',
            'date_1er_pa' => 'Date 1er Pa',
            'date_der_don' => 'Date Der Don',
            'date_1er_don' => 'Date 1er Don',
            'mnt_der_don' => 'Mnt Der Don',
            'nbr_occurences' => 'Nbr Occurences',
            'profil_vague_fichiers' => 'Profil Vague Fichiers',
            'montant_pa_annuel' => 'Montant Pa Annuel',
            'origine' => 'Origine',
            'trc_operation' => 'Trc Operation',
            'tel_trouve' => 'Téléphone principale',
            'n_montant' => 'N Montant',
            'n_cycle' => 'N Cycle',
            'date_modification' => 'Date Modification',
            'date_retour' => 'Date Retour',
            'commentaire_appel' => 'Commentaire Appel',
            'commentaire_donateur' => 'Commentaire Donateur',
            'priorite' => 'Priorite',
            'segmentation_fichier' => 'Segmentation Fichier',
            'code_fichier' => 'Code Fichier',
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
            'raison_desaccord_gp' => 'Raison Desaccord Gp',
            'filtre' => 'Filtre',
        ];
    }

    public static function GetFormulaireCycles() {
        return array(
            ['id' => '12', 'name' => 'Tous les mois'],
            ['id' => '6', 'name' => 'Tous les 2 mois'],
            ['id' => '4', 'name' => 'Tous les 3 mois'],
            ['id' => '2', 'name' => 'Tous les 6 mois'],
            ['id' => '1', 'name' => 'Tous les 12 mois'],
        );
    }

    public function GetProchainPA() {
        if (Date('d') < 10) {
            $date = Date('Y-m-') . $this->jour_der_pa;
            $date = date("Y-m", strtotime("+1 month", strtotime($date . "-01")));
            return $date;
        } else {
            $date = Date('Y-m-') . $this->jour_der_pa;
            $date = date("Y-m-d", strtotime("+2 month", strtotime($date . "-01")));
            return $date;
        }
    }

    public function search($params, $filtersearch) {
        $query = $this::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->andFilterWhere($filtersearch);

        $query->andFilterWhere(['like', 'nom', $this->nom])
                ->andFilterWhere(['like', 'prenom', $this->prenom])
                ->andFilterWhere(['like', 'tel_trouve', $this->tel_trouve])
                ->andFilterWhere(['like', 'tel3', $this->tel3])
                ->andFilterWhere(['like', 'cp', $this->cp])
                ->andFilterWhere(['like', 'ville', $this->ville])

        ;

        return $dataProvider;
    }

}
