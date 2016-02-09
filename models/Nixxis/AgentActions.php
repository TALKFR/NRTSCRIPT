<?php

namespace app\models\Nixxis;

use Yii;

/**
* This is the model class for table "AgentActions".
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
    * @property integer $ActionId
    * @property integer $Duration
    * @property integer $DurationUsefull
    * @property string $TeamId
    * @property string $Extension
    * @property integer $Voice
    * @property integer $Chat
    * @property integer $Mail
*/
class AgentActions extends \app\models\Nixxis\Data
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'AgentActions';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['SiteId', 'ServerId', 'ContactId', 'DateTimeString', 'AgentId', 'TeamId', 'Extension'], 'string'],
            [['DateTimeValue', 'LocalDateTime'], 'safe'],
            [['TimeZone', 'LocalDateGroup', 'ActionId', 'Duration', 'DurationUsefull', 'Voice', 'Chat', 'Mail'], 'integer']
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
    'ActionId' => 'Action ID',
    'Duration' => 'Duration',
    'DurationUsefull' => 'Duration Usefull',
    'TeamId' => 'Team ID',
    'Extension' => 'Extension',
    'Voice' => 'Voice',
    'Chat' => 'Chat',
    'Mail' => 'Mail',
];
}
}
