<?php
App::uses('AppController', 'Controller');
/**
 * AccountsTrainings Controller
 *
 * @property AccountsTraining $AccountsTraining
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AccountsTrainingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
        if($this->request->is('ajax'))
        {
            $this->layout = 'ajax';
        } else
        {
            throw new NotImplementedException("Diese Anfrage wird nur mit Ajax unterstützt");
        }
		$this->AccountsTraining->recursive = 0;
		$this->set('accountsTrainings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AccountsTraining->exists($id)) {
			throw new NotFoundException(__('Invalid accounts training'));
		}
		$options = array('conditions' => array('AccountsTraining.' . $this->AccountsTraining->primaryKey => $id));
		$this->set('accountsTraining', $this->AccountsTraining->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AccountsTraining->create();
			if ($this->AccountsTraining->save($this->request->data)) {
				$this->Session->setFlash(__('The accounts training has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The accounts training could not be saved. Please, try again.'));
			}
		}
		$accounts = $this->AccountsTraining->Account->find('list');
		$this->set(compact('accounts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AccountsTraining->exists($id)) {
			throw new NotFoundException(__('Invalid accounts training'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AccountsTraining->save($this->request->data)) {
				$this->Session->setFlash(__('The accounts training has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The accounts training could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AccountsTraining.' . $this->AccountsTraining->primaryKey => $id));
			$this->request->data = $this->AccountsTraining->find('first', $options);
		}
		$accounts = $this->AccountsTraining->Account->find('list');
		$this->set(compact('accounts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AccountsTraining->id = $id;
		if (!$this->AccountsTraining->exists()) {
			throw new NotFoundException(__('Invalid accounts training'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->AccountsTraining->delete()) {
			$this->Session->setFlash(__('The accounts training has been deleted.'));
		} else {
			$this->Session->setFlash(__('The accounts training could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
