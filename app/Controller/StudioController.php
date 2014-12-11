<?php
App::uses('AppController', 'Controller');
/**
 * Studio Controller
 *
 * @property PaginatorComponent $Paginator
 */
class StudioController extends AppController {

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
    
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow();
    }
}