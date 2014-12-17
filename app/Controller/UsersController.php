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

    public function index()
    {

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
            if ($this->request->is(array('post', 'put'))) {

            } else {
                if (is_null($id)) {
                    $id = $this->Auth->user('id');
                } else {
                    if ($this->Auth->user('role') == 0) {
                        throw new ForbiddenException;
                    }
                }

                $conditions = array('Account.id', $id);
                $result = $this->Account->find('first', array('conditions' => $conditions));
                $this->set(compact('result'));
            }
        } else {
            throw new AjaxImplementedException;
        }
    }

    public function add()
    {

    }

    public function edit($id = null)
    {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            if ($this->request->is(array('post', 'put'))) {

            } else {
                if (is_null($id)) {
                    $id = $this->Auth->user('id');
                    //Eigenen User bearbeiten
                } else {
                    if ($this->Auth->user('role') == 0) {
                        throw new ForbiddenException;
                    }
                    //bearbeiten eines anderen Users
                }

                $conditions = array('Account.id', $id);
                $result = $this->Account->find('first', array('conditions' => $conditions));
                $this->set(compact('result'));
            }
        } else {
            throw new NotImplementedException("Diese Anfrage wird nur mit Ajax unterstützt");
        }
    }

    public function delete($id = null)
    {

    }
}