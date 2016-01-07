<?php

use yii\widgets\ActiveForm;
use app\components\QualificationsWidget;
use app\components\ErrorMessageWidget;

/* @var $this yii\web\View */
/* @var $model \app\models\Campaigns\DATA0331e68e23ca4e308b49869bffbe5c79 */
$this->title = 'Nixxis Reporting & Tools';
?>
<script type="text/javascript" >
    function SetQualification(qualid) {
//        var callbackdatetime = callbackdatetime || null;
//        var callbacktime = callbacktime || null;
//        var callbacknumber = callbacknumber || null;
        $('#qualificationId').val(qualid);
//        $('#callbackdatetime').val(callbackdatetime);
//        $('#callbacknumber').val(callbacknumber);


    }

</script>  
<div class="site-index">
    <?php
    $form = ActiveForm::begin(['id' => 'qualify-form', 'enableClientValidation' => true,
                'action' => [$Script['ControllerDirectory'] . '_v' . $Script['Version'] . '/script/qualify', 'Internal__Id__' => $model->Internal__Id__]]);
    ?>
    <?php
//    echo 'DialerCampaign   : ' . $NixxisParameters->diallerCampaign . '<br>';
//    echo 'Contactid        : ' . $NixxisParameters->contactid . '<br>';
//    echo 'DiallerReference : ' . $NixxisParameters->diallerReference . '<br>';
//    echo 'autosearch       : ' . $NixxisParameters->autosearch . '<br>';
//    echo 'sessionid        : ' . $NixxisParameters->sessionid . '<br>';
    ?>
    <?= $form->field($model, 'Internal__Id__')->hiddenInput(['id' => 'Internal__Id__'])->label(false) ?>
    <?= $form->field($model_qualifications, 'qualificationId')->hiddenInput(['id' => 'qualificationId'])->label(false) ?>

    <div class="row">
        <div class="col-sm-2" >
            <div class="row" style="text-align: center;">
                <span style="color: red;"><b><?= ($NixxisParameters->autosearch == '') ? 'APPEL SORTANT' : 'APPEL ENTRANT' ?></b> </span>
            </div>
            <div class="row" style="background-color: #113060; color: #ffffff; font-size: 10px;">
                <span style="text-decoration: underline;"><b>Numéro membre :</b> </span>
                <br><?= $model->numero_membre ?>
                <br>
                <span style="text-decoration: underline;"><b>Code média :</b> </span>
                <br><?= $model->code_media ?>    
                <br>
                <span style="text-decoration: underline;"><b>Montant dernier PA :</b> </span>
                <br><?= $model->mnt_der_pa ?>     
                <br>
                <span style="text-decoration: underline;"><b>Cycle actuel :</b> </span>
                <br><?= $model->cycle_pa ?>    
                <br>
                <span style="text-decoration: underline;"><b>Mois dernier PA :</b> </span>
                <br><?= $model->mois_der_pa ?>   
                <br>
                <span style="text-decoration: underline;"><b>Jour dernier PA :</b> </span>
                <br><?= $model->jour_der_pa ?>                  
            </div>




        </div>

        <div class="col-sm-10">
            <div class="row" style="background-color: #113060; color: #ffffff; height: 39px; margin-left: 0px; margin-right: 0px;">

                <div class="col-sm-12" style="text-align: center;"><h4>GREENPEACE UPGRADE</h4></div>
            </div>
            <?=
            $this->render('GP_Upgrade_v' . $Script['Version'] . '/index', [
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
                <?= $form->field($model, 'commentaire_appel')->textarea(['rows' => 3, 'readonly' => $model->scenario == 'RO' ? true : false]) ?>
            </div>
            <?= $model->scenario != 'RO' ? QualificationsWidget::widget(['type' => QualificationsWidget::NEUTRES, 'datas' => $NixxisQualifications, 'model' => $model]) : '' ?>

            <div class="row" style=" margin-left: 0px; margin-right: 0px;">
                <?= $form->field($model, 'commentaire_donateur')->textarea(['rows' => 3, 'readonly' => $model->scenario == 'RO' ? true : false]) ?>
            </div>
            <?= $model->scenario != 'RO' ? QualificationsWidget::widget(['type' => QualificationsWidget::POSITIVES, 'datas' => $NixxisQualifications, 'model' => $model]) : '' ?>

        </div>
    </div>



    <?php ActiveForm::end(); ?>    

</div>
