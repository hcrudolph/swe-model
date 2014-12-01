<?php
App::uses('AppController', 'Controller');

class GitController extends AppController {

  public function pull()
  {
    $this->autoRender = false;
    echo getcwd()."<br />";
    echo shell_exec("git pull")."<br />";
    echo exec("whoami");
  }
}
?>
