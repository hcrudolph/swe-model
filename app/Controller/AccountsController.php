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
            throw new NotImplementedException("Diese Anfrage wird nur mit Ajax unterstützt");
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
        if($this->request->is('ajax'))
        {
            $this->layout = 'ajax';
            if ($this->request->is(array('post', 'put'))) {

            } else
            {
                if(is_null($id))
                {
                    $id = $this->Auth->user('id');
                    //Eigenen Account bearbeiten
                } else
                {
                    if($this->Auth->user('role')==0)
                    {
                        throw new ForbiddenException;
                    }
                    //bearbeiten eines anderen Accounts
                }

                $conditions = array('Account.id', $id);
                $result = $this->Account->find('first', array('conditions'=>$conditions));
                $this->set(compact($result));
            }
        } else {
            throw new NotImplementedException("Diese Anfrage wird nur mit Ajax unterstützt");
        }

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
        if($this->request->is('ajax'))
        {
            $this->layout = 'ajax';
            if ($this->request->is(array('post', 'put'))) {

            } else
            {
                if(is_null($id))
                {
                    $id = $this->Auth->user('id');
                    if(isset($this->data[$this->account]['role']) AND $user['role'] == 0) {
                        unset($this->data[$this->account]['role']);
                        throw new ForbiddenException;
                    }
                    //Eigenen Account bearbeiten
                } else
                {
                    if($this->Auth->user('role')==0)
                    {
                        throw new ForbiddenException;
                    }
                    //bearbeiten eines anderen Accounts
                }

                $conditions = array('Account.id', $id);
                $result = $this->Account->find('first', array('conditions'=>$conditions));
                $this->set(compact($result));
            }
        } else {
            throw new NotImplementedException("Diese Anfrage wird nur mit Ajax unterstützt");
        }





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
        $this->Auth->allow('login', 'add');
        $this->Auth->deny('edit', 'delete', 'index',/* 'add',*/ 'view');
        $this->Auth->allow('permissions');
        //$this->Auth->allow('index', 'view');
    }


    public function permissions()
    {
    $role = $this->Account->role;

    // Admin Allow everything
    if ($role = 2) {
        $this->Acl->allow($role, 'controllers');
    }
    // Trainer Permissions
    if ($role = 1) {
        $this->Acl->deny($role, 'controllers');
        $this->Acl->allow($role, 'controllers/posts');
        $this->Acl->allow($role, 'controllers/courses');
        $this->Acl->allow($role, 'controllers/dates');
        $this->Acl->allow($role, 'controllers/rooms');
        $this->Acl->allow($role, 'controllers/people/view');
        $this->Acl->allow($role, 'controllers/people/add');
        $this->Acl->allow($role, 'controllers/people/edit');
        $this->Acl->allow($role, 'controllers/AccountsTrainings');
        $this->Acl->allow($role, 'controllers/bills/view');
        $this->Acl->allow($role, 'controllers/bills/add');
        $this->Acl->allow($role, 'controllers/calendar');
        $this->Acl->allow($role, 'controllers/lists');
        $this->Acl->allow($role, 'controllers/users/view');
        $this->Acl->allow($role, 'controllers/users/add');
        $this->Acl->allow($role, 'controllers/users/edit');
        $this->Acl->deny($role, 'controllers/users/delete');
        $this->Acl->allow($role, 'controllers/tariffs');
        $this->Acl->allow($role, 'controllers/accounts/view');
        $this->Acl->allow($role, 'controllers/accounts/add');
        $this->Acl->allow($role, 'controllers/accounts/edit');
        $this->Acl->deny($role, 'controllers/accounts/delete');
    }

    // Member Permissions
    if ($role = 0) {
        $this->Acl->deny($role, 'controllers');
        $this->Acl->allow($role, 'controllers/posts/view');
        $this->Acl->allow($role, 'controllers/courses/view');
        $this->Acl->allow($role, 'controllers/dates/view');
        $this->Acl->allow($role, 'controllers/dates/signup');
        $this->Acl->allow($role, 'controllers/dates/signoff');
        $this->Acl->allow($role, 'controllers/people/view');
        $this->Acl->allow($role, 'controllers/rooms/view');
        $this->Acl->allow($role, 'controllers/lists/view/trainer');
        $this->Acl->allow($role, 'controllers/AccountsTrainings/view');
        $this->Acl->allow($role, 'controllers/calendar/view');
        $this->Acl->allow($role, 'controllers/users/logout');


        //$this->Acl->allow($role, 'controllers/studio/view');
    }
    $this->Acl->allow($role, 'controllers/users/logout');

    echo "all done";
    exit;
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
                    $answer['sidebar'] = $view->element('sidebar', array('user' => $this->Auth->user()));
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
                    $answer['sidebar'] = $view->element('sidebar');
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
