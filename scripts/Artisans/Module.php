<?php

namespace app\scripts\Artisans;

use Yii;
use yii\base\BootstrapInterface;

class Module extends \app\scripts\Script {

    public static function getRoute() {
        return '/Scripts/Artisans';
    }

    public static function getName() {
        return 'LEADS BTOB';
    }

}
