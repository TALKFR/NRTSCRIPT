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
            <?=
            $this->render('common_info', [
                'form' => $form,
                'model' => $model,
                'NixxisParameters' => $NixxisParameters,
            ])
            ?>   
        </div>

        <div class="col-sm-10">
            <?php
//            $form = ActiveForm::begin(['id' => 'qualify-form', 'action' => ['site/update', 'Internal__Id__' => $model->Internal__Id__]]);
            ?>

            <?= $form->field($model_qualifications, 'qualificationId')->hiddenInput()->label(false) ?>
            <?= $form->field($model_qualifications, 'callbackDateTime')->hiddenInput(['id' => 'callbackDateTime'])->label(false) ?>
            <?= $form->field($model_qualifications, 'callbackPhone', ['template' => "{label}\n{input}\n{hint}"])->hiddenInput(['id' => 'callbackPhone'])->label(false) ?>            

            <div class="row" style="background-color: #113060; color: #ffffff; height: 39px; margin-left: 0px; margin-right: 0px;">

                <div class="col-sm-12" style="text-align: center;"><h4>UNADEV FIDELISATION</h4></div>
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
                case '11e09f316e4c49a3ae406a65a0b80cdf' : // RAPPEL
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
                                ],
                            ]);
                            echo Html::error($model_qualifications, 'callback_date');

                            echo Html::error($model, 'callback_date');
                            ?>

                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo $form->field($model_qualifications, 'callbackTime')->widget(TimePicker::classname(), [
                                'readonly' => true,
                                'pluginOptions' => [
                                    'showSeconds' => false,
                                    'showMeridian' => false,
                                ]
                            ])->label('Heure du rappel (entre 9h15 et 19h45)');
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
                case '63085e8fb23a4c5aaf2e409c0696c4a3': // PAM
                    ?>
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>CREATION D'UN PRELEVEMENT AUTOMATIQUE</b></h5></div>
                    </div> 

                    <div class="row" >
                        <div class="col-sm-12">
                            <?= $form->field($model, 'N_MONTANT')->textInput()->label('Montant du Prélévement') ?>
                            <?= $form->field($model, 'N_PERIODICITE')->dropDownList(ArrayHelper::map($model::GetFormulaireCycles(), 'id', 'name'), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Nouveau cycle') ?>
                            <?= $form->field($model, 'N_DATEPA')->textInput()->label('Date du prochain Prélévement') ?>                    
                        </div>
                    </div>                         
                    <?php
                    break;
                case '3d3f3024cde74f9fa1c5ee7fbf7c18f5': // PAM SLIMPAY
                    ?>
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>CREATION D'UN PRELEVEMENT AUTOMATIQUE</b></h5></div>
                    </div> 

                    <div class="row" >
                        <div class="col-sm-12">
                            <?= $form->field($model, 'N_MONTANT')->textInput()->label('Montant du Prélévement') ?>
                            <?= $form->field($model, 'N_PERIODICITE')->dropDownList(ArrayHelper::map($model::GetFormulaireCycles(), 'id', 'name'), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Nouveau cycle') ?>
                            <?= $form->field($model, 'N_DATEPA')->textInput()->label('Date du prochain Prélévement') ?>                    
                        </div>
                    </div>                         
                    <?php
                    break;
                case '52118127c7b6409da7d3adda64573fb5': // PA
                    ?>
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>CREATION D'UN PRELEVEMENT AUTOMATIQUE</b></h5></div>
                    </div> 

                    <div class="row" >
                        <div class="col-sm-12">
                            <?= $form->field($model, 'N_DATEPA')->textInput()->label('Date du prochain Prélévement') ?>                    
                        </div>
                    </div>                         
                    <?php
                    break;
                case '9ba6ba9b2b9a498a97829d051119af44': // DS
                    ?>
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>DON SIMPLE SANS MONTANT</b></h5></div>
                    </div> 



                    <?php
                    break;
                case 'ff36d463b2d34ecb947c058cdc46be02': // DSM
                    ?>
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>DON SIMPLE AVEC MONTANT</b></h5></div>
                    </div> 

                    <div class="row" >
                        <div class="col-sm-12">
                            <?= $form->field($model, 'N_MONTANT')->textInput()->label('Montant du don') ?>            
                        </div>
                    </div> 

                    <?php
                    break;
                case 'b71c97f6792d4da1bb5e98f6fae3f37d': // DSM EN LIGNE
                    ?>
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>DON SIMPLE AVEC MONTANT EN LIGNE</b></h5></div>
                    </div> 

                    <div class="row" >
                        <div class="col-sm-12">
                            <?= $form->field($model, 'N_MONTANT')->textInput()->label('Montant du don') ?>

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
