<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Dates Controller
 *
 * @property Date $Date
 * @property PaginatorComponent $Paginator
 */
class DatesController extends AppController {

    /**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

    /** delete method
     *
     * @throws AjaxImplementedException, MethodNotAllowedException, NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if($this->request->is('ajax')) {
            if (!$this->Date->exists($id)) {
                throw new NotFoundException;
            }
            if ($this->request->is('post', 'delete')) {

                $this->Date->Behaviors->load('Containable');
                $contain = array(
                    'Account' => array(
                        'Person' => array(),
                        'fields' => array('Account.id')
                    ),
                    'Course' => array()
                );
                $conditions = array('Date.id' => $id);
                $date = $this->Date->find('first', array('contain' => $contain, 'conditions' => $conditions));

                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();
                $this->Date->id = $id;
                if($this->Date->delete()) {
                    $answer['success'] = true;
                    $answer['message'] = 'Der Termin wurde erfolgreich gelöscht.';
                    $answer['courseId'] = $this->request->data['courseId'];

                    $this->Post = ClassRegistry::init('Post');
                    $this->Post->create();
                    $post = array('Post' => array(
                        'account_id' => $this->Auth->user('id'),
                        'heading' => $date['Course']['name'].' ['.$date['Course']['level'].'] abgesagt',
                        'body' => $date['Course']['name'].' ['.$date['Course']['level'].'] am '.date('d.m.Y', strtotime($date['Date']['begin'])).' wurde abgesagt.',
                        'visiblebegin' => date('d.m.Y'),
                        'visibleend' => date('d.m.Y', strtotime($date['Date']['begin']))
                    ));
                    $this->Post->save($post);

                    $dateDateTime = new DateTime($date['Date']['begin']);
                    $nowDateTime = new DateTime();

                    if($dateDateTime >= $nowDateTime) {
                        foreach($date['Account'] as $account)
                        {
                            $person = $account['Person'];
                            $answer['person'] = $person;
                            if(!empty($person['email'])) {
                                $email = new CakeEmail('noreplay');
                                $email->to($person['email']);
                                $email->subject('[Abgesagt]'.$date['Course']['name'].' (Schwierigkeitsgrad: '+$date['Course']['level'].') am '+ date('d.m.Y', strtotime($date['Date']['begin'])));
                                $email->send("My Message");
                            } else {
                                $answer['nomail'] = array();
                                $num = count($answer['nomail']);
                                $answer['nomail'][$num]['name'] = $person['name'];
                                $answer['nomail'][$num]['surname'] = $person['surname'];
                                $answer['nomail'][$num]['phone'] = ((empty($person['phone']))?'--':$person['phone']);
                                $answer['nomail'][$num]['adress']['plz']= $person['plz'];
                                $answer['nomail'][$num]['adress']['city'] = $person['city'];
                                $answer['nomail'][$num]['adress']['street'] = $person['street'];
                                $answer['nomail'][$num]['adress']['hnextra'] = ((empty($person['hnextra']))?'':$person['hnextra']);
                                $answer['nomail'][$num]['adress']['housenumber'] = $person['housenumber'];
                            }
                        }
                    }

                } else {
                    $answer['success'] = false;
                    $answer['message'] = 'Der Termin konnte nicht gelöscht werden.';
                }
                echo json_encode($answer);
            } else {
                throw new MethodNotAllowedException;
            }
        } else {
            throw new AjaxImplementedException;
        }
    }




    #####implemented

    /**
     * add method
     *
     * @throws AjaxImplementedException, ForbiddenException
     * @param string $courseId
     * @return void
     */
    public function add($courseId = null) {
        if($this->request->is('ajax')) {
            if($this->Auth->user('role') == 0) {
                throw new ForbiddenException;
            }
            $this->layout = 'ajax';
            if ($this->request->is('post', 'put')) {
                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();

                if ($this->Date->save($this->request->data)) {
                    $answer['success'] = true;
                    $answer['message'] = 'Der Termin wurde erstellt';
                    $answer['dateId'] = $this->Date->id;;
                } else {
                    $answer['success'] = false;
                    $answer['message'] = 'Der Termin konnte nicht erstellt werden';
                    $answer['errors']['Date'] = $this->Date->validationErrors;
                }
                echo json_encode($answer);
            } else
            {
                $this->Date->Behaviors->load('Containable');
                if(is_null($courseId)) {
                    $courses = $this->Date->Course->find('all', array(
                        'fields' => array('Course.id', 'Course.name', 'Course.level'),
                        'contain' => false,
                    ));
                    $this->set('message', 'courseId is null');
                } else {
                    $courses = $this->Date->Course->find('all', array(
                        'fields' => array('Course.id', 'Course.name', 'Course.level'),
                        'contain' => false,
                        'conditions' => array('Course.id'=>$courseId)
                    ));
                    $this->set('message', 'courseId is NOT null');
                }
                $rooms = $this->Date->Room->find('list', array('fields' => array('Room.id', 'Room.name')));
                $directors = $this->Date->Account->find('all', array(
                    'conditions' => array('role >' => '0'),
                    'fields' => array('Account.id', 'Account.username', 'Person.name', 'Person.surname'),
                    'contain' => array('Account'=>array('Person'=>array())),
                    'order' => array('Person.name' => 'ASC')
                ));
                $this->set(compact('courses', 'rooms', 'directors', 'courseId'));
            }
        } else {
            throw new AjaxImplementedException;
        }
    }


    /**
     * edit method
     *
     * @throws AjaxImplementedException, MethodNotAllowedException, NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if($this->request->is('ajax')) {
            if($this->Auth->user('role') == 0) {
                throw new ForbiddenException;
            }
            if(!$this->Date->exists($id)) {
                throw new NotFoundException;
            }
            $this->layout = 'ajax';
            if ($this->request->is('post', 'put')) {
                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();

                $this->request->data['Date']['id'] = $id;
                if ($this->Date->save($this->request->data)) {
                    $answer['success'] = true;
                    $answer['message'] = 'Der Termin wurde bearbeitet';
                } else {
                    $answer['success'] = false;
                    $answer['message'] = 'Der Termin konnte nicht erstellt werden';
                    $answer['errors']['Date'] = $this->Date->validationErrors;
                }
                echo json_encode($answer);
            } else
            {
                $this->Date->Behaviors->load('Containable');
                $date = $this->Date->findById($id);
                $directors = $this->Date->Account->find('all', array(
                    'conditions' => array('role >' => '0'),
                    'fields' => array('Account.id', 'Account.username', 'Person.name', 'Person.surname'),
                    'contain' => array('Account'=>array('Person'=>array())),
                    'order' => array('Person.name' => 'ASC')
                ));
                $rooms = $this->Date->Room->find('list', array('fields' => array('Room.id', 'Room.name')));
                $this->set(compact('courses', 'date', 'directors', 'rooms'));
            }
        } else {
            throw new AjaxImplementedException;
        }
    }


    /**
     * signupUser method
     *
     * @throws AjaxImplementedException, NotFoundException, MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function signupUser($id = null) {
        if($this->request->is('ajax')) {
            if (!$this->Date->exists($id)) {
                throw new NotFoundException;
            }
            if ($this->request->is('post', 'put')) {
                $conditions = array('Date.' . $this->Date->primaryKey => $id);
                $date = $this->Date->find('first', array('conditions' => $conditions));
                $userSignedUp = false;
                foreach ($date['Account'] as $account) {
                    if ($this->Auth->user('id') == $account['id']) {
                        $userSignedUp = true;
                    }
                }

                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();


                if ($userSignedUp) {
                    $answer['success'] = false;
                    $answer['error'] = 'warning';
                    $answer['message'] = 'Sie sind bereits angemeldet.';
                } elseif (count($date['Account']) < $this->Date->field('maxcount')) {
                    if($this->Date->habtmAdd('Account', $id, $this->Auth->user('id')))
                    {
                        $answer['success'] = true;
                        $answer['message'] = "Sie wurden erfolgreich angemeldet.";
                        $answer['courseId'] = $date['Date']['course_id'];

                    } else{
                        $answer['success'] = false;
                        $answer['error'] = 'error';
                        $answer['message'] = 'Sie konnten nicht am Kurs angemeldet werden';
                    }
                } else {
                    $answer['success'] = false;
                    $answer['error'] = 'error';
                    $answer['message'] = 'Der Kurs hat bereits die maximale Teilnehmeranzahl.';
                }
                echo json_encode($answer);
            } else {
                throw new MethodNotAllowedException;
            }
        } else {
            throw new AjaxImplementedException;
        }
    }

    /**
     * signoffUser method
     *
     * @throws AjaxImplementedException, NotFoundException, MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function signoffUser($id = null){
        if($this->request->is('ajax')) {
            if (!$this->Date->exists($id)) {
                throw new NotFoundException;
            }
            if ($this->request->is('post', 'delete')) {
                $conditions = array('Date.' . $this->Date->primaryKey => $id);
                $date = $this->Date->find('first', array('conditions' => $conditions));
                $userSignedUp = false;
                foreach ($date['Account'] as $account) {
                    if ($this->Auth->user('id') == $account['id']) {
                        $userSignedUp = true;
                    }
                }

                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();


                if ($userSignedUp) {
                    if($this->Date->habtmDelete('Account', $id, $this->Auth->user('id'))) {
                        $answer['success'] = true;
                        $answer['message'] = "Sie wurden erfolgreich abgemeldet";
                        $answer['courseId'] = $date['Date']['course_id'];
                    } else {
                        $answer['success'] = false;
                        $answer['message'] = "Sie konnten nicht abgemeldet werden";
                    }
                } else {
                    $answer['success'] = false;
                    $answer['message'] = 'Sie sind nicht einmal angemeldet!';
                }
                echo json_encode($answer);
            } else {
                throw new MethodNotAllowedException;
            }
        } else {
            throw new AjaxImplementedException;
        }
    }
    
    public function events()
    {
        $this->autoRender = false;
        $this->response->type('json');
        
        $start=$this->request->query['start'];
        $end = $this->request->query['end'].' 23:59:59';

        $conditions = array('Date.end <=' => $end, 'Date.begin >=' => $start);
        $fields = array('Date.begin', 'Date.end', 'Course.name', 'Date.id');
        
        $events = $this->Date->find('all', array('conditions' => $conditions, 'fields' => $fields));
        
        $trenner = '';
        echo '[';
        foreach($events as $event)
        {
            $start = new DateTime($event['Date']['begin']);
            $end = new DateTime($event['Date']['end']);
            echo $trenner;
            echo '{';
            echo '"title":"'.$event['Course']['name'].'",';
            echo '"start":"'.$start->format(DateTime::ISO8601).'",';
            echo '"end":"'.$end->format(DateTime::ISO8601).'",';
            echo '"url":"dates/view/'.$event['Date']['id'].'"';
            echo '}';
            $trenner = ',';
        }
        echo ']';
    }
    
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('events');
    }
}
