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
 * @param string $page
 * @return void
 */
	public function index($page = 0) {
        if($this->request->is('ajax'))
        {
            $this->layout = 'ajax';
        }

        $this->Post->Behaviors->load('Containable');
        $order = array('Post.created' => 'DESC');
        $contain = array(
            'Account'=>array(
                'Person'=>array(
                    'fields' => array('name', 'surname'),
                )
            )
        );
        $limit = 5;

        $this->set(compact('limit'));
        $this->set('postCount', $this->Post->find('count'));
        $this->set(compact('page'));
		$this->set('posts', $this->Post->find('all', array('contain'=>$contain,'limit'=>$limit,'page'=>$page+1, 'order' => $order)));
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
                throw new NotFoundException;
            }
            $this->Post->Behaviors->load('Containable');
            $contain = array(
                'Account'=>array(
                    'Person'=>array()
                ));
            $conditions = array('Post.' . $this->Post->primaryKey => $id);
            $this->set('post', $this->Post->find('first', array('conditions' => $conditions,'contain' =>$contain)));
        } else
        {
            throw new AjaxImplementedException;
	    }
	}

/**
 * add method
 * @throws AjaxImplementedException, ForbiddenException
 * @return void
 */
	public function add() {
        if($this->request->is('ajax'))
        {
            if($this->Auth->user('role') == 0) {
                throw new ForbiddenException;
            } else {
                if ($this->request->is('post', 'put')) {
                    $this->autoRender = false;
                    $this->layout = null;
                    $this->response->type('json');
                    $answer = array();
                    $this->request->data['Post']['account_id'] = $this->Auth->user('id');

                    if ($this->Post->save($this->request->data)) {
                        $answer['success'] = true;
                        $answer['id'] = $this->Post->id;
                        $answer['message'] = 'Der Eintrag wurde gespeichert';

                    } else {
                        $answer['success'] = false;
                        $answer['message'] = "Der Eintrag konnte nicht hinzugefügt werden";
                        $answer['errors']['Post'] = $this->Post->validationErrors;
                    }
                    echo json_encode($answer);
                } else {
                    $this->layout = 'ajax';
                }
            }
        } else {
            throw new AjaxImplementedException;
        }
	}

/**
 * edit method
 *
 * @throws AjaxImplementedException, ForbiddenException, NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        
        if($this->request->is('ajax'))
        {
            if($this->Auth->user('role') == 0) {
                throw new ForbiddenException;
            }
            if(!$this->Post->exists($id))
            {
                throw new NotFoundException;
            }
            $this->layout = 'ajax';
            if ($this->request->is(array('post', 'put'))) {

                $this->request->data['Post']['account_id'] = $this->Auth->user('id');
                $this->request->data['Post']['id'] = $id;
                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();

                if ($this->Post->save($this->request->data)) {
                    $answer['success'] = true;
                    $answer['message'] = 'Der Eintrag wurde gespeichert';
                } else {
                    $answer['success'] = false;
                    $answer['message'] = 'Der Eintrag konnte nicht gespeichert werden';
                    $answer['errors']['Post'] = $this->Post->validationErrors;
                }
                echo json_encode($answer);
            } else {
                $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
                $post = $this->Post->find('first', $options);
                $this->set(compact('post'));
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
                if(!$this->Post->exists($id))
                {
                    throw new NotFoundException;
                }
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

    /**
     * slider method
     *
     * @throws AjaxImplementedException
     * @param string $id
     * @return void
     */
    public function slider() {
        if($this->request->is('ajax'))
        {
            $this->layout = 'ajax';
            $this->Post->recursive = 0;
            $conditions = array('visiblebegin <=' => date("Y-m-d"), 'visibleend >=' => date("Y-m-d"));
            $posts = $this->Post->find('all', array('conditions' => $conditions));
            $this->set(compact('posts'));
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
