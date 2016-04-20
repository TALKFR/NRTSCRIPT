<?php

namespace app\components\FormWidgets;

use yii\base\Widget;
use yii\helpers\Html;

class TextBoxWidget extends Widget {

    public $label;
    public $form;
    public $model;
    public $field;
    public $ro = false;

    public function run() {
        $html = '';
        try {
            $this->ro = ($this->model->scenario == 'RO') ? true : $this->ro;
            $this->ro = ($this->model->scenario <> 'default') ? true : $this->ro;
            $html.= $this->form->field($this->model, $this->field)->textInput(['readonly' => $this->ro])->label($this->label);
        } catch (\Exception $ex) {
            $html = "<p style='color:red'>" . 'TextBox Error' . "</p>";
        }

        return $html;
    }

    public function init() {
        parent::init();
    }

}
