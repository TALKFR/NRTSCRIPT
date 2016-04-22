<?php

namespace app\components\FormWidgets;

use yii\base\Widget;
use yii\helpers\Html;
use kartik\date\DatePicker;
use kartik\time\TimePicker;

class DateTimeWidget extends Widget {

    public $label_date;
    public $label_time;
    public $form;
    public $model;
    public $field_date;
    public $field_time;
    public $ro = false;

    public function run() {
        $html = '';
        try {
            $this->ro = ($this->model->scenario == 'RO') ? true : $this->ro;
            $this->ro = ($this->model->scenario <> 'default') ? true : $this->ro;




            $html.='<div class="col-sm-6">';
            $html.= DatePicker::widget([
                        'language' => 'fr',
                        'model' => $this->model,
                        'form' => $this->form,
                        'name' => $this->field_date,
                        'readonly' => true,
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'attribute' => $this->field_date,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd/mm/yyyy',
                            'todayHighlight' => true,
                        ],
            ]);
//            $html.= Html::error($this->model, $this->field_date);


            $html.='</div>';
            $html.= '<div class="col-sm-6">';

            $html.= $this->form->field($this->model, $this->field_time)->widget(TimePicker::classname(), [
                        'readonly' => true,
                        'pluginOptions' => [
                            'showSeconds' => false,
                            'showMeridian' => false,
                        ]
                    ])->label($this->label_time);
            $html.= '</div>';
        } catch (\Exception $ex) {
            $html = "<p style='color:red'>" . 'DateTime Error' . "</p>";
        }

        return $html;
    }

    public function init() {
        parent::init();
    }

}
