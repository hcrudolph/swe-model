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
        echo "alle Trainer";
    }
    
    public function mitarbeiter()
    {
        $this->autoRender = false;
        echo "alle Mitarbeiter";
    }
    
    public function mitglieder()
    {
        $this->autoRender = false;
        echo "alle Mitglieder";
    }
    
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow();
    }
}