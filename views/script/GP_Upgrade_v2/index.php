<?php

use yii\widgets\ActiveForm;
use app\components\QualificationsWidget;
use app\components\ErrorMessageWidget;

/* @var $this yii\web\View */
/* @var $model \app\models\Campaigns\DATA4307f92b371f4d918b0d30be75048ef4 */
$this->title = 'Nixxis Reporting & Tools';
?>
<script type="text/javascript" >
    function SetQualification(qualid) {
        $('#qualificationId').val(qualid);
    }
</script>  
<div class="site-index">
    <?php
    $form = ActiveForm::begin(['id' => 'qualify-form', 'enableClientValidation' => true,
                'action' => [$Script['ControllerDirectory'] . '_v' . $Script['Version'] . '/script/qualify', 'Internal__id__' => $model->Internal__id__]]);
    ?>
    <?php
//    echo 'DialerCampaign   : ' . $NixxisParameters->diallerCampaign . '<br>';
//    echo 'Contactid        : ' . $NixxisParameters->contactid . '<br>';
//    echo 'DiallerReference : ' . $NixxisParameters->diallerReference . '<br>';
//    echo 'autosearch       : ' . $NixxisParameters->autosearch . '<br>';
//    echo 'sessionid        : ' . $NixxisParameters->sessionid . '<br>';
    ?>
    <?= $form->field($model, 'Internal__id__')->hiddenInput(['id' => 'Internal__id__'])->label(false) ?>
    <?= $form->field($model_qualifications, 'qualificationId')->hiddenInput(['id' => 'qualificationId'])->label(false) ?>

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
            <div class="row" style="background-color: #113060; color: #ffffff; height: 39px; margin-left: 0px; margin-right: 0px;">

                <div class="col-sm-12" style="text-align: center;"><h4>GREENPEACE UPGRADE</h4></div>
            </div>
            <?=
            $this->render('common_identity', [
                'form' => $form,
                'model' => $model,
            ])
            ?>            
            <?=
            $model->scenario == 'RO' ?
                    ErrorMessageWidget::widget(['title' => "MESSAGE D'ERREUR",
                        'message' => "La fiche a déjà été qualifiée le " . $model->GetSystemData()->GetLastHandlingTimeFormatted() . ' par ' .
                        $model->GetSystemData()->GetLastHandlerName() . '<br> avec la qualification : ' . $model->GetSystemData()->GetLastQualificationName()]) : ''
            ?>
            <?=
            $model->scenario != 'RO' ?
                    QualificationsWidget::widget(['type' => QualificationsWidget::NEGATIVES, 'datas' => $NixxisQualifications, 'model' => $model]) :
                    QualificationsWidget::widget(['type' => QualificationsWidget::NEGATIVES, 'qualificationid' => $Script['IncomingQualificationError'], 'datas' => $NixxisQualifications, 'model' => $model])
            ?>
            <div class="row" style=" margin-left: 0px; margin-right: 0px;">
                <?= $form->field($model, 'COMMENTAIRE_APPEL')->textarea(['rows' => 3, 'readonly' => $model->scenario == 'RO' ? true : false]) ?>
            </div>
            <?= $model->scenario != 'RO' ? QualificationsWidget::widget(['type' => QualificationsWidget::NEUTRES, 'datas' => $NixxisQualifications, 'model' => $model]) : '' ?>

            <div class="row" style=" margin-left: 0px; margin-right: 0px;">
                <?= $form->field($model, 'COMMENTAIRE_DONATEUR')->textarea(['rows' => 3, 'readonly' => $model->scenario == 'RO' ? true : false]) ?>
            </div>
            <?= $model->scenario != 'RO' ? QualificationsWidget::widget(['type' => QualificationsWidget::POSITIVES, 'datas' => $NixxisQualifications, 'model' => $model]) : '' ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>    
</div>
