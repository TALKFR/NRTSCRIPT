<?php

namespace app\components\FormWidgets;

use yii\base\Widget;
use yii\helpers\Html;

class SelectWidget extends Widget {

    public $label;
    public $data;
    public $form;
    public $model;
    public $field;
    public $ro = false;

    public function run() {
        $html = '';

        try {
            $this->ro = ($this->model->scenario == 'RO') ? true : $this->ro;
            $this->ro = ($this->model->scenario <> 'default') ? true : $this->ro;

            $html.=$this->form->field($this->model, $this->field)->dropDownList($this->data, ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label($this->label);
        } catch (\Exception $ex) {
            $html = "<p style='color:red'>" . 'Select Error' . "</p>";
        }

        return $html;
    }

    public function init() {
        parent::init();
    }

}
