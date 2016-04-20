<?php

namespace app\components\FormWidgets;

use yii\base\Widget;
use yii\helpers\Html;

class QualificationsGroupWidget extends Widget {

    const POSITIVES = 1;
    const NEGATIVES = -1;
    const NEUTRES = 0;

    public $type;
    public $col = 3;
    public $datas = array();
    public $model;
    public $form;
    public $qualificationid;
    public $htmltoinsert;
    public $htmltoadd;

    public function init() {

        parent::init();
    }

    public function run() {
        $html = null;
        $col = 0;
        $style = null;
        $text = null;
        switch ($this->type) {
            case self::NEGATIVES:
                $style = 'btn-warning';
                $text = 'QUALIFICATIONS NEGATIVES';
                break;
            case self::NEUTRES:
                $style = 'btn-info';
                $text = 'QUALIFICATIONS NEUTRES';
                break;
            case self::POSITIVES:
                $style = 'btn-success';
                $text = 'QUALIFICATIONS POSITIVES';
                break;
        }
        $html .='
            <div class="row" style="background-color: #113060; color: #ffffff; height: 29px; margin-left: 0px; margin-right: 0px; margin-top: 5px;">
                <div class="col-sm-12" style="text-align: center;"><h5><b>' . $text . '</b></h5></div>
            </div>';
        $html .='
            <div class="row">
            <div class="col-sm-12">
            <p>';

        $html .= $this->htmltoinsert;


        $html .='
            </p>
            </div>
            </div>';
        if ($this->qualificationid !== null) {
            $html.= '<p style="height : 30px; text-align:center;">';
            $html.= Html::submitButton($this->datas[$this->qualificationid]['Description'], ['class' => 'btn ' . $style . '', 'style' => 'width:32%; font-size:10px; font-weight: bold;     padding: 6px 1px; ',
                        'onclick' => 'SetQualification("' . $this->qualificationid . '")'
            ]);
            $html.= '</p>';
        } else {

            foreach ($this->datas as $NixxisQualification) {


                if ($NixxisQualification['Positive'] == $this->type) {
                    if ($col % $this->col == 0) {
                        if ($col) {
                            $html.= '</p>';
                        }
                        $html.= '<p style="height : 30px; text-align:center;">';
                    }
//                    if ($this->type <= 0) {
//                        if ($NixxisQualification['Action'] != 4) {
//                            $html.= Html::submitButton($NixxisQualification['Description'], ['class' => 'btn ' . $style . '', 'style' => 'width:32%; font-size:10px; font-weight: bold;     padding: 6px 1px; ',
//                                        'onclick' => 'SetQualification("' . $NixxisQualification['Id'] . '")'
//                            ]);
//                        } else {
//                            $html.= Html::a($NixxisQualification['Description'], ['goto', 'Internal__id__' => $this->model->Internal__id__], ['class' => 'btn btn-info', 'style' => 'width:32%; font-size:10px; font-weight: bold;     padding: 6px 1px; ', 'onclick' => 'SetQualification("' . $NixxisQualification['Id'] . '")', 'data' => ['method' => 'post']]);
//                        }
//                    } else {
//                        $html.= Html::a($NixxisQualification['Description'], ['goto', 'Internal__id__' => $this->model->Internal__id__], ['class' => 'btn btn-success', 'style' => 'width:32%; font-size:10px; font-weight: bold;     padding: 6px 1px; ', 'onclick' => 'SetQualification("' . $NixxisQualification['Id'] . '")', 'data' => ['method' => 'post']]);
//                    }

                    $html.= Html::submitButton($NixxisQualification['Description'], ['class' => 'btn ' . $style . '', 'style' => 'width:32%; font-size:10px; font-weight: bold;     padding: 6px 1px; ',
                                'onclick' => 'SetQualification("' . $NixxisQualification['Id'] . '")'
                    ]);
                    $col++;
                    $html.= '&nbsp;';
                }
            }
        }
        $html.= '</p>';


        $html.= $this->htmltoadd;



        $html.='      <div class="row" style=" margin-left: 0px; margin-right: 0px; margin-top: 5px;">';
        $html.='  <div class="col-sm-12" style="margin-top: 5px; background-color: #113060;  height: 2px;"></div>';
        $html.=' </div>    ';

        return $html;
    }

}
