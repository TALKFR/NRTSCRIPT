
<?php
/* @var $model \app\scripts\UNADEV_FACTEURS\v1\models\DATA0e083f4fab3144b6813f7dd82a56bcf1 */

use yii\helpers\ArrayHelper;
use app\components\FormWidgets\LabelWidget;
?>
<div class="row" style="text-align: center;">
    <span style="color: red;"><b><?= ($NixxisParameters->ActivityType == $NixxisParameters::ACT_OUTBOUND) ? 'APPEL SORTANT' : 'APPEL ENTRANT' ?></b> </span>
</div>
<div class="row" style="background-color: #113060; color: #ffffff; font-size: 14px;">
    <?= LabelWidget::widget(['label' => 'Identifiant :', 'model' => $model, 'field' => 'IDENTIFIANT1']) ?>    
    <?= LabelWidget::widget(['label' => 'Code Média  :', 'model' => $model, 'field' => 'CODE_MEDIA']) ?>  
    <?= LabelWidget::widget(['label' => 'Montant dernier DON :', 'model' => $model, 'field' => 'A_MONTANT']) ?>  
    <?= LabelWidget::widget(['label' => 'Date Marché :', 'model' => $model, 'field' => '_DATE_MARCHE']) ?>  
</div>

