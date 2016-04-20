<?php

namespace app\components\FormWidgets;

use yii\base\Widget;
use yii\helpers\Html;

class ButtonWidget extends Widget {

    public $label;
    public $controller;
    public $action;
    public $parameters;

    public function run() {
        $html = '';
        try {


            $array = [
                $this->action,
            ];

            $array = array_merge($array, $this->parameters);

            $html.= '<p style="text-align:center">';
            $html.= Html::a($this->label, $array, ['class' => 'btn btn-danger', 'style' => 'width:32%; font-size:10px; font-weight: bold;     padding: 6px 1px; ']);
            $html.= '</p>';
        } catch (\Exception $ex) {
            $html = "<p style='color:red'>" . 'Line Error' . "</p>";
        }
        return $html;
    }

    public function init() {
        parent::init();
    }

}
