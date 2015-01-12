<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 * Bearbeitet die Aktionen sowohl für den Accounts als auch für den Person Controller
 */
class UsersController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
    var $uses = array('Account', 'Person');

    /**
     * listing method
     *
     * @throws ForbiddenException, AjaxImplementedException, NotFoundException
     * @param $id
     * @return void
     */
    public function listing($id = null)
    {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->Account->recursive = 0;
            if(!is_null($id)) {
                if ($this->Auth->user('id') != $id AND $this->Auth->user('role') == 0) {
                    throw new ForbiddenException;
                }
                if (!$this->Account->exists($id)) {
                    throw new NotFoundException;
                }
                $usersListing = $this->Account->find('all', array('conditions'=>array('Account.id' => $id)));
            } else {
                $usersListing = $this->Account->find('all', array('order'=>array('Person.name')));
            }
            $this->set(compact('usersListing'));
        } else {
            throw new AjaxImplementedException;
        }
    }

    /**
     * view method
     *
     * @throws ForbiddenException, AjaxImplementedException, NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            if (is_null($id)) {
                $id = $this->Auth->user('id');
            } else {
                if ($this->Auth->user('id') != $id AND $this->Auth->user('role') == 0) {
                    throw new ForbiddenException;
                }
                if(!$this->Account->exists($id))
                {
                    throw new NotFoundException;
                }
            }
            #Anzeige eines einzelnen Users
            $conditions = array('Account.id' => $id);
            $userResult = $this->Account->find('first', array('conditions' => $conditions));
            $this->set(compact('userResult'));
        } else {
            throw new AjaxImplementedException;
        }
    }

    /**
     * add method
     * Fügt dem System einen neuen Account hinzu
     *
     *
     * @throws ForbiddenException, AjaxImplementedException
     * @return void
     */
    public function add()
    {
        if ($this->request->is('ajax')) {
            if ($this->Auth->user('role') == 0) {
                throw new ForbiddenException;
            } else {
                if ($this->request->is(array('post', 'put'))) {
                    $this->autoRender = false;
                    $this->layout = null;
                    $this->response->type('json');
                    $answer = array();

                    $CreatorRole = $this->Auth->User('role');
                    $UserRole = $this->request->data['Account']['role'];


                    if((($CreatorRole == 2 AND $UserRole >= 0) OR ($CreatorRole == 1 AND $UserRole == 0)) AND $this->Account->saveAssociated($this->request->data, array('validate' => 'first', 'deep' => true)))
                    {
                        $answer['success'] = true;
                        $answer['id'] = $this->Account->id;
                        $answer['message'] = "Der User wurde angelegt";
                    } else{

                        $answer['success'] = false;
                        $answer['message'] = "Der User konnte nicht angelegt werden";
                        $answer['errors'] = $this->Account->validationErrors;
                        if(!empty($answer['errors']['Account']['Person'])) {
                            $answer['errors']['Person'] = $answer['errors']['Account']['Person'];
                            unset($answer['errors']['Account']['Person']);
                        }
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
     * @throws ForbiddenException, AjaxImplementedException, NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            if (is_null($id)) {
                $id = $this->Auth->user('id');
            } else {
                if ($id != $this->Auth->user('id') && $this->Auth->user('role') == 0) {
                    throw new ForbiddenException;
                }
            }
            if(!$this->Account->exists($id))
            {
                throw new NotFoundException;
            }
            if ($this->request->is(array('post', 'put'))) {
                $this->request->data['Account']['id'] = $id;
                
                if ($id != $this->Auth->user('id') && $this->Auth->user('role') == 1) {
                    if(empty($this->request->data['Account']['password']) && empty($this->request->data['Account']['passwordRepeat'])) {
                        unset($this->request->data['Account']['password']);
                        unset($this->request->data['Account']['passwordRepeat']);
                    }
    
                    if(isset($this->request->data['Account']['role']))
                        unset($this->request->data['Account']['role']);
                }
                if ($this->Auth->user('role') == 0) {
                    if(empty($this->request->data['Account']['password']) && empty($this->request->data['Account']['passwordRepeat'])) {
                        unset($this->request->data['Account']['password']);
                        unset($this->request->data['Account']['passwordRepeat']);
                    }
                    if(isset($this->request->data['Account']['role']))
                        unset($this->request->data['Account']['role']);
                    if(isset($this->request->data['Person']['name']))
                        unset($this->request->data['Person']['name']);
                    if(isset($this->request->data['Person']['surname']))
                        unset($this->request->data['Person']['surname']);
                    if(isset($this->request->data['Person']['plz']))
                        unset($this->request->data['Person']['plz']);
                    if(isset($this->request->data['Person']['city']))
                        unset($this->request->data['Person']['city']);
                    if(isset($this->request->data['Person']['street']))
                        unset($this->request->data['Person']['street']);
                    if(isset($this->request->data['Person']['housenumber']))
                        unset($this->request->data['Person']['housenumber']);
                    if(isset($this->request->data['Person']['hnextra']))
                        unset($this->request->data['Person']['hnextra']);
                    if(isset($this->request->data['Person']['birthdate']))
                        unset($this->request->data['Person']['birthdate']);
                }
                $editUser = $this->Account->find('first', array('conditions'=> array('Account.id' => $id), 'fields'=>array('Account.role')));
                $userrolle = $editUser['Account']['role'];
                if ($this->Auth->user('role') == 1 && $userrolle > 1) {
                    if(empty($this->request->data['Account']['password']) && empty($this->request->data['Account']['passwordRepeat'])) {
                        unset($this->request->data['Account']['password']);
                        unset($this->request->data['Account']['passwordRepeat']);
                    }
                    if (isset($this->request->data['Account']['username']))
                        unset($this->request->data['Account']['username']);
                    if (isset($this->request->data['Account']['password']))
                        unset($this->request->data['Account']['password']);
                    if (isset($this->request->data['Account']['passwordRepeat']))
                        unset($this->request->data['Account']['passwordRepeat']);
                    if(isset($this->request->data['Account']['role']))
                        unset($this->request->data['Account']['role']);
                    if(isset($this->request->data['Person']['name']))
                        unset($this->request->data['Person']['name']);
                    if(isset($this->request->data['Person']['email']))
                        unset($this->request->data['Person']['email']);
                    if(isset($this->request->data['Person']['surname']))
                        unset($this->request->data['Person']['surname']);
                    if(isset($this->request->data['Person']['plz']))
                        unset($this->request->data['Person']['plz']);
                    if(isset($this->request->data['Person']['phone']))
                        unset($this->request->data['Person']['phone']);
                    if(isset($this->request->data['Person']['city']))
                        unset($this->request->data['Person']['city']);
                    if(isset($this->request->data['Person']['street']))
                        unset($this->request->data['Person']['street']);
                    if(isset($this->request->data['Person']['housenumber']))
                        unset($this->request->data['Person']['housenumber']);
                    if(isset($this->request->data['Person']['hnextra']))
                        unset($this->request->data['Person']['hnextra']);
                    if(isset($this->request->data['Person']['birthdate']))
                        unset($this->request->data['Person']['birthdate']);
                }

                //related Model needs id
                $conditions = array('Person.account_id' => $this->request->data['Account']['id']);
                $fields = array('Person.id');
                $relatedEntry = $this->Person->find('first', array('conditions' => $conditions, 'fields' => $fields));
                $this->request->data['Person']['id'] = $relatedEntry['Person']['id'];

                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();
                if($this->Account->saveAssociated($this->request->data/*, array('validate' => 'first', 'deep' => true)*/))
                {
                    $answer['success'] = true;
                    $answer['message'] = "User erfolgreich bearbeitet";
                } else
                {
                    $answer['success'] = false;
                    $answer['message'] = "User konnte nicht bearbeitet werden";
                    $answer['errors']['Account'] = $this->Account->validationErrors;
                    if(!empty($answer['errors']['Account']['Person'])) {
                        $answer['errors']['Person'] = $answer['errors']['Account']['Person'];
                        unset($answer['errors']['Account']['Person']);
                    }
                }
                echo json_encode($answer);
            } else {
                $conditions = array('Account.id' => $id);
                $userResult = $this->Account->find('first', array('conditions' => $conditions));
                $this->set(compact('userResult'));
            }
        } else {
            throw new AjaxImplementedException;
        }
    }

    /**
     * delete method
     *
     * @throws ForbiddenException, AjaxImplementedException, MethodNotAllowedException, NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $deleteUser = $this->Account->find('first', array('conditions'=> array('Account.id' => $id), 'fields'=>array('Account.role')));
            $userrolle = $deleteUser['Account']['role'];
            if ($this->Auth->user('role') == 0) {
                throw new ForbiddenException;
            }
            elseif ($this->Auth->user('role') == 1) {
                if ($userrolle > 0) {
                    throw new ForbiddenException;
                }
                else {
                    if ($this->request->is(array('post', 'delete'))) {
                        $this->autoRender = false;
                        $this->layout = null;
                        $this->response->type('json');
                        $answer = array();
                        //Löschen des Users über alle verknüpften Models
                        if(!is_null($id) AND $this->Account->delete($id, true))
                        {
                            $answer['success'] = true;
                            $answer['message'] = "Der Account und alle zugehörigen Daten wurden gelöscht.";
                        } else
                        {
                            $answer['success'] = false;
                            $answer['message'] = "Der Account und alle zugehörigen Daten konnten nicht gelöscht werden";
                        }
                        echo json_encode($answer);
                    } else
                    {
                        throw new MethodNotAllowedException;
                    }
                }
            }
            else {
                if ($this->request->is(array('post', 'delete'))) {
                    $this->autoRender = false;
                    $this->layout = null;
                    $this->response->type('json');
                    $answer = array();
                    //Löschen des Users über alle verknüpften Models
                    if(!is_null($id) AND $this->Account->delete($id, true))
                    {
                        $answer['success'] = true;
                        $answer['message'] = "Der Account und alle zugehörigen Daten wurden gelöscht";
                    } else
                    {
                        $answer['success'] = false;
                        $answer['message'] = "Der Account und alle zugehörigen Daten konnten nicht gelöscht werden";
                    }
                    echo json_encode($answer);
                } else
                {
                    throw new MethodNotAllowedException;
                }
            }
        } else {
            throw new AjaxImplementedException;
        }
    }
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->deny();
        $this->Auth->allow('login', 'checklogin');
        
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

