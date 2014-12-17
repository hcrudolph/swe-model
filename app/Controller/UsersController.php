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
            //$conditions = array('Account.id', $id);
            $users = $this->Account->find('all'/*, array('conditions' => $conditions)*/);
            $this->set(compact('users'));
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
            $conditions = array('Account.id', $id);
            $user = $this->Account->find('first', array('conditions' => $conditions));
            $this->set(compact('user'));
        } else {
            throw new AjaxImplementedException;
        }
    }

    /**
     * add method
     *
     * @throws ForbiddenException, AjaxImplementedException
     * @return void
     */
    public function add()
    {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            if ($this->Auth->user('role') == 0) {
                throw new ForbiddenException;
            } else {
                if ($this->request->is(array('post', 'put'))) {
                    //Speichern und Validierung
                } else {

                    //Ausgabe des Templates
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
                #Speichern des Users
            } else {
                if (is_null($id)) {
                    $id = $this->Auth->user('id');
                } else {
                    if ($this->Auth->user('role') == 0) {
                        throw new ForbiddenException;
                    }
                }
                #Anzeige des Templates
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
                if ($this->request->is(array('post', 'put'))) {
                    //Löschen des Users
                }
            }
        } else {
            throw new AjaxImplementedException;
        }
    }
}