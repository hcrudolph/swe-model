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
        $accounts = $directors = $this->Date->AccountsDate->Account->find('list');
        $directors = $this->Date->AccountsDate->Account->find('list', array(
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
        $accounts = $directors = $this->Date->AccountsDate->Account->find('list');
        $directors = $this->Date->AccountsDate->Account->find('list', array(
            'conditions' => array('role' => '1')
        ));
        $this->set(compact('courses', 'rooms', 'accounts', 'directors'));
	}

    /**
     * signip method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function signup($id = null) {
        if (!$this->Date->exists($id)) {
            throw new NotFoundException(__('Invalid date'));
        }
        $data = array(
            'Date' => array('id' => $this->Date->id),
            'Account' => array('account_id' => $this->Auth->user('id'))
        );
        if($this->Date->AccountsDate->create($data)){
            $this->Date->AccountsDate->saveAssociated($data);
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
}
