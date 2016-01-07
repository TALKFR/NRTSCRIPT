<?php

namespace app\models\Nixxis;

use Yii;

/**
 * This is the model class for table "inboundactivities".
 *
 * @property string $Id
 * @property string $Destination
 * @property integer $Reject
 * @property integer $Ring
 * @property integer $AbandonsAreCalledBack
 * @property integer $PromptForOverflow
 * @property integer $TransmitEWT
 * @property integer $QueueMusicDelay
 * @property integer $TransmitPosition
 * @property integer $WaitMusicLength
 * @property integer $SlaPercentageHandledInTime
 * @property integer $SlaPercentageToHandle
 * @property integer $SlaTime
 * @property integer $UsePreferredAgent
 * @property integer $PreferredAgentQueueTime
 * @property integer $PreferredAgentValidity
 * @property integer $PreprocessorReplacesSkills
 * @property integer $PreprocessorReplacesLanguages
 * @property integer $InitialProfit
 * @property integer $AlternateInitialProfit
 * @property string $AlternateInitialProfitRule
 * @property string $OverflowActiveDTMFs
 * @property string $OverflowPrompt
 * @property integer $OverflowPromptStartingLoop
 * @property string $CallbackActivityId
 * @property string $AbandonsCallbackActivityId
 * @property integer $OverflowActionType
 * @property string $OverflowParam
 * @property string $OverflowPreprocessorParams
 * @property string $OverflowRerouteParam
 * @property string $TimeStamp
 */
class InboundActivities extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'admin.dbo.inboundactivities';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Id', 'Reject', 'Ring', 'TransmitEWT', 'TransmitPosition', 'WaitMusicLength'], 'required'],
            [['Id', 'Destination', 'AlternateInitialProfitRule', 'OverflowActiveDTMFs', 'OverflowPrompt', 'CallbackActivityId', 'AbandonsCallbackActivityId', 'OverflowParam', 'OverflowPreprocessorParams', 'OverflowRerouteParam'], 'string'],
            [['Reject', 'Ring', 'AbandonsAreCalledBack', 'PromptForOverflow', 'TransmitEWT', 'QueueMusicDelay', 'TransmitPosition', 'WaitMusicLength', 'SlaPercentageHandledInTime', 'SlaPercentageToHandle', 'SlaTime', 'UsePreferredAgent', 'PreferredAgentQueueTime', 'PreferredAgentValidity', 'PreprocessorReplacesSkills', 'PreprocessorReplacesLanguages', 'InitialProfit', 'AlternateInitialProfit', 'OverflowPromptStartingLoop', 'OverflowActionType'], 'integer'],
            [['TimeStamp'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'Id' => 'ID',
            'Destination' => 'Destination',
            'Reject' => 'Reject',
            'Ring' => 'Ring',
            'AbandonsAreCalledBack' => 'Abandons Are Called Back',
            'PromptForOverflow' => 'Prompt For Overflow',
            'TransmitEWT' => 'Transmit Ewt',
            'QueueMusicDelay' => 'Queue Music Delay',
            'TransmitPosition' => 'Transmit Position',
            'WaitMusicLength' => 'Wait Music Length',
            'SlaPercentageHandledInTime' => 'Sla Percentage Handled In Time',
            'SlaPercentageToHandle' => 'Sla Percentage To Handle',
            'SlaTime' => 'Sla Time',
            'UsePreferredAgent' => 'Use Preferred Agent',
            'PreferredAgentQueueTime' => 'Preferred Agent Queue Time',
            'PreferredAgentValidity' => 'Preferred Agent Validity',
            'PreprocessorReplacesSkills' => 'Preprocessor Replaces Skills',
            'PreprocessorReplacesLanguages' => 'Preprocessor Replaces Languages',
            'InitialProfit' => 'Initial Profit',
            'AlternateInitialProfit' => 'Alternate Initial Profit',
            'AlternateInitialProfitRule' => 'Alternate Initial Profit Rule',
            'OverflowActiveDTMFs' => 'Overflow Active Dtmfs',
            'OverflowPrompt' => 'Overflow Prompt',
            'OverflowPromptStartingLoop' => 'Overflow Prompt Starting Loop',
            'CallbackActivityId' => 'Callback Activity ID',
            'AbandonsCallbackActivityId' => 'Abandons Callback Activity ID',
            'OverflowActionType' => 'Overflow Action Type',
            'OverflowParam' => 'Overflow Param',
            'OverflowPreprocessorParams' => 'Overflow Preprocessor Params',
            'OverflowRerouteParam' => 'Overflow Reroute Param',
            'TimeStamp' => 'Time Stamp',
        ];
    }

}
