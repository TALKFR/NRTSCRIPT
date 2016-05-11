<?php

namespace app\components\FormWidgets;

use yii\base\Widget;
use yii\helpers\Html;
use kartik\date\DatePicker;
use kartik\time\TimePicker;

class DateWidget extends Widget {

    public $label;
    public $form;
    public $model;
    public $field;
    public $format = "dd/mm/yyyy";
    public $ro = false;

    public function run() {
        $html = '';
        try {
            $this->ro = ($this->model->scenario == 'RO') ? true : $this->ro;
            $this->ro = ($this->model->scenario <> 'default') ? true : $this->ro;




            $html.= DatePicker::widget([
                        'language' => 'fr',
                        'model' => $this->model,
                        'form' => $this->form,
                        'name' => $this->field,
                        'readonly' => true,
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'attribute' => $this->field,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => $this->format,
                            'todayHighlight' => true,
                        ],
            ]);
//            $html.= Html::error($this->model, $this->field_date);
        } catch (\Exception $ex) {
            $html = "<p style='color:red'>" . 'Date Error' . "</p>";
        }

        return $html;
    }

    public function init() {
        parent::init();
    }

}
