<?php

use yii\helpers\ArrayHelper;
use app\components\FormWidgets\LineWidget;
use app\components\FormWidgets\TextBoxWidget;
use app\components\FormWidgets\CheckBoxWidget;
use app\components\FormWidgets\MonthYearWidget;
use app\components\FormWidgets\YearWidget;
use app\components\FormWidgets\SelectWidget;
use app\components\FormWidgets\DateWidget;
use app\components\FormWidgets\YesNoWidget;
use app\components\FormWidgets\ButtonWidget;

/* @var $model \app\scripts\LCDE_REACTIVIATION\v1\models\DATA27a28f0a1a314c8ebdcdd3448922cef0 */
?>

<div class="row">
    <div class="col-sm-2"  >
        <?= $form->field($model, 'CIV')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Civilité') ?>
    </div>
    <div class="col-sm-5" >
        <?= $form->field($model, 'NOM')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Nom') ?>
    </div>
    <div class="col-sm-5" > 
        <?= $form->field($model, 'PRENOM')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Prénom') ?>
    </div>
</div>    
<div class="row">
    <div class="col-sm-12"  >
        <?= $form->field($model, '_RAISON_SOCIALE_ENTREPRISE')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Raison sociale') ?>
    </div>

</div>  
<div class="row" >
    <div class="col-sm-6">
        <?= $form->field($model, 'ADR1')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Adresse 1') ?>


    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'ADR2')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Adresse 2') ?>

    </div>        
</div>
<div class="row" >
    <div class="col-sm-3">
        <?= $form->field($model, '_NUMERO_DE_RUE')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false, 'maxlength' => 4, 'style' => 'width:80px'])->label('Numéro de rue') ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model, '_CODE_BIS')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false, 'maxlength' => 4, 'style' => 'width:80px'])->label('Code bis') ?>

    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'ADR3')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Adresse 3') ?>

    </div>
</div>
<div class="row" >

    <div class="col-sm-6">

        <?= $form->field($model, 'ADR4')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Adresse 4') ?>
    </div>      
    <div class="col-sm-2">


        <?= $form->field($model, 'CP')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Code Postal') ?>

    </div>    
    <div class="col-sm-4">

        <?= $form->field($model, 'VILLE')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Ville') ?>
    </div>       
</div>
<div class="row">
    <div class="col-sm-4">
        <?= $form->field($model, 'TEL1')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Téléphoné mobile') ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'TEL2')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Téléphone fixe') ?>
    </div>        
    <div class="col-sm-4">
        <?= $form->field($model, 'TEL3')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Téléphone professionel') ?>
    </div>       
</div>  
<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'EMAIL1')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Adresse Email 1') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'EMAIL2')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Adresse Email 2') ?>
    </div>
</div>     
