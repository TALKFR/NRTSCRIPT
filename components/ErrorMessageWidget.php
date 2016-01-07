<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class ErrorMessageWidget extends Widget {

    const POSITIVES = 1;
    const NEGATIVES = -1;
    const NEUTRES = 0;

    public $title;
    public $message;

    public function init() {

        parent::init();
    }

    public function run() {
        $html = null;

        $html .='
            <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                <div class="col-sm-12" style="text-align: center;"><h5><b>' . $this->title . '</b></h5></div>
            </div>';

        $html.= '<p style="height : 30px; text-align:center; color:red; font-weight:bold;">';

        $html.= $this->message;
        $html.= '</p>';
        $html.='      <div class="row" style=" margin-left: 0px; margin-right: 0px; margin-top: 5px;">';
        $html.='  <div class="col-sm-12" style="margin-top: 5px; background-color: #113060;  height: 2px;"></div>';
        $html.=' </div>    ';

        return $html;
    }

}
