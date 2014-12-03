<?php
App::uses('AppController', 'Controller');

class TestController extends AppController {

	public $components = array('Paginator', 'Session');
	
	public $helpers = array('Html' => array('className' => 'ApplicationHtml'));
	
	public function index() {
		$this->layout = 'polymer';
	}
	
}
