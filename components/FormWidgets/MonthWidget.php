<?php

namespace app\components\FormWidgets;

use yii\base\Widget;
use yii\helpers\Html;

class MonthWidget extends Widget {

    public $label_month;
    public $form;
    public $model;
    public $field_month;
    public $ro = false;

    public function run() {
        $html = '';
        try {
            $this->ro = ($this->model->scenario == 'RO') ? true : $this->ro;
            $this->ro = ($this->model->scenario <> 'default') ? true : $this->ro;

            $html.=$this->form->field($this->model, $this->field_month)->dropDownList(\app\models\Nixxis\Data::getMonths(), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label($this->label_month);
        } catch (\Exception $ex) {
            $html = "<p style='color:red'>" . 'Month Error' . "</p>";
        }

        return $html;
    }

    public function init() {
        parent::init();
    }

}
