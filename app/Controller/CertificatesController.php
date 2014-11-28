<?php
App::uses('AppController', 'Controller');
/**
 * Certificates Controller
 *
 * @property Certificate $Certificate
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CertificatesController extends AppController {

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
		$this->Certificate->recursive = 0;
		$this->set('certificates', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Certificate->exists($id)) {
			throw new NotFoundException(__('Invalid certificate'));
		}
		$options = array('conditions' => array('Certificate.' . $this->Certificate->primaryKey => $id));
		$this->set('certificate', $this->Certificate->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Certificate->create();
			if ($this->Certificate->save($this->request->data)) {
				$this->Session->setFlash(__('The certificate has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The certificate could not be saved. Please, try again.'));
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
		if (!$this->Certificate->exists($id)) {
			throw new NotFoundException(__('Invalid certificate'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Certificate->save($this->request->data)) {
				$this->Session->setFlash(__('The certificate has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The certificate could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Certificate.' . $this->Certificate->primaryKey => $id));
			$this->request->data = $this->Certificate->find('first', $options);
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
		$this->Certificate->id = $id;
		if (!$this->Certificate->exists()) {
			throw new NotFoundException(__('Invalid certificate'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Certificate->delete()) {
			$this->Session->setFlash(__('The certificate has been deleted.'));
		} else {
			$this->Session->setFlash(__('The certificate could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
