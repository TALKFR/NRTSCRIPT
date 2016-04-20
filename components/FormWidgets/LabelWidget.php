<?php

namespace app\components\FormWidgets;

use yii\base\Widget;
use yii\helpers\Html;

class LabelWidget extends Widget {

    public $label;
    public $model;
    public $field;
    public $value;

    public function run() {
        $html = '';
        try {

            $field = $this->field;

            if ($this->value <> '') {
                $html .='    <span style="text-decoration: underline;"><b>' . $this->label . '</b> </span><br>' . $this->value . '<br>';
            } else {
                $html .='    <span style="text-decoration: underline;"><b>' . $this->label . '</b> </span><br>' . $this->model->$field . '<br>';
            }
        } catch (\Exception $ex) {
            $html = "<p style='color:red'>" . 'Label Error' . "</p>";
        }
        return $html;
    }

    public function init() {
        parent::init();
    }

}
