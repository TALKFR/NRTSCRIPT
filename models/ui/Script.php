<?php

namespace app\models\ui;

use Yii;
use yii\base\Model;

class Script extends Model {

    public $name;
    public $description;
    public $NixxisCampaignId;

    public function rules() {
        return [

            [['name', 'description', 'NixxisCampaignId'], 'required'],
//            [['name'], 'FolderExists'],
        ];
    }

    public function FolderExists($attribute, $params) {
        $directories = glob('../' . Yii::$app->params['ScriptPath'] . '/*', GLOB_ONLYDIR);
        foreach ($directories as $directory) {
            if (strtolower(basename($directory)) == strtolower($this->$attribute)) {
                $this->addError($attribute, 'Name already exists !');
            }
        }
    }

    public function CreateView() {
        if ($this->IsViewExist()) {
            $this->DropView('Data_' . $this->NixxisCampaignId);
        }
        try {
            $sql = "CREATE VIEW DATA_" . $this->NixxisCampaignId . " as select * from Data_" . $this->NixxisCampaignId . "..Data";
            $connection = Yii::$app->db;
            $command = $connection->createCommand($sql);
            $command->execute(); // execute the non-query SQL
        } catch (yii\db\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function CreateFolders() {
        $basepath = '../' . Yii::$app->params['ScriptPath'];
        try {
            $this->CreateFolder($basepath, $this->name);
            $basepath .= '/' . $this->name;
            $this->CreateFolder($basepath, 'v1');
            $basepath .= '/' . 'v1';
            $this->CreateFolder($basepath, 'controllers');
            $this->CreateFolder($basepath, 'models');
            $this->CreateFolder($basepath, 'views');
            $basepath .= '/' . 'views';
            $this->CreateFolder($basepath, 'default');
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function CreateModuleFile($templatefile = 'Module.nrt') {
        $reflector = new \ReflectionClass(static::class);
        $basepath = dirname($reflector->getFileName()) . '/templates/Modules';
        $template = file_get_contents($basepath . '/' . $templatefile);

        $file = preg_replace("/\<\?\?\=( Name )\?\?\>/", $this->name, $template);
        $file = preg_replace("/\<\?\?\=( Description )\?\?\>/", $this->description, $file);

        $basepath = '../' . Yii::$app->params['ScriptPath'];
        $basepath .= '/' . $this->name;
        file_put_contents($basepath . '/Module.php', $file);
    }

    public function CreateControllerFile($templatefile = 'DefaultController.nrt') {
        $reflector = new \ReflectionClass(static::class);
        $basepath = dirname($reflector->getFileName()) . '/templates/Controllers';
        $template = file_get_contents($basepath . '/' . $templatefile);

        $file = preg_replace("/\<\?\?\=( Name )\?\?\>/", $this->name, $template);
        $file = preg_replace("/\<\?\?\=( Version )\?\?\>/", 'v1', $file);
        $file = preg_replace("/\<\?\?\=( CampaignId )\?\?\>/", $this->NixxisCampaignId, $file);

        $basepath = '../' . Yii::$app->params['ScriptPath'];
        $basepath .= '/' . $this->name;
        $basepath .= '/' . 'v1';
        $basepath .= '/' . 'controllers';
        file_put_contents($basepath . '/DefaultController.php', $file);
    }

    public function CreateCustomModelFile($templatefile = 'Custommodel.nrt') {
        $reflector = new \ReflectionClass(static::class);
        $basepath = dirname($reflector->getFileName()) . '/templates/Models';
        $template = file_get_contents($basepath . '/' . $templatefile);

        $file = preg_replace("/\<\?\?\=( Name )\?\?\>/", $this->name, $template);
        $file = preg_replace("/\<\?\?\=( Version )\?\?\>/", 'v1', $file);

        $basepath = '../' . Yii::$app->params['ScriptPath'];
        $basepath .= '/' . $this->name;
        $basepath .= '/' . 'v1';
        $basepath .= '/' . 'models';
        file_put_contents($basepath . '/custommodel.php', $file);
    }

    public function CreateModelFile($version = 1) {
        $Generator = new \yii\gii\generators\model\Generator;
        $Generator->templates['Nrt'] = '/var/www/nrtscriptdev/Templates';
        $Generator->db = 'dbv2';
        $Generator->ns = 'app\\scripts\\' . $this->name . '\\v' . $version . '\\models';
        $Generator->tableName = 'DATA_' . ucfirst($this->NixxisCampaignId);
        $Generator->modelClass = str_replace('_', '', $Generator->tableName);
        $Generator->template = 'Nrt';

        $files = $Generator->generate();

        if (count($files)) {
            $basepath = '../' . Yii::$app->params['ScriptPath'];
            $basepath .= '/' . $this->name;
            $basepath .= '/' . 'v1';
            $basepath .= '/' . 'models';
            file_put_contents($basepath . '/DATA' . ucfirst($this->NixxisCampaignId) . '.php', $files[0]->content);
            return true;
        }
        return false;
    }

    public function CreateViewFiles() {
        $reflector = new \ReflectionClass(static::class);
        $basepath = dirname($reflector->getFileName()) . '/templates/Views';
        $template = file_get_contents($basepath . '/' . 'callback.nrt');
        $file = preg_replace("/\<\?\?\=( Name )\?\?\>/", $this->name, $template);
        $file = preg_replace("/\<\?\?\=( Version )\?\?\>/", 'v1', $file);
        $file = preg_replace("/\<\?\?\=( CampaignId )\?\?\>/", $this->NixxisCampaignId, $file);
        $basepath = '../' . Yii::$app->params['ScriptPath'];
        $basepath .= '/' . $this->name;
        $basepath .= '/' . 'v1';
        $basepath .= '/' . 'views/default';
        try {
            file_put_contents($basepath . '/callback.php', $file);
        } catch (\Exception $ex) {
            echo 'View file (callback.php) ... Failed!' . '<br>';
            echo '  ->' . $ex->getMessage() . '<br>';
        }

        $basepath = dirname($reflector->getFileName()) . '/templates/Views';
        $template = file_get_contents($basepath . '/' . 'common_identity.nrt');
        $file = preg_replace("/\<\?\?\=( Name )\?\?\>/", $this->name, $template);
        $file = preg_replace("/\<\?\?\=( Version )\?\?\>/", 'v1', $file);
        $file = preg_replace("/\<\?\?\=( CampaignId )\?\?\>/", $this->NixxisCampaignId, $file);
        $basepath = '../' . Yii::$app->params['ScriptPath'];
        $basepath .= '/' . $this->name;
        $basepath .= '/' . 'v1';
        $basepath .= '/' . 'views/default';
        try {
            file_put_contents($basepath . '/common_identity.php', $file);
        } catch (\Exception $ex) {
            echo 'View file (common_identity.php) ... Failed!' . '<br>';
            echo '  ->' . $ex->getMessage() . '<br>';
        }
        $basepath = dirname($reflector->getFileName()) . '/templates/Views';
        $template = file_get_contents($basepath . '/' . 'common_info.nrt');
        $file = preg_replace("/\<\?\?\=( Name )\?\?\>/", $this->name, $template);
        $file = preg_replace("/\<\?\?\=( Version )\?\?\>/", 'v1', $file);
        $file = preg_replace("/\<\?\?\=( CampaignId )\?\?\>/", $this->NixxisCampaignId, $file);
        $basepath = '../' . Yii::$app->params['ScriptPath'];
        $basepath .= '/' . $this->name;
        $basepath .= '/' . 'v1';
        $basepath .= '/' . 'views/default';
        try {
            file_put_contents($basepath . '/common_info.php', $file);
        } catch (\Exception $ex) {
            echo 'View file (common_info.php) ... Failed!' . '<br>';
            echo '  ->' . $ex->getMessage() . '<br>';
        }

        $basepath = dirname($reflector->getFileName()) . '/templates/Views';
        $template = file_get_contents($basepath . '/' . 'common_extra.nrt');
        $file = preg_replace("/\<\?\?\=( Name )\?\?\>/", $this->name, $template);
        $file = preg_replace("/\<\?\?\=( Version )\?\?\>/", 'v1', $file);
        $file = preg_replace("/\<\?\?\=( CampaignId )\?\?\>/", $this->NixxisCampaignId, $file);
        $basepath = '../' . Yii::$app->params['ScriptPath'];
        $basepath .= '/' . $this->name;
        $basepath .= '/' . 'v1';
        $basepath .= '/' . 'views/default';
        try {
            file_put_contents($basepath . '/common_extra.php', $file);
        } catch (\Exception $ex) {
            echo 'View file (common_extra.php) ... Failed!' . '<br>';
            echo '  ->' . $ex->getMessage() . '<br>';
            ;
        }
        $basepath = dirname($reflector->getFileName()) . '/templates/Views';
        $template = file_get_contents($basepath . '/' . 'index.nrt');
        $file = preg_replace("/\<\?\?\=( Name )\?\?\>/", $this->name, $template);
        $file = preg_replace("/\<\?\?\=( Version )\?\?\>/", 'v1', $file);
        $file = preg_replace("/\<\?\?\=( CampaignId )\?\?\>/", $this->NixxisCampaignId, $file);
        $basepath = '../' . Yii::$app->params['ScriptPath'];
        $basepath .= '/' . $this->name;
        $basepath .= '/' . 'v1';
        $basepath .= '/' . 'views/default';
        try {
            file_put_contents($basepath . '/index.php', $file);
        } catch (\Exception $ex) {
            echo 'View file (index.php) ... Failed!' . '<br>';
            echo '  ->' . $ex->getMessage() . '<br>';
            ;
        }
        $basepath = dirname($reflector->getFileName()) . '/templates/Views';
        $template = file_get_contents($basepath . '/' . 'last.nrt');
        $file = preg_replace("/\<\?\?\=( Name )\?\?\>/", $this->name, $template);
        $file = preg_replace("/\<\?\?\=( Version )\?\?\>/", 'v1', $file);
        $file = preg_replace("/\<\?\?\=( CampaignId )\?\?\>/", $this->NixxisCampaignId, $file);
        $basepath = '../' . Yii::$app->params['ScriptPath'];
        $basepath .= '/' . $this->name;
        $basepath .= '/' . 'v1';
        $basepath .= '/' . 'views/default';
        try {
            file_put_contents($basepath . '/last.php', $file);
        } catch (\Exception $ex) {
            echo 'View file (last.php) ... Failed!' . '<br>';
            echo '  ->' . $ex->getMessage() . '<br>';
            ;
        }
        $basepath = dirname($reflector->getFileName()) . '/templates/Views';
        $template = file_get_contents($basepath . '/' . 'qualifications.nrt');
        $file = preg_replace("/\<\?\?\=( Name )\?\?\>/", $this->name, $template);
        $file = preg_replace("/\<\?\?\=( Version )\?\?\>/", 'v1', $file);
        $file = preg_replace("/\<\?\?\=( CampaignId )\?\?\>/", $this->NixxisCampaignId, $file);
        $basepath = '../' . Yii::$app->params['ScriptPath'];
        $basepath .= '/' . $this->name;
        $basepath .= '/' . 'v1';
        $basepath .= '/' . 'views/default';
        try {
            file_put_contents($basepath . '/qualifications.php', $file);
        } catch (\Exception $ex) {
            echo 'View file (qualifications.php) ... Failed!' . '<br>';
            echo '  ->' . $ex->getMessage() . '<br>';
            ;
        }
    }

    private function CreateFolder($basepath, $foldername) {
        try {
            mkdir($basepath . '/' . $foldername);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    private function IsViewExist() {

        try {
            $sql = "SELECT * FROM Nrt.INFORMATION_SCHEMA.VIEWS WHERE TABLE_NAME='DATA_" . $this->NixxisCampaignId . "'";
            $connection = Yii::$app->db;
            $command = $connection->createCommand($sql);
            $result = $command->queryAll();
            if ($result) {
                return true;
            }
            return false;
        } catch (yii\db\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    private function DropView($view) {
        try {
            $sql = "DROP VIEW " . $view;
            $connection = Yii::$app->db;
            $command = $connection->createCommand($sql);
            $command->execute();

            return false;
        } catch (yii\db\Exception $ex) {
            echo $ex->getMessage();
        }
    }

}
