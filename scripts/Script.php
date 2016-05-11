<?php

namespace app\scripts;

use Yii;

abstract class Script extends \yii\base\Module implements ScriptInterface {

    public $version;

    public static function GetVersionsList() {
        $array = array();
        $reflector = new \ReflectionClass(static::class);
        $directories = glob(dirname($reflector->getFileName()) . '/*', GLOB_ONLYDIR);
        foreach ($directories as $directory) {

            $array[] = [ 'Name' => basename($directory), 'Id' => self::ExtractVersion(basename($directory))];
        }
        return $array;
    }

    private function ExtractVersion($string) {
        $output_array = array();
        if (preg_match("/[\d]+/", $string, $output_array)) {
            return $output_array[0];
        } else {
            return null;
        }
    }

    public function init() {
        parent::init();
        $reflector = new \ReflectionClass(get_called_class());
        try {
            $this->version = Yii::$app->session->get('Allocation')->version;
            $this->controllerNamespace = $reflector->getNamespaceName() . '\v' . $this->version . '\controllers';
            $this->setViewPath($this->getBasePath() . '/v' . $this->version . '/views');
        } catch (\Exception $ex) {
            die('Session timeout...');
        }
    }

}
