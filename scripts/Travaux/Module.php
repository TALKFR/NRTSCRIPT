<?php

namespace app\scripts\Travaux;

use Yii;
use yii\base\BootstrapInterface;

class Module extends \yii\base\Module {

    public $version;

    public static function getUrlRule() {
        return ['/Travaux/<idversion:\d+>' => '/Scripts/Travaux'];
    }

    public static function getName() {
        return 'LEADS TRAVAUX';
    }

    public function init() {
        $this->version = 1;
        $this->controllerNamespace = __NAMESPACE__ . '\v' . $this->version . '\controllers';
        $this->setViewPath($this->getBasePath() . '/v' . $this->version . '/views');
        parent::init();
    }

}
