<?php

namespace app\components\FormWidgets;

use yii\base\Widget;
use yii\helpers\Html;

class MonthYearWidget extends Widget {

    public $label_month;
    public $label_year;
    public $form;
    public $model;
    public $field_month;
    public $field_year;
    public $ro = false;

    public function run() {
        $html = '';
        try {
            $this->ro = ($this->model->scenario == 'RO') ? true : $this->ro;
            $this->ro = ($this->model->scenario <> 'default') ? true : $this->ro;


            $html.='<div class = "col-sm-6" > ' . $this->form->field($this->model, $this->field_month)->dropDownList(\app\models\Nixxis\Data::getMonths(), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label($this->label_month) . '</div>';
            $html.= '<div class = "col-sm-6" > ' . $this->form->field($this->model, $this->field_year)->dropDownList(\app\models\Nixxis\Data::getYears(5), ['prompt' => '--Select--'], ['class' => 'form-control inline-block updateindicator'])->label($this->label_year) . '</div>';
        } catch (\Exception $ex) {
            $html = "<p style='color:red'>" . 'MonthYear Error' . "</p>";
        }

        return $html;
    }

    public function init() {
        parent::init();
    }

}
