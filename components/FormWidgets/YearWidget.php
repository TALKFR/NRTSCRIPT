<?php

namespace app\components\FormWidgets;

use yii\base\Widget;
use yii\helpers\Html;

class YearWidget extends Widget {

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

            $html.=$this->form->field($this->model, $this->field)->dropDownList(\app\models\Nixxis\Data::getYears(11, 2006), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label($this->label);
        } catch (\Exception $ex) {
            $html = "<p style='color:red'>" . 'Year Error' . "</p>";
        }

        return $html;
    }

    public function init() {
        parent::init();
    }

}
