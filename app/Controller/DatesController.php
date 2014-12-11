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
     * signup method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function signup($id = null) {
        if (!$this->Date->exists($id)) {
            throw new NotFoundException(__('Invalid date'));
        }

        if($this->Date->Account->find('count') == $this->Date->Course->maxcount){
            $this->Session->setFlash(__('The course limit was reached.'));
            return $this->redirect(array('action' => 'index'));
        } elseif($this->Date->Account->getID() == $this->Auth->user('id')) {
            $this->Session->setFlash(__('You are already signed up for this course.'));
            return $this->redirect(array('action' => 'index'));
        }

        $data = $this->Date->find('all');
        $newdata = array('account_id' => $this->Auth->user('id'));
        array_push($data[0]['Account'], $newdata);
        if($this->Date->saveAll($data)){
            $this->Session->setFlash(__('You have been signed up successfully for this course.'));
        } else {
            $this->Session->setFlash(__('Unable to sign you up. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }


/**
 * delete method
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
