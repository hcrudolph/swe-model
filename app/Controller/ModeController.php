<?php

App::uses('AppController', 'Controller');
class ModeController extends AppController {
     public function safe()
     {
          $this->autoRender = false;
          if(ini_get('safe_mode')){
               echo 'safe-mode is on';
          }else{
               echo 'safe-mode is off';
          }
     }
}
?>
