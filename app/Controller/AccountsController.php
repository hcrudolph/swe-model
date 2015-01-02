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

        $role = $this->data[$this->account]['role'];
        // Admin Allow everything


        if ($role == 2) {
            $this->Acl->allow($role, 'controllers');
        }
        // Trainer Permissions
        if ($role == 1) {
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
        if ($role == 0) {
            $this->Acl->deny($role, 'controllers');
            $this->Acl->allow($role, 'controllers/posts/view');
            $this->Acl->allow($role, 'controllers/courses/view');
            $this->Acl->allow($role, 'controllers/dates/view');
            $this->Acl->allow($role, 'controllers/dates/signupUser');
            $this->Acl->allow($role, 'controllers/dates/signoffUser');
            $this->Acl->allow($role, 'controllers/people/view');
            $this->Acl->allow($role, 'controllers/rooms/view');
            $this->Acl->allow($role, 'controllers/lists/view/trainer');
            $this->Acl->allow($role, 'controllers/AccountsTrainings/view');
            $this->Acl->allow($role, 'controllers/calendar/view');
            $this->Acl->allow($role, 'controllers/users/logout');


            //$this->Acl->allow($role, 'controllers/studio/view');
        }
        $this->Acl->allow($role, 'controllers/users/logout');
        $this->Acl->allow($role, 'controllers/users/login');

        echo "all done";
        exit;
    }


    /**
     * login method
     *
     * @throws AjaxImplementedException, MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function login() {
        if($this->request->is('ajax')) {
            if ($this->request->is('post')) {
                $this->autoRender = false;
                $this->layout=null;
                $this->response->type('json');
                $answer = array();
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
                echo json_encode($answer);
            } else {
                throw new MethodNotAllowedException;
            }
        }  else {
            throw new AjaxImplementedException;
        }
    }

    /**
     * checklogin method
     *
     * @throws AjaxImplementedException
     * @return void
     */
    public function checklogin() {
        if($this->request->is('ajax'))
        {
            $this->autoRender = false;
            $this->layout=null;
            $this->response->type('json');
            $answer = array();
            if($this->Auth->loggedIn()) {
                $answer['loggedin'] = true;
            } else {
                $answer['loggedin'] = false;
            }
            echo json_encode($answer);
        } else {
            throw new AjaxImplementedException;
        }
    }

    /**
     * logout method
     *
     * @throws AjaxImplementedException, MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function logout() {
        if($this->request->is('ajax')) {
            if ($this->request->is('post')) {
                $this->autoRender = false;
                $this->layout=null;
                $this->response->type('json');
                $answer = array();
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
                echo json_encode($answer);
            } else {
                throw new MethodNotAllowedException;
            }

        } else {
            throw new AjaxImplementedException;
        }
    }
}
