<?php
App::uses('AppController', 'Controller');
/**
 * CourseRoomTimes Controller
 *
 * @property CourseRoomTime $CourseRoomTime
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CourseRoomTimesController extends AppController {

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
		$this->CourseRoomTime->recursive = 0;
		$this->set('courseRoomTimes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CourseRoomTime->exists($id)) {
			throw new NotFoundException(__('Invalid course room time'));
		}
		$options = array('conditions' => array('CourseRoomTime.' . $this->CourseRoomTime->primaryKey => $id));
		$this->set('courseRoomTime', $this->CourseRoomTime->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CourseRoomTime->create();
			if ($this->CourseRoomTime->save($this->request->data)) {
				$this->Session->setFlash(__('The course room time has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The course room time could not be saved. Please, try again.'));
			}
		}
		$courses = $this->CourseRoomTime->Course->find('list');
		$this->set(compact('courses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CourseRoomTime->exists($id)) {
			throw new NotFoundException(__('Invalid course room time'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CourseRoomTime->save($this->request->data)) {
				$this->Session->setFlash(__('The course room time has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The course room time could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CourseRoomTime.' . $this->CourseRoomTime->primaryKey => $id));
			$this->request->data = $this->CourseRoomTime->find('first', $options);
		}
		$courses = $this->CourseRoomTime->Course->find('list');
		$this->set(compact('courses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CourseRoomTime->id = $id;
		if (!$this->CourseRoomTime->exists()) {
			throw new NotFoundException(__('Invalid course room time'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CourseRoomTime->delete()) {
			$this->Session->setFlash(__('The course room time has been deleted.'));
		} else {
			$this->Session->setFlash(__('The course room time could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
