<?php
App::uses('AppController', 'Controller');

class GitController extends AppController {

  public function pull()
  {
    $this->autoRender = false;
    echo getcwd()."<br />";
    $output = array();
    exec("git pull", $output);
    foreach($output as $line)
    {
      echo $line.'<br />';
    }
    echo exec("whoami");
  }
}
?>
