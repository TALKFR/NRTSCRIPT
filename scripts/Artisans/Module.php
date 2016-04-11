<?php

namespace app\scripts\Artisans;

use Yii;
use yii\base\BootstrapInterface;

class Module extends \yii\base\Module {

    public static function getUrlRule() {
        return ['/Artisans/<idversion:\d+>' => '/Scripts/Artisans'];
    }

    public static function getName() {
        return 'LEADS BTOB';
    }

    public function init() {
        $version = 1;
        $this->controllerNamespace = __NAMESPACE__ . '\v' . $version . '\controllers';
        $this->setViewPath($this->getBasePath() . '/v' . $version . '/views');
        parent::init();
    }

}
