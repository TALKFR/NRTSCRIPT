<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
use app\components\FormWidgets\ButtonWidget;

/* @var $model \app\scripts\LCDE_UPGRADE\v1\models\DATA29270ed61ca441e484431aaae9cd7e4b */
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
                'action' => ['qualify', 'Internal__id__' => $model->Internal__id__]]);
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
            <?= $form->field($model_qualifications, 'qualificationId')->hiddenInput()->label(false) ?>
            <?= $form->field($model_qualifications, 'callbackDateTime')->hiddenInput(['id' => 'callbackDateTime'])->label(false) ?>
            <?= $form->field($model_qualifications, 'callbackPhone', ['template' => "{label}\n{input}\n{hint}"])->hiddenInput(['id' => 'callbackPhone'])->label(false) ?>            

            <div class="row" style="background-color: #113060; color: #ffffff; height: 39px; margin-left: 0px; margin-right: 0px;">
                <div class="col-sm-12" style="text-align: center;"><h4><?= $Module->getName() ?></h4></div>
            </div>
            <?=
            $this->render('common_identity', [
                'form' => $form,
                'model' => $model,
            ])
            ?>              <?php
            $NixxisQualification = $NixxisQualifications[$model_qualifications->qualificationId];

            switch ($model->scenario) {
                case 'AUGPAM':
                    echo'
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>AUGMENTATION D\'UN PRELEVEMENT AUTOMATIQUE</b></h5></div>
                    </div>
                    <div class = "row" >
                    <div class = "col-sm-12">';
                    echo $form->field($model, 'N_MONTANT')->textInput()->label('Montant du Prélévement');

                    echo $form->field($model, 'N_PERIODICITE')->dropDownList(ArrayHelper::map($model::GetFormulaireCycles(), 'id', 'name'), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Nouveau cycle');
                    echo $form->field($model, 'N_DATEPA')
                            ->label('Date du prochain PA')
                            ->widget('kartik\date\DatePicker', [
                                'language' => 'fr',
                                'readonly' => true,
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd/mm/yyyy',
                                    'todayHighlight' => true
                                ],
                    ]);

                    echo '</div> 
                    </div>';
                    break;
                case 'AUGPAMEMAIL':
                    echo'
                    <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                        <div class="col-sm-12" style="text-align: center;"><h5><b>AUGMENTATION D\'UN PRELEVEMENT AUTOMATIQUE</b></h5></div>
                    </div>
                    <div class = "row" >
                    <div class = "col-sm-12">';

                    if (count($model_qualifications->availableemails)) {
                        echo $form->field($model_qualifications, 'email')->dropDownList(ArrayHelper::map($model_qualifications->getAvailableEmails(), 'id', 'name'), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Adresse Email à utiliser');
                    }

                    echo $form->field($model, 'N_MONTANT')->textInput()->label('Montant du Prélévement');
                    echo $form->field($model, 'N_PERIODICITE')->dropDownList(ArrayHelper::map($model::GetFormulaireCycles(), 'id', 'name'), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Nouveau cycle');
                    echo $form->field($model, 'N_DATEPA')
                            ->label('Date du prochain PA')
                            ->widget('kartik\date\DatePicker', [
                                'language' => 'fr',
                                'readonly' => true,
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd/mm/yyyy',
                                    'todayHighlight' => true
                                ],
                    ]);

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

                    //echo $model::GetMonthProchainPA();
                    echo '</div>';
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
                            <?= TextBoxWidget::widget(['label' => 'Numéro de téléphone pour le rappel (facultatif)', 'model' => $$model_qualifications, 'field' => 'callbackPhone', 'form' => $form]) ?>
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
            <?= LineWidget::widget() ?>

            <div class="row" style = "margin-top: 5px;">
                <div class="col-sm-12">
                    <p style="text-align:center;margin-top: 5px;">
                        <?= ButtonWidget::widget(['label' => 'Retour', 'action' => 'default/index', 'parameters' => ['Internal__id__' => $model->Internal__id__]]) ?>
                    </p>
                </div>

            </div>  
            <?php ActiveForm::end(); ?> 
        </div>
    </div>
</div>
