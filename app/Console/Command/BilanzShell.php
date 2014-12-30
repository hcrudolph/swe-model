<?php
App::uses('Xml', 'Utility');
class BilanzShell extends AppShell {
    public $uses = array('Course', 'Account', 'Person', 'Courses', 'Tariff');

    public function findRelatedTariff($course_id){
        $related_tariff = $this->Tariff->find('first', array(
            'condition' => array('course_id' => $course_id),
            'recursive' => -1
        ));
        return '<tariff>' . $related_tariff['Tariff']['amount'] . '</tariff>';
    }

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

        foreach ($mitarbeiter as $key => $value){
            unset($mitarbeiter[$key]['Account']['password']);
            unset($mitarbeiter[$key]['Account']['role']);
            $mitarbeiter[$key]['Dates'] = array();
            foreach ($mitarbeiter[$key]['Date'] as $date){
                unset($date['director']);
                // push all <Date> tags to <Dates>
                array_push($mitarbeiter[$key]['Dates'], array('Date' => $date));
            }
            unset($mitarbeiter[$key]['Date']);
            $newkey = 'employee' . $mitarbeiter[$key]['Account']['id'];
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

        // Wrap in root elements and build core
        $mitglieder = array('mitglieder' => $mitglieder);
        $mitgliederObject = Xml::build($mitglieder);
        $mitgliederString = $mitgliederObject->asXML();

        $mitarbeiter = array('employees' => $mitarbeiter);
        $mitarbeiterObject = Xml::build($mitarbeiter);
        $mitarbeiterString = $mitarbeiterObject->asXML();

        $admins = array('admins' => $admins);
        $adminObject = Xml::build($admins);
        $adminString = $adminObject->asXML();

        // Refactor
        // Replace tag <emloyeeXY> with <emloyee>
        $mitarbeiterString = preg_replace('/employee\\d+/', 'employee', $mitarbeiterString, -1);
        // Put all <Date> tags in one single <Dates> element
        $toFind = '</Dates><Dates>';
        $mitarbeiterString = preg_replace("/" .preg_quote($toFind, '/') . "/", '', $mitarbeiterString, -1);
        // add respective tariff to date
        $mitarbeiterString = preg_replace('/<course_id>(\d+)<\/course_id>/', $this->findRelatedTariff('$1'), $mitarbeiterString);

        // print out XML
        //print $mitgliederString;
        print $mitarbeiterString;
        //print $adminString;
    }
}