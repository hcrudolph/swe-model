<?php
App::uses('AppController', 'Controller');

class TestController extends AppController {

	public $components = array('Paginator', 'Session');
	
	public $helpers = array('Polymer');
	
	public function index() {
		$this->layout = 'polymer';
	}
	
	public function test() {
		$this->layout = 'polymer';
		$this->autoRender = false;
		/*
		Count-Abfrage
		http://stackoverflow.com/questions/3696701/cakephp-using-models-in-different-controllers
		$this->loadModel('course_room_times');
		*/
	}
	
}
