<?php
App::uses('AppController', 'Controller');

class AccountsController extends AppController {

	public $components = array('Paginator', 'Session');
	
	$helpers = array('Html' => array('className' => 'HtmlApp'));
	
	public function index() {
		$this->layout = 'polymer';
	}
	
}
