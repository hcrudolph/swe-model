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
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Date->create();
			if ($this->Date->save($this->request->data)) {
				$this->Session->setFlash(__('The date has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The date could not be saved. Please, try again.'));
			}
		}
		$courses = $this->Date->Course->find('list');
		$rooms = $this->Date->Room->find('list');
		$accounts = $this->Date->Account->find('list');
        $directors = $this->Date->Account->find('list', array(
            'conditions' => array('role' => '1')
        ));
		$this->set(compact('courses', 'rooms', 'accounts', 'directors'));
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
                } elseif (count($date['Account']) < $this->Date->Course->field('maxcount')) {
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
     * @throws AjaxImplementedException, NotFoundExceptionm MethodNotAllowedException
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










        if($this->request->is('ajax')) {
            if (!$this->Date->exists($id)) {
                throw new NotFoundException;
            }
            if ($this->request->is('post', 'put')) {

                $this->Date->id = $id;
                $account_id = $this->Auth->user('id');
                $data = $this->Date->findAllById($id);

                //Check if User is signed up for this course
                while ($Acc = current($data[0]['Account'])) {
                    if ($Acc['id'] == $account_id) {
                        $key = key($data[0]['Account']);
                        unset($data[0]['Account'][$key]);
                        /**
                         * Debugging:
                         * debug($data);
                         * print_r($data);
                         */
                        $this->Date->saveAll($data);
                        $this->Session->setFlash(__('Signed off successfully'));
                        return $this->redirect(array('action' => 'index'));
                    }
                    next($data[0]['Account']);
                }
            } else {
                throw new MethodNotAllowedException;
            }
        } else {
            throw new AjaxImplementedException;
        }
    }


 /** delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Date->id = $id;
		if (!$this->Date->exists()) {
			throw new NotFoundException(__('Invalid date'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Date->delete()) {
			$this->Session->setFlash(__('The date has been deleted.'));
		} else {
			$this->Session->setFlash(__('The date could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
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
            echo '"url":"javascript:alert(\''.$event['Date']['id'].'\')"';
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
