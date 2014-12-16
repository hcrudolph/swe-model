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

    var $uses = array('Date', 'Account');
    
    
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
	}
    
    
    
    public function trainer()
    {
        $this->autoRender = false;
        
        $fields = array('DISTINCT Date.director');
        $results = $this->Date->find('all', array('fields' => $fields));
        
        echo var_dump($results);
        
        echo "alle Trainer";
    }
    
    public function mitarbeiter()
    {
        $this->autoRender = false;
        
        
        $conditions = array('Account.role' => 1, 'Account.role' => 2); //array of conditions
        $results = $this->Account->find('all', array('conditions' => $conditions));
        
        echo var_dump($results);
    }
    
    public function mitglieder()
    {
        $this->autoRender = false;
        $conditions = array('Account.role' => 0,); //array of conditions
        $results = $this->Account->find('all', array('conditions' => $conditions));
        
        echo var_dump($results);
    }
    
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow();
    }
}