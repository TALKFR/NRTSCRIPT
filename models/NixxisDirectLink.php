<?php

namespace app\models;

use DateTime;

class NixxisDirectLink {

    private $_url;
    private $_sessionid;
    private $_contactid;
    private $_contactlistid;

    function __construct($url, $sessionid) {
        $this->_url = $url;
        $this->_sessionid = $sessionid;
    }

    function setContactid($contactid) {
        $this->_contactid = $contactid;
    }

    function setContactlistid($contactlistid) {
        $this->_contactlistid = $contactlistid;
    }

    function setInternalId() {

        //$sequence = time();
        // $date = new DateTime();
        $sequence = $this->microtime_float();
        //$url = $this->_url;

        $url = 'http://nixxisv2.talk.intra:8088/';
        $url .= '~' . $this->_sessionid . '/agent?';
        $url .= 'events=no&fmt=uri&action=~setinfo';
        $url .= '&inc=' . $sequence;
        $url .= '&__p1=5';
        $url .= '&__p2=' . $this->_contactid;
        $url .= '&__p3=@@ContactListId';
        $url .= '&__p4=' . $this->_contactlistid;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_HEADER => FALSE,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_URL => $url,
        ));
        //http://nixxisv2.talk.intra:8088/~b6282c687f00417a9369efa1f4cb3aad/agent?events=no&fmt=uri&action=~setinfo&inc=1460381998347&__p1=5&__p2=b57376609d944cf5b053126380f8759e&__p3=@@ContactListId&__p4=0112a24a465746ba9eb3438859179156
        //http://nixxisv2.talk.intra:8088/~b6282c687f00417a9369efa1f4cb3aad/agent?events=no&fmt=uri&action=~setinfo&inc=1460383815&__p1=5&__p2=b57376609d944cf5b053126380f8759e&__p3=@@ContactListId&__p4=0112a24a465746ba9eb3438859179156
        //http://nixxisv2.talk.intra:8088/~b6282c687f00417a9369efa1f4cb3aad/agent?events=no&fmt=uri&action=~setinfo&inc=1460383936&__p1=5&__p2=b57376609d944cf5b053126380f8759e&__p3=@@ContactListId&__p4=0112a24a465746ba9eb3438859179156

        curl_exec($curl);
        return curl_getinfo($curl, CURLINFO_HTTP_CODE);
    }

    function setQualification($QualificationId, $CallBackTimeStamp = null, $CallBackPhoneNumber = null) {
        $sequence = $this->microtime_float();
        $url = 'http://nixxisv2.talk.intra:8088/';
        $url .= '~' . $this->_sessionid . '/agent?';
        $url .= 'events=no&fmt=uri&action=~setinfo';
        $url .= '&inc=' . $sequence;
        $url .= '&__p1=1';
        $url .= '&__p2=*';
        $url .= '&__p3=' . $QualificationId;
        if ($CallBackTimeStamp != null && $CallBackTimeStamp != '') {
            $url .= '&__p4=' . $CallBackTimeStamp;
            if ($CallBackPhoneNumber != null && $CallBackPhoneNumber != '') {
                $url .= '&__p5=' . $CallBackPhoneNumber;
            }
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_HEADER => FALSE,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_URL => $url,
        ));
        curl_exec($curl);
        return curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //http://nixxisv2.talk.intra:8088/~b6282c687f00417a9369efa1f4cb3aad/agent?events=no&fmt=uri&action=~setinfo&inc=1460383921053&__p1=1&__p2=*&__p3=c9a8a6d71bc94dd5a899a80766e161c
        //http://nixxisv2.talk.intra:8088/~b6282c687f00417a9369efa1f4cb3aad/agent?events=no&fmt=uri&action=~setinfo&inc=1460383975950&__p1=1&__p2=*&__p3=14d9ea15db024979a34d08a4a69fd27c&__p4=201605011600
        //http://nixxisv2.talk.intra:8088/~b6282c687f00417a9369efa1f4cb3aad/agent?events=no&fmt=uri&action=~setinfo&inc=1460384037153&__p1=1&__p2=*&__p3=14d9ea15db024979a34d08a4a69fd27c&__p4=201604301600&__p5=0672823738
    }

    function microtime_float() {
        return round(microtime(true) * 1000);
    }

}
