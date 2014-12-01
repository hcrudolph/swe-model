<?php
set_time_limit(0);
App::uses('AppController', 'Controller');

class GitController extends AppController {

  public function pull()
  {
    $this->autoRender = false;
    echo getcwd()."<br />";
    $output = array();
    exec("git pull 2>&1", $output);
    foreach($output as $line)
    {
      echo $line;
      echo '<br />';
    }
    echo exec("whoami");
  }
}
?>
