<?php

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\components\QualificationsWidget;
use app\components\ErrorMessageWidget;

/* @var $this yii\web\View */
/* @var $model \app\scripts\UNADEV_FIDELISATION\v1\models\DATA76b3ff146f6c4802b727bb3042493043 */

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


            <?=QualificationsWidget::widget(['type' => QualificationsWidget::NEGATIVES, 'datas' => $NixxisQualifications, 'model' => $model])?>
            <div class="row" style=" margin-left: 0px; margin-right: 0px;">
                <?= $form->field($model, 'COMMENTAIRE_APPEL')->textarea(['rows' => 3, 'readonly' => $model->scenario == 'RO' ? true : false]) ?>
            </div>
            <?= QualificationsWidget::widget(['type' => QualificationsWidget::NEUTRES, 'datas' => $NixxisQualifications, 'model' => $model])  ?>
            <?=  QualificationsWidget::widget(['type' => QualificationsWidget::POSITIVES, 'datas' => $NixxisQualifications, 'model' => $model]) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>    
</div>
