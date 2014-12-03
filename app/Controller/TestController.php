<?php
App::uses('AppController', 'Controller');

class TestController extends AppController {

	public $components = array('Paginator', 'Session');
	
	public $helpers = array('Polymer');
	
	public function index() {
		$this->layout = 'polymer';
	}
	
}
