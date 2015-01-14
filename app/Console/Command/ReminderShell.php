<?php
App::uses('CakeEmail', 'Network/Email');

class ReminderShell extends AppShell
{
    public $uses = array('Date');

    public function main()
    {
        $this->Date->Behaviors->load('Containable');

        $dates = $this->Date->find('all', array(
            'conditions' => array(
                'Date.begin >=' => date('Y-m-d'),
                'Date.end <=' => date('Y-m-d').' 23.59.59'
            ),
            'contain' => array(
                'Account' => array(
                    'Person'
                ),
                'Course' => array()
            )
        ));

        foreach($dates as $date) {
            foreach($date['Account'] as $account) {
                $person = $account['Person'];
                if(!is_null($person['email'])) {
                    $email = new CakeEmail('noreplay');
                    $email->viewVars(array(
                        'nachname' => $person['name'],
                        'vorname' => $person['surname'],
                        'dateBegin' => $date['Date']['begin'],
                        'courseName' => $date['Course']['name'],
                        'courseLevel' => $date['Course']['level'],

                    ));
                    $email->emailFormat('text');
                    $email->to($person['email']);
                    $email->subject('[Erinnerung]'.$date['Course']['name'].' (Schwierigkeitsgrad: '.$date['Course']['level'].') am '. date('d.m.Y', strtotime($date['Date']['begin'])));

                    $message = 'Sehr geehrte(r) '.$person['surname'].' '.$person['name'].",\n\n";
                    $message.= 'wir wollen Sie erinnern, dass ihr Kurs '.$date['Course']['name'].' heute um'.date('H:i:s', strtotime($date['Date']['begin']))." beginnt.\n\n";
                    $message.= "Freundliche Grüße,\n ihr Fitnessstudio";

                    $email->send($message);
                }
            }
        }

    }
}