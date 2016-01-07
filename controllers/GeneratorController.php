<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

//http://10.100.30.110/nrtscriptdev/web/index.php?r=generator/index&id=

class GeneratorController extends Controller {

    public $module;

    public function actionIndex($id) {


        try {
            $sql = "CREATE VIEW DATA_" . $id . " as select * from Data_" . $id . "..Data";
            $connection = Yii::$app->db;
            $command = $connection->createCommand($sql);
            $command->execute(); // execute the non-query SQL
        } catch (yii\db\Exception $ex) {
            echo $ex->getMessage();
            echo 'View already exists<br>';
        }

        $Generator = new \yii\gii\generators\model\Generator;
        $Generator->templates['Nrt'] = '/var/www/nrtscriptdev/Templates';
        $Generator->db = 'dbv2';
        $Generator->ns = 'app\models\Campaigns';
        $Generator->tableName = 'DATA_' . $id;
        $Generator->modelClass = str_replace('_', '', $Generator->tableName);
        $Generator->template = 'Nrt';
        $this->module = new \yii\gii\Module('1');

        $files = $Generator->generate();
        $tmp = null;
        foreach ($files as &$file) {

            $tmp[$file->id] = 1;
            $file->operation = 'overwrite';
        }
        if ($tmp !== null) {
            $Errors = $Generator->save($files, $tmp, $result);
        } else {
            die('no files generated');
        }
        echo $result;
    }

}
