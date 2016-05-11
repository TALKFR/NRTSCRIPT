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
use app\components\FormWidgets\DateWidget;
use app\components\FormWidgets\YesNoWidget;
?>
<!-- * @property string $_TYPE_ANIMAL_1
 * @property string $_PRENOM_ANIMAL_1
 * @property string $_DATE_NAISSANCE_ANIMAL_1
 * @property string $_RACE_ANIMAL_1
 * @property string $_VACCIN_ANIMAL_1
 * @property string $_TATOUE_PUCE_ANIMAL_1
 * @property string $_ASSURANCE_ANIMAL_1-->
<?= LineWidget::widget() ?>

<?= LineWidget::widget() ?>
<label for="blockchien">Renseignements sur l'animal 1</label>
<div id ="blockchien" class="row">

    <div class="col-sm-3">
        <?= TextBoxWidget::widget(['label' => 'Prénom de l\'animal', 'model' => $model, 'field' => '_PRENOM_ANIMAL_1', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= SelectWidget::widget(['label' => "Race de l'animal", 'model' => $model, 'field' => '_RACE_ANIMAL_1', 'form' => $form, 'data' => app\scripts\Animaux\v1\models\custommodel::getRaces()]) ?>
    </div>      
    <div class="col-sm-6">
        <?= DateWidget::widget(['label' => 'Date de naissance', 'model' => $model, 'field' => '_DATE_NAISSANCE_ANIMAL_1', 'form' => $form,]) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <?= YesNoWidget::widget(['label' => 'Animal vacciné ?', 'model' => $model, 'field' => '_VACCIN_ANIMAL_1', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= YesNoWidget::widget(['label' => 'Animal tatoué ?', 'model' => $model, 'field' => '_TATOUE_PUCE_ANIMAL_1', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= YesNoWidget::widget(['label' => 'Animal assuré ?', 'model' => $model, 'field' => '_ASSURANCE_ANIMAL_1', 'form' => $form]) ?>
    </div>
</div>

<?= LineWidget::widget() ?>

<label for="blockchien">Renseignements sur l'animal 2</label>
<div id ="blockchien" class="row">

    <div class="col-sm-3">
        <?= TextBoxWidget::widget(['label' => 'Prénom de l\'animal', 'model' => $model, 'field' => '_PRENOM_ANIMAL_2', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= SelectWidget::widget(['label' => "Race de l'animal", 'model' => $model, 'field' => '_RACE_ANIMAL_2', 'form' => $form, 'data' => app\scripts\Animaux\v1\models\custommodel::getRaces()]) ?>
    </div>      
    <div class="col-sm-6">
        <?= DateWidget::widget(['label' => 'Date de naissance', 'model' => $model, 'field' => '_DATE_NAISSANCE_ANIMAL_2', 'form' => $form,]) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <?= YesNoWidget::widget(['label' => 'Animal vacciné ?', 'model' => $model, 'field' => '_VACCIN_ANIMAL_2', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= YesNoWidget::widget(['label' => 'Animal tatoué ?', 'model' => $model, 'field' => '_TATOUE_PUCE_ANIMAL_2', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= YesNoWidget::widget(['label' => 'Animal assuré ?', 'model' => $model, 'field' => '_ASSURANCE_ANIMAL_2', 'form' => $form]) ?>
    </div>
</div>

<?= LineWidget::widget() ?>

<label for="blockchien">Renseignements sur l'animal 3</label>
<div id ="blockchien" class="row">

    <div class="col-sm-3">
        <?= TextBoxWidget::widget(['label' => 'Prénom de l\'animal', 'model' => $model, 'field' => '_PRENOM_ANIMAL_3', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= SelectWidget::widget(['label' => "Race de l'animal", 'model' => $model, 'field' => '_RACE_ANIMAL_3', 'form' => $form, 'data' => app\scripts\Animaux\v1\models\custommodel::getRaces()]) ?>
    </div>      
    <div class="col-sm-6">
        <?= DateWidget::widget(['label' => 'Date de naissance', 'model' => $model, 'field' => '_DATE_NAISSANCE_ANIMAL_3', 'form' => $form,]) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <?= YesNoWidget::widget(['label' => 'Animal vacciné ?', 'model' => $model, 'field' => '_VACCIN_ANIMAL_3', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= YesNoWidget::widget(['label' => 'Animal tatoué ?', 'model' => $model, 'field' => '_TATOUE_PUCE_ANIMAL_3', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= YesNoWidget::widget(['label' => 'Animal assuré ?', 'model' => $model, 'field' => '_ASSURANCE_ANIMAL_3', 'form' => $form]) ?>
    </div>
</div>

<?= LineWidget::widget() ?>

<label for="blockchien">Renseignements sur l'animal 4</label>
<div id ="blockchien" class="row">

    <div class="col-sm-3">
        <?= TextBoxWidget::widget(['label' => 'Prénom de l\'animal', 'model' => $model, 'field' => '_PRENOM_ANIMAL_4', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= SelectWidget::widget(['label' => "Race de l'animal", 'model' => $model, 'field' => '_RACE_ANIMAL_4', 'form' => $form, 'data' => app\scripts\Animaux\v1\models\custommodel::getRaces()]) ?>
    </div>      
    <div class="col-sm-6">
        <?= DateWidget::widget(['label' => 'Date de naissance', 'model' => $model, 'field' => '_DATE_NAISSANCE_ANIMAL_4', 'form' => $form,]) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <?= YesNoWidget::widget(['label' => 'Animal vacciné ?', 'model' => $model, 'field' => '_VACCIN_ANIMAL_4', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= YesNoWidget::widget(['label' => 'Animal tatoué ?', 'model' => $model, 'field' => '_TATOUE_PUCE_ANIMAL_4', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= YesNoWidget::widget(['label' => 'Animal assuré ?', 'model' => $model, 'field' => '_ASSURANCE_ANIMAL_4', 'form' => $form]) ?>
    </div>
</div>

<?= LineWidget::widget() ?>




<label for="blockchien">Renseignements sur l'animal 5</label>
<div id ="blockchien" class="row">

    <div class="col-sm-3">
        <?= TextBoxWidget::widget(['label' => 'Prénom de l\'animal', 'model' => $model, 'field' => '_PRENOM_ANIMAL_5', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= SelectWidget::widget(['label' => "Race de l'animal", 'model' => $model, 'field' => '_RACE_ANIMAL_5', 'form' => $form, 'data' => app\scripts\Animaux\v1\models\custommodel::getRaces()]) ?>
    </div>      
    <div class="col-sm-6">
        <?= DateWidget::widget(['label' => 'Date de naissance', 'model' => $model, 'field' => '_DATE_NAISSANCE_ANIMAL_5', 'form' => $form,]) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <?= YesNoWidget::widget(['label' => 'Animal vacciné ?', 'model' => $model, 'field' => '_VACCIN_ANIMAL_5', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= YesNoWidget::widget(['label' => 'Animal tatoué ?', 'model' => $model, 'field' => '_TATOUE_PUCE_ANIMAL_5', 'form' => $form]) ?>
    </div>
    <div class="col-sm-3">
        <?= YesNoWidget::widget(['label' => 'Animal assuré ?', 'model' => $model, 'field' => '_ASSURANCE_ANIMAL_5', 'form' => $form]) ?>
    </div>
</div>

<?= LineWidget::widget() ?>