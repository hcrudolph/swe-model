<?php
App::uses('AppController', 'Controller');

class GitController extends AppController {

  public function pull()
  {
    $this->autoRender = false;
    echo getcwd();
    echo shell_exec("git pull");
    echo "<br />";
    echo "Hello World!<br />";
    echo shell_exec("echo 'hello from Console'");;
  }
}
?>
