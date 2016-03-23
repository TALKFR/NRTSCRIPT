<?php

namespace app\components;

class Email {

    private $recipient;
    private $from_email;
    private $from_name;
    private $subject;

    function setRecipient($recipient) {
        $this->recipient = $recipient;
    }

    function setFrom_email($from_email) {
        $this->from_email = $from_email;
    }

    function setFrom_name($from_name) {
        $this->from_name = $from_name;
    }

    function setSubject($subject) {
        $this->subject = $subject;
    }

    public function Test() {
        $params = [];
        \Yii::$app->mail->compose('Test', ['params' => $params])
                ->setFrom([\Yii::$app->params['adminEmail'] => 'Test Mail'])
                ->setTo('info@byphone.eu')
                ->setSubject('This is a test mail ')
                ->send();
    }

    public function Send($mail, $model) {
        $params = [
            'model' => $model
        ];
        \Yii::$app->mail->compose($mail, $params)
                ->setFrom([$this->from_email => $this->from_name])
                ->setTo($this->recipient)
                ->setSubject($this->subject)
                ->send();
    }

}
