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
        if ($this->Auth->user('role') == 0) {
            throw new ForbiddenException;
        }
        if($this->request->is('ajax'))
        {
            $this->layout = 'ajax';
        } else
        {
            throw new AjaxImplementedException;
        }
	}
    
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->deny('index');
    }
}