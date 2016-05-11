<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Apikeys */

$this->title = Yii::t('app', 'Create Script Allocation');
?>
<div class="allocation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
