<?php
App::uses('AppController', 'Controller');

class CalendarController extends AppController
{
    public function init()
    {
        $this->layout = 'ajax';
    }
}