<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Apikeys */
?>
<div class="allocations-view">



    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CampaignName',
            'ActivityName',
            'ScriptName',
            'version',
        ],
    ])
    ?>
    <p>
        <?= Html::a(Yii::t('app', 'Run'), ['run', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>



</div>
