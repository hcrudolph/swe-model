<?php
App::uses('AppController', 'Controller');
/**
 * Courses Controller
 *
 * @property Course $Course
 * @property PaginatorComponent $Paginator
 */
class CoursesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @throws AjaxImplementedException
 * @return void
 */
	public function index() {
        if($this->request->is('ajax')) {
        	$this->layout = 'ajax';

			$fields = array("Course.name", 'Course.id');
			$courses = $this->Course->find('all', array('fields' => $fields));
			$this->set(compact('courses'));
    	} else
		{
			throw new AjaxImplementedException;
		}
	}

/**
 * view method
 *
 * @throws AjaxImplementedException, NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';
			if(!$this->Course->exists($id)) {
				throw new NotFoundException;
			}
			$this->Course->Behaviors->load('Containable');

			$contain = array(
					'Date' => array(
						'Trainer' => array (
							'Person'
						),
						'Room' => array(),
						'Account' => array()
					)
			);

			$conditions = array('Course.'.$this->Course->primaryKey => $id);
			$course = $this->Course->find('first', array('conditions'=>$conditions, 'contain'=>$contain));
			$this->set(compact('course'));
		} else
		{
			throw new AjaxImplementedException;
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Course->create();
			if ($this->Course->save($this->request->data)) {
				$this->Session->setFlash(__('The course has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The course could not be saved. Please, try again.'));
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
		if (!$this->Course->exists($id)) {
			throw new NotFoundException(__('Invalid course'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Course->save($this->request->data)) {
				$this->Session->setFlash(__('The course has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The course could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id));
			$this->request->data = $this->Course->find('first', $options);
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
		$this->Course->id = $id;
		if (!$this->Course->exists()) {
			throw new NotFoundException(__('Invalid course'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Course->delete()) {
			$this->Session->setFlash(__('The course has been deleted.'));
		} else {
			$this->Session->setFlash(__('The course could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
