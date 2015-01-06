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
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';

            $fields = array("Tariff.name", 'Tariff.id');
            $tariffs = $this->Tariff->find('all', array('fields' => $fields));
            $this->set(compact('tariffs'));
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

            $fields = array("Tariffs.name", 'Tariffs.id');
            $conditions = array('Tariffs.id' => $id);
            $this->set('tariff', $this->Tariff->find('first', array('conditions'=>$conditions, 'fields' => $fields)));
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
            if(!$this->Tariff->exists($id)) {
                throw new NotFoundException;
            }
            $this->Tariff->Behaviors->load('Containable');

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
                'Room.'.$this->Tariff->primaryKey => $id,
            );
            $tariff = $this->Tariff->find('first', array('conditions'=>$conditions, 'contain'=>$contain));
            $this->set(compact('tariff'));
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

                if ($this->Tariff->save($this->request->data)) {
                    $answer['success'] = true;
                    $answer['message'] = 'Der Tarif wurde erstellt';
                    $answer['tariffId'] = $this->Tariff->id;
                } else {
                    $answer['success'] = false;
                    $answer['message'] = 'Der Tarif konnte nicht erstellt werden';
                    $answer['errors']['Tariff'] = $this->Tariff->validationErrors;
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
                if(!$this->Tariff->exists($id))
                {
                    throw new NotFoundException;
                }
                $this->request->data['Tariff']['id'] = $id;
                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();

                if ($this->Tariff->save($this->request->data)) {
                    $answer['success'] = true;
                    $answer['message'] = 'Der Tarif wurde bearbeitet';
                } else {
                    $answer['success'] = false;
                    $answer['message'] = 'Der Tarif konnte nicht bearbeitet werden';
                    $answer['errors']['Tariff'] = $this->Tariff->validationErrors;
                }
                echo json_encode($answer);
            } else
            {
                $options = array('conditions' => array('Tariff.' . $this->Tariff->primaryKey => $id));
                $this->set('tariff', $this->Tariff->find('first', $options));
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
                if(!$this->Tariff->exists($id))
                {
                    throw new NotFoundException;
                }
                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();

                if ($this->Tariff->delete($id)) {
                    $answer['success'] = true;
                    $answer['message'] = 'Der Tarif wurde gelöscht';
                } else {
                    $answer['success'] = false;
                    $answer['message'] = 'Der Tarif konnte nicht gelöscht werden';
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
