<?php

namespace app\models\Nixxis;

use Yii;

/**
* This is the model class for table "Pauses".
*
    * @property string $Id
    * @property string $GroupId
    * @property string $Description
    * @property integer $Active
    * @property string $GroupKey
    * @property string $CreatorId
    * @property string $CreationDate
    * @property string $LastModifiedBy
    * @property string $LastModification
    * @property string $ExternalData
    * @property string $TimeStamp
*/
class Pauses extends \app\models\Nixxis\Data
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'Pauses';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['Id', 'Active'], 'required'],
            [['Id', 'GroupId', 'Description', 'GroupKey', 'CreatorId', 'LastModifiedBy', 'ExternalData'], 'string'],
            [['Active'], 'integer'],
            [['CreationDate', 'LastModification', 'TimeStamp'], 'safe']
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'Id' => 'ID',
    'GroupId' => 'Group ID',
    'Description' => 'Description',
    'Active' => 'Active',
    'GroupKey' => 'Group Key',
    'CreatorId' => 'Creator ID',
    'CreationDate' => 'Creation Date',
    'LastModifiedBy' => 'Last Modified By',
    'LastModification' => 'Last Modification',
    'ExternalData' => 'External Data',
    'TimeStamp' => 'Time Stamp',
];
}
}
