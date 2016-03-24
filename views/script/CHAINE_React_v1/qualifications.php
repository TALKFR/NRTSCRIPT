<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use app\components\iRaiserPayment;

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

                <div class="col-sm-12" style="text-align: center;"><h4>CHAINE DE L'ESPOIR REACTIVATION</h4></div>
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


                    echo DatePicker::widget([
                        'language' => 'fr',
                        'model' => $model,
                        'form' => $form,
                        'name' => 'N_DATEPA',
                        'readonly' => true,
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'attribute' => 'N_DATEPA',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd/mm/yyyy',
                            'todayHighlight' => true
                        ],
                    ]);
                    echo Html::error($model_qualifications, 'callback_date');

                    echo Html::error($model, 'callback_date');

                    echo '</div> 
                    </div>';
                    break;
                case 'PAMENLIGNE':
                    echo'
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>CREATION D\'UN PRELEVEMENT AUTOMATIQUE PAR CB</b></h5></div>
                    </div>
                    <div class = "row" >
                    <div class = "col-sm-12">';
                    $iRaiserPayment = new iRaiserPayment();
                    $iRaiserPayment->setBase_url('https://donner.chainedelespoir.org');
                    $iRaiserPayment->setCid('18');
                    $iRaiserPayment->setFrequency('regular');
                    //echo $iRaiserPayment->GetUrl($model);
                    //echo '<a href="' . $iRaiserPayment->GetUrl($model) . '" target="_blank">Cliquez ici pour effectuer le paiement en ligne</a>';
                    echo '                  
  <script type="text/javascript">
  function openURL()
  {
      var shell = new ActiveXObject("WScript.Shell");
      shell.run("' . $iRaiserPayment->GetUrl($model) . '");
          
  }
  </script>';
                    echo ' <div class="row" style="text-align:center;">';
                    echo ' <input type="button" onclick="openURL()" value="Cliquez ici pour effectuer le prélévement en ligne">';
                    echo '</div>';
                    echo $form->field($model, 'N_MONTANT')->textInput()->label('Montant du Prélévement');
                    echo $form->field($model, 'N_PERIODICITE')->dropDownList(ArrayHelper::map($model::GetFormulaireCycles(), 'id', 'name'), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Nouveau cycle');
                    echo DatePicker::widget([
                        'language' => 'fr',
                        'model' => $model,
                        'form' => $form,
                        'name' => 'N_DATEPA',
                        'readonly' => true,
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'attribute' => 'N_DATEPA',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd/mm/yyyy',
                            'todayHighlight' => true
                        ],
                    ]);
                    echo Html::error($model_qualifications, 'callback_date');

                    echo Html::error($model, 'callback_date');

                    echo '</div> 
                    </div>';
                    break;

                case 'PAMSLIMPAY':
                    echo'
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>CREATION D\'UN PRELEVEMENT AUTOMATIQUE SLIMPAY</b></h5></div>
                    </div>
                    <div class = "row" >
                    <div class = "col-sm-12">';
                    $iRaiserPayment = new iRaiserPayment();
                    $iRaiserPayment->setBase_url('https://donner.chainedelespoir.org');
                    $iRaiserPayment->setCid('18');
                    $iRaiserPayment->setFrequency('regular');
                    //echo $iRaiserPayment->GetUrl($model);
                    //echo '<a href="' . $iRaiserPayment->GetUrl($model) . '" target="_blank">Cliquez ici pour effectuer le paiement en ligne</a>';
                    echo '                  
  <script type="text/javascript">
  function openURL()
  {
      var shell = new ActiveXObject("WScript.Shell");
      shell.run("' . $iRaiserPayment->GetUrl($model) . '");
          
  }
  </script>';
                    echo ' <div class="row" style="text-align:center;">';
                    echo ' <input type="button" onclick="openURL()" value="Cliquez ici pour effectuer le prélévement en ligne">';
                    echo '</div>';
                    echo $form->field($model, 'N_MONTANT')->textInput()->label('Montant du Prélévement');
                    echo $form->field($model, 'N_PERIODICITE')->dropDownList(ArrayHelper::map($model::GetFormulaireCycles(), 'id', 'name'), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Nouveau cycle');
                    echo DatePicker::widget([
                        'language' => 'fr',
                        'model' => $model,
                        'form' => $form,
                        'name' => 'N_DATEPA',
                        'readonly' => true,
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'attribute' => 'N_DATEPA',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd/mm/yyyy',
                            'todayHighlight' => true
                        ],
                    ]);
                    echo Html::error($model_qualifications, 'callback_date');

                    echo Html::error($model, 'callback_date');

                    echo '</div> 
                    </div>';
                    break;

                case 'DSM':
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
                case 'DSMENLIGNE':
                    echo'
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>DON SIMPLE AVEC MONTANT</b></h5></div>
                    </div>
                    <div class = "row" >
                    <div class = "col-sm-12">';

                    $iRaiserPayment = new iRaiserPayment();
                    $iRaiserPayment->setBase_url('https://donner.chainedelespoir.org');
                    $iRaiserPayment->setCid('18');
                    $iRaiserPayment->setFrequency('once');
                    //echo $iRaiserPayment->GetUrl($model);
                    //echo '<a href="' . $iRaiserPayment->GetUrl($model) . '" target="_blank">Cliquez ici pour effectuer le paiement en ligne</a>';
                    echo '                  
  <script type="text/javascript">
  function openURL()
  {
      var shell = new ActiveXObject("WScript.Shell");
      shell.run("' . $iRaiserPayment->GetUrl($model) . '");
          
  }
  </script>';
                    echo ' <div class="row" style="text-align:center;">';
                    echo ' <input type="button" onclick="openURL()" value="Cliquez ici pour effectuer le don en ligne">';
                    echo '</div>';
//                    echo Html::a('Link', [$iRaiserPayment->GetUrl($model)], ['target' => '_blank']);
                    // echo '<iframe src="' . $iRaiserPayment->GetUrl($model) . '" style="width:100%; height:500px"></iframe>';
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
            //echo 'model:' . $model_qualifications->scenario;
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
    $('#data76b3ff146f6c4802b727bb3042493043-n_datepa_day').change(function() {
        $.ajax({
            url: 'index.php?r=UNA_Fid_v1/script/get-prochainpa&day=' + this.value,
            dataType: "json",
            success: function (data) {
                if (data.error) {
                    alert(data.error);
                } else if (data.month) {
                    $("#data76b3ff146f6c4802b727bb3042493043-n_datepa_month").val(data.month);
                    $("#data76b3ff146f6c4802b727bb3042493043-n_datepa_year").val(data.year);
                } else {
                    alert("Response in invalid format!");
                }
            }              
        });
    });

          

JS;
$this->registerJs($myAjaxJs);
?>