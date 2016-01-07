<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\time\TimePicker;

/* @var $model \app\models\Campaigns\DATA4307f92b371f4d918b0d30be75048ef4 */
?>
<script type="text/javascript" >
    function SetQualification(qualid) {
        $(document).ready(function () {
            var $form = $("#qualify-form");
            data = $form.data("yiiActiveForm");
            $.each(data.attributes, function () {
                this.status = 3;
            });
        });
    }

</script>  
<div class="site-index">

    <?php
    // CODE POUR LIMITER LA PLAGE HORAIRE DU RAPPEL ENTRE 9h30 ET 19H30
    $this->registerJs("
    $(\"#nixxisqualifications-callbacktime\").on('changeTime.timepicker', function (e) {

        var hours = e.time.hours;
        var minutes = e.time.minutes;

        if (hours > 19) {
            $(this).timepicker('setTime', '9:15');
        }

        if (hours < 9) {
            $(this).timepicker('setTime', '19:30');
        }

        if (hours == 9 && minutes < 15) {
            $(this).timepicker('setTime', '19:30');
        }

        if (hours == 19 && minutes > 30) {
            $(this).timepicker('setTime', '9:15');
        }

    });             
", $this::POS_READY);


// print_r($NixxisParameters);
//    echo $NixxisParameters->contactid;
//    exit(0);
    $form = ActiveForm::begin(['id' => 'qualify-form',
                'action' => [$Script['ControllerDirectory'] . '_v' . $Script['Version'] . '/script/qualify', 'Internal__id__' => $model->Internal__id__]]);
    ?>
    <?php
//    print_r($NixxisQualifications);
//    exit(0);
    // echo $model_qualifications->qualificationId;
//    echo 'DialerCampaign   : ' . $NixxisParameters->diallerCampaign . '<br>';
//    echo 'Contactid        : ' . $NixxisParameters->contactid . '<br>';
//    echo 'DiallerReference : ' . $NixxisParameters->diallerReference . '<br>';
//    echo 'autosearch       : ' . $NixxisParameters->autosearch . '<br>';
//    echo 'sessionid        : ' . $NixxisParameters->sessionid . '<br>';
    ?>
    <div class="row">
        <div class="col-sm-2" >
            <div class="row" style="text-align: center;">
                <span style="color: red;"><b>APPEL SORTANT</b> </span>
            </div>
            <div class="row" style="background-color: #113060; color: #ffffff; font-size: 10px;">
                <span style="text-decoration: underline;"><b>Numéro membre :</b> </span>
                <br><?= $model->IDENTIFIANT1 ?>
                <br>
                <span style="text-decoration: underline;"><b>Code média :</b> </span>
                <br><?= $model->CODE_MEDIA ?>    
                <br>
                <span style="text-decoration: underline;"><b>Montant dernier PA :</b> </span>
                <br><?= $model->A_MONTANT ?>     
                <br>
                <span style="text-decoration: underline;"><b>Cycle actuel :</b> </span>
                <br><?= $model->GetTextCycle($model->A_PERIODICITE) ?>    
                <br>
                <span style="text-decoration: underline;"><b>Mois dernier PA :</b> </span>
                <br><?= $model->A_MOISPA ?>   
                <br>
                <span style="text-decoration: underline;"><b>Jour dernier PA :</b> </span>
                <br><?= $model->A_JOURPA ?>                  
            </div>
        </div>

        <div class="col-sm-10">
            <?php
//            $form = ActiveForm::begin(['id' => 'qualify-form', 'action' => ['site/update', 'Internal__Id__' => $model->Internal__Id__]]);
            ?>

            <?= $form->field($model_qualifications, 'qualificationId')->hiddenInput()->label(false) ?>
            <?= $form->field($model_qualifications, 'callbackDateTime')->hiddenInput(['id' => 'callbackDateTime'])->label(false) ?>
            <?= $form->field($model_qualifications, 'callbackPhone', ['template' => "{label}\n{input}\n{hint}"])->hiddenInput(['id' => 'callbackPhone'])->label(false) ?>            

            <div class="row" style="background-color: #113060; color: #ffffff; height: 39px; margin-left: 0px; margin-right: 0px;">

                <div class="col-sm-12" style="text-align: center;"><h4>GREENPEACE UPGRADE</h4></div>
            </div>
            <?=
            $this->render('common_identity', [
                'form' => $form,
                'model' => $model,
            ])
            ?>              <?php
            $NixxisQualification = $NixxisQualifications[$model_qualifications->qualificationId];
//            if (isset($NixxisQualifications_P[$model_qualifications->qualificationId])) {
//                $NixxisQualification = $NixxisQualifications_P[$model_qualifications->qualificationId];
//            } elseif (isset($NixxisQualifications_I[$model_qualifications->qualificationId])) {
//                $NixxisQualification = $NixxisQualifications_I[$model_qualifications->qualificationId];
//            } else {
////                echo 'null';
//                $NixxisQualification = null;
//            }
            switch ($NixxisQualification['Id']) {
                case '81f38eb61c444a36ae6f90fe478291ca' : // RAPPEL
                    ?>
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>EFFECTUER UN RAPPEL</b></h5></div>
                    </div>  
                    <div class="row">
                        <div class="col-sm-6">
                            <?php
                            echo DatePicker::widget([
                                'language' => 'fr',
                                'model' => $model_qualifications,
                                'form' => $form,
                                'name' => 'callback_date',
                                'readonly' => true,
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'attribute' => 'callbackDate',
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-mm-yyyy',
                                    'todayHighlight' => true
                                ]
                            ]);
                            echo Html::error($model_qualifications, 'callback_date');

                            echo Html::error($model, 'callback_date');
                            ?>

                        </div>
                        <div class="col-sm-6">
                            <?=
                            $form->field($model_qualifications, 'callbackTime')->widget(TimePicker::classname(), [
                                'name' => 'callback_time',
                                'readonly' => true,
                                'pluginOptions' => [
                                    'showSeconds' => false,
                                    'showMeridian' => false,
                                ]
                            ])->label('Heure du rappel (entre 9h15 et 19h30)');
                            ?>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?= $form->field($model_qualifications, 'callbackPhone')->textInput()->label('Numéro de téléphone pour le rappel (facultatif)') ?>
                        </div>
                    </div>            
                    <?php
                    break;
                case 'f888544daee64f44af2fde31233740a0': // AUGMENTATION PA
                    ?>
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>AUGMENTATION PRELEVEMENT AUTOMATIQUE</b></h5></div>
                    </div> 

                    <div class="row" >
                        <div class="col-sm-12">
                            <?= $form->field($model, 'N_MONTANT')->textInput()->label('Nouveau montant') ?>
                            <?= $form->field($model, 'N_PERIODICITE')->dropDownList(ArrayHelper::map($model::GetFormulaireCycles(), 'id', 'name'), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Nouveau cycle') ?>
                            <?= $form->field($model, 'N_DATEPA')->textInput(['readonly' => true])->label('Date du prochain PA') ?>                    
                        </div>
                    </div>                         
                    <?php
                    break;
                case 'c63dec7200804b858a38dd6898adaad3': // DS
                    ?>
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>DON SIMPLE SANS MONTANT</b></h5></div>
                    </div> 



                    <?php
                    break;
                case '4d784672223947488055251ae149d5d1': // DSM
                    ?>
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>DON SIMPLE AVEC MONTANT</b></h5></div>
                    </div> 

                    <div class="row" >
                        <div class="col-sm-12">
                            <?= $form->field($model, 'N_MONTANT')->textInput()->label('Nouveau montant') ?>            
                        </div>
                    </div> 

                    <?php
                    break;
                case '469eba39d8984e308e6aec841cb3752a': // DSM EN LIGNE
                    ?>
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>DON SIMPLE AVEC MONTANT EN LIGNE</b></h5></div>
                    </div> 

                    <div class="row" >
                        <div class="col-sm-12">
                            <?= $form->field($model, 'N_MONTANT')->textInput()->label('Nouveau montant') ?>

                        </div>
                    </div> 

                <?php
            }
            ?>
            <div class="row" style = "margin-top: 5px;">
                <div class="col-sm-12">
                    <?php
                    echo '<p style="text-align:center">';

                    //echo Html::a($NixxisQualification_P['Description'], ['qualify', 'id' => $model->Internal__Id__, 'buttonid' => $NixxisQualification_P['Id']], ['class' => 'btn btn-success', 'style' => 'width:32%; font-size:10px; font-weight: bold;     padding: 6px 1px; ', 'data' => ['method' => 'post']]);
                    ?>
                    <?=
                    Html::submitButton($NixxisQualification['Description'], ['class' => 'btn btn-success', 'style' => 'width:32%; font-size:10px; font-weight: bold;     padding: 6px 1px; ',
                        'onclick' => 'SetQualification("' . $NixxisQualification['Id'] . '")',
                    ])
                    ?>
                    <?php
                    echo '</p>';
                    ?>
                </div>

            </div> 
            <div class="row" style=" margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                <div class="col-sm-12" style="margin-top: 5px; background-color: #113060;  height: 2px;"></div>
            </div> 


            <div class="row" style = "margin-top: 5px;">
                <div class="col-sm-12">

                    <?php
                    echo '<p style="text-align:center">';
                    //$NixxisQualification_P = $NixxisQualifications_P[$buttonid];
                    echo Html::a('Retour', ['index', 'id' => $model->Internal__id__, 'buttonid' => $NixxisQualification['Id']], ['class' => 'btn btn-danger', 'style' => 'width:32%; font-size:10px; font-weight: bold;     padding: 6px 1px; ']);
                    echo '</p>';
                    ?>
                </div>

            </div>  
            <?php ActiveForm::end(); ?> 
        </div>
    </div>








</div>
