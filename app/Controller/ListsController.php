<?php
App::uses('AppController', 'Controller');
/**
 * Lists Controller
 *
 * @property PaginatorComponent $Paginator
 */
class ListsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

    var $uses = array('Date', 'Account', 'Person');
    
    
/**
 * index method
 *
 * @throws AjaxImplementedException
 * @return void
 */
	public function index() {
        if($this->request->is('ajax'))
        {
            $this->layout = 'ajax';
        } else
        {
            throw new AjaxImplementedException;
        }
	}
    
    
    
    public function trainer()
    {
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';


            //$fields = array("Date.*", 'Person.*');
            $joins = array(
                array(
                    'table' => 'people',
                    'alias' => 'Person',
                    'type' => 'INNER',
                    'conditions' => array('Date.director = Person.account_id')
                )
            );
            $results = $this->Date->find('all', array(/*'fields' => $fields,*/
                'joins' => $joins));
            $this->set(compact('results'));
        } else
        {
            throw new AjaxImplementedException;
        }
    }
    
    public function mitarbeiter()
    {
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';

            $conditions = array('Account.role' => 1, 'Account.role' => 2);
            $fields = array('Account.id', 'Person.*');
            $results = $this->Account->find('all', array('conditions' => $conditions, 'fields' => $fields));
            $this->set(compact('results'));
        } else
        {
            throw new AjaxImplementedException;
        }
    }
    
    public function mitglieder()
    {
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';

            $conditions = array('Account.role' => 0,);
            $fields = array('Account.id', 'Person.*');
            $results = $this->Account->find('all', array('conditions' => $conditions, 'fields' => $fields));
            $this->set(compact('results'));
        } else
        {
            throw new AjaxImplementedException;
        }
    }
    
    public function beforeFilter()
    {
        parent::beforeFilter();
        //$this->Auth->deny(array('index', 'trainer', 'mitarbeiter', 'mitglieder'));
    }
}