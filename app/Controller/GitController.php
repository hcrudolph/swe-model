<?php
App::uses('AppController', 'Controller');

class GitController extends AppController {

public function pull()
{
$this->autoRender = false;
echo getcwd()."\n";
echo shell_exec("git pull");
}
}
