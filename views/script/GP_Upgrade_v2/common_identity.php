


<div class="row">
    <div class="col-sm-2"  >
        <?= $form->field($model, 'CIV')->textInput()->label('Civilité') ?>
    </div>
    <div class="col-sm-5" >
        <?= $form->field($model, 'NOM')->textInput()->label('Nom') ?>
    </div>
    <div class="col-sm-5" > 
        <?= $form->field($model, 'PRENOM')->textInput()->label('Prénom') ?>
    </div>
</div>    
<div class="row" >
    <div class="col-sm-6">
        <?= $form->field($model, 'ADR1')->textInput()->label('Adresse 1') ?>
        <?= $form->field($model, 'ADR3')->textInput()->label('Adresse 3') ?>
        <?= $form->field($model, 'CP')->textInput()->label('Code Postal') ?>

    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'ADR2')->textInput()->label('Adresse 2') ?>
        <?= $form->field($model, 'ADR4')->textInput()->label('Adresse 4') ?>
        <?= $form->field($model, 'VILLE')->textInput()->label('Ville') ?>
    </div>        
</div>
<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'TEL1')->textInput()->label('Téléphoné mobile') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'TEL2')->textInput()->label('Téléphone fixe') ?>
    </div>        
</div>  
<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'EMAIL1')->textInput()->label('Adresse Email') ?>
    </div>

</div>    
