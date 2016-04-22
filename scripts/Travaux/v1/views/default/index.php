<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\components\QualificationsWidget2;
use app\components\FormWidgets\QualificationsGroupWidget;
use app\components\FormWidgets\TitleWidget;
use app\components\FormWidgets\CheckBoxWidget;

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

            <?= TitleWidget::widget(['label' => $Module->getName()]) ?>
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

            <label for="blockbesoins">Besoins du contact</label>
            <div id ="blockchien" class="row">
                <div class="col-sm-12">
                    <?php
                    echo '<ul>';
                    foreach ($Leads as $Lead) {
                        echo '<li style = "color: back;">' . $Lead->GetActivityName() . '(' . $Lead->act_id . ')' . '</li>';
                    }
                    echo '</ul>';
                    ?>


                    <?php
//                    echo GridView::widget([
//                        'dataProvider' => $Leads,
//                        'summary' => "",
//                        'columns' => [
//                            [
//                                'attribute' => 'Identifiant',
//                                'value' => 'act_id',
//                            ],
//                            [
//                                'attribute' => 'Description',
//                                'value' => 'ActivityName',
//                            ],
//                        ],
//                    ]);
                    ?>      
                </div>


            </div>             






            <?= QualificationsGroupWidget::widget(['type' => QualificationsGroupWidget::NEGATIVES, 'datas' => $NixxisQualifications, 'model' => $model]) ?>

            <div class="row" style=" margin-left: 0px; margin-right: 0px;">
                <?= $form->field($model, 'COMMENTAIRE_APPEL')->textarea(['rows' => 3, 'readonly' => $model->scenario == 'RO' ? true : false]) ?>
            </div>

            <?= QualificationsGroupWidget::widget(['type' => QualificationsWidget2::NEUTRES, 'datas' => $NixxisQualifications, 'model' => $model]) ?>
            <?= QualificationsGroupWidget::widget(['type' => QualificationsWidget2::POSITIVES, 'datas' => $NixxisQualifications, 'model' => $model,]) ?>


        </div>


    </div>

    <div class="row">
        <div class="col-sm-2" >

        </div>
        <div class="col-sm-10">
            <?php
//            ActiveForm::begin(['id' => 'addneed', 'enableClientValidation' => false,
//                'action' => ['step3', 'Internal__id__' => $model->Internal__id__]]);

            echo '<p style="text-align:center; padding: 5px;">';
            echo Html::submitButton('Ajouter un besoin', ['class' => 'btn_sucess', 'style' => 'width:32%; font-size:10px; font-weight: bold;     padding: 6px 1px; ', 'onclick' => 'SetQualification("' . '1234' . '")']);
            echo '</p>';
//            ActiveForm::end();
            ?>            
        </div>
    </div>   
    <?php
    ActiveForm::end();
    ?>           



</div>
