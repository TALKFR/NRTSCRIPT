<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'NRT Script';
?>


<div class="site-index">
    <p>
        <?= Html::a(Yii::t('app', 'Add Script Allocation'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'CampaignName',
            'ActivityName',
            'ScriptName',
            'version',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
