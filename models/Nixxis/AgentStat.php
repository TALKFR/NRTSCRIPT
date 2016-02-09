<?php

namespace app\models\Nixxis;

use Yii;

/**
* This is the model class for table "AgentStat".
*
    * @property integer $Id
    * @property string $SiteId
    * @property string $ServerId
    * @property string $ContactId
    * @property string $DateTimeValue
    * @property string $DateTimeString
    * @property integer $TimeZone
    * @property string $LocalDateTime
    * @property integer $LocalDateGroup
    * @property string $AgentId
    * @property integer $AgentStateId
    * @property integer $AgentActionId
    * @property string $Data
    * @property integer $DurationState
    * @property integer $DurationAction
    * @property integer $DurationActionUsefull
    * @property integer $StateChange
    * @property string $TeamId
    * @property string $Extension
*/
class AgentStat extends \app\models\Nixxis\Data
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'AgentStat';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['SiteId', 'ServerId', 'ContactId', 'DateTimeString', 'AgentId', 'Data', 'TeamId', 'Extension'], 'string'],
            [['DateTimeValue', 'LocalDateTime'], 'safe'],
            [['TimeZone', 'LocalDateGroup', 'AgentStateId', 'AgentActionId', 'DurationState', 'DurationAction', 'DurationActionUsefull', 'StateChange'], 'integer']
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'Id' => 'ID',
    'SiteId' => 'Site ID',
    'ServerId' => 'Server ID',
    'ContactId' => 'Contact ID',
    'DateTimeValue' => 'Date Time Value',
    'DateTimeString' => 'Date Time String',
    'TimeZone' => 'Time Zone',
    'LocalDateTime' => 'Local Date Time',
    'LocalDateGroup' => 'Local Date Group',
    'AgentId' => 'Agent ID',
    'AgentStateId' => 'Agent State ID',
    'AgentActionId' => 'Agent Action ID',
    'Data' => 'Data',
    'DurationState' => 'Duration State',
    'DurationAction' => 'Duration Action',
    'DurationActionUsefull' => 'Duration Action Usefull',
    'StateChange' => 'State Change',
    'TeamId' => 'Team ID',
    'Extension' => 'Extension',
];
}
}
