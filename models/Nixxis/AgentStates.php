<?php

namespace app\models\Nixxis;

use Yii;

/**
* This is the model class for table "AgentStates".
*
    * @property integer $Id
    * @property string $SiteId
    * @property string $ServerId
    * @property string $DateTimeValue
    * @property string $DateTimeString
    * @property integer $TimeZone
    * @property string $LocalDateTime
    * @property integer $LocalDateGroup
    * @property string $AgentId
    * @property integer $StateId
    * @property string $Data
    * @property integer $Duration
    * @property string $Extension
*/
class AgentStates extends \app\models\Nixxis\Data
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'AgentStates';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['SiteId', 'ServerId', 'DateTimeString', 'AgentId', 'Data', 'Extension'], 'string'],
            [['DateTimeValue', 'LocalDateTime'], 'safe'],
            [['TimeZone', 'LocalDateGroup', 'StateId', 'Duration'], 'integer']
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
    'DateTimeValue' => 'Date Time Value',
    'DateTimeString' => 'Date Time String',
    'TimeZone' => 'Time Zone',
    'LocalDateTime' => 'Local Date Time',
    'LocalDateGroup' => 'Local Date Group',
    'AgentId' => 'Agent ID',
    'StateId' => 'State ID',
    'Data' => 'Data',
    'Duration' => 'Duration',
    'Extension' => 'Extension',
];
}
}
