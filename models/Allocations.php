<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "allocations".
 *
 * @property integer $id
 * @property string $NixxisActivityId
 * @property string $Script
 * @property integer $version
 * @property string $comments
 */
class Allocations extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'allocations';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('dbscripts');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['version'], 'integer'],
            [['comments'], 'string'],
            [['NixxisActivityId'], 'string', 'max' => 32],
            [['Script'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'NixxisActivityId' => 'Nixxis Activity ID',
            'Script' => 'Script',
            'version' => 'Version',
            'comments' => 'Comments',
        ];
    }

    public function
}
