<?php
App::uses('AppController', 'Controller');
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

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Date->recursive = 0;
		$this->set('dates', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Date->exists($id)) {
			throw new NotFoundException(__('Invalid date'));
		}
		$options = array('conditions' => array('Date.' . $this->Date->primaryKey => $id));
		$this->set('date', $this->Date->find('first', $options));
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Date->exists($id)) {
			throw new NotFoundException(__('Invalid date'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Date->save($this->request->data)) {
				$this->Session->setFlash(__('The date has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The date could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Date.' . $this->Date->primaryKey => $id));
			$this->request->data = $this->Date->find('first', $options);
		}
		$courses = $this->Date->Course->find('list');
		$rooms = $this->Date->Room->find('list');
		$accounts = $this->Date->Account->find('list');
        $directors = $this->Date->Account->find('list', array(
            'conditions' => array('role' => '1')
        ));
		$this->set(compact('courses', 'rooms', 'accounts', 'directors'));
	}




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

                $this->Date->id = $id;
                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();
                if($this->Date->delete()) {
                    $answer['success'] = true;
                    $answer['message'] = 'Der Termin wurde erfolgreich gelöscht.';
                    //Create Post entry
                    //Senden der Emails

                } else {
                    $answer['success'] = false;
                    $answer['message'] = 'Der Termin konnte nicht gelöscht werden.';
                }
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
     * @throws AjaxImplementedException, ForbiddenException, NotFoundException
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
                } else {
                    $answer['success'] = false;
                    $answer['message'] = 'Der Termin konnte nicht erstellt werden';
                    $answer['errors']['Date'] = $this->Date->validationErrors;
                }
                echo json_encode($answer);
            } else
            {
                $this->Date->Behaviors->load('Containable');
                $contain = array(
                    'Account'=>array(
                        'Person'=>array()
                    ));
                if(is_null($courseId)) {
                    $courses = $this->Date->Course->find('all', array(
                        'fields' => array('Course.id', 'Course.name', 'Course.level'),
                        'contain' => false,
                    ));
                } else {
                    $courses = $this->Date->Course->find('all', array(
                        'fields' => array('Course.id', 'Course.name', 'Course.level'),
                        'contain' => false,
                        'condtitions' => array('Course.id'=>$courseId)
                    ));
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
