<?php
App::uses('AppController', 'Controller');
/**
 * Bills Controller
 *
 * @property Bill $Bill
 * @property PaginatorComponent $Paginator
 */
class BillsController extends AppController {

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
		$this->Bill->recursive = 0;
		$this->set('bills', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Bill->exists($id)) {
			throw new NotFoundException(__('Invalid bill'));
		}
		$options = array('conditions' => array('Bill.' . $this->Bill->primaryKey => $id));
		$this->set('bill', $this->Bill->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Bill->create();
			if ($this->Bill->save($this->request->data)) {
				$this->Session->setFlash(__('The bill has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bill could not be saved. Please, try again.'));
			}
		}
		$accounts = $this->Bill->Account->find('list');
		$tariffs = $this->Bill->Tariff->find('list');
		$this->set(compact('accounts', 'tariffs'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Bill->exists($id)) {
			throw new NotFoundException(__('Invalid bill'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Bill->save($this->request->data)) {
				$this->Session->setFlash(__('The bill has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bill could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Bill.' . $this->Bill->primaryKey => $id));
			$this->request->data = $this->Bill->find('first', $options);
		}
		$accounts = $this->Bill->Account->find('list');
		$tariffs = $this->Bill->Tariff->find('list');
		$this->set(compact('accounts', 'tariffs'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Bill->id = $id;
		if (!$this->Bill->exists()) {
			throw new NotFoundException(__('Invalid bill'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Bill->delete()) {
			$this->Session->setFlash(__('The bill has been deleted.'));
		} else {
			$this->Session->setFlash(__('The bill could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
