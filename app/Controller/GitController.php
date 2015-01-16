<?php
set_time_limit(0);
App::uses('AppController', 'Controller');

class GitController extends AppController {

  public function pull()
  {
  $this->autoRender = false;
    echo '<table>';
    echo "<tr><td>current directory</td><td>";
    echo getcwd()."</td></tr>";
    echo "<tr><td>git pull</td><td>";
    $output = array();
    exec("git pull 2>&1", $output);
    foreach($output as $line)
    {
      echo $line;
      echo '<br />';
    }
    echo "</td></tr>";
    
    echo "<tr><td>current user</td><td>".exec("whoami")."</td></tr>";
    echo '</table>';
  }
  public function overwrite()
  {
    $this->autoRender = false;
    echo '<table>';
    echo "<tr><td>current directory</td><td>";
    echo getcwd()."</td></tr>";
    echo "<tr><td>git fetch --all</td><td>";
    $output = array();
    exec("git fetch --all 2>&1", $output);
    foreach($output as $line)
    {
      echo $line;
      echo '<br />';
    }
    echo "</td></tr>";
    
    echo "<tr><td>git reset --hard origin/development</td><td>";
    $output = array();
    exec("git reset --hard origin/development 2>&1", $output);
    foreach($output as $line)
    {
      echo $line;
      echo '<br />';
    }
    echo "</td></tr>";
    
    echo "<tr><td>current user</td><td>".exec("whoami")."</td></tr>";
    echo '</table>';
  }
    
    //git benötigt keinen Login
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();
    }
}
?>
