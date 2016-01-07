<?php

namespace app\models\Nixxis;

use Yii;

/**
 * This is the model class for table "qualifications".
 *
 * @property string $Id
 * @property integer $Active
 * @property string $Description
 * @property string $CustomValue
 * @property string $Parent
 * @property integer $Argued
 * @property integer $Positive
 * @property integer $PositiveUpdatable
 * @property integer $DisplayOrder
 * @property integer $Delay
 * @property string $GroupKey
 * @property string $CreatorId
 * @property string $CreationDate
 * @property string $LastModifiedBy
 * @property string $LastModification
 * @property string $ExternalData
 * @property integer $Action
 * @property string $ActionParameters
 * @property string $NewActivity
 * @property integer $SystemMapping
 * @property integer $Exportable
 * @property string $TimeStamp
 */
class Qualifications extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'admin.dbo.qualifications';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Id', 'Active', 'Argued', 'Positive'], 'required'],
            [['Id', 'Description', 'CustomValue', 'Parent', 'GroupKey', 'CreatorId', 'LastModifiedBy', 'ExternalData', 'ActionParameters', 'NewActivity'], 'string'],
            [['Active', 'Argued', 'Positive', 'PositiveUpdatable', 'DisplayOrder', 'Delay', 'Action', 'SystemMapping', 'Exportable'], 'integer'],
            [['CreationDate', 'LastModification', 'TimeStamp'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'Id' => 'ID',
            'Active' => 'Active',
            'Description' => 'Description',
            'CustomValue' => 'Custom Value',
            'Parent' => 'Parent',
            'Argued' => 'Argued',
            'Positive' => 'Positive',
            'PositiveUpdatable' => 'Positive Updatable',
            'DisplayOrder' => 'Display Order',
            'Delay' => 'Delay',
            'GroupKey' => 'Group Key',
            'CreatorId' => 'Creator ID',
            'CreationDate' => 'Creation Date',
            'LastModifiedBy' => 'Last Modified By',
            'LastModification' => 'Last Modification',
            'ExternalData' => 'External Data',
            'Action' => 'Action',
            'ActionParameters' => 'Action Parameters',
            'NewActivity' => 'New Activity',
            'SystemMapping' => 'System Mapping',
            'Exportable' => 'Exportable',
            'TimeStamp' => 'Time Stamp',
        ];
    }

}
