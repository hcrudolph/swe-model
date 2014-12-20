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
     * index method
     *
     * @throws ForbiddenException, AjaxImplementedException
     * @return void
     */
    public function index()
    {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            if ($this->Auth->user('role') == 0) {
                throw new ForbiddenException;
            }
            #Sortierung? Anzeige des Templates
            $users = $this->Account->find('all');
            $this->set(compact('users'));
        } else {
            throw new AjaxImplementedException;
        }
    }

    /**
     * listing method
     *
     * @throws ForbiddenException, AjaxImplementedException
     * @return void
     */
    public function listing()
    {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            if ($this->Auth->user('role') == 0) {
                throw new ForbiddenException;
            }
            #Sortierung? Anzeige des Templates
            $usersListing = $this->Account->find('all');
            $this->set(compact('usersListing'));
        } else {
            throw new AjaxImplementedException;
        }
    }

    /**
     * view method
     *
     * @throws ForbiddenException, AjaxImplementedException
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
                if ($this->Auth->user('role') == 0) {
                    throw new ForbiddenException;
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
                    $UserRole = $this->request->data->Account->role;

                    if((($CreatorRole == 2 AND $UserRole >= 0) OR ($CreatorRole == 1 AND $UserRole == 0)) AND $this->Account->save())
                    {
                        if($this->Person->save()) {
                            $answer['success'] = true;
                            $answer['id'] = $this->Account->id;
                            $answer['message'] = "Der User wurde angelegt";
                        } else{
                            //Damit beim erneuten Ajax-Senden keine Reste des Accounts existieren
                            $this->Account->delete();
                            $answer['success'] = false;
                            $answer['errors'] = $this->Person->validationErrors;
                            $answer['message'] = "Der User konnte nicht angelegt werden";
                        }
                    } else
                    {
                        $answer['success'] = false;
                        $answer['errors'] = $this->Account->validationErrors;
                        $answer['message'] = "Der User konnte nicht angelegt werden";
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
     * @throws ForbiddenException, AjaxImplementedException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            if ($this->request->is(array('post', 'put'))) {
                if ($id != $this->Auth->user('id') && $this->Auth->user('role') == 0) {
                    //Mitglied will einen anderen User Speichern
                    throw new ForbiddenException;
                }
                if (is_null($id)) {
                    $this->request->data['Account']['id'] = $this->Auth->user('id');
                    //$this->request->data['Person']['account_id'] = $this->Auth->user('id');
                } else
                {
                    $this->request->data['Account']['id'] = $id;
                    //$this->request->data['Person']['account_id'] = $id;
                }

                $this->request->data['Person']['birthdate'] = date("Y-m-d", strtotime($this->request->data['Person']['birthdate']));

                $this->autoRender = false;
                $this->layout = null;
                $this->response->type('json');
                $answer = array();
                if($this->Account->saveAssociated($this->request->data))
                {
                    $answer['success'] = true;
                    $answer['message'] = "User erfolgreich bearbeitet";
                } else
                {
                    $answer['success'] = false;
                    $answer['message'] = "User konnte nicht bearbeitet werden";
                    $answer['errors'] = $this->validationErrors;
                }
                echo json_encode($answer);
            } else {
                if (is_null($id)) {
                    $id = $this->Auth->user('id');
                } else {
                    if ($this->Auth->user('role') == 0) {
                        throw new ForbiddenException;
                    }
                }
                $conditions = array('Account.id' => $id);
                $userResult = $this->Account->find('first', array('conditions' => $conditions));
                $this->set(compact('userResult'));
            }
        } else {
            throw new AjaxImplementedException;
        }
    }

    public function delete($id = null)
    {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            if ($this->Auth->user('role') == 0) {
                throw new ForbiddenException;
            } else {
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
                    throw new RequestTypeException;
                }
            }
        } else {
            throw new AjaxImplementedException;
        }
    }
}