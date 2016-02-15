<?php

namespace app\models\Nixxis;

use Yii;

/**
* This is the model class for table "DIT_In_ContactState".
*
    * @property integer $Id
    * @property string $Description
    * @property string $DescriptionFr
*/
class DITInContactState extends \app\models\Nixxis\Data
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'DIT_In_ContactState';
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
