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

            $conditions = array(
                'Room.'.$this->Room->primaryKey => $id,
            );
            $room = $this->Room->find('first', array('conditions'=>$conditions));
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
        if($this->request->is('ajax')) {
            if($this->Auth->user('role') == 0) {
                throw new ForbiddenException;
            }
            $this->layout = 'ajax';
            if ($this->request->is('post')) {
                if(!$this->Room->exists($id))
                {
                    throw new NotFoundException;
                }
                $this->request->data['Room']['id'] = $id;
                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();

                if ($this->Room->save($this->request->data)) {
                    $answer['success'] = true;
                    $answer['message'] = 'Der Raum wurde bearbeitet';
                } else {
                    $answer['success'] = false;
                    $answer['message'] = 'Der Raum konnte nicht bearbeitet werden';
                    $answer['errors']['Room'] = $this->Room->validationErrors;
                }
                echo json_encode($answer);
            } else
            {
                $options = array('conditions' => array('Room.' . $this->Room->primaryKey => $id));
                $this->set('room', $this->Room->find('first', $options));
            }
        } else {
            throw new AjaxImplementedException;
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
        if($this->request->is('ajax')) {
            if($this->Auth->user('role') == 0) {
                throw new ForbiddenException;
            }
            $this->layout = 'ajax';
            if ($this->request->is('post', 'delete')) {
                if(!$this->Room->exists($id))
                {
                    throw new NotFoundException;
                }
                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();

                if ($this->Room->delete($id)) {
                        $answer['success'] = true;
                        $answer['message'] = 'Der Raum wurde gelöscht';
                } else {
                        $answer['success'] = false;
                        $answer['message'] = 'Der Raum konnte nicht gelöscht werden';
                }
                echo json_encode($answer);
            } else
            {
                throw new MethodNotAllowedException;
            }
        } else {
            throw new AjaxImplementedException;
        }
	}
}
