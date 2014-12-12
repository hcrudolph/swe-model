<?php
App::uses('AppController', 'Controller');
/**
 * Accounts Controller
 *
 * @property Account $Account
 * @property PaginatorComponent $Paginator
 */
class AccountsController extends AppController {

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
		$this->Account->recursive = 0;
		$this->set('accounts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Account->exists($id)) {
			throw new NotFoundException(__('Invalid account'));
		}
		$options = array('conditions' => array('Account.' . $this->Account->primaryKey => $id));
		$this->set('account', $this->Account->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Account->create();
			if ($this->Account->save($this->request->data)) {
				$this->Session->setFlash(__('The account has been saved.'));
                $data = array(
                    'Account' => array('id' => $this->Account->id),
                    'Person' => array('id' => NULL, 'account_id' => $this->Account->id)
                );
                $this->Account->Person->save($data);
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The account could not be saved. Please, try again.'));
			}
		}
		$certificates = $this->Account->Certificate->find('list');
		$dates = $this->Account->Date->find('list');
		$this->set(compact('certificates', 'dates'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Account->exists($id)) {
			throw new NotFoundException(__('Invalid account'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Account->save($this->request->data)) {
				$this->Session->setFlash(__('The account has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The account could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Account.' . $this->Account->primaryKey => $id));
			$this->request->data = $this->Account->find('first', $options);
		}
		$certificates = $this->Account->Certificate->find('list');
		$dates = $this->Account->Date->find('list');
		$this->set(compact('certificates', 'dates'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Account->id = $id;
		if (!$this->Account->exists()) {
			throw new NotFoundException(__('Invalid account'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Account->delete()) {
			$this->Session->setFlash(__('The account has been deleted.'));
		} else {
			$this->Session->setFlash(__('The account could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
/**
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
        $this->Auth->deny('edit', 'delete');
    }*/
    
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();
    }
    
    public function login() {
        if($this->request->is('ajax'))
        {
            $this->autoRender = false;
            $this->layout=null;
            $this->response->type('json');
            $answer = array();
            if ($this->request->is('post')) {
                if ($this->Auth->login()) {
                    $view = new View($this, false);
                    $answer['login'] = true;
                    $answer['message'] = 'Sie wurden erfolgreich eingeloggt';
                    $answer['logout'] = $view->element('authentification/logout', array('user' => $this->Auth->user()));
                    $answer['sidebar'] = $view->element('sidebar/sidebar', array('user' => $this->Auth->user()));
                } else
                {
                    $answer['login'] = false;
                    $answer['message'] = 'Sie konnten nicht eingeloggt werden';
                }
            }
            echo json_encode($answer);
        }
    }
    
    public function logout() {
        if($this->request->is('ajax'))
        {
            $this->autoRender = false;
            $this->layout=null;
            $this->response->type('json');
            $answer = array();
            if ($this->request->is('post')) {
                if ($this->Auth->logout()) {
                    $view = new View($this, false);
                    $answer['logout'] = true;
                    $answer['message'] = 'Sie wurden erfolgreich ausgeloggt';
                    $answer['login'] = $view->element('authentification/login');
                    $answer['sidebar'] = $view->element('sidebar/sidebar');
                } else
                {
                    $answer['logout'] = false;
                    $answer['message'] = 'Sie konnten nicht ausgeloggt werden';
                }
            }
            echo json_encode($answer);
        }
    }
}
