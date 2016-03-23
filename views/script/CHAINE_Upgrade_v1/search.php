<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Ss7Search */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="search-index">

    <div class="col-sm-12">
        <div class="row" style="background-color: #113060; color: #ffffff; height: 39px; margin-left: 0px; margin-right: 0px;">

            <div class="col-sm-12" style="text-align: center;"><h4><?= $Titre ?></h4></div>
        </div>
        <div class="row" style="background-color: #113060; color: #ffffff; height: 39px; margin-left: 0px; margin-right: 0px;">

            <div class="col-sm-12" style="text-align: center; color: red;"><h6><b><?= $Message ?></b></h6></div>
        </div>            
        <div class="row" style="background-color: #113060; color: #ffffff; height: 39px; margin-left: 0px; margin-right: 0px;">

            <div class="col-sm-12" style="text-align: center;"><h6><?= $NixxisParameters->validatedPhoneNumber ?></h6></div>
        </div>        
    </div>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'CODE_MEDIA:ntext',
            'NOM',
            'PRENOM:ntext',
            'TEL1',
            'TEL2',
            'CP',
            'VILLE',
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 70px;'],
                'template' => '{select}',
                'buttons' => [
                    'select' => function ($url) {
                        return Html::a(
                                        '<span class="glyphicon glyphicon-arrow-download">VOIR</span>', $url, [
                                    'title' => 'Select'
                                        ]
                        );
                    },
                        ],
                    ],
                ],
            ]);
            ?>

</div>
