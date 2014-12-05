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
		$this->layout = 'polymer';
	}
}