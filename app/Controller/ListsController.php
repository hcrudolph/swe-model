<?php
App::uses('AppController', 'Controller');

/**
 * Lists Controller
 *
 * @property PaginatorComponent $Paginator
 */
class ListsController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    var $uses = array('Date', 'Account', 'Person', 'Course');


    /**
     * index method
     *
     * @throws AjaxImplementedException
     * @return void
     */
    public function index()
    {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        } else {
            throw new AjaxImplementedException;
        }
    }

    /**
     * trainer method
     *
     * @throws AjaxImplementedException
     * @return void
     */
    public function trainer()
    {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';

            //$fields = array("Date.*", 'Person.*');
            $joins = array(
                array(
                    'table' => 'dates',
                    'alias' => 'Date',
                    'type' => 'INNER',
                    'conditions' => array('Date.director = Account.id')
                )
            );
            $trainers = $this->Account->find('all', array(/*'fields' => $fields,*/
                'joins' => $joins,
                'group' => array('Date.director'),
                'contain' => array(
                    'Person' => array(),
                    'Certificate' => array()
                )
            ));
            $this->set(compact('trainers'));
        } else {
            throw new AjaxImplementedException;
        }
    }

    /**
     * mitarbeiter method
     *
     * @throws AjaxImplementedException
     * @return void
     */
    public function mitarbeiter()
    {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';

            $conditions = array('Account.role >' => 0);
            $fields = array('Account.id', 'Person.*');
            $results = $this->Account->find('all', array('conditions' => $conditions, 'fields' => $fields));
            $this->set(compact('results'));
        } else {
            throw new AjaxImplementedException;
        }
    }

    /**
     * kurse method
     *
     * @throws AjaxImplementedException
     * @return void
     */
    public function kurse()
    {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $fields = array('Course.name', 'Course.description');
            $courses = $this->find('all', array('fields' => $fields));
            $this->set(compact('courses'));
        } else {
            throw new AjaxImplementedException;
        }
    }
    /**
     * tarife method
     *
     * @throws AjaxImplementedException
     * @return void
     */
    public function tarife()
    {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        } else {
            throw new AjaxImplementedException;
        }
    }

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->deny();
        $this->Auth->allow(array('index','trainer', 'mitarbeiter','kurse', 'tarife'));
        // erlaubt view von Trainer, Mitarbeitern, Kurse, Preise
    }
}
