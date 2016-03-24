<?php

namespace app\components;

class iRaiserPayment {

    //&reserved_field=CODEMEDIA
    //https://donner.chainedelespoir.org/?cid=18&civility=1&firstname=Dan&lastname=Martin&email=hello@chameleon.eu&address1=12+smithfield&postcode=EC1A9BU&city=London&country=GB&frequency=once&amount=3000&free_amount=0&reserved_field=CODEMEDIA

    private $base_url;
    private $cid;
    private $frequency;

    function setBase_url($base_url) {
        $this->base_url = $base_url;
    }

    function setCid($cid) {
        $this->cid = $cid;
    }

    function setFrequency($frequency) {
        $this->frequency = $frequency;
    }

    public function GetUrl($model) {
        //$base_url = 'https://donner.chainedelespoir.org/?';
        $base_url = $this->base_url . '/?cid=' . $this->cid . '&';

//        $base_url .= urlencode('civility=' . $model->CIV) . '&';
        $base_url .= trim('firstname=' . $model->NOM) . '&';
        $base_url .= trim('lastname=' . $model->PRENOM) . '&';
        $base_url .= trim('email=' . $model->EMAIL1) . '&';
        $base_url .= trim('address1=' . $model->_NUMERO_DE_RUE . ' ' . $model->_CODE_BIS . ' ' . $model->ADR3 . ' ' . $model->ADR4) . '&';
        $base_url .= trim('address2=' . $model->ADR1 . ' ' . $model->ADR2) . '&';
        $base_url .= trim('postcode=' . $model->CP) . '&';
        $base_url .= trim('city=' . $model->VILLE) . '&';
        $base_url .= 'country=FR&';
        $base_url .= 'frequency=' . $this->frequency . '&';
        $base_url .= trim('amount=' . ($model->N_MONTANT * 100)) . '&';
        $base_url .= 'free_amount=1&';
        $base_url .= trim('reserved_field=' . $model->CODE_MEDIA) . '&';
        $base_url .= trim('External_id=' . $model->IDENTIFIANT1) . '&';
        $base_url .= 'nocache=' . uniqid();


        $base_url = str_replace(' ', '+', $base_url);

        return ($base_url);
    }

}
