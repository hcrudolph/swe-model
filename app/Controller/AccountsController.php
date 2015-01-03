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
        $this->Auth->allow('login', 'checklogin');
        $this->Auth->deny('edit', 'delete', 'index', 'add', 'view');
      //$this->Auth->allow('index', 'view');
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
