<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
?>
<div class="row" style=" margin-left: 0px; margin-right: 0px; margin-top: 5px;">
    <div class="col-sm-12" style="margin-top: 5px; background-color: #113060;  height: 2px;"></div>
</div> 
<div class="row">


    <div class="col-sm-6">
        <?=
                $form->field($model, '_DEJA_AFFILIE_123DEVIS')->checkbox(array(
                    'readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false,
                    'label' => '',
                    'labelOptions' => array('style' => 'padding:20px;'),
                    'disabled' => false
                ))
                ->label('Déjà affilié 123 Devis');
        ?>

    </div>

</div> 

<div class="row" >
    <div class="col-sm-6" style="background-color: #e6e6e6; padding-bottom: 15px;">
        <?php
        echo '<label class="control-label" for=rown_datecreation">Date de création de la société</label>';
        echo '<div id="rown_datecreation" class = "row" >';
        echo '<div class = "col-sm-6" > ' . $form->field($model, 'N_DATEPA_MONTH')->dropDownList($model::getMonths(), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Mois') . '</div>';
        echo '<div class = "col-sm-6" > ' . $form->field($model, 'N_DATEPA_YEAR')->dropDownList($model::getYears(), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Année') . '</div>';
        //echo $model::GetMonthProchainPA();
        echo '</div>';
        ?>
    </div>
    <div class="col-sm-6" >
        <?= $form->field($model, '_NB_SALARIE')->dropDownList(ArrayHelper::map($model::GetFormulaireNbSalaries(), 'name', 'name'), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Nombre de salariés') ?>

    </div>    

</div> 
<div class="row">
    <div class="col-sm-3">
        <?=
                $form->field($model, '_AFFILIE_INACTIF')->checkbox(array(
                    'readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false,
                    'label' => '',
                    'labelOptions' => array('style' => 'padding:5px;'),
                    'disabled' => false
                ))
                ->label('Affilié inactif ?');
        ?>    </div>


    <div class="col-sm-3">
        <?=
                $form->field($model, '_FLOTTE_AUTOMOBILE')->checkbox(array(
                    'readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false,
                    'label' => '',
                    'labelOptions' => array('style' => 'padding:5px;'),
                    'disabled' => false
                ))
                ->label('Flotte automobile');
        ?>

    </div>
    <div class="col-sm-3">
        <?=
                $form->field($model, '_SITE_INTERNET')->checkbox(array(
                    'readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false,
                    'label' => '',
                    'labelOptions' => array('style' => 'padding:5px;'),
                    'disabled' => false
                ))
                ->label('Site internet');
        ?>

    </div>    
    <div class="col-sm-3">
        <?=
                $form->field($model, '_ALARME')->checkbox(array(
                    'readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false,
                    'label' => '',
                    'labelOptions' => array('style' => 'padding:5px;'),
                    'disabled' => false
                ))
                ->label('Alarme');
        ?>

    </div>       
</div> 
<div class="row"  style="background-color: #e6e6e6;">
    <div class="col-sm-12">
        <label class="control-label" for=rown_datecreation">Contrat décennal</label>
        <div id="rown_datecreation" class = "row" >
            <div class="col-sm-6">
                <?=
                        $form->field($model, '_CONTRAT_DECENNAL_EN_COURS')->checkbox(array(
                            'readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false,
                            'label' => '',
                            'labelOptions' => array('style' => 'padding:5px;'),
                            'disabled' => false
                        ))
                        ->label('Contrat décennal en cours');
                ?>

            </div>
            <div class="col-sm-6">
                <?=
                        $form->field($model, '_SOUHAITE_DEVIS_DECENNAL')->checkbox(array(
                            'readonly' => ($model->scenario <> 'default' || $model->scenario == 'RO') ? true : false,
                            'label' => '',
                            'labelOptions' => array('style' => 'padding:5px;'),
                            'disabled' => false
                        ))
                        ->label('Si non, souhaite-t-il 1 devis ?');
                ?>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php
        echo DatePicker::widget([
            'language' => 'fr',
            'model' => $model,
            'form' => $form,
            'name' => 'DATE_RAPPEL',
            'readonly' => true,
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'attribute' => 'DATE_RAPPEL',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd/mm/yyyy',
                'todayHighlight' => true
            ],
        ]);
        echo Html::error($model, 'DATE_RAPPEL');
        ?>

    </div>
    <div class="col-sm-6">
        <?php
        echo $form->field($model, 'HEURE_RAPPEL')->widget(TimePicker::classname(), [
            'readonly' => true,
            'pluginOptions' => [
                'showSeconds' => false,
                'showMeridian' => false,
            ]
        ])->label('Heure du rappel');
        ?>
    </div>


</div>
<div class="row" style=" margin-left: 0px; margin-right: 0px; margin-top: 5px;">
    <div class="col-sm-12" style="margin-top: 5px; background-color: #113060;  height: 2px;"></div>
</div> 