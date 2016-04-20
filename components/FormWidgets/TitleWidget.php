<?php

namespace app\components\FormWidgets;

use yii\base\Widget;
use yii\helpers\Html;

class TitleWidget extends Widget {

    public $label;

    public function run() {
        $html = '';
        try {
            $html .='
            <div class="row" style="background-color: #113060; color: #ffffff; height: 39px; margin-left: 0px; margin-right: 0px;">
                <div class="col-sm-12" style="text-align: center;"><h4>' . $this->label . '</h4></div>
            </div>';
        } catch (\Exception $ex) {
            $html = "<p style='color:red'>" . 'Title Error' . "</p>";
        }
        return $html;
    }

    public function init() {
        parent::init();
    }

}
