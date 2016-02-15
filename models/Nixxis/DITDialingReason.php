<?php

namespace app\models\Nixxis;

use Yii;

/**
* This is the model class for table "DIT_DialingReason".
*
    * @property integer $Id
    * @property string $Description
    * @property string $DescriptionFr
*/
class DITDialingReason extends \app\models\Nixxis\Data
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'DIT_DialingReason';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['Id'], 'required'],
            [['Id'], 'integer'],
            [['Description', 'DescriptionFr'], 'string']
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'Id' => 'ID',
    'Description' => 'Description',
    'DescriptionFr' => 'Description Fr',
];
}
}
