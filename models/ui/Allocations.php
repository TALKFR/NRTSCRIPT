<?php

namespace app\models\ui;

use Yii;
use app\models\Nixxis\Activities;
use app\models\Nixxis\Campaigns;

/**
 * This is the model class for table "allocations".
 *
 * @property integer $id
 * @property string $NixxisCampaignId
 * @property string $NixxisActivityId
 * @property string $Script
 * @property integer $version
 * @property string $comments
 */
class Allocations extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'allocations';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('dbscripts');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['version'], 'integer'],
            [['comments'], 'string'],
            [['NixxisActivityId', 'NixxisCampaignId'], 'string', 'max' => 32],
            [['Script'], 'string', 'max' => 255],
            [['NixxisActivityId', 'version', 'Script'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'NixxisActivityId' => 'Nixxis Activity ID',
            'NixxisCampaignId' => 'Nixxis Campaign ID',
            'Script' => 'Script',
            'version' => 'Version',
            'comments' => 'Comments',
        ];
    }

    public function GetActivityName() {
        return Activities::find()->select('Description')->where(['Id' => $this->NixxisActivityId])->one()->Description;
    }

    public function GetCampaignName() {
        $CampaignId = Activities::find()->where(['Id' => $this->NixxisActivityId])->one()->CampaignId;
        //return 'oui';
        return Campaigns::find()->select('Description')->where(['Id' => $CampaignId])->one()->Description;
    }

    public function GetScriptName() {
        $classname = $this->Script;
        $ScriptName = '';

        try {
            $ScriptName .= $classname::getName();
        } catch (\Exception $ex) {
            $ScriptName .='Not found';
        }



        return $ScriptName;
    }

}
