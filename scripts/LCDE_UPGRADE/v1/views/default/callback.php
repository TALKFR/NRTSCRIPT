<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use app\components\FormWidgets\ButtonWidget;
use app\components\FormWidgets\LineWidget;

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
            ?>   
 
            <?php
            $NixxisQualification = $NixxisQualifications[$model_qualifications->qualificationId];
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
                    <?= ButtonWidget::widget(['label' => 'Retour', 'action' => 'index', 'parameters' => ['id' => $model->Internal__id__, 'buttonid' => $NixxisQualification['Id']]]) ?>
                </div>

            </div>  
            <?php ActiveForm::end(); ?> 
        </div>
    </div>
</div>
