<?php
App::uses('AppController', 'Controller');
/**
 * Certificates Controller
 *
 * @property Certificate $Certificate
 * @property PaginatorComponent $Paginator
 */
class CertificatesController extends AppController {

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

            $fields = array('Certificate.id', 'Certificate.name', 'Certificate.description');
            $certificates = $this->Certificate->find('all', array('fields' => $fields));
            $this->set(compact('certificates'));
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

            $fields = array('Certificate.id', 'Certificate.name', 'Certificate.description');
            $conditions = array('Certificate.id' => $id);
            $this->set('certificate', $this->Certificate->find('first', array('conditions'=>$conditions, 'fields' => $fields)));
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
            if(!$this->Certificate->exists($id)) {
                throw new NotFoundException;
            }

            $conditions = array(
                'Certificate.'.$this->Certificate->primaryKey => $id,
            );
            $certificate = $this->Certificate->find('first', array('conditions'=>$conditions));
            $this->set(compact('certificate'));
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

                if ($this->Certificate->save($this->request->data)) {
                    $answer['success'] = true;
                    $answer['message'] = 'Der Zertifikat wurde erstellt';
                    $answer['certificateId'] = $this->Certificate->id;
                } else {
                    $answer['success'] = false;
                    $answer['message'] = 'Der Zertifikat konnte nicht erstellt werden';
                    $answer['errors']['Certificate'] = $this->Certificate->validationErrors;
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
                if(!$this->Certificate->exists($id))
                {
                    throw new NotFoundException;
                }
                $this->request->data['Certificate']['id'] = $id;
                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();



                if ($this->Certificate->saveAll($this->request->data)) {
                    $answer['success'] = true;
                    $answer['message'] = 'Der Zertifikat wurde bearbeitet';

                } else {
                    $answer['success'] = false;
                    $answer['message'] = 'Der Zertifikat konnte nicht bearbeitet werden';
                    $answer['errors']['Certificate'] = $this->Certificate->validationErrors;
                }
                echo json_encode($answer);
            } else
            {
                $this->Certificate->Behaviors->load('Containable');

                $contain = array(
                    'Account' => array (
                        'fields' => array('Account.id')
                    )
                );
                $conditions = array('Certificate.' . $this->Certificate->primaryKey => $id);
                $certificate = $this->Certificate->find('first', array('conditions'=>$conditions, 'contain' => $contain));
                $this->loadModel('Account');
                $users = $this->Account->find('all', array('recursive'=>1, 'conditions'=>array('Account.role > '=>0), 'fields'=> array('Account.id', 'Account.username', 'Person.name', 'Person.surname')));
                $this->set(compact('certificate', 'users'));
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
                if(!$this->Certificate->exists($id))
                {
                    throw new NotFoundException;
                }
                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();

                if ($this->Certificate->delete($id)) {
                    $answer['success'] = true;
                    $answer['message'] = 'Der Zertifikat wurde gelöscht';
                } else {
                    $answer['success'] = false;
                    $answer['message'] = 'Der Zertifikat konnte nicht gelöscht werden';
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
