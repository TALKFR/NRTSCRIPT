<?php

namespace app\scripts;

class Scripts extends \yii\base\Module {

    public $controllerNamespace = 'app\scripts';

    public function init() {
        parent::init();
        $directories = glob($this->getBasePath() . '/*', GLOB_ONLYDIR);
        foreach ($directories as $directory) {
            $value[basename($directory)] = ['class' => "app\scripts\\" . basename($directory) . "\Module"];
        }



        $this->modules = $value;
    }

    public static function GetScriptsList() {
        $array = array();
        $reflector = new \ReflectionClass(static::class);
        $directories = glob(dirname($reflector->getFileName()) . '/*', GLOB_ONLYDIR);

        foreach ($directories as $directory) {
            if (file_exists($directory . '/Module.php')) {
                $classname = $reflector->getNamespaceName() . "\\" . basename($directory) . "\Module";
                $array[] = [ 'Name' => $classname::getName(), 'Id' => $classname];
            }
        }
        return $array;
    }

    public static function GetVersionsList($script) {
        $Versions = array();
        if ($script) {
            $Versions = $script::GetVersionsList();
        }
        return $Versions;
    }

}
