<?php

namespace app\models\Nixxis;

use Yii;

/**
 * This is the model class for table "Campaigns".
 *
 * @property string $Id
 * @property integer $Active
 * @property string $NumberFormat
 * @property integer $QualificationLinked
 * @property string $Description
 * @property string $DatabaseName
 * @property string $UserTable
 * @property string $SystemTable
 * @property string $GroupKey
 * @property string $FieldsConfig
 * @property string $CustomConfig
 * @property string $ExternalData
 * @property string $ScriptDefinition
 * @property string $Qualification
 * @property string $CreatorId
 * @property string $CreationDate
 * @property string $LastModifiedBy
 * @property string $LastModification
 * @property string $AppointmentsContext
 * @property integer $AutomaticRecording
 * @property string $ImportExportPlugin
 * @property integer $Advanced
 * @property string $ExportFields
 * @property string $TimeStamp
 */
class Campaigns extends \app\models\Nixxis\Data {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Campaigns';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Id', 'Active'], 'required'],
            [['Id', 'NumberFormat', 'Description', 'DatabaseName', 'UserTable', 'SystemTable', 'GroupKey', 'FieldsConfig', 'CustomConfig', 'ExternalData', 'ScriptDefinition', 'Qualification', 'CreatorId', 'LastModifiedBy', 'AppointmentsContext', 'ImportExportPlugin', 'ExportFields'], 'string'],
            [['Active', 'QualificationLinked', 'AutomaticRecording', 'Advanced'], 'integer'],
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
            'NumberFormat' => 'Number Format',
            'QualificationLinked' => 'Qualification Linked',
            'Description' => 'Description',
            'DatabaseName' => 'Database Name',
            'UserTable' => 'User Table',
            'SystemTable' => 'System Table',
            'GroupKey' => 'Group Key',
            'FieldsConfig' => 'Fields Config',
            'CustomConfig' => 'Custom Config',
            'ExternalData' => 'External Data',
            'ScriptDefinition' => 'Script Definition',
            'Qualification' => 'Qualification',
            'CreatorId' => 'Creator ID',
            'CreationDate' => 'Creation Date',
            'LastModifiedBy' => 'Last Modified By',
            'LastModification' => 'Last Modification',
            'AppointmentsContext' => 'Appointments Context',
            'AutomaticRecording' => 'Automatic Recording',
            'ImportExportPlugin' => 'Import Export Plugin',
            'Advanced' => 'Advanced',
            'ExportFields' => 'Export Fields',
            'TimeStamp' => 'Time Stamp',
        ];
    }

}
