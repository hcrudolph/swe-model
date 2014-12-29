<?php
App::uses('Xml', 'Utility');
class BilanzShell extends AppShell {
    public $uses = array('Course', 'Account', 'Person', 'Courses', 'Tariff');

    public function main(){
        $this->Account->Behaviors->load('Containable');

        $mitglieder = $this->Account->find('all', array(
            'conditions' => array('role' => '0'),
            'contain' => array(
                'Person.name', 'Person.surname', 'Person.city', 'Person.street', 'Person.housenumber', 'Person.hnextra',
                'Date.begin', 'Date.end', 'Date.course_id'
            ),
        ));

        $mitarbeiter = $this->Account->find('all', array(
            'conditions' => array('role' => '1'),
            'contain' => array(
                'Person.name', 'Person.surname', 'Person.city', 'Person.street', 'Person.housenumber', 'Person.hnextra',
                'Date.begin', 'Date.end', 'Date.course_id'
            )
        ));

        $admins = $this->Account->find('all', array(
            'conditions' => array('role' => '2'),
            'contain' => array(
                'Person.name', 'Person.surname', 'Person.city', 'Person.street', 'Person.housenumber', 'Person.hnextra',
            )
        ));

        foreach ($mitarbeiter as $key => $value){
             /**
            foreach ($mitarbeiter[$key]['Date'] as $date){
                $date['begin'] = new DateTime($date['begin']);
                $date['end'] = new DateTime($date['end']);
                $interval = $date['begin']->diff($date['end']);
                $total_days = $interval->days;
                $hours      = $interval->h;
                if ($total_days !== FALSE) {
                    $hours += 24 * $total_days;
                }
                $minutes    = $interval->i;
                array_push($date, sprintf('%02d:%02d', $hours, $minutes));
            }
              **/
            unset($mitarbeiter[$key]['Account']['password']);
            unset($mitarbeiter[$key]['Account']['role']);
            $newkey = 'mitarbeiter' . $mitarbeiter[$key]['Account']['id'];
            $mitarbeiter[$newkey] = $mitarbeiter[$key];
            unset($mitarbeiter[$key]);
        }

        foreach ($mitglieder as $key => $value){
            unset($mitglieder[$key]['Account']['password']);
            unset($mitglieder[$key]['Account']['role']);
            $newkey = 'mitglied' . $mitglieder[$key]['Account']['id'];
            $mitglieder[$newkey] = $mitglieder[$key];
            unset($mitglieder[$key]);
        }

        foreach ($admins as $key => $value){
            unset($admins[$key]['Account']['password']);
            unset($admins[$key]['Account']['role']);
            $newkey = 'admin' . $admins[$key]['Account']['id'];
            $admins[$newkey] = $admins[$key];
            unset($admins[$key]);
        }

        pr($mitarbeiter);

        $mitarbeiter = array('mitarbeiters' => $mitarbeiter);
        $mitglieder = array('mitglieder' => $mitglieder);
        $admins = array('admins' => $admins);

        $xmlObject = Xml::build($mitarbeiter);
        $xmlString = $xmlObject->asXML();
        print $xmlString;

        $xmlObject = Xml::build($mitglieder);
        $xmlString2 = $xmlObject->asXML();
        print $xmlString2;

        $xmlObject = Xml::build($admins);
        $xmlString2 = $xmlObject->asXML();
        print $xmlString2;
    }
}