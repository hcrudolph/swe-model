<?php
App::uses('AppController', 'Controller');

class CalendarController extends AppController
{
    public function init()
    {
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
        } else
        {
            throw new AjaxImplementedException;
        }
    }
}