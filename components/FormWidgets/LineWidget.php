<?php

namespace app\components\FormWidgets;

use yii\base\Widget;
use yii\helpers\Html;

class LineWidget extends Widget {

    public function run() {
        $html = '';
        try {
            $html .='
            <div class="row" style=" margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                <div class="col-sm-12" style="margin-top: 5px; background-color: #113060;  height: 2px;"></div>
            </div> ';
        } catch (\Exception $ex) {
            $html = "<p style='color:red'>" . 'Line Error' . "</p>";
        }
        return $html;
    }

    public function init() {
        parent::init();
    }

}
