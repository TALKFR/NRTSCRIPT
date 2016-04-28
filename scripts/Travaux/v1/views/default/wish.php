<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\components\QualificationsWidget2;
use app\components\ErrorMessageWidget;
use app\components\FormWidgets\ButtonWidget;
use app\components\FormWidgets\LineWidget;
?>

<div class="row" style="background-color: #113060; color: #ffffff; height: 39px; margin-left: 0px; margin-right: 0px;">
    <div class="col-sm-12" style="text-align: center;"><h4><?= $Module->getName() ?></h4></div>
</div>
<?php
$form = ActiveForm::begin(['id' => 'wish', 'enableClientValidation' => false,
            'action' => ['add', 'Internal__id__' => $model->Internal__id__, 'act_id' => $jsonobject['act_id']]]);


echo $this->render('common_identity', [
    'form' => $form,
    'model' => $model,
    'NixxisParameters' => $NixxisParameters,
]);
?>
<div class="row" style=" margin-left: 0px; margin-right: 0px; margin-top: 5px;">
    <div class="col-sm-12" style="margin-top: 5px; background-color: #113060;  height: 2px;"></div>
</div> 

<div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
    <div class="col-sm-12" style="text-align: center;"><h5><b><?= $jsonobject['act_libelle'] ?></b></h5></div>
</div>
<?php
if (isset($Errors) && is_array($Errors)) {
    echo '<ul>';
    foreach ($Errors as $Error) {
        echo '<li style = "color: red;">' . $Error . '</li>';
    }
    echo '</ul>';

    //print_r($Errors);
}
?>


<div class="row" style=" margin-left: 0px; margin-right: 0px; margin-top: 5px;">
    <div class="col-sm-12" style="margin-top: 5px; background-color: #113060;  height: 2px;"></div>
</div> 
<?php
echo $genform;
echo '<p style="text-align:center">';
echo Html::submitButton('Ajouter le besoin', ['class' => 'btn_info', 'style' => 'width:32%; font-size:10px; font-weight: bold;     padding: 10px 1px; margin :5px; ']);
echo '</p>';

echo ButtonWidget::widget(['label' => 'Retour', 'action' => 'wish-list/index', 'parameters' => ['Internal__id__' => $model->Internal__id__]]);





ActiveForm::end();
