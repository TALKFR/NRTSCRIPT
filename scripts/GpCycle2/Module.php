<?php

namespace app\scripts\GpCycle2;

use Yii;
use yii\base\BootstrapInterface;

class Module extends \yii\base\Module {

    public static function getUrlRule() {
        return ['/Travaux/<idversion:\d+>' => '/Scripts/Travaux'];
    }

    public static function getName() {
        return 'GREENPEACE CYCLE 2';
    }

    public function init() {
        $version = 1;
        $this->controllerNamespace = __NAMESPACE__ . '\v' . $version . '\controllers';
        $this->setViewPath($this->getBasePath() . '/v' . $version . '/views');
        parent::init();
    }

}
