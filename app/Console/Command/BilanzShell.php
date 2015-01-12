<?php
App::uses('Xml', 'Utility');
class BilanzShell extends AppShell
{
    public $uses = array('Course', 'Account', 'Person', 'Courses', 'Tariff');

    public function main()
    {
        $this->Account->Behaviors->load('Containable');

        $member = $this->findAccountsByRole(0);
        $employees = $this->findAccountsByRole(1);
        $admins = $this->findAccountsByRole(2);

        foreach ($member as $key => $value) {
            unset($member[$key]['Account']['password']);
            $member[$key]['Dates'] = array();
            foreach ($employees[$key]['Date'] as $date) {
                unset($date['director']);
                array_push($member[$key]['Dates'], array('Date' => $date));
            }
            unset($member[$key]['Date']);
            $newkey = 'member' . $member[$key]['Account']['id'];
            $member[$newkey] = $member[$key];
            unset($member[$key]);
        }

        foreach ($employees as $key => $value) {
            unset($employees[$key]['Account']['password']);
            $employees[$key]['Dates'] = array();
            foreach ($employees[$key]['Date'] as $date) {
                unset($date['director']);
                // push all <Date> tags to <Dates>
                array_push($employees[$key]['Dates'], array('Date' => $date));
            }
            unset($employees[$key]['Date']);
            $newkey = 'employee' . $employees[$key]['Account']['id'];
            $employees[$newkey] = $employees[$key];
            unset($employees[$key]);
        }

        foreach ($admins as $key => $value) {
            unset($admins[$key]['Account']['password']);
            unset($admins[$key]['Account']['role']);
            $newkey = 'admin' . $admins[$key]['Account']['id'];
            $admins[$newkey] = $admins[$key];
            unset($admins[$key]);
        }

        // Wrap in root elements and build core
        $member = array('members' => $member);
        $member = array('memberbill' => $member);
        $memberObject = Xml::build($member);
        $memberObject->addChild('tariff', $this->getTariffByRole(0));
        $memberObject->addChild('timestamp', date("Y-m-d H:i:s"));
        $memberString = $memberObject->asXML();

        $employees = array('employees' => $employees);
        $employees = array('employeebill' => $employees);
        $employeeObject = Xml::build($employees);
        $employeeObject->addChild('timestamp', date("Y-m-d H:i:s"));
        $employeeString = $employeeObject->asXML();

        $admins = array('admins' => $admins);
        $admins = array('adminbill' => $admins);
        $adminObject = Xml::build($admins);
        $adminObject->addChild('tariff', $this->getTariffByRole(2));
        $adminObject->addChild('timestamp', date("Y-m-d H:i:s"));
        $adminString = $adminObject->asXML();

        /** Refactor XML **/
        /** Members **/
        // Replace tag <memberXY> with <member>
        $memberString = preg_replace('/member\\d+/', 'member', $memberString, -1);
        // Put all <Date> tags in one single <Dates> element
        $toFind = '</Dates><Dates>';
        $memberString = preg_replace("/" . preg_quote($toFind, '/') . "/", '', $memberString, -1);

        /** Employees **/
        // Replace tag <emloyeeXY> with <emloyee>
        $employeeString = preg_replace('/employee\\d+/', 'employee', $employeeString, -1);
        // Put all <Date> tags in one single <Dates> element
        $toFind = '</Dates><Dates>';
        $employeeString = preg_replace("/" . preg_quote($toFind, '/') . "/", '', $employeeString, -1);
        // add respective tariff to date
        $employeeString = preg_replace('/<course_id>(\d+)<\/course_id>/e', '$this->getCourseTariff("$1")', $employeeString);

        /** Admins **/
        // Replace tag <adminXY> with <admin>
        $adminString = preg_replace('/admin\\d+/', 'admin', $adminString, -1);

        // print out XML
        print $memberString;
        print $employeeString;
        print $adminString;
    }

    private function getTariffByRole($role){
        $tariff = $this->Tariff->findByRole($role);
        return $tariff['Tariff']['amount'];
    }

    private function getCourseTariff($course_id){
        $related_tariff = $this->Course->find('first', array(
            'condition' => array('Course.id' => $course_id),
            'contain' => array('Tariff.amount')
        ));
        pr($related_tariff);
        return '<tariff>' . $related_tariff['Tariff']['amount'] . '</tariff>';
    }

    private function findAccountsByRole($role){
        $accounts = $this->Account->find('all', array(
            'conditions' => array('role' => $role),
            'contain' => array(
                'Date' => array(
                    'conditions' => array(
                        'Date.begin >' => date("Y-m-d H:i:s", strtotime("-1 month")),
                        'Date.begin <' => date("Y-m-d H:i:s"),
                        )
                ),
                'Person.name', 'Person.surname', 'Person.city', 'Person.street', 'Person.housenumber', 'Person.hnextra',
            )
        ));
        return $accounts;
    }
}