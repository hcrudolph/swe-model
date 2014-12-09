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
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
        if($this->request->is('ajax'))
        {
            $this->layout = 'ajax';
        } else
        {
            $this->layout = 'polymer';
        }
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
		$this->set('post', $this->Post->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($addId = null) {
        $this->request->data['account_id'] = 1;
        if($this->request->is('ajax'))
        {
            if($this->request->is('post'))
            {
                $this->autoRender = false;
                $this->layout=null;
                $this->response->type('json');
                $answer = array();
                if($this->Post->save($this->request->data))
                {
                    $answer['inserted'] = true;
                    $answer['id'] = $this->Post->id;

                } else
                {
                    $answer['inserted'] = false;
                }
                echo json_encode($answer);
            } else
            {
                $this->layout = 'ajax';
                $this->set('addId', $addId);
            }
        } else
        {
            $this->layout = 'polymer';
        
        
            if ($this->request->is('post')) {
                $this->Post->create();
                if ($this->Post->save($this->request->data)) {
                    $this->Session->setFlash(__('The post has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The post could not be saved. Please, try again.'));
                }
            }
            $accounts = $this->Post->Account->find('list');
            $this->set(compact('accounts'));
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
        if($this->request->is('ajax'))
        {
            $this->layout = 'ajax';
            if($this->request->is(array('post', 'put')))
            {
               $this->request->data['account_id'] = 1;
                $this->autoRender = false;
                $this->layout=null;
                $this->response->type('json');
                $answer = array();
                if($this->Post->save($this->request->data))
                {
                    $answer['inserted'] = true;
                } else
                {
                    $answer['inserted'] = false;
                }
                echo json_encode($answer);
            } else
            {
                $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
                $data = $this->Post->find('first', $options);
                $this->set(compact('data'));
            }
        } else
        {
            $this->layout = 'polymer';
        
        
            if (!$this->Post->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            if ($this->request->is(array('post', 'put'))) {
                if ($this->Post->save($this->request->data)) {
                    $this->Session->setFlash(__('The post has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The post could not be saved. Please, try again.'));
                }
            } else {
                $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
                $this->request->data = $this->Post->find('first', $options);
            }
            $accounts = $this->Post->Account->find('list');
            $this->set(compact('accounts'));
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
        $this->Post->id = $id;
        if($this->request->is('ajax'))
        {
            $this->autoRender = false;
            $this->layout = 'ajax';
            $this->Post->delete();
        } else
        {
            $this->layout = 'polymer';
            
            if (!$this->Post->exists()) {
                throw new NotFoundException(__('Invalid post'));
            }
            //$this->request->allowMethod('post', 'delete');
            if ($this->Post->delete()) {
                $this->Session->setFlash(__('The post has been deleted.'));
            } else {
                $this->Session->setFlash(__('The post could not be deleted. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
        }
	}
}
