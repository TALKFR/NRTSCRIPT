<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\components\QualificationsWidget2;
use app\components\ErrorMessageWidget;
use app\components\FormWidgets\ButtonWidget;
use app\components\FormWidgets\LineWidget;
?>

<script type="text/javascript" >
    function SetActivityId(act_id) {

        $("input[name='act_id']").val(act_id);

    }
</script>  
<?php
$form = ActiveForm::begin(['id' => 'addneed', 'enableClientValidation' => false,
            'action' => ['step4', 'Internal__id__' => $model->Internal__id__]]);

echo Html::hiddenInput('act_id', 'toto');
//echo $this->render('common_identity', [
//    'form' => $form,
//    'model' => $model,
//    'NixxisParameters' => $NixxisParameters,
//]);
?>
<div class="row" style=" margin-left: 0px; margin-right: 0px; margin-top: 5px;">
    <div class="col-sm-12" style="margin-top: 5px; background-color: #113060;  height: 2px;"></div>
</div> 


<div class="row">
    <div class="col-sm-2" style="margin-top: 5px;" >
        <p style="text-align:center;margin-top: 5px;">
            <?= Html::textInput('search') ?>
        </p>
        <p style="text-align:center;margin-top: 5px;">
            <?= Html::submitButton('Recherche', [ 'name' => 'recherche', 'class' => 'btn_info', 'style' => 'margin-top:10px;']) ?>
        </p>
        <?= LineWidget::widget() ?>
        <p style="text-align:center;margin-top: 5px;">
            <?= ButtonWidget::widget(['label' => 'Retour', 'action' => 'index', 'parameters' => ['Internal__id__' => $model->Internal__id__]]) ?>

        </p>
    </div>
    <div class="col-sm-10">
        <?php
        foreach ($ListActivities as $Activity) {
            echo Html::submitButton($Activity['libelle'], [ 'class' => 'btn_info', 'style' => 'width:32%; font-size:10px; font-weight: bold;     padding: 10px 1px; margin :5px; ', 'onclick' => 'SetActivityId(' . $Activity['id'] . ')']);
        }
        ?>            
    </div>
</div>


<?php
ActiveForm::end();
