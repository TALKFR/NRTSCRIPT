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
    $form = ActiveForm::begin(['id' => 'qualify-form',
                'action' => [$Script['ControllerDirectory'] . '_v' . $Script['Version'] . '/script/qualify', 'Internal__id__' => $model->Internal__id__]]);
    ?>
    <?php
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
//            echo $model->scenario;
//            $form = ActiveForm::begin(['id' => 'qualify-form', 'action' => ['site/update', 'Internal__Id__' => $model->Internal__Id__]]);
            ?>

            <?= $form->field($model_qualifications, 'qualificationId')->hiddenInput()->label(false) ?>
            <?= $form->field($model_qualifications, 'callbackDateTime')->hiddenInput(['id' => 'callbackDateTime'])->label(false) ?>
            <?= $form->field($model_qualifications, 'callbackPhone', ['template' => "{label}\n{input}\n{hint}"])->hiddenInput(['id' => 'callbackPhone'])->label(false) ?>            

            <div class="row" style="background-color: #113060; color: #ffffff; height: 39px; margin-left: 0px; margin-right: 0px;">

                <div class="col-sm-12" style="text-align: center;"><h4>UNADEV FACTEURS</h4></div>
            </div>
            <?=
            $this->render('common_identity', [
                'form' => $form,
                'model' => $model,
            ])
            ?>              <?php
            $NixxisQualification = $NixxisQualifications[$model_qualifications->qualificationId];

            switch ($model->scenario) {
                case 'PAM':
                    echo'
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>CREATION D\'UN PRELEVEMENT AUTOMATIQUE</b></h5></div>
                    </div>
                    <div class = "row" >
                    <div class = "col-sm-12">';
                    echo $form->field($model, 'N_MONTANT')->textInput()->label('Montant du Prélévement');

                    echo $form->field($model, 'N_PERIODICITE')->dropDownList(ArrayHelper::map($model::GetFormulaireCycles(), 'id', 'name'), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Nouveau cycle');
                    //echo $form->field($model, 'N_DATEPA')->textInput()->label('Date du prochain Prélévement');
                    echo '<label class="control-label" for=rown_datepa">Date du prochain prélévement</label>';
                    echo '<div id="rown_datepa" class = "row" >';
                    echo '<div class = "col-sm-3" > ' . $form->field($model, 'N_DATEPA_MONTH')->dropDownList($model::getMonths(), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Mois') . '</div>';
                    echo '<div class = "col-sm-3" > ' . $form->field($model, 'N_DATEPA_YEAR')->dropDownList($model::getYears(), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Année') . '</div>';
                    //echo $model::GetMonthProchainPA();
                    echo '</div>';
                    echo '</div> 
                    </div>';
                    break;
                case 'PAM SLIMPAY':
                    echo'
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>CREATION D\'UN PRELEVEMENT AUTOMATIQUE</b></h5></div>
                    </div>
                    <div class = "row" >
                    <div class = "col-sm-12">';
                    echo $form->field($model, 'N_MONTANT')->textInput()->label('Montant du Prélévement');

                    echo $form->field($model, 'N_PERIODICITE')->dropDownList(ArrayHelper::map($model::GetFormulaireCycles(), 'id', 'name'), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Nouveau cycle');
                    //echo $form->field($model, 'N_DATEPA')->textInput()->label('Date du prochain Prélévement');
                    echo '<label class="control-label" for=rown_datepa">Date du prochain prélévement</label>';
                    echo '<div id="rown_datepa" class = "row" >';
                    echo '<div class = "col-sm-3" > ' . $form->field($model, 'N_DATEPA_DAY')->dropDownList(['05' => '05', '15' => '15', '25' => '25'], ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Jour') . '</div>';
                    echo '<div class = "col-sm-3" > ' . $form->field($model, 'N_DATEPA_MONTH')->dropDownList($model::getMonths(), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Mois') . '</div>';
                    echo '<div class = "col-sm-3" > ' . $form->field($model, 'N_DATEPA_YEAR')->dropDownList($model::getYears(), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Année') . '</div>';
                    //echo $model::GetMonthProchainPA();
                    echo '</div>';
                    echo '</div> 
                    </div>';
                    break;
                case 'PA':
                    echo'
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>CREATION D\'UN PRELEVEMENT AUTOMATIQUE</b></h5></div>
                    </div>
                    <div class = "row" >
                    <div class = "col-sm-12">';
                    echo '<label class="control-label" for=rown_datepa">Date du prochain prélévement</label>';
                    echo '<div id="rown_datepa" class = "row" >';
                    echo '<div class = "col-sm-3" > ' . $form->field($model, 'N_DATEPA_MONTH')->dropDownList($model::getMonths(), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Mois') . '</div>';
                    echo '<div class = "col-sm-3" > ' . $form->field($model, 'N_DATEPA_YEAR')->dropDownList($model::getYears(), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Année') . '</div>';
                    //echo $model::GetMonthProchainPA();
                    echo '</div>';
                    echo '</div> 
                    </div>';
                    break;
                case 'ENVOYE':
                    echo'
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>VA ENVOYER / DEJA ENVOYE</b></h5></div>
                    </div>
                    <div class = "row" >
                    <div class = "col-sm-12">';
                    echo '<div id="rown_datepa" class = "row" >';
                    echo '<div class = "col-sm-6" > ' . $form->field($model, '_PROMESSEENVOYEE')->dropDownList(ArrayHelper::map($model::GetFormulairePromesseEnvoyee(), 'id', 'name'), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Promesse') . '</div>';
                    //echo $model::GetMonthProchainPA();
                    echo '</div>';
                    echo '</div> 
                    </div>';
                    break;
                case 'DSM/DSM EN LIGNE':
                    echo'
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>DON SIMPLE AVEC MONTANT</b></h5></div>
                    </div>
                    <div class = "row" >
                    <div class = "col-sm-12">';
                    echo $form->field($model, 'N_MONTANT')->textInput()->label('Montant du don');
                    echo '</div> 
                    </div>';
                    break;

                default :
                    echo'
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>' . $NixxisQualification['Description'] . '</b></h5></div>
                    </div>
                    <div class = "row" >
                    <div class = "col-sm-12">';
                    echo '</div> 
                    </div>';
                    break;
            }

            switch ($model_qualifications->scenario) {
                case 'CALLBACK' : // RAPPEL
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
            }
            ?>
            <div class="row" style = "margin-top: 5px;">
                <div class="col-sm-12">
                    <?php
                    echo '<p style="text-align:center">';
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
                    echo Html::a('Retour', ['index', 'id' => $model->Internal__id__, 'buttonid' => $NixxisQualification['Id']], ['class' => 'btn btn-danger', 'style' => 'width:32%; font-size:10px; font-weight: bold;     padding: 6px 1px; ']);
                    echo '</p>';
                    ?>
                </div>

            </div>  
            <?php ActiveForm::end(); ?> 
        </div>
    </div>
</div>
<?php
$myAjaxJs = <<<JS
    $('#data0e083f4fab3144b6813f7dd82a56bcf1-n_datepa_day').change(function() {
        $.ajax({
            url: 'index.php?r=UNA_Fact_v1/script/get-prochainpa&day=' + this.value,
            dataType: "json",
            success: function (data) {
                if (data.error) {
                    alert(data.error);
                } else if (data.month) {
                    $("#data0e083f4fab3144b6813f7dd82a56bcf1-n_datepa_month").val(data.month);
                    $("#data0e083f4fab3144b6813f7dd82a56bcf1-n_datepa_year").val(data.year);
                } else {
                    alert("Response in invalid format!");
                }
            }              
        });
    });

          

JS;
$this->registerJs($myAjaxJs);
?>