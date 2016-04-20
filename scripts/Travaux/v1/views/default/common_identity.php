<?php

use yii\helpers\ArrayHelper;
use app\components\FormWidgets\TextBoxWidget;
?>
<div class="row">
    <div class="col-sm-6">
        <?= TextBoxWidget::widget(['label' => 'Raison sociale 1', 'model' => $model, 'field' => 'RS1', 'form' => $form]) ?>
    </div>
    <div class="col-sm-6">
        <?= TextBoxWidget::widget(['label' => 'Raison sociale 2', 'model' => $model, 'field' => 'RS2', 'form' => $form]) ?>
    </div>
</div> 
<div class="row">
    <div class="col-sm-2"  >
        <?= TextBoxWidget::widget(['label' => 'Civilité', 'model' => $model, 'field' => 'CIV', 'form' => $form]) ?>
    </div>
    <div class="col-sm-5" >
        <?= TextBoxWidget::widget(['label' => 'Nom', 'model' => $model, 'field' => 'NOM', 'form' => $form]) ?>
    </div>
    <div class="col-sm-5" > 
        <?= TextBoxWidget::widget(['label' => 'Prénom', 'model' => $model, 'field' => 'PRENOM', 'form' => $form]) ?>
    </div>
</div>    
<div class="row" >
    <div class="col-sm-6">
        <?= TextBoxWidget::widget(['label' => 'Adresse 1', 'model' => $model, 'field' => 'ADR1', 'form' => $form]) ?>
        <?= TextBoxWidget::widget(['label' => 'Adresse 3', 'model' => $model, 'field' => 'ADR3', 'form' => $form]) ?>
        <?= TextBoxWidget::widget(['label' => 'Code Postal', 'model' => $model, 'field' => 'CP', 'form' => $form]) ?>
    </div>
    <div class="col-sm-6">
        <?= TextBoxWidget::widget(['label' => 'Adresse 2', 'model' => $model, 'field' => 'ADR2', 'form' => $form]) ?>
        <?= TextBoxWidget::widget(['label' => 'Adresse 4', 'model' => $model, 'field' => 'ADR4', 'form' => $form]) ?>
        <?= TextBoxWidget::widget(['label' => 'Ville', 'model' => $model, 'field' => 'VILLE', 'form' => $form]) ?>        
    </div>        
</div>
<div class="row">
    <div class="col-sm-4">
        <?= TextBoxWidget::widget(['label' => 'Téléphone mobile', 'model' => $model, 'field' => 'TEL1', 'form' => $form]) ?>
    </div>
    <div class="col-sm-4">
        <?= TextBoxWidget::widget(['label' => 'Téléphone fixe', 'model' => $model, 'field' => 'TEL2', 'form' => $form]) ?>
    </div>        
    <div class="col-sm-4">
        <?= TextBoxWidget::widget(['label' => 'Téléphone professionnel', 'model' => $model, 'field' => 'TEL3', 'form' => $form]) ?>
    </div>       
</div>  
<div class="row">
    <div class="col-sm-6">
        <?= TextBoxWidget::widget(['label' => 'Adresse Email 1', 'model' => $model, 'field' => 'EMAIL1', 'form' => $form]) ?>
    </div>
    <div class="col-sm-6">
        <?= TextBoxWidget::widget(['label' => 'Adresse Email 2', 'model' => $model, 'field' => 'EMAIL2', 'form' => $form]) ?>
    </div>
</div>     
