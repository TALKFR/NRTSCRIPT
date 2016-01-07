<?php

namespace app\models\Nixxis;

use Yii;

/**
 * This is the model class for table "agents".
 *
 * @property string $Id
 * @property integer $Active
 * @property string $Description
 * @property string $CallerIdentification
 * @property string $Account
 * @property string $PassKey
 * @property string $FirstName
 * @property string $LastName
 * @property string $GroupKey
 * @property integer $AutoReady
 * @property integer $WrapupExtendable
 * @property integer $WrapupTime
 * @property string $ExternalData
 * @property integer $AdministrationLevel
 * @property integer $SupervisionLevel
 * @property integer $RecordingPlaybackLevel
 * @property integer $CustomerVisibilityLevel
 * @property string $CreatorId
 * @property string $CreationDate
 * @property string $LastModifiedBy
 * @property string $LastModification
 * @property string $TimeStamp
 */
class Agents extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'admin.dbo.agents';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Id', 'Active'], 'required'],
            [['Id', 'Description', 'CallerIdentification', 'Account', 'PassKey', 'FirstName', 'LastName', 'GroupKey', 'ExternalData', 'CreatorId', 'LastModifiedBy'], 'string'],
            [['Active', 'AutoReady', 'WrapupExtendable', 'WrapupTime', 'AdministrationLevel', 'SupervisionLevel', 'RecordingPlaybackLevel', 'CustomerVisibilityLevel'], 'integer'],
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
            'CallerIdentification' => 'Caller Identification',
            'Account' => 'Account',
            'PassKey' => 'Pass Key',
            'FirstName' => 'First Name',
            'LastName' => 'Last Name',
            'GroupKey' => 'Group Key',
            'AutoReady' => 'Auto Ready',
            'WrapupExtendable' => 'Wrapup Extendable',
            'WrapupTime' => 'Wrapup Time',
            'ExternalData' => 'External Data',
            'AdministrationLevel' => 'Administration Level',
            'SupervisionLevel' => 'Supervision Level',
            'RecordingPlaybackLevel' => 'Recording Playback Level',
            'CustomerVisibilityLevel' => 'Customer Visibility Level',
            'CreatorId' => 'Creator ID',
            'CreationDate' => 'Creation Date',
            'LastModifiedBy' => 'Last Modified By',
            'LastModification' => 'Last Modification',
            'TimeStamp' => 'Time Stamp',
        ];
    }

}
