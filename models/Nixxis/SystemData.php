<?php

namespace app\models\Nixxis;

use Yii;
use app\models\Nixxis\Qualifications;
use app\models\Nixxis\Agents;

/**
 * This is the model class for table "SYSTEMDATA".
 *
 * @property string $Internal__Id__
 * @property string $CurrentActivity
 * @property string $PreviousActivity
 * @property string $LastHandlerActivity
 * @property string $LastContactId
 * @property string $LastActivityChange
 * @property string $LastHandler
 * @property string $LastHandlingTime
 * @property integer $LastHandlingDuration
 * @property integer $TotalHandlingDuration
 * @property integer $TotalHandlers
 * @property integer $State
 * @property integer $PreviousState
 * @property integer $SortInfo
 * @property integer $CustomSortInfo
 * @property integer $Priority
 * @property integer $DialingModeOverride
 * @property string $DialStartDate
 * @property string $DialEndDate
 * @property string $CreationTime
 * @property integer $ImportSequence
 * @property string $ImportTag
 * @property integer $ExportSequence
 * @property integer $RecycleCount
 * @property string $LastRecycle
 * @property string $ExportTime
 * @property string $TargetHandler
 * @property string $TargetDestination
 * @property integer $TargetMedia
 * @property integer $DialedCurrentActivity
 * @property integer $TotalDialed
 * @property integer $MaxDialAttempts
 * @property integer $ExpectedProfit
 * @property integer $LastDialStatus
 * @property integer $LastDialStatusCount
 * @property string $LastDialedDestination
 * @property string $LastQualification
 * @property integer $LastQualificationArgued
 * @property integer $LastQualificationPositive
 * @property integer $LastQualificationExportable
 * @property string $AreaId
 * @property string $AppointmentId
 * @property integer $Excluded
 * @property integer $VMFlagged
 */
class SystemData extends \yii\db\ActiveRecord {

    public static $system_tablename;

    public static function primaryKey() {
        parent::primaryKey();
        return array('Internal__Id__');
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return self::$system_tablename;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Internal__Id__'], 'required'],
            [['Internal__Id__', 'CurrentActivity', 'PreviousActivity', 'LastHandlerActivity', 'LastContactId', 'LastHandler', 'ImportTag', 'TargetHandler', 'TargetDestination', 'LastDialedDestination', 'LastQualification', 'AreaId', 'AppointmentId'], 'string'],
            [['LastActivityChange', 'LastHandlingTime', 'DialStartDate', 'DialEndDate', 'CreationTime', 'LastRecycle', 'ExportTime'], 'safe'],
            [['LastHandlingDuration', 'TotalHandlingDuration', 'TotalHandlers', 'State', 'PreviousState', 'SortInfo', 'CustomSortInfo', 'Priority', 'DialingModeOverride', 'ImportSequence', 'ExportSequence', 'RecycleCount', 'TargetMedia', 'DialedCurrentActivity', 'TotalDialed', 'MaxDialAttempts', 'ExpectedProfit', 'LastDialStatus', 'LastDialStatusCount', 'LastQualificationArgued', 'LastQualificationPositive', 'LastQualificationExportable', 'Excluded', 'VMFlagged'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'Internal__Id__' => 'Internal   ID',
            'CurrentActivity' => 'Current Activity',
            'PreviousActivity' => 'Previous Activity',
            'LastHandlerActivity' => 'Last Handler Activity',
            'LastContactId' => 'Last Contact ID',
            'LastActivityChange' => 'Last Activity Change',
            'LastHandler' => 'Last Handler',
            'LastHandlingTime' => 'Last Handling Time',
            'LastHandlingDuration' => 'Last Handling Duration',
            'TotalHandlingDuration' => 'Total Handling Duration',
            'TotalHandlers' => 'Total Handlers',
            'State' => 'State',
            'PreviousState' => 'Previous State',
            'SortInfo' => 'Sort Info',
            'CustomSortInfo' => 'Custom Sort Info',
            'Priority' => 'Priority',
            'DialingModeOverride' => 'Dialing Mode Override',
            'DialStartDate' => 'Dial Start Date',
            'DialEndDate' => 'Dial End Date',
            'CreationTime' => 'Creation Time',
            'ImportSequence' => 'Import Sequence',
            'ImportTag' => 'Import Tag',
            'ExportSequence' => 'Export Sequence',
            'RecycleCount' => 'Recycle Count',
            'LastRecycle' => 'Last Recycle',
            'ExportTime' => 'Export Time',
            'TargetHandler' => 'Target Handler',
            'TargetDestination' => 'Target Destination',
            'TargetMedia' => 'Target Media',
            'DialedCurrentActivity' => 'Dialed Current Activity',
            'TotalDialed' => 'Total Dialed',
            'MaxDialAttempts' => 'Max Dial Attempts',
            'ExpectedProfit' => 'Expected Profit',
            'LastDialStatus' => 'Last Dial Status',
            'LastDialStatusCount' => 'Last Dial Status Count',
            'LastDialedDestination' => 'Last Dialed Destination',
            'LastQualification' => 'Last Qualification',
            'LastQualificationArgued' => 'Last Qualification Argued',
            'LastQualificationPositive' => 'Last Qualification Positive',
            'LastQualificationExportable' => 'Last Qualification Exportable',
            'AreaId' => 'Area ID',
            'AppointmentId' => 'Appointment ID',
            'Excluded' => 'Excluded',
            'VMFlagged' => 'Vmflagged',
        ];
    }

    public function GetLastHandlingTimeFormatted() {
        $date = \DateTime::createFromFormat('M j Y h:i:s:uA', $this->LastHandlingTime);
        return $date->format('d/m/Y');
    }

    public function GetLastQualificationName() {
        $Qualification = Qualifications::find()->where("Id='" . $this->LastQualification . "'")->one();
        return $Qualification->Description;
    }

    public function GetLastHandlerName() {
        $Agent = Agents::find()->where("Id='" . $this->LastHandler . "'")->one();
        return $Agent->Account;
    }

}
