<?php
App::uses('AppController', 'Controller');
/**
 * Tariffs Controller
 *
 * @property Tariff $Tariff
 * @property PaginatorComponent $Paginator
 */
class TariffsController extends AppController {

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
        if($this->request->is('ajax'))
        {
            $this->layout = 'ajax';
        } else
        {
            $this->layout = 'polymer';
        }
		$this->Tariff->recursive = 0;
		$this->set('tariffs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tariff->exists($id)) {
			throw new NotFoundException(__('Invalid tariff'));
		}
		$options = array('conditions' => array('Tariff.' . $this->Tariff->primaryKey => $id));
		$this->set('tariff', $this->Tariff->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tariff->create();
			if ($this->Tariff->save($this->request->data)) {
				$this->Session->setFlash(__('The tariff has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tariff could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Tariff->exists($id)) {
			throw new NotFoundException(__('Invalid tariff'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tariff->save($this->request->data)) {
				$this->Session->setFlash(__('The tariff has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tariff could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Tariff.' . $this->Tariff->primaryKey => $id));
			$this->request->data = $this->Tariff->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Tariff->id = $id;
		if (!$this->Tariff->exists()) {
			throw new NotFoundException(__('Invalid tariff'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Tariff->delete()) {
			$this->Session->setFlash(__('The tariff has been deleted.'));
		} else {
			$this->Session->setFlash(__('The tariff could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
