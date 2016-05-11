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
    <?= $form->field($model, 'name')->textInput()->label('Script Name (Will be the folder name)')
    ?>
    <?= $form->field($model, 'description')->textInput()->label('Script Description (Will appears at the top of the script screen)')
    ?>
    <?=
    $form->field($model, 'NixxisCampaignId')->dropDownList(
            ArrayHelper::map(\app\models\Nixxis\Campaigns::find()->where(['Active' => 1])->all(), 'Id', 'Description'), [
        'prompt' => 'Select Campaign',
    ])->label('Select Nixxis Campaign');
    ?>
    <p></p>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create Script'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
