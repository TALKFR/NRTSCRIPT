<?php

namespace app\scripts\Travaux\v1\models;

use Yii;
use app\scripts\Travaux\v1\models\SM_ListActivities;

/**
 * This is the model class for table "leads".
 *
 * @property integer $id
 * @property string $nixxisId
 * @property string $trackid
 * @property integer $blacklist
 * @property string $act_id
 * @property string $cus_title
 * @property string $cus_last_name
 * @property string $cus_first_name
 * @property string $cus_postcode
 * @property string $cus_town
 * @property string $cus_email
 * @property string $cus_tel
 * @property string $object
 * @property integer $order
 * @property string $LocalDateTime
 */
class Leads extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'leads';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db123devis');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['blacklist', 'order'], 'integer'],
            [['object'], 'string'],
            [['nixxisId'], 'string', 'max' => 32],
            [['trackid', 'cus_title', 'cus_last_name', 'cus_first_name', 'cus_postcode', 'cus_town', 'cus_email', 'cus_tel', 'LocalDateTime'], 'string', 'max' => 255],
            [['act_id'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nixxisId' => 'Nixxis ID',
            'trackid' => 'Trackid',
            'blacklist' => 'Blacklist',
            'act_id' => 'Act ID',
            'cus_title' => 'Cus Title',
            'cus_last_name' => 'Cus Last Name',
            'cus_first_name' => 'Cus First Name',
            'cus_postcode' => 'Cus Postcode',
            'cus_town' => 'Cus Town',
            'cus_email' => 'Cus Email',
            'cus_tel' => 'Cus Tel',
            'object' => 'Object',
            'order' => 'Order',
        ];
    }

    public function GetActivityName() {
        return SM_ListActivities::GetActivityName($this->act_id);
    }

    public function BeforeSave() {
        if (Leads::find()->where(['nixxisid' => $this->nixxisId, 'act_id' => $this->act_id])->exists())
            return false;



        return true;
    }

}
