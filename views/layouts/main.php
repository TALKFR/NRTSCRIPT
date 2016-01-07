<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>


        <link href="/nrtscriptdev/web/css/bootstrap.min.css" rel="stylesheet">
        <script src="/nrtscriptdev/web/js/NixxisDirectLink.js"></script>
        <script src="/nrtscriptdev/web/js/respond.min.js"></script>
        <script src="/nrtscriptdev/web/js/html5shiv.min.js"></script>
        <script type="text/javascript">
            var ie = (function () {

                var undef,
                        v = 3,
                        div = document.createElement('div'),
                        all = div.getElementsByTagName('i');

                while (
                        div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
                                        all[0]
                                        )
                                    ;

                                return v > 4 ? v : undef;

                            }());

                            // alert(ie);

        </script>

        <?php $this->head() ?>
    </head>
    <body >
        <?php $this->beginBody() ?>
        <div class="wrap">
            <div class="container" style="padding-top: 5px;">
                <?= $content ?>
            </div>
            <?php $this->endBody() ?>
        </div>
    </body>
</html>
<?php $this->endPage() ?>
