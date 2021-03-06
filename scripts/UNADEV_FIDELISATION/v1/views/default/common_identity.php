<?php

use yii\helpers\ArrayHelper;

/* @var $model \app\scripts\UNADEV_FIDELISATION\v1\models\DATA76b3ff146f6c4802b727bb3042493043 */
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
<div class="row" >
    <div class="col-sm-6">
        <?= $form->field($model, 'ADR1')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Adresse 1') ?>
        <?= $form->field($model, 'ADR3')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Adresse 3') ?>
        <?= $form->field($model, 'CP')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Code Postal') ?>

    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'ADR2')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Adresse 2') ?>
        <?= $form->field($model, 'ADR4')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Adresse 4') ?>
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
<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'DATE_DE_NAISSANCE')->textInput(['readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false])->label('Date de naissance (JJ/MM/AAAA)') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'CHIENCHATS')->dropDownList(ArrayHelper::map($model::GetFormulaireChienChats(), 'id', 'name'), ['prompt' => '--Select--', 'disabled' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false], ['class' => 'form-control inline-block updateindicator'])->label('Chien ou chat ?') ?>
    </div>    

</div>   
