<?php

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\components\QualificationsWidget2;
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
                'action' => ['step2', 'Internal__id__' => $model->Internal__id__]]);
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
                <div class="col-sm-12" style="text-align: center;"><h4><?= $Module->getName() ?></h4></div>
            </div>
            <?=
            $this->render('common_identity', [
                'form' => $form,
                'model' => $model,
            ])
            ?>     
            <?=
            $this->render('common_extra', [
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

            <?php
            echo QualificationsWidget2::widget(['type' => QualificationsWidget2::NEGATIVES, 'datas' => $NixxisQualifications, 'model' => $model]);
            ?>
            <div class="row" style=" margin-left: 0px; margin-right: 0px;">
                <?= $form->field($model, 'COMMENTAIRE_APPEL')->textarea(['rows' => 3, 'readonly' => $model->scenario == 'RO' ? true : false]) ?>
            </div>
            <?= $model->scenario != 'RO' ? QualificationsWidget2::widget(['type' => QualificationsWidget2::NEUTRES, 'datas' => $NixxisQualifications, 'model' => $model]) : '' ?>

            <?php
            $html = $form->field($model, '_ACTIVITE1')->dropDownList(ArrayHelper::map($model::GetFormulaireActivitités(), 'id', 'name'), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Choix de l\'activité');
            ?>

            <?= $model->scenario != 'RO' ? QualificationsWidget2::widget(['type' => QualificationsWidget2::POSITIVES, 'datas' => $NixxisQualifications, 'model' => $model, 'htmltoinsert' => $html]) : '' ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>    
</div>
