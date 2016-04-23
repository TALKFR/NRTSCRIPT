<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use app\components\FormWidgets\LineWidget;
use app\components\FormWidgets\TextBoxWidget;
use app\components\FormWidgets\CheckBoxWidget;
use app\components\FormWidgets\MonthYearWidget;
use app\components\FormWidgets\YearWidget;
use app\components\FormWidgets\SelectWidget;
?>

<?= LineWidget::widget() ?>
<label for="blocktravaux">Coordonnées des travaux</label>
<div id ="blocktravaux" class="row">

    <div class="col-sm-5">
        <?= TextBoxWidget::widget(['label' => 'Adresse', 'model' => $model, 'field' => '_ADRESSE_TRAVAUX', 'form' => $form]) ?>
    </div>
    <div class="col-sm-2">
        <?= TextBoxWidget::widget(['label' => 'Code Postal', 'model' => $model, 'field' => '_CP_TRAVAUX', 'form' => $form]) ?>
    </div>
    <div class="col-sm-5">
        <?= TextBoxWidget::widget(['label' => 'Ville', 'model' => $model, 'field' => '_VILLE_TRAVAUX', 'form' => $form]) ?>
    </div>
</div> 
<?= LineWidget::widget() ?>
<label for="blockchien">Renseignements sur le chien</label>
<div id ="blockchien" class="row">
    <div class="col-sm-3">
        <?= CheckBoxWidget::widget(['label' => 'Avez vous un chien ?', 'model' => $model, 'field' => '_CHIEN', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= CheckBoxWidget::widget(['label' => 'Devis mutuelle ?', 'model' => $model, 'field' => '_DEVIS_CHIEN', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= TextBoxWidget::widget(['label' => 'Nom', 'model' => $model, 'field' => '_NOM_CHIEN', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= YearWidget::widget(['label' => 'Année de naissance', 'model' => $model, 'field' => '_ANNEE_NAISSANCE_CHIEN', 'form' => $form]) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <?= SelectWidget::widget(['label' => 'Nombre de chien(s)', 'model' => $model, 'field' => '_NB_CHIEN', 'form' => $form, 'data' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5 et +']]) ?>
    </div>   
</div> 
<?= LineWidget::widget() ?>
<label for="blockchat">Renseignements sur le chat</label>
<div id ="blockchat" class="row">
    <div class="col-sm-3">
        <?= CheckBoxWidget::widget(['label' => 'Avez vous un chat ?', 'model' => $model, 'field' => '_CHAT', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= CheckBoxWidget::widget(['label' => 'Devis mutuelle ?', 'model' => $model, 'field' => '_DEVIS_CHAT', 'form' => $form]) ?>
    </div>

    <div class="col-sm-3">
        <?= TextBoxWidget::widget(['label' => 'Nom', 'model' => $model, 'field' => '_NOM_CHAT', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= YearWidget::widget(['label' => 'Année de naissance', 'model' => $model, 'field' => '_ANNEE_NAISSANCE_CHAT', 'form' => $form]) ?>
    </div> 

</div>
<div class="row">
    <div class="col-sm-3">
        <?= SelectWidget::widget(['label' => 'Nombre de chat(s)', 'model' => $model, 'field' => '_NB_CHAT', 'form' => $form, 'data' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5 et +']]) ?>
    </div>   
</div> 
<?= LineWidget::widget() ?>
<label for="blockdons">Dons</label>
<div id ="blockchien" class="row">
    <div class="col-sm-6">
        <?= CheckBoxWidget::widget(['label' => 'Donneriez vous pour Greenpeace ?', 'model' => $model, 'field' => '_DON_GREENPEACE', 'form' => $form]) ?>
    </div>
    <div class="col-sm-6">
        <?= CheckBoxWidget::widget(['label' => 'Donneriez vous pour les enfants aveugles ?', 'model' => $model, 'field' => '_DON_ENFANTS_AVEUGLES', 'form' => $form]) ?>
    </div>

</div> 
<?= LineWidget::widget() ?>
<label for="blockrappel">Rappel</label>
<div id ="blockchien" class="row">

    <?= MonthYearWidget::widget(['label_month' => 'Mois', 'label_year' => 'Année', 'model' => $model, 'field_month' => 'MOIS_RAPPEL', 'field_year' => 'ANNEE_RAPPEL', 'form' => $form]) ?>


</div> 


<?= LineWidget::widget() ?>