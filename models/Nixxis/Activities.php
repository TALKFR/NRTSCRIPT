<?php

namespace app\models\Nixxis;

use Yii;

/**
 * This is the model class for table "activities".
 *
 * @property string $Id
 * @property string $CampaignId
 * @property string $Owner
 * @property string $MusicPrompt
 * @property string $WaitMusicProcessor
 * @property integer $Active
 * @property string $Description
 * @property string $PreprocessorParams
 * @property string $PostprocessorParams
 * @property integer $MediaType
 * @property string $PreprocessorId
 * @property string $PostprocessorId
 * @property string $QueueId
 * @property string $WaitResource
 * @property string $GroupKey
 * @property string $Script
 * @property string $ScriptId
 * @property integer $AutoReadyDelay
 * @property integer $WrapupExtendable
 * @property integer $WrapupTime
 * @property integer $PostWrapupOptionsValue
 * @property integer $AutomaticRecording
 * @property integer $ListenAllowed
 * @property string $CreatorId
 * @property string $CreationDate
 * @property string $LastModifiedBy
 * @property string $LastModification
 * @property integer $QualificationRequired
 * @property integer $Lines
 * @property integer $RecordingPlaybackLevel
 * @property integer $DisableManualQualification
 * @property integer $TimeOffset
 * @property string $ProviderConfigSettings
 * @property string $TimeStamp
 */
class Activities extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'admin.dbo.activities';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Id', 'Active', 'MediaType'], 'required'],
            [['Id', 'CampaignId', 'Owner', 'MusicPrompt', 'WaitMusicProcessor', 'Description', 'PreprocessorParams', 'PostprocessorParams', 'PreprocessorId', 'PostprocessorId', 'QueueId', 'WaitResource', 'GroupKey', 'Script', 'ScriptId', 'CreatorId', 'LastModifiedBy', 'ProviderConfigSettings'], 'string'],
            [['Active', 'MediaType', 'AutoReadyDelay', 'WrapupExtendable', 'WrapupTime', 'PostWrapupOptionsValue', 'AutomaticRecording', 'ListenAllowed', 'QualificationRequired', 'Lines', 'RecordingPlaybackLevel', 'DisableManualQualification', 'TimeOffset'], 'integer'],
            [['CreationDate', 'LastModification', 'TimeStamp'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'Id' => 'ID',
            'CampaignId' => 'Campaign ID',
            'Owner' => 'Owner',
            'MusicPrompt' => 'Music Prompt',
            'WaitMusicProcessor' => 'Wait Music Processor',
            'Active' => 'Active',
            'Description' => 'Description',
            'PreprocessorParams' => 'Preprocessor Params',
            'PostprocessorParams' => 'Postprocessor Params',
            'MediaType' => 'Media Type',
            'PreprocessorId' => 'Preprocessor ID',
            'PostprocessorId' => 'Postprocessor ID',
            'QueueId' => 'Queue ID',
            'WaitResource' => 'Wait Resource',
            'GroupKey' => 'Group Key',
            'Script' => 'Script',
            'ScriptId' => 'Script ID',
            'AutoReadyDelay' => 'Auto Ready Delay',
            'WrapupExtendable' => 'Wrapup Extendable',
            'WrapupTime' => 'Wrapup Time',
            'PostWrapupOptionsValue' => 'Post Wrapup Options Value',
            'AutomaticRecording' => 'Automatic Recording',
            'ListenAllowed' => 'Listen Allowed',
            'CreatorId' => 'Creator ID',
            'CreationDate' => 'Creation Date',
            'LastModifiedBy' => 'Last Modified By',
            'LastModification' => 'Last Modification',
            'QualificationRequired' => 'Qualification Required',
            'Lines' => 'Lines',
            'RecordingPlaybackLevel' => 'Recording Playback Level',
            'DisableManualQualification' => 'Disable Manual Qualification',
            'TimeOffset' => 'Time Offset',
            'ProviderConfigSettings' => 'Provider Config Settings',
            'TimeStamp' => 'Time Stamp',
        ];
    }

}
