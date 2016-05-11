<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Apikeys */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apikeys-form">

    <?php $form = ActiveForm::begin(); ?>

    <p>



        <?=
        $form->field($model, 'NixxisCampaignId')->dropDownList(
                ArrayHelper::map(\app\models\Nixxis\Campaigns::find()->where(['Active' => 1])->all(), 'Id', 'Description'), [
            'prompt' => 'Select Campaign',
            'onchange' => '
                                        $.post( "index.php?r=ui/allocations/list-activities&id=' . '"+$(this).val(), function( data ) {
                                            $( "select#allocations-nixxisactivityid" ).html( data );
                                        });'
        ])->label('Select Nixxis Campaign');
        ?>
    </p>
    <p>
        <?= $form->field($model, 'NixxisActivityId')->dropDownList(ArrayHelper::map(\app\models\Nixxis\Activities::find()->where(['Active' => 1])->all(), 'Id', 'Description'), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label('Select Nixxis Activity Name'); ?>

    </p>
    <p>
        <?=
        $form->field($model, 'Script')->dropDownList(
                ArrayHelper::map(app\scripts\Scripts::GetScriptsList(), 'Id', 'Name'), [
            'prompt' => '--Select--',
            'class' => 'form-control inline-block updateindicator',
            'onchange' => '
                                        $.post( "index.php?r=ui/allocations/list-versions&id=' . '"+$(this).val(), function( data ) {
                                            $( "select#allocations-version" ).html( data );
                                        });'
        ])->label('Script Name');
        ?>
    </p>
    <p>
        <?=
        $form->field($model, 'version')->dropDownList(
                ArrayHelper::map(app\scripts\Scripts::GetVersionsList($model->Script), 'Id', 'Name'), [
            'prompt' => '--Select--',
            'class' => 'form-control inline-block updateindicator',
        ])->label('Script Version');
        ?>
    </p>        
    <?php
//    $.post("index.php?r=allocations/list&id=' . '" + $(this).val(), function(data){
//            $("select#models-contact").html(data);
//    });
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create Allocation') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
