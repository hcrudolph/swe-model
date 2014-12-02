<?php
set_time_limit(0);
App::uses('AppController', 'Controller');
class TestController extends AppController {
  public function view()
  {
    $this->layout = 'polymer';
  }
}
?>
