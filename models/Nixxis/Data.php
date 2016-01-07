<?php

namespace app\models\Nixxis;

use Yii;

class Data extends \yii\db\ActiveRecord {

    public static function primaryKey() {
        parent::primaryKey();
        return array('Internal__id__');
    }

//    public static function getDb() {
//        return Yii::$app->dbv2;
//    }

    public function GetSystemData() {
        $ClassSystemData = new SystemData();
        $ClassSystemData::$system_tablename = $this->tableName() . '.dbo.SystemData';
//        $ClassSystemData::$system_tablename = 'dbo.SystemData';
//
//        $connection = Yii::$app->db;
//        $command = $connection->createCommand('use Data_4307f92b371f4d918b0d30be75048ef4');
//        $command->execute(); // execute the non-query SQL

        return $ClassSystemData::find()->where("Internal__id__ = '" . $this->Internal__id__ . "'")->one();
    }

}
