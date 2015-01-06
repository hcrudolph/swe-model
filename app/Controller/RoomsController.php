<?php
App::uses('AppController', 'Controller');
/**
 * Rooms Controller
 *
 * @property Room $Room
 * @property PaginatorComponent $Paginator
 */
class RoomsController extends AppController {

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
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';

            $fields = array("Room.name", 'Room.id');
            $rooms = $this->Room->find('all', array('fields' => $fields));
            $this->set(compact('rooms'));
        } else
        {
            throw new AjaxImplementedException;
        }
	}

    public function indexElement($id=null) {
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            if(is_null($id)) {
                throw new NotFoundException;
            }

            $fields = array("Room.name", 'Room.id');
            $conditions = array('Room.id' => $id);
            $this->set('room', $this->Room->find('first', array('conditions'=>$conditions, 'fields' => $fields)));
        } else
        {
            throw new AjaxImplementedException;
        }
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            if(!$this->Room->exists($id)) {
                throw new NotFoundException;
            }
            $this->Room->Behaviors->load('Containable');

            $contain = array(
                'Date' => array(
                    'Trainer' => array (
                        'Person'
                    ),
                    'Account' => array(),
                ),
                'Tariff'
            );
            if($this->Auth->user('role') == 0) {
                $contain['Date']['conditions'] = array(
                    'Date.begin >=' => date('Y-m-d')
                );
            }

            $conditions = array(
                'Room.'.$this->Room->primaryKey => $id,
            );
            $room = $this->Room->find('first', array('conditions'=>$conditions, 'contain'=>$contain));
            $this->set(compact('room'));
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

                if ($this->Room->save($this->request->data)) {
                    $answer['success'] = true;
                    $answer['message'] = 'Der Raum wurde erstellt';
                    $answer['roomId'] = $this->Room->id;
                } else {
                    $answer['success'] = false;
                    $answer['message'] = 'Der Raum konnte nicht erstellt werden';
                    $answer['errors']['Room'] = $this->Room->validationErrors;
                }
                echo json_encode($answer);
            } else
            {}
        } else {
            throw new AjaxImplementedException;
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
		if (!$this->Room->exists($id)) {
			throw new NotFoundException(__('Invalid room'));
		}
		if ($this->request->is(array('post', 'put'))) {
            //if ($this->Auth->user('role') < 2) {
            //    throw new ForbiddenException;
            //} else {
			if ($this->Room->save($this->request->data)) {
				$this->Session->setFlash(__('The room has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The room could not be saved. Please, try again.'));
			} // }
		} else {
			$options = array('conditions' => array('Room.' . $this->Room->primaryKey => $id));
			$this->request->data = $this->Room->find('first', $options);
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
		$this->Room->id = $id;
		if (!$this->Room->exists()) {
			throw new NotFoundException(__('Invalid room'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Room->delete()) {
            //if ($this->Auth->user('role') < 2) {
            //    throw new ForbiddenException;
            //} else {
			$this->Session->setFlash(__('The room has been deleted.'));
		} // }
        else {
			$this->Session->setFlash(__('The room could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
