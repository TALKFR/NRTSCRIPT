<?php

namespace app\models\Nixxis;

use Yii;

class Data extends \yii\db\ActiveRecord {

    public static function primaryKey() {
        parent::primaryKey();
        return array('Internal__id__');
    }

    public function GetSystemData() {
        $ClassSystemData = new SystemData();
        $reflector = new \ReflectionClass($this);
        $bddname = str_replace('DATA', '', $reflector->getShortName());
        $bddname = str_replace('_', '', $bddname);
        $bddname = 'Data_' . $bddname;

        $ClassSystemData::$system_tablename = $bddname . '.dbo.SystemData';

        return $ClassSystemData::find()->where("Internal__id__ = '" . $this->Internal__id__ . "'")->one();
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [

            [['EMAIL1', 'EMAIL2'], 'email', 'message' => 'La valeur doit être un email valide'],
            [['TEL1', 'TEL2', 'TEL3'], 'app\components\Validators\NixxisPhoneNumberValidator', 'format' => 'FR'],
        ];
    }

    public static function getMonths() {
        $months = array();
        setlocale(LC_TIME, "fr_FR.utf8");
        for ($x = 1; $x <= 12; $x++) {
            $x = str_pad($x, 2, '0', STR_PAD_LEFT);
            $months[$x] = ucfirst(strftime('%B', strtotime(date("F", mktime(0, 0, 0, $x, 10)))));
        }

        return $months;
    }

    public static function getYears($limit = 2, $start = 'now') {
        $years = array();

        if ($start == 'now') {
            $curYear = date("Y");
        } else {
            $curYear = $start;
        }
        for ($x = $curYear; $x < $curYear + $limit; $x++) {
            $years[$x] = $x;
        }
        return $years;
    }

    public static function getFirstAvailable($array) {
        foreach ($array as $value) {
            if ($value != '') {
                return $value;
            }
        }
    }

}
