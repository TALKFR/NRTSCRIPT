
<?php

use yii\helpers\ArrayHelper;
use app\components\FormWidgets\LabelWidget;
?>
<div class="row" style="text-align: center;">
    <span style="color: red;"><b><?= ($NixxisParameters->ActivityType == $NixxisParameters::ACT_OUTBOUND) ? 'APPEL SORTANT' : 'APPEL ENTRANT' ?></b> </span>
</div>
<div class="row" style="background-color: #113060; color: #ffffff; font-size: 14px;">
    <?= LabelWidget::widget(['label' => 'Identifiant :', 'model' => $model, 'field' => 'IDENTIFIANT1']) ?>    
    <?= LabelWidget::widget(['label' => 'Code Média  :', 'model' => $model, 'field' => 'CODE_MEDIA']) ?>  
    <?= LabelWidget::widget(['label' => 'Date du permis  :', 'model' => $model, 'field' => '_DATE_AUTO']) ?>  
</div>

