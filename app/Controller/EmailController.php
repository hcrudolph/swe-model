<?php
set_time_limit(0);
App::uses('CakeEmail', 'Network/Email');
App::uses('AppController', 'Controller');

class EmailController extends AppController {

    public function send()
    {
        $this->autoRender = false;
        $email = new CakeEmail('noreplay');
        $email->to('zinkljannik@gmail.com');
        $email->subject('[Abgesagt] Kurs#1 (Schwierigkeitsgrad: 1) am 11.01.2015');
        $email->send("Hier steht ihre Nachricht!");
    }

    //Test benötigt keinen Login
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();
    }
}
?>
