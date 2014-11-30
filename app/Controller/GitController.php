<?php
App::uses('AppController', 'Controller');

class GitController extends AppController {

  public function pull()
  {
    $this->autoRender = false;
    echo getcwd();
    echo exec("git pull");
  }
}
?>
