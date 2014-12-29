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

        foreach ($mitglieder as $key => $value){
            unset($mitglieder[$key]['Account']['password']);
            unset($mitglieder[$key]['Account']['role']);
            $mitglieder[$key]['Dates'] = array();
            foreach ($mitarbeiter[$key]['Date'] as $date){
                unset($date['director']);
                array_push($mitglieder[$key]['Dates'], array('Date' => $date));
            }
            unset($mitglieder[$key]['Date']);
            $newkey = 'mitglied' . $mitglieder[$key]['Account']['id'];
            $mitglieder[$newkey] = $mitglieder[$key];
            unset($mitglieder[$key]);
        }

        pr($mitglieder);

        foreach ($mitarbeiter as $key => $value){
            unset($mitarbeiter[$key]['Account']['password']);
            unset($mitarbeiter[$key]['Account']['role']);
            $mitarbeiter[$key]['Dates'] = array();
            foreach ($mitarbeiter[$key]['Date'] as $date){
                unset($date['director']);
                array_push($mitarbeiter[$key]['Dates'], array('Date' => $date));
            }
            unset($mitarbeiter[$key]['Date']);
            $newkey = 'mitarbeiter' . $mitarbeiter[$key]['Account']['id'];
            $mitarbeiter[$newkey] = $mitarbeiter[$key];
            unset($mitarbeiter[$key]);
        }

        foreach ($admins as $key => $value){
            unset($admins[$key]['Account']['password']);
            unset($admins[$key]['Account']['role']);
            $newkey = 'admin' . $admins[$key]['Account']['id'];
            $admins[$newkey] = $admins[$key];
            unset($admins[$key]);
        }

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