<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class PostsController extends AppController {

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
        
		//$this->Post->recursive = 0;
		$this->set('posts', $this->Post->find('all', array('order' => array('Post.created' => 'DESC'))));
	}

/**
 * view method
 *
 * @throws AjaxImplementedException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
        if($this->request->is('ajax'))
        {
            $this->layout = 'ajax';
            if (!$this->Post->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
            $this->set('post', $this->Post->find('first', $options));
        } else
        {
            throw new AjaxImplementedException;
	}
	}

/**
 * add method
 * @throws AjaxImplementedException, ForbiddenException
 * @param String $addId
 * @return void
 */
	public function add($addId = null) {
        if($this->request->is('ajax'))
        {
            if($this->Auth->user('role') == 0) {
                throw new ForbiddenException;
            } else {
                if ($this->request->is('post')) {
                    $this->autoRender = false;
                    $this->layout = null;
                    $this->response->type('json');
                    $answer = array();
                    $this->request->data['account_id'] = $this->Auth->user('id');

                    $this->request->data['visiblebegin'] = (empty($this->request->data['visiblebegin']) ? null : date("Y-m-d", strtotime($this->request->data['visiblebegin'])));
                    $this->request->data['visibleend'] = (empty($this->request->data['visibleend']) ? null : date("Y-m-d", strtotime($this->request->data['visibleend'])));

                    if ($this->Post->save($this->request->data)) {
                        $answer['inserted'] = true;
                        $answer['id'] = $this->Post->id;
                        $answer['message'] = 'Der Eintrag wurde gespeichert';

                    } else {
                        $answer['inserted'] = false;
                        $answer['message'] = "Der Eintrag konnte nicht hinzugefügt werden";
                    }
                    echo json_encode($answer);
                } else {
                    $this->layout = 'ajax';
                    $this->set('addId', $addId);
                }
            }
        } else {
            throw new AjaxImplementedException;
        }
	}

/**
 * edit method
 *
 * @throws AjaxImplementedException, ForbiddenException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        
        if($this->request->is('ajax'))
        {
            if($this->Auth->user('role') == 0) {
                throw new ForbiddenException;
            } else {
                $this->layout = 'ajax';
                if ($this->request->is(array('post', 'put'))) {
                    $this->request->data['account_id'] = $this->Auth->user('id');
                    $this->request->data['id'] = $id;
                    $this->request->data['visiblebegin'] = (empty($this->request->data['visiblebegin']) ? null : date("Y-m-d", strtotime($this->request->data['visiblebegin'])));
                    $this->request->data['visibleend'] = (empty($this->request->data['visibleend']) ? null : date("Y-m-d", strtotime($this->request->data['visibleend'])));
                    $this->autoRender = false;
                    $this->layout = null;
                    $this->response->type('json');
                    $answer = array();

                    if ($this->Post->save($this->request->data)) {
                        $answer['inserted'] = true;
                        $answer['message'] = 'Der Eintrag wurde gespeichert';
                    } else {
                        $answer['inserted'] = false;
                        $answer['message'] = 'Der Eintrag konnte nicht gespeichert werden';
                    }
                    echo json_encode($answer);
                } else {
                    $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
                    $data = $this->Post->find('first', $options);
                    $this->set(compact('data'));
                }
            }
        } else {
            throw new AjaxImplementedException;
        }
	}

/**
 * delete method
 *
 * @throws AjaxImplementedException, ForbiddenException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
        if($this->request->is('ajax'))
        {
            if($this->Auth->user('role') == 0) {
                throw new ForbiddenException;
            } else {
                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();
                if ($this->request->is(array('post', 'delete'))) {
                    $this->Post->id = $id;
                    if ($this->Post->delete()) {
                        $answer['success'] = true;
                        $answer['message'] = "Der Eintrag wurde gelöscht";
                    } else {
                        $answer['success'] = false;
                        $answer['message'] = "Der Eintrag konnte nicht gelöscht werden.";
                    }
                } else {
                    throw new RequestTypeException;
                }
                echo json_encode($answer);
            }
        } else {
            throw new AjaxImplementedException;
        }
	}
    
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();
        $this->Auth->deny(array('delete', 'edit', 'add'));
    }
}
