<?php

use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'NRT Script';
?>


<div class="site-index">

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'NixxisActivityId',
            'Script',
            'version',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
